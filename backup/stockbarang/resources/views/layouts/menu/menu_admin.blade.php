<li class="treeview @yield('active-master')">
    <a href="#">
        <i class="fa fa-bars"></i> <span>Master</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="@yield('active-bidang')"><a href="{{ route('bidang.index') }}"><i class="fa fa-bank"></i> Bidang</a></li>
        <li class="@yield('active-barang')"><a href="{{ route('barang.index') }}"><i class="fa fa-suitcase"></i> Barang</a></li>
    </ul>
</li>

<li class="@yield('active-barangmasuk')">
    <a href="{{ route('barangmasuk.index') }}">
        <i class="fa fa-exchange"></i> <span>Barang Masuk</span>
    </a>
</li>

<li class="@yield('active-transaksikeluar')">
    <a href="{{ route('order.index') }}">
        <i class="fa fa-cart-plus"></i> <span>Transaksi Keluar</span>
    </a>
</li>


<li class="@yield('active-manajemenuser')">
    <a href="{{ route('manajemenuser.index') }}">
        <i class="fa fa-users"></i> <span>Manajemen User</span>
    </a>
</li>