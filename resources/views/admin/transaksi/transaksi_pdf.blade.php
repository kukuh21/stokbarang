@extends('layouts.app')

@section('title')
Print Transaksi
@endsection


@section('content')
<section class="invoice">
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
            Invocie : {{ $invoice }}
            <small class="pull-right">Tanggal: {{ $tanggal }}</small>
            </h2>
        </div>    
    </div>
        
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <address>
                <strong>{{ $tipe_user }},</strong> {{ $nama_user }} ({{ $nohp_user }})<br>
                <b>Order Id :</b> {{ $orderid }}
            </address>
        </div>
    </div>
    <h3 class="text-center">{{ $bidangnama }}</h3> <br><br>
        
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Qty</th>
                        <th>Satuan</th>
                        <th>Stok Barang</th>
                        <th>Sisa</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderdetail as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->barang_nama }}</td>
                        <td>{{ $item->jumlah }}</td>
                        <td>
                            @if ($item->satuan_nama == null)
                            -
                            @endif
                            {{ $item->satuan_nama }}
                        </td>
                        <td>{{ $item->barang_stock }}</td>
                        <td>{{ $item->barang_stock - $item->jumlah }}</td>
                        <td>{{ $item->status }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th>#</th>
                        <th>Total Barang</th>
                        <th>{{ $total }}</th>
                        <th colspan="4"></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
            
    <div class="row no-print">
        <div class="col-xs-12">
            <a href="" class="btn btn-primary pull-right"><i class="fa fa-print"></i> Print
            </a>
            <button type="button" class="btn btn-danger pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
            </button>
        </div>
    </div>
</section>
@endsection
