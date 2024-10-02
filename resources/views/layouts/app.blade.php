<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <title>Home - News</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="{{url('front/img/favicon.ico')}}" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="{{url('https://fonts.gstatic.com')}}" />
    <link
      href="{{url('https://fonts.googleapis.com/css2?family=Handlee&family=Nunito&display=swap')}}"
      rel="stylesheet"
    />

    <!-- Font Awesome -->
    <link
      href="{{url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css')}}"
      rel="stylesheet"
    />

    <!-- Flaticon Font -->
    <link href="{{url('front/lib/flaticon/font/flaticon.css')}}" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="{{url('front/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet" />
    <link href="{{url('front/lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{url('front/css/style.css')}}" rel="stylesheet" />
    @yield('style')
  </head>

  <body>
    @include('layouts.header')

    @yield('content')

    @include('layouts.footer')

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary p-3 back-to-top"
      ><i class="fa fa-angle-double-up"></i
    ></a>

    <!-- JavaScript Libraries -->
    <script src="{{url('https://code.jquery.com/jquery-3.4.1.min.js')}}"></script>
    <script src="{{url('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{url('front/lib/easing/easing.min.js')}}"></script>
    <script src="{{url('front/lib/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{url('front/lib/isotope/isotope.pkgd.min.js')}}"></script>
    <script src="{{url('front/lib/lightbox/js/lightbox.min.js')}}"></script>


    <script src="{{url('front/js/main.js')}}"></script>

    @yield('sript')
  </body>
</html>
