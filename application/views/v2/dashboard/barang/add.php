<!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0">TAMBAH DATA BARANG BARU</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">DASHBOARD</a></li>
                           <li class="breadcrumb-item"><a href="<?php echo base_url('barang'); ?>">BARANG</a></li>
                           <li class="breadcrumb-item active">TAMBAH BARU</li>
                        </ol>
                     </div>
                     <!-- /.col -->
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <div class="content">
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="card" id="card-barang">
                           <div class="card-header">
                              <h3 class="card-title">ISI DATA BARANG</h3>
                           </div>
                           <div class="card-body">
                              <!-- form start -->
                              <form class="form-horizontal" id="form_barang" action="<?php echo base_url('barang/save'); ?>" method="POST">
                                 <div class="card-body">
                                    <div class="form-group row">
                                       <label for="kode_brg" class="col-sm-2 col-form-label">KODE BARANG</label>
                                       <div class="col-sm-10">
                                          <input type="text" class="form-control" name="kode_brg" id="kode_brg" value="<?php echo $kode_brg; ?>"placeholder="0000000000" readonly>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="nama_brg" class="col-sm-2 col-form-label">NAMA BARANG</label>
                                       <div class="col-sm-10">
                                          <input type="text" class="form-control" name="nama_brg" id="nama_brg" placeholder="NAMA BARANG">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="nama_brg" class="col-sm-2 col-form-label">KATEGORI</label>
                                       <div class="col-sm-10">
                                          <select class="form-control select2" name="kode_kat" id="select-kategori">
                                             <option>- PILIH KATEGORI -</option>
                                             <?php foreach ($kategories as $kategori) : ?>
                                                 <option value="<?php echo $kategori->kode_kat; ?>"><?php echo $kategori->kategori; ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="nama_brg" class="col-sm-2 col-form-label">JENIS</label>
                                       <div class="col-sm-10 ajax-jenis">
                                          <select class="form-control select2" name="kode_jenis" id="select-jenis">
                                             <option>- PILIH JENIS -</option>
                                             <?php foreach ($all_jenis as $jenis) : ?>
                                                 <option value="<?php echo $jenis->kode_jenis; ?>"><?php echo $jenis->jenis; ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="nama_brg" class="col-sm-2 col-form-label">MEREK</label>
                                       <div class="col-sm-10">
                                          <select class="form-control select2" name="kode_merek" id="select-merek">
                                             <option>- PILIH MEREK -</option>
                                             <?php foreach ($all_merek as $merek) : ?>
                                                 <option value="<?php echo $merek->kode_merek; ?>"><?php echo $merek->merek; ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="nama_brg" class="col-sm-2 col-form-label">SATUAN</label>
                                       <div class="col-sm-10">
                                          <select class="form-control select2" name="kode_satuan" id="select-satuan">
                                             <option>- PILIH SATUAN -</option>
                                             <?php foreach ($all_satuan as $satuan) : ?>
                                                 <option value="<?php echo $satuan->kode_satuan; ?>"><?php echo $satuan->satuan; ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="stok_toko" class="col-sm-2 col-form-label">STOK TOKO</label>
                                       <div class="col-sm-10">
                                          <input type="text" name="stok_toko" class="form-control" id="stok_toko">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="stok_gudang" class="col-sm-2 col-form-label">STOK GUDANG</label>
                                       <div class="col-sm-10">
                                          <input type="text" name="stok_gudang" class="form-control" id="stok_gudang" <?php if (!is_admin()) { echo 'readonly';} ?>>
                                       </div>
                                    </div>
                                    <div class="form-group row" <?php if (!is_admin()) { echo 'style="display:none;"'; } ?>>
                                       <label for="harga_beli" class="col-sm-2 col-form-label">HARGA BELI</label>
                                       <div class="col-sm-10">
                                          <input type="text" name="harga_beli" class="form-control harga" id="harga_beli">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="harga_jual" class="col-sm-2 col-form-label">HARGA JUAL</label>
                                       <div class="col-sm-10">
                                          <input type="text" name="harga_jual" class="form-control harga" id="harga_jual">
                                       </div>
                                    </div>
                                    <div class="form-group text-right">
                                       <a href="javascript:void(0)" class="btn btn-primary add-grosir"> Grosir <i class="fa fa-plus-circle"></i></a>
                                    </div>
                                    <div class="card card-warning">
                                       <div class="card-header">
                                          <h3 class="card-title">GROSIR</h3>
                                       </div>
                                       <!-- /.card-header -->
                                       <div class="card-body">
                                            <div class="alert alert-danger alert-dismissible">
                                            <h5><i class="icon fas fa-ban"></i> PERHATIAN!</h5>
                                            Harga yang tertera adalah harga satuan.
                                            Contoh Yang benar:
                                            Minimal pembelian 3 Pcs harga satuannya Rp 5000.

                                            Contoh yang salah:
                                            Minimal pembelian 3 Pcs harga satuannya Rp 15.000.
                                            </div>
                                            <div class="form-group">
                                                <div class="grosir">
                                                    <p class="text-center grosir-default">Tidak ada data Grosir</p>
                                                </div>
                                            </div>
                                       </div>
                                       <!-- /.card-body -->
                                    </div>
                                 </div>
                                 <!-- /.card-body -->
                                 <div class="card-footer">
                                    <button type="submit" class="btn btn-info">
                                       <i class="fa fa-save"></i> SIMPAN
                                    </button>
                                    <button type="submit" class="btn btn-default float-right">Cancel</button>
                                 </div>
                                 <!-- /.card-footer -->
                              </form>
                              <!-- / .form -->
                           </div>
                           <!-- / .card-body -->
                           <div class="overlay" id="form-loading" style="display: none;"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>
                        </div>
                        <!-- /.card -->
                     </div>
                     <!-- /.col-lg-6 -->
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
<?php
   $this->load->view('v2/dashboard/js');
