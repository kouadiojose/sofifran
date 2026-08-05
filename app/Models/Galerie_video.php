<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class Galerie_video extends Model

{

    protected $fillable = [

    	'image', 'title_fr','title_en', 'description_fr', 'description_en', 'link_video'

    ];

}

