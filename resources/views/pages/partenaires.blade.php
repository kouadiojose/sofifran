@extends('layouts.frontend.template') 
<?php
  if( app()->getLocale() == 'fr' ){
    $langue = 'Partenaires';
  }else{
    $langue = 'Partners';
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

                      <h2>{{ app()->getLocale() == 'fr' ? 'Partenaires': 'Partners' }}</h2>

                      <ul>

                          <li><a href="{{ route('index') }}">{{ app()->getLocale() == 'fr' ? 'Accueil': 'Home' }}</a></li>

                          <li>{{ app()->getLocale() == 'fr' ? 'Partenaires': 'Partners' }}</li>

                      </ul>

                  </div>

              </div>

          </div>

      </div>

  </div>

  <!-- End Page Title Area -->


  <section class="team-area ptb-100 pb-70">
    <div class="container">
        <div class="row">
           <div class="col-md-12 mb-4">
              <h2>Partenaires Financiers</h2>
           </div>

           @foreach($partenaireFinance as $p)
           
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{$p->link}}" target="_blank">
                <div class="single-team-box">
                    <div class="image">
                        <img loading="lazy" width="100%" src="/frontend/assets/images/partenaires/{{$p->image}}" alt="image">
                    </div>
                </div>
                </a>
            </div>
            
            @endforeach

        </div>

        <div class="row">
           <div class="col-md-12 mb-4 mt-5">
              <h2>Commanditaires</h2>
           </div>

           @foreach($partenaireCommanditaire as $p)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{$p->link}}" target="_blank">
                <div class="single-team-box">
                    <div class="image">
                        <img loading="lazy" width="100%" src="/frontend/assets/images/partenaires/{{$p->image}}" alt="image">
                    </div>
                </div>
                </a>
            </div>
            @endforeach

        </div>

        <div class="row">
           <div class="col-md-12 mb-4 mt-5">
              <h2>Partenaires Communautaires</h2>
           </div>

           @foreach($partenaireCommunautaire as $p)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{$p->link}}" target="_blank">
                <div class="single-team-box">
                    <div class="image">
                        <img loading="lazy" width="100%" src="/frontend/assets/images/partenaires/{{$p->image}}" alt="image">
                    </div>
                </div>
                </a>
            </div>
            @endforeach

        </div>

        <div class="row">
           <div class="col-md-12 mb-4 mt-5">
              <h2>Autres Partenaires</h2>
           </div>

           @foreach($partenaireAutres as $p)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <a href="{{$p->link}}" target="_blank">
                <div class="single-team-box">
                    <div class="image">
                        <img loading="lazy" width="100%" src="/frontend/assets/images/partenaires/{{$p->image}}" alt="image">
                    </div>
                </div>
                </a>
            </div>
            @endforeach

        </div>

      </div>
    </section>

  

@endsection

