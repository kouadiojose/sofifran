<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class Atelier extends Model

{

    protected $fillable = [

    	'title_fr', 'title_en', 'description_fr', 'description_en', 'image', 'start', 'end', 'hour_start', 'hour_end', 'slug', 'color'

    ];

}

