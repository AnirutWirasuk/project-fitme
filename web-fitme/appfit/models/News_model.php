<?php
class News_model extends CI_Model {

	// Get data
	public function listData($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_news');
		return $query->result_array();
	}

	// Get knowledge
	public function listKnowledge($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_knowledge');
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

	// Count all news
	public function count_all_news(){
		$this->db->select('news_id');
		$this->db->where(array('news_show' => 1));
		$query = $this->db->get('tb_news');
		return count($query->result_array());
	}

	public function newsPerpage(){
		$this->db->select('set_perpage_news');
		$query = $this->db->get('tb_settings');
		$list = $query->result_array();
		return $list[0]['set_perpage_news'];
	}

}
?>
