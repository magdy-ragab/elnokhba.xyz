<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Qr extends CI_Controller
{
	var $titles;
	var $cont;
	var $has;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url','form'));
		$this->load->model('core_model');
		$this->load->model('admin/pages_model');
		$this->load->library(array('session','form_validation')) ;
		$this->titles = array('إضافة إعلان', 'عرض الإعلانات');
		$this->cont =$this->router->fetch_class();
		$this->has =array('title', 'date', 'pic', 'active', 'content');
        
		if(! $this->session->userdata('user'))
		{
			redirect( base_url().$this->core_model->admin_dir() );
		}
	}
    
    
	public function view()
	{
	    if($this->core_model->admin_can())
	    {
		    $data['titles']= $this->titles;
		    $data['admin_dir']= base_url().$this->core_model->admin_dir();
		    $data['page_title'] = "الفواتير";
		    $this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
		    $this->load->view( $this->core_model->admin_dir().'/qr/view', $data);
		    $this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
	    }else{
		    $this->core_model->check_permission();
	    }
	}
	
	
	public function invoince()
	{
	    if($this->core_model->admin_can())
	    {
		$data['page_title'] = "الفواتير";
		$inv=$this->input->post('invoince');
		$row= $this->db->where("cart_id='{$inv}'")->get("cart_cache");
		//echo "<pre>";print_r($row->result_id->num_rows); die; 
		$rows= $row->num_rows(); 
		if( $rows === 0 ):
		    $this->session->set_flashdata("unavialble", 1);
		else:
		   $row=$row->row() ;
		   $data['fullInvoince']= $this->shop->invoince($row->cart_id);
		   $data['user']= $this->shop->getUserData($row->uid);
		endif;
		$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
		$this->load->view( $this->core_model->admin_dir().'/qr/view', $data);
		$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
	    }else{
		    $this->core_model->check_permission();
	    }
	}
}
	
