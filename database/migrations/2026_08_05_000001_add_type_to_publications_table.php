<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ajoute une colonne "type" aux publications afin que chaque page de
     * documents du site (rapports annuels, rapports projets, communiqués,
     * articles de presse, infolettres, offres d'emploi) soit gérée depuis
     * l'admin au lieu d'être codée en dur dans les vues.
     */
    public function up(): void
    {
        if (!Schema::hasTable('publications')) {
            // Base de dev sans le schema de production : la table complete
            // n'existe pas, on la cree avec toutes ses colonnes.
            Schema::create('publications', function (Blueprint $table) {
                $table->id();
                $table->text('titre_fr')->nullable();
                $table->text('titre_en')->nullable();
                $table->longText('description_fr')->nullable();
                $table->longText('description_en')->nullable();
                $table->text('doc')->nullable();
                $table->string('date_pub', 100);
                $table->string('type', 50)->default('autre')->index();
                $table->timestamps();
            });
            return;
        }

        if (!Schema::hasColumn('publications', 'type')) {
            Schema::table('publications', function (Blueprint $table) {
                $table->string('type', 50)->default('autre')->index();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('publications', 'type')) {
            Schema::table('publications', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }
};
