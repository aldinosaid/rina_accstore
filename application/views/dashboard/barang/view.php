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
                    <h2>Semua Data Barang</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="all_finalist" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Barcode</th>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Harga beli</th>
                                <th>Harga Jual</th>
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
                            <td><?php echo $value->barcode; ?></td>
                            <td><?php echo $value->nama_brg; ?></td>
                            <td><?php echo $value->qty; ?></td>
                            <td><?php echo idr_format($value->harga_beli); ?></td>
                            <td><?php echo idr_format($value->harga_jual); ?></td>
                            <td>
                            <a href="<?php echo base_url('barang/delete/' . $value->id); ?>"><i class="fa fa-trash"></i></a>
                            <a href="<?php echo base_url('barang/edit/' . $value->id); ?>"><i class="fa fa-edit"></i></a>
                            </td>
                            </tr>
                            <?php
                            $i++;
                            endforeach;
                            ?>
                        </tbody>
                    </table>
                    <br>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <a href="<?php echo base_url('barang/add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Barang Baru</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    $this->load->view('dashboard/js');
?>
