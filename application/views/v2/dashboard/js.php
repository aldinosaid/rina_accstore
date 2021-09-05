      <!-- jQuery -->
      <script src="<?php echo base_url('assets/v2/plugins/jquery/jquery.min.js'); ?>"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="<?php echo base_url('assets/v2/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>
      <script>
        $.widget.bridge('uibutton', $.ui.button)
      </script>
      <!-- Bootstrap -->
      <script src="<?php echo base_url('assets/v2/plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
      <!-- required javascript -->
      <script type="text/javascript">
         var baseUrl = '<?php echo base_url(); ?>';
      </script>
      <?php
         if (isset($required_js)) {
            foreach ($required_js as $path) {
               echo '<script src="' . base_url('assets/v2/'. $path) . '"></script>';
            }
         }
      ?>
      <script src="<?php echo base_url('assets/v2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
      <!-- AdminLTE -->
      <script src="<?php echo base_url('assets/v2/dist/js/adminlte.js'); ?>"></script>
      <!-- OPTIONAL SCRIPTS -->
      <script src="<?php echo base_url('assets/v2/plugins/chart.js/Chart.min.js'); ?>"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="<?php echo base_url('assets/v2/dist/js/demo.js'); ?>"></script>
      <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
      <script src="<?php echo base_url('assets/v2/dist/js/pages/dashboard3.js'); ?>"></script>