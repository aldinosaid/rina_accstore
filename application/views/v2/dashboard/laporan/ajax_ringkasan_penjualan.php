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