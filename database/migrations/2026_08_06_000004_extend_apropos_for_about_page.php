<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Rend la page "Qui sommes-nous ?" administrable : la table apropos
     * (editee dans Admin > Rubriques > A propos) recoit une colonne par
     * section de la page, et les textes actuellement codes en dur dans la
     * vue y sont repris tels quels — rien ne change visuellement, tout
     * devient modifiable.
     */
    public function up(): void
    {
        if (!Schema::hasTable('apropos')) {
            Schema::create('apropos', function (Blueprint $table) {
                $table->id();
                $table->text('nom_fr')->nullable();
                $table->text('nom_en')->nullable();
                $table->text('title_fr')->nullable();
                $table->text('title_en')->nullable();
                $table->longText('description_fr')->nullable();
                $table->longText('description_en')->nullable();
                $table->string('cle_video', 100)->nullable();
                $table->timestamps();
            });
        }

        Schema::table('apropos', function (Blueprint $table) {
            foreach ([
                'experience_fr', 'experience_en',
                'intro_fr', 'intro_en',
                'historique_fr', 'historique_en',
                'mission_fr', 'mission_en',
                'mandat_fr', 'mandat_en',
                'objectifs_fr', 'objectifs_en',
            ] as $col) {
                if (!Schema::hasColumn('apropos', $col)) {
                    $table->longText($col)->nullable();
                }
            }
        });

        // Reprise des textes actuels de la page (seulement si vides).
        $textes = $this->textesActuels();
        $row    = DB::table('apropos')->first();

        if (!$row) {
            DB::table('apropos')->insert(array_merge($textes, [
                'nom_fr'     => 'À propos de nous',
                'nom_en'     => 'About us',
                'created_at' => now(),
                'updated_at' => now(),
            ]));
            return;
        }

        $updates = [];
        foreach ($textes as $col => $value) {
            if (empty($row->{$col})) {
                $updates[$col] = $value;
            }
        }
        if ($updates) {
            DB::table('apropos')->where('id', $row->id)->update($updates);
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('apropos')) {
            return;
        }

        Schema::table('apropos', function (Blueprint $table) {
            foreach ([
                'experience_fr', 'experience_en',
                'intro_fr', 'intro_en',
                'historique_fr', 'historique_en',
                'mission_fr', 'mission_en',
                'mandat_fr', 'mandat_en',
                'objectifs_fr', 'objectifs_en',
            ] as $col) {
                if (Schema::hasColumn('apropos', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }

    private function textesActuels(): array
    {
        return [
            'experience_fr' => "Plus de 15 ans d'expérience",
            'experience_en' => 'Over 15 years experience',

            'intro_fr' => <<<'TXT'
SOFIFRAN est un organisme communautaire sans but lucratif, créé en 2007 par des femmes immigrantes francophones – vivant dans la région du Niagara et originaires de diverses parties du monde. L’organisme a pour but d’accompagner les femmes et leurs familles dans leur processus d’intégration au Niagara en offrant des services dans le domaine social, économique, éducatif et culturel. Avec l’expérience, le recul et la pratique de terrain, les membres de SOFIFRAN comprennent l’importance, la nécessité et l’impact de leurs actions sur l’immigration locale. Elles ciblent toujours plus de soutien de la part des communautés, des partenaires et des institutions.
TXT,
            'intro_en' => <<<'TXT'
SOFIFRAN is a non-profit community organization created in 2007 by French-speaking immigrant women - living in the Niagara region and originating from various parts of the world. The organization's goal is to support women and their families in their integration process in Niagara by offering social, economic, educational and cultural services. With experience, hindsight and hands-on practice, SOFIFRAN members understand the importance, necessity and impact of their actions on local immigration. They aim for ever-greater support from communities, partners and institutions.
TXT,

            'historique_fr' => <<<'TXT'
En mars 2006, sept femmes immigrantes francophones, originaires de diverses régions et religions, résidant dans la région du Niagara, se sont réunies pour identifier leurs besoins prioritaires. À l’issue de plusieurs réunions, elles ont constaté un besoin urgent de créer une plateforme destinée à les représenter, les soutenir et organiser des activités sociales, culturelles, économiques et éducatives qui soient culturellement adaptées à leur communauté. C'est ainsi que Sofifran (Solidarité des Femmes Immigrantes Francophones du Niagara) a vu le jour le 11 décembre 2007. Sa mission initiale visait à promouvoir le développement social, économique, éducatif et culturel des femmes immigrantes francophones vivant dans la région du Niagara.

Le 5 décembre 2010, la mission et le mandat de Sofifran ont été élargis pour inclure les familles d’immigrantes francophones au Niagara, afin de mieux répondre aux besoins de cette population.

Lors de son assemblée générale annuelle de 2018, les membres ont décidé de modifier le terme « immigrant » en « interconnecté », un terme qui reflète mieux l’extension des collaborations de Sofifran, tant au niveau du Niagara qu’à l’échelle de l’Ontario. Dès lors, SOFIFRAN signifie Solidarité des Femmes et Familles Interconnectées Francophones du Niagara. Grâce à l'engagement de ses bénévoles, Sofifran conçoit, développe, organise et réalise des projets qui répondent aux besoins spécifiques et actuels de la communauté des immigrants francophones du Niagara.
TXT,
            'historique_en' => <<<'TXT'
In March 2006, seven French-speaking immigrant women from various regions and religions living in the Niagara region came together to identify their priority needs. After several meetings, they realized that there was an urgent need to create a platform to represent and support them, and to organize social, cultural, economic and educational activities that were culturally adapted to their community. Sofifran (Solidarité des Femmes Immigrantes Francophones du Niagara) was born on December 11, 2007. Its initial mission was to promote the social, economic, educational and cultural development of French-speaking immigrant women living in the Niagara region.

On December 5, 2010, Sofifran's mission and mandate were expanded to include Francophone immigrant families in Niagara, in order to better meet the needs of this population.

At its 2018 Annual General Meeting, members decided to change the term “immigrant” to “interconnected”, a term that better reflects the extension of Sofifran's collaborations, both Niagara-wide and Ontario-wide. From then on, SOFIFRAN stands for Solidarité des Femmes et Familles Interconnectées Francophones du Niagara. Thanks to the commitment of its volunteers, Sofifran designs, develops, organizes and implements projects that meet the specific and current needs of Niagara's French-speaking immigrant community.
TXT,

            'mission_fr' => <<<'TXT'
SOFIFRAN est une plateforme francophone qui vise la promotion et la participation des immigrants dans les secteurs économique et social, tout en favorisant leur épanouissement sur le plan artistique et culturel pour une meilleure intégration au Canada.
TXT,
            'mission_en' => <<<'TXT'
Sofifran is a French-speaking platform that targets the promotion and participation of immigrants in the economic and social sectors, while promoting their artistic and cultural development for better integration in Canada.
TXT,

            'mandat_fr' => <<<'TXT'
Rassembler, valoriser, promouvoir, représenter et utiliser rationnellement les compétences acquises des femmes immigrantes francophones de Niagara /Hamilton et leur servir de support dans le domaine de développement social, économique éducatif et culturel, et ce en vue de se prendre et/ou de prendre leurs familles en charge.
TXT,
            'mandat_en' => <<<'TXT'
Gather, enhance, promote, rationally represent and use the skills acquired by French-speaking immigrant women from Niagara /Hamilton and serve them as a support in the field of social, educational and cultural development, and this in order to take and /or take their families in charge.
TXT,

            'objectifs_fr' => <<<'TXT'
Briser l'isolement des femmes immigrantes francophones du Niagara et de leurs familles à travers des activités sociales et culturelles;
Lutter contre la pauvreté et le chômage chez les immigrants francophones en les aidant à développer les compétences nécessaires à l'employabilité;
Augmenter leurs capacités entrepreneuriales;
Aider les femmes immigrantes francophones à acquérir l'autonomie organisationnelle pour bien prendre soin de leurs familles;
Promouvoir les œuvres artistiques et artisanales des femmes immigrées francophones et celles des membres de leur famille;
Organiser les activités visant à rassembler la communauté francophone plurielle, d'une part, et la communauté hôte en général, d'autre part.
TXT,
            'objectifs_en' => <<<'TXT'
Break the isolation of Francophone immigrant women from Niagara and their families through social and cultural activities;
Fight against poverty and unemployment among Francophone immigrant women by helping them develop the skills required for employability;
Increase their entrepreneurial capacities;
Help French-speaking immigrant women acquire organizational autonomy to take good care of their families;
Promote the artistic and craft works of Francophone immigrant women and those of members of their families;
Organize activities aimed at bringing together the plural Francophone community, on the one hand, and the host community in general, on the other.
TXT,
        ];
    }
};
