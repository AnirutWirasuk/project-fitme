<?php
class Tip_model extends CI_Model {

	// Get seting 
	public function listApp($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_app');
		return $query->result_array();
	}

	public function listDis($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_disease');
		return $query->result_array();
	}

	public function listDis_Tip($data = array()){
		$this->db->select($data['fide']);
		$this->db->from('tb_tip');
		$this->db->join('tb_disease', 'tb_disease.dis_id = tb_tip.dis_id');
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get();
		return $query->result_array();
	}

	// Get data
	public function listData($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_tip');
		return $query->result_array();
	}

	// Insert data
	public function insertData($data = array()){
		$this->db->insert("tb_tip",$data);
		return $this->db->insert_id();
	}

	// Update data
	public function updateData($data){
		$this->db->where(array('tip_id' => $data['tip_id']));
		$this->db->update("tb_tip",$data);
		return $data['tip_id'];
	}

	public function deleteData($data){
		$id = $data['tip_id'];
		$this->db->where(array('tip_id' => $id));
		$this->db->delete("tb_tip",$data);
	}
}
?>
