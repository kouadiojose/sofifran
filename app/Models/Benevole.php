<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benevole extends Model
{
    protected $fillable = [
    	'name', 'email', 'telephone', 'province', 'ville', 'message'
    ];
}
