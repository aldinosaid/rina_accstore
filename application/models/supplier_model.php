<?php

/**
*
*/
class Supplier_model extends CI_Model
{
    public function insert($args)
    {
        return $this->db
                    ->insert('supplier', $args);
    }

    public function update($args, $id_supplier)
    {
        return $this->db
                    ->where(['id_supplier' => $id_supplier])
                    ->update('supplier', $args);
    }

    public function delete($id_supplier)
    {
        return $this->db
                    ->delete('supplier', ['id_supplier' => $id_supplier]);
    }

    public function getAll()
    {
        return $this->db
                    ->get('supplier')
                    ->result();
    }

    public function getSupplierById($id_supplier)
    {
        $where = [
            'id_supplier' => $id_supplier
        ];

        return $this->db
                    ->where($where)
                    ->get('supplier')
                    ->result();
    }

    public function factory_reset() {
        return $this->db
                    ->query('TRUNCATE table supplier');   
    }
}
