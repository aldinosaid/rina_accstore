		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
		<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->
		<!-- Main Footer -->
		<footer class="main-footer">
			<!-- To the right -->
			<div class="float-right d-none d-sm-inline"> Anything you want </div>
			<!-- Default to the left -->
			<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>. </strong> All rights reserved.
		</footer>
	</div>
		<!-- ./wrapper -->
		<!-- REQUIRED SCRIPTS -->
		<?php
			if (isset($required_js)) {
				foreach ($required_js as $path) {
					echo '<script src="' . base_url('assets/v2/'. $path) . '"></script>';
				}
			}
		?>
		<script type="text/javascript">
			var baseUrl = '<?php echo base_url(); ?>';
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				function modal() {
		            $('#cari-barang').click(function() {
		                $('#modal-data-barang').modal('show');
		                $('#modal-data-barang').on('shown.bs.modal', function() {
		                    $('.pilih-barang').click(function() {
		                        var kode_brg = $(this).attr('kode_brg');
		                        $('[name=kode_brg]').val(kode_brg);
		                        $('[name=qty]').val(1);
		                        $('#modal-data-barang').modal('hide');
		                        $('#btn-keranjang').focus();
		                    });
		                });
		            });
		        }

		        function cetak() {
		            $('.cetak').click(function() {
		                var total = $('[name=total]').val();
		                var no_nota = $('[name=no_nota]').val();
		                var sub_total = $('[name=sub_total]').val();
		                var bayar = $('[name=bayar]').val();
		                var kembali = $('[name=kembali]').val();
		                var discount = $('[name=discount]').val();
		                if (parseInt(bayar.replace('Rp ', '')) <= 0 || parseInt(kembali.replace('Rp ', '')) < 0) {
		                	Swal.fire(
		                      'Gagal!',
		                      'CASH / Pembayaran harus di isi dan kembali tidak boleh - (minus)',
		                      'error'
		                    );
		                } else {
		                	var data = {
			                    total : total,
			                    sub_total : sub_total,
			                    discount : discount,
			                    bayar : bayar,
			                    kembali : kembali,
			                    no_nota : no_nota
			                }
			                $.ajax({
			                    url : baseUrl+'penjualan/generate_receipt_html',
			                    type : 'post',
			                    dataType : 'JSON',
			                    data : data
			                }).done(function(r){
			                    do_print_popup(r.receipt_html);
			                    location.reload();
			                });
		                }
		            });
		        }

		        function do_print_popup(data) 
				{
				    var myWindow = window.open('', 'Receipt', 'height=400,width=600');
				    
				    myWindow.document.write(data);
				    myWindow.document.close(); // necessary for IE >= 10

				    myWindow.onload=function(){ // necessary if the div contain images
				        myWindow.focus(); // necessary for IE >= 10
				        myWindow.print();
				        myWindow.close();
				    };
				}

		        function bayar() {
		        	$('[name=bayar]').change(function() {
		                var total = $('#total').val();
		                var bayar = $(this).val();
		                var data = {
		                    total : total,
		                    bayar : bayar
		                }
		                $.ajax({
		                    url : baseUrl+'penjualan/jumlah',
		                    type : 'post',
		                    dataType : 'JSON',
		                    data : data
		                }).done(function(r){
		                    $('[name=kembali]').val(r.kembali);
		                });
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

				function reinitBtnKeranjang() {
					$('#btn-keranjang').click(function() {
						var kode_brg = $('[name=kode_brg]').val();
						var qty = $('[name=qty]').val();
						var data = {
							kode_brg : kode_brg,
							qty : qty
						};

						$.ajax({
		                    url : baseUrl+'penjualan/add',
		                    dataType : 'JSON',
		                    type : "POST",
		                    data : data
		                }).done(function(r) {
		                    $('#result-ajax-cart-table').html(r.html);
		                    $('#sub_total_display').html(r.sub_total);
		                    $('#sub_total').val(r.sub_total);
		                    $('#total').val(r.total);
		                }).fail(function(jqXHR, textStatus) {
		                    Swal.fire(
		                      'Gagal!',
		                      textStatus,
		                      'error'
		                    );
		                });
					});
				}

				function resetValueCartInput() {
					$('[name=kode_brg]').val('');

				}

				function reinitTableCart() {

				}

				function init() {
					reinitBtnKeranjang();
					modal();
					$('#data-barang').DataTable({
						"createdRow": function( row, data, dataIndex){
			                if( data[3] <= 0){
			                    $(row).css('color', 'red');
			                }
			            }
					});
					bayar();
					inputMask();
					cetak();
				}

				init();
			});
		</script>
	</body>
</html>