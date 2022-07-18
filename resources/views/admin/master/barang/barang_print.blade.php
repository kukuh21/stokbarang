<!DOCTYPE html>
<html>
  <body>
    <style type="text/css">
    .header {

    }

    .logo {
      border-radius: 100em;
      height: 20px;
      float: left;
    }

    .logokanan {
      border-radius: 100em;
      opacity: 0,5;
      height: 20px;
      float: right;
	    padding-top: 28px;
    }

    .judul {
      border-top: 2px solid black;
	     border-bottom: 2px solid black;
    }

    .title {
      margin-top: 0px;
      font-family: Arial;
    }

    h4 hr {
      border-bottom: 3px solid black;
    }

    .tabel {
      border-collapse:collapse;border-spacing:0;border-color:#ccc;
    }

    .tabel td {
      font-family:Arial;font-size:12px;border-style:solid;padding:5px 5px;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;
    }

    .tabel th {
      font-family:Arial;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;
    }

    .tabel .top {
      font-weight:bold;font-size:12px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center
    }

    .tabel .bot {
      font-size:12px;font-family:"Arial", Helvetica, sans-serif !important;
    }

    .tengah {
      text-align: center;
    }

    .tebal {
      font-weight: bold;
    }

    @media print {
      .pagebreak { page-break-before: always; } /* page-break-after works, as well */
    }

    </style>
    <div>
      	<!-- bagian edit-->
    			<div class="header">
    			<div class="title">
    			   <h4 align="center" style="margin-left: 0%;">
               <a style="color: #000; font-size: 16px; font-weight: bold;">STOK BARANG BKPSDM TABALONG</a>
             </h4>
    			</div>
          </div>

					<div class="panel-body" style="margin-top: 0px;">
							<table class="tabel" width="100%">
								<thead style="text-align: center">
                  <tr>
                    <td width="10">No.</td>
                    <td>Nama Barang</td>
                    <td>Stok</td>
                    <td>Satuan</td>
                    <td>Status</td>
                </tr>
								</thead>
									<tbody>
                    @foreach ($data as $no => $list)
                      <tr>
                        <td class="tengah">{{ $no+1 }}</tdc>
                        <td>{{ $list->barang_nama }}</td>
                        <td>{{ $list->barang_stock }}</td>
                        <td>{{ $list->satuan_nama }}</td>
                          @if($list->barang_stock == 0)
                            <td>
                              Stock Kosong
                            </td>
                          @elseif($list->barang_stock > 5)
                            <td>
                              Stock Aman
                            </td>
                          @else
                            <td>
                              Stock Menipis
                            </td>
                          @endif
                      </tr>
                    @endforeach
									</tbody>
							</table>
					</div>
					{{-- <div class="pagebreak"> </div> --}}
    </div>
  </body>

  <script>
    window.print();
  </script>

</html>

