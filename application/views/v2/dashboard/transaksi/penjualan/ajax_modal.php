<div class="modal fade" id="modal-data-barang">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">CARI DATA BARANG</h4>
            </div>
            <div class="modal-body">
                <table id="data-barang" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>KODE BARANG</th>
                            <th>NAMA BARANG</th>
                            <th>STOK TOKO</th>
                            <th>STOK GUDANG</th>
                            <th>HARGA</th>
                            <th>HARGA GROSIR</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            $i = 1;
                        foreach ($barang as $value) :
                        ?>
                        <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $value->kode_brg; ?></td>
                        <td><?php echo $value->nama_brg; ?></td>
                        <td><?php echo $value->stok_toko; ?></td>
                        <td><?php echo $value->stok_gudang; ?></td>
                        <td><?php echo idr_format($value->harga_jual); ?></td>
                        <td><?php $grosir = json_decode($value->grosir); ?>
                            <?php if (!empty($grosir->min)) : ?>
                                <?php if (sizeof($grosir->min) > 0 ) : ?>
                                    <?php foreach ($grosir->min as $key_grosir => $value_grosir) : ?>
                                        Min : <?php echo $grosir->min[$key_grosir]; ?>
                                        @<?php echo $grosir->harga_jual_grosir[$key_grosir]; ?>
                                        <br>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    TIDAK ADA DATA GROSIR
                                <?php endif; ?>
                            <?php else :?>
                                TIDAK ADA DATA GROSIR
                            <?php endif; ?>
                        </td>
                        <td>
                        <button class="btn btn-primary pilih-barang" kode_brg="<?php echo $value->kode_brg; ?>"><i class="fa fa-plus"></i> Pilih</button>
                        </td>
                        </tr>
                        <?php
                        $i++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->