@extends('layouts.frontend.template') 



<?php

  if( app()->getLocale() == 'fr' ){

    $langue = 'Blogue';

  }else{

    $langue = 'Blog';

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

                    <h2>{{ app()->getLocale() == 'fr' ? 'Blogue' : 'Blog' }}</h2>

                    <ul>

                        <li><a href="{{route('index')}}">Accueil</a></li>

                        <li>{{ app()->getLocale() == 'fr' ? 'Blogue' : 'Blog' }}</li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- End Page Title Area -->



<!-- Start Blog Area -->

<section class="blog-area ptb-100">

    <div class="container">

        <div class="row">

            

            @foreach($blog as $b)

            <div class="col-lg-4 col-md-6">

                <div class="single-blog-post">

                    <div class="post-image">

                        <a href="{{ route('detail-blog', $b->slug) }}"><img loading="lazy" src="/frontend/assets/images/blog/{{$b->image}}" alt="image"></a>

                        <div class="date"><i class="flaticon-calendar"></i> {{ date('d M Y', strtotime($b->created_at)) }}</div>

                    </div>



                    <div class="post-content">

                        <h3><a href="{{ route('detail-blog', $b->slug) }}">{{ app()->getLocale() == 'fr' ? substr($b->title_fr, 0, 25) : substr($b->title_en, 0, 25) }}...</a></h3>

                        <p>

                            {{ app()->getLocale() == 'fr' ? substr($b->description_fr, 0, 50) : substr($b->description_en, 0, 50) }}...

                        </p>



                        <a href="{{ route('detail-blog', $b->slug) }}" class="default-btn">Lire Plus <span></span></a>

                    </div>

                </div>

            </div>

            @endforeach

            <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                {{ $blog->links() }}
            </div>

        </div>

    </div>

</section>

<!-- End Blog Area -->

@endsection