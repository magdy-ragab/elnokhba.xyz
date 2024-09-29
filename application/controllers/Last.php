<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Last extends CI_Controller {

    var $hash = 'R41T0H45H';
    var $hash_repeat = 2;

    public function __construct() {
	parent::__construct();
	$this->load->helper('url');
	$this->load->helper('form');
	$this->load->database();
	$this->load->model(array('core_model', 'Hijri'));
	$this->load->library(array( 'session'));
    }

    public function index($start=0,$orderByField='ID',$order="desc") {
	$data =$rows= array();
	
	foreach( $this->db->where(["uid"=>$_SESSION['i']])->get("last")->result() as $row )
	{
	    $rows[]=$this->core_model->product_data($row->item_id);
	}
	$data['rows']= $rows;
	$this->load->view('templates/header', $data);
	$this->load->view('last/last', $data);
	$this->load->view('templates/footer', $data);
    }

}

