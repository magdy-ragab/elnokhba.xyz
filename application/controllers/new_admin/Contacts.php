<?php
class Contacts extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('session','form_validation')) ;
		$this->load->helper(array('url','form'));
		$this->load->model(array('core_model', 'admin/comics_model'));
		if(! $this->session->userdata('user'))
		{
			redirect( base_url().$this->core_model->admin_dir() );
		}
	}

	public function index()
	{
		if($this->core_model->admin_can())
		{
			$data['admin_dir']= base_url().$this->core_model->admin_dir()."/admin_index";
			$data['page_title'] = "اتصل بنا";
			$data['editor'] = true;
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/'. $this->router->fetch_class() .'/view', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
	
	
	public function read($slug)
	{
		if($this->core_model->admin_can())
		{
			$data['row']= $this->core_model->contact_data($slug);
			$data['id']= $slug;
			$data['admin_dir']= base_url().$this->core_model->admin_dir()."/admin_index";
			$data['page_title'] = "<a href='". base_url().$this->core_model->admin_dir() ."/contacts'>الرسائل </a> / " . $data['row']->subject;
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/contacts/read', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
	
	
	public function settings()
	{		
		if($this->core_model->admin_can())
		{
			if($this->input->post('save_contact_data') == 1)
			{
				$this->db->Where( array("ID"=>1))->update("settings", array(
								"map"=>$this->input->post('map'), 
								"contact_data"=>$this->input->post('content') ) );
			}
			$data['admin_dir']= base_url().$this->core_model->admin_dir()."/admin_index";
			$data['page_title'] = "إعدادات صفحة اتصل بنا";
			$data['row'] = $this->core_model->get_settings();;
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/'. $this->router->fetch_class() .'/settings', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
	
	public function mailsettings()
	{
		if($this->core_model->admin_can())
		{
			if($this->input->post('save_smtp_data') == 1)
			{
				$this->db->Where( array("ID"=>1))->update("settings", 
                array("smtp"=> serialize($this->input->post('smtp') ),
                "send_to"=> $this->input->post('send_to') ,
                     "sendmail_settings"=>$this->input->post('settings_type')) );
			}
			$data['admin_dir']= base_url().$this->core_model->admin_dir()."/admin_index";
			$data['page_title'] = "إعدادات البريد الإلكتروني";
			$data['row'] = unserialize($this->core_model->get_settings('smtp'));
			$data['settings'] = $this->core_model->get_settings();
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/'. $this->router->fetch_class() .'/mailsettings', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
	
	public function reply($id)
	{
		if($this->core_model->admin_can())
		{
			$data['row'] = $this->db->where("ID='". $id ."'")->get('contact')->row();
			if($this->input->post('send'))
			{
				$mailer = unserialize($this->core_model->get_settings('smtp'));
				$this->load->library('email');
				$config['smtp_host']= $mailer['host'];
				$config['smtp_user']= $mailer['user'];
				$config['smtp_pass']= $mailer['pass'];
				$config['smtp_port']= $mailer['port'];
				$config['charset']= 'utf-8';
				$config['mailtype']= 'html';
				$this->email->initialize($config);
				$this->email->from($mailer['from']);
				$this->email->to($data['row']->email); 
				$this->email->subject($this->input->post('title'));
				$this->email->message($this->input->post('content'));	
				$this->email->send();
				$data['sent']=1;
			}
			
			
			$data['content']="<p>&nbsp;</p><p>---</p><div style='color:darkgray;border-right:3px solid #ccc; padding-right:15px; margin-right:15px;'>". stripslashes( nl2br($data['row']->message) ). "</div>";
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/'. $this->router->fetch_class() .'/sendmail', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
	
	
	public function del($id)
	{
		if($this->core_model->admin_can())
		{
			$this->db->where("ID='". $id ."'")->delete('contact');
			redirect( base_url().$this->core_model->admin_dir()."/contacts" );
		}else{
			$this->core_model->check_permission();
		}
	}


}
