@extends('layouts.frontend.template') 
<?php
  if( app()->getLocale() == 'fr' ){
    $langue = 'Publication';
  }else{
    $langue = 'Publication';
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
                      <h2>{{ app()->getLocale() == 'fr' ? 'Publication': 'Publication' }}</h2>
                      <ul>
                          <li><a href="{{ route('index') }}">{{ app()->getLocale() == 'fr' ? 'Accueil': 'Home' }}</a></li>
                          <li>{{ app()->getLocale() == 'fr' ? 'Publication': 'Publication' }}</li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- End Page Title Area -->

  <section class="insurance-details-area ptb-100">
      <div class="container">
        <div class="insurance-details-header">
            <div class="row align-items-center">
                @foreach($pubs as $p)
                  <div class="col-md-4">
                      <div class="single-services-box">
                        <img src="/frontend/assets/images/publication/file.png">
                        <div class="date mt-4"><i class="flaticon-calendar"></i><span>{{ date('d M Y', strtotime($p->date_pub)) }}</span></div>
                        <h2>{{ app()->getLocale() == 'fr' ? $p->titre_fr: $p->titre_en }}</h2>

                        <a target="_blank" class="default-btn" href="{{ $p->doc_url }}">{{ app()->getLocale() == 'fr' ? 'Voir la Publication': 'See Publication' }}</a>
                      </div>
                  </div>
                @endforeach
            </div>
        </div>
      </div>
  </section>
@endsection
