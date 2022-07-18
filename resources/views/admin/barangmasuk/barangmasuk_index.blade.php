@extends('layouts.app')

@section('breadcrumb')
   @parent
   <li>Barang Masuk</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h4 class="alert bg-danger text-center">Barang Masuk</h4>
    </div>
    <div class="col-xs-12">
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <a data-toggle="modal" onclick="addform()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="data-tables">
              <thead>
                <tr>
                    <th width="10"><center>No.</center></th>
                    <th><center>Barang</center></th>
                    <th><center>Stock</center></th>
                    <th><center>Tanggal</center></th>
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
    @include('admin.barangmasuk.modal.modal_barangmasuk')

  </div>
<!-- /.row -->
@endsection

@section('active-barangmasuk')
  active
@endsection

@section('script')
  <script src="{{ url('vendor/jsvalidation/js/jsvalidation.min.js' , false) }}" charset="utf-8"></script>
  {!! $JsValidator->selector('#form-input') !!}

  <script>
    function addform(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modalbarangmasuk').modal('show');
        $('#modalbarangmasuk form')[0].reset();
        $('#barangmasuk_id').val('').trigger('change');
        $('.modal-title').text('Tambah Barang Masuk');
        $('#simpan').show();
        $('#loading').hide();
    }

    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#simpan').show();
        $('#loading').hide();
        $('#modalbarangmasuk form')[0].reset();
        $.ajax({
          url : "barangmasuk/"+id+"/edit",
          type : "GET",
          dataType : "JSON",
          success : function(data){
            $('#modalbarangmasuk').modal('show');
            $('.modal-title').text('Edit Barang Masuk');

            $('#barangmasuk_id').val(data.barangmasuk_id);
            $('#barang').val(data.barang_id).trigger('change');
            $('#stock').val(data.barangmasuk_stock);
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
            ajax: '{!! route('barangmasuk.data') !!}',
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'barang.barang_nama'},
                { data: 'barangmasuk_stock'},
                { data: 'tanggal', orderable: false, searchable: false},
                { data: 'action', actions: 'actions', orderable: false, searchable: false }
            ],
            columnDefs: [
              {
                  "targets": 0, // your case first column
                  "className": "text-center"
              },
            ],
        });

        $('#modalbarangmasuk form').validator().on('submit', function(e) {
            if(!e.isDefaultPrevented()) {
              var id = $('#barangmasuk_id').val();
              $('#simpan').hide();
              $('#loading').show();
              if(save_method == "add") url = "{{ route('barangmasuk.store') }}";
              else url = "barangmasuk/"+id;

              $.ajax({
                url : url,
                type : "POST",
                data : $('#modalbarangmasuk form').serialize(),
                success : function(data) {
                  if(data.code === 200) {
                    $('#modalbarangmasuk').modal('hide');
                    toastr.success('Sukses', data.status, {
                      onHidden: function() {
                        table.ajax.reload();
                      }
                    })
                  }
                  if(data.code === 400) {
                    $('#modalbarangmasuk').modal('hide');
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
            url : "barangmasuk/"+id,
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