<?php
class Logout extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('session','form_validation')) ;
		$this->load->helper(array('url','form', 'cookie'));
		$this->load->model(array('core_model'));
		if(! $this->session->userdata('user'))
		{
			redirect( base_url().$this->core_model->admin_dir() );
		}
	}

	public function index()
	{
		session_destroy();
		delete_cookie("user");
		redirect( base_url().$this->core_model->admin_dir() );
	}
}
