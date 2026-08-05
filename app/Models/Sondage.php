<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sondage extends Model
{
    protected $fillable = [
    	'description_en', 'description_fr', 'btn_name_fr', 'btn_name_en', 'title_fr', 'title_en', 'link'
    ];
}
