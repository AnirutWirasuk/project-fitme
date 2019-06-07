<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Administrator extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->lang->load(array('admin_page_lang','admin_form_lang'), 'english');
		$this->load->model("administrator_model","administrator");
	}

	public function index($status = ""){
		$data = array();
		$data['formcrf'] = $this->tokens->token('formcrf');
		$data['msg'] = "";
		if($status == "false"){
			$data['msg'] = '<p class="text-danger">ชื่อหรือรหัสผ่าน ไม่ถูกต้อง.</p>';
		}

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listseting'] = $this->administrator->listSeting($condition);

		$this->load->view('administrators/login',$data);
	}

	public function main(){
		$this->permission->admin();
		$data = array();

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->administrator->listSeting($condition);

		//List data administrators
		$condition = array();
		$condition['fide'] = "admin_id,admin_fname,admin_lname,admin_tel,admin_email,lastedit_name,lastedit_date,admin_lastlogin,admin_status";
		$condition['where'] = array('admin_status' => 1);
		$data['listdata'] = $this->administrator->listData($condition);

		$this->template->backend('administrators/main',$data);
	}

	public function form($id = ""){
		$this->permission->admin();
		$data = array();

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->administrator->listSeting($condition);

		//Data in case update
		if(!empty($id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('admin_id' => $id, 'admin_status' => 1);
			$data['listdata'] = $this->administrator->listData($condition);
			if(count($data['listdata']) == 0){
				show_404();
			}
		}

		$data['formcrf'] = $this->tokens->token('formcrf');
		$this->template->backend('administrators/form',$data);
	}

	public function formpassword($Id = ""){
		$this->permission->admin();

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->administrator->listSeting($condition);
		
		if($Id == ""){
			show_404();
		}
		$data['Id'] = $Id;
		$data['formcrf'] = $this->tokens->token('formcrf');
		$this->template->backend('administrators/formpassword',$data);
	}

	public function create(){
		$this->permission->admin();
		if($this->tokens->verify('formcrf')){
			$data = array(
				'admin_fname' => $this->input->post('Text_Name'),
				'admin_lname' => $this->input->post('Text_lastname'),
				'admin_tel' => $this->input->post('Text_Tel'),
				'admin_email' => $this->input->post('Text_Email'),
				'admin_pass' => $this->input->post('Text_passWord'),
				'lastedit_name' => $this->encryption->decrypt($this->input->cookie('sysn')),
				'lastedit_date' => date('Y-m-d H:i:s'),
				'admin_show' => 1,
				'admin_status' => 1,
			);
			$this->administrator->insertData($data);
			$result = array(
				'error' => false,
				'url' => site_url('administrator/main')
			);
			echo json_encode($result);
		}
	}

	public function update(){
		$this->permission->admin();
		if($this->tokens->verify('formcrf')){
			$data = array(
				'admin_id' => $this->input->post('Id'),
				'admin_fname' => $this->input->post('Text_Name'),
				'admin_lname' => $this->input->post('Text_lastname'),
				'admin_tel' => $this->input->post('Text_Tel'),
				'lastedit_name' => $this->encryption->decrypt($this->input->cookie('sysn')),
				'lastedit_date' => date('Y-m-d H:i:s'),
				'admin_show' => 1,
				'admin_status' => 1,

			);
			$this->administrator->updateData($data);
			$result = array(
				'error' => false,
				'url' => site_url('administrator/main')
			);
			echo json_encode($result);
		}
	}

	public function delete($Id){
		$this->permission->admin();
		$this->administrator->deleteData($Id);
		header("location:".site_url('administrator/main'));
	}

	function delete_student_id() {
		$id = $this->uri->segment(3);
		$this->delete_model->delete_student_id($id);
		$this->show_student_id();
		}

	public function checkemail(){
		$this->permission->admin();
		// check email count 0 = true or than 0 = false
		$Text_Email = $this->input->post('Text_Email');
		if(!empty($Text_Email)){
			$condition = array();
			$condition['fide'] = "admin_id";
			$condition['where'] = array('admin_email' => $Text_Email, 'admin_status' => 1);
			$listemail = $this->administrator->listData($condition);
			if(count($listemail) == 0){
				echo "true";
			}else{
				echo "false";
			}
		}
	}

	public function changepassword(){
		$this->permission->admin();

		if($this->tokens->verify('formcrf')){
			$data = array(
				'admin_id' => $this->input->post('Id'),
				'admin_pass' => $this->input->post('Text_passWord')
			);
			$this->administrator->updateData($data);
			$result = array(
				'error' => false,
				'url' => site_url('administrator/main')
			);
			echo json_encode($result);
		}
	}

	public function authen(){
		if($this->tokens->verify('formcrf')){
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			if($username != "" && $password != ""){
				$condition = array();
				$condition['fide'] = "admin_id,admin_fname,admin_lname";
				$condition['where'] = array('admin_email' => $username, 'admin_pass' => $password);
				$listdata = $this->administrator->listData($condition);
				if(count($listdata) == 1){
					$data = array(
						'admin_id' => $listdata[0]['admin_id'],
						'admin_lastlogin' => date('Y-m-d H:i:s')
					);
					$this->administrator->updateData($data);
					$l = $this->encryption->encrypt("l1ci");
					$i = $this->encryption->encrypt($listdata[0]['admin_id']);
					$f = $this->encryption->encrypt($listdata[0]['admin_fname']);
					$ln = $this->encryption->encrypt($listdata[0]['admin_lname']);
					$cookie = array(
									'name'   => 'syslev',
									'value'  => $l,
									'expire' => '86500',
									'path'   => '/'
							 );
					$cookie_id = array(
		 							'name'   => 'sysli',
		 							'value'  => $i,
		 							'expire' => '86500',
		 							'path'   => '/'
		 					);
					$cookie_fullname = array(
		 							'name'   => 'sysn',
		 							'value'  => $f,
		 							'expire' => '86500',
		 							'path'   => '/'
		 					);
					$cookie_lastname = array(
				 					'name'   => 'sysp',
				 					'value'  => $ln,
				 					'expire' => '86500',
				 					'path'   => '/'
				 			);
					$this->input->set_cookie($cookie);
					$this->input->set_cookie($cookie_id);
					$this->input->set_cookie($cookie_fullname);
					$this->input->set_cookie($cookie_lastname);
					header("location:".site_url('information/index'));
				}else{
					header("location:".site_url('administrator/index/false'));
				}
			}
		}
	}

	public function logout(){
		delete_cookie("syslev");
		header("location:".site_url('administrator/index'));
	}

}
