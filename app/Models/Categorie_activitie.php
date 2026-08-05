<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie_activitie extends Model
{
    protected $fillable = [
        'titre_fr', 'titre_en', 'description_fr', 'description_en', 'image', 'slug',
    ];

    /**
     * Activites rattachees a cette categorie (liaison par slug,
     * heritee du schema existant).
     */
    public function activites()
    {
        return $this->hasMany(Activite::class, 'categorie_activity_slug', 'slug');
    }
}
