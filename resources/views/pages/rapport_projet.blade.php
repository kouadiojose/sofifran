@extends('layouts.frontend.template') 



<?php

  if( app()->getLocale() == 'fr' ){

    $langue = 'Rapport de projet';

  }else{

    $langue = 'Project Report';

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

                    <h2>{{ app()->getLocale() == 'fr' ? 'Rapport de projet' : 'Project Report' }}</h2>

                    <ul>

                        <li><a href="{{route('index')}}">Accueil</a></li>

                        <li>{{ app()->getLocale() == 'fr' ? 'Rapport de projet' : 'Project Report' }}</li>

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

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/rapport_projets/Projet de production de chaine communautaire_Canal Sofifran.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/rapport_projets/Projet de production de chaine communautaire_Canal Sofifran.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le rapport de projet de production de chaine communautaire canal Sofifran</a>

            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/rapport_projets/Rapport sur la Formation des Bénévoles_Canal Sofifran.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/rapport_projets/Rapport sur la Formation des Bénévoles_Canal Sofifran.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le rapport de projet sur la Formation des Bénévoles_Canal Sofifran.pdf</a>

            </div>
             

        </div>

    </div>

</section>

<!-- End Blog Area -->

@endsection