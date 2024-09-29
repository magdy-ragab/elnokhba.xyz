<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    
    public function __construct() {
	    parent::__construct();
            $this->load->library('session');
    
    }
	public function view($url)
	{
		
		$url= ($url);
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
			$data['share_img']= base_url()."uploads/pages/". $page['pic'];
			
			$this->db->where("id='". intval($url) ."'");
			$this->db->update("pages", array("view"=>$page['view']+1));
			
			$this->load->view('templates/header',$data);
			$this->load->view('pages/pages', $data);
			$this->load->view('templates/footer', $data);
		}
	}
	
}
