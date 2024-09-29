<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Earnings extends CI_Controller
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
		$this->load->library(array('session','form_validation')) ;
		$this->cont =$this->router->fetch_class();
	}
	
    
    public function view()
    {
        $data['page_title']= 'الأرباح';
        $data['admin_dir']= base_url().$this->core_model->admin_dir();
        $data['admin_data'] = $this->core_model->admin_data_by_hash($_SESSION['user']);
        $this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
	$this->load->view( $this->core_model->admin_dir().'/earnings/view', $data);
	$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
    }
    
    
    public function details($id)
    {
	$data['id']= $id;
	$data['page_title']= 'التفاصيل';
	$data['admin_dir']= base_url().$this->core_model->admin_dir();
        $data['admin_data'] = $this->core_model->admin_data_by_hash($_SESSION['user']);
        $data['row'] = $this->db->where("ID='{$id}'")->order_by("ID desc")->get("cart_items")->row();
	//var_dump($data['row']->cart_id);
        $data['cart_data'] = $this->shop->cart_data($data['row']->cart_id);
        $data['prod'] = $this->core_model->product_data($data['row']->product_item);
        $data['price'] = ($data['prod']['discount'])?$data['prod']['discount']:$data['prod']['price'];
	$data['user'] = $this->db->where("ID='{$data['row']->buyer}'")->get("user")->row();
        $this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
	$this->load->view( $this->core_model->admin_dir().'/earnings/details', $data);
	$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
    }
    
    public function cart_details($cart_id)
    {
	$id=$data['id']= $this->db->where("cart_id='{$cart_id}'")->get("cart_items")->row()->ID;
	$data['page_title']= 'التفاصيل';
	$data['admin_dir']= base_url().$this->core_model->admin_dir();
        $data['admin_data'] = $this->core_model->admin_data_by_hash($_SESSION['user']);
        $data['row'] = $this->db->where("ID='{$id}'")->order_by("ID desc")->get("cart_items")->row();
	//var_dump($data['row']->cart_id);
        $data['cart_data'] = $this->shop->cart_data($data['row']->cart_id);
        $data['prod'] = $this->core_model->product_data($data['row']->product_item);
        $data['price'] = ($data['prod']['discount'])?$data['prod']['discount']:$data['prod']['price'];
	$data['user'] = $this->db->where("ID='{$data['row']->buyer}'")->get("user")->row();
        $this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
	$this->load->view( $this->core_model->admin_dir().'/earnings/cart_details', $data);
	$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
    }
    
    
    public function packages()
    {
	$data['id']= $id;
	$data['page_title']= 'الصفقات';
	$data['admin_dir']= base_url().$this->core_model->admin_dir();
        $data['admin_data'] = $this->core_model->admin_data_by_hash($_SESSION['user']);
        $data['row'] = $this->db->where("ID='{$id}'")->order_by("ID desc")->get("cart_items")->row();
	//var_dump($data['row']->cart_id);
        $data['cart_data'] = $this->shop->cart_data($data['row']->cart_id);
        $data['prod'] = $this->core_model->product_data($data['row']->product_item);
        $data['price'] = ($data['prod']['discount'])?$data['prod']['discount']:$data['prod']['price'];
	$data['user'] = $this->db->where("ID='{$data['row']->buyer}'")->get("user")->row();
        $this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
	$this->load->view( $this->core_model->admin_dir().'/earnings/packages', $data);
	$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
    }

	
}
	
