<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PaymentPaypal extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('session');
		$this->load->database();
		$this->load->model(array('core_model', 'Hijri'));
	}
	
	public function paypal()
	{
	    $data= array();
	    $status= $_POST['payment_status'];
	    $cart_id= $this->input->post('custom');
	    $this->load->view('templates/header',$data);
	    
	    if( $this->db->where("cart_id='{$cart_id}'")->get("cart")->num_rows() > 0 )
	    {$this->load->view('cart/error2',$data);
		
	    }else{
		$this->db->query("INSERT INTO `_d_cart` select * from `_d_cart_cache` where `cart_id` = '$cart_id';");
		$this->db->where(array("cart_id"=>$cart_id))->update( "cart", array("status"=>$status) );
		$this->db->where(array("cart_id"=>$cart_id))->update( "cart_cache", array("status"=>$status) );
		if( $staut=='Completed' ||  $staut=='Processed' ) 
		{
		    $this->load->view('cart/done',$data);
		    unset($_SESSION['cart']);
		}else{
		    $this->load->view('cart/error',$data);
		    unset($_SESSION['cart']);
		}

		$this->load->view('templates/footer',$data);
	    }
	    
	    
	}
	
	
}
