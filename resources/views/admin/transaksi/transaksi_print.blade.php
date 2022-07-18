@include('layouts.css')
<style src="text/css">
    .tabel-border{
        border: 1px solid;
        align:center;
        padding: 5px;
    }
</style>

<section class="invoice">
    <div class="row">
        <div class="col-xs-12">
            <h4 class="page-header">
            Invocie : {{ $invoice }}
            <small class="pull-right">Tanggal: {{ $tanggal }}</small>
            </h4>
        </div>    
    </div>
        
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            <address>
                <strong>{{ $tipe_user }},</strong> {{ $nama_user }} ({{ $nohp_user }})<br>
            </address>
        </div>
    </div>
    <h4 class="text-center">{{ $bidangnama }}</h4> <br><br>
        
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
                        @foreach ($orderdetail as $item)
                        <tr class="tabel-border">
                            <td class="tabel-border">{{ $loop->iteration }}</td>
                            <td class="tabel-border">{{ $item->barang_nama }}</td>
                            <td class="tabel-border">{{ $item->jumlah }}</td>
                            <td class="tabel-border">
                                @if ($item->satuan_nama == null)
                                -
                                @endif
                                {{ $item->satuan_nama }}
                            </td>
                            <td class="tabel-border">{{ $item->barang_stock }}</td>
                            <td class="tabel-border">{{ $item->barang_stock - $item->jumlah }}</td>
                            <td class="tabel-border">{{ $item->status }}</td>
                        </tr>
                        @endforeach
                        <tr class="tabel-border">
                            <th style="padding:5px;">#</th>
                            <th style="padding:5px;">Total Barang</th>
                            <th style="padding:5px;">{{ $total }}</th>
                            <th style="padding:5px;" colspan="4"></th>
                        </tr>
                    </tbody>
                </table>
            </center>
        </div>
    </div>
</section>

<script>
    window.print();
</script>

@include('layouts.js')
