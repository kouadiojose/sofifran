@extends('layouts.frontend.template') 

<?php
  if( app()->getLocale() == 'fr' ){
    $langue = $cat->titre_fr;
  }else{
    $langue = $cat->titre_en;
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
                    <h2>{{ app()->getLocale() == 'fr' ? $cat->titre_fr : $cat->titre_en }}</h2>
                    <ul>
                        <li><a href="{{route('index')}}">Accueil</a></li>
                        <li>{{ app()->getLocale() == 'fr' ? $cat->titre_fr : $cat->titre_en }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Services Area -->
<section class="services-area ptb-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="title">
                <h4 class="mb-2">{{ app()->getLocale() == 'fr' ? $cat->titre_fr : $cat->titre_en }}</h4>
                <p class="mb-5" style="text-align: justify; font-size: 18px;">
                    {{ app()->getLocale() == 'fr' ? $cat->description_fr : $cat->description_en }}
                </p>
            </div>

            @foreach($activites as $p)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="services-box">
                    <div class="image">
                        <img loading="lazy" src="/frontend/assets/images/activites/{{$p->image}}" alt="image">
                    </div>

                    <div class="content">
                        <h3><a style="text-transform: capitalize !important;" href="{{ route('detail-activites', [$p->categorie_activity_slug, $p->slug]) }}">{{ app()->getLocale() == 'fr' ? substr($p->title_fr, 0, 25) : substr($p->title_en, 0, 25) }}...</a></h3>

                        <p>
                            <?= app()->getLocale() == 'fr' ? substr($p->description_fr, 0, 100) : substr($p->description_en, 0, 100); ?>...
                        </p>

                        <a href="{{ route('detail-activites', [$p->categorie_activity_slug, $p->slug]) }}" class="read-more-btn">Lire Plus <i class="flaticon-right-chevron"></i></a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- End Services Area -->
@endsection