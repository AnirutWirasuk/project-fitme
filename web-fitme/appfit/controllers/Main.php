<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model("main_model","main");
		$this->load->helper('fileexist');
	}

	public function jsondisease(){
		$condition = array();
		$condition['fide'] = "dis_id as Id,dis_name as Name";
		$condition['where'] = array('dis_show' => 1);
		$condition['orderby'] = "dis_sort ASC";
		$data['listDisease'] = $this->main->listDisease($condition);
		echo json_encode(array('data' => $data['listDisease']));
	}

	public function checkemail(){
		$textEmail = $this->input->post('textEmail');
		if($textEmail != ""){
			$condition = array();
			$condition['fide'] = "user_id";
			$condition['where'] = array('user_email' => $textEmail);
			$condition['orderby'] = "user_id ASC";
			$data['listUser'] = $this->main->listUser($condition);
			if(count($data['listUser']) == 1){
				echo "no";
			}else{
				echo "ok";
			}
		}
	}

	public function register(){
		$data = array(
			'user_fname' => $this->input->post('textFirstname'),
			'user_lname' => $this->input->post('textLastname'),
			'user_tel' => $this->input->post('textPhonenumber'),
			'dis_id' => $this->input->post('intDisease'),
			'user_email' => $this->input->post('textEmail'),
			'user_pass' => $this->input->post('textPassword'),
			'user_img' => $this->upfile('imageProfile')
		);
		$this->main->insertData($data);
		echo "true";
	}

	public function authunserver(){
		$textEmail = $this->input->post('textEmail');
		$textPassword = $this->input->post('textPassword');
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('user_email' => $textEmail,'user_pass' => $textPassword);
		$condition['orderby'] = "user_id ASC";
		$data['listUser'] = $this->main->listUser($condition);
		if(count($data['listUser']) != 0){
			foreach ($data['listUser'] as $key => $value) {
				$user['user_id'] = $value['user_id'];
				$user['user_img'] = $value['user_img'];
				$user['user_fname'] = $value['user_fname'];
				$user['user_lname'] = $value['user_lname'];
				$user['user_tel'] = $value['user_tel'];
				$user['user_email'] = $value['user_email'];
				$user['dis_id'] = $value['dis_id'];
			}
			echo json_encode($user);
		}else{
			echo 'on';
		}
	}

	public function news(){
		$data = array();
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('news_show' => 1);
		$condition['orderby'] = "news_id ASC";
		$data['listNews'] = $this->main->listNews($condition);
		$this->template->frontend('newsmain/main',$data);
	}

	public function newsdetail($id){
		$data = array();
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('news_show' => 1,'news_id' => $id);
		$condition['orderby'] = "news_id ASC";
		$data['listNews'] = $this->main->listNews($condition);
		$this->template->frontend('newsmain/newsdetail',$data);
	}

	public function knowledge(){
		$data = array();
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('dis_show' => 1);
		$condition['orderby'] = "dis_sort ASC";
		$data['listDisease'] = $this->main->listDisease($condition);
		$this->template->frontend('knowledgemain/main',$data);
	}

	public function disdetail($id){
		$data = array();
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('dis_id' => $id);
		$condition['orderby'] = "tip_id ASC";
		$data['listKnowledge'] = $this->main->listKnowledge($condition);
		$this->template->frontend('knowledgemain/maindetail',$data);
	}

	public function knowledgedetail($id){
		$data = array();
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('tip_id' => $id);
		$condition['orderby'] = "tip_id ASC";
		$data['listKnowledge'] = $this->main->listKnowledge($condition);
		$this->template->frontend('knowledgemain/knowledgedetail',$data);
	}

	private function upfile($File_img){
		$fileold = $this->input->post($File_img.'_old');
		if(!empty($_FILES[$File_img])){
			$new_name = time();
			$config['upload_path'] = './uploads/profile/';
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

}
