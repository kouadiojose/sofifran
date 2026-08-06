<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Image de couverture optionnelle des publications : affichee sur les
     * cartes de documents du site (rapports, communiques, infolettres...).
     * Sans couverture, une vignette stylisee aux couleurs du site est generee.
     */
    public function up(): void
    {
        if (!Schema::hasTable('publications') || Schema::hasColumn('publications', 'cover')) {
            return;
        }

        Schema::table('publications', function (Blueprint $table) {
            $table->text('cover')->nullable();
        });
    }

    public function down(): void
    {
        if (Schema::hasTable('publications') && Schema::hasColumn('publications', 'cover')) {
            Schema::table('publications', function (Blueprint $table) {
                $table->dropColumn('cover');
            });
        }
    }
};
