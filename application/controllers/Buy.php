<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buy extends CI_Controller {

    public function __construct() {
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->helper('form');
	    $this->load->database();
	    $this->load->model(array('core_model', 'Hijri'));
	    $this->load->library('session');
    }
	
    public function index() {
	$this->load->view('templates/header',$data);
        if(isset( $_SESSION['i'] ))
        {
            $data['cart']=$this->db->where("uid='{$_SESSION['i']}'")->get('cart_items')->result();
            $this->load->view('user_pages/buyed',$data);
        }else{
            $this->load->view('user_pages/please_login',$data);
        }
	$this->load->view('templates/footer', $data);
    }
}
