
<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="icon" href="{{ URL::asset('assets/watermark/sg.jpg') }}" type="image/ico"/>

    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700&display=swap" rel="stylesheet">

	<!-- datepicker  -->
	<link rel="stylesheet" href="{{ URL::asset('assets/Datepicker/jquery-ui.css') }}">
    <link href="{{ URL::asset('assets/backend/css/daterangepicker.css') }}" rel="stylesheet">
	
	<script src="{{ URL::asset('assets/Datepicker/jquery.js') }}"></script>
	<script src="{{ URL::asset('assets/Datepicker/jquery-ui.js') }}"></script>
	

    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/animate.css') }}">
    
    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/aos.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/jquery.timepicker.css') }}">

    
    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/frontend/css/style.css') }}">
	
	<link href="{{ URL::asset('assets/backend/css/pnotify/pnotify.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/backend/css/pnotify/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/backend/css/pnotify/pnotify.nonblock.css') }}" rel="stylesheet">
	
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="">
          {{ (getsiteconfig() !== '')? getsiteconfig()->name : '' }}
		  </a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
<ul class="navbar-nav ml-auto">
	<li class="nav-item {{ request()->is('/') ? 'active' : '' }}"><a href="{{ URL::to('/') }}" class="nav-link">Home</a></li>
	<li class="nav-item {{ request()->is('rooms') ? 'active' : '' }}"><a href="{{ URL::to('rooms') }}" class="nav-link">Our Rooms</a></li>
	<li class="nav-item {{ request()->is('about') ? 'active' : '' }}"><a href="{{ URL::to('about') }}" class="nav-link">About Us</a></li>
	<li class="nav-item {{ request()->is('contact') ? 'active' : '' }}"><a href="{{ URL::to('contact') }}" class="nav-link">Contact</a></li>
</ul>
	      </div>
	    </div>
	  </nav>
    <!-- END nav -->
		<div class="hero">
	    <section class="home-slider owl-carousel">
	      <div class="slider-item" style="background-image:url({{ URL::asset('assets/frontend/images/bg_1.jpg') }});">
	      	<div class="overlay"></div>
	        <div class="container">
	          <div class="row no-gutters slider-text align-items-center justify-content-end">
	          <div class="col-md-6 ftco-animate">
	          	<div class="text">
	          		<h2>More than a hotel... an experience</h2>
		            <h1 class="mb-3">{{ (getsiteconfig() !== '')? getsiteconfig()->name : '' }}</h1>
	            </div>
	          </div>
	        </div>
	        </div>
	      </div>
	      <div class="slider-item" style="background-image:url({{ URL::asset('assets/frontend/images/bg_2.jpg') }});">
	      	<div class="overlay"></div>
	        <div class="container">
	          <div class="row no-gutters slider-text align-items-center justify-content-end">
	          <div class="col-md-6 ftco-animate">
	          	<div class="text">
	          		<h2></h2>
		            <h1 class="mb-3">It feels like staying in your own home.</h1>
	            </div>
	          </div>
	        </div>
	        </div>
	      </div>
	    </section>
	  </div>
	