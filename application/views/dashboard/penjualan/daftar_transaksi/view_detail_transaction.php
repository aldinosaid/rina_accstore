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
    <?php elseif ($this->session->flashdata('error_notification')) : ?>
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
                <h2>Detail Transaksi : <?php echo $transaction[0]->no_nota; ?></small></h2>
                <input type="hidden" name="no_nota" value="<?php echo $transaction[0]->no_nota; ?>">
                <input type="hidden" name="tanggal_nota" value="<?php echo $transaction[0]->tanggal; ?>">
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-striped keranjang">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Harga</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $i = 1;
                            foreach ($detail_transaction as $item) :
                            ?>
                            <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $item->kode_brg; ?></td>
                            <td><?php echo $item->nama_brg; ?></td>
                            <td><?php echo $item->qty; ?></td>
                            <td><?php echo idr_format($item->harga); ?></td>
                            </tr>
                            <?php
                            $i++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 pull-right">
                        <table class="table">
                            <tr>
                                <th><h3>Total</h3></th>
                                <td><h3 class="total"><?php echo idr_format($transaction[0]->total); ?></h3></td>
                            </tr>
                            <tr>
                                <th><h3>Bayar</h3></th>
                                <td><h3 class="bayar"><?php echo idr_format($transaction[0]->bayar); ?></h3></td>
                            </tr>
                            <tr>
                                <th><h3>Kembali</h3></th>
                                <td><h3 class="kembali"><?php echo idr_format($transaction[0]->kembali); ?></h3></td>
                            </tr>
                        </table>
                        <br>
                        <a href="javascript:void(0)" class="btn btn-primary cetak_transaksi"><i class="fa fa-print"></i> Cetak</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    $this->load->view('dashboard/js');
?>