?>
<script type="text/javascript">
    $(document).ready(function(){

      function btnRemoveGrosir() {
            var removeGrosir = document.querySelectorAll('.remove-grosir-item'); 
            [].forEach.call(removeGrosir, function(elm) {
                $(elm).click(function(){
                    var itemGrosir = $(this).closest('.item-grosir');
                    $(itemGrosir).remove();
                    if ($('.item-grosir').length <= 0) {
                        $('.grosir').html('<p class="text-center grosir-default">Tidak ada data Grosir</p>');
                    }
                });
            });
        }

        function btnAddGrosir() {
            $('.add-grosir').click(function(){
                if ($('.grosir-default')) {
                    $('.grosir-default').remove();
                }
                $('.grosir').append(
                    '<div class="item-grosir row">'
                        +'<div class="col-md-5 col-sm-6 form-group row">'
                            +'<label class="control-label">Min beli</label>'
                                +'<input type="text" class="col-md-5 form-control" name="grosir[min][]">'
                        +'</div>'
                        +'<div class="col-md-5 col-sm-6 form-group row">'
                            +'<label class="control-label">Harga Grosir</label>'
                                +'<input type="text" class="col-md-8 form-control harga" name="grosir[harga_jual_grosir][]">'
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

        function executeAlertMessage(alertMessage = 'wohe', alertType = 'info') {
          var Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000
            });

          Toast.fire({
            icon: alertType,
            title: alertMessage
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

        function ajax_form() {
          $('#form_barang').on('submit', function(e) {
              e.preventDefault();
              $('#form-loading').show();
              data = $(this).serialize();
              $.ajax({
                  url : $(this).attr('action'),
                  dataType : 'JSON',
                  type : "POST",
                  data : data
              }).done(function(r) {
                  $('#form-loading').hide();
                  console.log(r);
                  if (r.status) {
                      executeAlertMessage(r.message, r.messageType);
                  } else {
                      executeAlertMessage(r.message, r.messageType);
                  }
              }).fail(function() {
                  $('#form-loading').hide();
              });
          });
        }

        function ajax_get_list_jenis() {
            $('#select-kategori').on('select2:select', function (e) {
               var data = e.params.data;
               var id = data.id;
               $.ajax({
                   url : baseUrl+'jenis/get_list_jenis_by_kategori/'+id
               }).done(function(r) {
                  $('.ajax-jenis').html(r);
                  $('#select-jenis').select2();
               }).fail(function(jqXHR, textStatus) {
                  console.log(textStatus);
               });
            });
        }

        function init() {
            $('.select2').select2();
            btnAddGrosir();
            btnRemoveGrosir();
            inputMask();
            ajax_form();
            ajax_get_list_jenis();
        }

        init();
    });
</script>