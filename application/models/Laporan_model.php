<?php

/**
*
*/
class Laporan_model extends CI_Model
{

    public function getRinigkasanPenjualan($start_date, $end_date) {
        return $this->db
                    ->select('count(`DT`.`harga_beli`) as total_transaksi, SUM(`DT`.`QTY`*`DT`.`harga_beli`) as total_harga_beli, SUM(`DT`.`QTY`*`DT`.`harga_jual`) as total_harga_jual, (SUM(`DT`.`QTY`*`DT`.`harga_jual`)-SUM(`DT`.`QTY`*`DT`.`harga_beli`)) as laba_bersih')
                    ->join('det_penjualan DT', 'DT.no_nota=P.no_nota')
                    ->where("DATE_FORMAT(p.tanggal, '%Y-%m-%d') >=", $start_date)
                    ->where("DATE_FORMAT(p.tanggal, '%Y-%m-%d') <=", $end_date)
                    ->get('penjualan P')
                    ->result();
    }
}
