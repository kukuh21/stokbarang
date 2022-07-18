<li class="@yield('active-stokbarang')">
    <a href="{{ route('stokbarang.index') }}">
        <i class="fa fa-exchange"></i> <span>Stok Barang</span>
    </a>
</li>

<li class="@yield('active-transaksikeluar')">
    <a href="{{ route('order.index') }}">
        <i class="fa fa-cart-plus"></i> <span>Transaksi Keluar</span>
    </a>
</li>