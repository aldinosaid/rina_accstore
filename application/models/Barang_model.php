<?php  

/**
* 
*/
class Barang_model extends CI_Model
{
	public function insert($args) {
		return $this->db
					->insert('barang', $args);
	}

	public function update($args, $id) {
		return $this->db
					->where(['id' => $id])
					->update('barang', $args);
	}

	public function getById($where) {
		return $this->db
					->where($where)
					->get('barang')
					->result();
	}

	public function getAll() {
		return $this->db
					->where(['flag' => 0])
					->get('barang')
					->result();
	}

	public function getByTerm($term) {
		return $this->db
					->like($term)
					->get('barang')
					->result();
	}

	public function getMaxId($kodeKat) {
		return $this->db
					->select('max(RIGHT(kode_brg, 6)) as kode_brg')
					->like($kodeKat)
					->get('barang')
					->result();
	}

	public function getBarangById($id) {
		$where = [
			'flag' => 0,
			'id' => $id
		];

		return $this->db
					->where($where)
					->get('barang')
					->result();
	}
}
?>