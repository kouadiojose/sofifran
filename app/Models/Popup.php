<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected $fillable = [
    	'titre', 'image', 'contenu', 'start', 'end', 'link'
    ];

    /**
     * Statut d'affichage calcule a partir des dates : actif / programme / expire.
     */
    public function getStatutAttribute(): string
    {
        $today = now()->format('Y-m-d');

        if ($this->start > $today) {
            return 'programme';
        }
        if ($this->end < $today) {
            return 'expire';
        }
        return 'actif';
    }
}
