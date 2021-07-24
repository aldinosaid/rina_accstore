<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Tambah Barang Baru</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form class="form-horizontal form-label-left" action="<?php echo base_url('barang/save'); ?>" method="POST">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Kode Barang</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" placeholder="0000000000" name="kode_brg" style="text-transform:uppercase" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-3">
                                <div class="checkbox">
                                    <label>
                                        <div class="icheckbox_flat-green">
                                            <input type="checkbox" class="flat" id="equal">
                                        </div>
                                        Barcode sama dengan kode barang
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Barcode</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" placeholder="0000000000" name="barcode" style="text-transform:uppercase">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Barang</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control" placeholder="Nama Barang" name="nama_brg" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nama Kategori *</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <select class="form-control" id="select-kategori">
                                    <option>- Pilih Kategori -</option>
                                    <?php foreach ($kategories as $kategori) : ?>
                                        <option value="<?php echo $kategori->kode_kat; ?>"><?php echo $kategori->kategori; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Qty</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="number" class="form-control" placeholder="Qty" name="qty" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga Beli</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control harga" name="harga_beli" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Harga Jual</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <input type="text" class="form-control harga" name="harga_jual" required>
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <a href="javascript:void(0)" class="btn btn-primary add-grosir"> Grosir <i class="fa fa-plus-circle"></i></a>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="grosir">
                                
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success btn-lg">SIMPAN</button>
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
        function btnRemoveGrosir() {
            var removeGrosir = document.querySelectorAll('.remove-grosir-item'); 
            [].forEach.call(removeGrosir, function(elm) {
                $(elm).click(function(){
                    var itemGrosir = $(this).closest('.item-grosir');
                    $(itemGrosir).remove();
                    if ($('.item-grosir').length <= 0) {
                        $('.grosir').append('<p class="text-center grosir-default">Tidak ada data Grosir</p>');
                    }
                });
            });
        }

        function barcodeIsEqualItemCode() {
            var isEqual = document.getElementById('equal');
            if (isEqual.checked) {
                $('[name=barcode]').val($('[name=kode_brg]').val());
                $('[name=barcode]').attr('readonly', 'readonly');
            } else {
                $('[name=barcode]').val('');
                $('[name=barcode]').removeAttr('readonly');
            }
        }

        function eventClickIsEqual() {
            $('#equal').on('click', function() {
                barcodeIsEqualItemCode();
            });
        }

        function btnAddGrosir() {
            $('.add-grosir').click(function(){
                if ($('.grosir-default')) {
                    $('.grosir-default').remove();
                }
                $('.grosir').append(
                    '<div class="item-grosir col-md-12">'
                        +'<div class="col-md-5 col-sm-6 form-group">'
                            +'<label class="control-label col-md-3 col-sm-3 col-xs-12">Min beli</label>'
                            +'<div class="col-md-9 col-sm-9 col-xs-12">'
                                +'<input type="text" class="form-control" name="grosir[min][]">'
                            +'</div>'
                        +'</div>'
                        +'<div class="col-md-5 col-sm-6 form-group">'
                            +'<label class="control-label col-md-3 col-sm-3 col-xs-12">Harga Grosir</label>'
                            +'<div class="col-md-9 col-sm-9 col-xs-12">'
                                +'<input type="text" class="form-control harga" name="grosir[harga_jual_grosir][]">'
                            +'</div>'
                        +'</div>'
                        +'<div class="col-md-2">'
                            +'<a href="javascript:void(0)" class="btn btn-danger remove-grosir-item">'
                                +'<i class="fa fa-minus-circle"></i>'
                            +'</a>'
                        +'</div>'
                    +'</div>'
                );
                inputMask();
                btnRemoveGrosir();
            });
        }

        function inputMask() {
            $('.harga').inputmask("numeric", {
                radixPoint: ".",
                groupSeparator: ",",
                digits: 2,
                autoGroup: true,
                prefix: 'Rp ', //No Space, this will truncate the first character
                rightAlign: false,
                oncleared: function () { self.Value(''); }
            });
        }

        function init() {
            btnAddGrosir();
            btnRemoveGrosir();
            eventClickIsEqual();
            inputMask();
        }

        init();
    });
</script>
