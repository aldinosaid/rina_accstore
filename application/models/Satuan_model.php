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

    public function update($args, $id)
    {
        return $this->db
                    ->where(['id' => $id])
                    ->update('satuan', $args);
    }

    public function getAll()
    {
        return $this->db
                    ->get('satuan')
                    ->result();
    }

    public function getSatuanById($id)
    {
        $where = [
            'flag' => 0,
            'id' => $id
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
