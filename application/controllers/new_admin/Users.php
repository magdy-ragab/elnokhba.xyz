<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller
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
        $data['page_title']= 'الأعضاء';
        $data['admin_dir']= base_url().$this->core_model->admin_dir();
        $data['admin_data'] = $this->core_model->admin_data_by_hash($_SESSION['user']);
        $this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
	$this->load->view( $this->core_model->admin_dir().'/users/view', $data);
	$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
    }
    
    public function sellers()
    {
        $data['page_title']= 'البائعين';
        $data['admin_dir']= base_url().$this->core_model->admin_dir();
        $data['admin_data'] = $this->core_model->admin_data_by_hash($_SESSION['user']);
        $this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
	$this->load->view( $this->core_model->admin_dir().'/users/sellers', $data);
	$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
    }
    
    
    public function edit($id)
    {
	$data['id']= $id;
	$data['page_title']= 'تعديل عضو';
	$data['admin_dir']= base_url().$this->core_model->admin_dir();
        $data['admin_data'] = $this->core_model->admin_data_by_hash($_SESSION['user']);
        $data['row'] = $this->db->where("ID='{$id}'")->order_by("ID desc")->get("cart_items")->row();
	//var_dump($data['row']->cart_id);
        $data['cart_data'] = $this->shop->cart_data($data['row']->cart_id);
        $data['prod'] = $this->core_model->product_data($data['row']->product_item);
        $data['price'] = ($data['prod']['discount'])?$data['prod']['discount']:$data['prod']['price'];
	$data['user'] = $this->db->where("ID='{$data['row']->buyer}'")->get("user")->row();
        $this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
	$this->load->view( $this->core_model->admin_dir().'/users/add', $data);
	$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
    }
    
    public function del($id)
    {
	$data['id']= $id;
	$data['page_title']= 'حذف عضو';
	$data['admin_dir']= base_url().$this->core_model->admin_dir();
        $data['admin_data'] = $this->core_model->admin_data_by_hash($_SESSION['user']);
	$this->db->where("ID='{$id}'")->delete("user") ;
	$data['del']=1;
        $this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
	$this->load->view( $this->core_model->admin_dir().'/users/del', $data);
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
    


    public function seller_balance($id='')
    {
	$data['id']= $id;
	$data['page_title']= 'الرصيد';
	$data['admin_dir']= base_url().$this->core_model->admin_dir();
        $data['admin_data'] = $this->core_model->admin_data_by_hash($_SESSION['user']);
        
	$data['user'] = $this->db->where("ID='{$data['row']->buyer}'")->get("user")->row();
	$data['balance'] = $this->shop->userSelledValue($id);
        $this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
	$this->load->view( $this->core_model->admin_dir().'/users/seller_balance', $data);
	$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
    }
    
    
    public function seller_balance_manage($id)
    {
	//print_r($_POST);
	$data['id']= $id;
	$data['page_title']= 'تفاصيل الرصيد';
	$data['admin_dir']= base_url().$this->core_model->admin_dir();
        $data['admin_data'] = $this->core_model->admin_data_by_hash($_SESSION['user']);
        $data['balance'] = $this->shop->userSelledValue($id);
	if( isset($_POST['new_balance_send']) && ( isset($_POST['withdraw']) && $_POST['withdraw']!=='Y' ) ):
	    $this->session->set_flashdata("please_check", 1);
	    redirect( $this->core_model->admin_dir().'/users/seller_balance/'.$id);
	elseif( $this->input->post('new_balance') > $this->shop->userSelledValue($id)  ) :
		$this->session->set_flashdata("balance_error", 1);
		redirect( $this->core_model->admin_dir().'/users/seller_balance/'.$id);
        else :
	    $this->db->query("update `_d_balance_history` set `balance`=`balance`-".$this->input->post('new_balance')." where `uid`='".$id."'");
	    $this->db->insert("balance", array( "uid"=>$id, "withdraw"=>'Y', "note"=>"إرسال ". $this->input->post("new_balance"), "balance"=>$this->input->post("new_balance") ));
	    $this->session->set_flashdata("success", 1);
	    redirect( $this->core_model->admin_dir().'/users/seller_balance/'.$id);
	endif;
	
	
	    
	/*$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
	$this->load->view( $this->core_model->admin_dir().'/users/seller_balance_manage', $data);
	$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );*/
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
	
