<?php

/**
*
*/
class Referensi_model extends CI_Model
{
    public function insert($args)
    {
        return $this->db
                    ->insert('referensi', $args);
    }

    public function update($args, $id_referensi)
    {
        return $this->db
                    ->where(['id_referensi' => $id_referensi])
                    ->update('referensi', $args);
    }

    public function delete($id_referensi)
    {
        return $this->db
                    ->delete('referensi', ['id_referensi' => $id_referensi]);
    }

    public function getAll()
    {
        return $this->db
                    ->select('R.id_referensi, B.kode_brg, B.nama_brg, S.id_supplier, S.nama_supplier, R.harga_supplier as harga, R.qty, R.tgl_update as tanggal, M.kode_merek, M.merek')
                    ->join('barang B', 'B.kode_brg=R.kode_brg', 'left')
                    ->join('merek M', 'M.kode_merek=B.kode_merek', 'left')
                    ->join('supplier S', 'S.id_supplier=R.id_supplier', 'left')
                    ->get('referensi R')
                    ->result();
    }

    public function getReferensiById($id_referensi)
    {
        $where = [
            'id_referensi' => $id_referensi
        ];

        return $this->db
                    ->where($where)
                    ->get('referensi')
                    ->result();
    }

    public function factory_reset() {
        return $this->db
                    ->query('TRUNCATE table referensi');   
    }
}
