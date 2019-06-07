<?php
class Knowledge_model extends CI_Model {

	// Get data
	public function listData($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(isset($data['notin']) && count($data['notin']) != 0){$this->db->where_not_in($data['notin']['key'],$data['notin']['value']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_knowledge');
		return $query->result_array();
	}

	// Get news
	public function listNews($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_news');
		return $query->result_array();
	}

	// Get activity
	public function listActivity($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_gallery');
		return $query->result_array();
	}

	// Count all knowledge
	public function count_all_knowledge(){
		$this->db->select('know_id');
		$this->db->where(array('know_status' => 1));
		$query = $this->db->get('tb_knowledge');
		return count($query->result_array());
	}

	public function knowledgePerpage(){
		$this->db->select('set_perpage_knowledge');
		$query = $this->db->get('tb_settings');
		$list = $query->result_array();
		return $list[0]['set_perpage_knowledge'];
	}

}
?>
