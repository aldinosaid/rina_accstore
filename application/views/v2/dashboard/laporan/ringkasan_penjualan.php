<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">RINGKASAN PENJUALAN</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">DASHBOARD</a>
                        </li>
                        <li class="breadcrumb-item active">RINGKASAN PENJUALAN</li>
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
                <div class="col-md-6">
                    <div class="card card-outline card-warning">
                        <div class="card-header">
                            <h3 class="card-title">FILTER DATA TRANSAKSI</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <!-- form start -->
                            <form class="form-horizontal" id="form_filter" action="
                                <?php echo base_url('laporan/ajax_filter'); ?>" method="POST">
                                <div class="form-group">
                                    <label>FILTER BERDASARKAN</label>
                                    <div class="input-group">
                                        <button type="button" class="btn btn-default float-right" id="daterange-btn">
                                            <i class="fa fa-calendar"></i>&nbsp; <span>PILIH TANGGAL</span>
                                            <i class="fa fa-caret-down"></i>
                                            <input type="text" name="start_date" style="display: none;">
                                            <input type="text" name="end_date" style="display: none;">
                                        </button>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fa fa-filter"></i> FILTER </button>
                                </div>
                                <!-- /.card-footer -->
                            </form>
                            <!-- / .form -->
                        </div>
                        <!-- / .card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- / .col-md-6 -->
                <div class="col-lg-3 col-4">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $ringkasan_laporan[0]->total_transaksi; ?></h3>
                            <p>Total Transaksi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="javascript:void(0);" class="small-box-footer"> More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div id="result-ajax-reingkasan-penjualan">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">PENJUALAN</h3>
                                <small>( total penjualan kotor - diskon ) + pajak</small>
                            </div>
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>KETERANGAN</th>
                                            <th>JUMLAH</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Penjualan Kotor</td>
                                            <td><?php echo idr_format($ringkasan_laporan[0]->total_harga_jual); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Diskon</td>
                                            <td>Rp 0</td>
                                        </tr>
                                        <tr>
                                            <td><b>Total Penjualan Bersih</b></td>
                                            <td><?php echo idr_format($ringkasan_laporan[0]->total_harga_jual); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Pajak</td>
                                            <td>Rp 0</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total Penjualan</th>
                                            <td><?php echo idr_format($ringkasan_laporan[0]->total_harga_jual); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">KEUNTUNGAN </h3>
                                <small>( total penjualan bersih - harga modal )</small>
                            </div>
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>KETERANGAN</th>
                                            <th>JUMLAH</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Total Penjualan Bersih</td>
                                            <td><?php echo idr_format($ringkasan_laporan[0]->total_harga_jual); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Harga Modal</td>
                                            <td><?php echo idr_format($ringkasan_laporan[0]->total_harga_beli); ?></td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total Keuntungan</th>
                                            <td><?php echo idr_format($ringkasan_laporan[0]->laba_bersih); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- / .row -->
            </div>
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
                    $('#result-ajax-reingkasan-penjualan').html(r.html);
                    var total_transaksi = '<h3>'+r.report_data.total_transaksi+'</h3>'
                    +'<p>Total Transaksi</p>';
                    $('.inner').html(total_transaksi);
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

        function init() {
            $('.select2').select2();
            reinitAjaxFilter();
            reinitDaterange();
            ajax_form();
            $('#reportrange').daterangepicker();
        }

        init();
    });
</script>