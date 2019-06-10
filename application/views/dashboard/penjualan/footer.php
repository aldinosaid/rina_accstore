<script type="text/javascript">var baseUrl = '<?php echo base_url(); ?>';</script>
<script type="text/javascript">
    $(document).ready(function() {
        
        function selectKategori() {
            var selectedKategori = document.getElementById('select-kategori');
            $(selectedKategori).change(function() {
                var kodeKat = this.options[this.selectedIndex].value;
                $.ajax({
                    url : baseUrl+'barang/findMaxId/'+kodeKat,
                    dataType : 'json'
                }).done(function(r){
                    $('[name=barcode]').val(r.barcode);
                }); 
            });
        }

        function dataTable() {
            var tableCari = $('#cari_barang').DataTable({
              fixedHeader: true
            });

            tableCari.on( 'draw.dt', function () {
                $('.pilih-barang').click(function() {
                    var barcode = $(this).attr('barcode');
                    $('[name=barcode]').val(barcode);
                    $('#modal-data-barang').modal('hide');
                });
            });
        }

        function count() {
            $('[name=bayar]').keypress(function() {
                var total = $('.total').html();
                var bayar = $(this).val();
                var data = {
                    total : total,
                    bayar : bayar
                }
                $.ajax({
                    url : baseUrl+'penjualan/jumlah',
                    type : 'post',
                    data : data
                }).done(function(r){
                    $('.kembali').html(r);
                });
            });
            $('[name=bayar]').click(function() {
                var total = $('.total').html();
                var bayar = $(this).val();
                var data = {
                    total : total,
                    bayar : bayar
                }
                $.ajax({
                    url : baseUrl+'penjualan/jumlah',
                    type : 'post',
                    data : data
                }).done(function(r){
                    $('.kembali').html(r);
                });
            });
        }

        function modal() {
            $('#cari-barang').click(function() {
                $('#modal-data-barang').modal('show');
                $('#modal-data-barang').on('shown.bs.modal', function() {
                    $('.pilih-barang').click(function() {
                        var barcode = $(this).attr('barcode');
                        $('[name=barcode]').val(barcode);
                        $('[name=qty]').val(1);
                        $('#modal-data-barang').modal('hide');
                        $("#barcode").change();
                    });
                });
            });
        }

        function kodeBarangChange() {
            $("#barcode").keypress(function(e){
                cariBarang(this);
            });
        }

        function btnKeranjang() {
            $('#btn-keranjang').click(function() {
                var barcode = $('[name=barcode]').val();
                var qty = 0;
                var harga = $('[hrg-brg]').attr('hrg-brg');
                qty = $('[name=qty]').val();

                var data = {
                    barcode : barcode,
                    qty     : qty,
                    harga   : harga
                }

                $.ajax({
                    url : baseUrl+'penjualan/add',
                    type : 'post',
                    data : data
                }).done(function(r) {
                    $('.keranjang tbody').html(r);
                    ajaxCount();
                    resetForm();
                });
            });
        }

        function ajaxCount() {
            $.ajax({
                url : baseUrl+'penjualan/count',
                dataType : 'json'
            }).done(function(r) {
                $('.total').html(r.total);
            });
        }

        function cariBarang(elm) {
            var barcode = $('[name=barcode]').val();
            $.ajax({
                url : baseUrl+'barang/ajaxCariBarcode/'+barcode,
                dataType : 'json'
            }).done(function(r) {
                var grosir = r.grosir
                $('#kd_brg').html(r.kode_brg);
                $('#nm_brg').html(r.nama_brg);
                $('#hrg_brg').html(r.harga);
                $('#hrg_brg').attr('hrg-brg', r.harga);

                if (grosir) {
                    $(elm).select();
                    var fQty = $('[name=qty]').val();
                    var newQty = parseInt(fQty) + 1;
                    $('[name=qty]').val(newQty);
                    var minGrosir = grosir.min;

                    minGrosir.forEach(function(val, i){
                        var hargaGrosir = grosir.harga_jual_grosir[i];
                        console.log(val);
                        if (newQty >= val) {
                            $('#hrg_brg').html(hargaGrosir);
                            $('#hrg_brg').attr('hrg-brg', hargaGrosir);
                        }
                    });
                } else {
                    $('[name=qty]').val(1);
                    $('#btn-keranjang').click();
                }
            });
        }

        function resetForm() {
            $('[name=barcode]').val('');
            $('#kd_brg').html('-');
            $('#nm_brg').html('-');
            $('#hrg_brg').html('-');
            $('#hrg_brg').attr('hrg-brg', '0');
            $('[name=qty]').val(0);
        }

        function cetak() {
            $('.cetak').click(function() {
                var total = $('.total').html();
                var bayar = $('[name=bayar]').val();
                var kembali = $('.kembali').html();
                var data = {
                    total : total,
                    bayar : bayar,
                    kembali : kembali
                }
                $.ajax({
                    url : baseUrl+'penjualan/cetak',
                    type : 'post',
                    data : data
                }).done(function(r){
                    console.log(r);
                    // location.reload();
                });
            });
        }

        function init() {
            $('.harga').inputmask("numeric", {
                radixPoint: ".",
                groupSeparator: ",",
                digits: 2,
                autoGroup: true,
                prefix: 'Rp ', //No Space, this will truncate the first character
                rightAlign: false,
                oncleared: function () { self.Value(''); }
            });
            $('#modal-data-barang').on('hidden.bs.modal', function () {
              $(this).data('bs.modal', null);
            });
            $('#barcode').focus();
            modal();
            kodeBarangChange();
            count();
            dataTable();
            btnKeranjang();
            cetak();
        }

        init();
    });
</script>
</body>

</html>
