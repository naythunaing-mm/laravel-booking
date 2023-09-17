
@include('layouts.partial.header')
@yield('content')

<div class="right_col" role="main">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>View Listing: <small>View</small></h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">
          <div class="col-sm-12">
            <div class="card-box table-responsive">
              <p class="text-muted font-13 m-b-30">
                The following data are showing for view.
              </p>

              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>View ID</th>
                    <th>View Name</th>
                    <th>Room</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($view_data as $view )
                    <tr>
                        <td>{{ $view->id }}</td>
                        <td>{{ $view->name }}</td>
                        <td>{{ getRoomByView($view) }}</td>
                        <td>
                        <a href="{{ URL::asset('admin-backend/view/edit')}}/{{ $view->id }}" class="btn btn-info btn-xs"><small><i class="fa fa-pencil"></i>Edit</small></a>
                        <a href="{{ URL::asset('admin-backend/view/delete')}}/{{ $view->id }}" onclick="return confirm('Are you sure you want to delete this View?');" class="btn btn-danger btn-xs"><small><i class="fa fa-trash-o"></i>Delete</small></a>
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

@include('layouts.partial.footer')
         <!-- pnotify -->
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