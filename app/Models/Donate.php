<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donate extends Model
{
    protected $fillable = [
    	'user_id', 'projet_id','charge_id', 'gains'
    ];
}
