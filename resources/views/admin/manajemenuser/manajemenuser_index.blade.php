@extends('layouts.app')

@section('breadcrumb')
   @parent
   <li>Manajemen User</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h4 class="alert bg-danger text-center">Manajemen User</h4>
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
                    <th><center>Username</center></th>
                    <th><center>Nama</center></th>
                    <th><center>Tipe</center></th>
                    <th><center>Bidang</center></th>
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
    @include('admin.manajemenuser.modal.modal_manajemenuser')

  </div>
<!-- /.row -->
@endsection

@section('active-manajemenuser')
  active
@endsection

@section('script')
  <script src="{{ url('vendor/jsvalidation/js/jsvalidation.min.js' , false) }}" charset="utf-8"></script>
  {!! $JsValidator->selector('#form-input') !!}

  <script>
    function addform(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modalmanajemenuser').modal('show');
        $('#modalmanajemenuser form')[0].reset();
        $('.modal-title').text('Tambah User');
        $('#simpan').show();
        $('#loading').hide();
    }

    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#simpan').show();
        $('#loading').hide();
        $('#modalmanajemenuser form')[0].reset();
        $.ajax({
          url : "manajemenuser/"+id+"/edit",
          type : "GET",
          dataType : "JSON",
          success : function(data){
            $('#modalmanajemenuser').modal('show');
            $('.modal-title').text('Edit User');

            $('#user_id').val(data.user_id);
            $('#username').val(data.username);
            $('#password').val('');
            $('#nama').val(data.nama);
            $('#nohp').val(data.nohp);
            $('#alamat').val(data.alamat);
            $('#bidang').val(data.bidang_id).trigger('change');
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
            ajax: '{!! route('manajemenuser.data') !!}',
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'username'},
                { data: 'nama'},
                { data: 'tipe'},
                { data: 'bidang.bidang_nama'},
                { data: 'action', actions: 'actions', orderable: false, searchable: false }
            ],
            columnDefs: [
              {
                  "targets": 0, // your case first column
                  "className": "text-center"
              },
            ],
        });

        $('#modalmanajemenuser form').validator().on('submit', function(e) {
            if(!e.isDefaultPrevented()) {
              var id = $('#user_id').val();
              $('#simpan').hide();
              $('#loading').show();
              if(save_method == "add") url = "{{ route('manajemenuser.store') }}";
              else url = "manajemenuser/"+id;

              $.ajax({
                url : url,
                type : "POST",
                data : $('#modalmanajemenuser form').serialize(),
                success : function(data) {
                  if(data.code === 200) {
                    $('#modalmanajemenuser').modal('hide');
                    toastr.success('Sukses', data.status, {
                      onHidden: function() {
                        table.ajax.reload();
                      }
                    })
                  }
                  if(data.code === 400) {
                    $('#modalmanajemenuser').modal('hide');
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
            url : "manajemenuser/"+id,
            type : "POST",
            data: {
                "_method" : "DELETE",
                "_token": "{{ csrf_token() }}"
            },
            success : function(data){
              if(data.code === 200) {
                swal("Data berhasil dihapus", {
                  icon: "success",
                });
                table.ajax.reload();
              }

              if(data.code === 400) {
                toastr.error('Gagal', data.status, {
                  onHidden: function() {
                    table.ajax.reload();
                  }
                })
              }
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