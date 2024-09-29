<?php
class Invoinceuser extends CI_Controller
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

    public function invoinceuserPrint($id)
    {
	$data['id']= $id;
	$data['row']= $this->db->where("ID='{$id}'")->get("user")->row();
	$this->load->view('prints/invoinceuser', $data);
    }
}
