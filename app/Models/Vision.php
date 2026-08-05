<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vision extends Model
{
    protected $fillable = [
    	'titre_en', 'titre_fr', 'contenu_en', 'contenu_fr'
    ];
}
