@extends('layouts.app')

@section('breadcrumb')
   @parent
   <li>Jenis Perpustakaan</li>
   <li>{{ $data->jenisperpustakaan_nama }}</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h4 class="alert bg-danger text-center">Kategori Perpustakaan</h4>
    </div>
    <div class="col-xs-12">
      <div class="box box-default color-palette-box">
        <div class="box-header with-border">
          <a data-toggle="modal" onclick="addform()" class="btn btn-success"><i class="fa fa-plus-circle"></i> Tambah</a>
          <a href="{{ route('jenisperpustakaan.index') }}" class="btn btn-danger"><i class="fa fa-undo"></i> Kembali</a>
        </div>
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="data-tables">
              <thead>
                <tr>
                    <th width="10"><center>No.</center></th>
                    <th><center>Kategori Perpustakaan</center></th>
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
    @include('admin.master.kategoriperpustakaan.modal.modal_kategoriperpustakaan')

  </div>
<!-- /.row -->
@endsection

@section('active-master')
  active
@endsection

@section('active-jenisperpustakaan')
  active
@endsection

@section('script')
  <script src="{{ url('vendor/jsvalidation/js/jsvalidation.min.js' , false) }}" charset="utf-8"></script>
  {!! $JsValidator->selector('#form-input') !!}

  <script>
    function addform(){
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#modalkategoriperpustakaan').modal('show');
        $('#modalkategoriperpustakaan form')[0].reset();
        $('.modal-title').text('Tambah Kategori Perpustakaan');
        $('#simpan').show();
        $('#loading').hide();
    }

    function editForm(id){
        save_method = "edit";
        $('input[name=_method]').val('PATCH');
        $('#simpan').show();
        $('#loading').hide();
        $('#modalkategoriperpustakaan form')[0].reset();
        $.ajax({
          url : "{{ url('kategoriperpustakaan/editJson/') }}/" + id,
          type : "GET",
          dataType : "JSON",
          success : function(data){
            $('#modalkategoriperpustakaan').modal('show');
            $('.modal-title').text('Edit Kategori Perpustakaan');

            $('#kategoriperpustakaan_id').val(data.kategoriperpustakaan_id);
            $('#kategori_perpustakaan').val(data.kategoriperpustakaan_nama);
          },
          error : function(){
            toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
          }
        });
    }

    $(function() {
        let jenis = $('#jenisperpustakaan_id').val();
        table = $('#data-tables').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ url('/kategoriperpustakaan/data/') }}/" + jenis,
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'kategoriperpustakaan_nama'},
                { data: 'action', actions: 'actions', orderable: false, searchable: false }
            ],
            columnDefs: [
              {
                  "targets": 0, // your case first column
                  "className": "text-center"
              },
            ],
        });

        $('#modalkategoriperpustakaan form').validator().on('submit', function(e) {
            if(!e.isDefaultPrevented()) {
              var id = $('#kategoriperpustakaan_id').val();
              $('#simpan').hide();
              $('#loading').show();
              if(save_method == "add") url = "{{ route('kategoriperpustakaan.store') }}";
              else url = "{{ url('kategoriperpustakaan/') }}/" + id;

              $.ajax({
                url : url,
                type : "POST",
                data : $('#modalkategoriperpustakaan form').serialize(),
                success : function(data) {
                  if(data.code === 200) {
                    $('#modalkategoriperpustakaan').modal('hide');
                    toastr.success('Sukses', data.status, {
                      onHidden: function() {
                        table.ajax.reload();
                      }
                    })
                  }
                  if(data.code === 400) {
                    $('#modalkategoriperpustakaan').modal('hide');
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
            url : "{{ url('/kategoriperpustakaan/') }}/" + id,
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