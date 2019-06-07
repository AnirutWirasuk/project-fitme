<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class About extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->lang->load(array('admin_page_lang','admin_form_lang'), 'english');
		$this->load->model("about_model","about");
	}

	public function index(){
		$data = array();

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->about->listApp($condition);

		// List data contents
		$condition = array();
		$condition['fide'] = "*";
		$condition['orderby'] = "lastedit_date DESC";
		$data['listdata'] = $this->about->listData($condition);

		$this->template->backend('about/main',$data);
	}

	public function form($id = ""){
		
		$data = array();

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->about->listApp($condition);

		//Data in case update
		if(!empty($id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('ab_id' => $id);
			$data['listdata'] = $this->about->listData($condition);
			
			if(count($data['listdata']) == 0){
				show_404();
			}
		}

		$data['crform'] = $this->tokens->token('crform');

		$this->template->backend('about/form',$data);
	}

	public function create(){
		if($this->tokens->verify('crform')){
			$data['ab_fname'] = $this->input->post('Text_name');
			$data['ab_lname'] = $this->input->post('Text_lastname');
			$data['ab_img'] = $this->upfile('File_img');
			$data['ab_tel'] = $this->input->post('Text_tel');
			$data['ab_email'] = $this->input->post('Text_email');
			$data['ab_facebook'] = $this->input->post('Text_facebook');
			$data['ad_show'] = $this->input->post('Text_eye');
			$data['lastedit_name'] = $this->encryption->decrypt($this->input->cookie('sysn'));
			$data['lastedit_date'] = date('Y-m-d H:i:s');
			$Id = $this->about->insertData($data);
			$result = array(
				'error' => false,
				'url' => site_url('about/form/'.$Id)
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
			$data['ab_id'] = $this->input->post('Id');
			$data['ab_fname'] = $this->input->post('Text_name');
			$data['ab_lname'] = $this->input->post('Text_lastname');
			$data['ab_img'] = $this->upfile('File_img');
			$data['ab_tel'] = $this->input->post('Text_tel');
			$data['ab_email'] = $this->input->post('Text_email');
			$data['ab_facebook'] = $this->input->post('Text_facebook');
			$data['ad_show'] = $this->input->post('Text_eye');
			$data['lastedit_name'] = $this->encryption->decrypt($this->input->cookie('sysn'));
			$data['lastedit_date'] = date('Y-m-d H:i:s');
			
			$this->about->updateData($data);
			$result = array(
				'error' => false,
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
			$config['upload_path'] = './uploads/about/';
			$config['allowed_types'] = '*';
			$config['file_name'] = $new_name;
			$config['max_size']	= '35000';
			$this->load->library('upload', $config ,'upbanner');
			$this->upbanner->initialize($config);
			if ( ! $this->upbanner->do_upload($File_img)){
				$result = array(
					'error' => true,
					'title' => "Error",
					'msg' => $this->upbanner->display_errors()
				);
				echo json_encode($result);
				die;
			}else{
				if(!empty($fileold)){
					@unlink($config['upload_path'].$fileold);
				}
				$img = $this->upbanner->data();
				return $img['file_name'];
			}

		}else{
			return $fileold;
		}
	}

	public function delete($Id){

			$data = array(
				'ab_id' => $Id
			);
			$this->about->deleteData($data);
			
		header("location:".site_url('about/index'));
	}
}
