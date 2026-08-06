<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
        <!-- Required meta tags -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        @php
          // Description : surchargeable par page via @section('meta_description'),
          // sinon description par defaut (~160 caracteres pour les moteurs).
          $defaultDescription = app()->getLocale() == 'fr'
              ? "SOFIFRAN – Solidarité des Femmes et Familles Interconnectées Francophones du Niagara. Organisme communautaire d'accompagnement des familles immigrantes francophones."
              : 'SOFIFRAN – Community organization supporting French-speaking immigrant women and families in the Niagara region since 2007.';
          $metaImage = url('/frontend/assets/images/logo-white.png');
        @endphp

        <meta name="description" content="@hasSection('meta_description')@yield('meta_description')@else{{ $defaultDescription }}@endif">

        {{-- Partage social (Open Graph / Twitter) --}}
        <meta property="og:site_name" content="Sofifran">
        <meta property="og:type" content="website">
        <meta property="og:title" content="Sofifran - @yield('title')">
        <meta property="og:description" content="@hasSection('meta_description')@yield('meta_description')@else{{ $defaultDescription }}@endif">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:image" content="@hasSection('meta_image')@yield('meta_image')@else{{ $metaImage }}@endif">
        <meta name="twitter:card" content="summary_large_image">

        <link rel="canonical" href="{{ url()->current() }}">

        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- All CSS Links -->
        <link rel="stylesheet" href="/frontend/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/frontend/assets/css/animate.min.css">
        <link rel="stylesheet" href="/frontend/assets/css/fontawesome.min.css">
        <link rel="stylesheet" href="/frontend/assets/css/flaticon.css">
        <link rel="stylesheet" href="/frontend/assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="/frontend/assets/css/slick.min.css">
        <link rel="stylesheet" href="/frontend/assets/css/meanmenu.css">
        <link rel="stylesheet" href="/frontend/assets/css/magnific-popup.min.css">
        <link rel="stylesheet" href="/frontend/assets/css/odometer.min.css">
        <link rel="stylesheet" href="/frontend/assets/css/nice-select.min.css">

        <link rel="stylesheet" type="text/css" href="https://cdn-uicons.flaticon.com/uicons-bold-rounded/css/uicons-bold-rounded.css">
        <link rel="stylesheet" href="https://cdn-uicons.flaticon.com/uicons-brands/css/uicons-brands.css">

        <link rel="stylesheet" href="/frontend/assets/css/style.css">
        <link rel="stylesheet" href="/frontend/assets/css/responsive.css">
        <link rel="stylesheet" href="/frontend/assets/css/dark-style.css">

        @yield('css')

        <title>Sofifran - @yield('title')</title>
        @php
          // Favicon : logo configure dans Admin > General, sinon logo local.
          $favicon = (!empty($setting?->logo) && file_exists(public_path('frontend/assets/images/' . $setting->logo)))
              ? '/frontend/assets/images/' . $setting->logo
              : '/frontend/assets/images/logo-white.png';
        @endphp
        <link rel="icon" type="image/png" href="{{ $favicon }}">
  </head>
  <body>
      <!-- Preloader 
      <div class="preloader">
          <div class="loader">
              <div class="shadow"></div>
              <div class="box"></div>
          </div>
      </div>-->
      <!-- End Preloader -->