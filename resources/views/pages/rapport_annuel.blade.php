@extends('layouts.frontend.template') 



<?php

  if( app()->getLocale() == 'fr' ){

    $langue = 'Rapport Annuel';

  }else{

    $langue = 'Annual Report';

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

                    <h2>{{ app()->getLocale() == 'fr' ? 'Rapport Annuel' : 'Annual Report' }}</h2>

                    <ul>

                        <li><a href="{{route('index')}}">Accueil</a></li>

                        <li>{{ app()->getLocale() == 'fr' ? 'Rapport Annuel' : 'Annual Report' }}</li>

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

                <embed src="/frontend/assets/docs/rapports/Rapport_FrancoSphere_P-15670_PassepART_SOFIFRAN.pdf" width="100%" height="500" type="application/pdf"/>
                <a target="_blank" href="/frontend/assets/docs/rapports/Rapport_FrancoSphere_P-15670_PassepART_SOFIFRAN.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Rapports annuels de PASSEP’AR - P-15670</a>

            </div>
            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/rapports/Rapport_Les_VOIx_du_futur_ViceVersa_SOFIFRAN.pdf" width="100%" height="500" type="application/pdf"/>
                <a target="_blank" href="/frontend/assets/docs/rapports/Rapport_Les_VOIx_du_futur_ViceVersa_SOFIFRAN.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Rapports annuels de Vice Versa D-54165</a>

            </div>
            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/rapports/Rapport_ApprenTISSAGE_ViceVersa_SOFIFRAN.pdf" width="100%" height="500" type="application/pdf"/>
                <a target="_blank" href="/frontend/assets/docs/rapports/Rapport_ApprenTISSAGE_ViceVersa_SOFIFRAN.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i>Voir 1ère ronde - Subvention VICE VERSA</a>

            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/rapports/Rapport_FrancoSphere_PassepART_LaMosaique_SOFIFRAN.pdf" width="100%" height="500" type="application/pdf"/>
                <a target="_blank" href="/frontend/assets/docs/rapports/Rapport_FrancoSphere_PassepART_LaMosaique_SOFIFRAN.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i>Voir Passep’ART – SOFIFRAN – P-16482</a>

            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/rapports/Rapport_FrancoSphere_PassepART_GabrielleRoy_SOFIFRAN.pdf" width="100%" height="500" type="application/pdf"/>
                <a target="_blank" href="/frontend/assets/docs/rapports/Rapport_FrancoSphere_PassepART_GabrielleRoy_SOFIFRAN.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i>Voir Passep’ART – SOFIFRAN – P-16482</a>

            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/rapports/Rapport_FrancoSphere_PassepART_SOFIFRAN.pdf" width="100%" height="500" type="application/pdf"/>
                <a target="_blank" href="/frontend/assets/docs/rapports/Rapport_FrancoSphere_PassepART_SOFIFRAN.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i>Voir Passep’ART – SOFIFRAN – P-16482</a>

            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/rapports/Rapport_Voix_du_Futur_Vice_Versa_SOFIFRAN.pdf" width="100%" height="500" type="application/pdf"/>
                <a target="_blank" href="/frontend/assets/docs/rapports/Rapport_Voix_du_Futur_Vice_Versa_SOFIFRAN.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i>Voir VICE VERSA – SOFIFRAN – D 54165</a>

            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/rapports/RAPPORT-ANNUEL-2024-2025 (9).pdf" width="100%" height="500" type="application/pdf"/>
                <a target="_blank" href="/frontend/assets/docs/rapports/RAPPORT-ANNUEL-2024-2025 (9).pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le rapport annuel 2024-2025</a>

            </div>

             <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/rapports/RAPPORT ANNUEL 2022-2023.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/rapports/RAPPORT ANNUEL 2022-2023.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le rapport annuel 2022-2023</a>

            </div>
            

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/rapports/RAPPORT 2021-2022.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/rapports/RAPPORT 2021-2022.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le rapport annuel 2021-2022</a>

            </div>

            <div class="col-lg-4 col-md-6 text-center mb-5">

                <embed src="/frontend/assets/docs/rapports/RAPPORT ANNUEL 2020-2021.pdf" width="100%" height="500" type="application/pdf"/>



                <a target="_blank" href="/frontend/assets/docs/rapports/RAPPORT ANNUEL 2020-2021.pdf" class="btn btn-primary btn-lg mt-2"><i class="icofont-eyes"></i> Voir le rapport annuel 2020-2021</a>

            </div>

        </div>

    </div>

</section>

<!-- End Blog Area -->

@endsection