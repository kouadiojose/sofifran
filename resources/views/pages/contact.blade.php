@extends('layouts.frontend.template') 

@section('title', 'Contact')



@section('content')

   <!-- Start Page Title Area -->

    <div class="page-title-area page-title-bg3" @if(!empty($baniere) && $baniere->image) style="background-image: url('/frontend/assets/images/resource/{{ $baniere->image }}');" @endif>

        <div class="d-table">

            <div class="d-table-cell">

                <div class="container">

                    <div class="page-title-content">

                        <h2>Contact</h2>

                        <ul>

                            <li><a href="{{ route('index') }}">{{ app()->getLocale() == 'fr' ? 'Accueil': 'Home' }}</a></li>

                            <li>Contact</li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- End Page Title Area -->



    <!-- Start Contact Area -->

    <section class="contact-area ptb-100">

        <div class="container">

            <div class="section-title">

                <span class="sub-title"> {{ app()->getLocale() == 'fr' ? 'Contactez-nous' : 'Contact-Us' }} </span>

                <h2>{{ app()->getLocale() == 'fr' ? 'Envoyez-nous un message pour toute question' : 'Send us a message if you have any questions' }}</h2>

                <p>{{ app()->getLocale() == 'fr' ? 'Utilisez le formulaire de contact ci-dessous pour nous envoyer un courriel. Nous aimerions avoir de vos nouvelles.' : 'Please use the contact form below to send us an email. We would love to hear from you.' }}</p>

            </div>



            <div class="row">

                <div class="col-lg-6 col-md-12">

                    <div class="contact-form">

                        <form id="contactForm">

                            <div class="row">

                                <div class="col-lg-12 col-md-6">

                                    <div class="form-group">

                                        <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name" placeholder="{{ app()->getLocale() == 'fr' ? 'Nom Et Prénom(s)' : 'Full Name' }}">

                                        <div class="help-block with-errors"></div>

                                    </div>

                                </div>



                                <div class="col-lg-12 col-md-6">

                                    <div class="form-group">

                                        <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="{{ app()->getLocale() == 'fr' ? 'Email' : 'Email' }}">

                                        <div class="help-block with-errors"></div>

                                    </div>

                                </div>



                                <div class="col-lg-12 col-md-12">

                                    <div class="form-group">

                                        <input type="text" name="phone_number" id="phone_number" required data-error="Please enter your number" class="form-control" placeholder="{{ app()->getLocale() == 'fr' ? 'Téléphone' : 'Phone' }}">

                                        <div class="help-block with-errors"></div>

                                    </div>

                                </div>



                                <div class="col-lg-12 col-md-12">

                                    <div class="form-group">

                                        <textarea name="message" class="form-control" id="message" cols="30" rows="6" required data-error="Write your message" placeholder="{{ app()->getLocale() == 'fr' ? 'Votre message' : 'Your message' }}"></textarea>

                                        <div class="help-block with-errors"></div>

                                    </div>

                                </div>

                                <div class="col-lg-12 col-md-12">
                                    {{-- Honeypot --}}
                                    <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">

                                    {{-- CAPTCHA visuel --}}
                                    <div class="captcha mt-3">
                                        <img src="data:image/png;base64,{{ $captcha_image }}" alt="CAPTCHA">
                                    </div>

                                    <input class="form-control" type="text" name="captcha" id="captcha" placeholder="Entrez le code affiché" required>
                                </div>

                                <div class="col-lg-12 col-md-12">

                                    <button type="submit" class="default-btn">{{ app()->getLocale() == 'fr' ? 'Envoyez message' : 'Send message' }} <span></span></button>

                                    <div id="msgSubmit" class="h3 text-center hidden"></div>

                                    <div class="clearfix"></div>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>



                <div class="col-lg-6 col-md-12">

                    <div id="map">

                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2918.9529380335584!2d-79.24914412339614!3d42.97926499575697!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d349d518b29daf%3A0xaac0b03ae3915573!2s165%20Plymouth%20Rd%20%238%2C%20Welland%2C%20ON%20L3B%203E1%2C%20Canada!5e0!3m2!1sfr!2sci!4v1754932265835!5m2!1sfr!2sci" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                </div>

            </div>



            <div class="contact-info">

                <div class="contact-info-content">

                    <h3>{{ app()->getLocale() == 'fr' ? 'Contactez-nous par Téléphone ou par Email' : 'Contact us by phone or email' }}</h3>

                    <h2>

                        @php
                            $contactPhone = $setting->phone1 ?? '+1 (905) 226 5282';
                            $contactEmail = $setting->email ?? 'info@sofifran.org';
                        @endphp
                        <a href="tel:{{ preg_replace('/[^0-9+]/', '', $contactPhone) }}">{{ $contactPhone }}</a>

                        <span>OU</span>

                        <a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a>

                    </h2>



                    <ul class="social">

                        <li><a href="{{ $setting->facebook ?? '#' }}" target="_blank"><i class="fi fi-brands-facebook"></i></a></li>

                        <li><a href="{{ $setting->linkedln ?? '#' }}" target="_blank"><i class="fi fi-brands-linkedin"></i></a></li>

                        <li><a href="#" target="_blank"><i class="fi fi-brands-instagram"></i></a></li>

                    </ul>

                </div>

            </div>

        </div>

        

        <div class="bg-map"><img src="assets/img/bg-map.png" alt="image"></div>

    </section>

    <!-- End Contact Area -->



@endsection