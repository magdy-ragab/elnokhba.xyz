<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->model(array('core_model', 'Hijri'));
	}
	
	public function index() {
        $data['page_title']= "قائمة الطعام";
		$this->load->view('templates/header',$data);
		$this->load->view('gallery/index', $data);
		$this->load->view('templates/footer', $data);
	}
	
	
	public function view($id) {
		$data['row']= $this->core_model->pages_data($id);
        $data['page_title']= $data['row']['title'];
        $data['page_keywords']= str_replace(" ", ",", mb_substr( strip_tags($data['row']['content']), 0, 255,"utf-8")) ;
		$data['page_description']= mb_substr(strip_tags($data['row']['content']), 0, 255,"utf-8") ;
		$this->load->view('templates/header',$data);
		$this->load->view('gallery/view', $data);
		$this->load->view('templates/footer', $data);
	}
}
