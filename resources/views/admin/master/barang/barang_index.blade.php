@extends('layouts.app')

@section('breadcrumb')
   @parent
   <li>Barang</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h4 class="alert bg-danger text-center">Barang</h4>
    </div>
    <div class="col-xs-12">
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <a data-toggle="modal" onclick="addform()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
          <a onclick="importdata()" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Import</a>
          <a target="_blank" href="{{ route('barang.print') }}" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="data-tables">
              <thead>
                <tr>
                    <th width="10"><center>No.</center></th>
                    <th><center>Barang</center></th>
                    <th><center>Stock</center></th>
                    <th><center>Satuan</center></th>
                    <th><center>Status</center></th>
                    <th width="120"><center>Aksi</center></th>
                </tr>
              </thead>
              <tbody>

              </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Dialogs -->
    @include('admin.master.barang.modal.modal_barang')
    @include('admin.master.barang.modal.modal_import')

  </div>
<!-- /.row -->
@endsection

@section('active-master')
  active
@endsection

@section('active-barang')
  active
@endsection

@section('script')
  <script src="{{ url('vendor/jsvalidation/js/jsvalidation.min.js' , false) }}" charset="utf-8"></script>
  {!! $JsValidator->selector('#form-input') !!}
  {!! $JsValidatorFile->selector('#form-input-file') !!}

  <script>
    function addform(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modalbarang').modal('show');
        $('#modalbarang form')[0].reset();
        $('.modal-title').text('Tambah Barang');
        $('#satuan').val('').trigger('change');
        $('#simpan').show();
        $('#loading').hide();
    }

    function importdata(){
        $('#modalimport').modal('show');
        $('#modalimport form')[0].reset();
        $('.modal-title-import').text('Import Data Barang');
    }

    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#simpan').show();
        $('#loading').hide();
        $('#modalbarang form')[0].reset();
        $.ajax({
          url : "barang/"+id+"/edit",
          type : "GET",
          dataType : "JSON",
          success : function(data){
            $('#modalbarang').modal('show');
            $('.modal-title').text('Edit Barang');

            $('#barang_id').val(data.barang_id);
            $('#barang').val(data.barang_nama);
            $('#stock').val(data.barang_stock);
            $('#satuan').val(data.satuan_id).trigger('change');
          },
          error : function(){
            toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
          }
        });
    }

    $(function() {
        table = $('#data-tables').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{!! route('barang.data') !!}',
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'barang_nama'},
                { data: 'barang_stock'},
                { data: 'satuan_nama', orderable: false, searchable: false},
                { data: 'statusbarang', orderable: false, searchable: false },
                { data: 'action', actions: 'actions', orderable: false, searchable: false }
            ],
            columnDefs: [
              {
                  "targets": 0, // your case first column
                  "className": "text-center"
              },
            ],
        });

        $('#modalbarang form').validator().on('submit', function(e) {
            if(!e.isDefaultPrevented()) {
              var id = $('#barang_id').val();
              $('#simpan').hide();
              $('#loading').show();
              if(save_method == "add") url = "{{ route('barang.store') }}";
              else url = "barang/"+id;

              $.ajax({
                url : url,
                type : "POST",
                data : $('#modalbarang form').serialize(),
                success : function(data) {
                  if(data.code === 200) {
                    $('#modalbarang').modal('hide');
                    toastr.success('Sukses', data.status, {
                      onHidden: function() {
                        table.ajax.reload();
                      }
                    })
                  }
                  if(data.code === 400) {
                    $('#modalbarang').modal('hide');
                    toastr.error('Error', data.status, {
                      onHidden: function() {
                        table.ajax.reload();
                      }
                    })
                  }
                },
                error : function(){
                  toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server');
                }
              });
              return false;
          }
        });

    });

    function deleteData(id) {
      swal({
        title: "Apakah kamu yakin ?",
        text: "Akan menghapus data ini",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
            $.ajax({
            url : "barang/"+id,
            type : "POST",
            data: {
                "_method" : "DELETE",
                "_token": "{{ csrf_token() }}"
            },
            success : function(data){
              swal("Data berhasil dihapus", {
                icon: "success",
              });
              table.ajax.reload();
            },
            error : function() {
              swal("Tidak dapat menghapus data");
            }
          });
        } else {
          swal("Batal di hapus");
        }
      });
    }

  </script>
@endsection