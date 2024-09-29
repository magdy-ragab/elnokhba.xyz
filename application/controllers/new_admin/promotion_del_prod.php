<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Promotion_del_prod extends CI_Controller
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
	    $this->titles = array('إضافة ترويج', 'عرض العروض السابقة');
	    $this->cont =$this->router->fetch_class();
	    $this->has =array('title', 'date', 'pic', 'active', 'content');
	    if(! $this->session->userdata('user'))
	    {
		    redirect( base_url().$this->core_model->admin_dir() );
	    }
    }
    
    
    public function del($id)
    {
	if($this->core_model->admin_can())
	{
	    $data['admin_dir']= base_url().$this->core_model->admin_dir();
	    $data['page_title'] = "حذف";
	    $data['cont'] = $this->cont;
	    $row=$this->db->where("ID='{$id}'")->get("promotion_product")->row();
	    var_dump($row);
	    $this->db->where("ID='{$id}'")->delete("promotion_product");
	    redirect( "new_admin/promotion/prod/".$row->promotion );
	}else{
	    $this->core_model->check_permission();
	}
    }

}