@extends('layouts.master')
@section('title','Admin::reservation Listing')
@section('content')
<style>
  .w-5 {
    display: none !important;
  }
</style>
<div class="right_col" role="main">
<div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>reservation Listing: <small>reservation</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                          <p class="text-muted font-13 m-b-30">
                            The following data are showing for reservation.
                          </p>

                          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                              <tr>
                                <th>ID</th>   
                                <th>Custmer</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Room</th>
                                <th>Checkin</th>
                                <th>Checkout</th>
                                <th>Extra Bed</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($reservations as $reservation)
                                <tr>
                                  <td>{{ $reservation->id }}</td>
                                  <td>{{ $reservation->customer_name }}</td>
                                  <td>{{ $reservation->email }} </td>
                                  <td>{{ $reservation->phone }}</td>
                                  <td>{{ $reservation->room_name }} </td>
                                  <td>{{ $reservation->checkin }}</td>
                                  <td>{{ $reservation->checkout }} </td>
                                  <td>
                                      @if($reservation->extra_bed == 0)
                                        <span class="bg-danger text-white rounded p-1">None</span>
                                      @else 
                                        <span class="bg-success text-white rounded p-1">Include</span>
                                      @endif
                                  </td>
                                  <td>{{ $reservation->total_price }} {{ getsiteconfig() !== null ? getsiteconfig()->price_unit : '' }}</td>
                                  <td> 
                                      @if($reservation->status == 0)
                                       <span class="bg-warning text-white rounded p-1">Pending</span> 
                                      @else
                                        <span class="bg-success text-white rounded p-1">Confirm</span>
                                      @endif
                                  </td>
                                  <td>
                                    @if($reservation->status == 1)
                                    <a href="{{ URL::to('admin-backend/reservation/delete') }}/{{ $reservation->id }}" class="btn btn-danger btn-xs"><small><i class="fa fa-trash-o"> Reject</i></small></a>
                                    @else
                                    <a href="{{ URL::to('admin-backend/reservation/confirm') }}/{{ $reservation->id }}" class="btn btn-primary btn-xs">Confirm</a>
                                    <a href="{{ URL::to('admin-backend/reservation/delete') }}/{{ $reservation->id }}" class="btn btn-danger btn-xs"><small><i class="fa fa-trash-o"> Reject</i></small></a>
                                    @endif     
                                  </td>
                              </tr>
                                @endforeach
                            </tbody>
                          </table>
                        </div>
                        <div>
                          {{  $reservations->links() }}
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
