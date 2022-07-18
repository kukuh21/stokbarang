<div class="modal fade" id="modal-barang" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">
                        &times; </span> </button>
                <h3 class="modal-title">Cari Barang</h3>
            </div>

            <div class="modal-body">
                <table class="table table-striped tabel-barang table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Stock</th>
                            <th width="20">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($barang as $list)
                        <tr>
                            <th>{{ $list->barang_nama }}</th>
                            <th>{{ $list->barang_stock }}</th>
                            <th class="text-center"><a onclick="selectItem({{ $list->barang_id }})" class="btn btn-primary"><i
                                        class="fa fa-check-circle"></i> Pilih</a></th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>
