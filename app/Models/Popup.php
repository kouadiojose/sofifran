<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $fillable = [
    	'titre', 'image', 'contenu', 'start', 'end'
    ];
}
