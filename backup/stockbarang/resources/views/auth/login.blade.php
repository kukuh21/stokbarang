<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Login | {{ config('app.name') }}</title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="stylesheet" href="{{ asset('adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminLTE/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminLTE/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminLTE/dist/css/AdminLTE.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('adminLTE/plugins/iCheck/square/blue.css') }} ">
  <link rel="shortcut icon" href="{{ asset('simpeg.ico') }}" />

</head>

<body class="hold-transition login-page" style="background-image: linear-gradient(#b6b6b6, #ffffff);">
<div class="login-box">
  <div class="login-logo">
    <img src="{{ asset('tabalong.png') }}" width="60">
  </div>

  <div class="login-box-body" style="border-radius: 10px;">
    <p class="login-box-msg">Silakan Login</p>
    @if(session('status'))
    <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>
        {{session('status')}}
    </div>
    @endif
    <form action="{{ url('/login') }}" method="POST">
    {{ csrf_field() }}

      <div class="form-group has-feedback">
        <label for="nip" class="colform-label pl-0">Username</label>
        <br>
        <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>
        @if ($errors->has('username'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('username') }}</strong>
        </span>
        @endif
      </div>

      <div class="form-group has-feedback">
        <label for="password" class="colform-label text-md-left pl-0">Password</label>
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>

      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat" style="border-radius: 5px;">Login</button>
        </div>
      </div>
    </form>

  </div>

</div>

<script src="{{ asset('adminLTE/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('adminLTE/plugins/iCheck/icheck.min.js') }}"></script>
</body>
</html>