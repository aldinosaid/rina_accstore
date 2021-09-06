<div class="col-md-6">
                        <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Kategori Best Seller</h3>
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
                                            <th>Nama Kategori</th>
                                            <th>Qty Penjualan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($categories as $category) :?>
                                        <tr>
                                            <td>
                                                <?php echo $category->kategori; ?>
                                            </td>
                                            <td>
                                                <?php echo $category->qty; ?>
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
                </div>
                <!-- /.ajax-category-best-seller -->