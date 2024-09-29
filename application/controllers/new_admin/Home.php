<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function index()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('core_model');
		$this->load->helper(array('url_helper','url', 'form', 'captcha','cookie'));
		$this->load->library(array('form_validation','session') );
	
		if( get_cookie("user") )
		{
			$this->session->set_userdata("user", get_cookie('user'));
		}
		
		if( $this->session->userdata('user'))
		{
			$this->core_model->update_last_login();
			redirect($this->core_model->admin_dir().'/admin_index');
			die;
		}
		if(!$this->session->userdata('user'))
		{
			$this->load->view($this->core_model->admin_dir().'/home');
		}
	}
}
