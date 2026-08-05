@extends('layouts.frontend.template') 



<?php

  if( app()->getLocale() == 'fr' ){

    $langue = 'Offres d\'emplois';

  }else{

    $langue = 'Carrers';

  }

?>



@section('title', $langue)



@section('content')

<!-- Start Page Title Area -->

<div class="page-title-area page-title-bg3">

    <div class="d-table">

        <div class="d-table-cell">

            <div class="container">

                <div class="page-title-content">

                    <h2>{{ app()->getLocale() == 'fr' ? 'Offres d\'emplois disponible' : 'Available Carrers' }}</h2>

                    <ul>

                        <li><a href="{{route('index')}}">Accueil</a></li>

                        <li>{{ app()->getLocale() == 'fr' ? 'Offres d\'emplois disponible' : 'Available Carrers' }}</li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- End Page Title Area -->



<!-- Start Blog Area -->

<section class="blog-area ptb-100">

    <div class="container">

        <div class="row">

            <div class="col-lg-6 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/carrers/OFFRE D'EMPLOI - COORDONNATEUR(TRICE) DE PROJET.dox.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/carrers/OFFRE D'EMPLOI - COORDONNATEUR(TRICE) DE PROJET.dox.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Télécharger l'offre</a>

            </div>
            <div class="col-lg-6 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/carrers/OFFRE D'EMPLOI.d - AGENT.E D'ACCOMPAGNEMENT.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/carrers/OFFRE D'EMPLOI.d - AGENT.E D'ACCOMPAGNEMENT.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Télécharger l'offre</a>

            </div>
     


        </div>

    </div>

</section>

<!-- End Blog Area -->

@endsection