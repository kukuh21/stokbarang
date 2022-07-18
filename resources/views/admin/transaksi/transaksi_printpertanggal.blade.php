@include('layouts.css')
<style src="text/css">
    .tabel-border{
        border: 1px solid;
        align:center;
        padding: 5px;
    }
</style>

@foreach ($data as $data_item)
    <section class="invoice" style="page-break-before:always;">
        <div class="row">
            <div class="col-xs-12">
                <h4 class="page-header">
                Invocie : {{ $data_item->invoice }}
                <small class="pull-right">Tanggal: {{ $data_item->tanggal }}</small>
                </h4>
            </div>    
        </div>
            
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <address>
                    <strong>{{ $data_item->tipe }},</strong> {{ $data_item->nama }} ({{ $data_item->nohp }})<br>
                </address>
            </div>
        </div>
        <h4 class="text-center">{{ $data_item->bidang_nama }}</h4> <br><br>
            
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <center>
                    <table class="tabel-border" style="width:90%;">
                        <thead>
                            <tr class="tabel-border">
                                <th class="tabel-border" style="width:5%;">No</th>
                                <th class="tabel-border" style="width:35%;">Barang</th>
                                <th class="tabel-border" style="width:10%;">Qty</th>
                                <th class="tabel-border" style="width:10%;">Satuan</th>
                                <th class="tabel-border" style="width:10%;">Stok Barang</th>
                                <th class="tabel-border" style="width:10%;">Sisa</th>
                                <th class="tabel-border" style="width:20%;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php 
                                $data_detail = App\Model\OrderDetail::leftJoin('tb_barang', 'tb_orderdetail.barang_id', '=', 'tb_barang.barang_id')
                                ->leftJoin('tb_satuan', 'tb_barang.satuan_id', '=', 'tb_satuan.satuan_id')
                                ->where('order_id', $data_item->order_id)
                                ->get();
                            @endphp
                            @foreach ($data_detail as $detail_item)
                            <tr class="tabel-border">
                                <td class="tabel-border">{{ $loop->iteration }}</td>
                                <td class="tabel-border">{{ $detail_item->barang_nama }}</td>
                                <td class="tabel-border">{{ $detail_item->jumlah }}</td>
                                <td class="tabel-border">
                                    @if ($detail_item->satuan_nama == null)
                                    -
                                    @endif
                                    {{ $detail_item->satuan_nama }}
                                </td>
                                <td class="tabel-border">{{ $detail_item->barang_stock }}</td>
                                <td class="tabel-border">{{ $detail_item->barang_stock - $detail_item->jumlah }}</td>
                                <td class="tabel-border">{{ $detail_item->status }}</td>
                            </tr>
                            @endforeach
                            <tr class="tabel-border">
                                <th style="padding:5px;">#</th>
                                <th style="padding:5px;">Total Barang</th>
                                <th style="padding:5px;">{{ $data_item->total }}</th>
                                <th style="padding:5px;" colspan="4"></th>
                            </tr>
                        </tbody>
                    </table>
                </center>
            </div>
        </div>
    </section>
@endforeach

<script>
    window.print();
</script>

@include('layouts.js')
