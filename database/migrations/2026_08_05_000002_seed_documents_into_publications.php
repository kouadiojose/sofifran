<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Reprend dans la table publications les documents PDF qui etaient
     * codes en dur dans les vues (rapport_annuel, rapport_projet,
     * communique, article_presse, infolettre, carrers), pour que ces pages
     * deviennent entierement administrables sans perdre le contenu actuel.
     *
     * Idempotent : un document deja present (meme chemin "doc") n'est pas reinsere.
     */
    private array $documents = [
        // Rapports annuels
        ['type' => 'rapport-annuel', 'titre' => "Rapports annuels de PASSEP'ART - P-15670", 'doc' => '/frontend/assets/docs/rapports/Rapport_FrancoSphere_P-15670_PassepART_SOFIFRAN.pdf', 'date' => '2023-06-01'],
        ['type' => 'rapport-annuel', 'titre' => 'Rapports annuels de Vice Versa D-54165', 'doc' => '/frontend/assets/docs/rapports/Rapport_Les_VOIx_du_futur_ViceVersa_SOFIFRAN.pdf', 'date' => '2023-06-01'],
        ['type' => 'rapport-annuel', 'titre' => '1ère ronde - Subvention VICE VERSA', 'doc' => '/frontend/assets/docs/rapports/Rapport_ApprenTISSAGE_ViceVersa_SOFIFRAN.pdf', 'date' => '2023-06-01'],
        ['type' => 'rapport-annuel', 'titre' => "Passep'ART – SOFIFRAN – La Mosaïque", 'doc' => '/frontend/assets/docs/rapports/Rapport_FrancoSphere_PassepART_LaMosaique_SOFIFRAN.pdf', 'date' => '2023-06-01'],
        ['type' => 'rapport-annuel', 'titre' => "Passep'ART – SOFIFRAN – Gabrielle Roy", 'doc' => '/frontend/assets/docs/rapports/Rapport_FrancoSphere_PassepART_GabrielleRoy_SOFIFRAN.pdf', 'date' => '2023-06-01'],
        ['type' => 'rapport-annuel', 'titre' => "Passep'ART – SOFIFRAN – P-16482", 'doc' => '/frontend/assets/docs/rapports/Rapport_FrancoSphere_PassepART_SOFIFRAN.pdf', 'date' => '2023-06-01'],
        ['type' => 'rapport-annuel', 'titre' => 'VICE VERSA – SOFIFRAN – D 54165', 'doc' => '/frontend/assets/docs/rapports/Rapport_Voix_du_Futur_Vice_Versa_SOFIFRAN.pdf', 'date' => '2023-06-01'],
        ['type' => 'rapport-annuel', 'titre' => 'Rapport annuel 2024-2025', 'doc' => '/frontend/assets/docs/rapports/RAPPORT-ANNUEL-2024-2025 (9).pdf', 'date' => '2025-06-01'],
        ['type' => 'rapport-annuel', 'titre' => 'Rapport annuel 2022-2023', 'doc' => '/frontend/assets/docs/rapports/RAPPORT ANNUEL 2022-2023.pdf', 'date' => '2023-06-01'],
        ['type' => 'rapport-annuel', 'titre' => 'Rapport annuel 2021-2022', 'doc' => '/frontend/assets/docs/rapports/RAPPORT 2021-2022.pdf', 'date' => '2022-06-01'],
        ['type' => 'rapport-annuel', 'titre' => 'Rapport annuel 2020-2021', 'doc' => '/frontend/assets/docs/rapports/RAPPORT ANNUEL 2020-2021.pdf', 'date' => '2021-06-01'],

        // Rapports projets
        ['type' => 'rapport-projet', 'titre' => 'Projet de production de chaîne communautaire - Canal Sofifran', 'doc' => '/frontend/assets/docs/rapport_projets/Projet de production de chaine communautaire_Canal Sofifran.pdf', 'date' => '2023-01-01'],
        ['type' => 'rapport-projet', 'titre' => 'Rapport sur la formation des bénévoles - Canal Sofifran', 'doc' => '/frontend/assets/docs/rapport_projets/Rapport sur la Formation des Bénévoles_Canal Sofifran.pdf', 'date' => '2023-01-01'],

        // Communiqués
        ['type' => 'communique', 'titre' => 'Communiqué de presse', 'doc' => '/frontend/assets/docs/communiques/COMMUNIQUE-PRESSE.pdf', 'date' => '2022-06-01'],
        ['type' => 'communique', 'titre' => 'Communiqué de Juillet 2023', 'doc' => '/frontend/assets/docs/communiques/COMMUNIQUE - Juillet 2023.pdf', 'date' => '2023-07-01'],
        ['type' => 'communique', 'titre' => 'Communiqué de presse - WAGE', 'doc' => '/frontend/assets/docs/communiques/WAGE - COMMUNIQUÉ DE PRESSE.pdf', 'date' => '2023-01-01'],

        // Articles de presse
        ['type' => 'article-presse', 'titre' => 'Le Régional du 2 Juin 2026', 'doc' => '/frontend/assets/docs/articles/Le Regional du 2 Juin 2026.pdf', 'date' => '2026-06-02'],
        ['type' => 'article-presse', 'titre' => 'ONFR du 26 novembre', 'doc' => '/frontend/assets/docs/articles/ONFR du 26 novembre.pdf', 'date' => '2025-11-26'],
        ['type' => 'article-presse', 'titre' => 'Le Régional du 24 Octobre 2025', 'doc' => '/frontend/assets/docs/articles/Le Régional du 24 Octobre 2025.pdf', 'date' => '2025-10-24'],
        ['type' => 'article-presse', 'titre' => 'SOFIFRAN repense ses services pour mieux répondre aux besoins de la communauté', 'doc' => '/frontend/assets/docs/articles/SOFIFRAN repense ses services pour mieux répondre  aux besoin de la communauté.pdf', 'date' => '2025-06-05'],
        ['type' => 'article-presse', 'titre' => 'SOFIFRAN initie les nouveaux arrivants au vivre-ensemble canadien', 'doc' => '/frontend/assets/docs/articles/SOFIFRAN initie les nouveaux arrivants au vivre-ensemble canadien.pdf', 'date' => '2025-01-24'],
        ['type' => 'article-presse', 'titre' => 'SOFIFRAN propose un vibrant hommage à la francophonie et à la diversité', 'doc' => '/frontend/assets/docs/articles/SOFIFRAN propose un vibrant hommage à la francophonie et à la diversité.pdf', 'date' => '2025-01-02'],
        ['type' => 'article-presse', 'titre' => 'Le Régional du 5 Juin 2025', 'doc' => '/frontend/assets/docs/articles/Le Regional 05 Juin 2025.pdf', 'date' => '2025-06-05'],
        ['type' => 'article-presse', 'titre' => 'Le Régional du 2 Janvier 2025', 'doc' => '/frontend/assets/docs/articles/Le Regional 2 Janvier 2025.pdf', 'date' => '2025-01-02'],
        ['type' => 'article-presse', 'titre' => 'Le Régional du 24 Janvier 2025', 'doc' => '/frontend/assets/docs/articles/Le Regional 24 Janvier 2025.pdf', 'date' => '2025-01-24'],
        ['type' => 'article-presse', 'titre' => 'Article de presse', 'doc' => '/frontend/assets/docs/articles/-1653670411.pdf', 'date' => '2022-05-27'],
        ['type' => 'article-presse', 'titre' => 'Article de presse', 'doc' => '/frontend/assets/docs/articles/-1653670854.pdf', 'date' => '2022-05-27'],
        ['type' => 'article-presse', 'titre' => 'SOFIFRAN fait rayonner le multiculturalisme à Welland', 'doc' => '/frontend/assets/docs/articles/SOFIFRAN fait rayonnrerle multiculturalisme à Welland.pdf', 'date' => '2022-07-01'],
        ['type' => 'article-presse', 'titre' => 'Une chaîne francophone voit le jour grâce à Sofifran', 'doc' => '/frontend/assets/docs/articles/Une chaîne francophone voit le jour le grâce à Sofifran.pdf', 'date' => '2022-06-01'],

        // Infolettres (documents PDF)
        ['type' => 'infolettre', 'titre' => 'Infolettre 4ème édition - Juillet', 'doc' => '/frontend/assets/docs/infolettre/INFOLETTRE -4ÉME-JUILLET.pdf', 'date' => '2026-07-01'],
        ['type' => 'infolettre', 'titre' => 'Infolettre 3ème édition - Mars 2026', 'doc' => '/frontend/assets/docs/infolettre/INFOLETTRE-3eme-edition-Mars 2026.pdf', 'date' => '2026-03-01'],
        ['type' => 'infolettre', 'titre' => 'Infolettre Octobre 2025', 'doc' => '/frontend/assets/docs/infolettre/Infolettre Octobre 2025.pdf', 'date' => '2025-10-01'],

        // Offres d'emploi
        ['type' => 'emploi', 'titre' => "Offre d'emploi - Coordonnateur(trice) de projet", 'doc' => "/frontend/assets/docs/carrers/OFFRE D'EMPLOI - COORDONNATEUR(TRICE) DE PROJET.dox.pdf", 'date' => '2025-01-01'],
        ['type' => 'emploi', 'titre' => "Offre d'emploi - Agent.e d'accompagnement", 'doc' => "/frontend/assets/docs/carrers/OFFRE D'EMPLOI.d - AGENT.E D'ACCOMPAGNEMENT.pdf", 'date' => '2025-01-01'],
    ];

    public function up(): void
    {
        if (!Schema::hasTable('publications') || !Schema::hasColumn('publications', 'type')) {
            return;
        }

        foreach ($this->documents as $doc) {
            $exists = DB::table('publications')->where('doc', $doc['doc'])->exists();

            if (!$exists) {
                DB::table('publications')->insert([
                    'titre_fr'   => $doc['titre'],
                    'titre_en'   => $doc['titre'],
                    'doc'        => $doc['doc'],
                    'date_pub'   => $doc['date'],
                    'type'       => $doc['type'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('publications')) {
            return;
        }

        $paths = array_column($this->documents, 'doc');
        DB::table('publications')->whereIn('doc', $paths)->delete();
    }
};
