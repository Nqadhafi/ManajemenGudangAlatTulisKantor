<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
  
      <!-- Dropdown Logout -->
      <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="nav-icon fas fa-user"></i> 
            Halo, {{ auth()->user()->name }} <!-- Menampilkan nama pengguna yang sedang login -->
              <i class="fas fa-angle-down ml-2"></i> <!-- Ikon untuk dropdown -->
        
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <!-- Opsi Logout -->
              <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fas fa-sign-out-alt mr-2"></i> Logout
              </a>
              <!-- Tambahkan opsi lain jika diperlukan -->
          </div>
      </li>
  
      <!-- Form Logout -->
      <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
          @csrf
      </form>
  </ul>
  
  
</nav>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="{{ route('admin.dashboard') }}" class="brand-link">
    <!-- Menampilkan Logo Perusahaan jika ada -->
    @if($perusahaan && $perusahaan->logo)
        <img src="{{ asset('storage/' . $perusahaan->logo) }}" alt="Logo Perusahaan" class="brand-image img-circle elevation-3" style="opacity: .8">
    @else
        <img src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    @endif
    
    <span class="brand-text font-weight-light">
        <!-- Menampilkan Nama Perusahaan -->
        {{ $perusahaan ? $perusahaan->nama : 'Admin Dashboard' }}
    </span>
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
                <li class="nav-item">
                    <a href="{{ route('perusahaan.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Master Perusahaan</p>
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
                      <!-- Transaksi Masuk -->
                      <li class="nav-item">
                          <a href="{{ route('transaksi.masuk') }}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Transaksi Masuk</p>
                          </a>
                      </li>
                      <!-- Transaksi Keluar -->
                      <li class="nav-item">
                          <a href="{{ route('transaksi.keluar') }}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>Transaksi Keluar</p>
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
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-angle-left right"></i>
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Laporan</p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{ route('laporan.stok') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Laporan Stok</p>
                          </a>
                        </li>
                      </ul>
                </li>





            </ul>
        </nav>
    </div>
</aside>
