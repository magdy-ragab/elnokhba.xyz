<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class News extends CI_Controller
{
	var $titles;
	var $cont;
	var $has;
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url','form'));
		$this->load->model(['core_model','admin/pages_model', 'admin/admin']);
		$this->load->library(array('session','form_validation')) ;
		$this->titles = array('إضافة موضوع', 'عرض الأخبار');
		$this->cont =$this->router->fetch_class();
		$this->has =array('title', 'date', 'pic', 'active', 'content');
		if(! $this->session->userdata('user'))
		{
			redirect( base_url().$this->core_model->admin_dir() );
		}
	}
	
	public function add()
	{
		if($this->core_model->admin_can())
		{
			if($this->input->post('add_news'))
			{
				$this->form_validation->set_rules('title', 'عنوان الموضوع ', 'required',
					array('required' => '- لم تقم بكتابة %s.'));
				$this->form_validation->set_rules('content', 'تفاصيل الموضوع ', 'required',
					array('required' => '- لم تقم بكتابة %s.'));
				$this->form_validation->run();
				
				if($this->pages_model->pages_dupliated($this->input->post('title')) ==  true)
				{
					$data['duplicated']=1;
					$data['row']['title']= $this->input->post('title');
				}else{
					$title= $this->input->post('title');
					$content= $this->input->post('content');
					$news_date= $this->input->post('news_date');
					$active= $this->input->post('active');
					$pic='';
					$thumbnail="";
					$up= $_FILES['up']['name'];
					if($up){
						$uploadedImage = $this->admin->uploadPic('up', '', './uploads/news/');
						$pic= $uploadedImage['pic'];
						$thumbnail= $uploadedImage['thumbnail'];
					}else{
						$pic="";
						$thumbnail="";
					}
					$ret= $this->pages_model->add_pages($title, $content, $news_date,$active,$pic,$thumbnail, $this->cont);
					$data['inserted']=$ret;
				}
			}
			
			
			$data['admin_dir']= base_url().$this->core_model->admin_dir()."";
			$data['page_title'] = "إضافــة موضوع";
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
	
	
	public function view()
	{
		if($this->core_model->admin_can())
		{
			$data['titles']= $this->titles;
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['page_title'] = "عرض المواضيع";
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
			if(! $this->core_model->is_pages($id) )
			{
				$data['del']=0;
			}else
			{
				$data['del']=1;
				$this->load->model('admin/pages_model');
				$this->pages_model->del_pages($id);
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
			if($this->input->post('edit_news'))
			{
				$id= $this->input->post('id');
				$this->form_validation->set_rules('title', 'عنوان الموضوع ', 'required',
						array('required' => '- لم تقم بكتابة %s.'));
				$this->form_validation->set_rules('content', 'تفاصيل الموضوع ', 'required',
						array('required' => '- لم تقم بكتابة %s.'));
				$this->form_validation->run();
				
				$this->load->model('admin/pages_model');
				if( $this->core_model->is_pages($id) ==  true)
				{
					$title= $this->input->post('title');
					$content= $this->input->post('content');
					$news_date= $this->input->post('news_date');
					$active= $this->input->post('active');
					$pic       =$this->input->post('old');
					$thumbnail =$this->input->post('thumb');
					$up= $_FILES['up']['name'];
					if($up)
					{
						$config['upload_path']          = './uploads/'.$this->cont.'/';
						$config['allowed_types']        = 'gif|jpg|png';
						$config['file_name']			= uniqid();
						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload('up'))
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
							$row=$this->core_model->news_data($id);
	 						unlink("./uploads/'.$this->cont.'/".$row['pic']);
	 						unlink("./uploads/'.$this->cont.'/".$row['thumbnail']);
						}
					}
					$this->pages_model->edit_pages($title, $content, $news_date,$active,$pic,$thumbnail, $id);
					$data['updated']=true;
				}else{
					show_404();
				}
			}
			
			$data['titles']= $this->titles;
			$data['edit']= $slug;
			$data['row']= $this->core_model->pages_data($slug);
			$data['has'] = $this->has;
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['page_title'] = "تعديل خبر \"". $data['row']['title'] ."\"";
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/'.$this->cont.'/add', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
	
}
	
