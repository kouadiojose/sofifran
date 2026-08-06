@extends('layouts.frontend.template') 
<?php
  if( app()->getLocale() == 'fr' ){
    $langue = 'Engagez-vous';
  }else{
    $langue = 'Engage yourself';
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
                      <h2>{{ app()->getLocale() == 'fr' ? 'Engagez-vous': 'Get involved' }}</h2>
                      <ul>
                          <li><a href="{{ route('index') }}">{{ app()->getLocale() == 'fr' ? 'Accueil': 'Home' }}</a></li>
                          <li>{{ app()->getLocale() == 'fr' ? 'Engagez-vous': 'Get involved' }}</li>
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
                <div class="col-lg-6 col-md-12">
                    <div class="content">
                        <h3>{{ app()->getLocale() == 'fr' ? 'Engagez-vous': 'Get involved' }}</h3>
                        <h1>{{ app()->getLocale() == 'fr' ? 'Ensemble, faisons le Changement': 'Together, let\'s make Change' }}</h1>
                        <p>
                          {{ app()->getLocale() == 'fr' ? 'Sofifran a besoin de volontaires pour son travail quotidien auprès de cette communauté, pour mettre en place le maximum de soutiens et de structures permettant la réussite de toutes les immigrations prometteuses. Nous sommes l\'unique association immigrante francophone de la région du Niagara, dédiée à l\'intégration et à l\'accompagnement de la population immigrante. Nous avons besoin de Vous. Engagez-vous auprès de nous pour nos actions et nos évènements. Participez aux activités et réseaux Sofifran, que vous soyez immigrant ou non. Grâce aux liens que nous tissons, nous construisons un avenir meilleur pour tous, un Niagara plus riche de sa diversité, et un Canada plus Grand.': 'Sofifran needs volunteers for his daily work with this community, to set up the maximum of support and structures allowing the success of all these promising immigrations. We are the only French -speaking immigrant association in the Niagara region, dedicated to integration and support for the immigrant population. We need you. Commit yourself to us for our actions and our events. Take part in Sofifran activities and networks, whether you are an immigrant or not. Thanks to the links we weave, we build a better future for everyone, a nigararic niagara of its diversity, and a larger Canada.' }}
                        </p>
                        
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="image text-center">
                        <img src="/frontend/assets/images/resource/Our_Mission.jpg" alt="image">
                    </div>
                </div>
            </div>
        </div>
      </div>
  </section>
@endsection
