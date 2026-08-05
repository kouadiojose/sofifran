<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class Activite extends Model

{

    protected $fillable = [

    	'image','categorie_activity_slug','title_fr','title_en','description_fr','description_en','slug', 'cle_video', 'link_img' 

    ];

}

