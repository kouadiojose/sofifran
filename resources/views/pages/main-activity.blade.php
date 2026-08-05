@extends('layouts.frontend.template') 

<?php
  if( app()->getLocale() == 'fr' ){
    $langue = 'Activités';
  }else{
    $langue = 'Activity';
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
                    <h2>{{ app()->getLocale() == 'fr' ? 'Activités' : 'Activity' }}</h2>
                    <ul>
                        <li><a href="{{route('index')}}">Accueil</a></li>
                        <li>{{ app()->getLocale() == 'fr' ? 'Activités' : 'Activity' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Case Study Area -->
<section class="case-study-area ptb-100 pb-70 bg-fafafa">
    <div class="container">
        <div class="row">
        	@foreach($activites as $p)
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="single-case-study-box">
                    <a href="{{ route('sous-activites', $p->slug) }}" class="case-study-link">
                        <img src="/frontend/assets/images/activites/categories/{{ $p->image }}">
                    </a>
                    <div class="case-study-info">
                        
                        <h3 class="title"><a href="{{ route('sous-activites', $p->slug) }}">{{ app()->getLocale() == 'fr' ? $p->titre_fr: $p->titre_en }}</a></h3>

                        <p style="text-align: justify;">
                            <?= app()->getLocale() == 'fr' ? $p->description_fr: $p->description_fr; ?>...
                        </p>

                        <a href="{{ route('sous-activites', $p->slug) }}" class="read-more-btn">{{ app()->getLocale() == 'fr' ? 'Voir Détails': 'See Details' }} <i class="flaticon-right-chevron"></i></a>

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End Case Study Area -->
@endsection