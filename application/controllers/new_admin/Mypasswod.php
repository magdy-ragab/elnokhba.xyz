<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mypasswod extends CI_Controller
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
		$this->titles = array('إضافة موضوع', 'عرض المواضيع');
		$this->cont =$this->router->fetch_class();
		$this->has =array('title', 'date', 'pic', 'active', 'content');
		if(! $this->session->userdata('user'))
		{
			redirect( base_url().$this->core_model->admin_dir() );
		}
	}
	
	
	
	
	
	public function index()
	{
		
		
			if( $this->input->post('change') )
			{
				if( strtolower(str_replace(" ", "", $this->input->post('cap'))) ==  strtolower(str_replace(" ", "", $this->input->post('word'))))
				{
					if( $this->input->post('password1') != $this->input->post('password2') )
					{
						$data['not_equal']='1';
					}else{
						
						// die( $_SESSION['user'] );
						$salt=$this->core_model->create_strings2(4);
						$salt_extra=$this->core_model->create_strings2(5);
						$repeat=rand(1,5);
					 	$password=$this->core_model->mk_password($salt,$repeat,$salt_extra,$this->input->post('password1'));
					 	$hash= md5("{$salt}.{$salt_extra}.{$repeat}");
						 $this->db->where("hash='". $_SESSION['user'] ."'")
						 	->update("admin", [
								"salt"=>$salt ,
								"salt_extra"=>$salt_extra ,
								"salt_repeat"=>$repeat ,
								"pwd"=>$password ,
								"hash"=>$hash
					 		]);
						$data['inserted']=1;
						redirect($this->core_model->admin_dir().'/logout');
						die;
					}
					
			

				}else{
					$data['wrong']= 1;
				}
			}
			$this->load->helper('captcha');
			$data['titles']= $this->titles;
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['admin_data'] = $this->core_model->admin_data_by_hash($_SESSION['user']);
			$cap_func =$this->core_model->captcha_img();
	     	$data['cap']= $cap_func;
			$data['page_title'] = "تغيير كلمة المرور";
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/mypassword', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		
		
	}
	
	
	
}
	
