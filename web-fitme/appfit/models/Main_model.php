<?php
class Main_model extends CI_Model {

	// Get data
	public function listDisease($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_disease');
		return $query->result_array();
	}

	public function listUser($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_user');
		return $query->result_array();
	}

	public function listNews($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_news');
		return $query->result_array();
	}

	public function listKnowledge($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_tip');
		return $query->result_array();
	}

	public function listAbout($data = array()){
		$this->db->select($data['fide']);
		if(!empty($data['where'])){$this->db->where($data['where']);}
		if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
		if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
		$query = $this->db->get('tb_about');
		return $query->result_array();
	}

	public function insertData($data = array()){
		$this->db->insert("tb_user",$data);
		return $this->db->insert_id();
	}

	// // Get data
	// public function listShowIntro($data = array()){
	// 	$this->db->select($data['fide']);
	// 	if(!empty($data['where'])){$this->db->where($data['where']);}
	// 	if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
	// 	if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
	// 	$query = $this->db->get('tb_intro');
	// 	return $query->result_array();
	// }

	// // Get news
	// public function listNews($data = array()){
	// 	$this->db->select($data['fide']);
	// 	if(!empty($data['where'])){$this->db->where($data['where']);}
	// 	if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
	// 	if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
	// 	$query = $this->db->get('tb_news');
	// 	return $query->result_array();
	// }

	// // Get purchase
	// public function listshowPurchase($data = array()){
	// 	$this->db->select($data['fide']);
	// 	$this->db->from('tb_purchase', 'tb_purchasegroup');
	// 	$this->db->join('tb_purchasegroup', 'tb_purchasegroup.purchase_group_id = tb_purchase.purchase_group_id');
	// 	if(!empty($data['where'])){$this->db->where($data['where']);}
	// 	if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
	// 	if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
	// 	$query = $this->db->get();
	// 	return $query->result_array();
	// }

	// //select group
	// public function listPurchase($data = array()){
	// 	$this->db->select($data['fide']);
	// 	$this->db->from('tb_purchase', 'tb_purchasegroup', 'tb_purchasesubgroup');
	// 	$this->db->join('tb_purchasegroup', 'tb_purchasegroup.purchase_group_id = tb_purchase.purchase_group_id');
	// 	$this->db->join('tb_purchasesubgroup', 'tb_purchasesubgroup.purchase_sub_id = tb_purchase.purchase_sub_id');
	// 	if(!empty($data['where'])){$this->db->where($data['where']);}
	// 	if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
	// 	if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
	// 	$query = $this->db->get();
	// 	return $query->result_array();
		
	// }
	
	// //select group
	// public function listPurchaseDetail($data = array()){
	// 	$this->db->select($data['fide']);
	// 	$this->db->from('tb_purchase', 'tb_purchasegroup', 'tb_purchasesubgroup');
	// 	$this->db->join('tb_purchasegroup', 'tb_purchasegroup.purchase_group_id = tb_purchase.purchase_group_id');
	// 	if(!empty($data['where'])){$this->db->where($data['where']);}
	// 	if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
	// 	if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
	// 	$query = $this->db->get();
	// 	return $query->result_array();
		
	// }



	// //select group
	// public function all_menu_info($data = array()){
	// 	$this->db->select($data['fide']);
	// 	if(!empty($data['where'])){$this->db->where($data['where']);}
	// 	if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
	// 	if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
	// 	$query = $this->db->get('tb_purchasegroup');
	// 	return $query->result_array();
		
	// }

	// //select sub group
	// public function all_submenu_info($data = array()){
	// 	$this->db->select($data['fide']);
	// 	if(!empty($data['where'])){$this->db->where($data['where']);}
	// 	if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
	// 	if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
	// 	$query = $this->db->get('tb_purchasesubgroup');
	// 	return $query->result_array();
		
	// }

	// // Get Group, sub group
	// public function listGroup($data = array()){
	// 	$this->db->select($data['fide']);
	// 	$this->db->from('tb_purchasegroup','tb_purchasesubgroup');
	// 	$this->db->join('tb_purchasesubgroup', 'tb_purchasesubgroup.purchase_group_id = tb_purchasegroup.purchase_group_id');
	// 	if(!empty($data['where'])){$this->db->where($data['where']);}
	// 	if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
	// 	if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
	// 	$query = $this->db->get();
	// 	return $query->result_array();
	// }

	// // Get sub data
	// public function listSubcontent($data = array()){
	// 	$this->db->select($data['fide']);
	// 	if(!empty($data['where'])){$this->db->where($data['where']);}
	// 	if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
	// 	if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
	// 	$query = $this->db->get('tb_subcontents');
	// 	return $query->result_array();
	// }

	// // Get settings
	// public function listSettings($data = array()){
	// 	$this->db->select($data['fide']);
	// 	if(!empty($data['where'])){$this->db->where($data['where']);}
	// 	if(!empty($data['orderby'])){$this->db->order_by($data['orderby']);}
	// 	if(!empty($data['limit'])){$this->db->limit($data['limit'][0],$data['limit'][1]);}
	// 	$query = $this->db->get('tb_settings');
	// 	return $query->result_array();
	// }

}
?>
