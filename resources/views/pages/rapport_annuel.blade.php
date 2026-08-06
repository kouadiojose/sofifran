@extends('layouts.frontend.template')

<?php

  if( app()->getLocale() == 'fr' ){

    $langue = "Rapport Annuel";

  }else{

    $langue = "Annual Report";

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

@include('pages.partials._documents_grid', ['cols' => 4])

@endsection
