<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Information extends MX_Controller {

	function __construct(){
		parent::__construct();
		$this->permission->admin();
		$this->lang->load(array('admin_page_lang','admin_form_lang'), 'english');
		$this->load->model("information_model","information");
	}

	public function index(){
		$data = array();

		//List data app
		$condition = array();
		$condition['fide'] = "*";
		$condition['where'] = array('app_id' => 1);
		$data['listapp'] = $this->information->listApp($condition);

		$condition = array();
		$condition['fide'] = "*";
		$condition['limit'] = array(5,0);
		$condition['orderby'] = "lastedit_date DESC";
		$data['listTip'] = $this->information->listTip($condition);


		$this->template->backend('information/main',$data);
	}

}
