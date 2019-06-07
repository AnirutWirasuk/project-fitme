<?php

class Purchase_model extends CI_Model
{
    // Get data
    public function listData($data = array())
    {
        $this->db->select($data['fide']);
        if (!empty($data['where'])) { $this->db->where($data['where']); }
        if (!empty($data['orderby'])) { $this->db->order_by($data['orderby']);}
        if (!empty($data['limit'])) { $this->db->limit($data['limit'][0], $data['limit'][1]);}
        $query = $this->db->get('tb_contents');

        return $query->result_array();
    }

    // Select Menu
    public function listGroup($data = array())
    {
        $this->db->select($data['fide']);
        if (!empty($data['where'])) { $this->db->where($data['where']); }
        if (!empty($data['orderby'])) { $this->db->order_by($data['orderby']);}
        if (!empty($data['limit'])) { $this->db->limit($data['limit'][0], $data['limit'][1]);}
        $query = $this->db->get('tb_purchasegroup');

        return $query->result_array();
    }

    public function listSubGroup($data = array())
    {
        $this->db->select($data['fide']);
        if (!empty($data['where'])) { $this->db->where($data['where']); }
        if (!empty($data['orderby'])) { $this->db->order_by($data['orderby']);}
        if (!empty($data['limit'])) { $this->db->limit($data['limit'][0], $data['limit'][1]);}
        $query = $this->db->get('tb_purchasesubgroup');

        return $query->result_array();
    }

    public function listPurchase($data = array())
    {
        $this->db->select($data['fide']);
        $this->db->from('tb_purchase', 'tb_purchasegroup');
		$this->db->join('tb_purchasegroup', 'tb_purchasegroup.purchase_group_id = tb_purchase.purchase_group_id');
        if (!empty($data['where'])) { $this->db->where($data['where']); }
        if (!empty($data['orderby'])) { $this->db->order_by($data['orderby']);}
        if (!empty($data['limit'])) { $this->db->limit($data['limit'][0], $data['limit'][1]);}
        $query = $this->db->get();

        return $query->result_array();
    }

    public function count_all_news()
    {
        $this->db->select('pur_id');
        $this->db->where(array('pur_show' => 1, 'pur_status' => 1));
        $query = $this->db->get('tb_purchase');

        return count($query->result_array());
    }

}
