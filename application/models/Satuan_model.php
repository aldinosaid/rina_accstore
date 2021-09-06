<?php

/**
*
*/
class Satuan_model extends CI_Model
{
    public function insert($args)
    {
        return $this->db
                    ->insert('satuan', $args);
    }

    public function update($args, $kode_satuan)
    {
        return $this->db
                    ->where(['kode_satuan' => $kode_satuan])
                    ->update('satuan', $args);
    }

    public function delete($kode_satuan)
    {
        return $this->db
                    ->delete('satuan', ['kode_satuan' => $kode_satuan]);
    }

    public function getAll()
    {
        return $this->db
                    ->get('satuan')
                    ->result();
    }

    public function getSatuanById($kode_satuan)
    {
        $where = [
            'kode_satuan' => $kode_satuan
        ];

        return $this->db
                    ->where($where)
                    ->get('satuan')
                    ->result();
    }

    public function factory_reset() {
        return $this->db
                    ->query('TRUNCATE table satuan');   
    }
}
