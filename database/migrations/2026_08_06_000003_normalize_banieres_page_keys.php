<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Normalise la colonne "page" des banieres avec des cles stables
     * (temoignage, projets, galerie-photo...). Auparavant la colonne
     * contenait des libelles libres ('PROJETS', 'Activité'...) et le site
     * retrouvait les banieres par id code en dur : la gestion n'etait pas
     * reellement dynamique.
     *
     * La correspondance id -> cle reprend exactement les ids historiques
     * utilises par les controleurs.
     */
    private array $mapping = [
        1  => 'temoignage',
        2  => 'activites',
        3  => 'calendrier',
        4  => 'equipe',
        5  => 'about',
        6  => 'contact',
        7  => 'partenaire',
        9  => 'atelier',
        10 => 'projets',
        12 => 'presse',
        13 => 'publication',
        14 => 'galerie-photo',
        15 => 'galerie-video',
        16 => 'blog',
        17 => 'engagez',
    ];

    public function up(): void
    {
        if (!Schema::hasTable('banieres')) {
            return;
        }

        foreach ($this->mapping as $id => $key) {
            DB::table('banieres')->where('id', $id)->update(['page' => $key]);
        }
    }

    public function down(): void
    {
        // Les anciens libelles etaient libres : pas de retour arriere utile.
    }
};
