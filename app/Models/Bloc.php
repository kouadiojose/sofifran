<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bloc extends Model
{
    protected $fillable = [
    	'title_fr', 'title_en', 'description_fr', 'description_en', 'btn_link', 'btn_name_fr', 'btn_name_en', 'icon', 'color'
    ];
}
