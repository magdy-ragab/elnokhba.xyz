<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ForgetMyPassword extends CI_Controller
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
	
    
    public function code($code)
    {
        $data['show_form']=1;
        $data['code']=$code;
        if( $this->input->post('change') )
        {
            $email= strtolower( $this->input->post('email') );
            $this->form_validation->set_rules('email', 'البريد الإلكتروني ', 'required',
                            array('required' => '- لم تقم بكتابة %s.'));
            $this->form_validation->set_rules('password1', 'كلمة المرور ', 'required',
                            array('required' => '- لم تقم بكتابة %s.'));
             $this->form_validation->set_rules('password2', 'إعادة كلمة المرور', 'required',
                            array('required' => '- لم تقم بكتابة %s.'));


            if($this->form_validation->run() != false )
            {
                if( $this->input->post('password1') == $this->input->post('password2') )
                {
                $r= $this->db->get_where("admin", array("email"=>$email,
                    "reset_hash"=>$this->input->post('reset_hash'))
                )->row();
                if($r)
                {
                     $salt=$this->core_model->create_strings2(4);
                     $salt_extra=$this->core_model->create_strings2(5);
                     $repeat=rand(1,5);
                     $password=$this->core_model->mk_password($salt,
                        $repeat,$salt_extra,$this->input->post('password1')
                    );
                     $hash= md5("{$salt}.{$salt_extra}.{$repeat}");
                     $this->db->where("email='". $email ."'")->update("admin", array(
                        "salt"=>$salt ,
                        "salt_extra"=>$salt_extra ,
                        "salt_repeat"=>$repeat ,
                        "pwd"=>$password ,
                        "hash"=>$hash,
                        "reset_hash"=>''
                      ));
                    $data['done'] = 1;
                  }else{
                    $data['not_email2']=1;
                 }
                }else
                {
                     $data['not_equal'] = 1;
                }
            }
        }
        $this->load->helper('captcha');
        $data['titles']= $this->titles;
        $data['admin_dir']= base_url().$this->core_model->admin_dir();
        $data['admin_data'] = $this->core_model->admin_data_by_hash($_SESSION['user']);
        $cap_func =$this->core_model->captcha_img();
        $data['cap']= $cap_func;
        $data['page_title'] = "تغيير كلمة المرور";
        $this->load->view( $this->core_model->admin_dir().'/fmypassword', $data);
    }
	
	
	
	
	public function index()
	{
        if($this->input->post('femail'))
        {
            $email= strtolower( $this->input->post('femail') );
            $this->form_validation->set_rules('femail', 'البريد الإلكتروني ', 'required',
								array('required' => '- لم تقم بكتابة %s.'));
            if($this->form_validation->run() != false )
            {
                $r= $this->db->get_where("admin", array("email"=>$email))->row();
                if(!$r)
                {
                    $data['not_email']=1;
                }else{
                    $code= md5( uniqid());
                    $url= base_url() .$this->core_model->admin_dir() . 
                        "/ForgetMyPassword/code/{$code}";
                    $this->db->where(["email"=>$email])->
                        update("admin", array( "reset_hash"=>$code ) );
                    $body= '<p>مرحباً بك يا <b>'. $row->username .'<b/> 
                    <br /> لقد طلبت تغيير كلمة المرور الخاصة بك في لوحة تحكم موقع : 
                    '. $this->core_model->get_settings('title') .' <br />
                    من فضلك قم بإتباع الرابط التالي <a href="'. $url.'">'.$url.'</a></p>';
                    $this->core_model->send_email("تغيير كلمة المرور", $body);
                    $data['send']=1;
                }
            }
        }
		
       
			
			
			$this->load->view( $this->core_model->admin_dir().'/fmypassword', $data);
			
		
		
	}
	
	
	
}
	
