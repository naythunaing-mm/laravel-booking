@extends('layouts.master')
@section('title','Admin::Room Gallery')
@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Hotel Room Gallery</h3>
            </div>
        </div>
        <div class="clearfix"></div>
       
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_content">
                            @if(isset($roomGalleries) && count($roomGalleries) >0 && !isset($roomGallery) )
                            <div class="row">
                                @foreach ($roomGalleries as $roomGallery)
                                <div class="col-md-3">
                                    <div class="img-wrapper">
                                        <img src="{{ isset($roomGallery) ? URL::asset('assets/upload') .'/'. $id .'/'. $roomGallery->image : '' }}" alt="" style="width:100%;">
                                    </div>
                                    <div class="btn-wrapper">
                                        <a href="{{ URL::to('admin-backend/room/room-gallery/edit') }}/{{ $roomGallery->id }}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                                        <a href="{{ URL::to('admin-backend/room/room-gallery/delete') }}/{{ $roomGallery->id }}"  onclick="return confirm('Are you sure you want to delete this image?');" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                            </div>
                            <div style="height:20px;"></div>
                            @if(isset($roomGalleries))
                            <form action="{{ route('roomGallery') }}" method="POST" id="form-create" enctype="multipart/form-data" >
                            @else
                            <form action="{{ route('updateGallery') }}" method="POST" id="form-create" enctype="multipart/form-data" >
                                <input type="hidden" name="id" value={{ $gallery->id }}>
                            @endif
                                @csrf
                                <span class="section">Room Gallery</span>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Upload Image<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <div id="preview-wrapper">
                                            <div class="vertical-center" style="{{ isset($roomGalleries) ? "" : "display:none;" }}" >
                                                <label class="file-choose" onclick="chooseFile()">Choose File</label>
                                            </div>
                                            <div class="" id="preview-img" style="{{ isset($roomGalleries) ? "display:none;" : "" }}" >
                                            <label for="" class="change-img" onclick="changePhoto()">Change Photo</label>
                                            @if(isset($roomGalleries))
                                            <img src="" alt="" id="upload-img">
                                            @else
                                            <img src="{{ URL::asset('assets/upload/'. $gallery->room_id . '/'. $gallery->image ) }}?" alt="Existing Room Image" style="width:100%;" id="upload-img">
                                            @endif
                                            </div>
                                            <input type="file" id="thumb-file" name="file" style="display:none" onchange="uploadPhoto()">
                                         </div> 
                                    </div>
                                </div><hr>

                                <div class="">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            <button type='submit' class="btn btn-primary" id="submit-btn">Upload</button>
                                            <button type='reset' class="btn btn-success" id="reset">Reset</button>
                                            @if(isset($roomGalleries))
                                            <input type="hidden" name="id" value="{{ $id }}">
                                            @else
                                            <input type="hidden" name="room_id" value={{ $gallery->room_id }}>
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

        <script src="{{ URL::asset('assets/backend/js/pages/upload_img.js?v=20230802') }}"></script>
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