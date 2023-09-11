
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> </title>

    <!-- Bootstrap -->
    <link href="{{ URL::asset('assets/backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <!-- <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet"> -->
    <link href="{{ URL::asset('assets/backend/css/font-awesome/font-awesome.min.css') }}" rel="stylesheet">

    <!-- Animate.css -->
    <link href="{{ URL::asset('assets/backend/css/animate/animate.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ URL::asset('assets/backend/css/custom.min.css')}}" rel="stylesheet">

     <!-- PNotify -->
     <link href="{{ URL::asset('assets/backend/css/pnotify/pnotify.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/backend/css/pnotify/pnotify.buttons.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('assets/backend/css/pnotify/pnotify.nonblock.css')}}" rel="stylesheet">

  </head>
  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form action="{{ route('postlogin') }}" method="POST" />
            @csrf
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" value="{{ old('name') }}"  name="name" />
              </div>
            @if($errors->has('name'))
                <p style="color:red">{{ $errors->first('name') }}</p>
            @endif
              <div>
                <input type="password" class="form-control" placeholder="Password" name="password" />
              </div>
            @if($errors->has('password'))
              <p style="color:red">{{ $errors->first('password') }}</p>
            @endif
              <div class="checkbox">
                <label for="remember">
                  <input type="checkbox" name="remember" id="remember" value="1" > Remember Me ?
                </label>
              </div>
              <div>
                <button type="submit" class="btn btn-secondary" name="submit" >Login</button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="javascript:void(0);" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />
              
                <div>
                  <h1><i class="fa fa-paw"></i> {{ (getsiteconfig() !== '')? getsiteconfig()->name : '' }}</h1>
                  <p>©2016 All Rights Reserved. {{ (getsiteconfig() !== '')? getsiteconfig()->name : '' }}! is a Bootstrap 4 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div>

      </div>
    </div>
    <!-- jQuery -->
    <script src="{{ URL::asset('assets/backend/jquery/jquery.min.js')}}"></scripjavascript:void>
        // <!-- pnotify -->
    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.js')}}"></script>
    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.buttons.js')}}"></script>
    <script src="{{ URL::asset('assets/backend/css/pnotify/pnotify.nonblock.js')}}"></script>
  @if ($errors->has('error'))
      <script>
            new PNotify({
            title: 'Error',
            text: '{{ $errors->first('error') }}',
            type: 'error',
            hide: false,
            styling: 'bootstrap3'
        }); 
      </script>
  @endif


