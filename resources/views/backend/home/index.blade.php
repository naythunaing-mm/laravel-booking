@extends('layouts.master')
@section('title','Admin::Home Page')
@section('content')

  <div class="right_col" role="main">
    <!-- top tiles -->
    <div class="row" style="display: inline-block;" >
    <div class="tile_count">
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
        <div class="count">2500</div>
        <span class="count_bottom"><i class="green">4% </i> From last Week</span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-clock-o"></i> Average Time</span>
        <div class="count">123.50</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Males</span>
        <div class="count green">2,500</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Females</span>
        <div class="count">4,567</div>
        <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
        <div class="count">2,315</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
      </div>
      <div class="col-md-2 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
        <div class="count">7,325</div>
        <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
      </div>
    </div>
  </div>
          <!-- /top tiles -->
  <div class="row">
    <div class="col-md-12 col-sm-12 ">
    </div>
  </div>
  <br />
  </div>
        <!-- /page content -->
  <script src="{{ URL::asset('assets/backend/js/pages/upload_img.js?v=20230802') }}"></script>
  <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.js') }}"></script>
  <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.buttons.js') }}"></script>
  <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.nonblock.js') }}"></script>
  @if(session('success'))
      <script>
      new PNotify({
      title: 'Success',
      text: '{{ session()->get('success') }}',
      type: 'success',
      hide: false,
      styling: 'bootstrap3'
      }); 
      </script>";
  @endif
@endsection