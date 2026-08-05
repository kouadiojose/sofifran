<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie_activitie extends Model
{
    protected $fillable = [
    	'titre_fr', 'titre_en', 'image', 'slug',
    ];
}
