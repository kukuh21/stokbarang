@extends('layouts.app')

@section('breadcrumb')
@parent
<li>Dashboard</li>
@endsection

@section('content')
<style>
    #chartdiv {
        width: 100%;
        height: 300px;
    }

</style>

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12" style="margin-bottom: 20px;">
                        <center><img src="{{ asset('images/logo-tabalong.png') }}" alt="logo-tabalong" width="70">
                        </center>
                        <h2 class="text-center">Aplikasi Informasi Stok Barang</h2>
                    </div>


                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <h3>{{ $totalbarang }}</h3>

                                <p>Total Barang</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <h3>{{ $aman }}</h3>

                                <p>Total Barang Stok Aman</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-check"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <h3>{{ $menipis }}</h3>

                                <p>Total Barang Stok Menipis</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-warning"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                        <!-- small box -->
                        <div class="small-box bg-red">
                            <div class="inner">
                                <h3>{{ $habis }}</h3>

                                <p>Total Barang Stok Habis</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-close"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->


                </div>

            </div>
            <!-- ./box-body -->
        </div>
        <!-- /.box -->
    </div>

</div>



@endsection

@section('active-home')
active
@endsection

@section('script')


@endsection
