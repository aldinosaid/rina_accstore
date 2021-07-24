<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <?php if ($this->session->flashdata('notification')) : ?>
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong><?php echo $this->session->flashdata('notification'); ?></strong>
                </div>
            <?php elseif ($this->session->flashdata('error_notification')) : ?>
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    <strong><?php echo $this->session->flashdata('notification'); ?></strong>
                </div>
            <?php endif; ?>
            <div class="x_panel">
                <div class="x_title">
                    <h2>Semua Data Transaksi</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">
                        <table id="all_finalist" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No Nota</th>
                                    <th>Total Order</th>
                                    <th>Bayar</th>
                                    <th>Kembali</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $i = 1;
                                foreach ($transactions as $transaction) :
                                ?>
                                <tr>
                                <td><?php echo $transaction->no_nota; ?></td>
                                <td><?php echo idr_format($transaction->total); ?></td>
                                <td><?php echo idr_format($transaction->bayar); ?></td>
                                <td><?php echo idr_format($transaction->kembali); ?></td>
                                <td><?php echo idTimeFormat($transaction->tanggal); ?></td>
                                <td>
                                <a href="<?php echo base_url('daftar_transaksi/detail/' . $transaction->no_nota); ?>" target="_blank">
                                    <i class="fa fa-eye"></i> Lihat Detail</a>
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
        </div>
    </div>
</div>
<?php
    $this->load->view('dashboard/js');
?>
