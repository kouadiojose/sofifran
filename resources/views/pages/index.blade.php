@extends('layouts.frontend.template')

<?php

  if( app()->getLocale() == 'fr' ){

    $langue = 'Accueil';

  }else{

    $langue = 'Home';

  }

  $mois_noms = app()->getLocale() == 'fr'
    ? [1 => 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre']
    : [1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

  // Lien du bouton "Je continue" du popup : configure dans l'admin
  // (Popups d'annonce), avec repli sur la page Infolettres.
  $UneLink = (isset($popup) && $popup && !empty($popup->link))
      ? $popup->link
      : route('infolettre');
?>



@section('title', $langue)



@section('css')

<link href="https://fonts.googleapis.com/css2?family=Unica+One&display=swap" rel="stylesheet">



<style>

    

    .ad-overlay {

      position: fixed; inset: 0; background: rgba(0,0,0,.5); backdrop-filter: blur(2px);

      z-index: 9998;

    }

    .ad-modal {

      position: fixed; inset: 0; display: grid; place-items: center; z-index: 9999;

      padding: 16px;

    }

    .ad-modal[hidden], .ad-overlay[hidden] { display: none !important; }

    

    .ad-content {

      width: min(90vw, 800px);

      background: #fff; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,.25);

      overflow: hidden; text-align: center; position: relative;

      padding: 20px;

    }

    .ad-content img { width: 100%; height: auto; display: block; border-radius: 12px; }

    .ad-text { margin: 14px 0; font-size: 16px; line-height: 1.4; }

    

    .ad-cta {

      display: inline-block; margin: 8px 0 4px; padding: 12px 18px;

      border-radius: 999px; text-decoration: none; font-weight: 600;

      background: #111; color: #fff;

    }

    

    .ad-close {

      position: absolute; top: 8px; right: 10px;

      width: 36px; height: 36px; border-radius: 999px;

      border: none; background: #f2f2f2; cursor: pointer; font-size: 24px; line-height: 1;

    }

    .ad-close:hover { background: #e8e8e8; }

    



</style>

@endsection



@section('content')



<!-- Popup Annonce (popup actif selon ses dates de debut/fin, gere dans l'admin) -->

@if($popup)

<div id="ad-overlay" class="ad-overlay" hidden></div>



<div id="ad-modal" class="ad-modal" role="dialog" aria-modal="true" aria-labelledby="ad-title" hidden>

  <button class="ad-close" aria-label="Fermer la fenêtre">&times;</button>



  <div class="ad-content">

    <h2 class="mt-4 mb-4" id="ad-title" style="background-color: #dc3545; padding: 10px; color: white;">- {{ app()->getLocale() == 'fr' ? 'Actualité à La Une': 'Headline News' }} - </h2>

    <a href="<?= $UneLink; ?>" rel="noopener">

      <img loading="lazy" src="/frontend/assets/images/popups/{{ $popup->image }}" alt="Découvrez cette actualité">

    </a>

    <h2 class="mt-5" id="ad-title">{{ $popup->titre }}</h2>

    <p class="ad-text">

      {{ $popup->contenu }}

    </p>

    <br>

    <a href="<?= $UneLink; ?>" class="ad-cta" aria-label="Fermer la fenêtre"> {{ app()->getLocale() == 'fr' ? 'Je continue': 'I\'ll keep going.' }}-></a>

  </div>
</div>

@endif

<!-- Start Main Banner Area -->

<div class="home-area">

    <div class="banner-section home-area-video item-bg1">

        <video loop="" muted="" autoplay="" poster="#" class="background-video">

            <source src="/frontend/assets/images/sliders/video_intro.mp4" type="video/mp4">

        </video>

        <div class="d-table">

            <div class="d-table-cell">

                <div class="container">

                    <div class="main-banner-content text-center">

                        <h1 style="">NOTRE MISSION</h1>

                        <p>{{ app()->getLocale() == 'fr' ? 'SOFIFRAN est un organisme francophone qui vise la promotion et la participation des immigrants dans les secteurs économique et social, tout en favorisant leur épanouissement sur le plan artistique et culturel pour une meilleure intégration au Canada.': 'SOFIFRAN is a French-speaking organization that aims to promote and encourage the participation of immigrants in the economic and social sectors, while fostering their artistic and cultural development for better integration in Canada.' }}</p>



                        <div class="btn-box">

                            <a href="{{ route('about') }}" class="default-btn"> {{ app()->getLocale() == 'fr' ? 'En Savoir Plus': 'Learn More' }}<i class="flaticon-right-chevron"></i><span></span></a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- End Main Banner Area -->



<!-- Start Project Area -->

<section class="blog-area ptb-100 pb-0">

    <div class="container-fluid">

        <div class="section-title">

            <h2><i class="flaticon-home-insurance"></i> {{ app()->getLocale() == 'fr' ? 'Nos Projets': 'Our Projects' }}</h2>

        </div>



        <div class="row">

            @foreach($projets as $p)

            <div class="col-lg-3 col-md-6">

                <div class="single-blog-post">

                    <div class="post-image">

                        <a href="{{ route('detail-projets', $p->slug) }}"><img loading="lazy" src="/frontend/assets/images/projects/{{ $p->image }}" alt="image"></a>



                    </div>



                    <div class="post-content text-center">

                        <h4><a style="text-transform: capitalize !important;" href="{{ route('detail-projets', $p->slug) }}">{{ app()->getLocale() == 'fr' ? $p->titre_fr: $p->titre_en }}</a></h4>



                        <a href="{{ route('detail-projets', $p->slug) }}" class="read-more-btn">LIRE PLUS <i class="flaticon-right-chevron"></i> <span></span></a>

                    </div>

                </div>

            </div>

            @endforeach



            <div class="col-lg-12 col-md-12">

                <div class="blog-notes">

                    <p><a href="{{ route('projets') }}" style="color: #ffffff;" class="default-btn">Voir tous nos projets <i class="flaticon-right-chevron"></i></a></p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- End Project Area -->



<!-- Start Our Achievements Area -->

<section class="achievements-area mt-5">

    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-12 col-md-12">

                <div class="achievements-content">

                    

                    <div class="row">

                        <div class="col-lg-3 col-md-3 col-6 col-sm-3">

                            <div class="single-funfact">

                                <i class="flaticon-home-insurance"></i>

                                <h3><span class="odometer" data-count="{{ $nbProjets }}">00</span>+</h3>

                                <p>Projets</p>

                            </div>

                        </div>



                        <div class="col-lg-3 col-md-3 col-6 col-sm-3">

                            <div class="single-funfact">

                                <i class="flaticon-customer-service"></i>

                                <h3><span class="odometer" data-count="100">00</span>+</h3>

                                <p>Bénévoles</p>

                            </div>

                        </div>



                        <div class="col-lg-3 col-md-3 col-6 col-sm-3">

                            <div class="single-funfact">

                                <i class="flaticon-group"></i>

                                <h3><span class="odometer" data-count="{{ $nbPartenaires }}">00</span>+</h3>

                                <p>Partenaires</p>

                            </div>

                        </div>



                        <div class="col-lg-3 col-md-3 col-12 col-sm-3">

                            <div class="single-funfact">

                                <i class="flaticon-medal"></i>

                                <h3><span class="odometer" data-count="{{ $nbBlogs }}">00</span>+</h3>

                                <p>Blogues</p>

                            </div>

                        </div>

                    </div>



                </div>

            </div>

        </div>

    </div>

</section>

<!-- End Our Achievements Area -->



<!-- Start Services Area -->

<section class="services-area ptb-100 pb-70">

    <div class="container-fluid">

        <div class="section-title">

            <h2><i class="flaticon-group"></i> {{ app()->getLocale() == 'fr' ? 'Nos Activités': 'Our Activity' }}</h2>

        </div>



        <div class="row">

            @foreach($activites as $act)

                <div class="col-lg-3 col-md-6 col-sm-6">

                    <div class="services-box">

                        <div class="image">

                            <img loading="lazy" src="/frontend/assets/images/activites/categories/{{$act->image}}" alt="image">

                        </div>



                        <div class="content">

                            <h3 style="text-transform: capitalize;"><a href="{{ route('sous-activites', $act->slug) }}">{{ app()->getLocale() == 'fr' ? $act->titre_fr: $act->titre_en }}</a></h3>



                            <p style="text-align: justify;">

                                <?= app()->getLocale() == 'fr' ? substr($act->description_fr, 0, 160): substr($act->description_en, 0, 160); ?>...

                            </p>



                            <a href="{{ route('sous-activites', $act->slug) }}" class="read-more-btn">{{ app()->getLocale() == 'fr' ? 'Voir Détails': 'See Details' }} <i class="flaticon-right-chevron"></i></a>

                        </div>

                    </div>

                </div>

            @endforeach

            <div class="col-md-12 text-center">

                <a href="{{ route('activites') }}" class="default-btn">Voir toutes les activités <i class="flaticon-right-chevron"></i></a>

            </div>

        </div>

    </div>

</section>

<!-- End Services Area -->



<!-- Start Events Area -->

<section class="events-area ptb-100 pb-70">

    <div class="container-fluid">

        <div class="section-title">

            <h2>{{ app()->getLocale() == 'fr' ? 'Nos prochains événements': 'Our next events' }}</h2>

        </div>

        <div class="row">

            @if($atelier->isNotEmpty())

            @foreach($atelier as $a)

            @php

                $date = new DateTime($a->start);

                $dateEnd = new DateTime($a->end);

                $heure = $a->hour_start ? new DateTime($a->hour_start) : null;

            @endphp

            <div class="col-md-6">

                <div class="single-events-box">

                    <div class="events-box">

                        <div class="events-image">

                            <div class="image" style="background: {{ $a->image ? "url('/frontend/assets/images/ateliers/" . $a->image . "')" : ($a->color ?: '#6f2da8') }};">

                            </div>

                        </div>



                        <div class="events-content">

                            <div class="content">

                                <h3><a href="{{ route('detail-atelier', $a->slug) }}">{{ app()->getLocale() == 'fr' ? $a->title_fr: $a->title_en }}</a></h3>

                                <p><?= app()->getLocale() == 'fr' ? substr($a->description_fr, 0, 100): substr($a->description_en, 0, 100);  ?>...</p>

                                <span class="location"><i class="fi fi-br-calendar"></i> {{ $a->periode() }}</span>

                                <a href="{{ route('detail-atelier', $a->slug) }}" class="join-now-btn">Détails</a>

                            </div>

                        </div>



                        <div class="events-date">

                            <div class="date">

                                <div class="d-table">

                                    <div class="d-table-cell">

                                        <span>{{ $date->format('d') }}</span>

                                        <h3>{{ $mois_noms[(int) $date->format('n')] }} {{ $date->format('Y') }}</h3>

                                        @if($heure)<p>{{ $heure->format('H') }}H</p>@endif



                                        <i class="flaticon-timetable"></i>



                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            @endforeach

            @else

            <div class="col-md-12">

                <div class="alert alert-info text-center">

                    <p style="font-size: 18px;">{{ app()->getLocale() == 'fr' ? 'Il n\'y a pas de prochains événements disponibles en ce moment.': 'There are no upcoming events available at this time.' }}</p>

                </div>

            </div>

            @endif

        </div>

        

    </div>

</section>

<!-- End Events Area -->



<!-- Start Feedback Area -->

<section class="feedback-area ptb-90">

    <div class="container">

        <div class="section-title">

            <h2><i class="flaticon-customer-service"></i> {{ app()->getLocale() == 'fr' ? 'Témoignages': 'Testimonals' }}</h2>

        </div>



        <div class="feedback-item-slides owl-carousel owl-theme">

            

            @foreach($temoignages as $t)

            <div class="single-feedback-item">

                <div class="feedback-desc">

                    <p>

                       {{ app()->getLocale() == 'fr' ? $t->content_fr: $t->content_en }} 

                    </p>

                </div>



                <div class="client-info">

                    <img loading="lazy" src="/frontend/assets/images/temoignages/{{$t->image}}" alt="image">

                    <h3>{{$t->name}}</h3>

                    <span>{{ app()->getLocale() == 'fr' ? 'Témoin': 'Indicator' }}</span>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>

<!-- End Feedback Area -->



<!-- Start Blog Area -->

<section class="blog-area ptb-100 pb-0">

  <div class="container">

      <div class="section-title">

          <h2><i class="flaticon-medal"></i> {{ app()->getLocale() == 'fr' ? 'Récentes Actualités / Blogues': 'Current News / Blogs' }}</h2>

      </div>



      <div class="row">

          @foreach($blogs as $p)

          <div class="col-lg-4 col-md-6">

              <div class="single-blog-post">

                  <div class="post-image">

                      <a href="{{ route('detail-blog', $p->slug) }}"><img loading="lazy" src="/frontend/assets/images/blog/{{$p->image}}" alt="image"></a>



                      <div class="date"><i class="flaticon-timetable"></i> {{ date('d M Y', strtotime($p->created_at)) }}</div>

                  </div>



                  <div class="post-content">

                      <h3><a style="text-transform: Capitalize;" href="{{ route('detail-blog', $p->slug) }}">{{ app()->getLocale() == 'fr' ? $p->title_fr : $p->title_en }}...</a></h3>

                      <p>

                        <?= app()->getLocale() == 'fr' ? substr($p->description_fr, 0, 25) : substr($p->description_en, 0, 25); ?>...

                      </p>



                      <a href="{{ route('detail-blog', $p->slug) }}" class="default-btn">Lire Plus <i class="flaticon-right-chevron"></i></a>

                  </div>

              </div>

          </div>

          @endforeach

      </div>

  </div>

</section>

<!-- End Blog Area -->



<!-- Start Partner Area -->

<section class="partner-area">

    <div class="container">

        <div class="section-title">

            <h2><i class="flaticon-group"></i> {{ app()->getLocale() == 'fr' ? 'Nos Partenaires': 'Our Partners' }}</h2>

        </div>



        <div class="partner-slides owl-carousel owl-theme">

            

            @foreach($partenaires as $p)

            <div class="single-partner-item">

                <a href="#">

                    <img loading="lazy" src="/frontend/assets/images/partenaires/{{$p->image}}" alt="image">

                </a>

            </div>

            @endforeach

        </div>

    </div>

</section>

<!-- End Partner Area -->









@endsection



@section('js')


  

  <script>

    (function() {

      const MODAL_ID = 'ad-modal';

      const OVERLAY_ID = 'ad-overlay';

      const STORAGE_KEY = 'adPopupSeenAt';

      const DAYS_BETWEEN_SHOWS = 0; // ← change ici si tu veux 1 jour, 3 jours, etc.

      const SHOW_DELAY_MS = 400;    // petit délai après le load

    

      const modal = document.getElementById(MODAL_ID);

      const overlay = document.getElementById(OVERLAY_ID);

      const closeBtn = modal?.querySelector('.ad-close');

      const continueBtn = modal?.querySelector('.ad-cta');

    

      function canShow() {

        try {

          const last = localStorage.getItem(STORAGE_KEY);

          if (!last) return true;

          const lastTime = parseInt(last, 10);

          const now = Date.now();

          const diffDays = (now - lastTime) / (1000 * 60 * 60 * 24);

          return diffDays >= DAYS_BETWEEN_SHOWS;

        } catch {

          return true;

        }

      }

    

      function openModal() {

        if (!modal || !overlay) return;

        overlay.hidden = false;

        modal.hidden = false;

        document.body.style.overflow = 'hidden';

        // Focus accessible

        closeBtn?.focus();

      }

    

      function closeModal() {

        if (!modal || !overlay) return;

        overlay.hidden = true;

        modal.hidden = true;

        document.body.style.overflow = '';

        try { localStorage.setItem(STORAGE_KEY, String(Date.now())); } catch {}

      }

    

      function onKeydown(e) {

        if (e.key === 'Escape') closeModal();

      }

    

      // Listeners

      overlay?.addEventListener('click', closeModal);

      closeBtn?.addEventListener('click', closeModal);

      continueBtn?.addEventListener('click', function(e) {

        e.preventDefault(); // empêche le scroll en haut de page

        closeModal();

      });

      document.addEventListener('keydown', e => {

        if (e.key === 'Escape') closeModal();

      });

      

      //document.addEventListener('keydown', onKeydown);

    

      window.addEventListener('load', function() {

        const last = localStorage.getItem(STORAGE_KEY);

        if (!last || ((Date.now() - parseInt(last)) / (1000*60*60*24) >= DAYS_BETWEEN_SHOWS)) {

          setTimeout(openModal, 600);

        }

      });

    })();

    </script>



@endsection

