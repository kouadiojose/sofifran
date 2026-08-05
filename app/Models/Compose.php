<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Compose extends Model
{
    protected $fillable = ['email', 'subject', 'contenu', 'file'];
}
