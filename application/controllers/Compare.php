<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Compare extends CI_Controller {

    var $hash = 'R41T0H45H';
    var $hash_repeat = 2;

    public function __construct() {
	parent::__construct();
	$this->load->helper('url');
	$this->load->helper('form');
	$this->load->database();
	$this->load->model(array('core_model', 'Hijri'));
	$this->load->library('session');
    }

    public function index() {
	$data = array();
	if ($_POST['updateCartCounts']) {
	    foreach ($_POST['productCount'] as $k => $v) {
		$_SESSION['cart'][$k]['count'] = $v;
	    }
	    redirect(base_url() . 'cart');
	}
	$this->load->view('templates/header', $data);
	$this->load->view('compare/compare', $data);
	$this->load->view('templates/footer', $data);
    }

    function del($id) {
	unset($_SESSION['wishlist'][array_search($id, $_SESSION['wishlist'])]);
	redirect(base_url()."wishlist");
    }

    

}

