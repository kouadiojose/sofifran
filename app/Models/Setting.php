<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [

    	'phone1',
    	'phone2',
    	'adresse1',
        'adresse2',
    	'email',
    	'logo',
    	'facebook',
    	'instagram',
    	'twitter',
    	'youtube',
    	'linkedln',
    	'theme',

    ];
}
