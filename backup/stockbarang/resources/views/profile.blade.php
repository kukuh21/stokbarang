@extends('layouts.app')

@section('breadcrumb')
   @parent
   <li>Dashboard</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          @if(Auth::user()->pegawai_gambar != null)
            <img class="profile-user-img img-responsive img-circle" src="{{ asset('https://simpeg.tabalongkab.go.id/public/images/'.Auth::user()->pegawai_gambar) }}" alt="User profile picture">
          @else
            <img class="profile-user-img img-responsive img-circle" src="{{ asset('images/no-image.png') }}" alt="User profile picture">
          @endif
          <h3 class="profile-username text-center">{{ Auth::user()->nama }}</h3>
          <p class="text-muted text-center">{{ Auth::user()->pegawai_nip }}</p>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <!-- About Me Box -->
        <div class="box box-primary">
          <!-- /.box-header -->
          <div class="box-body">
            <strong><i class="fa fa-book margin-r-5"></i> Jabatan</strong>

            <p class="text-muted">
              {{ $data->jabatan_nama }}
            </p>

            <hr>
            <strong><i class="fa fa-file-text-o margin-r-5"></i> SKPD</strong>

            @if($data->subunit_id != 0)
              <p class="text-muted">{{ $data->subunit_nama }}</p>
            @else
              <p class="text-muted">{{ $data->skpd_nama }}</p>
            @endif
          </div>
          <!-- /.box-body -->
        </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
@endsection