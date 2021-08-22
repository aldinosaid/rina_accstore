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

    public function update($args, $id)
    {
        return $this->db
                    ->where(['id' => $id])
                    ->update('jenis', $args);
    }

    public function getAll()
    {
        return $this->db
                    ->get('jenis')
                    ->result();
    }

    public function getJenisById($id)
    {
        $where = [
            'flag' => 0,
            'id' => $id
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
