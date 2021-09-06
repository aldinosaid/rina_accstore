<table id="transaksi" class="table table-bordered table-striped">
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
        foreach ($keranjang as $item) :
    ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $item->kode_brg; ?></td>
            <td><?php echo $item->nama_brg; ?></td>
            <td><?php echo $item->qty; ?></td>
            <td><?php echo idr_format($item->harga); ?></td>
            <td>
            <a href="<?php echo base_url('penjualan/hapus/' . $item->kode_brg); ?>" class="remove" kode_brg="<?php echo $item->kode_brg; ?>">
            <i class="fa fa-times-circle"></i>
            </a>
            </td>
        </tr>
    <?php
        $i++;
        endforeach;
    ?>
 </tbody>
</table>