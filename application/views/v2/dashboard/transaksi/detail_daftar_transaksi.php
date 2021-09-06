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
                            <a href="<?php echo base_url('daftar_transaksi'); ?>">DAFTAR TRANSAKSI</a>
                        </li>
                        <li class="breadcrumb-item active">DETAIL TRANSAKSI</li>
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
                                        <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?php echo $transaction[0]->tanggal; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kasir" class="col-sm-5 col-form-label">KASIR</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="kasir" class="form-control" value="<?php echo $transaction[0]->name; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="pelanggan" class="col-sm-5 col-form-label">PELANGGAN</label>
                                    <div class="col-sm-7">
                                        <select class="form-control" name="pelanggan" readonly>
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
                    
                </div>
                <!-- / col-md-4 -->
                <div class="col-md-4">
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <small class="float-right">
                                        NO NOTA : <?php echo $transaction[0]->no_nota; ?>
                                        <input type="text" name="no_nota" value="<?php echo $transaction[0]->no_nota; ?>" style="display: none;">
                                    </small>
                                </h4>
                                <P class="amount" id="sub_total_display">
                                    <?php echo idr_format($transaction[0]->sub_total); ?>
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
                                                foreach ($orders as $item) :
                                            ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $item->kode_brg; ?></td>
                                                    <td><?php echo $item->nama_brg; ?></td>
                                                    <td><?php echo $item->qty; ?></td>
                                                    <td><?php echo idr_format($item->harga); ?></td>
                                                    <td>
                                                    <a href="javascript:void(0);" class="remove" kode_brg="<?php echo $item->kode_brg; ?>">
                                                    <i class="fa fa-exchange-alt"></i>
                                                    Return
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
                                        <input type="text" class="form-control" id="sub_total" name="sub_total" value="<?php echo idr_format($transaction[0]->sub_total); ?>" readonly>
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
                                        <input type="text" name="total" id="total" class="form-control" value="<?php echo idr_format($transaction[0]->sub_total); ?>" readonly>
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
                                        <input type="text" name="bayar" class="form-control harga" value="<?php echo $transaction[0]->bayar; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="kembali" class="col-sm-5 col-form-label">KEMBALIAN</label>
                                    <div class="col-sm-7">
                                        <input type="text" name="kembali" class="form-control harga" value="<?php echo $transaction[0]->kembali; ?>" readonly>
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
                                <a href="javascript:void(0)" class="btn btn-primary cetak_det"><i class="fa fa-print"></i> CETAK</a>
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