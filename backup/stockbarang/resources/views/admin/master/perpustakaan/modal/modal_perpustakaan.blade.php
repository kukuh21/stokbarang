<div class="modal fade" id="modalperpustakaan" data-backdrop="static"  role="dialog" aria-labelledby="statusBackdrop" aria-hidden="true">
  <div class="modal-dialog">
    <form id="form-input" class="form-horizontal" data-toggle="validator" method="post">
      {{ csrf_field() }} {{ method_field('POST') }}
      <input type="hidden" id="perpustakaan_id" name="perpustakaan_id">
      <input value="{{ $data->kategoriperpustakaan_id }}" type="hidden" id="kategoriperpustakaan_id" name="kategoriperpustakaan_id">
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
                  <label>Nama Perpustakaan</label>
                  <input type="text" class="form-control" name="nama_perpustakaan" id="nama_perpustakaan" autocomplete="off">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>No. Perpustakaan</label>
                  <input type="text" class="form-control" name="perpustakaan_no" id="perpustakaan_no" autocomplete="off">
                </div>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Akredetasi</label>
                  <input type="text" class="form-control" name="perpustakaan_akredetasi" id="perpustakaan_akredetasi" autocomplete="off">
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