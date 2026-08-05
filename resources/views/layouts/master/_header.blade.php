@php $locale = session()->get('locale'); @endphp

<header class="main-header header-style-five">

    <div class="header-top-two">

        <div class="theme_container">

            <div class="header-top-two-wrapper-box">

                <div class="left-column">

                    <ul class="header-top-contact-info">

                        <li>

                            <p><a href="#">@lang('general.welcome')</a></p>

                        </li>

                    </ul>

                </div>

                <div class="right-column">

                    <div class="header-top-two-social-link">

                        <ul>

                            <li>

                              <a target="_blank" href="https://www.facebook.com/Sofifran-101320351789936/"><i class="fab fa-facebook-f"></i></a>

                          </li>

                          <li>

                              <a target="_blank" href="https://www.youtube.com/channel/UCI1RPtrZQAW24uoy3jQLrWQ"><i class="fab fa-youtube"></i></a>

                          </li>
                          <li>

                              <a target="_blank" href="https://twitter.com/sofifranniagara"><i class="fab fa-twitter"></i></a>

                          </li>
                          <li>

                              <a target="_blank" href="https://www.instagram.com/sofifran_niagara/"><i class="fab fa-instagram"></i></a>

                          </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="header-upper">

        <div class="header-container-box">

            <div class="inner-container">

                <div class="left-column">

                    <div class="logo" style="margin-top: 50px;">

                        <a href="{{ route('index') }}"><img width="" src="/assets/images/logo-light.png" alt="" /></a>

                    </div>

                    



                    <div class="nav-outer">

                        <div class="mobile-nav-toggler"><img src="/assets/images/icons/icon-bar2.png" alt="" /></div>

                        <nav class="main-menu navbar-expand-md navbar-light">

                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">

                                <ul class="navigation">

                                    <li><a href="{{ route('index') }}">@lang('menu.menu_home')</a></li>

                                    <li class="dropdown">

                                        <a href="#">@lang('menu.menu_about') <i class="fas fa-chevron-down"></i></a>

                                        <ul>

                                            <li><a href="{{ route('about') }}">@lang('menu.menu_historique') - @lang('menu.menu_mission_objectif')</a></li>

                                            <li><a href="{{ route('team') }}">@lang('menu.menu_team')</a></li>

                                        </ul>

                                    </li>

                                    <li class="dropdown">

                                        <a href="#" style="text-transform: uppercase;">@lang('menu.menu_activite') <i class="fas fa-chevron-down"></i></a>

                                        <ul>

                                            <li><a href="{{ route('activites') }}">@lang('menu.menu_activite')</a></li>

                                            <li><a href="{{ route('atelier') }}">@lang('menu.menu_atelier')</a></li>

                                        </ul>

                                    </li>

                                    <!--<li><a href="#">CALENDRIER</a></li>

                                    <li><a href="#">NOS PARTENAIRES</a></li>-->

                                    <li><a href="{{ route('projets') }}" style="text-transform: uppercase;">@lang('menu.menu_projet')</a></li>

                                    

                                    <li class="dropdown">

                                        <a href="#">@lang('menu.menu_media') <i class="fas fa-chevron-down"></i></a>

                                        <ul>

                                            <li><a href="{{ route('publication') }}">Publication</a></li>

                                            <li><a href="{{ route('galerie-photo') }}">@lang('menu.menu_galerie_photo')</a></li>

                                            <li><a href="{{ route('galerie-video') }}">@lang('menu.menu_galerie_video')</a></li>

                                            <li><a href="{{ route('blog') }}">@lang('menu.menu_blog_actualite') / @lang('menu.menu_presse')</a></li>

                                        </ul>

                                    </li>

                                    <li class="dropdown">

                                        <a href="#" style="text-transform: uppercase;">@lang('menu.menu_contact') <i class="fas fa-chevron-down"></i></a>

                                        <ul>

                                            <li><a href="{{ route('contact') }}">@lang('menu.menu_contact')</a></li>

                                            <li><a href="{{ route('engagez-vous') }}">@lang('engagez.title')</a></li>

                                        </ul>

                                    </li>

                                </ul>

                            </div>

                        </nav>

                    </div>

                    <div class="language">

                        <select onchange="window.location.href=this.value">

                            @if( $locale == 'fr')

                            <option value="" data-display="Francais">Francais</option>

                            <option value="{{ route('lang', 'en') }}">Anglais</option>

                            @elseif( $locale == 'en' )

                            <option data-display="English" value="">English</option>

                            <option value="{{ route('lang', 'fr') }}">French</option>

                            @else



                            <option value="1" data-display="Francais">Francais</option>

                            <option value="{{ route('lang', 'en') }}">Anglais</option>



                            @endif

                        </select>

                    </div>

                </div>

                <div class="right-column">

                    <div class="search-toggler"><i class="far fa-search"></i></div>

                    <!--<div class="menu-bar sidemenu-nav-toggler"><img src="assets/images/icons/icon-bar4.png" alt="" /></div><i class="far fa-lock"></i>-->

                    <a href="https://www.safran.sofifran.org/" target="_blank" class="primary_btn style-four">LE SAFRAN</a>

                </div>

            </div>

        </div>

    </div>



    <div class="sticky-header">

        <div class="header-upper">

            <div class="header-container-box">

                <div class="inner-container">

                    <div class="left-column">

                        <div class="logo">

                            <a href="{{ route('index') }}"><img style="margin-top: 50px !important;" width="" src="/assets/images/logo-light.png" alt="" /></a>

                        </div>

                        <div class="nav-outer">

                            <div class="mobile-nav-toggler"><img src="/assets/images/icons/icon-bar.png" alt="" /></div>

                            <nav class="main-menu navbar-expand-md navbar-light"></nav>

                            <div class="language">

                                <select onchange="window.location.href=this.value">

                                    @if( $locale == 'fr')

                                    <option value="" data-display="Francais">Francais</option>

                                    <option value="{{ route('lang', 'en') }}">Anglais</option>

                                    @elseif( $locale == 'en' )

                                    <option data-display="English" value="">English</option>

                                    <option value="{{ route('lang', 'fr') }}">French</option>

                                    @else



                                    <option value="1" data-display="Francais">Francais</option>

                                    <option value="{{ route('lang', 'en') }}">Anglais</option>



                                    @endif

                                </select>

                            </div>

                        </div>

                    </div>

                    <div class="right-column">

                        <div class="search-toggler"><i class="far fa-search"></i></div>

                        <div class="menu-bar sidemenu-nav-toggler"><img src="/assets/images/icons/icon-menu.png" alt="" /></div>

                        <a href="#" class="primary_btn style-seven">Login<i class="far fa-lock"></i></a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="mobile-menu">

        <div class="menu-backdrop"></div>

        <div class="close-btn"><i class="icon far fa-times"></i></div>

        <nav class="menu-box">

            <div class="nav-logo">

                <a href="{{ route('index') }}"><img src="/assets/images/logo-light.png" alt="" title="" /></a>

            </div>

            <div class="menu-outer"></div>

        </nav>

    </div>

    <div class="nav-overlay"></div>

</header>