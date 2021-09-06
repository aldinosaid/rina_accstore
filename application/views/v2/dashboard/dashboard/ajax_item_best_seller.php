<div class="col-md-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Item Best Seller</h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-tool btn-sm">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                        <tr>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Qty Penjualan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($items as $value) :?>
                                        <tr>
                                            <td>
                                                <?php echo $value->kode_brg; ?>
                                            </td>
                                            <td><?php echo $value->nama_brg; ?></td>
                                            <td>
                                                <?php echo $value->qty; ?>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-md-6 -->