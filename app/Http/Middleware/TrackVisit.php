<?php

namespace App\Http\Middleware;

use App\Models\Visite;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Enregistre chaque page vue du site public dans la table visites.
 * Sont ignores : la zone admin, les requetes non-GET/AJAX, les robots
 * d'indexation et les administrateurs connectes (pour ne pas fausser
 * les statistiques).
 */
class TrackVisit
{
    private const BOT_PATTERN = '/bot|crawl|spider|slurp|bingpreview|facebookexternalhit|whatsapp|telegram|skypeuripreview|curl|wget|python|java\/|httpclient|headless|monitor|pingdom|uptime|lighthouse|gtmetrix/i';

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        try {
            if ($this->shouldTrack($request, $response)) {
                $this->record($request);
            }
        } catch (\Throwable $e) {
            // Le suivi statistique ne doit jamais faire echouer une page
            // (ex. table absente tant que la migration n'a pas ete lancee).
        }

        return $response;
    }

    private function shouldTrack(Request $request, Response $response): bool
    {
        if (!$request->isMethod('GET') || $request->ajax()) {
            return false;
        }

        if ($response->getStatusCode() !== 200) {
            return false;
        }

        if ($request->is('admin-sofifran*') || $request->is('up') || $request->is('build/*') || $request->is('storage/*') || $request->is('lang/*')) {
            return false;
        }

        $ua = (string) $request->userAgent();
        if ($ua === '' || preg_match(self::BOT_PATTERN, $ua)) {
            return false;
        }

        if (auth('admin')->check()) {
            return false;
        }

        return true;
    }

    private function record(Request $request): void
    {
        $ua = (string) $request->userAgent();

        // Source externe uniquement : la navigation interne n'est pas une "source".
        $refererHost = null;
        $refererUrl  = null;
        $referer     = (string) $request->headers->get('referer');
        if ($referer !== '') {
            $host = parse_url($referer, PHP_URL_HOST);
            if ($host && strcasecmp($host, $request->getHost()) !== 0) {
                $refererHost = strtolower(preg_replace('/^www\./i', '', $host));
                $refererUrl  = mb_substr($referer, 0, 500);
            }
        }

        Visite::create([
            'visitor_hash' => hash('sha256', $request->ip() . '|' . $ua),
            'page'         => mb_substr('/' . ltrim($request->path(), '/'), 0, 191),
            'referer_host' => $refererHost,
            'referer_url'  => $refererUrl,
            'device'       => $this->device($ua),
            'browser'      => $this->browser($ua),
            'platform'     => $this->platform($ua),
            'locale'       => mb_substr((string) session('locale', config('app.locale')), 0, 5),
            'created_at'   => now(),
        ]);
    }

    private function device(string $ua): string
    {
        if (preg_match('/tablet|ipad/i', $ua)) {
            return 'tablette';
        }
        if (preg_match('/mobile|iphone|android/i', $ua)) {
            return 'mobile';
        }
        return 'ordinateur';
    }

    private function browser(string $ua): string
    {
        return match (true) {
            str_contains($ua, 'Edg/')                                  => 'Edge',
            str_contains($ua, 'OPR/') || str_contains($ua, 'Opera')    => 'Opera',
            str_contains($ua, 'SamsungBrowser')                        => 'Samsung Internet',
            str_contains($ua, 'Chrome/')                               => 'Chrome',
            str_contains($ua, 'Safari/') && str_contains($ua, 'Version/') => 'Safari',
            str_contains($ua, 'Firefox/')                              => 'Firefox',
            default                                                    => 'Autre',
        };
    }

    private function platform(string $ua): string
    {
        return match (true) {
            str_contains($ua, 'Windows')                                => 'Windows',
            str_contains($ua, 'Android')                                => 'Android',
            str_contains($ua, 'iPhone') || str_contains($ua, 'iPad')    => 'iOS',
            str_contains($ua, 'Mac OS')                                 => 'macOS',
            str_contains($ua, 'Linux')                                  => 'Linux',
            default                                                     => 'Autre',
        };
    }
}
