<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->model( array('core_model' , 'Hijri') );
		$this->load->library(array('pagination', 'session'));
	}
	
	public function index() {
		$start=0;
		$data['page_title']= "الاخبار";
        $this->load->view('templates/header',$data);
		$this->load->view('news/index', $data);
		$this->load->view('templates/footer', $data);
	}
	
	
	public function view($url)
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->model('core_model');
		
		$page= $this->core_model->pages_data( ($url));
		if($page['active']=='N')
		{
			$this->load->view('templates/header',$data);
			$this->load->view('home/page404', $data);
			$this->load->view('templates/footer', $data);
		}else{
			$data['page']= $page;
			$data['page_keywords']= str_replace(" ", ",", mb_substr( strip_tags($page['content']), 0, 255,"utf-8")) ;
			$data['page_description']= mb_substr(strip_tags($page['content']), 0, 255,"utf-8") ;
			$data['page_title']= $page['title'];
			$data['share_img']= base_url()."uploads/news/". $page['pic'];
			
			$this->db->where("id='". intval($url) ."'");
			$this->db->update("pages", array("view"=>$page['view']+1));
			
			$this->load->view('templates/header',$data);
			$this->load->view('news/news', $data);
			$this->load->view('templates/footer', $data);
		}
	}
	
}
