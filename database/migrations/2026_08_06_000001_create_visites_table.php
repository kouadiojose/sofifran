<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Suivi interne des visites du site public : chaque page vue (hors
     * admin, robots et administrateurs connectes) est enregistree ici et
     * restituee dans Admin > Statistiques de visites.
     */
    public function up(): void
    {
        if (Schema::hasTable('visites')) {
            return;
        }

        Schema::create('visites', function (Blueprint $table) {
            $table->id();
            $table->string('visitor_hash', 64)->index();   // empreinte anonyme ip+navigateur
            $table->string('page', 191)->index();          // chemin visite (/, /projets...)
            $table->string('referer_host', 191)->nullable()->index(); // source externe (google.com...)
            $table->text('referer_url')->nullable();
            $table->string('device', 20)->nullable();      // ordinateur / mobile / tablette
            $table->string('browser', 30)->nullable();
            $table->string('platform', 30)->nullable();
            $table->string('locale', 5)->nullable();       // fr / en
            $table->timestamp('created_at')->useCurrent()->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visites');
    }
};
