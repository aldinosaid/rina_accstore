<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">TAMBAH DATA REFERENSI BARU</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">DASHBOARD</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url('referensi'); ?>">REFERENSI</a></li>
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
                    <div class="card" id="card-referensi">
                        <div class="card-header">
                            <h3 class="card-title">ISI DATA REFERENSI</h3>
                        </div>
                        <div class="card-body">
                            <!-- form start -->
                            <form class="form-horizontal" id="form_referensi" action="<?php echo base_url('referensi/save'); ?>" method="POST">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="nama_brg" class="col-sm-2 col-form-label">NAMA BARANG</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="kode_brg" id="select-barang">
                                                <option>- PILIH BARANG -</option>
                                                <?php foreach ($items as $barang) : ?>
                                                <option value="<?php echo $barang->kode_brg; ?>"><?php echo $barang->nama_brg; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="supplier" class="col-sm-2 col-form-label">NAMA SUPPLIER</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" name="id_supplier" id="select-supplier">
                                                <option>- PILIH SUPPLIER -</option>
                                                <?php foreach ($suppliers as $supplier) : ?>
                                                <option value="<?php echo $supplier->id_supplier; ?>"><?php echo $supplier->nama_supplier; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" <?php if (!is_admin()) { echo 'style="display:none;"'; } ?>>
                                        <label for="harga_supplier" class="col-sm-2 col-form-label">HARGA SUPPLIER</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="harga_supplier" class="form-control harga" id="harga_supplier">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="qty" class="col-sm-2 col-form-label">QTY <small>{dalam satuan koli / bal}</small></label>
                                        <div class="col-sm-10">
                                            <input type="text" name="qty" class="form-control" id="qty">
                                        </div>
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
          $('#form_referensi').on('submit', function(e) {
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
    
        function init() {
            $('.select2').select2();
            inputMask();
            ajax_form();
        }
    
        init();
    });
</script>