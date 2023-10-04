@extends('layouts.master')
@section('title','Admin::Room Listing')
@section('content')

<div class="right_col" role="main">
<div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Room Listing: <small>Room</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                          <p class="text-muted font-13 m-b-30">
                            The following data are showing for room.
                          </p>

                          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Occupancy</th>
                                <th>Bed</th>
                                <th>Size</th>
                                <th>View</th>
                                <th>Price</th>
                                <th>Extra Bed</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($room_data as $room)
                                <tr>
                                  <td>{{ $room->id }}</td>
                                  <td>{{ $room->name }}</td>
                                  <td>{{ $room->occupancy }} {{ getsiteconfig() !== null ? getsiteconfig()->occupancy : '' }}</td>
                                  <td>{{ $room->bed_name }}</td>
                                  <td>{{ $room->size }} {{ getsiteconfig() !== null ? getsiteconfig()->size_unit : '' }}</td>
                                  <td>{{ $room->view_name }}</td>
                                  <td>{{ $room->price_per_day }} {{ getsiteconfig() !== null ? getsiteconfig()->price_unit : '' }}</td>
                                  <td>{{ $room->extra_bed_price }} {{ getsiteconfig() !== null ? getsiteconfig()->price_unit : '' }}</td>
                                  <td>
                                      <a href="{{ URL::to('admin-backend/room/room-gallery') }}/{{ $room->id }}" class="btn btn-success btn-xs"><small><i class="fa fa-photo"> Gallery</i></small></a>
                                      <a href="{{ URL::to('admin-backend/room/detail') }}/{{ $room->id }}" class="btn btn-primary btn-xs"><i class="fa fa-eye"> View</i></a>
                                      <a href="{{ URL::to('admin-backend/room/edit') }}/{{ $room->id }}" class="btn btn-info btn-xs"><small><i class="fa fa-pencil"> Edit</i></small></a>
                                      <a href="{{ URL::to('admin-backend/room/delete') }}/{{ $room->id }}" class="btn btn-danger btn-xs"><small><i class="fa fa-trash-o"> Delete</i></small></a>
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
