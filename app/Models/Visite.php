<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    public $timestamps = false; // seul created_at est utilise (rempli en base)

    protected $fillable = [
        'visitor_hash', 'page', 'referer_host', 'referer_url',
        'device', 'browser', 'platform', 'locale', 'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];
}
