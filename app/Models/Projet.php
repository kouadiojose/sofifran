<?php

	namespace App\Models;
	use Illuminate\Database\Eloquent\Model;

	class Projet extends Model
	{

	  protected $fillable = ['id', 'titre_fr', 'titre_en', 'objectif', 'image', 'description_fr', 'description_en', 'slug', 'ended'];

	  

	}
