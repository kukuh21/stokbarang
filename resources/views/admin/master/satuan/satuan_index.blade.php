@extends('layouts.app')

@section('breadcrumb')
   @parent
   <li>Satuan</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h4 class="alert bg-danger text-center">Satuan</h4>
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
                    <th><center>Satuan</center></th>
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
    @include('admin.master.satuan.modal.modal_satuan')

  </div>
<!-- /.row -->
@endsection

@section('active-master')
  active
@endsection

@section('active-satuan')
  active
@endsection

@section('script')
  <script src="{{ url('vendor/jsvalidation/js/jsvalidation.min.js' , false) }}" charset="utf-8"></script>
  {!! $JsValidator->selector('#form-input') !!}

  <script>
    function addform(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modalsatuan').modal('show');
        $('#modalsatuan form')[0].reset();
        $('.modal-title').text('Tambah Satuan');
        $('#simpan').show();
        $('#loading').hide();
    }

    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#simpan').show();
        $('#loading').hide();
        $('#modalsatuan form')[0].reset();
        $.ajax({
          url : "satuan/"+id+"/edit",
          type : "GET",
          dataType : "JSON",
          success : function(data){
            $('#modalsatuan').modal('show');
            $('.modal-title').text('Edit Satuan');

            $('#satuan_id').val(data.satuan_id);
            $('#satuan').val(data.satuan_nama);
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
            ajax: '{!! route('satuan.data') !!}',
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'satuan_nama'},
                { data: 'action', actions: 'actions', orderable: false, searchable: false }
            ],
            columnDefs: [
              {
                  "targets": 0, // your case first column
                  "className": "text-center"
              },
            ],
        });

        $('#modalsatuan form').validator().on('submit', function(e) {
            if(!e.isDefaultPrevented()) {
              var id = $('#satuan_id').val();
              $('#simpan').hide();
              $('#loading').show();
              if(save_method == "add") url = "{{ route('satuan.store') }}";
              else url = "satuan/"+id;

              $.ajax({
                url : url,
                type : "POST",
                data : $('#modalsatuan form').serialize(),
                success : function(data) {
                  if(data.code === 200) {
                    $('#modalsatuan').modal('hide');
                    toastr.success('Sukses', data.status, {
                      onHidden: function() {
                        table.ajax.reload();
                      }
                    })
                  }
                  if(data.code === 400) {
                    $('#modalsatuan').modal('hide');
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
            url : "satuan/"+id,
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