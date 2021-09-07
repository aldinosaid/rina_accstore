<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url(); ?>">DASHBOARD</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?php echo base_url('daftar_transaksi'); ?>">TRANSAKSI</a>
                        </li>
                        <li class="breadcrumb-item active">PENJUALAN</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="tanggal" class="col-sm-5 col-form-label">TGL</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tanggal; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kasir" class="col-sm-5 col-form-label">KASIR</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="kasir" class="form-control" value="<?php echo $username; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pelanggan" class="col-sm-5 col-form-label">PELANGGAN</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="pelanggan">
                                            <option value="0">UMUM</option>
                                            <option value="1">MEMBER</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                    </div>
                </div>
                <!-- / col-md-4 -->
                <div class="col-md-4">
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="tanggal" class="col-sm-5 col-form-label">KODE BARANG</label>
                                    <div class="col-sm-7">
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="kode_brg" class="form-control">
                                            <span class="input-group-append">
                                                <button type="button" id="cari-barang" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="qty" class="col-sm-5 col-form-label">QTY</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="qty" class="form-control" value="">
                                    </div>
                                </div>
                                <button type="button" id="btn-keranjang" class="btn btn-primary col-md-12"><i class="fa fa-cart-plus"></i> Tambah</button>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                    </div>
                </div>
                <!-- / col-md-4 -->
                <div class="col-md-4">
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <small class="float-right">
                                        NO NOTA : <?php echo $no_nota; ?>
                                        <input type="text" name="no_nota" value="<?php echo $no_nota; ?>" style="display: none;">
                                    </small>
                                </h4>
                                <P class="amount" id="sub_total_display">
                                    <?php echo $sub_total; ?>
                                </P>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                    </div>
                </div>
                <!-- / col-md-4 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <div id="result-ajax-cart-table">
                                    <div class="table-responsive">
                                        <table id="transaksi" class="table table-bordered table-striped">
                                             <thead>
                                                <tr>
                                                    <th>NO</th>
                                                    <th>KODE BARANG</th>
                                                    <th>NAMA BARANG</th>
                                                    <th>QTY</th>
                                                    <th>HARGA</th>
                                                    <th>AKSI</th>
                                               </tr>
                                             </thead>
                                             <tbody>
                                                <?php
                                                    $i = 1;
                                                    foreach ($keranjang as $item) :
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $item->kode_brg; ?></td>
                                                        <td><?php echo $item->nama_brg; ?></td>
                                                        <td><?php echo $item->qty; ?></td>
                                                        <td><?php echo idr_format($item->harga); ?></td>
                                                        <td>
                                                        <a href="<?php echo base_url('penjualan/hapus/' . $item->kode_brg); ?>" class="remove" kode_brg="<?php echo $item->kode_brg; ?>">
                                                        <i class="fa fa-times-circle"></i>
                                                        </a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $i++;
                                                    endforeach;
                                                ?>
                                             </tbody>
                                          </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                    </div>
                </div>
                <!-- / col-md-4 -->
            </div>
            <!-- / .row -->
            <div class="row">
                <div class="col-md-4">
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="sub_total" class="col-sm-5 col-form-label">SUB TOTAL</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="sub_total" name="sub_total" value="<?php echo $sub_total; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="disc" class="col-sm-5 col-form-label">DISCOUNT</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="discount" class="form-control" value="0" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="total" class="col-sm-5 col-form-label">TOTAL</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="total" id="total" class="form-control" value="<?php echo $total; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                    </div>
                </div>
                <!-- / col-md-4 -->
                <div class="col-md-4">
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label for="sub_total" class="col-sm-5 col-form-label">METODE PEMBAYARAN</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" readonly>
                                            <option>CASH</option>
                                            <option>TRANSFER BRI</option>
                                            <option>TRANSFER BCA</option>
                                            <option>OVO</option>
                                            <option>SHOPEE PAY</option>
                                            <option>GOPAY</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bayar" class="col-sm-5 col-form-label">CASH</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="bayar" class="form-control harga" value="0">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kembali" class="col-sm-5 col-form-label">KEMBALIAN</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="kembali" class="form-control harga" value="0" readonly>
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                    </div>
                </div>
                <!-- / col-md-4 -->
                <div class="col-md-4">
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <a class="btn btn-warning" href="<?php echo base_url('penjualan'); ?>"><i class="fa fa-sync-alt"></i> RELOAD</a>
                                <a class="btn btn-danger" href="<?php echo base_url('penjualan/bersihkan'); ?>"><i class="fa fa-eraser"></i> BERSIHKAN</a>
                                <a href="javascript:void(0)" class="btn btn-primary cetak"><i class="fa fa-print"></i> CETAK</a>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                    </div>
                </div>
                <!-- / col-md-3 -->
            </div>
            <!-- / .row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<div class="result-ajax-modal">
    <?php $this->load->view('v2/dashboard/transaksi/penjualan/ajax_modal', $data['barang'] = $barang); ?>
</div>