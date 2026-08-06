@extends('layouts.frontend.template')

<?php

  if( app()->getLocale() == 'fr' ){

    $langue = 'Événements';

  }else{

    $langue = 'Events';

  }

  $mois_fr = [1 => 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
  $mois_en = [1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

?>

@section('title', $langue)

@section('content')

<!-- Start Page Title Area -->
<div class="page-title-area page-title-bg3" @if($baniere && $baniere->image) style="background-image: url('/frontend/assets/images/resource/{{ $baniere->image }}');" @endif>
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="page-title-content">
                    <h2>{{ app()->getLocale() == 'fr' ? 'Nos prochains événements': 'Our next events' }}</h2>
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

<!-- Start Events Area -->
<section class="events-area ptb-100">
    <div class="container-fluid">

        <div class="section-title">
            <h2>{{ app()->getLocale() == 'fr' ? 'Nos prochains événements': 'Our next events' }}</h2>
        </div>

        <div class="row">

            @forelse($calendar as $a)

            @php
                $date  = new DateTime($a->start);
                $heure = new DateTime($a->hour_start);
                $mois  = app()->getLocale() == 'fr' ? $mois_fr[(int) $date->format('n')] : $mois_en[(int) $date->format('n')];
            @endphp

            <div class="col-md-6">
                <div class="single-events-box">
                    <div class="events-box">
                        <div class="events-image">
                            <div class="image" style="background: {{ $a->image ? "url('/frontend/assets/images/ateliers/" . $a->image . "')" : ($a->color ?: '#6f2da8') }};"></div>
                        </div>

                        <div class="events-content">
                            <div class="content">
                                <h3><a href="{{ route('detail-atelier', $a->slug) }}">{{ app()->getLocale() == 'fr' ? $a->title_fr: $a->title_en }}</a></h3>
                                <p><?= app()->getLocale() == 'fr' ? substr(strip_tags($a->description_fr), 0, 100): substr(strip_tags($a->description_en), 0, 100); ?>...</p>
                                <span class="location"><i class="fi fi-br-calendar"></i> {{ $a->periode() }}</span>
                                <a href="{{ route('detail-atelier', $a->slug) }}" class="join-now-btn">{{ app()->getLocale() == 'fr' ? 'Détails': 'Details' }}</a>
                            </div>
                        </div>

                        <div class="events-date">
                            <div class="date">
                                <div class="d-table">
                                    <div class="d-table-cell">
                                        <span>{{ $date->format('d') }}</span>
                                        <h3>{{ $mois }} {{ $date->format('Y') }}</h3>
                                        <p>{{ $heure->format('H') }}H</p>
                                        <i class="flaticon-timetable"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @empty

            <div class="col-md-12">
                <div class="alert alert-info text-center">
                    <p style="font-size: 18px;">{{ app()->getLocale() == 'fr' ? 'Il n\'y a pas de prochains événements disponibles en ce moment.': 'There are no upcoming events available at this time.' }}</p>
                </div>
            </div>

            @endforelse

        </div>
    </div>
</section>
<!-- End Events Area -->

@endsection
