@extends('layouts.frontend.template')

<?php
  if( app()->getLocale() == 'fr' ){
    $langue = 'Qui sommes-nous ?';
  }else{
    $langue = 'Who are we ?';
  }

  // Contenu administrable (Admin > Rubriques > A propos). Chaque section
  // garde un repli sur le texte historique tant que la base n'est pas migree.
  $trad = function (string $champ, string $fallback = '') use ($apropos) {
      return ($apropos && method_exists($apropos, 'trad') && $apropos->trad($champ) !== '')
          ? $apropos->trad($champ)
          : $fallback;
  };

  $iconesObjectifs = ['flaticon-like', 'flaticon-customer-service', 'flaticon-care', 'flaticon-team', 'flaticon-policy', 'flaticon-education'];
?>

@section('title', $langue)

@section('content')
<!-- Start Page Title Area -->
<div class="page-title-area page-title-bg3" @if(!empty($baniere) && $baniere->image) style="background-image: url('/frontend/assets/images/resource/{{ $baniere->image }}');" @endif>
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-title-content">
                    <h2>{{ $langue }}</h2>
                    <ul>
                        <li><a href="{{route('index')}}">Accueil</a></li>
                        <li>{{ $langue }}</li>
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
                <img loading="lazy" style="border-radius: 15px;" src="{{ $apropos ? $apropos->imageUrl('image_intro', '/frontend/assets/images/resource/about_who.jpg') : '/frontend/assets/images/resource/about_who.jpg' }}" alt="image">
            </div>

            <div class="col-lg-7 col-md-12">
                <div class="about-content">
                    <span>{{ app()->getLocale() == 'fr' ? 'A Propos' : 'About' }}</span>
                    <h2>{{ $trad('experience', app()->getLocale() == 'fr' ? "Plus de 15 ans d'expérience" : 'Over 15 years experience') }}</h2>
                    <p style="text-align: justify; font-size: 18px;">{{ $trad('intro') }}</p>
                </div>
            </div>
        </div>

        <div class="about-inner-area">
            <div class="row">
                <div class="col-lg-12 col-md-6 col-sm-6">
                    <div class="about-text-box">
                        <h3>{{ app()->getLocale() == 'fr' ? 'Notre Historique' : 'Our History' }}</h3>
                        <p style="text-align: justify; font-size: 18px;">
                            {!! nl2br(e($trad('historique'))) !!}
                        </p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="about-text-box">
                        <img loading="lazy" src="{{ $apropos ? $apropos->imageUrl('image_mission', '/frontend/assets/images/resource/mission.jpg') : '/frontend/assets/images/resource/mission.jpg' }}" width="100%">
                        <h3 class="mt-4">{{ app()->getLocale() == 'fr' ? 'Notre Mission' : 'Our Mission' }}</h3>
                        <p style="text-align: justify; font-size: 18px;">{{ $trad('mission') }}</p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 offset-lg-0 offset-md-3 offset-sm-3 col-sm-6">
                    <div class="about-text-box">
                        <img loading="lazy" src="{{ $apropos ? $apropos->imageUrl('image_mandat', '/frontend/assets/images/resource/mandat.jpg') : '/frontend/assets/images/resource/mandat.jpg' }}" width="100%">
                        <h3 class="mt-4">{{ app()->getLocale() == 'fr' ? 'Mandat' : 'Mandate' }}</h3>
                        <p style="text-align: justify; font-size: 18px;">{{ $trad('mandat') }}</p>
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
                    <div class="why-choose-us-image bg1" @if($apropos?->image_objectif1) style="background-image: url('/frontend/assets/images/resource/{{ $apropos->image_objectif1 }}');" @endif></div>

                    <div class="why-choose-us-image bg2" @if($apropos?->image_objectif2) style="background-image: url('/frontend/assets/images/resource/{{ $apropos->image_objectif2 }}');" @endif></div>

                    <div class="why-choose-us-image bg3" @if($apropos?->image_objectif3) style="background-image: url('/frontend/assets/images/resource/{{ $apropos->image_objectif3 }}');" @endif></div>
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
                            @foreach(preg_split('/\r\n|\r|\n/', $trad('objectifs'), -1, PREG_SPLIT_NO_EMPTY) as $index => $objectif)
                            <li>
                                <div class="icon">
                                    <i class="{{ $iconesObjectifs[$index % count($iconesObjectifs)] }}"></i>
                                </div>
                                {{ $objectif }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Why Choose Us Area -->
@endsection
