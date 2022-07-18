<div class="modal fade" id="modalbarang" data-backdrop="static"  role="dialog" aria-labelledby="statusBackdrop" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-input" class="form-horizontal" data-toggle="validator" method="post">
      {{ csrf_field() }} {{ method_field('POST') }}
      <input type="hidden" id="barang_id" name="barang_id">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">
            <div class="row" style="margin-left: 5px; margin-right: 5px;">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Barang</label>
                  <input type="text" class="form-control" name="barang" id="barang" autocomplete="off">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Stock</label>
                  <input type="number" class="form-control" name="stock" id="stock" autocomplete="off">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Satuan</label>
                  <select name="satuan" id="satuan" class="form-control select2-all">
                    <option value="">Pilih Satuan</option>
                    @foreach ($satuan as $item)
                        <option value="{{ $item->satuan_id }}">{{ $item->satuan_nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger font-weight-bold" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
            <button id="simpan" type="submit" class="btn btn-primary font-weight-bold"><i class="fa fa-save"></i> Simpan</button>
            <button id="loading" class="btn btn-primary font-weight-bold" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...
            </button>
          </div>
        </div>
        <!-- /.modal-content -->
    </form>
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->