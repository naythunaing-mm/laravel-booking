
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="icon" href="" type="image/ico"/>

    <title>@yield('title')</title>

    <!-- data table  -->
    <link href="{{ URL::asset('assets/backend/css/data-table/jquery.dataTables.min.css') }}">
    <link href="{{ URL::asset('assets/backend/css/data-table/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/backend/css/data-table/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/backend/css/data-table/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/backend/css/data-table/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/backend/css/data-table/scroller.bootstrap.min.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{ URL::asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Font Awesome -->
    <!-- <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet"> -->
    <link href="{{ URL::asset('assets/backend/css/font-awesome/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ URL::asset('assets/backend/css/nprogress.css') }}" rel="stylesheet">
    <!-- <link href="../vendors/nprogress/nprogress.css" rel="stylesheet"> -->
    <!-- Animate.css -->
    <link href="{{ URL::asset('assets/backend/css/animate/animate.min.css') }}" rel="stylesheet">
    <!-- <link href="../vendors/animate.css/animate.min.css" rel="stylesheet"> -->

    <!-- bootstrap-progressbar -->
    <link href="{{ URL::asset('assets/backend/css/bootstrap-progress/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">

    <!-- PNotify -->
    <link href="{{ URL::asset('assets/backend/css/pnotify/pnotify.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/backend/css/pnotify/pnotify.buttons.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/backend/css/pnotify/pnotify.nonblock.css') }}" rel="stylesheet">
    <!-- JQVMap -->

    <!-- bootstrap-daterangepicker -->
    <link href="{{ URL::asset('assets/backend/css/daterangepicker.css') }}" rel="stylesheet">
    
    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('assets/backend/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/backend/css/backend.style.css?v=20230902') }}" rel="stylesheet">
    

 

    <!-- jQuery -->
    <script src="{{ URL::asset('assets/backend/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ URL::asset('assets/backend/js/bootstrap.bundle.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ URL::asset('assets/backend/js/fastclick/lib/fastclick.js') }}"></script>
    <!-- NProgress -->
    <script src="{{ URL::asset('assets/backend/js/nprogress/nprogress.js') }}"></script>
    <!-- Chart.js -->
    
    <!-- bootstrap-progressbar -->
    <script src="{{ URL::asset('assets/backend/js/bootstrap-progressbar.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ URL::asset('assets/backend/js/iCheck/icheck.min.js') }}"></script>
    <!-- Skycons -->

         <!-- pnotify -->
    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.buttons.js') }}"></script>
    <script src="{{ URL::asset('') }}assets/backend/css/pnotify/pnotify.nonblock.js"></script>

        <!-- data table  -->
     <script src="{{ URL::asset('assets/backend/js/data-table/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/js/data-table/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/js/data-table/dataTables.buttons.min.js') }}"></script>


  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        @include('layouts.partial.topnav')
        @include('layouts.partial.sidebar')
        
       
       