<div class="modal fade" id="modal-data-barang">
    <div class="modal-dialog modal-lg">
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
                            <th>QTY</th>
                            <th>HARGA</th>
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
                        <td><?php echo $value->qty; ?></td>
                        <td><?php echo idr_format($value->harga_jual); ?></td>
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