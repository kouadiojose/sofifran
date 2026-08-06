@extends('layouts.frontend.template')

<?php

  if( app()->getLocale() == 'fr' ){

    $langue = 'Témoignages';

  }else{

    $langue = 'Testimonials';

  }

?>

@section('title', $langue)

@section('content')

<!-- Start Page Title Area -->
<div class="page-title-area page-title-bg3" @if($baniere && $baniere->image) style="background-image: url('/frontend/assets/images/resource/{{ $baniere->image }}');" @endif>
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-title-content">
                    <h2>{{ $langue }}</h2>
                    <ul>
                        <li><a href="{{ route('index') }}">{{ app()->getLocale() == 'fr' ? 'Accueil': 'Home' }}</a></li>
                        <li>{{ $langue }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Feedback Area -->
<section class="feedback-area ptb-100">
    <div class="container">
        <div class="section-title">
            <h2><i class="flaticon-customer-service"></i> {{ $langue }}</h2>
        </div>

        <div class="row">
            @forelse($temoignages as $t)
            <div class="col-lg-6 col-md-6">
                <div class="single-feedback-item mb-4">
                    <div class="feedback-desc">
                        <p>
                            {{ app()->getLocale() == 'fr' ? $t->content_fr : $t->content_en }}
                        </p>
                    </div>

                    <div class="client-info">
                        <img loading="lazy" src="/frontend/assets/images/temoignages/{{ $t->image }}" alt="{{ $t->name }}">
                        <h3>{{ $t->name }}</h3>
                        <span>{{ app()->getLocale() == 'fr' ? 'Témoin': 'Witness' }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p>{{ app()->getLocale() == 'fr' ? 'Aucun témoignage disponible pour le moment.': 'No testimonials available at the moment.' }}</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
<!-- End Feedback Area -->

@endsection
