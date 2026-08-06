<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Lien "contenu complet" du popup d'annonce, configurable dans l'admin
     * (avant : URL codee en dur dans la page d'accueil).
     */
    public function up(): void
    {
        if (!Schema::hasTable('popups')) {
            Schema::create('popups', function (Blueprint $table) {
                $table->id();
                $table->text('titre');
                $table->text('image')->nullable();
                $table->longText('contenu');
                $table->string('start', 50);
                $table->string('end', 100);
                $table->text('link')->nullable();
                $table->timestamps();
            });
            return;
        }

        if (!Schema::hasColumn('popups', 'link')) {
            Schema::table('popups', function (Blueprint $table) {
                $table->text('link')->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('popups', 'link')) {
            Schema::table('popups', function (Blueprint $table) {
                $table->dropColumn('link');
            });
        }
    }
};
