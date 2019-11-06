<!-- page content -->
<div class="right_col" role="main">
    <?php if ($this->session->flashdata('notification')) : ?>
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong><?php echo $this->session->flashdata('notification'); ?></strong>
            </div>
        </div>
    <?php elseif ($this->session->flashdata('error_notification')) : ?>
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong><?php echo $this->session->flashdata('notification'); ?></strong>
            </div>
        </div>
    <?php endif; ?>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Laporan Penjualan</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="col-md-3 col-xs-12">
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </button>
                        <strong>Start : <?php echo idTimeFormat($start_date); ?></strong>
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        </button>
                        <strong>End : <?php echo idTimeFormat($end_date); ?></strong>
                    </div>
                </div>
                <table id="laporan_penjualan" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Qty</th>
                            <th>Harga Pokok</th>
                            <th>Total</th>
                            <th>Laba</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $laba = 0;
                            foreach ($semua_penjualan as $penjualan) :
                        ?>
                        <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $penjualan->kode_brg; ?></td>
                        <td><?php echo $penjualan->nama_brg; ?></td>
                        <td><?php echo $penjualan->qty; ?></td>
                        <td><?php echo idr_format($penjualan->harga_pokok); ?></td>
                        <td><?php echo idr_format($penjualan->total); ?></td>
                        <td><?php echo idr_format($penjualan->laba); ?></td>
                        </tr>
                        <?php
                            $laba += $penjualan->laba;
                            $no++;
                            endforeach;
                        ?>
                    </tbody>
                    <tfoot> 
                        <tr>
                            <th colspan="5" class="text-center">Jumlah</th>
                            <th><?php echo idr_format($total); ?></th>
                            <th><?php echo idr_format($laba); ?></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="col-md-6 col-sm-12 pull-right">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th><h3>Total</h3></th>
                                <td><h3 class="total"><?php echo idr_format($total); ?></h3></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3 col-md-3 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Filter Laporan</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="control-group">
                    <form class="form-horizontal" action="<?php echo base_url('laporan/penjualan'); ?>" method="POST">
                        <div class="controls">
                            Start Date
                            <div class="form-group">
                                <div class='input-group date' id='startDate'>
                                    <input type='text' name="start_date" value="<?php echo $start_date; ?>" class="form-control" />
                                    <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="controls">
                            End Date
                            <div class="form-group">
                                <div class='input-group date' id='endDate'>
                                    <input type='text' name="end_date" value="<?php echo $end_date; ?>" class="form-control" />
                                    <span class="input-group-addon">
                                       <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <input type="submit" value="Filter" class="btn btn-success btn-lg" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    $this->load->view('dashboard/js');
?>
<script type="text/javascript">
    $(document).ready(function() {
        function getDateNow()
        {
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; 
            var yyyy = today.getFullYear();
            if(dd<10) 
            {
                dd='0'+dd;
            } 

            if(mm<10) 
            {
                mm='0'+mm;
            }
            today = dd+'_'+mm+'_'+yyyy;
            return today;
        }

        $("#laporan_penjualan").DataTable({
          dom: "Blfrtip",
          buttons: [
            {
              extend: "copy",
              title: 'Laporan tanggal '+getDateNow(),
              className: "btn-sm",
              footer: true
            },
            {
              extend: "csvHtml5",
              title: 'Laporan tanggal '+getDateNow(),
              className: "btn-sm",
              footer: true
            },
            {
              extend: "excelHtml5",
              title: 'Laporan tanggal '+getDateNow(),
              className: "btn-sm",
              footer: true
            },
            {
              extend: "pdfHtml5",
              title: 'Laporan tanggal '+getDateNow(),
              className: "btn-sm",
              footer: true
            },
            {
              extend: "print",
              title: 'Laporan tanggal '+getDateNow(),
              className: "btn-sm",
              footer: true
            },
          ],
          responsive: true
        });

        function init_datetime() {
            $('#startDate').datetimepicker({
                format: 'YYYY-MM-DD'
            });
            $('#endDate').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        }

        function init() {
            init_datetime();
        }

        init();
    });
</script>
