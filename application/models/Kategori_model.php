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

    public function update($args, $id)
    {
        return $this->db
                    ->where(['id' => $id])
                    ->update('kategori', $args);
    }

    public function getAll()
    {
        return $this->db
                    ->where(['flag' => 0])
                    ->get('kategori')
                    ->result();
    }

    public function getKategoriById($id)
    {
        $where = [
            'flag' => 0,
            'id' => $id
        ];

        return $this->db
                    ->where($where)
                    ->get('kategori')
                    ->result();
    }
}
