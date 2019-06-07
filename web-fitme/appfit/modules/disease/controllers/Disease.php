<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Disease extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->lang->load(array('admin_page_lang','admin_form_lang'), 'english');
		$this->load->model("disease_model","disease");
	}

	public function index(){
		$data = array();

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->disease->listApp($condition);

		// List data contents
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('dis_id !=' => 1);
		$condition['orderby'] = "dis_sort ASC";
		$data['listdata'] = $this->disease->listData($condition);

		$this->template->backend('disease/main',$data);
	}

	public function form($id = ""){
		
		$data = array();

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->disease->listApp($condition);

		//Data in case update
		if(!empty($id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('dis_id' => $id,'dis_show !=' => 0);
			$data['listdata'] = $this->disease->listData($condition);
			
			if(count($data['listdata']) == 0){
				show_404();
			}
		}

		$data['crform'] = $this->tokens->token('crform');

		$this->template->backend('disease/form',$data);
	}

	public function create(){
		if($this->tokens->verify('crform')){
			$data['dis_name'] = $this->input->post('Text_title');
			$data['dis_show'] = $this->input->post('Text_eye');
			$data['dis_sort'] = $this->input->post('Text_sort');
			$data['lastedit_name'] = $this->encryption->decrypt($this->input->cookie('sysn'));
			$data['lastedit_date'] = date('Y-m-d H:i:s');
			$Id = $this->disease->insertData($data);
			$result = array(
				'error' => false,
				'url' => site_url('disease/form/'.$Id)
			);
			echo json_encode($result);
		}else{
			$result = array(
				'error' => true,
				'title' => "Error",
				'msg' => "No tokens"
			);
			echo json_encode($result);
		}
	}

	public function update(){
		if($this->tokens->verify('crform')){
			$data['dis_id'] = $this->input->post('Id');
			$data['dis_name'] = $this->input->post('Text_title');
			$data['dis_sort'] = $this->input->post('Text_sort');
			$data['dis_show'] = $this->input->post('Text_eye');
			$data['lastedit_name'] = $this->encryption->decrypt($this->input->cookie('sysn'));
			$data['lastedit_date'] = date('Y-m-d H:i:s');
			
			$this->disease->updateData($data);
			$result = array(
				'error' => false,
				'title' => "อัพเดตข้อมูลเรียบร้อยแล้ว",
				'msg' => ""
			);
			echo json_encode($result);
		}
}

	public function delete($Id){

			$data = array(
				'dis_id' => $Id
			);
			$this->disease->deleteData($data);
			
		header("location:".site_url('disease/index'));
	}
}
