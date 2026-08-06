<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Images de la page "Qui sommes-nous ?" administrables (intro, mission,
     * mandat). Null = image historique du theme conservee.
     */
    public function up(): void
    {
        if (!Schema::hasTable('apropos')) {
            return;
        }

        Schema::table('apropos', function (Blueprint $table) {
            foreach (['image_intro', 'image_mission', 'image_mandat'] as $col) {
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
            foreach (['image_intro', 'image_mission', 'image_mandat'] as $col) {
                if (Schema::hasColumn('apropos', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
