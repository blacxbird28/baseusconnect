<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Baseus Connect</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"/>
    <link href="https://db.onlinewebfonts.com/c/04ecfd1f1a7d49f44bada96557206489?family=Owners+TRIAL+Wide" rel="stylesheet">

    @section('meta_tag_default')
      @include('layouts.frontend.meta-tag-default')
    @show

    @if (env('APP_ENV')!='prod')
      <!-- Scripts -->
      @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
      <link href="{{ asset('build/dist/app.css') }}" rel="stylesheet">
    @endif

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-PHGLL0SNWB"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-PHGLL0SNWB');
    </script>

    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [
        {
          "@type": "WebPage",
          "@id": "https://baseusconnect.id/",
          "url": "https://baseusconnect.id/",
          "name": "Baseus Meet N Run",
          "isPartOf": {
            "@id": "https://baseusconnect.id/#website"
          },
          "primaryImageOfPage": {
            "@id": "https://baseusconnect.id/#primaryimage"
          },
          "image": {
            "@id": "https://baseusconnect.id/#primaryimage"
          },
          "thumbnailUrl": "https://baseusconnect.id/public/images/main-banner.jpg",
          "datePublished": "2024-04-28T08:04:37+00:00",
          "dateModified": "2024-11-20T02:03:32+00:00",
          "description": "Baseus Meet N Run",
          "breadcrumb": {
            "@id": "https://baseusconnect.id/#breadcrumb"
          },
          "inLanguage": "en-US",
          "potentialAction": [
            {
              "@type": "ReadAction",
              "target": [
                "https://baseusconnect.id/"
              ]
            }
          ]
        },
        {
          "@type": "ImageObject",
          "inLanguage": "en-US",
          "@id": "https://baseusconnect.id/#primaryimage",
          "url": "https://baseusconnect.id/public/images/main-banner.jpg",
          "contentUrl": "https://baseusconnect.id/public/images/main-banner.jpg",
          "width": 800,
          "height": 640,
          "caption": "Baseus Meet N Run"
        }
      ]
    }
  </script>

  </head>
  <body class="font-sans antialiased">
    <div class="min-h-screen">
      <!-- Page Content -->
      @include('layouts.frontend.header')

      <main>
          @yield('content')
      </main>

      @include('layouts.frontend.footer')

      @include('components.popup-login')
      @include('components.popup-registration')

      @if(session('success_registration'))
        @include('components.popup-registration-success')
      @endif

      <div class="fixed bottom-2 right-[20px] animate-bounce z-2">
        <a href="https://wa.me/082125258709" target="_blank"><img src="{{ asset('images/icon-leo.png') }}" alt="whatsapp" class="w-[70px] md:w-[100px] transition duration-300 hover:scale-110"></a>
      </div>

      <div class="popup__overlay JS__popup-close fixed left-0 top-0 w-full h-full z-[49] bg-primary-black opacity-50 hide-overlay"></div>
    </div>

    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.13.0/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @if (env('APP_ENV')=='prod')
      <script src="{{ asset('build/dist/app2.js') }}"></script>
    @endif

    @yield('customscript')

    <script type="module">
      new WOW().init();

      jQuery(document).ready(function() {
        if(jQuery('#datepicker').length) {
          console.log('datepicker');

          jQuery("#datepicker, .datepicker").datepicker({
            dateFormat: 'yy-mm-dd',
            changeYear: true,
            yearRange: "1970:2012",
            defaultDate: new Date(2000, 0, 1), // January 1, 2000
            setDate: new Date(2000, 0, 1),
            maxDate: new Date(2012, 11, 31) // December 31, 2000
        });
        }
      });

    </script>
  </body>

</html>
