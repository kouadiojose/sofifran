@extends('layouts.frontend.template') 
<?php
  if( app()->getLocale() == 'fr' ){
    $langue = 'Détail Evènement';
  }else{
    $langue = 'Event Detail';
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
                        <h2>{{ app()->getLocale() == 'fr' ? 'Détail Evènement': 'Event Detail' }}</h2>
                        <ul>
                            <li><a href="{{ route('index') }}">{{ app()->getLocale() == 'fr' ? 'Accueil': 'Home' }}</a></li>
                            <li>{{ app()->getLocale() == 'fr' ? 'Détail Evènement': 'Event Detail' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Title Area -->


    <!-- Start Blog Details Area -->
    <section class="blog-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-details-desc">
                        <div class="article-image">
                        	<?php if ( $atelier->image != Null ): ?>
	                           <img src="/frontend/assets/images/ateliers/{{ $atelier->image }}" alt="image">
	                         <?php endif ?>
                        </div>

                        <div class="article-content">
                            <div class="entry-meta">
                                <ul>
                                    <li><i class="fi fi-br-calendar"></i> {{ $atelier->periode() }}</li>
                                    <li>
                                        @if($atelier->estAVenir())
                                            <span class="badge badge-success" style="background:#28a745;color:#fff;padding:4px 10px;border-radius:4px;">{{ app()->getLocale() == 'fr' ? 'À venir' : 'Upcoming' }}</span>
                                        @else
                                            <span class="badge badge-secondary" style="background:#6c757d;color:#fff;padding:4px 10px;border-radius:4px;">{{ app()->getLocale() == 'fr' ? 'Évènement passé' : 'Past event' }}</span>
                                        @endif
                                    </li>
                                </ul>
                            </div>

                            <h3>{{ app()->getLocale() == 'fr' ? $atelier->title_fr: $atelier->title_en }}</h3>

                            <p>
                            	<?= app()->getLocale() == 'fr' ? $atelier->description_fr: $atelier->description_en; ?>
                            </p>

                        </div>

                        <div class="article-footer">

                            <div class="article-share">
                                @php $shareUrl = urlencode(url()->current()); $shareTitle = urlencode(app()->getLocale() == 'fr' ? $atelier->title_fr : $atelier->title_en); @endphp
                                <ul class="social">
                                    <li><span>{{ app()->getLocale() == 'fr' ? 'Partager': 'Share' }}:</span></li>
                                    <li><a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener" title="Partager sur Facebook"><i class="fi fi-brands-facebook"></i></a></li>
                                    <li><a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}" target="_blank" rel="noopener" title="Partager sur LinkedIn"><i class="fi fi-brands-linkedin"></i></a></li>
                                    <li><a href="https://wa.me/?text={{ $shareTitle }}%20{{ $shareUrl }}" target="_blank" rel="noopener" title="Partager sur WhatsApp"><i class="fi fi-brands-whatsapp"></i></a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <aside class="widget-area" id="secondary">
                        <section class="widget widget_pearo_posts_thumb">
                            <h3 class="widget-title">{{ app()->getLocale() == 'fr' ? 'Évènements à venir': 'Upcoming events' }}</h3>

                            @forelse( $ateliers as $b )
	                            <article class="item">
	                                <a href="{{ route('detail-atelier', $b->slug) }}" class="thumb">
	                                	<?php if ($b->image != Null): ?>
                                         <span class="fullimage cover" style="background: url('/frontend/assets/images/ateliers/{{ $b->image }}');" role="img"></span>
                                       <?php endif ?>

	                                </a>
	                                <div class="info">
	                                    <time datetime="{{ $b->start }}">{{ $b->start ? date('d/m/Y', strtotime($b->start)) : '' }}</time>
	                                    <h4 class="title usmall"><a href="{{ route('detail-atelier', $b->slug) }}">{{ app()->getLocale() == 'fr' ? $b->title_fr: $b->title_en }}</a></h4>
	                                </div>

	                                <div class="clear"></div>
	                            </article>
                            @empty
                                <p>{{ app()->getLocale() == 'fr' ? 'Aucun évènement à venir pour le moment.': 'No upcoming events at the moment.' }}</p>
                            @endforelse
                        </section>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- End Blog Details Area -->
@endsection