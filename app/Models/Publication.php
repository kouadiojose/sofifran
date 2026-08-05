<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
    	'titre_fr', 'titre_en', 'description_fr', 'description_en', 'doc', 'date_pub'
    ];
}
