@extends('layouts.frontend.template') 



<?php

  if( app()->getLocale() == 'fr' ){

    $langue = 'Galérie Photo';

  }else{

    $langue = 'Picture Gallery';

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

                    <h2>{{ app()->getLocale() == 'fr' ? 'Galérie Photos' : 'Picture Gallery' }}</h2>

                    <ul>

                        <li><a href="{{route('index')}}">Accueil</a></li>

                        <li>{{ app()->getLocale() == 'fr' ? 'Galérie Photos' : 'Picture Gallery' }}</li>

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

            <!-- Start Case Study Details Area -->

            <section class="case-study-details-area ptb-100">

                <div class="container">

                    <div class="row">

                     @foreach( $galerie as $g )   

                        <div class="col-lg-4 col-md-4 col-sm-4">

                            <div class="case-study-details-image">

                                <img loading="lazy" width="100%" src="/frontend/assets/images/gallery/photos/{{ $g->image }}" alt="projects">

                                <a href="/frontend/assets/images/gallery/photos/{{ $g->image }}" class="popup-btn"><i class="fi fi-br-plus"></i></a>

                            </div>

                        </div>

                     @endforeach

                     <div class="d-flex justify-content-center">
                        {!! $galerie->links() !!}
                     </div>
                    </div>

                </div>

            </section>

        </div>

    </div>

</section>

<!-- End Services Area -->

@endsection