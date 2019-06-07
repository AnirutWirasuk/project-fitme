<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tip extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->lang->load(array('admin_page_lang','admin_form_lang'), 'english');
		$this->load->model("tip_model","tip");
	}

	public function index(){
		$data = array();

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->tip->listApp($condition);

		// List data contents
		$condition = array();
		$condition['fide'] = "*";
		$condition['orderby'] = "tb_disease.lastedit_date asc";
		$data['listdata'] = $this->tip->listDis_Tip($condition);

		$this->template->backend('tip/main',$data);
	}

	public function form($id = ""){
		
		$data = array();

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->tip->listApp($condition);

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('dis_id !=' => 1);
		$data['listdis'] = $this->tip->listDis($condition);

		//Data in case update
		if(!empty($id)){
			$condition = array();
			$condition['fide'] = "*";
			$condition['where'] = array('tip_id' => $id,'tip_show !=' => 0);
			$data['listdata'] = $this->tip->listData($condition);
			
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

		$this->template->backend('tip/form',$data);
	}

	public function create(){
		if($this->tokens->verify('crform')){
			$data['tip_title'] = $this->input->post('Text_title');
			$data['dis_id'] = $this->input->post('text_type');
			$data['tip_detail'] = $this->input->post('Text_detail');
			$data['tip_show'] = $this->input->post('Text_eye');
			$data['tip_imgcover'] = $this->upfile('File_img');
			$data['tip_createname'] = $this->encryption->decrypt($this->input->cookie('sysn'));
			$data['tip_createdate'] = date('Y-m-d H:i:s');
			$Id = $this->tip->insertData($data);
			$result = array(
				'error' => false,
				'url' => site_url('tip/form/'.$Id)
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
			$data['tip_id'] = $this->input->post('Id');
			$data['tip_title'] = $this->input->post('Text_title');
			$data['dis_id'] = $this->input->post('text_type');
			$data['tip_detail'] = $this->input->post('Text_detail');
			$data['tip_show'] = $this->input->post('Text_eye');
			$data['tip_imgcover'] = $this->upfile('File_img');
			$data['lastedit_name'] = $this->encryption->decrypt($this->input->cookie('sysn'));
			$data['lastedit_date'] = date('Y-m-d H:i:s');
			
			$this->tip->updateData($data);
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
			$config['upload_path'] = './uploads/tip/';
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

		if(!empty($Id)){
			$data = array();
			$data['fide'] = "*";
			$data['where'] = array('tip_id' => $Id);
			$listImages = $this->tip->listData($data);

			if(isset($listImages) && count($listImages) != 0){
				foreach ($listImages as $key => $value) {
					$name = $value['tip_imgcover'];
				}
			}
			$data = array(
				'tip_id' => $Id
			);
			$this->tip->deleteData($data);

			if($name != ''){
				if(file_exists(dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/tip/".$name) == 1)
				{
				unlink(dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/tip/".$name);
				}
			}
		}
		header("location:".site_url('tip/index'));
	}
}
