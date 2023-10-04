@extends('layouts.master')
@section('title','Admin::Setting')
@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Hotel Room View</h3>
            </div>
        </div>
        <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_content">
                            @if(isset($editData))
                            <form action="{{ route('SettingUpdate') }}" method="POST" id="form-create" enctype="multipart/form-data" >
                            <input type="hidden" name="id" value="{{ $editData->id }}">
                            @endif
                                @csrf
                                <span class="section">Site Setting</span>

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
                                            <img src="{{ URL::asset('images/'. '/' .$editData->logo)}}" alt="Existing Room Image" style="width:100%;" id="upload-img">
                                            @else
                                            <img src="" alt="" id="upload-img">
                                            @endif
                                            </div>
                                            @if($errors->has('logo'))
                                                <p style="color:red">{{ $errors->first('logo') }}</p>
                                            @endif
                                            <input type="file" id="thumb-file" name="file" style="display:none" onchange="uploadPhoto()">
                                         </div> 
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="name">Web Site Name<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control name" name="name" placeholder="Please Fill Name" type="text" id="name" value="{{ $editData->name }}" />
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  label-error hide" id="name-error"><span class="error-msg"></span></label>
                                </div>  

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="email">Email<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control email" name="email" placeholder="example@gmail.com" type="email" id="email" value="{{ $editData->email }}"/>
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  label-error hide" id="email-error"><span class="error-msg"></span></label>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3 col-sm-3 label-align" for="address">Address<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <textarea class="form-control address" rows="2" name="address" id="address" placeholder="Please Fill Address">{{ $editData->address }}</textarea>
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  address-label-error hide" id="address-name-error"><span class="address-error-msg" style="color:red;"></span></label>
                                </div>

                                <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 label-align" for="checkin">Checkin Time<span class="required">*</span>
                                    </label>
                                    <div class='input-group date col-md-6 col-sm-6' id='checkin'>
                                        <input type='text' class="form-control" name="checkin" value="{{ $editData->checkin }}" />
                                        <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3 label-align" for="checkin">Checkout Time<span class="required">*</span>
                                    </label>
                                    <div class='input-group date col-md-6 col-sm-6' id='checkout'>
                                        <input type='text' class="form-control" name="checkout" value="{{ $editData->checkout }}" />
                                        <span class="input-group-addon">
                                        <span class="fa fa-calendar"></span>
                                        </span>
                                    </div>
                                </div>

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="online">Online Phone<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control name" name="online_phone" placeholder="+95 XXXX XXX XXXX" type="text" id="online" value="{{ $editData->online_phone }}" />
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  label-error hide" id="online-error"><span class="online-error-msg"></span></label>
                                </div>  

                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="outline">Outline Phone<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control name" name="outline_phone" placeholder="+1 XXX XXXX" type="text" id="name" value="{{ $editData->outline_phone }}" />
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  label-error hide" id="outline-error"><span class="outline-error-msg"></span></label>
                                </div>  
                                
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="size-unit">Room Size Unit<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control unit" name="size_unit" placeholder="ex. mm²" type="text" id="size-unit"value="{{ $editData->size_unit }}"/>
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  label-error hide" id="unit-error"><span class="unit-error-msg"></span></label>
                                </div>  
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="people">Occupancy<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control name" name="occupancy" placeholder="ex. people" type="text" id="people" value="{{ $editData->occupancy }}"/>
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  label-error hide" id="people-error"><span class="people-error-msg"></span></label>
                                </div>  
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="price-unit">Price Unit<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control price_unit" name="price_unit" placeholder="ex. mmk" type="text" id="price-unit" value="{{ $editData->price_unit }}"/>
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  label-error hide" id="price-unit-error"><span class="price-uniterror-msg"></span></label>
                                </div>  

                                <div class="">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type='submit' class="btn btn-primary" id="submit-btn">Submit</button>
                                            <button type='reset' class="btn btn-success" id="reset">Reset</button>
                            
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
    <script src="{{ URL::asset('assets/backend/js/pages/upload_img.js?v=20230802') }}"></script>
    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.buttons.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.nonblock.js') }}"></script>
<script>
     $('#checkin').datetimepicker({
        format: 'hh:mm A'
     });

     $('#checkout').datetimepicker({
        format: 'hh:mm A'
     });

    $(document).ready(function(){
        $('#submit-btn').click(function(){
            let error              = false
            const view_name        = $('.view_name').val();
            const view_name_length = view_name.length;
            if(view_name  == ''){
                $('.name-error-msg').text('')
                $('.name-error-msg').text('Please fill hotel room view name')
                $('.label-error').show()
                error     = true
            } else {
                $('.label-error').hide()
            }
            if(view_name != '' && view_name_length <3){
                $('.name-error-msg').text('')
                $('.name-error-msg').text('Name length is at least must be greather then three ')
                $('.label-error').show()
                error     = true
            }
            if(view_name != '' && view_name_length > 30){
                $('.name-error-msg').text('')
                $('.name-error-msg').text('Name length is must be less then 30')
                $('.label-error').show()
                error     = true
            }
            if(error == false){
                $('#form-create').submit();
            }
        })
        
        $('#reset').click(function(){
                $('.label-error').hide()
        }) 
    })
</script>
</html>
@endsection