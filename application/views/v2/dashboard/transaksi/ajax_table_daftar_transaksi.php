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