<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Register | {{ config('app.name') }}</title>

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
  <link rel="stylesheet" href="{{ asset('adminLTE/bower_components/select2/dist/css/select2.min.css') }}">
  <link rel="shortcut icon" href="{{ asset('simpeg.ico') }}" />

</head>

<body class="hold-transition login-page" style="background-image: linear-gradient(#b6b6b6, #ffffff);">
<div class="login-box" style="margin-top: 16px;">
  <div class="login-logo">
    <img src="{{ asset('tabalong.png') }}" width="60">
  </div>

  <div class="login-box-body" style="border-radius: 10px;">
    <p class="login-box-msg">Form Register</p>
    @if(session('status'))
    <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>
        {{session('status')}}
    </div>
    @endif
    <form action="{{ url('/register') }}" method="POST" id="form-input">
    {{ csrf_field() }}

      <div class="form-group has-feedback">
        <label class="colform-label pl-0">Nama</label>
        <br>
        <input id="nama" type="text" class="form-control" name="nama" value="{{ old('nama') }}" autofocus>
      </div>

      <div class="form-group has-feedback">
        <label for="nip" class="colform-label pl-0">Username</label>
        <br>
        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" autofocus>
      </div>

      <div class="form-group has-feedback">
        <label for="password" class="colform-label text-md-left pl-0">Password</label>
        <input id="password" type="password" class="form-control" name="password" >
      </div>

      <div class="form-group has-feedback">
        <label for="password" class="colform-label text-md-left pl-0">Kategori Perpustakaan</label>
        <select name="kategori_perpustakaan" id="kategori_perpustakaan" class="form-control select2-all" >
          <option value="">Pilih Perpustakaan</option>
          @foreach ($kategoriperpus as $list)
              <option value="{{ $list->kategoriperpustakaan_id }}">{{ $list->kategoriperpustakaan_nama }} - {{ $list->jenisperpustakaan->jenisperpustakaan_nama }}</option>
          @endforeach
        </select>
      </div>

      <div class="form-group has-feedback">
        <label for="password" class="colform-label text-md-left pl-0">Perpustakaan</label>
        <select name="perpustakaan" id="perpustakaan" class="form-control select2-all" >
          <option value="">Pilih Perpustakaan</option>
        </select>
      </div>

      <div class="row">
        <div class="col-xs-6">
          <button type="submit" class="btn btn-success btn-block btn-flat" style="border-radius: 5px;">Register</button>
        </div>
        <div class="col-xs-6">
          <a href="{{ url('/login') }}" class="btn btn-danger btn-block btn-flat" style="border-radius: 5px;">Batal</a>
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
<script src="{{ asset('adminLTE/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ url('vendor/jsvalidation/js/jsvalidation.min.js' , false) }}" charset="utf-8"></script>
{!! $JsValidator->selector('#form-input') !!}

<script>
  $(function() {
    $('.select2-all').select2({
      width: '100%'
    });

    $("select#kategori_perpustakaan").change(function () {
      var kategori = $(this).val();
      if (kategori) {
          $.ajax({
              url: "{{ url('json/getperpustakaan/') }}/" + kategori,
              type: "get",
              dataType: "json",
              success: function (data) {
                  console.log(data);
                  var count = data.length;
                  $("select#perpustakaan").empty();
                  if (count == 0) {
                      $("select#perpustakaan").html('<option value="">Perpustakaan Tidak Ditemukan</option>')
                  } else {
                      $("select#perpustakaan").append('<option value="">Pilih Perpustakaan</option>')
                      $.each(data, function (key, value) {
                          $("select#perpustakaan").append('<option value="' + value.perpustakaan_id + '">' + value.perpustakaan_nama + '</option>')
                      });
                  }
              }
          });
      } else {
          $("select#perpustakaan").empty();
      }
    });

  });

  $(document).ready(function () {
      // do not allow users to enter spaces:
      $("#username").on({
          keydown: function (event) {
              if (event.which === 32)
                  return false;
          },
          // if a space copied and pasted in the input field, replace it (remove it):
          change: function () {
              this.value = this.value.replace(/\s/g, "");
          }
      });
  });
</script>
</body>
</html>