<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

    var $hash = 'R41T0H45H';
    var $hash_repeat = 2;

    public function __construct() {
	parent::__construct();
	$this->load->helper('url');
	$this->load->helper('form');
	$this->load->database();
	$this->load->model(array('core_model', 'Hijri'));
	$this->load->library(array('pagination', 'session'));
    }

    public function index($start=0) {
	$data = array();
	$limit=9;
	$data= array();
	$data['rows']= $this->db->
		order_by($orderByField,$order)->
		limit($limit,$start)->
		where("module='products' and `active`='Y' and `title` like '%".
		$this->input->post('q')
		."%'")->get("pages")->result() ;
	$data['brand']= $this->db->where(["id"=>$id, "module"=>'brands'])->get("pages")->row();

	$config['base_url'] = base_url().'search/'.'?'.http_build_query($_GET);
	$config['total_rows'] = $this->db->order_by($orderByField,$order)->where("module='products' and `active`='Y' and `title` like '%{$_GET['search']}%'")->get("pages")->num_rows();
	$config['full_tag_open'] = '<ul class="pagination pagination-small pagination-centered">';
	$config['full_tag_close'] = '</ul>';
	$config['per_page'] = $limit;
	$config['num_links'] = 13;
	$config['page_query_string'] = false;
	$config['prev_link'] = '&lt; السابق';
	$config['prev_tag_open'] = '<li>';
	$config['prev_tag_close'] = '</li>';
	$config['next_link'] = 'التالي &gt;';
	$config['next_tag_open'] = '<li>';
	$config['next_tag_close'] = '</li>';
	$config['cur_tag_open'] = '<li class="active"><a href="#">';
	$config['cur_tag_close'] = '</a></li>';
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';
	$config['first_link'] = FALSE;
	$config['last_link'] = FALSE;
	$this->pagination->initialize($config); 
	
	
	$this->load->view('templates/header', $data);
	$this->load->view('search/search', $data);
	$this->load->view('templates/footer', $data);
    }

    function del($id) {
	unset($_SESSION['wishlist'][array_search($id, $_SESSION['wishlist'])]);
	redirect(base_url()."wishlist");
    }

    

}

