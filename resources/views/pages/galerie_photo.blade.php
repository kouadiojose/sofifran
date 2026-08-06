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

            @foreach($activites as $p)

                <?php 



                    $countPhotos = DB::table('galerie_photos')->Where('galerie_id', $p->id)->count();

                ?>

                <div class="col-lg-4 col-md-6 col-sm-6">

                    <div class="single-team-box">

                        <div class="image">

                            <img loading="lazy" src="/frontend/assets/images/activites/{{$p->image}}" alt="image">

                        </div>



                        <div class="content">

                            <h3><a href="#">{{ app()->getLocale() == 'fr' ? $p->title_fr : $p->title_en }}</a></h3>



                            @if($countPhotos > 0)

                            <a href="{{ route('galerie-photo-get', $p->slug) }}" class="default-btn mt-4">{{ app()->getLocale() == 'fr' ? 'Voir album' : 'View album' }} <i class="flaticon-right-chevron"></i></a>

                            @endif

                        </div>

                    </div>

                </div>

            @endforeach

            <div class="d-flex justify-content-center">
                {!! $activites->links() !!}
            </div>



        </div>

    </div>

</section>

<!-- End Services Area -->

@endsection