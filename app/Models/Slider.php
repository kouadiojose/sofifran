<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class Slider extends Model

{

    protected $fillable = [



    	'title_fr',

    	'description_fr',

    	'title_en',

    	'description_en',

    	'image',

    	'btn_name_fr',

    	'btn_name_en',

    	'btn_color',

    	'btn_link',

    	'orders',



    ];

}

