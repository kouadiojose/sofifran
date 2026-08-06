<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    /**
     * Types de documents geres par l'admin. Chaque type alimente une page
     * publique dediee du site.
     */
    public const TYPES = [
        'rapport-annuel' => 'Rapport annuel',
        'rapport-projet' => 'Rapport de projet',
        'communique'     => 'Communiqué',
        'article-presse' => 'Article de presse',
        'infolettre'     => 'Infolettre (PDF)',
        'emploi'         => "Offre d'emploi",
        'autre'          => 'Autre publication',
    ];

    protected $fillable = [
        'titre_fr', 'titre_en', 'description_fr', 'description_en', 'doc', 'date_pub', 'type', 'cover',
    ];

    /**
     * URL de l'image de couverture, ou null (la vue affiche alors une
     * vignette stylisee).
     */
    public function getCoverUrlAttribute(): ?string
    {
        return $this->cover ? '/frontend/assets/images/publication/covers/' . $this->cover : null;
    }

    /**
     * Poids lisible du document ("2,4 Mo"), null si le fichier est introuvable.
     */
    public function tailleFichier(): ?string
    {
        $chemin = public_path(ltrim($this->doc_url, '/'));

        if (!is_file($chemin)) {
            return null;
        }

        $octets = filesize($chemin);

        if ($octets >= 1048576) {
            return number_format($octets / 1048576, 1, ',', ' ') . ' Mo';
        }

        return max(1, (int) round($octets / 1024)) . ' Ko';
    }

    /**
     * Date de publication lisible (la colonne est un varchar historique).
     */
    public function datePub(): ?string
    {
        $ts = strtotime((string) $this->date_pub);

        return $ts ? date('d/m/Y', $ts) : null;
    }

    /**
     * URL publique du document. Les anciens enregistrements stockent un simple
     * nom de fichier (dossier images/publication), les nouveaux un chemin complet.
     */
    public function getDocUrlAttribute(): string
    {
        if (str_starts_with((string) $this->doc, '/')) {
            return $this->doc;
        }

        return '/frontend/assets/images/publication/' . $this->doc;
    }

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? ucfirst((string) $this->type);
    }
}
