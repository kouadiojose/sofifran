<?php $lang = app()->getLocale(); ?>

<!-- Start Header Area -->
<header class="header-area">

    <!-- Start Navbar Area -->
    <div class="navbar-area">
        <div class="pearo-responsive-nav">
            <div class="container">
                <div class="pearo-responsive-menu">
                    <div class="logo black-logo">
                        <a href="{{ route('index') }}">
                            <img src="/frontend/assets/images/logo-white.png" alt="logo">
                        </a>
                    </div>
                    <div class="logo white-logo">
                        <a href="{{ route('index') }}">
                            <img src="/frontend/assets/images/logo-white.png" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pearo-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand black-logo" href="{{ route('index') }}">
                        <img style="position: relative; left: -100px;" src="/frontend/assets/images/logo-white.png" alt="logo">
                    </a>
                    <a class="navbar-brand white-logo" href="{{ route('index') }}">
                        <img src="/frontend/assets/images/logo-white.png" alt="logo">
                    </a>

                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                            
                            <li class="nav-item"><a href="{{ route('index') }}" class="nav-link active">{{ app()->getLocale() == 'fr' ? 'Accueil': 'Home' }}</a></li>

                            <li class="nav-item"><a href="#" class="nav-link">{{ app()->getLocale() == 'fr' ? 'A Propos': 'About' }} <i class="flaticon-down-arrow"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Qui Sommes-nous ?': 'Who We Are ?' }}</a></li>
                                    <li class="nav-item"><a href="{{ route('team') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Notre Equipe': 'Our Team' }}</a></li>
                                    <li class="nav-item"><a href="{{ route('partenaires') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Nos Partenaires': 'Our Partners' }}</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a href="{{ route('activites') }}" class="nav-link"> {{ app()->getLocale() == 'fr' ? 'Activités': 'Activity' }}</a></li>
                            <li class="nav-item"><a href="#" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Projets': 'Projects' }} <i class="flaticon-down-arrow"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="{{ route('projets') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Projets en cours': 'Projects in progress' }}</a></li>
                                    <li class="nav-item"><a href="{{ route('projets-termines') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Projets Terminés': 'Completed Projects' }}</a></li>
                                </ul>
                            </li>
                            
                            <li class="nav-item"><a href="#" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Publication': 'Publish' }} <i class="flaticon-down-arrow"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="#" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Rapports': 'Reports' }}</a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item"><a href="{{ route('rapport_annuel') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Rapports annuels': 'Annual Report' }}</a></li>
                                            <li class="nav-item"><a href="{{ route('rapport_projet') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Rapports projets': 'Project Reports' }}</a></li>

                                        </ul>
                                    </li>
                                    

                                    <li class="nav-item"><a href="{{ route('communique') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Communiqués': 'News' }}</a></li>
                                    <li class="nav-item"><a href="{{ route('article_presse') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Articles de presse': 'Press articles' }}</a></li>
                                    <li class="nav-item"><a href="{{ route('infolettre') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Lettre Information': 'Infolettre' }}</a></li>
                                    <li class="nav-item"><a href="{{ route('compteEmbed1') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Recueil de Conte': 'Collection of Tales' }}</a></li>
                                    <li class="nav-item"><a href="{{ route('carrers') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Offres d\'emplois': 'Carrers' }}</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a href="#" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Médias': 'Medias' }} <i class="flaticon-down-arrow"></i></a>
                                <ul class="dropdown-menu">

                                    <li class="nav-item"><a href="#" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Galerie': 'Gallery' }}</a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item"><a href="{{ route('galerie-photo') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Photos': 'Pictures' }}</a></li>
                                            <li class="nav-item"><a href="{{ route('galerie-video') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Vidéos': 'Videos' }}</a></li>
                                        </ul>
                                    </li>

                                    <li class="nav-item"><a href="{{ route('blog') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Blogue-Actualités': 'Blog-News' }}</a></li>

                                </ul>
                            </li>
                            
                            
                            <li class="nav-item"><a href="#" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Contactez-nous': 'Contact-Us' }} <i class="flaticon-down-arrow"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Contactez': 'Contact' }}</a></li>

                                    <li class="nav-item"><a href="{{ route('engagez-vous') }}" class="nav-link">{{ app()->getLocale() == 'fr' ? 'Engagez-vous': 'Get involved' }}</a></li>

                                </ul>
                            </li>


                            <!--change Language-->
                            <li class="nav-item">
                                <a href="#" class="nav-link">{{ $lang == 'fr' ? "Fr" : "En" }} <i class="flaticon-down-arrow"></i></a>

                                <ul class="dropdown-menu">
                                    @if( $lang == 'fr')
                                    <li class="nav-item"><a href="{{ route('lang', 'en') }}" class="nav-link">En</a></li>
                                    @else
                                    <li class="nav-item"><a href="{{ route('lang', 'fr') }}" class="nav-link">Fr</a></li>
                                    @endif
                                </ul>
                            </li>
                            <!--End Change Language-->
                        </ul>

                        <div class="others-option">
                            <!-- Dark/Light Toggle -->
                            <div class="dark-version-btn">
                                <a href="https://www.safran.sofifran.org/" target="_blank">
                                    <img src="/frontend/assets/images/safran.jpg" width="70"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Navbar Area -->
</header>
<!-- End Header Area -->

<!-- Sidebar Modal -->
<div class="sidebar-modal">
    <div class="sidebar-modal-inner">
        <div class="sidebar-about-area">
            <div class="title">
                <h2>{{ app()->getLocale() == 'fr' ? 'A Propos': 'About' }}</h2>
                <p>SOFIFRAN est un organisme communautaire sans but lucratif, créé en 2007 par des femmes immigrantes francophones – vivant dans la région du Niagara et originaires de diverses parties du monde.</p>
            </div>
        </div>

        

        <div class="sidebar-contact-area">
            <div class="sidebar-contact-info">
                <div class="contact-info-content">
                    <h2>
                        @php $headerPhone = $setting->phone1 ?? '+1 (905) 714-7333'; @endphp
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $headerPhone) }}">{{ $headerPhone }}</a>
                        <span>OR</span>
                        <a href="mailto:{{ $setting->email ?? 'info@sofifran.org' }}">{{ $setting->email ?? 'info@sofifran.org' }}</a>
                    </h2>

                    <ul class="social">
                        @if(!empty($setting?->youtube))
                        <li><a href="{{ $setting->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                        @endif
                        @if(!empty($setting?->facebook))
                        <li><a href="{{ $setting->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                        @endif
                        @if(!empty($setting?->linkedln))
                        <li><a href="{{ $setting->linkedln }}" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
                        @endif
                        @if(!empty($setting?->instagram))
                        <li><a href="{{ $setting->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                        @endif
                        @if(!empty($setting?->twitter))
                        <li><a href="{{ $setting->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <span class="close-btn sidebar-modal-close-btn"><i class="flaticon-cross-out"></i></span>
    </div>
</div>
<!-- End Sidebar Modal -->