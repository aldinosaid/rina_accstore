<!-- Main Sidebar Container -->
         <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
            <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
            <span class="brand-text font-weight-light">TOKO GROSIR LUSINAN</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
               <!-- Sidebar user panel (optional) -->
               <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                     <img src="<?php echo base_url('assets/v2/dist/img/user2-160x160.jpg'); ?>" class="img-circle elevation-2" alt="User Image">
                  </div>
                  <div class="info">
                     <a href="#" class="d-block"><?php echo ucfirst($this->session->userdata('username')); ?></a>
                  </div>
               </div>
               <!-- SidebarSearch Form -->
               <!-- <div class="form-inline">
                  <div class="input-group" data-widget="sidebar-search">
                     <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                     <div class="input-group-append">
                        <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                        </button>
                     </div>
                  </div>
               </div> -->
               <!-- Sidebar Menu -->
               <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                     <?php
                        $segment['master_data'] = [
                           'barang',
                           'kategori',
                           'jenis',
                           'merek',
                           'satuan',
                           'suplier',
                           'customer'
                        ];
                        $segment['transaksi'] = [
                           'daftar_transaksi',
                           'penjualan',
                           'pembelian'
                        ];
                        $segment['laporan'] = [
                           'penjualan',
                           'pembelian'
                        ];
                        $segment['pengaturan'] = [
                           'pengguna',
                           'factory_reset',
                           'test_print'
                        ];
                     ?>
                     <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                     <li class="nav-item <?php if (in_array($this->uri->segment(1), $segment['master_data'])) {echo 'menu-open';} ?>">
                        <a href="#" class="nav-link <?php if (in_array($this->uri->segment(1), $segment['master_data'])) {echo 'active';} ?>">
                           <i class="nav-icon fas fa-cubes"></i>
                           <p>
                              MASTER DATA
                              <i class="right fas fa-angle-left"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="<?php echo base_url('barang'); ?>" class="nav-link <?php if ($this->uri->segment(1) == 'barang') { echo 'active';} ?>">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>BARANG</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="<?php echo base_url('kategori'); ?>" class="nav-link <?php if ($this->uri->segment(1) == 'kategori') { echo 'active';} ?>">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>KATEGORI</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="<?php echo base_url('jenis'); ?>" class="nav-link <?php if ($this->uri->segment(1) == 'jenis') { echo 'active';} ?>">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>JENIS</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="<?php echo base_url('merek'); ?>" class="nav-link <?php if ($this->uri->segment(1) == 'merek') { echo 'active';} ?>">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>MEREK</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="<?php echo base_url('satuan'); ?>" class="nav-link <?php if ($this->uri->segment(1) == 'satuan') { echo 'active';} ?>">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>SATUAN</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="<?php echo base_url('suplier'); ?>" class="nav-link <?php if ($this->uri->segment(1) == 'suplier') { echo 'active';} ?>">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>SUPLIER</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="<?php echo base_url('customer'); ?>" class="nav-link <?php if ($this->uri->segment(1) == 'customer') { echo 'active';} ?>">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>CUSTOMER</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item <?php if (in_array($this->uri->segment(1), $segment['transaksi'])) {echo 'menu-open';} ?>">
                        <a href="#" class="nav-link <?php if (in_array($this->uri->segment(1), $segment['transaksi'])) {echo 'active';} ?>">
                           <i class="nav-icon fas fa-exchange-alt"></i>
                           <p>
                              TRANSAKSI
                              <i class="right fas fa-angle-left"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="<?php echo base_url('daftar_transaksi'); ?>" class="nav-link <?php if ($this->uri->segment(1) == 'daftar_transaksi') { echo 'active';} ?>">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>DAFTAR TRANSAKSI</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="<?php echo base_url('penjualan'); ?>" class="nav-link <?php if ($this->uri->segment(1) == 'penjualan') { echo 'active';} ?>">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>PENJUALAN</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="<?php echo base_url('pembelian'); ?>" class="nav-link <?php if ($this->uri->segment(1) == 'pembelian') { echo 'active';} ?>">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>PEMBELIAN</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li class="nav-item">
                        <a href="#" class="nav-link <?php if (in_array($this->uri->segment(1), $segment['laporan'])) {echo 'active';} ?>">
                           <i class="nav-icon fas fa-file"></i>
                           <p>
                              LAPORAN
                              <i class="right fas fa-angle-left"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview">
                           <li class="nav-item">
                              <a href="<?php echo base_url('laporan/ringkasan_penjualan'); ?>" class="nav-link <?php if ($this->uri->segment(1) == 'ringkasan_penjualan') { echo 'active';} ?>">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>RINGKASAN PENJUALAN</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="<?php echo base_url('pembelian'); ?>" class="nav-link <?php if ($this->uri->segment(1) == 'pembelian') { echo 'active';} ?>">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>PEMBELIAN</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </nav>
               <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
         </aside>