<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Baniere extends Model
{
    /**
     * Catalogue des pages du site pouvant recevoir une banniere.
     * La cle est stockee dans la colonne "page" ; le libelle sert a l'admin.
     */
    public const PAGE_LABELS = [
        'temoignage'    => 'Témoignages',
        'activites'     => 'Activités',
        'calendrier'    => 'Calendrier',
        'equipe'        => 'Notre équipe',
        'about'         => 'Qui sommes-nous',
        'contact'       => 'Contact',
        'partenaire'    => 'Nos partenaires',
        'atelier'       => 'Évènements / Ateliers',
        'projets'       => 'Projets',
        'presse'        => 'Presse',
        'publication'   => 'Publications',
        'galerie-photo' => 'Galerie photos',
        'galerie-video' => 'Galerie vidéos',
        'blog'          => 'Blogue - Actualités',
        'engagez'       => 'Engagez-vous',
    ];

    /**
     * Correspondance historique page -> id, utilisee comme repli tant que la
     * migration de normalisation de la colonne "page" n'a pas ete executee.
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

    /**
     * Banniere d'une page du site : recherche par cle de page (dynamique),
     * avec repli sur l'ancien id fixe pour les bases non migrees.
     */
    public static function forPage(string $page): ?self
    {
        $baniere = self::where('page', $page)->orderBy('id')->first();

        if ($baniere) {
            return $baniere;
        }

        $id = self::PAGES[$page] ?? null;

        return $id ? self::find($id) : null;
    }

    public function getPageLabelAttribute(): string
    {
        return self::PAGE_LABELS[$this->page] ?? ($this->page ?: 'Non assignée');
    }
}
