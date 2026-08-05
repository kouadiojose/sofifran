<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $fillable = [
    	'name', 'email', 'ville', 'age'
    ];
}
