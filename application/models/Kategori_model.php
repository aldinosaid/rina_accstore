<?php

/**
*
*/
class Kategori_model extends CI_Model
{
    public function insert($args)
    {
        return $this->db
                    ->insert('kategori', $args);
    }

    public function update($args, $kode_kat)
    {
        return $this->db
                    ->where(['kode_kat' => $kode_kat])
                    ->update('kategori', $args);
    }

    public function delete($kode_kat)
    {
        return $this->db
                    ->delete('kategori', ['kode_kat' => $kode_kat]);
    }

    public function getAll()
    {
        return $this->db
                    ->where(['flag' => 0])
                    ->get('kategori')
                    ->result();
    }

    public function getKategoriById($kode_kat)
    {
        $where = [
            'flag' => 0,
            'kode_kat' => $kode_kat
        ];

        return $this->db
                    ->where($where)
                    ->get('kategori')
                    ->result();
    }

    public function factory_reset() {
        return $this->db
                    ->query('TRUNCATE table kategori');   
    }
}
