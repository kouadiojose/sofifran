@extends('layouts.frontend.template') 

<?php
  if( app()->getLocale() == 'fr' ){
    $langue = 'Communiqué';
  }else{
    $langue = 'Press release';
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
                    <h2>{{ app()->getLocale() == 'fr' ? 'Communiqué' : 'Press release' }}</h2>
                    <ul>
                        <li><a href="{{route('index')}}">Accueil</a></li>
                        <li>{{ app()->getLocale() == 'fr' ? 'Communiqué' : 'Press release' }}</li>
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
                <embed src="/frontend/assets/docs/communiques/COMMUNIQUE-PRESSE.pdf" width="100%" height="500" type="application/pdf"/>

                <a target="_blank" href="/frontend/assets/docs/communiques/COMMUNIQUE-PRESSE.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le communiqué de Presse</a>
            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">
                <embed src="/frontend/assets/docs/communiques/COMMUNIQUE - Juillet 2023.pdf" width="100%" height="500" type="application/pdf"/>

                <a target="_blank" href="/frontend/assets/docs/communiques/COMMUNIQUE - Juillet 2023.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le communiqué de Juillet 2023</a>
            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">
                <embed src="/frontend/assets/docs/communiques/WAGE - COMMUNIQUÉ DE PRESSE.pdf" width="100%" height="500" type="application/pdf"/>

                <a target="_blank" href="/frontend/assets/docs/communiques/WAGE - COMMUNIQUÉ DE PRESSE.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le communiqué de Presse - WAGE</a>
            </div>

        </div>
    </div>
</section>
<!-- End Blog Area -->
@endsection