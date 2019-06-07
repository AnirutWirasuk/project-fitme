<?php
class Category_model extends CI_Model {

	// Get seting 
	public function listApp($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_app');
		return $query->result_array();
	}

	// Get data
	public function listData($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_category');
		return $query->result_array();
	}

	// Insert data
	public function insertData($data = array()){
		$this->db->insert("tb_category",$data);
		return $this->db->insert_id();
	}

	// Update data
	public function updateData($data){
		$this->db->where(array('cate_id' => $data['cate_id']));
		$this->db->update("tb_category",$data);
		return $data['cate_id'];
	}

	public function deleteData($data){
		$id = $data['cate_id'];
		$this->db->where(array('cate_id' => $id));
		$this->db->delete("tb_category",$data);
	}
}
?>
