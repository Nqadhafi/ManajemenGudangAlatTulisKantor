<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Dashboard</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <!-- Transaksi -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-angle-left right"></i>
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Transaksi</p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{ route('transaksi.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Transaksi Barang</p>
                          </a>
                        </li>
                      </ul>
                </li>

                <!-- Data Karyawan -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-angle-left right"></i>
                        <i class="nav-icon fas fa-sitemap "></i>
                        <p>Data Karyawan</p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{ route('divisi.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Master Divisi</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('karyawan.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Master Karyawan</p>
                          </a>
                        </li>
                      </ul>
                </li>

                <!-- Data Barang -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-angle-left right"></i>
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Data Barang</p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{ route('kategori.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Master Kategori</p>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a href="{{ route('produk.index') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Master Produk</p>
                          </a>
                        </li>
                      </ul>
                </li>





            </ul>
        </nav>
    </div>
</aside>
