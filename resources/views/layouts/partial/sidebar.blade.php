
<div class="col-md-3 left_col ">
  <div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
      <a href="" class="site_title">
        {{ (getsiteconfig() !== '')? getsiteconfig()->name : '' }}
      </a>
    </div>
    <!-- menu profile quick info -->
    <div class="profile clearfix">
      <div class="profile_pic">
        <img src="{{ URL::asset('images')}}/{{ (getsiteconfig() !== '')? getsiteconfig()->logo : '' }}
        " alt="..." class="img-circle profile_img" style="width:50px;">
        </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2>
            {{ Auth::guard('Admin')->user()->name }}
        </h2>
      </div>
    </div>
    <!-- /menu profile quick info -->
    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" >
      <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
          <li><a href="{{ route('index') }}"><i class="fa fa-home"></i>Home</a></li>
              
          <li><a><i class="fa fa-laptop"></i>View<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{ route('ViewForm') }}">Create</a></li>
                <li><a href="{{ route('viewListing') }}">Listing</a></li>
              </ul>
          </li>

          <li><a><i class="fa fa-edit"></i>Bed<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{ route('BedForm') }}">Create</a></li>
                <li><a href="{{ route('BedListing') }}">Listing</a></li>
              </ul>
          </li>

          <li><a><i class="fa fa-bank"></i> Amenities<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{ route('AmenityForm')}}">Create</a></li>
                <li><a href="{{ route('AmenityListing') }}">Listing</a></li>
              </ul>
            </li>

          <li><a><i class="fa fa-beer"></i>Special Feature<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{ route('FeatureForm') }}">Create</a></li>
                <li><a href="{{ route('FeatureListing') }}">Listing</a></li>
              </ul>
            </li>
            
          <li><a><i class="fa fa-dashboard"></i> Room<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{ route('RoomForm') }}">Create</a></li>
                <li><a href="{{ route('RoomListing') }}">Listing</a></li>
              </ul>
          </li>
            
          <li><a><i class="fa fa-edit"></i>Reservation<span class="fa fa-chevron-down"></span></a>
              <ul class="nav child_menu">
                <li><a href="{{ URL::to('admin-backend/reservation/listing') }}">Listing</a></li>
              </ul>
          </li>
          
          <li>
            <a href="{{ URL::to('admin-backend/sitesetting') }}"><i class="fa fa-home"></i>Site Setting</a>
          </li>
            
        </ul>
      </div>
    </div>
  </div>
</div>