<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apropo extends Model
{
    protected $fillable = [
    	'title_fr', 'title_en', 'description_fr', 'description_en', 'nom_fr', 'nom_en', 'cle_video'
    ];
}
