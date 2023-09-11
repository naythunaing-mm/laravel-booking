@include('layouts.partial.header')
@yield('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Amenity</h3>
            </div>
        </div>
        <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_content">
                            @if(isset($amenity_data))
                            <form action="{{ route('AmenityUpdate') }}" method="POST" id="form-create" >
                            @else
                            <form action="{{ route('AmenityCreate') }}" method="POST" id="form-create" >
                            @endif
                            @csrf
                                <span class="section">Amenity Create</span>
                                    <div class="field item form-group">
                                        <label class="col-form-label col-md-3 col-sm-3  label-align" for="name">Amenity Name<span class="required">*</span></label>
                                            <div class="col-md-6 col-sm-6">
                                                @if(isset($amenity_data))
                                                <input class="form-control amenity_name" name="name" placeholder="ex. Swimming Pool" type="text" id="name" value="{{ $amenity_data->name }}"/>
                                                @else
                                                <input class="form-control amenity_name" name="name" placeholder="ex. Swimming Pool" type="text" id="name"/>
                                                @endif
                                            </div>
                                        <label class="col-form-label col-md-3 col-sm-3  label-error hide" id="amenity-name-error"><span class="name-error-msg"></span></label>
                                    </div>
                                
                                    <div class="form-group row">
                                        <label class="control-label col-md-3 col-sm-3 label-align">Amenity Type</label>
                                        <div class="col-md-6 col-sm-6">
                                            <select class="form-control amenity_type" name="type">
                                                <option value=""  {{ $amenity_type == '' ? 'selected' : '' }} disabled >-Choose Amenity Type-</option>
                                                @foreach ($amenity_type as $key => $value)
                                                @if(isset($amenity_data))
                                                    <option name="amenity_type" value="{{ $key }}" {{ $key == $amenity_data->type ? 'selected' : '' }}>
                                                    {{ $value }}</option>
                                                @else
                                                <option name="amenity_type" value="{{ $key }}" {{ old('type', $amenity_data->type ?? '') == $key ? 'selected' : '' }} >
                                                    {{ $value }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <label class="col-form-label col-md-3 col-sm-3 type-label-error hide" id="type-error-msg">
                                            <span class="type-error-msg" style="color:red;"></span>
                                        </label>
                                    </div>
                                    

                                <div class="">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type='submit' class="btn btn-primary" id="submit-btn">Submit</button>
                                            <button type='reset' class="btn btn-success" id="reset">Reset</button>
                                            <input type="hidden" name="form-sub" value="1" />
                                            @if (isset($amenity_data))
                                                <input type="hidden" value="{{ $amenity_data->id }}" name="id">
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
                let error                 = false
                const amenity_name        = $('.amenity_name').val();
                const amenity_name_length = amenity_name.length;
                const amenity_type        = $('.amenity_type').find(":selected").val();
                if(amenity_name  === ''){
                    $('.name-error-msg').text('')
                    $('.name-error-msg').text('Please fill amenity name')
                    $('.label-error').show()
                    error     = true
                } else {
                    $('.label-error').hide()
                    error     = false
                }
                if(amenity_type === ''){
                    $('.type-error-msg').text('')
                    $('.type-error-msg').text('Please choose amenity type')
                    $('.type-label-error').show()
                    error       = true
                } else {
                    $('.type-label-error').hide()
                }
                if(amenity_name != '' && amenity_name_length <3){
                    $('.name-error-msg').text('')
                    $('.name-error-msg').text('Name length is at least must be greather then three ')
                    $('.label-error').show()
                    error     = true
                }
                if(amenity_name != '' && amenity_name_length > 30){
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
         <!-- pnotify -->
        
         <!-- pnotify -->
    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.buttons.js') }}"></script>
    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.nonblock.js') }}"></script>

</html>