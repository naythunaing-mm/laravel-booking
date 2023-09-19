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
                                <span class="section">Room Create</span>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Image<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <div id="preview-wrapper">
                                            <div class="vertical-center" style="display:none;" >
                                                <label class="file-choose" onclick="chooseFile()">Choose File</label>
                                            </div>
                                            <div class="" id="preview-img" style="" >
                                            <label for="" class="change-img" onclick="changePhoto()">Change Photo</label>
                                            <img src="{{ URL::asset('assets/upload/'. $editData->id . '/thumb/'. $editData->thumbnail ) }}?" alt="Existing Room Image" style="width:100%;" id="upload-img">
                                            </div>
                                            <input type="file" id="thumb-file" name="file" style="display:none" onchange="uploadPhoto()">
                                         </div> 
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="name">Name<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control room_name" name="name" placeholder="ex. Depluex" type="text" id="name" value="{{ old('name',isset($editData) ? $editData->name : '') }}" readonly/>
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  label-error hide" id="room-name-error"><span class="name-error-msg"></span></label>
                                </div>
                                
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align " for="occupancy">Occupancy <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control room_occupancy" type="text"  name="occupancy" id="occupancy" placeholder="ex. 2 or 3" value="{{ $editData->occupancy }}" readonly/>
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  occupancy-label-error hide" id="room-occupancy-error"><span class="occupancy-error-msg" style="color:red;"></span></label>
                                </div>

                                <div class=" field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align " for="bed">Bed <span calss="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6">
                                        <select class="select2_group form-control room_bed" id="bed" name="bed">
                                        <option value=""> Choose Bed Type </option>  
                                        @foreach ($roomBed as $bed)
                                         <option value="{{ $bed->id }}" {{ (old('bed_id',isset($editData) ? $editData->bed_id : '') == $bed->id) ? 'selected' : ''}} disabled />{{ $bed->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  bed-label-error hide"><span class="bed-error-msg" style="color:red;"></span></label>
								</div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="room_size">Room Size <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control room_size" type="text" name="size" id="room_size" data-validate-minmax="10,100"  placeholder="ex. 10 mm²" value="{{ old('size',isset($editData) ? $editData->size : '') }}" readonly/>
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3 size-label-error hide"><span class="size-error-msg" style="color:red;"></span></label>
                                </div>

                                <div class=" field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align " for="view">View <span calss="required">*</span> </label>
                                    <div class="col-md-6 col-sm-6">
                                        <select class="select2_group form-control room_view"  name="view">
                                            <option value=""> Choose View </option>
                                            @foreach ($roomView as $view)
                                            <option value="{{ $view->id }}" {{ (old('view_id',isset($editData) ? $editData->view_id : '') == $view->id) ? 'selected' : ''}} disabled />{{ $view->name }}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  view-label-error hide" id="room-view-error"><span class="view-error-msg" style="color:red;"></span></label>
								</div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="price_per_day">Price Per Day <small>($)</small> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control room_price" type="text"  name="price" data-validate-minmax="10,100"  id="price_per_day" placeholder="ex. 30$" value="{{ $editData->price_per_day }}" readonly/>
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  price-label-error hide" id="room-price-error"><span class="price-error-msg" style="color:red;"></span></label>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="extra_price">Extra Bed Price Per Day <small>($)</small> <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control room_extra" type="text"  name="extraBed" data-validate-minmax="10,100" id="extra_price" placeholder="ex. 1.8$" value="{{ $editData->extra_bed_price}}" readonly/>
                                    </div>
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
                                                        <input type="checkbox" class="room_feature"  value="{{ $feature->id }}" name="specialfeature[]" {{ (is_array(old('specialfeature')) && in_array($feature->id, old('feature'))) || (isset($featureByRoomId) && is_array($featureByRoomId) && in_array($feature->id,$featureByRoomId)) ? 'checked': '' }} disabled/>{{ $feature->name }}
                                                    </label> 
                                                </div>
                                            </div>  
                                            @endforeach
                                        </div>
									</div>
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
                                                    <input type="checkbox" class="room_amenity" value="{{ $amenity->id }}" name="amenity[]"  {{ (is_array(old('amenity')) && in_array($amenity->id, old('amenity'))) || (isset($amenityByroomId) && is_array($amenityByroomId) && in_array($amenity->id,$amenityByroomId)) ? 'checked': '' }} disabled/>{{ $amenity->name }}
                                                </label>  
                                            </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  amenity-label-error hide" id="room-amenity-error"><span class="amenity-error-msg" style="color:red;"></span></label>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 label-align" for="room_detail">Room Details<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea class="form-control room_detail" rows="2" name="detail" id="room_detail" placeholder="ex. Room Details" readonly/>{{ $editData->detail }}</textarea>
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  detail-label-error hide" id="detail-name-error"><span class="detail-error-msg" style="color:red;"></span></label>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 label-align" for="description">Room Description<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea class="form-control room_des" rows="3" name="description" id="description" placeholder="ex. Room Description" readonly/>{{ $editData->description }}</textarea>
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  des-label-error hide" id="des-name-error"><span class="des-error-msg" style="color:red;"></span></label>
                                </div>
                                <div class="">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('layouts.partial.footer')
   
<script src="{{ URL::asset('assets/backend/js/pages/upload_img.js?v=20230802') }}"></script>
</html>