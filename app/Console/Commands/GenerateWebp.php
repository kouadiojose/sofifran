<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateWebp extends Command
{
    protected $signature = 'sofifran:webp {--force : Regénère même si la variante existe déjà}';

    protected $description = 'Génère les variantes .webp des images du site (servies aux navigateurs modernes via .htaccess)';

    public function handle(): int
    {
        $base = public_path('frontend/assets/images');

        if (!is_dir($base)) {
            $this->error("Dossier introuvable : $base");
            return self::FAILURE;
        }

        $useCwebp = trim((string) shell_exec('command -v cwebp')) !== '';
        $this->info($useCwebp ? 'Encodeur : cwebp' : 'Encodeur : PHP GD (imagewebp)');

        $done = 0; $skipped = 0; $failed = 0; $tooBig = 0;

        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($base, \FilesystemIterator::SKIP_DOTS));

        foreach ($iterator as $file) {
            if (!$file->isFile()) {
                continue;
            }

            $ext = strtolower($file->getExtension());
            if (!in_array($ext, ['jpg', 'jpeg', 'png'])) {
                continue;
            }

            $src  = $file->getPathname();
            $dest = $src . '.webp'; // photo.jpg -> photo.jpg.webp (attendu par le rewrite .htaccess)

            if (!$this->option('force') && file_exists($dest) && filemtime($dest) >= filemtime($src)) {
                $skipped++;
                continue;
            }

            $ok = $useCwebp
                ? $this->encodeAvecCwebp($src, $dest)
                : $this->encodeAvecGd($src, $dest, $ext);

            if (!$ok) {
                $failed++;
                continue;
            }

            // Ne garder la variante que si elle fait vraiment gagner de la place.
            if (filesize($dest) >= filesize($src)) {
                @unlink($dest);
                $tooBig++;
                continue;
            }

            $done++;
        }

        $this->info("Variantes générées : $done | déjà à jour : $skipped | sans gain (ignorées) : $tooBig | échecs : $failed");

        return self::SUCCESS;
    }

    private function encodeAvecCwebp(string $src, string $dest): bool
    {
        $cmd = sprintf('cwebp -quiet -q 80 %s -o %s 2>/dev/null', escapeshellarg($src), escapeshellarg($dest));
        shell_exec($cmd);

        return file_exists($dest) && filesize($dest) > 0;
    }

    private function encodeAvecGd(string $src, string $dest, string $ext): bool
    {
        try {
            $img = $ext === 'png' ? @imagecreatefrompng($src) : @imagecreatefromjpeg($src);
            if (!$img) {
                return false;
            }
            if ($ext === 'png') {
                imagepalettetotruecolor($img);
                imagealphablending($img, true);
                imagesavealpha($img, true);
            }
            $ok = imagewebp($img, $dest, 80);
            imagedestroy($img);

            return $ok && file_exists($dest);
        } catch (\Throwable $e) {
            return false;
        }
    }
}
