<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Atelier extends Model
{
    protected $fillable = [
        'title_fr', 'title_en', 'description_fr', 'description_en', 'image', 'start', 'end', 'hour_start', 'hour_end', 'slug', 'color',
    ];

    /**
     * Evenements non termines : la fin (date + heure, 23h59 si l'heure
     * manque) est encore a venir. Couvre aussi les evenements en cours
     * sur plusieurs jours.
     */
    public function scopeAVenir($query)
    {
        $now = now()->format('Y-m-d H:i:s');

        if (DB::connection()->getDriverName() === 'sqlite') {
            return $query->whereRaw("datetime(`end` || ' ' || COALESCE(`hour_end`, '23:59:59')) >= ?", [$now]);
        }

        return $query->whereRaw("TIMESTAMP(`end`, COALESCE(`hour_end`, '23:59:59')) >= ?", [$now]);
    }

    /**
     * Tri chronologique (prochain evenement en premier).
     */
    public function scopeChrono($query)
    {
        if (DB::connection()->getDriverName() === 'sqlite') {
            return $query->orderByRaw("datetime(`start` || ' ' || COALESCE(`hour_start`, '00:00:00')) ASC");
        }

        return $query->orderByRaw("TIMESTAMP(`start`, COALESCE(`hour_start`, '00:00:00')) ASC");
    }

    public function estAVenir(): bool
    {
        $fin = ($this->end ?: $this->start) . ' ' . ($this->hour_end ?: '23:59:59');

        return strtotime($fin) >= time();
    }

    /**
     * Periode lisible dans la langue courante :
     * "Le 08/05/2026 de 15h00 à 18h00" ou "Du 08/05/2026 au 10/05/2026".
     */
    public function periode(): string
    {
        if (!$this->start) {
            return '';
        }

        $fr    = app()->getLocale() == 'fr';
        $debut = date('d/m/Y', strtotime($this->start));
        $fin   = $this->end ? date('d/m/Y', strtotime($this->end)) : $debut;
        $hs    = $this->hour_start ? str_replace(':', 'h', substr($this->hour_start, 0, 5)) : null;
        $he    = $this->hour_end ? str_replace(':', 'h', substr($this->hour_end, 0, 5)) : null;

        if ($debut === $fin) {
            $txt = ($fr ? 'Le ' : 'On ') . $debut;
            if ($hs && $he) {
                $txt .= $fr ? " de {$hs} à {$he}" : " from {$hs} to {$he}";
            } elseif ($hs) {
                $txt .= $fr ? " à {$hs}" : " at {$hs}";
            }
            return $txt;
        }

        $txt = ($fr ? 'Du ' : 'From ') . $debut;
        if ($hs) {
            $txt .= $fr ? " à {$hs}" : " at {$hs}";
        }
        $txt .= ($fr ? ' au ' : ' to ') . $fin;
        if ($he) {
            $txt .= $fr ? " à {$he}" : " at {$he}";
        }

        return $txt;
    }
}
