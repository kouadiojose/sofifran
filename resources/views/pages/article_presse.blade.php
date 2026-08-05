@extends('layouts.frontend.template') 



<?php

  if( app()->getLocale() == 'fr' ){

    $langue = 'Article de presse';

  }else{

    $langue = 'Press article';

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

                    <h2>{{ app()->getLocale() == 'fr' ? 'Article de Presse' : 'Press article' }}</h2>

                    <ul>

                        <li><a href="{{route('index')}}">Accueil</a></li>

                        <li>{{ app()->getLocale() == 'fr' ? 'Article de Presse' : 'Press article' }}</li>

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

                <embed src="/frontend/assets/docs/articles/Le Regional du 2 Juin 2026.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/articles/Le Regional du 2 Juin 2026.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir l'article Complet</a>

            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/articles/ONFR du 26 novembre.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/articles/ONFR du 26 novembre.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir l'article Complet</a>

            </div>
            
            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/articles/Le Régional du 24 Octobre 2025.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/articles/Le Régional du 24 Octobre 2025.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le régional Complet</a>

            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/articles/SOFIFRAN repense ses services pour mieux répondre  aux besoin de la communauté.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/articles/SOFIFRAN repense ses services pour mieux répondre  aux besoin de la communauté.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le régional Complet</a>

            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/articles/SOFIFRAN initie les nouveaux arrivants au vivre-ensemble canadien.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/articles/SOFIFRAN initie les nouveaux arrivants au vivre-ensemble canadien.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le régional Complet</a>

            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/articles/SOFIFRAN propose un vibrant hommage à la francophonie et à la diversité.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/articles/SOFIFRAN propose un vibrant hommage à la francophonie et à la diversité.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le régional Complet</a>

            </div>
            
            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/articles/Le Regional 05 Juin 2025.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/articles/Le Regional 05 Juin 2025.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le régional Complet</a>

            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/articles/Le Regional 2 Janvier 2025.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/articles/Le Regional 2 Janvier 2025.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le régional Complet</a>

            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/articles/Le Regional 24 Janvier 2025.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/articles/Le Regional 24 Janvier 2025.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le régional Complet</a>

            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/articles/-1653670411.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/articles/-1653670411.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le régional Complet</a>

            </div>



            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/articles/-1653670854.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/articles/-1653670854.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le régional P4 Complet</a>

            </div>



            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/articles/SOFIFRAN fait rayonnrerle multiculturalisme à Welland.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/articles/SOFIFRAN fait rayonnrerle multiculturalisme à Welland.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir l'article Complet</a>

            </div>

            

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/articles/Une chaîne francophone voit le jour le grâce à Sofifran.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/articles/Une chaîne francophone voit le jour le grâce à Sofifran.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir l'article Complet</a>

            </div>



        </div>

    </div>

</section>

<!-- End Blog Area -->

@endsection