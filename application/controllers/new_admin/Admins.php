<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admins extends CI_Controller
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
		$this->titles = array('إضافة خبر', 'عرض الأخبار');
		$this->cont =$this->router->fetch_class();
		$this->has =array('title', 'date', 'pic', 'active', 'content');
		if(! $this->session->userdata('user'))
		{
			redirect( base_url().$this->core_model->admin_dir() );
		}
	}
	
	public function mydata()
	{
		if($this->core_model->admin_can())
		{
			if($this->input->post('edit') == 1)
			{
				// var_dump($_FILES); die;
				$pic=$old=$this->input->post('old') ;
				$cover_old=$cover=$this->input->post('cover') ;
				if( isset($_FILES['pic']['name']) && $_FILES['pic']['name'])
				{
					$config['upload_path']          = './uploads/'.$this->cont.'/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 2000;
					$config['max_width']            = 2000;
					$config['max_height']           = 2000;
					$config['file_name']			= (uniqid());
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('pic'))
					{
						$data['uploads_error'] = array('error' => $this->upload->display_errors());
					}
					else
					{
						$pic=$this->upload->data('file_name');
						$config['image_library'] = 'gd2';
						$config['source_image'] = $this->upload->data('full_path');
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width']         = 250;
						$config['height']       = 250;
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$d=$this->upload->data();
						$thumbnail = $d['raw_name'].'_thumb'.$d['file_ext'];
						if($old!='user.png'){
							@unlink("./uploads/{$this->cont}/".$old);
						}
						$this->image_lib->clear(); 
					}
				}

				if( isset($_FILES['cover']['name']) && $_FILES['cover']['name'] )
				{
					// $this->image_lib->clear(); 
					$config['upload_path']          = './uploads/'.$this->cont.'/';
					$config['allowed_types']        = 'gif|jpg|png';
					$config['max_size']             = 2000;
					$config['max_width']            = 2000;
					$config['max_height']           = 2000;
					$config['file_name']			= (uniqid());
					$this->load->library('upload', $config);
					if ( ! $this->upload->do_upload('cover'))
					{
						$data['uploads_error'] = array('error' => $this->upload->display_errors());
					}
					else
					{
						if($cover!='cover.jpg'){
							@unlink("./uploads/{$this->cont}/".$cover);
						}
						if($cover!='cover.jpg'){
							@unlink("./uploads/{$this->cont}/".$cover_old);
						}
						$cover=$this->upload->data('file_name');
						$config['image_library'] = 'gd2';
						$config['source_image'] = $this->upload->data('full_path');
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width']         = 850;
						$config['height']       = 351;
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$d=$this->upload->data();
						$cover = $d['raw_name'].'_thumb'.$d['file_ext'];
						$this->image_lib->clear(); 
					}
				}
				$this->db->where("`hash`='". $this->session->userdata('user') ."'")->
					update("admin",
						[
							"pic"=>$pic,
							"cover"=>$cover,
							"username"=>$this->input->post('username')
						]
					);
				// var_dump($this->db->last_query()); die;
				$data['inserted']=1;
			}
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['page_title'] = "بياناتي";
			$data['row']= $this->core_model->current_admin();
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/'.$this->cont.'/mydata', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
	
	public function add()
	{
		
			if($this->core_model->admin_can())
			{
				if($this->input->post('add_news'))
				{
					
					if( $this->input->post('password1') != $this->input->post('password2') )
					{
						$data['not_equal']='1';
					}else{
						
						
						$e= $this->db->get_where("admin", array("email"=>$this->input->post('email')))->result()[0]->email ; 
						if( $e )
						{
							$data['duplicated']=1;
						}else
						{			
							$this->form_validation->set_rules('username', 'الاسم ', 'required',
								array('required' => '- لم تقم بكتابة %s.'));
							$this->form_validation->set_rules('email', 'البريد الإلكتروني ', 'required',
								array('required' => '- لم تقم بكتابة %s.'));
							$this->form_validation->set_rules('password1', 'كلمة المرور ', 'required',
								array('required' => '- لم تقم بكتابة %s.'));
							$this->form_validation->set_rules('password2', 'إعادة كلمة المرور ', 'required',
								array('required' => '- لم تقم بكتابة %s.'));
							if($this->form_validation->run() != false )
							{
								//print_r($_POST);
								$salt=$this->core_model->create_strings2(4);
								$salt_extra=$this->core_model->create_strings2(5);
								$repeat=rand(1,5);
							 	$password=$this->core_model->mk_password($salt,$repeat,$salt_extra,$this->input->post('password1'));
							 	$username=$this->input->post('username');
							 	$email=$this->input->post('email');
							 	$active=$this->input->post('active');
							 	$mode=$this->input->post('mode');
							 	$hash= md5("{$salt}.{$salt_extra}.{$repeat}");
							 	$module=implode(",",$this->input->post('modules'));
							 	
							 	$data['inserted']= $this->db->insert("admin", array(
							 		"username"=>$username ,
							 		"salt"=>$salt ,
							 		"salt_extra"=>$salt_extra ,
							 		"salt_repeat"=>$repeat ,
							 		"pwd"=>$password ,
							 		"email"=>$email ,
							 		"active"=>$active ,
							 		"mode"=>$mode ,
							 		"hash"=>$hash,
							 		"modules"=>$module
							 	));
							}
						}
					}
					
				}
				
				
				$data['admin_dir']= base_url().$this->core_model->admin_dir();
				$data['page_title'] = "المشرفين";
				$data['titles']= $this->titles;
				$data['editor'] = true;
				$data['has'] = $this->has;
				$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
				$this->load->view( $this->core_model->admin_dir().'/'.$this->cont.'/add', $data);
				$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
			}else{
				$this->core_model->check_permission();
			}
		
	}
	
	
	
	public function edit_password($id)
	{
		if($this->core_model->admin_can())
		{
			if($this->core_model->is_admin_id($id) == $id)
			{
				if( $this->input->post('change') )
				{
					if( strtolower(str_replace(" ", "", $this->input->post('cap'))) ==  strtolower(str_replace(" ", "", $this->input->post('word'))))
					{
						if( $this->input->post('password1') != $this->input->post('password2') )
						{
							$data['not_equal']='1';
						}else{
							
							$salt=$this->core_model->create_strings2(4);
							$salt_extra=$this->core_model->create_strings2(5);
							$repeat=rand(1,5);
						 	$password=$this->core_model->mk_password($salt,$repeat,$salt_extra,$this->input->post('password1'));
						 	$hash= md5("{$salt}.{$salt_extra}.{$repeat}");
							$data['inserted']= $this->db->where("ID='{$id}'")->update("admin", array(
						 		"salt"=>$salt ,
						 		"salt_extra"=>$salt_extra ,
						 		"salt_repeat"=>$repeat ,
						 		"pwd"=>$password ,
						 		"hash"=>$hash
						 	));
						}
						
				
	
					}else{
						$data['wrong']= 1;
					}
				}
				$this->load->helper('captcha');
				$data['titles']= $this->titles;
				$data['admin_dir']= base_url().$this->core_model->admin_dir();
				$data['admin_data'] = $this->core_model->admin_data($id);
				$cap_func =$this->core_model->captcha_img();
		     	$data['cap']= $cap_func;
				$data['page_title'] = "تغيير كلمة المرور";
				$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
				$this->load->view( $this->core_model->admin_dir().'/'.$this->cont.'/edit_password', $data);
				$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
			}else{
				$data['page_title'] = "تغيير كلمة المرور";
				$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
				$this->load->view( $this->core_model->admin_dir().'/'.$this->cont.'/edit_password_error', $data);
				$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
			}
		}else{
			$this->core_model->check_permission();
		}
	}
	
	
	public function view()
	{
		if($this->core_model->admin_can())
		{
			$data['titles']= $this->titles;
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['page_title'] = "المشرفين";
			
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/'.$this->cont.'/view', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
	
	public function del($id)
	{
		if($this->core_model->admin_can())
		{
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['page_title'] = "حذف";
			$data['cont'] = $this->cont;
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			if(! $this->core_model->is_admin_id($id) )
			{
				$data['del']=0;
			}else
			{
				$data['del']=1;
				$this->db->where(array("ID"=>$id))->delete("admin");
			}
			$this->load->view( $this->core_model->admin_dir().'/'.$this->cont.'/del', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
	
	public function edit($slug)
	{
		if($this->core_model->admin_can())
		{
			if( $this->input->post('edit_news') )
			{
			 	$username=$this->input->post('username');
			 	$email=$this->input->post('email');
			 	$active=$this->input->post('active');
			 	$mode=$this->input->post('mode');
			 	$module=implode(",",$this->input->post('modules'));
			 	
			 	$this->db->where("ID='{$slug}'")->update("admin", array(
			 		"username"=>$username ,
			 		"email"=>$email ,
			 		"active"=>$active ,
			 		"mode"=>$mode ,
			 		"modules"=>$module
			 	));
			 	$data['updated']=1;
			}
			$data['edit']= $slug;
			$data['row']= $this->core_model->admin_data($slug);
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['page_title'] = "تعديل مشرف/مدير \"". $data['row']->username ."\"";
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/'.$this->cont.'/add', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
	
}
	
