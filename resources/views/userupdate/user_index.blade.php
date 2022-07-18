@extends('layouts.app')

@section('title')
Update Profil
@endsection

@section('breadcrumb')
@parent
<li>Update Profile</li>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif
    </div>
</div>
<form enctype="multipart/form-data" class="bg-white shadow-sm p-3"
    action="{{ route('profile.update', $user->user_id) }}" method="POST" id="form-input">
    @csrf
    <input type="hidden" value="PUT" name="_method">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>

            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                        class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                        class="fa fa-remove"></i></button>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input value="{{ $user->nama }}" type="text" class="form-control" name="nama" id="nama">
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input value="{{ $user->username }}" type="text" class="form-control" name="username"
                            id="username">
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="phone">No. HP</label>
                        <input value="{{ $user->nohp }}" type="text" name="nohp" class="form-control">
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password" />
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="avatar">Gambar Avatar</label>
                        <br>
                        <input id="avatar" name="avatar" type="file" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control">{{ $user->alamat }}</textarea>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            @if($user->avatar != null)
            <div class="row">
                <div class="col-md-3">
                    <img src="{{ asset('images/avatar/'.Auth::user()->avatar) }}" class="user-image" alt="User Image"
                        width="100">
                </div>
            </div>
            @endif
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary btn-save"><i class="fa fa-floppy-o"></i> Update </button>
        </div>
    </div>
</form>
<!-- /.box -->
@endsection

@section('script')
<script src="{{ url('vendor/jsvalidation/js/jsvalidation.min.js' , false) }}" charset="utf-8"></script>
{!! $JsValidator->selector('#form-input') !!}

<script type="text/javascript">
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
@endsection
