@extends('layouts.master')
@section('title','Admin::View Create')
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
                            @if(isset($view_data))
                            <form action="{{ route('viewUpdate') }}" method="POST" id="form-create" >
                            @else
                            <form action="{{ route('viewCreate') }}" method="POST" id="form-create" >
                            @endif
                            @csrf
                                <span class="section">View Create</span>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align" for="name" >Name<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input class="form-control name" name="name"id="name" placeholder="ex. View Lake" type="text" value="{{ old('name',(isset($view_data))? $view_data->name : '') }}" />
                                    </div>
                                    <label class="col-form-label col-md-3 col-sm-3  label-error hide" id="name-error"><span class="name-error-msg"></span></label>
                                    @if($errors->has('name'))
                                     <p style="color:red">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>  
                                <div class="">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type='button' class="btn btn-primary" id="submit-btn">Submit</button>
                                            <button type='reset' class="btn btn-success" id="reset">Reset</button>
                                            @if(isset($view_data))
                                                <input type="hidden" name="id" value="{{ $view_data->id }}">
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
                let error              = false
                const name        = $('.name').val();
                const name_length = name.length;
                if(name  == ''){
                    $('.name-error-msg').text('')
                    $('.name-error-msg').text('Please fill hotel room view name')
                    $('.label-error').show()
                    error     = true
                } else {
                    $('.label-error').hide()
                }
                if(name != '' && name_length <3){
                    $('.name-error-msg').text('')
                    $('.name-error-msg').text('Name length is at least must be greather then three ')
                    $('.label-error').show()
                    error     = true
                }
                if(name != '' && name_length > 30){
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

    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.buttons.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.nonblock.js') }}"></script>
    
</html>
@endsection