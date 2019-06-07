<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Media extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->lang->load(array('admin_page_lang','admin_form_lang'), 'english');
		$this->load->model("media_model","media");
	}

	public function index(){
		$data = array();

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->media->listApp($condition);

		// List data contents
		$condition = array();
		$condition['fide'] = "*";
		$condition['orderby'] = "tb_media.lastedit_date asc";
		$data['listdata'] = $this->media->listDatas($condition);

		$this->template->backend('media/main',$data);
	}

	public function form($id = ""){
		
		$data = array();

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->media->listApp($condition);

		$condition = array();
		$condition['fide'] = "*";
		$data['listtype'] = $this->media->listType($condition);

		$condition = array();
		$condition['fide'] = "*";
		$data['listcategory'] = $this->media->listCategory($condition);

		//Data in case update
		if(!empty($id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('med_id' => $id,'med_show !=' => 0);
			$data['listdata'] = $this->media->listData($condition);
			
			if(count($data['listdata']) == 0){
				show_404();
			}
		}

		$this->template->css(array(
			base_url('assets/inspinia/css/plugins/summernote/summernote'),
			base_url('assets/inspinia/css/plugins/summernote/summernote-bs3'),
			base_url('assets/inspinia/css/plugins/codemirror/codemirror'),
			base_url('assets/inspinia/css/plugins/codemirror/ambiance'),
			base_url('assets/inspinia/css/plugins/datapicker/datepicker3')
		));

		$data['crform'] = $this->tokens->token('crform');

		$this->template->backend('media/form',$data);
	}

	public function create(){
		if($this->tokens->verify('crform')){
			$data['type_id'] = $this->input->post('text_type');
			$data['cate_id'] = $this->input->post('text_category');
			$data['med_title'] = $this->input->post('Text_title');
			$data['med_imgcover'] = $this->upfile('File_img');
			$data['med_files'] = $this->input->post('Text_file');
			$data['med_show'] = $this->input->post('Text_eye');
			$data['lastedit_name'] = $this->encryption->decrypt($this->input->cookie('sysn'));
			$data['lastedit_date'] = date('Y-m-d H:i:s');
			$Id = $this->media->insertData($data);
			$result = array(
				'error' => false,
				'url' => site_url('media/form/'.$Id)
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
			$data['med_id'] = $this->input->post('Id');
			$data['type_id'] = $this->input->post('text_type');
			$data['cate_id'] = $this->input->post('text_category');
			$data['med_title'] = $this->input->post('Text_title');
			$data['med_imgcover'] = $this->upfile('File_img');
			$data['med_files'] = $this->input->post('Text_file');
			$data['med_show'] = $this->input->post('Text_eye');
			$data['lastedit_name'] = $this->encryption->decrypt($this->input->cookie('sysn'));
			$data['lastedit_date'] = date('Y-m-d H:i:s');
			
			$this->media->updateData($data);
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
			$config['upload_path'] = './uploads/media/';
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
			'med_id' => $Id
		);
		$this->media->deleteData($data);
		
	header("location:".site_url('media/index'));
}

}
