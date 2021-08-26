<!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0">SEMUA DATA TRANSAKSI</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">DASHBOARD</a></li>
                           <li class="breadcrumb-item active">SEMUA DATA TRANSAKSI</li>
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
                     <div class="col-md-8">
                        <div class="card">
                           <div class="card-header">
                              <h3 class="card-title">SEMUA DATA TRANSAKSI</h3>
                           </div>
                           <!-- /.card-header -->
                           <div class="card-body table-responsive">
                                <div id="result-ajax">
                                    <table id="transaksi" class="table table-bordered table-striped">
                                         <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>NO NOTA</th>
                                                <th>JUMLAH</th>
                                                <th>BAYAR</th>
                                                <th>KEMBALI</th>
                                                <th>TANGGAL TRANSAKSI</th>
                                                <th>AKSI</th>
                                           </tr>
                                         </thead>
                                         <tbody>
                                            <?php
                                                $i = 1;
                                                foreach ($transactions as $transaction) :
                                            ?>
                                                <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $transaction->no_nota; ?></td>
                                                <td><?php echo idr_format($transaction->total); ?></td>
                                                <td><?php echo idr_format($transaction->bayar); ?></td>
                                                <td><?php echo idr_format($transaction->kembali); ?></td>
                                                <td><?php echo idTimeFormat($transaction->tanggal); ?></td>
                                                <td>
                                                <a href="<?php echo base_url('daftar_transaksi/detail/' . $transaction->no_nota); ?>" target="_blank">
                                                    <i class="fa fa-eye"></i> Lihat Detail</a>
                                                </td>
                                                </tr>
                                            <?php
                                                $i++;
                                                endforeach;
                                            ?>
                                         </tbody>
                                      </table>
                                </div>
                           </div>
                           <!-- /.card-body -->
                           <div class="overlay" id="form-loading" style="display: none;"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>
                        </div>
                        <!-- /.card -->
                     </div>
                     <!-- / .col-md -->
                     <div class="col-md-4">
                        <div class="card card-outline card-warning">
                           <div class="card-header">
                              <h3 class="card-title">FILTER DATA TRANSAKSI</h3>
                           </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <!-- form start -->
                                <form class="form-horizontal" id="form_filter" action="<?php echo base_url('daftar_transaksi/ajax_daftar_nota'); ?>" method="POST">
                                    <div class="form-group">
                                        <label>FILTER BERDASARKAN</label>
                                        <div class="input-group">
                                            <button type="button" class="btn btn-default float-right" id="daterange-btn">
                                                <i class="fa fa-calendar"></i>&nbsp;
                                                <span>PILIH TANGGAL</span>
                                                <i class="fa fa-caret-down"></i>
                                                <input type="text" name="start_date" style="display: none;">
                                                <input type="text" name="end_date" style="display: none;">
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-info">
                                           <i class="fa fa-filter"></i> FILTER
                                        </button>
                                    </div>
                                    <!-- /.card-footer -->
                                </form>
                                <!-- / .form -->
                           </div>
                           <!-- / .card-body -->
                        </div>
                        <!-- /.card -->
                     </div>
                  </div>
                  <!-- / .row -->
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
        function reinitAjaxFilter() {
            $('#select-filter').change(function() {
                var filterId = $(this).val();
                
            });
        }

        function ajax_form() {
          $('#form_filter').on('submit', function(e) {
                e.preventDefault();
                $('#form-loading').show();
                data = $(this).serialize();
                $('#form-loading').show();
                $.ajax({
                    url : $(this).attr('action'),
                    dataType : 'JSON',
                    type : "POST",
                    data : data
                }).done(function(r) {
                    $('#form-loading').hide();
                    $('#result-ajax').html(r.html);
                    reinitDataTable();
                }).fail(function(jqXHR, textStatus) {
                    $('#form-loading').hide();
                    Swal.fire(
                      'Gagal!',
                      textStatus,
                      'danger'
                    );
                });
          });
        }

        function reinitDaterange() {
            $('#daterange-btn').daterangepicker({
                ranges   : {
                    'HARI INI'       : [moment(), moment()],
                    'KEMARIN'        : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    '1 MINGGU'       : [moment().subtract(6, 'days'), moment()],
                    '1 BULAN'        : [moment().subtract(29, 'days'), moment()],
                    '2 BULAN'        : [moment().subtract(58, 'days'), moment()],
                    '3 BULAN'        : [moment().subtract(87, 'days'), moment()],
                    'BULAN INI'      : [moment().startOf('month'), moment().endOf('month')],
                    'BULAN KEMARIN'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate  : moment()
            },
            function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('[name=start_date]').val(start.format('YYYY-MM-DD'));
                $('[name=end_date]').val(end.format('YYYY-MM-DD'));
            });
        }

        function reinitDataTable() {
            $("#transaksi").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf"],
                "createdRow": function( row, data, dataIndex){
                    if( data[3] <= 0){
                        $(row).css('color', 'red');
                    }
                }
            }).buttons().container().appendTo('#transaksi_wrapper .col-md-6:eq(0)');
        }

        function init() {
            reinitDataTable();
            $('.select2').select2();
            reinitAjaxFilter();
            reinitDaterange();
            ajax_form();
            $('#reportrange').daterangepicker();
        }

        init();
    });
</script>