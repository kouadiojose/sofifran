@extends('layouts.frontend.template') 

<?php
  if( app()->getLocale() == 'fr' ){
    $langue = 'Lettre information';
  }else{
    $langue = 'Infolettre';
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
                    <h2>{{ app()->getLocale() == 'fr' ? 'Lettre information' : 'Infolettre' }}</h2>
                    <ul>
                        <li><a href="{{route('index')}}">Accueil</a></li>
                        <li>{{ app()->getLocale() == 'fr' ? 'Lettre information' : 'Infolettre' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Title Area -->


<section class="blog-area ptb-100">

    <div class="container">

        <div class="row">

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed class="mb-3" src="/frontend/assets/docs/infolettre/INFOLETTRE -4ÉME-JUILLET.pdf" width="100%" height="500" type="application/pdf"/>


                <a target="_blank" href="/frontend/assets/docs/infolettre/INFOLETTRE -4ÉME-JUILLET.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir l'infolettre Juillet 2026</a>
            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed class="mb-3" src="/frontend/assets/docs/infolettre/INFOLETTRE-3eme-edition-Mars 2026.pdf" width="100%" height="500" type="application/pdf"/>


                <a target="_blank" href="/frontend/assets/docs/infolettre/INFOLETTRE-3eme-edition-Mars 2026.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir l'infolettre Mars 2026</a>
            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed class="mb-3" src="/frontend/assets/docs/infolettre/Infolettre Octobre 2025.pdf" width="100%" height="500" type="application/pdf"/>


                <a target="_blank" href="/frontend/assets/docs/infolettre/Infolettre Octobre 2025.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir l'infolettre Octobre 2025</a>
            </div>
            

        </div>

    </div>

</section>
@endsection