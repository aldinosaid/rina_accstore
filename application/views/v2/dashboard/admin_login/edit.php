<!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0">UBAH DATA ADMIN PENGGUNA BARU</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="<?php echo base_url('dashboard'); ?>">DASHBOARD</a></li>
                           <li class="breadcrumb-item"><a href="<?php echo base_url('admin_login'); ?>">ADMIN PENGGUNA</a></li>
                           <li class="breadcrumb-item active">UBAH DATA PENGGUNA</li>
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
                        <div class="card" id="card-admin_login">
                           <div class="card-header">
                              <h3 class="card-title">UBAH DATA ADMIN PENGGUNA</h3>
                           </div>
                           <div class="card-body">
                              <!-- form start -->
                              <?php foreach ($users as $value) : ?>
                              <form class="form-horizontal" id="form_admin_login" action="<?php echo base_url('admin_login/update/'.$value->id); ?>" method="POST">
                                 <div class="card-body">
                                    <div class="form-group row">
                                       <label for="name" class="col-sm-4 col-form-label">NAMA ADMIN PENGGUNA</label>
                                       <div class="col-sm-8">
                                          <input type="text" class="form-control" name="name" id="name" value="<?php echo $value->name; ?>" placeholder="NAMA ADMIN PENGGUNA">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="email" class="col-sm-4 col-form-label">EMAIL</label>
                                       <div class="col-sm-8">
                                          <input type="email" class="form-control" name="email" value="<?php echo $value->email; ?>" id="email" placeholder="john@dehli.com">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="pass" class="col-sm-4 col-form-label">PASSWORD</label>
                                       <div class="col-sm-8">
                                          <input type="password" class="form-control" name="pass" id="pass">
                                       </div>
                                    </div>
                                    <div class="form-group row">
                                       <label for="level" class="col-sm-4 col-form-label">LEVEL</label>
                                       <div class="col-sm-8">
                                          <select name="level" class="form-control auto_select" value="<?php echo $value->level; ?>">
                                             <option value="1">KASIR</option>
                                             <option value="2">ADMIN</option>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <div class="custom-control custom-switch">
                                          <input type="checkbox" name="flag" class="custom-control-input" id="flag" <?php if ($value->flag) { echo 'checked'; } ?>>
                                          <label class="custom-control-label" for="flag">Aktif / Tidak aktif</label>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- /.card-body -->
                                 <div class="card-footer">
                                    <button type="submit" class="btn btn-info">
                                       <i class="fa fa-save"></i> SIMPAN
                                    </button>
                                    <a href="<?php echo base_url('admin_login'); ?>" class="btn btn-default float-right">Cancel</a>
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
          $('#form_admin_login').on('submit', function(e) {
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
            ajax_form();
            autoSelect();
        }

        init();
    });
</script>