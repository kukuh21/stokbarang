@include('layouts.css')

<div class="modal fade" id="modal-cetak" tabindex="-2" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('order.orderprintpertanggal') }}" class="form-horizontal" data-toggle="validator" method="post" target="_blank">
            {{ csrf_field() }} {{ method_field('POST') }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">
                        &times; </span> </button>
                <h3 class="modal-title">Cetak Transaksi</h3>
            </div>

            <div class="modal-body">
                <div class="row" style="margin-left: 5px; margin-right: 5px;">
                    <div class="col-md-6 mr-2">
                        <div class="form-group">
                            <label>Dari Tanggal</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker" id="datepicker" name="tgl_dari">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Sampai Tanggal</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right datepicker" id="datepicker" name="tgl_sampai">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger font-weight-bold" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
                <button id="simpan" type="submit" class="btn btn-primary font-weight-bold"><i class="fa fa-print"></i> Cetak</button>
                {{-- <button id="loading" class="btn btn-primary font-weight-bold" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                </button> --}}
            </div>
        </div>  
        </form>
    </div>
</div>

@include('layouts.js')
