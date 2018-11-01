<script type="text/javascript">var baseUrl = '<?php echo base_url(); ?>';</script>
<script type="text/javascript">
	$('#all_finalist').DataTable({
      fixedHeader: true
    });

    $(document).ready(function() {
    	
    	function selectKategori() {
            var selectedKategori = document.getElementById('select-kategori');
            $(selectedKategori).change(function() {
                var kodeKat = this.options[this.selectedIndex].value;
                $.ajax({
                    url : baseUrl+'barang/findMaxId/'+kodeKat,
                    dataType : 'json'
                }).done(function(r){
                    $('[name=kode_brg]').val(r.kode_brg);
                }); 
            });
    	}

        function dataTable() {
            var tableCari = $('#cari_barang').DataTable({
              fixedHeader: true
            });

            tableCari.on( 'draw.dt', function () {
                $('.pilih-barang').click(function() {
                    var kode_brg = $(this).attr('kode-brg');
                    $('[name=kode_brg]').val(kode_brg);
                    $('#modal-data-barang').modal('hide');
                    cariBarang();
                });
            });
        }

        function autocomplete() {
            $( "#barang" ).autocomplete({
                source: baseUrl+'barang/autocomplete',
                minLenght: 3
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
                        var kode_brg = $(this).attr('kode-brg');
                        $('[name=kode_brg]').val(kode_brg);
                        $('[name=qty]').val(1);
                        $('#modal-data-barang').modal('hide');
                        cariBarang();
                    });
                });
            });
        }

        function btnKeranjang() {
            console.log('test');
            $('#btn-keranjang').click(function() {
                var kode_brg = $('[name=kode_brg]').val();
                var qty = 0;
                var harga = $('[hrg-brg]').attr('hrg-brg');
                qty = $('[name=qty]').val();

                var data = {
                    kode_brg : kode_brg,
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

        function cariBarang() {
            var kode_brg = $('[name=kode_brg]').val();
            $.ajax({
                url : baseUrl+'barang/ajaxCariId/'+kode_brg,
                dataType : 'json'
            }).done(function(r) {
                $('#nm_brg').html(r.nama_brg);
                $('#hrg_brg').html(r.harga);
                $('#hrg_brg').attr('hrg-brg', r.harga);
                $('#btn-keranjang').focus();
            });
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
                    method : 'post',
                    data : data
                }).done(function(r){
                    location.reload();
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
            if ($('#barang')) {
                autocomplete();
            }
            modal();
            selectKategori();
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