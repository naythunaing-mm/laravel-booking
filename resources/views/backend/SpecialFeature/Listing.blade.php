@extends('layouts.master')
@section('title','Admin::SpecialFeature Listing')
@section('content')
<div class="right_col" role="main">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Amenity Listing: <small>Amenity</small></h2>
        <ul class="nav navbar-right panel_toolbox"></ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-sm-12">
            <div class="card-box table-responsive">
              <p class="text-muted font-13 m-b-30">
                The following data are showing for Amenity.
              </p>

              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>SpecialFeature ID</th>
                    <th>SpecialFeature Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($feature_data as $feature)
                  <tr>
                    <td>{{ $feature->id }}</td>
                    <td>{{ $feature->name }}</td>
                    <td>
                    <a href="{{ URL::asset('admin-backend/feature/edit')}}/{{ $feature->id }}" class="btn btn-info btn-xs"><small><i class="fa fa-pencil"></i>Edit</small></a>
                    <a href="{{ URL::asset('admin-backend/feature/delete')}}/{{ $feature->id }}" onclick="return confirm('Are you sure you want to delete this SpecialFeature?');" class="btn btn-danger btn-xs"><small><i class="fa fa-trash-o"></i>Delete</small></a>
                    </td>
                </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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

</html>
@endsection