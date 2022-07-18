@extends('layouts.app')

@section('title')
Transaksi Keluar
@endsection


@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body">
                <table>
                    <tr>
                        <td width="150">Nama</td>
                        <td><b>{{ $data->user->nama }}</b></td>
                    </tr>
                    <tr>
                        <td>Bidang</td>
                        <td><b>{{ $data->user->bidang->bidang_nama }}</b></td>
                    </tr>
                </table>
                <hr>
                <form class="form form-horizontal form-barang" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="kode" class="col-md-2 control-label">Barang</label>
                        <div class="col-md-5">
                            <div class="input-group">
                              <input type="hidden" id="order_id" name="order_id" value="{{ $data->order_id }}">
                                <input id="id_barang" type="text" class="form-control" name="barang" autofocus required>
                                <span class="input-group-btn">
                                    <button onclick="showBarang()" type="button" class="btn btn-info">...</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>

                <form class="form-keranjang">
                    {{ csrf_field() }} {{ method_field('PATCH') }}
                    <div class="table-responsive">
                    <table class="table table-striped tabel-transaksi table-bordered">
                        <thead>
                            <tr>
                                <th width="30">No</th>
                                <th>Nama Barang</th>
                                <th width="50">Jumlah</th>
                                <th width="50">Satuan</th>
                                <th width="100">Tanggal</th>
                                <th width="100">Total</th>
                                <th width="50">Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                    </div>
                </form>

            </div>

            <div class="box-footer">
                <a class="btn btn-danger" href="{{ route('order.index') }}"><i class="fa fa-undo"></i> Kembali</a>
                <a onclick="simpanTransaksi({{ $data->order_id }})" class="btn btn-primary pull-right simpan"><i class="fa fa-floppy-o"></i> Simpan
                    Transaksi</a>
            </div>
        </div>
    </div>
    @include('admin.transaksi.modal.modal_barang')
</div>

@endsection

@section('active-transaksikeluar')
  active
@endsection

@section('script')
<script type="text/javascript">
  $(function() {
    $('.tabel-barang').DataTable();

    let order_id = $('#order_id').val();

    table = $('.tabel-transaksi').DataTable({
      "dom" : 'Brt',
      "bSort" : false,
      "processing" : true,
      "ajax" : {
        "url" : "{{ URL('/order/dataOrderDetail/') }}/" + order_id,
        "type" : "GET"
        }
      });

  });

  function addItem() {
    $.ajax({
      url : "{{ route('order.orderdetailStore') }}",
      type : "POST",
      data : $('.form-barang').serialize(),
      success : function(data){
        $('#id_barang').val('').focus();
        if(data.code === 200) {
          toastr.success('Sukses', data.status, {
            onHidden: function() {
              table.ajax.reload();
            }
          })
        }

        if(data.code === 400) {
          toastr.error('Error', data.status, {
            onHidden: function() {
              table.ajax.reload();
            }
          })
        }
      },
      error : function(){
        alert("Tidak dapat menyimpan data!");
      }
    });
  }

  function showBarang(){
    $('#modal-barang').modal('show');
  }

  function selectItem(id){
    $('#id_barang').val(id);
    $('#modal-barang').modal('hide');
    addItem();
  }

  function changeCount(id) {
     $.ajax({
        url : "{{ URL('/order/orderdetailUpdate/') }}/" + id,
        type : "POST",
        data : $('.form-keranjang').serialize(),
        success : function(data){
          $('#id_barang').focus();
          if(data.code === 200) {
            toastr.success('Sukses', data.status, {
              onHidden: function() {
                table.ajax.reload();
              }
            })
          }

          if(data.code === 400) {
            toastr.error('Error', data.status, {
              onHidden: function() {
                table.ajax.reload();
              }
            })
          }
        },
        error : function(){
          alert("Tidak dapat menyimpan data!");
        }
     });
  }

  function simpanTransaksi(id)
  {
    $.ajax({
          url : "{{ URL('/order/simpanTransaksi/') }}/" + id,
          type : "GET",
          dataType : "JSON",
          success : function(data){
            toastr.success('Berhasil', 'Data Berhasil Disimpan')
            table.ajax.reload();
          },
          error : function(){
            toastr.error('Gagal', 'Mohon Maaf Terjadi Kesalahan Pada Server')
          }
    });
  }

  function deleteItem(id){
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
            url : "{{ URL('/order/orderdetailHapus/') }}/" +  id,
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
