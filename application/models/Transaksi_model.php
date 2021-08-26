<?php 
/**
*
*/
class Transaksi_model extends CI_Model
{
	public function get_all_transaction()
	{
		return $this->db
                    ->select('*')
                    ->from('penjualan')
                    ->get()
                    ->result();
	}

    public function get_transaction_by_date($start_date, $end_date)
    {
        
        $this->db->where("DATE_FORMAT(tanggal, '%Y-%m-%d') >=", $start_date);
        $this->db->where("DATE_FORMAT(tanggal, '%Y-%m-%d') <=", $end_date);

        return $this->db->get('penjualan')->result();

    }

	public function get_transaction_by_no_nota($no_nota)
	{
		return $this->db
                ->where('no_nota', $no_nota)
                ->get('penjualan')
                ->result();
	}

	public function get_details_transaction($no_nota)
	{
		return $this->db
                    ->select('barang.kode_brg, barang.nama_brg, sum(det_penjualan.qty) as qty, det_penjualan.harga_beli, det_penjualan.harga_jual as harga, (sum(det_penjualan.qty)*det_penjualan.harga_jual) as sub_total')
                    ->join('barang', 'det_penjualan.kode_brg = barang.kode_brg')
                    ->where('det_penjualan.no_nota', $no_nota)
                    ->group_by('kode_brg')
                    ->get('det_penjualan')
                    ->result();
	}
}
?>