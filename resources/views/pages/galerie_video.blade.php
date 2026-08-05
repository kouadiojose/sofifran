@extends('layouts.frontend.template') 

<?php
  if( app()->getLocale() == 'fr' ){
    $langue = 'Galérie Vidéos';
  }else{
    $langue = 'Videos Gallery';
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
                    <h2>{{ app()->getLocale() == 'fr' ? 'Galérie Vidéos' : 'Videos Gallery' }}</h2>
                    <ul>
                        <li><a href="{{route('index')}}">Accueil</a></li>
                        <li>{{ app()->getLocale() == 'fr' ? 'Galérie Vidéos' : 'Videos Gallery' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Video Area -->
<section class="case-study-details-area ptb-100 pb-70">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="case-study-details-image">
                        <div class="image">
                            <img src="/frontend/assets/images/gallery/video/test_video.png" alt="projects">
                            <a href="https://vimeo.com/1142140259" class="popup-youtube"><i class="flaticon-play-button"></i></a>
                        </div>
                    </div>
                </div>
            @foreach($videos as $v)
               
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="case-study-details-image">
                        <div class="image">
                            <img src="/frontend/assets/images/gallery/video/{{$v->image}}" alt="projects">

                            <a href="https://www.youtube.com/watch?v={{$v->link_video}}" class="popup-youtube"><i class="flaticon-play-button"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</section>
<!-- End Services Area -->
@endsection