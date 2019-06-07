<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->lang->load(array('admin_page_lang','admin_form_lang'), 'english');
		$this->load->model("user_model","user");
	}

	public function index(){
		$data = array();

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->user->listApp($condition);

		// List data contents
		$condition = array();
		$condition['fide'] = "*";
		$condition['orderby'] = "tb_user.lastedit_date asc";
		$data['listdata'] = $this->user->listData($condition);

		$this->template->backend('user/main',$data);
	}

	public function form($id = ""){
		
		$data = array();

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->type->listApp($condition);

		//Data in case update
		if(!empty($id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('type_id' => $id,'type_show !=' => 0);
			$data['listdata'] = $this->type->listData($condition);
			
			if(count($data['listdata']) == 0){
				show_404();
			}
		}

		$data['crform'] = $this->tokens->token('crform');

		$this->template->backend('type/form',$data);
	}

	public function create(){
		if($this->tokens->verify('crform')){
			$data['type_title'] = $this->input->post('Text_title');
			$data['type_show'] = $this->input->post('Text_eye');
			$data['lastedit_name'] = $this->encryption->decrypt($this->input->cookie('sysn'));
			$data['lastedit_date'] = date('Y-m-d H:i:s');
			$Id = $this->type->insertData($data);
			$result = array(
				'error' => false,
				'url' => site_url('type/form/'.$Id)
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
			$data['type_id'] = $this->input->post('Id');
			$data['type_title'] = $this->input->post('Text_title');
			$data['type_show'] = $this->input->post('Text_eye');
			$data['lastedit_name'] = $this->encryption->decrypt($this->input->cookie('sysn'));
			$data['lastedit_date'] = date('Y-m-d H:i:s');
			
			$this->type->updateData($data);
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
				'type_id' => $Id
			);
			$this->type->deleteData($data);
			
		header("location:".site_url('type/index'));
	}
}
