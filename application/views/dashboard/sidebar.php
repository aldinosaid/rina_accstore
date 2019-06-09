<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <?php if (user_level($this->session->userdata('level')) == 'Admin') : ?>
            <li><a><i class="fa fa-cubes"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url('barang'); ?>">Barang</a></li>
                    <li><a href="<?php echo base_url('kategori'); ?>">Kategori</a></li>
                </ul>
            </li>
            <?php endif; ?>
            <li><a><i class="fa fa-exchange"></i> Transaksi <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url('penjualan'); ?>">Penjualan</a></li>
                    <li><a href="<?php echo base_url('pembelian'); ?>">Pembelian</a></li>
                </ul>
            </li>
            <?php if (user_level($this->session->userdata('level')) == 'Admin') : ?>
            <li><a><i class="fa fa-book"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?php echo base_url('laporan/penjualan'); ?>">Penjualan</a></li>
                    <li><a href="<?php echo base_url('laporan/pembelian'); ?>">Pembelian</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url('print_barcode'); ?>"><i class="fa fa-barcode"></i> Print Barcode</a>
            </li>
            <?php endif ?>
            <li><a><i class="fa fa-gear"></i> Settings <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <?php if (user_level($this->session->userdata('level')) == 'Admin') : ?>
                    <li><a href="<?php echo base_url('admin_login'); ?>">Pengguna</a></li>
                    <?php endif; ?>
                    <li><a href="<?php echo base_url('settings/test_print'); ?>">Test Print</a></li>
                </ul>
            </li>
        </ul>
    </div>

</div>
<div class="sidebar-footer hidden-small">
    <a data-toggle="tooltip" data-placement="top" title="Settings">
        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Lock">
        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
    </a>
    <a data-toggle="tooltip" data-placement="top" title="Logout">
        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
    </a>
</div>
