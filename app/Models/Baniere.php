<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baniere extends Model
{
    /**
     * Correspondance page -> id de banniere en base.
     * Centralise les identifiants qui etaient disperses en "magic numbers"
     * dans les controleurs. Les ids correspondent aux banieres existantes
     * de la table (gerees dans Admin > Rubriques > Banieres).
     */
    public const PAGES = [
        'temoignage'    => 1,
        'activites'     => 2,
        'calendrier'    => 3,
        'equipe'        => 4,
        'about'         => 5,
        'contact'       => 6,
        'partenaire'    => 7,
        'atelier'       => 9,
        'projets'       => 10,
        'presse'        => 12,
        'publication'   => 13,
        'galerie-photo' => 14,
        'galerie-video' => 15,
        'blog'          => 16,
        'engagez'       => 17,
    ];

    protected $fillable = [
        'title_fr',
        'title_en',
        'image',
        'page',
    ];

    public static function forPage(string $page): ?self
    {
        $id = self::PAGES[$page] ?? null;

        return $id ? self::find($id) : null;
    }
}
