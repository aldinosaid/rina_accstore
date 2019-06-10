<?php

/**
*
*/
class Penjualan_model extends CI_Model
{
    public function addKeranjang($args)
    {
        return $this->db
                    ->insert('keranjang', $args);
    }

    public function updateKeranjang($args, $where)
    {
        return $this->db
                    ->where($where)
                    ->update('keranjang', $args);
    }

    public function count()
    {
        return $this->db
                    ->select('sum(qty*harga_jual) as total')
                    ->get('keranjang')
                    ->result();
    }

    public function getItemByBarcode($data)
    {
        return $this->db
                    ->where($data)
                    ->get('keranjang')
                    ->result();
    }

    public function saveDet($no_nota)
    {
        $sql = "insert into det_penjualan (no_nota, kode_brg, qty , harga_beli, harga_jual) select '". $no_nota ."', kode_brg, qty, harga_beli, harga_jual from keranjang";
        return $this->db->query($sql);
    }

    public function hapusBrg($kode_brg)
    {
        return $this->db
                    ->delete('keranjang', array('kode_brg' => $kode_brg));
    }

    public function clearKeranjang()
    {
        $sql = 'delete from keranjang';
        $this->db->query($sql);
    }

    public function getBarangByBarcode($barcode)
    {
        $where = [
            'flag' => 0,
            'barcode' => $barcode
        ];

        return $this->db
                    ->where($where)
                    ->get('barang')
                    ->result();
    }

    public function getMaxNota($date)
    {
        return $this->db
                    ->select('max(RIGHT(no_nota, 4)) as no_nota')
                    ->like($date)
                    ->get('penjualan')
                    ->result();
    }

    public function createNota($data)
    {
        return $this->db
                    ->insert('penjualan', $data);
    }

    public function getById($where)
    {
        return $this->db
                    ->where($where)
                    ->get('barang')
                    ->result();
    }

    public function getDetOrders($no_nota)
    {
        return $this->db
                    ->select('barang.kode_brg, barang.nama_brg, sum(det_penjualan.qty) as qty, det_penjualan.harga_beli, det_penjualan.harga_jual as harga, (sum(det_penjualan.qty)*det_penjualan.harga_jual) as sub_total')
                    ->join('barang', 'det_penjualan.kode_brg = barang.kode_brg')
                    ->where('det_penjualan.no_nota', $no_nota)
                    ->group_by('kode_brg')
                    ->get('det_penjualan')
                    ->result();
    }

    public function getAll()
    {
        return $this->db
                    ->select('barang.kode_brg, barang.nama_brg, sum(keranjang.qty) as qty, keranjang.harga_beli, keranjang.harga_jual as harga, (sum(keranjang.qty)*keranjang.harga_jual) as sub_total')
                    ->join('barang', 'keranjang.kode_brg = barang.kode_brg')
                    ->group_by('kode_brg')
                    ->get('keranjang')
                    ->result();
    }

    public function getMaxId($kodeKat)
    {
        return $this->db
                    ->select('max(RIGHT(kode_brg, 6)) as kode_brg')
                    ->like($kodeKat)
                    ->get('barang')
                    ->result();
    }

    public function getBarangById($id)
    {
        $where = [
            'flag' => 0,
            'id' => $id
        ];

        return $this->db
                    ->where($where)
                    ->get('barang')
                    ->result();
    }

    public function factory_reset() {
        if ($this->db->query('TRUNCATE table penjualan')) {
            return $this->db->query('TRUNCATE table det_penjualan');
        }
    }
}
