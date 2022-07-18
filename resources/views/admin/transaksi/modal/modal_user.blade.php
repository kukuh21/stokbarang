<div class="modal fade" id="modal-user" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">
                        &times; </span> </button>
                <h3 class="modal-title">Pilih Pegawai</h3>
            </div>

            <div class="modal-body">
                <table class="table table-striped tabel-supplier">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Bidang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $data)
                        <tr>
                            <th>{{ $data->nama }}</th>
                            <th>{{ $data->bidang->bidang_nama }}</th>
                            <th><a href="{{ url('order/create', $data->user_id) }}" class="btn btn-primary"><i class="fa fa-check-circle"></i> Pilih</a></th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</div>
