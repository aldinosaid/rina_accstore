<?php

/**
*
*/
class Laporan_model extends CI_Model
{
    public function getLaporanPenjualan($args)
    {
        $start_date = $args['start_date'];
        $end_date = $args['end_date'];
        return $this->db
                    ->select('DT.kode_brg, P.tanggal, B.nama_brg, sum(DT.qty) as qty, DT.harga_jual as harga_pokok, (sum(DT.qty)*DT.harga_jual) as total, (sum(DT.qty)*sum(DT.harga_jual-DT.harga_beli)) as laba')
                    ->join('penjualan P', 'P.no_nota=DT.no_nota')
                    ->join('barang B', 'B.kode_brg=DT.kode_brg')
                    ->where("DATE_FORMAT(p.tanggal, '%Y-%m-%d') >=", $start_date)
                    ->where("DATE_FORMAT(p.tanggal, '%Y-%m-%d') <=", $end_date)
                    ->group_by('kode_brg, harga_pokok')
                    ->get('det_penjualan DT')
                    ->result();
    }
}
