<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_index extends CI_Controller
{
	public function index()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->model('core_model');
		$this->load->library('session');
		
		$data['page_title']="رئيسية لوحة التحكم";
		
		$this->load->view($this->core_model->admin_dir().'/templates/header', $data);
		$this->load->view($this->core_model->admin_dir().'/admin_index', $data);
		$this->load->view($this->core_model->admin_dir().'/templates/footer', $data);
		
		$data['charts']= true;
	}
}