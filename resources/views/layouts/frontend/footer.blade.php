
        <!-- Start Footer Area -->
        <footer class="footer-area">
            <div class="container">
                <div class="subscribe-area" id="newsletter">
                    <div class="row align-items-center">
                        <div class="col-lg-5 col-md-12">
                            <div class="subscribe-content">
                                <h2>{{ app()->getLocale() == 'fr' ? 'Infolettre': 'Newsletter' }}</h2>
                                <p>{{ app()->getLocale() == 'fr' ? 'Inscrivez votre adresse email afin de recevoir toutes nos actualités en temps réel.': 'Enter your email address to receive all our news in real time.' }}</p>
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-12">
                            <div class="subscribe-form">
                                <form class="newsletter-form" action="{{ route('infolettre-subscribe') }}" method="POST">
                                    @csrf
                                    <input type="email" class="input-newsletter" placeholder="{{ app()->getLocale() == 'fr' ? 'Votre Email': 'Your Email Adress' }}..." name="email" required autocomplete="off">

                                    <button type="submit">{{ app()->getLocale() == 'fr' ? 'Souscrire': 'Subscribe' }} <i class="flaticon-right-chevron"></i></button>
                                    <div id="validator-newsletter" class="form-result">
                                        @if(session('newsletter_success'))
                                            <span style="color:#8bc34a;">{{ session('newsletter_success') }}</span>
                                        @endif
                                        @if(session('newsletter_error'))
                                            <span style="color:#ff5252;">{{ session('newsletter_error') }}</span>
                                        @endif
                                        @error('email')
                                            <span style="color:#ff5252;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <div class="logo">
                                <a href="{{ route('index') }}"><img src="/frontend/assets/images/logo-white.png" alt="image"></a>

                                <p>{{ app()->getLocale() == 'fr' ? 'SOFIFRAN est un organisme communautaire sans but lucratif, créé en 2007 par des femmes immigrantes francophones – vivant dans la région du Niagara et originaires de diverses parties du monde.': 'SOFIFRAN is a non-profit community organization created in 2007 by French-speaking immigrant women - living in the Niagara region and from various parts of the world.' }}</p>
                            </div>

                            <ul class="social">
                                @if(!empty($setting?->facebook))
                                <li><a href="{{ $setting->facebook }}" target="_blank"><i class="fi fi-brands-facebook"></i></a></li>
                                @endif
                                @if(!empty($setting?->linkedln))
                                <li><a href="{{ $setting->linkedln }}" target="_blank"><i class="fi fi-brands-linkedin"></i></a></li>
                                @endif
                                @if(!empty($setting?->instagram))
                                <li><a href="{{ $setting->instagram }}" target="_blank"><i class="fi fi-brands-instagram"></i></a></li>
                                @endif
                                @if(!empty($setting?->youtube))
                                <li><a href="{{ $setting->youtube }}" target="_blank"><i class="fi fi-brands-youtube"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-footer-widget">
                            <h3>{{ app()->getLocale() == 'fr' ? 'Liens Rapides': 'Quick Links' }}</h3>

                            <ul class="footer-quick-links">
                                <li><a href="{{ route('index') }}">{{ app()->getLocale() == 'fr' ? 'Accueil': 'Home' }}</a></li>
                                <li><a href="{{ route('team') }}">{{ app()->getLocale() == 'fr' ? 'Notre Equipe': 'Our Team' }}</a></li>
                                <li><a href="{{ route('about') }}">{{ app()->getLocale() == 'fr' ? 'A Propos': 'About' }}</a></li>
                                <li><a href="{{ route('infolettre') }}">{{ app()->getLocale() == 'fr' ? 'Lettre Information': 'Infolettre' }}</a></li>
                                <li><a href="{{ route('blog') }}">{{ app()->getLocale() == 'fr' ? 'Blogue': 'Blog' }}</a></li>
                                <li><a href="{{ route('engagez-vous') }}">{{ app()->getLocale() == 'fr' ? 'Engagez-vous': 'Get involved' }}</a></li>
                                <li><a href="{{ route('galerie-photo') }}">{{ app()->getLocale() == 'fr' ? 'Galérie Photos': 'Pictures Gallery' }}</a></li>
                                <li><a href="{{ route('projets') }}">{{ app()->getLocale() == 'fr' ? 'Projets': 'Projects' }}</a></li>
                                <li><a href="{{ route('contact') }}">Contact</a></li>
                                <li><a href="{{ route('carrers') }}">{{ app()->getLocale() == 'fr' ? 'Offres d\'emplois': 'Carrers' }}</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-0 offset-sm-3 offset-md-3">
                        <div class="single-footer-widget">
                            <h3>{{ app()->getLocale() == 'fr' ? 'Contact Info': 'Contact Info' }}</h3>

                            @php
                                $footerAddress = $setting->adresse1 ?? '8-165 Plymouth Rd, Welland, ON, L3B 3E1';
                                $footerEmail   = $setting->email ?? 'info@sofifran.org';
                                $footerPhone   = $setting->phone1 ?? '+1 (905) 714-7333';
                                $footerFax     = $setting->phone2 ?? '+1 (905)-226-5282';
                            @endphp
                            <ul class="footer-contact-info">
                                <li><span>{{ app()->getLocale() == 'fr' ? 'Adresse': 'Location' }}:</span> {{ $footerAddress }}</li>
                                <li><span>Email:</span> <a href="mailto:{{ $footerEmail }}">{{ $footerEmail }}</a></li>
                                <li><span>{{ app()->getLocale() == 'fr' ? 'Téléphone': 'Phone' }}:</span> <a href="tel:{{ preg_replace('/[^0-9+]/', '', $footerPhone) }}">{{ $footerPhone }}</a></li>
                                <li><span>Fax:</span> <a href="tel:{{ preg_replace('/[^0-9+]/', '', $footerFax) }}">{{ $footerFax }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="copyright-area">
                    <div class="row align-items-center">
                        <div class="col-lg-6 col-sm-6 col-md-6">
                            <p>© {{ date('Y') }} Sofifran. {{ app()->getLocale() == 'fr' ? 'Tout Droit reservé par': 'All rights reserved by' }} <a href="https://markel-tech.com/" target="_blank">Markel Technology</a></p>
                        </div>

                        <div class="col-lg-6 col-sm-6 col-md-6">
                            <ul>
                                <li><a href="#">{{ app()->getLocale() == 'fr' ? 'Politique de confidentialité': 'Privacy Policy' }}</a></li>
                                <li><a href="#">{{ app()->getLocale() == 'fr' ? 'Conditions générales d\'utilisation': 'Terms & Conditions' }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End Footer Area -->
        
        <div class="go-top"><i class="fi fi-br-angle-up"></i><i class="fi fi-br-angle-up"></i></div>