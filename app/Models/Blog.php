<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
    	'title_fr',
    	'title_en',
    	'description_fr',
    	'description_en',
    	'slug',
    	'image',
    ];
}
