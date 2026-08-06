@extends('layouts.frontend.template') 

<?php
  if( app()->getLocale() == 'fr' ){
    $langue = 'Qui sommes-nous ?';
  }else{
    $langue = 'Who are we ?';
  }
?>

@section('title', $langue)

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area page-title-bg3" @if(!empty($baniere) && $baniere->image) style="background-image: url('/frontend/assets/images/resource/{{ $baniere->image }}');" @endif>
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-title-content">
                    <h2>{{ app()->getLocale() == 'fr' ? 'Qui sommes-nous ?' : 'Who are we ?' }}</h2>
                    <ul>
                        <li><a href="{{route('index')}}">Accueil</a></li>
                        <li>{{ app()->getLocale() == 'fr' ? 'Qui sommes-nous ?' : 'Who are we ?' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start About Area -->
<section class="about-area ptb-100 bg-f8f8f8">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5 col-md-12">
                <img style="border-radius: 15px;" src="/frontend/assets/images/resource/about_who.jpg" alt="image">
            </div>

            <div class="col-lg-7 col-md-12">
                <div class="about-content">
                    <span>{{ app()->getLocale() == 'fr' ? 'A Propos' : 'About' }}</span>
                    <h2>{{ app()->getLocale() == 'fr' ? 'Plus de 15 ans d\'expérience' : 'Over 15 years experience' }}</h2>
                    <p style="text-align: justify; font-size: 18px;">{{ app()->getLocale() == 'fr' ? 'SOFIFRAN est un organisme communautaire sans but lucratif, créé en 2007 par des femmes immigrantes francophones – vivant dans la région du Niagara et originaires de diverses parties du monde. L’organisme a pour but d’accompagner les femmes et leurs familles dans leur processus d’intégration au Niagara en offrant des services dans le domaine social, économique, éducatif et culturel. Avec l’expérience, le recul et la pratique de terrain, les membres de SOFIFRAN comprennent l’importance, la nécessité et l’impact de leurs actions sur l’immigration locale. Elles ciblent toujours plus de soutien de la part des communautés, des partenaires et des institutions.' : 'SOFIFRAN is a non-profit community organization created in 2007 by French-speaking immigrant women - living in the Niagara region and originating from various parts of the world. The organization\'s goal is to support women and their families in their integration process in Niagara by offering social, economic, educational and cultural services. With experience, hindsight and hands-on practice, SOFIFRAN members understand the importance, necessity and impact of their actions on local immigration. They aim for ever-greater support from communities, partners and institutions.' }}</p>

                </div>
            </div>
        </div>

        <div class="about-inner-area">
            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-6">
                    <div class="about-text-box">
                        <h3>{{ app()->getLocale() == 'fr' ? 'Notre Historique' : 'Our History' }}</h3>
                        <p style="text-align: justify; font-size: 18px;">
                            {{ app()->getLocale() == 'fr' ? 'En mars 2006, sept femmes immigrantes francophones, originaires de diverses régions et religions, résidant dans la région du Niagara, se sont réunies pour identifier leurs besoins prioritaires. À l’issue de plusieurs réunions, elles ont constaté un besoin urgent de créer une plateforme destinée à les représenter, les soutenir et organiser des activités sociales, culturelles, économiques et éducatives qui soient culturellement adaptées à leur communauté. C\'est ainsi que Sofifran (Solidarité des Femmes Immigrantes Francophones du Niagara) a vu le jour le 11 décembre 2007. Sa mission initiale visait à promouvoir le développement social, économique, éducatif et culturel des femmes immigrantes francophones vivant dans la région du Niagara.' : 'In March 2006, seven French-speaking immigrant women from various regions and religions living in the Niagara region came together to identify their priority needs. After several meetings, they realized that there was an urgent need to create a platform to represent and support them, and to organize social, cultural, economic and educational activities that were culturally adapted to their community. Sofifran (Solidarité des Femmes Immigrantes Francophones du Niagara) was born on December 11, 2007. Its initial mission was to promote the social, economic, educational and cultural development of French-speaking immigrant women living in the Niagara region.' }} <br><br>

                            {{ app()->getLocale() == 'fr' ? 'Le 5 décembre 2010, la mission et le mandat de Sofifran ont été élargis pour inclure les familles d’immigrantes francophones au Niagara, afin de mieux répondre aux besoins de cette population.' : 'On December 5, 2010, Sofifran\'s mission and mandate were expanded to include Francophone immigrant families in Niagara, in order to better meet the needs of this population.' }}

                            <br><br>
                            {{ app()->getLocale() == 'fr' ? 'Lors de son assemblée générale annuelle de 2018, les membres ont décidé de modifier le terme « immigrant » en « interconnecté », un terme qui reflète mieux l’extension des collaborations de Sofifran, tant au niveau du Niagara qu’à l’échelle de l’Ontario. Dès lors, SOFIFRAN signifie Solidarité des Femmes et Familles Interconnectées Francophones du Niagara. Grâce à l\'engagement de ses bénévoles, Sofifran conçoit, développe, organise et réalise des projets qui répondent aux besoins spécifiques et actuels de la communauté des immigrants francophones du Niagara.' : 'At its 2018 Annual General Meeting, members decided to change the term “immigrant” to “interconnected”, a term that better reflects the extension of Sofifran\'s collaborations, both Niagara-wide and Ontario-wide. From then on, SOFIFRAN stands for Solidarité des Femmes et Familles Interconnectées Francophones du Niagara. Thanks to the commitment of its volunteers, Sofifran designs, develops, organizes and implements projects that meet the specific and current needs of Niagara\'s French-speaking immigrant community.' }}
                        </p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="about-text-box">
                        <img src="/frontend/assets/images/resource/mission.jpg" width="100%">
                        <h3 class="mt-4">{{ app()->getLocale() == 'fr' ? 'Notre Mission' : 'Our Mission' }}</h3>
                        <p style="text-align: justify; font-size: 18px;">{{ app()->getLocale() == 'fr' ? 'SOFIFRAN est une plateforme francophone qui vise la promotion et la participation des immigrants dans les secteurs économique et social, tout en favorisant leur épanouissement sur le plan artistique et culturel pour une meilleure intégration au Canada.' : 'Sofifran is a French -speaking platform that targets the promotion and participation of immigrants in the economic and social sectors, while promoting their artistic and cultural development for better integration in Canada.' }}</p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 offset-lg-0 offset-md-3 offset-sm-3 col-sm-6">
                    <div class="about-text-box">
                        <img src="/frontend/assets/images/resource/mandat.jpg" width="100%">
                        <h3 class="mt-4">{{ app()->getLocale() == 'fr' ? 'Mandat' : 'Mandate' }}</h3>
                        <p style="text-align: justify; font-size: 18px;">{{ app()->getLocale() == 'fr' ? 'Rassembler, valoriser, promouvoir, représenter et utiliser rationnellement les compétences acquises des femmes immigrantes francophones de Niagara /Hamilton et leur servir de support dans le domaine de développement social, économique éducatif et culturel, et ce en vue de se prendre et/ou de prendre leurs familles en charge.' : 'Gather, enhance, promote, rationally represent and use the skills acquired by French -speaking immigrant women from Niagara /Hamilton and serve them as a support in the field of social, educational and cultural development, and this in order to take and /or take their families in charge.' }}</p>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>
<!-- End About Area -->

<!-- Start Why Choose Us Area -->
<section class="why-choose-us-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-5 col-md-12">
                <div class="why-choose-us-slides owl-carousel owl-theme">
                    <div class="why-choose-us-image bg1">
                        <img src="assets/img/why-choose-img1.jpg" alt="image">
                    </div>

                    <div class="why-choose-us-image bg2">
                        <img src="assets/img/why-choose-img2.jpg" alt="image">
                    </div>

                    <div class="why-choose-us-image bg3">
                        <img src="assets/img/why-choose-img3.jpg" alt="image">
                    </div>
                </div>
            </div>

            <div class="col-lg-7 col-md-12">
                <div class="why-choose-us-content">
                    <div class="content">
                        <div class="title">
                            <span class="sub-title">{{ app()->getLocale() == 'fr' ? 'Nos Objectifs' : 'Our Goals' }}</span>
                            <h2></h2>
                        </div>

                        <ul class="features-list">
                            <li>
                                <div class="icon">
                                    <i class="flaticon-like"></i>
                                </div>
                                {{ app()->getLocale() == 'fr' ? 'Briser l\'isolement des femmes immigrantes francophones du Niagara et de leurs familles à travers des activités sociales et culturelles;' : 'Break the isolation of Francophone immigrant women from Niagara and their families through social and cultural activities;' }}
                            </li>

                            <li>
                                <div class="icon">
                                    <i class="flaticon-customer-service"></i>
                                </div>
                                {{ app()->getLocale() == 'fr' ? 'Lutter contre la pauvreté et le chômage chez les immigrants francophones en les aidant à développer les compétences nécessaires à l\'employabilité;' : 'Fight against poverty and unemployment among Francophone immigrant women by helping them develop the skills required for employability;' }}
                            </li>

                            <li>
                                <div class="icon">
                                    <i class="flaticon-care"></i>
                                </div>
                                {{ app()->getLocale() == 'fr' ? 'Augmenter leurs capacités entrepreneuriales;' : 'Increase their entrepreneurial capacities;' }}
                            </li>

                            <li>
                                <div class="icon">
                                    <i class="flaticon-team"></i>
                                </div>
                                {{ app()->getLocale() == 'fr' ? 'Aider les femmes immigrantes francophones à acquérir l\'autonomie organisationnelle pour bien prendre soin de leurs familles;' : 'Help French-speaking immigrant women acquire organizational autonomy to take good care of their families;' }}
                            </li>

                            <li>
                                <div class="icon">
                                    <i class="flaticon-policy"></i>
                                </div>
                                {{ app()->getLocale() == 'fr' ? 'Promouvoir les œuvres artistiques et artisanales des femmes immigrées francophones et celles des membres de leur famille;' : ' Promote the artistic and craft works of Francophone immigrant women and those of members of their families;' }}
                            </li>

                            <li>
                                <div class="icon">
                                    <i class="flaticon-education"></i>
                                </div>
                                {{ app()->getLocale() == 'fr' ? 'Organiser les activités visant à rassembler la communauté francophone plurielle, d\'une part, et la communauté hôte en général, d\'autre part.' : 'Organize activities aimed at bringing together the plural Francophone community, on the one hand, and the host community in general, on the other.' }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Why Choose Us Area -->
@endsection