<?php
class Settings_model extends CI_Model {

	// Get data
	public function listdata($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['condition'])){$this->db->where($data['condition']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_app');
		return $query->result_array();
	}

	// Update data
	public function updateData($data = array()){
		$this->db->where(array('app_id' => $data['app_id']));
		$this->db->update("tb_app",$data);
		return $data['app_id'];
	}

}
?>
