<div class="modal fade" id="modalimport" data-backdrop="static"  role="dialog" aria-labelledby="statusBackdrop" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{ route('barang.import') }}" id="form-input-file" class="form-horizontal" data-toggle="validator" method="POST" enctype="multipart/form-data">
      {{ csrf_field() }} {{ method_field('POST') }}
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title-import"></h4>
          </div>
          <div class="modal-body">
            <div class="row" style="margin-left: 5px; margin-right: 5px;">
              <div class="col-md-12">
                <div class="form-group">
                  <label>File</label>
                  <input type="file" class="form-control" name="file_import" id="file_import">
                </div>
              </div>

            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger font-weight-bold" data-dismiss="modal"><i class="fa fa-close"></i> Tutup</button>
            <button type="submit" class="btn btn-primary font-weight-bold"><i class="fa fa-save"></i> Simpan</button>
          </div>
        </div>
        <!-- /.modal-content -->
    </form>
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->