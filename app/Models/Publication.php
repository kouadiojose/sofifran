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
        'titre_fr', 'titre_en', 'description_fr', 'description_en', 'doc', 'date_pub', 'type',
    ];

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
