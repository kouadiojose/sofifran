@extends('layouts.frontend.template') 

<?php
  if( app()->getLocale() == 'fr' ){
    $langue = 'Equipe';
  }else{
    $langue = 'Team';
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
                    <h2>{{ app()->getLocale() == 'fr' ? 'Equipe' : 'Team' }}</h2>
                    <ul>
                        <li><a href="{{route('index')}}">Accueil</a></li>
                        <li>{{ app()->getLocale() == 'fr' ? 'Equipe' : 'Team' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Title Area -->

<!-- Start Team Area -->
<section class="team-area ptb-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                <h2>{{ app()->getLocale() == 'fr' ? 'CONSEIL D\'ADMINISTRATION' : 'BOARD OF DIRECTORS' }}</h2>
            </div>

            @foreach( $team_conseil_ad as $t )
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-team-box">
                    <div class="image">
                        <img width="100%" src="/frontend/assets/images/team/{{$t->image}}" alt="image">
                    </div>

                    <div class="content">
                        <h3>{{ $t->name }}</h3>
                        <span>{{ app()->getLocale() == 'fr' ? $t->post_fr : $t->post_en }}</span>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-md-12 mt-4 mb-4">
                <h2>{{ app()->getLocale() == 'fr' ? 'PERSONNEL' : 'STAFF' }}</h2>
            </div>

            @foreach( $team_personnel as $t )
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="single-team-box">
                    <div class="image">
                        <img width="100%" src="/frontend/assets/images/team/{{$t->image}}" alt="image">
                    </div>

                    <div class="content">
                        <h3>{{ $t->name }}</h3>
                        <span>{{ app()->getLocale() == 'fr' ? $t->post_fr : $t->post_en }}</span>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- End Team Area -->
@endsection