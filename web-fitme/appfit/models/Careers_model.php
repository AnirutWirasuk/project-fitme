<?php
class Careers_model extends CI_Model {

	// Get data
	public function listData($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_jobposition');
		return $query->result_array();
	}

	// Get data page
	public function listDatapage($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_contents');
		return $query->result_array();
	}

	// Get settings
	public function listSettings($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_settings');
		return $query->result_array();
	}

	// Count all careers
	public function count_all_careers(){
		$this->db->select('job_id');
		$this->db->where(array('job_show' => 1));
		$query = $this->db->get('tb_jobposition');
		return count($query->result_array());
	}

	public function jobPerpage(){
		$this->db->select('set_perpage_knowledge');
		$query = $this->db->get('tb_settings');
		$list = $query->result_array();
		return $list[0]['set_perpage_knowledge'];
	}

	public function saveapply($data = array()){
		$this->db->insert("tb_application",$data);
		return $this->db->insert_id();
	}

}
?>
