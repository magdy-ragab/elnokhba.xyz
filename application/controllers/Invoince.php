<?php
class Invoince extends CI_Controller
{
    
    public function __construct()
    {
	parent::__construct();
	$this->load->helper('url');
	$this->load->helper('form');
	$this->load->database();
	$this->load->model(array('core_model', 'Hijri'));
	$this->load->library(array('pagination', 'session'));
    }

    public function invoincePrint($cart_id)
    {
	$data['id']= $id;
	$data['fullInvoince']= $this->shop->invoince($cart_id, false);
	$this->load->view('prints/invoince', $data);
    }
}
