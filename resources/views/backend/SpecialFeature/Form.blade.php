@extends('layouts.master')
@section('title','Admin::SpecialFeature Create')
@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Feature</h3>
            </div>
        </div>
        <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_content">
                            @if(isset($Feature_data))
                            <form action="{{ route('FeatureUpdate') }}" method="POST" id="form-create" >
                            @else
                            <form action="{{ route('FeatureCreate') }}" method="POST" id="form-create" >
                            @endif
                            @csrf
                                <span class="section">Feature Create</span>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align" for="name">Feature Name<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                @if(isset($Feature_data))
                                                <input class="form-control Feature_name" name="name" placeholder="ex. Swimming Pool" type="text" id="name" value="{{ $Feature_data->name }}"/>
                                                @else
                                                <input class="form-control Feature_name" name="name" placeholder="ex. Swimming Pool" type="text" id="name"/>
                                                @endif
                                            </div>
                                        <label class="col-form-label col-md-3 col-sm-3  label-error hide" id="Feature-name-error"><span class="name-error-msg"></span></label>
                                    </div>
                                    
                                <div class="">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type='submit' class="btn btn-primary" id="submit-btn">Submit</button>
                                            <button type='reset' class="btn btn-success" id="reset">Reset</button>
                                            <input type="hidden" name="form-sub" value="1" />
                                            @if (isset($Feature_data))
                                                <input type="hidden" value="{{ $Feature_data->id }}" name="id">
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
     
    <script>
        $(document).ready(function(){
            $('#submit-btn').click(function(){
                let error                 = false
                const Feature_name        = $('.Feature_name').val();
                const Feature_name_length = Feature_name.length;
                const Feature_type        = $('.Feature_type').find(":selected").val();
                if(Feature_name  === ''){
                    $('.name-error-msg').text('')
                    $('.name-error-msg').text('Please fill Feature name')
                    $('.label-error').show()
                    error     = true
                } else {
                    $('.label-error').hide()
                    error     = false
                }
                if(Feature_type === ''){
                    $('.type-error-msg').text('')
                    $('.type-error-msg').text('Please choose Feature type')
                    $('.type-label-error').show()
                    error       = true
                } else {
                    $('.type-label-error').hide()
                }
                if(Feature_name != '' && Feature_name_length <3){
                    $('.name-error-msg').text('')
                    $('.name-error-msg').text('Name length is at least must be greather then three ')
                    $('.label-error').show()
                    error     = true
                }
                if(Feature_name != '' && Feature_name_length > 30){
                    $('.name-error-msg').text('')
                    $('.name-error-msg').text('Name length is must be less then 30')
                    $('.label-error').show()
                    error     = true
                }
            
                if(error==false){
                    $('#form-create').submit();
                }
            })
            
            $('#reset').click(function(){
                    $('.label-error').hide()
            }) 
        })

    </script>

    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.buttons.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.nonblock.js') }}"></script>

</html>
@endsection