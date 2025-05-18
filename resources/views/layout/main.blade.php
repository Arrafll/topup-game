<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="Multipurpose, super flexible, powerful, clean modern responsive bootstrap 5 admin template">
  <meta name="keywords"
    content="admin template, ra-admin admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="la-themes">
  <link rel="icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ asset('assets/images/logo/favicon.png') }}" type="image/x-icon">
  <title> {{ $title }} | KlikTopUp</title>

  <!-- Animation css -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/animation/animate.min.css') }}">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Golos+Text:wght@400..900&display=swap" rel="stylesheet">

  <!-- wheather icon css--> 
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/weather/weather-icons.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/weather/weather-icons-wind.css') }}">

  <!--flag Icon css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/flag-icons-master/flag-icon.css') }}">

  <!-- tabler icons-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/tabler-icons/tabler-icons.css') }}">

  <!-- prism css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/prism/prism.min.css') }}">

  <!-- apexcharts css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/apexcharts/apexcharts.css') }}">

  <!-- glight css -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/glightbox/glightbox.min.css') }}">

  <!-- slick css -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor/slick/slick-theme.css') }}">

  <!-- Data Table css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/datatable/jquery.dataTables.min.css') }}">

  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/bootstrap.min.css') }}">

  <!-- vector map css -->
  <link rel="stylesheet" href="{{ asset('assets/vendor/vector-map/jquery-jvectormap.css') }}">

  <!-- apexcharts css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/apexcharts/apexcharts.css') }}">

  <!-- simplebar css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/simplebar/simplebar.css') }}">

  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">

  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}">

</head>

<body>
  <div class="app-wrapper">

    <div class="loader-wrapper">
      <div class="loader_16"></div>
    </div>
    @include('layout.menubar')
    <!-- Body main section starts -->
    <div class="app-content">
      <div class="">
        @include('layout.header')
        @yield('content')
      </div>
    </div>
    <!-- Body main section ends -->

    
    <!-- tap on top -->
    <div class="go-top">
      <span class="progress-value">
        <i class="ti ti-arrow-up"></i>
      </span>
    </div>
      @include('layout.footer')
  </div>


</body>

</html>
