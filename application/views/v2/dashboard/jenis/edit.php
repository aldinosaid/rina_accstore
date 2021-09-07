<!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0">UBAH DATA JENIS</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">DASHBOARD</a></li>
                           <li class="breadcrumb-item"><a href="<?php echo base_url('jenis'); ?>">JENIS</a></li>
                           <li class="breadcrumb-item active">UBAH DATA JENIS</li>
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
                        <div class="card" id="card-jenis">
                           <div class="card-header">
                              <h3 class="card-title">UBAH DATA JENIS</h3>
                           </div>
                           <div class="card-body">
                              <!-- form start -->
                              <?php foreach ($jenis as $value) : ?>
                              <form class="form-horizontal" id="form_jenis" action="<?php echo base_url('jenis/update/'.$value->kode_jenis); ?>" method="POST">
                                 <div class="card-body">
                                    <div class="form-group row">
                                       <label for="jenis" class="col-sm-2 col-form-label">NAMA JENIS</label>
                                       <div class="col-sm-10">
                                            <input type="text" name="kode_jenis" value="<?php echo $value->kode_jenis; ?>" style="display: none;">
                                            <input type="text" class="form-control" name="jenis" id="jenis" value="<?php echo $value->jenis; ?>" placeholder="NAMA JENIS">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="kategori" class="col-sm-2 col-form-label">KATEGORI</label>
                                       <div class="col-sm-10">
                                          <select class="form-control select2 auto_select" value="<?php echo $value->kode_kat; ?>" name="kode_kat" id="select-kategori">
                                             <option>- PILIH KATEGORI -</option>
                                             <?php foreach ($kategories as $kategori) : ?>
                                                 <option value="<?php echo $kategori->kode_kat; ?>"><?php echo $kategori->kategori; ?></option>
                                             <?php endforeach; ?>
                                         </select>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- /.card-body -->
                                 <div class="card-footer">
                                    <button type="submit" class="btn btn-info">
                                       <i class="fa fa-save"></i> SIMPAN
                                    </button>
                                    <a href="<?php echo base_url('jenis'); ?>" class="btn btn-default float-right">Cancel</a>
                                 </div>
                                 <!-- /.card-footer -->
                              </form>
                              <!-- / .form -->
                              <?php endforeach; ?>
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

        function ajax_form() {
          $('#form_jenis').on('submit', function(e) {
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

        function autoSelect() {
            $.each($(".auto_select"), function(i, elm){
                var itemValue = $(this).attr('value');
                if ($(this).hasClass('select2')) {
                    $(this).val(itemValue);
                    $(this).trigger('change');
                } else {
                    $(this).find('option[value='+itemValue+']').attr('selected', true);
                }
            });
        }

        function init() {
            autoSelect();
            $('.select2').select2();
            ajax_form();
        }

        init();
    });
</script>