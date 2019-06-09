<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Print Barcode</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" action="#" method="POST">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Barang</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select name="barcode" class="barcode-single form-control">
                                    <?php foreach ($barang as $key ) : ?>
                                        <option value="<?php echo $key->barcode; ?>"><?php echo $key->nama_brg; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Banyak</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" value="1" name="qty" required>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                <button type="button" class="btn btn-success print"><i class="fa fa-print"></i> Print</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    $this->load->view('dashboard/js');
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.barcode-single').select2();

        $('.print').click(function() {
            var barcode = $('.barcode-single').val();
            var qty = $('[name=qty]').val();
            $.ajax({
                url : baseUrl+'print_barcode/do_print',
                type : 'post',
                data : {
                    barcode : barcode,
                    qty : qty
                }
            }).done(function(r){
                console.log(r);
            });
        });
    });
</script>