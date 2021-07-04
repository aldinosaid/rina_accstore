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
                    <h2>Semua Kategori</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table id="all_finalist" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Kategori</th>
                                <th>Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $i = 1;
                            foreach ($kategories as $kategori) :
                            ?>
                            <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $kategori->kode_kat; ?></td>
                            <td><?php echo $kategori->kategori; ?></td>
                            <td>
                            <a href="<?php echo base_url('kategori/details/' . $kategori->id); ?>"><i class="fa fa-eye"></i></a>
                            <a href="<?php echo base_url('kategori/edit/' . $kategori->id); ?>"><i class="fa fa-edit"></i></a>
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
                        <a href="<?php echo base_url('kategori/add'); ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Kategori Baru</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    $this->load->view('dashboard/js');
?>
