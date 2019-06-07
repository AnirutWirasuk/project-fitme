<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Category extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->lang->load(array('admin_page_lang','admin_form_lang'), 'english');
		$this->load->model("category_model","category");
	}

	public function index(){
		$data = array();

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->category->listApp($condition);

		// List data contents
		$condition = array();
		$condition['fide'] = "*";
		$condition['orderby'] = "lastedit_date asc";
		$data['listdata'] = $this->category->listData($condition);

		$this->template->backend('category/main',$data);
	}

	public function form($id = ""){
		
		$data = array();

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->category->listApp($condition);

		//Data in case update
		if(!empty($id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('cate_id' => $id,'cate_show !=' => 0);
			$data['listdata'] = $this->category->listData($condition);
			
			if(count($data['listdata']) == 0){
				show_404();
			}
		}

		$data['crform'] = $this->tokens->token('crform');

		$this->template->backend('category/form',$data);
	}

	public function create(){
		if($this->tokens->verify('crform')){
			$data['cate_title'] = $this->input->post('Text_title');
			$data['cate_show'] = $this->input->post('Text_eye');
			$data['cate_imgover'] = $this->upfile('File_img');
			$data['lastedit_name'] = $this->encryption->decrypt($this->input->cookie('sysn'));
			$data['lastedit_date'] = date('Y-m-d H:i:s');
			$Id = $this->category->insertData($data);
			$result = array(
				'error' => false,
				'url' => site_url('category/form/'.$Id)
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
			$data['cate_id'] = $this->input->post('Id');
			$data['cate_title'] = $this->input->post('Text_title');
			$data['cate_show'] = $this->input->post('Text_eye');
			$data['cate_imgover'] = $this->upfile('File_img');
			$data['lastedit_name'] = $this->encryption->decrypt($this->input->cookie('sysn'));
			$data['lastedit_date'] = date('Y-m-d H:i:s');
			
			$this->category->updateData($data);
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
			$config['upload_path'] = './uploads/category/';
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
				'cate_id' => $Id
			);
			$this->category->deleteData($data);
			
		header("location:".site_url('category/index'));
	}
}
