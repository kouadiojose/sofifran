<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    protected $fillable = [
        'image', 'categorie_activity_slug', 'title_fr', 'title_en', 'description_fr', 'description_en', 'slug', 'cle_video', 'link_img',
    ];

    /**
     * Photos de la galerie rattachees a cette activite : chaque activite
     * fait office d'album photo (galerie_photos.galerie_id = activites.id).
     */
    public function photos()
    {
        return $this->hasMany(Galerie_photo::class, 'galerie_id');
    }
}
