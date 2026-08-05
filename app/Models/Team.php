<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class Team extends Model

{

    protected $fillable = [

    	'name', 'post_fr', 'post_en', 'image', 'facebook', 'instagram','type_membre','ordre'

    ];

}

