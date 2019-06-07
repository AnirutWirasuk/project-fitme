<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Settings extends MX_Controller {
	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->lang->load(array('admin_page_lang','admin_form_lang'), 'english');
		$this->load->model("settings_model","settings");
	}

	public function index(){
		$data = array();

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listdata'] = $this->settings->listData($condition);

		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->settings->listData($condition);

		$data['frmseting'] = $this->tokens->token('frmseting');
		$this->template->backend('settings/main',$data);
	}

	public function update(){
		if($this->tokens->verify('frmseting')){
				$data = array(
					'app_id' => $this->input->post('Id'),
					'app_name' => $this->input->post('Text_Name'),
					'app_detail' => $this->input->post('TEXT_Detail'),
					'lastedit_name' => $this->encryption->decrypt($this->input->cookie('sysn'))
				);
			$this->settings->updateData($data);
			
			$result = array(
				'error' => false,
				'url' => site_url('administrator/settings/index'),
				'title' => "อัพเดตข้อมูลเรียบร้อยแล้ว",
				'msg' => ""
			);
			echo json_encode($result);
		}
	}

	public function updateimg(){
		if($this->tokens->verify('formlogo')){
				$data = array(
					'app_id' => $this->input->post('Id'),
					'app_logo' => $this->upfile('File_img'),
					'lastedit_name' => $this->encryption->decrypt($this->input->cookie('sysn'))
				);
			$this->settings->updateData($data);
			
			$result = array(
				'error' => false,
				'url' => site_url('administrator/settings/index'),
				'title' => "อัพเดตข้อมูลเรียบร้อยแล้ว",
				'msg' => ""
			);
			echo json_encode($result);
		}
	}

	private function upfile($File_img){
		$fileold = $this->input->post($File_img.'_old');
		if(!empty($_FILES[$File_img])){
			$new_name = time();
			$config['upload_path'] = './uploads/application/';
			$config['allowed_types'] = '*';
			$config['file_name'] = $new_name;
			$config['max_size']	= '35000';
			$this->load->library('upload', $config ,'uplogo');
			$this->uplogo->initialize($config);
			if ( ! $this->uplogo->do_upload($File_img)){
				$result = array(
					'error' => true,
					'title' => "Error",
					'msg' => $this->uplogo->display_errors()
				);
				echo json_encode($result);
				die;
			}else{
				if(!empty($fileold)){
					@unlink($config['upload_path'].$fileold);
				}
				$img = $this->uplogo->data();
				return $img['file_name'];
			}

		}else{
			return $fileold;
		}
	}
}
