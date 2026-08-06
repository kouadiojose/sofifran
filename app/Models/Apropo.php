<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apropo extends Model
{
    protected $fillable = [
        'title_fr', 'title_en', 'description_fr', 'description_en', 'nom_fr', 'nom_en', 'cle_video',
        'experience_fr', 'experience_en',
        'intro_fr', 'intro_en',
        'historique_fr', 'historique_en',
        'mission_fr', 'mission_en',
        'mandat_fr', 'mandat_en',
        'objectifs_fr', 'objectifs_en',
        'image_intro', 'image_mission', 'image_mandat',
    ];

    /**
     * URL d'une image de section, avec repli sur l'image historique du theme.
     */
    public function imageUrl(string $champ, string $fallback): string
    {
        $image = $this->{$champ};

        return $image
            ? '/frontend/assets/images/resource/' . $image
            : $fallback;
    }

    /**
     * Valeur d'une section dans la langue courante, avec repli sur le
     * francais si la traduction manque.
     */
    public function trad(string $champ): string
    {
        $locale = app()->getLocale() == 'fr' ? 'fr' : 'en';

        return (string) ($this->{$champ . '_' . $locale} ?: $this->{$champ . '_fr'});
    }
}
