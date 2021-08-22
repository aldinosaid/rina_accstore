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

    public function update($args, $id)
    {
        return $this->db
                    ->where(['id' => $id])
                    ->update('merek', $args);
    }

    public function getAll()
    {
        return $this->db
                    ->get('merek')
                    ->result();
    }

    public function getMerekById($id)
    {
        $where = [
            'flag' => 0,
            'id' => $id
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
