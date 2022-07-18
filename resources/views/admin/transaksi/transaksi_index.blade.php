@extends('layouts.app')

@section('breadcrumb')
   @parent
   <li>Transaksi Keluar</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h4 class="alert bg-danger text-center">Transaksi Barang Keluar</h4>
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
                    <th><center>INV</center></th>
                    <th><center>Nama</center></th>
                    <th><center>Bidang</center></th>
                    <th><center>Total</center></th>
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
    @include('admin.transaksi.modal.modal_user')

  </div>
<!-- /.row -->
@endsection


@section('active-transaksikeluar')
  active
@endsection

@section('script')
  <script>
    function addform() {
      $('#modal-user').modal('show');
    }

    $(function() {
        table = $('#data-tables').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{!! route('order.data') !!}',
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'invoice'},
                { data: 'nama'},
                { data: 'bidang_nama'},
                { data: 'total'},
                { data: 'action', actions: 'actions', orderable: false, searchable: false }
            ],
            columnDefs: [
              {
                  "targets": 0, // your case first column
                  "className": "text-center"
              },
              {
                  "targets": 5, // your case first column
                  "className": "text-center"
              },
            ],
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
            url : "order/"+id,
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