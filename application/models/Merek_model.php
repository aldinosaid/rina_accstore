<?php

/**
*
*/
class Merek_model extends CI_Model
{
    public function insert($args)
    {
        return $this->db
                    ->insert('merek', $args);
    }

    public function update($args, $kode_merek)
    {
        return $this->db
                    ->where(['kode_merek' => $kode_merek])
                    ->update('merek', $args);
    }

    public function delete($kode_merek)
    {
        return $this->db
                    ->delete('merek', ['kode_merek' => $kode_merek]);
    }

    public function getAll()
    {
        return $this->db
                    ->get('merek')
                    ->result();
    }

    public function getMerekById($kode_merek)
    {
        $where = [
            'kode_merek' => $kode_merek
        ];

        return $this->db
                    ->where($where)
                    ->get('merek')
                    ->result();
    }

    public function factory_reset() {
        return $this->db
                    ->query('TRUNCATE table merek');   
    }
}
