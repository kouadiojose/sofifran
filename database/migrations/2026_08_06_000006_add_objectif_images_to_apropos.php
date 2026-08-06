<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Images du carrousel de la section "Nos Objectifs" de la page
     * "Qui sommes-nous ?". Avant, elles etaient fixees dans le CSS du theme
     * avec des URL distantes vers l'ancien site.
     */
    public function up(): void
    {
        if (!Schema::hasTable('apropos')) {
            return;
        }

        Schema::table('apropos', function (Blueprint $table) {
            foreach (['image_objectif1', 'image_objectif2', 'image_objectif3'] as $col) {
                if (!Schema::hasColumn('apropos', $col)) {
                    $table->text($col)->nullable();
                }
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('apropos')) {
            return;
        }

        Schema::table('apropos', function (Blueprint $table) {
            foreach (['image_objectif1', 'image_objectif2', 'image_objectif3'] as $col) {
                if (Schema::hasColumn('apropos', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
