<?php foreach ($kategories as $kategori) : ?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Kategori Baru</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form class="form-horizontal form-label-left" action="<?php echo base_url('kategori/update/'.$kategori->id); ?>" method="POST">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Kategori *</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" maxlength="3" placeholder="Kode Kategori" value="<?php echo $kategori->kode_kat; ?>" name="kode_kat" style="text-transform:uppercase" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kategori *</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="text" class="form-control" placeholder="Nama Kategori" value="<?php echo $kategori->kategori; ?>" name="kategori" required>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<?php
    $this->load->view('dashboard/js');
?>