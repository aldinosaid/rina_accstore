<?php

/**
*
*/
class Barang_model extends CI_Model
{
    public function insert($args)
    {
        return $this->db
                    ->insert('barang', $args);
    }

    public function delete($id)
    {
        return $this->db
                    ->delete('barang', ['id' => $id]);
    }

    public function update($args, $id)
    {
        return $this->db
                    ->where(['id' => $id])
                    ->update('barang', $args);
    }

    public function getById($where)
    {
        return $this->db
                    ->where($where)
                    ->get('barang')
                    ->result();
    }

    public function getByBarcode($where)
    {
        return $this->db
                    ->where($where)
                    ->get('barang')
                    ->result();
    }

    public function getAll()
    {
        return $this->db
                    ->select('B.id, B.kode_brg, B.nama_brg, S.kode_satuan, S.satuan, M.kode_merek, M.merek, J.kode_jenis, J.jenis, K.kode_kat, K.kategori, B.qty, B.harga_beli, B.harga_jual')
                    ->join('satuan S', 'S.kode_satuan=B.kode_satuan', 'left')
                    ->join('merek M', 'M.kode_merek=B.kode_merek', 'left')
                    ->join('jenis J', 'J.kode_jenis=B.kode_jenis', 'left')
                    ->join('kategori K', 'K.kode_kat=B.kode_kat', 'left')
                    ->where(['B.flag' => 0])
                    ->get('barang B')
                    ->result();
    }

    public function getByTerm($term)
    {
        return $this->db
                    ->like($term)
                    ->get('barang')
                    ->result();
    }

    public function getMaxId($kode_brg)
    {
        return $this->db
                    ->select('max(RIGHT(kode_brg, 6)) as kode_brg')
                    ->like($kode_brg)
                    ->get('barang')
                    ->result();
    }

    public function getItemOrderByBarcode() {

        return $this->db
                    ->where("barcode != ''", null, false)
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
        return $this->db
                    ->query('TRUNCATE table barang');   
    }
}
