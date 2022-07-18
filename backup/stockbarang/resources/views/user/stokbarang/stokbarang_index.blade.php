@extends('layouts.app')

@section('breadcrumb')
   @parent
   <li>Barang</li>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <h4 class="alert bg-danger text-center">Info Stok Barang</h4>
    </div>
    <div class="col-xs-12">
      <div class="box box-default color-palette-box">
        <div class="box-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="data-tables">
              <thead>
                <tr>
                    <th width="10"><center>No.</center></th>
                    <th><center>Barang</center></th>
                    <th><center>Stock</center></th>
                    <th><center>Status</center></th>
                </tr>
              </thead>
              <tbody>

              </tbody>
              </table>
          </div>
        </div>
      </div>
    </div>


  </div>
<!-- /.row -->
@endsection

@section('active-stokbarang')
  active
@endsection

@section('script')
  <script>
    $(function() {
        table = $('#data-tables').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: '{!! route('stokbarang.data') !!}',
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false},
                { data: 'barang_nama'},
                { data: 'barang_stock'},
                { data: 'statusbarang', orderable: false, searchable: false },
            ],
            columnDefs: [
              {
                  "targets": 0, // your case first column
                  "className": "text-center"
              },
            ],
        });



    });


  </script>
@endsection