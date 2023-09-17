@include('layouts.partial.header')
@yield('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Hotel Room room</h3>
            </div>
        </div>
        <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_content">
                            @if(isset($editData))
                            <form action="{{ route('RoomUpdate') }}" method="POST" id="form-create" enctype="multipart/form-data" >
                            @else
                            <form action="{{ route('RoomCreate') }}" method="POST" id="form-create" enctype="multipart/form-data" >
                            @endif
                                <span class="section">Room Create</span>
                                @csrf
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Image<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <div id="preview-wrapper">
                                            <div class="vertical-center" style="{{ isset($editData) ? "display:none;" : "" }}">
                                                <label class="file-choose" onclick="chooseFile()">Choose File</label>
                                            </div>
                                            <div class="" id="preview-img" style="{{ isset($editData) ? "" : "display:none;" }}" >
                                            <label for="" class="change-img" onclick="changePhoto()">Change Photo</label>
                                            @if(isset($editData))
                                            <img src="{{ URL::asset('assets/upload/'. $editData->id . '/thumb/'. $editData->thumbnail ) }}?" alt="Existing Room Image" style="width:100%;" id="upload-img">
                                            @else
                                            <img src="" alt="" id="upload-img">
                                            @endif
                                            </div>
                                            @if($errors->has('thumbnail'))
                                                <p style="color:red">{{ $errors->first('thumbnail') }}</p>
                                            @endif
                                            <input type="file" id="thumb-file" name="file" style="display:none" onchange="uploadPhoto()">
                                         </div> 
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="name">Name<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control room_name" name="name" placeholder="ex. Depluex" type="text" id="name" value="{{ old('name',isset($editData) ? $editData->name : '') }}" />
                                    </div>
                                    @if($errors->has('name'))
                                     <p style="color:red">{{ $errors->first('name') }}</p>
                                    @endif
                                    <label class="col-form-label col-md-3 col-sm-3  label-error hide" id="room-name-error"><span class="name-error-msg"></span></label>
                                </div>
                                
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align " for="occupancy">Occupancy <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control room_occupancy" type="text"  name="occupancy" id="occupancy" placeholder="ex. 2 or 3" value="{{ old('name',isset($editData) ? $editData->occupancy : '') }}" />
                                    </div>
                                    @if($errors->has('occupancy'))
                                     <p style="color:red">{{ $errors->first('occupancy') }}</p>
                                    @endif
                                    <label class="col-form-label col-md-3 col-sm-3  occupancy-label-error hide" id="room-occupancy-error"><span class="occupancy-error-msg" style="color:red;"></span></label>
                                </div>

                                <div class=" field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align " for="bed">Bed <span calss="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6">
                                        <select class="select2_group form-control room_bed" id="bed" name="bed">
                                        <option value=""> Choose Bed Type </option>  
                                        @foreach ($roomBed as $bed)
                                         <option value="{{ $bed->id }}" {{ (old('bed_id',isset($editData) ? $editData->bed_id : '') == $bed->id) ? 'selected' : ''}} >{{ $bed->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    @if($errors->has('bed'))
                                     <p style="color:red">{{ $errors->first('bed') }}</p>
                                    @endif
                                    <label class="col-form-label col-md-3 col-sm-3  bed-label-error hide"><span class="bed-error-msg" style="color:red;"></span></label>
								</div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="room_size">Room Size <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control room_size" type="text" name="size" id="room_size" data-validate-minmax="10,100"  placeholder="ex. 10 mm²" value="{{ old('size',isset($editData) ? $editData->size : '') }}" />
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3 size-label-error hide"><span class="size-error-msg" style="color:red;"></span></label>
                                    @if($errors->has('size'))
                                     <p style="color:red">{{ $errors->first('size') }}</p>
                                    @endif
                                </div>

                                <div class=" field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align " for="view">View <span calss="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6">
                                        <select class="select2_group form-control room_view"  name="view">
                                            <option value=""> Choose View </option>
                                            @foreach ($roomView as $view)
                                            <option value="{{ $view->id }}" {{ (old('view_id',isset($editData) ? $editData->view_id : '') == $view->id) ? 'selected' : ''}} >{{ $view->name }}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                    @if($errors->has('view'))
                                     <p style="color:red">{{ $errors->first('view') }}</p>
                                    @endif
                                    <label class="col-form-label col-md-3 col-sm-3  view-label-error hide" id="room-view-error"><span class="view-error-msg" style="color:red;"></span></label>
								</div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="price_per_day">Price Per Day <small>($)</small> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control room_price" type="text"  name="price" data-validate-minmax="10,100"  id="price_per_day" placeholder="ex. 30$" value="{{ old('size',isset($editData) ? $editData->price_per_day : '') }}" >
                                    </div>
                                    @if($errors->has('price'))
                                     <p style="color:red">{{ $errors->first('price') }}</p>
                                    @endif
                                    <label class="col-form-label col-md-3 col-sm-3  price-label-error hide" id="room-price-error"><span class="price-error-msg" style="color:red;"></span></label>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="extra_price">Extra Bed Price Per Day <small>($)</small> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control room_extra" type="text"  name="extraBed" data-validate-minmax="10,100" id="extra_price" placeholder="ex. 1.8$" value="{{ old('size',isset($editData) ? $editData->extra_bed_price : '') }}">
                                    </div>
                                    @if($errors->has('extraBed'))
                                     <p style="color:red">{{ $errors->first('extraBed') }}</p>
                                    @endif
                                    <label class="col-form-label col-md-3 col-sm-3  extra-label-error hide" id="room-extra-error"><span class="extra-error-msg" style="color:red;"></span></label>
                                </div>

                                <div class="form-group row">
									<label class="col-md-3 col-sm-3  label-align">Choose Special Feature <span class="required">*</span></label>
                                        <div class="col-md-6 col-sm-6 " >
                                        <div class="row">
                                            @foreach ($roomFeature as $feature)
                                            <div class="col-md-6">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" class="room_feature"  value="{{ $feature->id }}" name="specialfeature[]" {{ (is_array(old('specialfeature')) && in_array($feature->id, old('feature'))) || (isset($featureByRoomId) && is_array($featureByRoomId) && in_array($feature->id,$amenityByroomId)) ? 'checked': '' }}>{{ $feature->name }}
                                                    </label> 
                                                </div>
                                            </div>  
                                            @endforeach
                                        </div>
									</div>
                                    @if($errors->has('specialFeature'))
                                     <p style="color:red">{{ $errors->first('specialFeature') }}</p>
                                    @endif
                                    <label class="col-form-label col-md-3 col-sm-3  feature-label-error hide" id="feature-name-error"><span class="feature-error-msg" style="color:red;"></span></label>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-sm-3  label-align">Choose Amenities <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <div class="row">
                                            @foreach ($roomAmenity as $amenity )
                                            <div class="col-md-6">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="room_amenity" value="{{ $amenity->id }}" name="amenity[]"  {{ (is_array(old('amenity')) && in_array($amenity->id, old('amenity'))) || (isset($amenityByroomId) && is_array($amenityByroomId) && in_array($amenity->id,$amenityByroomId)) ? 'checked': '' }} >{{ $amenity->name }}
                                                </label>  
                                            </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @if($errors->has('amenity'))
                                     <p style="color:red">{{ $errors->first('amenity') }}</p>
                                    @endif
                                    <label class="col-form-label col-md-3 col-sm-3  amenity-label-error hide" id="room-amenity-error"><span class="amenity-error-msg" style="color:red;"></span></label>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 label-align" for="room_detail">Room Details<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea class="form-control room_detail" rows="2" name="detail" id="room_detail" placeholder="ex. Room Details" >{{ old('size',isset($editData) ? $editData->detail : '') }}</textarea>
                                    </div>
                                    @if($errors->has('detail'))
                                     <p style="color:red">{{ $errors->first('detail') }}</p>
                                    @endif
                                    <label class="col-form-label col-md-3 col-sm-3  detail-label-error hide" id="detail-name-error"><span class="detail-error-msg" style="color:red;"></span></label>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 label-align" for="description">Room Description<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea class="form-control room_des" rows="3" name="description" id="description" placeholder="ex. Room Description" >{{ old('size',isset($editData) ? $editData->description : '') }}</textarea>
                                    </div>
                                    @if($errors->has('description'))
                                     <p style="color:red">{{ $errors->first('description') }}</p>
                                    @endif
                                    <label class="col-form-label col-md-3 col-sm-3  des-label-error hide" id="des-name-error"><span class="des-error-msg" style="color:red;"></span></label>
                                </div>

                                <div class="">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type='button' class="btn btn-primary" id="submit-btn">Submit</button>
                                            <button type='button' class="btn btn-success" id="reset">Reset</button>
                                            @if(isset($editData))
                                            <input type="hidden" value="{{ $editData->id }}" name="id" >
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- /page content -->
        @include('layouts.partial.footer')
<script>
            
    $(document).ready(function(){
            $('#submit-btn').click(function(){
            
            let error              = false;
            const room_name        = $('.room_name').val();
            const room_occupancy   = $('.room_occupancy').val();
            const room_bed         = $('.room_bed').val();
            const room_size        = $('.room_size').val();
            const room_view        = $('.room_view').val();
            const room_price       = $('.room_price').val();
            const room_extra       = $('.room_extra').val();
            const room_detail      = $('.room_detail').val();
            const room_description = $('.room_des').val();
            const room_name_length = room_name.length;
            const room_amenities = $('input[name="amenity[]"]:checked').length;
            const room_features = $('input[name="specialfeature[]"]:checked').length;
            if(room_name  === ''){
                $('.name-error-msg').text('')
                $('.name-error-msg').text('Please fill Hotel Room name')
                $('.label-error').show()
                error = true
            } else {
                $('.label-error').hide()
            }
            if(room_occupancy  === ''){
                $('.occupancy-error-msg').text('')
                $('.occupancy-error-msg').text('Please fill Room Occupancy')
                $('.occupancy-label-error').show()
                error = true
            } else {
                $('.occupancy-label-error').hide()
            }
            if(room_bed  == ''){
                $('.bed-error-msg').text('')
                $('.bed-error-msg').text('Please fill Room Bed')
                $('.bed-label-error').show()
                error = true
            } else {
                $('.bed-label-error').hide()
            }
            if(room_size  == ''){
                $('.size-error-msg').text('')
                $('.size-error-msg').text('Please fill Room Size')
                $('.size-label-error').show()
                error = true
            } else {
                $('.size-label-error').hide()
            }
            if(room_view  == ''){
                $('.view-error-msg').text('')
                $('.view-error-msg').text('Please fill Room View')
                $('.view-label-error').show()
                error = true
            } else {
                $('.view-label-error').hide()
            }
            if(room_price  == ''){
                $('.price-error-msg').text('')
                $('.price-error-msg').text('Please fill Room Price Per Day')
                $('.price-label-error').show()
                error = true
            } else {
                $('.price-label-error').hide()
            }
            if(room_extra  == ''){
                $('.extra-error-msg').text('')
                $('.extra-error-msg').text('Please fill Extra Price Per Day')
                $('.extra-label-error').show()
                error = true
            } else {
                $('.extra-label-error').hide()
            }
            if (room_amenities === 0) {
            $('.amenity-label-error').show();
            error = true;
            } else {
                $('.amenity-label-error').hide();
            }

            if (room_amenities === 0) {
            $('.amenity-error-msg').text('Please select at least one Room Amenity.');
            $('.amenity-label-error').show();
            error = true;
            } else {
                $('.amenity-label-error').hide();
            }

            if (room_features === 0) {
                $('.feature-error-msg').text('Please select at least one Special Feature.');
                $('.feature-label-error').show();
                error = true;
            } else {
                $('.feature-label-error').hide();
            }

            if(room_detail  == ''){
                $('.deatil-error-msg').text('')
                $('.detail-error-msg').text('Please fill Room Detail')
                $('.detail-label-error').show()
                error = true
            } else {
                $('.detail-label-error').hide()
            }
            if(room_description  == ''){
                $('.des-error-msg').text('')
                $('.des-error-msg').text('Please fill Room Description')
                $('.des-label-error').show()
                error = true
            } else{
                $('.des-label-error').hide()
            }
          
            if(error === false){
                $('#form-create').submit();
            }
        })
        
        $('#reset').click(function(){
                $('.label-error').hide()
        }) 
    })


</script>
<script src="{{ URL::asset('assets/backend/js/pages/upload_img.js?v=20230802') }}"></script>
        <!-- /page content -->
 
        <!-- pnotify -->
   <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.js') }}"></script>
   <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.buttons.js') }}"></script>
   <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.nonblock.js') }}"></script>
   
  
</html>