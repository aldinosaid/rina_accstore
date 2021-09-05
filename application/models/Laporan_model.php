<?php

/**
*
*/
class Laporan_model extends CI_Model
{

    public function get_ringkasan_penjualan($start_date, $end_date) {
        $total_transaction = $this->get_data_count_transaction($start_date, $end_date);
        $data_ringkasan_penjualan = $this->db
                    ->select('SUM(`DT`.`QTY`*`DT`.`harga_beli`) as total_harga_beli, SUM(`DT`.`QTY`*`DT`.`harga_jual`) as total_harga_jual, (SUM(`DT`.`QTY`*`DT`.`harga_jual`)-SUM(`DT`.`QTY`*`DT`.`harga_beli`)) as laba_bersih')
                    ->join('det_penjualan DT', 'DT.no_nota=P.no_nota')
                    ->where("DATE_FORMAT(p.tanggal, '%Y-%m-%d') >=", $start_date)
                    ->where("DATE_FORMAT(p.tanggal, '%Y-%m-%d') <=", $end_date)
                    ->get('penjualan P')
                    ->result();
        $result[0] = (object)array_merge((array)$total_transaction[0], (array)$data_ringkasan_penjualan[0]);

        return $result;
    }

    protected function get_data_count_transaction($start_date, $end_date)
    {
        return $this->db
                    ->select('count(`P`.`no_nota`) as total_transaksi')
                    ->where("DATE_FORMAT(p.tanggal, '%Y-%m-%d') >=", $start_date)
                    ->where("DATE_FORMAT(p.tanggal, '%Y-%m-%d') <=", $end_date)
                    ->get('penjualan P')
                    ->result();
    }

    public function get_data_category_best_seller($start_date, $end_date)
    {
        return $this->db
                    ->select('`K`.`kategori`, sum(`DT`.`qty`) as qty')
                    ->join('det_penjualan DT', 'DT.no_nota=P.no_nota')
                    ->join('barang B', 'B.kode_brg=DT.kode_brg')
                    ->join('kategori K', 'K.kode_kat=B.kode_kat')
                    ->where("DATE_FORMAT(p.tanggal, '%Y-%m-%d') >=", $start_date)
                    ->where("DATE_FORMAT(p.tanggal, '%Y-%m-%d') <=", $end_date)
                    ->group_by('kategori')
                    ->limit(10)
                    ->order_by('qty', 'desc')
                    ->get('penjualan P')
                    ->result();
    }

    public function get_data_item_best_seller($start_date, $end_date)
    {
        return $this->db
                    ->select('`DT`.`kode_brg`, `B`.`nama_brg`, sum(`DT`.`qty`) as qty')
                    ->join('det_penjualan DT', 'DT.no_nota=P.no_nota')
                    ->join('barang B', 'B.kode_brg=DT.kode_brg')
                    ->where("DATE_FORMAT(p.tanggal, '%Y-%m-%d') >=", $start_date)
                    ->where("DATE_FORMAT(p.tanggal, '%Y-%m-%d') <=", $end_date)
                    ->group_by('kode_brg')
                    ->limit(10)
                    ->order_by('qty', 'desc')
                    ->get('penjualan P')
                    ->result();
    }
}
