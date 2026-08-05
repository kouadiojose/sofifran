@extends('layouts.frontend.template') 

<?php
  if( app()->getLocale() == 'fr' ){
    $langue = 'Recueil de Conte';
  }else{
    $langue = 'Collection of Tales';
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
                    <h2>{{ app()->getLocale() == 'fr' ? 'Recueil de Conte' : 'Collection of Tales' }}</h2>
                    <ul>
                        <li><a href="{{route('index')}}">Accueil</a></li>
                        <li>{{ app()->getLocale() == 'fr' ? 'Recueil de Conte' : 'Collection of Tales' }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Page Title Area -->


<section class="blog-area ptb-100">

    <div class="container">

        <div class="row">

            <div class="col-lg-12 col-md-12 text-center mb-5">

                <iframe allowfullscreen="allowfullscreen" allow="clipboard-write" scrolling="no" class="fp-iframe" src="https://heyzine.com/flip-book/dcedd143b9.html" style="border: 1px solid lightgray; width: 100%; height: 600px;"></iframe>
            </div>

            

        </div>

    </div>

</section>
@endsection