@extends('layouts.frontend.template') 

<?php
  if( app()->getLocale() == 'fr' ){
    $langue = 'Projets';
  }else{
    $langue = 'Project';
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
                    <h2>{{ app()->getLocale() == 'fr' ? 'Projets' : 'Project' }}</h2>
                    <ul>
                        <li><a href="{{route('index')}}">Accueil</a></li>
                        <li>{{ app()->getLocale() == 'fr' ? 'Projets' : 'Project' }}</li>
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

            @foreach($projets as $p)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="services-box">
                    <div class="image">
                        <img loading="lazy" src="/frontend/assets/images/projects/{{$p->image}}" alt="image">
                    </div>

                    <div class="content">
                        <h3><a href="{{ route('detail-projets', $p->slug) }}">{{ app()->getLocale() == 'fr' ? substr($p->titre_fr, 0, 25) : substr($p->titre_en, 0, 25) }}...</a></h3>

                        <p>
                            <?= app()->getLocale() == 'fr' ? substr($p->description_fr, 0, 100) : substr($p->description_en, 0, 100); ?>...
                        </p>

                        <a href="{{ route('detail-projets', $p->slug) }}" class="read-more-btn">Lire Plus <i class="flaticon-right-chevron"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="d-flex justify-content-center">
                {!! $projets->links() !!}
             </div>
        </div>
    </div>
</section>
<!-- End Services Area -->
@endsection