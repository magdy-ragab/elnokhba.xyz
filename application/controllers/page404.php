<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page404 extends CI_Controller {
	public function index($id)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
                $this->load->library('session');
		$this->load->model('core_model');
		$data['comics_last']= $this->core_model->comics(0, array("active"=>"Y"), 6);
		$data['comics_news']= $this->core_model->news(array("active"=>"Y"), 4);
		$data['cats']= $this->core_model->cats(array("catid"=>"0", "in_index"=>'Y'));
		$this->load->view('templates/header',$data);
		$this->load->view('home/page404', $data);
		$this->load->view('templates/footer', $data);
		
	}
}
