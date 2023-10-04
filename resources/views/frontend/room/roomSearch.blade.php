@extends('frontend.layouts.master')
@section('title', 'SoftGuide:: Avalable Rooms')
@section('content')
<section class="ftco-section ftco-no-pb ftco-room">
    <div class="container-fluid px-0">
        <div class="row no-gutters justify-content-center mb-5 pb-3">
      <div class="col-md-7 heading-section text-center ftco-animate">
          <span class="subheading"> Rooms</span>
        <h2 class="mb-4">Hotel Master's Rooms</h2>
      </div>
    </div>  
        <div class="row no-gutters">
            @if (count($rooms) >= 1)
                @php
                $room_count = 0;
                $room_line = 1;
            @endphp
            @foreach ($rooms as $room)
                @php $room_count++; @endphp
                @php
                    $class1 = ($room_line % 2 === 0) ? 'order-md-last' : '';
                    $class2 = ($room_line % 2 === 0) ? 'right-arrow' : 'left-arrow';
                    if ($room_count == 2) {
                            $room_line++;
                            $room_count = 0;
                    }
                    $detail_link = "detail/" . $room->id;
                @endphp
                <div class="col-lg-6">
                    <div class="room-wrap d-md-flex ftco-animate">
                        <img src="{{ URL::asset('assets/upload/'. $room->id . '/thumb/'. $room->thumbnail )}}" style="width:319px" alt="" class=" {{ $class1 }}">
                        {{-- <a href="#" class="img {{ $class1 }}" style="background-image: url({{ URL::asset('assets/upload/'. $room->id . '/thumb/'. $room->thumbnail )}});"></a> --}}
                        <div class="half  {{ $class2 }}  d-flex align-items-center">
                            <div class="text p-4 text-center">
                                <p class="star mb-0"><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span><span class="ion-ios-star"></span></p>
                                <p class="mb-0"><span class="price mr-1">{{ $room->price_per_day }} {{ (getsiteconfig() !== '')? getsiteconfig()->price_unit : '' }}</span> <span class="per">per night</span></p>
                                <h3 class="mb-3"><a href="">{{ $room->name }}</a></h3>
                                <p class="pt-1"><a href="{{ $detail_link }}" class="btn-custom px-3 py-2 rounded">View Details <span class="icon-long-arrow-right"></span></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif    
        </div>
    </div>
</section>
@endsection