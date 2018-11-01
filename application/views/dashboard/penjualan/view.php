<!-- page content -->
<div class="right_col" role="main">
    <?php if ($this->session->flashdata('notification')) : ?>
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong><?php echo $this->session->flashdata('notification'); ?></strong>
            </div>
        </div>
    <?php elseif($this->session->flashdata('error_notification')) : ?>
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong><?php echo $this->session->flashdata('notification'); ?></strong>
            </div>
        </div>
    <?php endif; ?>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Daftar Belanja</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped keranjang">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Action</th>
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
                                        <i class="fa fa-remove"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php 
                            $i++;
                            endforeach;
                        ?>
                    </tbody>
                </table>
                <br>
                <div class="col-md-6 col-sm-12 pull-right">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th><h3>Total</h3></th>
                                <td><h3 class="total"><?php echo idr_format($total[0]->total); ?></h3></td>
                            </tr>
                            <tr>
                                <th><h3>Bayar</h3></th>
                                <td><input type="text" class="harga" name="bayar"></td>
                            </tr>
                            <tr>
                                <th><h3>Kembali</h3></th>
                                <td><h3 class="kembali">Rp 0.</h3></td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <a class="btn btn-success" href="<?php echo base_url('penjualan'); ?>"><i class="fa fa-refresh"></i> Reload</a>
                    <a class="btn btn-danger" href="<?php echo base_url('penjualan/bersihkan'); ?>"><i class="fa fa-eraser"></i> Bersihkan</a>
                    <a href="javascript:void(0)" class="btn btn-primary cetak"><i class="fa fa-print"></i> Cetak</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data Barang</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="form-group">
                    <input type="text" name="kode_brg" id="barang" placeholder="Kode Barang" class="form-control" style="text-transform:uppercase" readonly>
                </div>
                <div class="form-group">
                    <input type="text" name="qty" placeholder="Qty" class="form-control">
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Nama Barang</th>
                            <td id="nm_brg">-</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td id="hrg_brg">Rp 0,-</td>
                        </tr>
                    </table>
                </div>
                <button class="btn btn-primary" id="cari-barang"><i class="fa fa-search"></i> Cari Barang</button>
                <button class="btn btn-success" id="btn-keranjang"><i class="fa fa-shopping-cart"></i> Tambah Ke daftar belanja</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-data-barang" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cari data barang</h4>
            </div>
            <div class="modal-body modal-lg">
                <table id="cari_barang" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $i = 1;
                            foreach ($barang as $value) : 
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $value->kode_brg; ?></td>
                            <td><?php echo $value->nama_brg; ?></td>
                            <td><?php echo idr_format($value->harga_jual); ?></td>
                            <td>
                                <button class="btn btn-primary pilih-barang" kode-brg="<?php echo $value->kode_brg; ?>"><i class="fa fa-plus"></i> Pilih</button>
                            </td>
                        </tr>
                        <?php 
                            $i++;
                            endforeach; 
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php
    $this->load->view('dashboard/js');
?>