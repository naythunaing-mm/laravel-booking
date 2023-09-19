@extends('frontend.layouts.master')
@section('title', 'Admin::Home Page')

@section('content')
<section class="ftco-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="row">
                    @if($room->getBed() != null)
                    <div class="col-md-12 ftco-animate">
                        <div class="single-slider owl-carousel">
                            @foreach($room->getGallery as $gallery)
                            <div class="item">
                                <div class="room-img" style="background-image: url({{ URL::asset('assets/upload/'. $room->id . '/'. $gallery->image) }});"></div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="col-md-12 room-single mt-4 mb-5 ftco-animate">
                        <h2 class="mb-4">{{ $room->name }}<span> - {{ $room->occupancy }} Person(s) Affordable</span></h2>
                        <p>{{ $room->detail }}</p>
                        <div class="d-md-flex mt-5 mb-5">
                            <ul class="list">
                                <li><span>Occupancy:</span> {{ $room->occupancy }} {{ getsiteconfig() !== null ? getsiteconfig()->occupancy : '' }}</li>
                                <li><span>Size:</span> {{ $room->size }} {{ getsiteconfig() !== null ? getsiteconfig()->size_unit : '' }}</li>
                            </ul>
                            <ul class="list ml-md-5">
                                <li><span>View:</span> {{ $room->getView->name }} </li>
                                <li><span>Bed:</span> {{ $room->getBed->name }}</li>
                            </ul>
                            <ul class="list ml-md-5">
                                <li><span>Price per Day:</span> {{ $room->price_per_day }} {{ getsiteconfig() !== null ? getsiteconfig()->price_unit : '' }}</li>
                                <li><span>Extra Bed Price:</span> {{ $room->extra_bed_price}} {{ getsiteconfig() !== null ? getsiteconfig()->price_unit : '' }}</li>
                            </ul>
                        </div>
                        <p>{{ $room->description }}</p>
                    </div>
                    <a href="" class="btn btn-primary py-3 px-5">Booking</a>
                </div>
            </div>
            <div class="col-lg-4 sidebar ftco-animate pl-md-5">
                <div class="sidebar-box ftco-animate">
                    <div class="categories">
                        <h3>Amenities</h3>
                        @if(count($amenity_data) > 0)
                        @foreach($amenity_data as $amenity)
                        <li><a href="javascript:void(0)">{{ $amenity->name }}<span>(
                            @if($amenity->type == 0)
                                General
                            @elseif($amenity->type == 1)
                                Bathroom
                            @else
                                Others
                            @endif)</span></a></li>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="sidebar-box ftco-animate">
                    <div class="categories">
                        <h3>Facilities</h3>
                        @if(count($feature_data) > 0)
                        @foreach($feature_data as $feature)
                        <li><a href="javascript:void(0)">{{ $feature->name }}</a></li>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> <!-- .section -->
@endsection
