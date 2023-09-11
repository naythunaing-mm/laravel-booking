@include('layouts.partial.header')
@yield('content')
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
                            <div class="row">
                                    <div class="col-md-3">
                                    <div class="img-wrapper">
                                        <img src="" alt="" style="width:100%;">
                                    </div>
                                    <div class="btn-wrapper">
                                        <a href="" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                                        <a href="" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div style="height:20px;"></div>
                            <form action="" method="POST" id="form-create" enctype="multipart/form-data" >
                                <span class="section">Room Gallery</span>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Upload Image<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <div id="preview-wrapper">
                                            <div class="vertical-center" >
                                                <label class="file-choose" onclick="chooseFile()">Choose File</label>
                                            </div>
                                            <div class="" id="preview-img" style="display:none;" >
                                            <label for="" class="change-img" onclick="changePhoto()">Change Photo</label>
                                                <img src="" alt="" id="upload-img">
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
                                            <input type="hidden" name="form-sub" value="1" />
                                            <input type="hidden" name="id" value="">
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
        <script src="{{ URL::asset('assets/backend/js/pages/upload_img.js?v=20230802') }}"></script>
        <!-- pnotify -->
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