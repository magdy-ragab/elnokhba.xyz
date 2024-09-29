<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {
    public function __construct() {
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->helper('form');
	    $this->load->database();
	    $this->load->model(array('core_model', 'Hijri'));
            $this->load->library('session');
    
    }
	
    public function index() {
	$data= array();
	unset($_SESSION['i']);unset($_SESSION['s']);unset($_SESSION['hash']);
	$this->load->view('templates/header',$data);
	$this->load->view('login/logout', $data);
	$this->load->view('templates/footer', $data);
    }

   

}
