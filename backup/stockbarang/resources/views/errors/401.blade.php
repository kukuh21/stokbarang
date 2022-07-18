@extends('layouts.app')
@section('content')
<div class="d-flex flex-row justify-content-center">
    <div class="col-md-12 text-center">
        <div class="alert alert-danger">
            <h1>401</h1>
            <h4>{{$exception->getMessage()}}</h4>
            <a href="{{url('home')}}" class="btn btn-success">Refresh</a>
        </div>
    </div>
</div>
@endsection