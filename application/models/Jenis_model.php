<?php

/**
*
*/
class Jenis_model extends CI_Model
{
    public function insert($args)
    {
        return $this->db
                    ->insert('jenis', $args);
    }

    public function update($args, $kode_jenis)
    {
        return $this->db
                    ->where(['kode_jenis' => $kode_jenis])
                    ->update('jenis', $args);
    }

    public function delete($kode_jenis)
    {
        return $this->db
                    ->delete('jenis', ['kode_jenis' => $kode_jenis]);
    }

    public function getAll()
    {
        return $this->db
                    ->get('jenis')
                    ->result();
    }

    public function getJenisById($kode_jenis)
    {
        $where = [
            'kode_jenis' => $kode_jenis
        ];

        return $this->db
                    ->where($where)
                    ->get('jenis')
                    ->result();
    }

    public function factory_reset() {
        return $this->db
                    ->query('TRUNCATE table jenis');   
    }
}
