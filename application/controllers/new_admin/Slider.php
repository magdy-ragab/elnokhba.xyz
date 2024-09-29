<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Slider extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url','form'));
		$this->load->model('core_model');
		$this->load->model('admin/slider_model');
		$this->load->library(array('session','form_validation')) ;
		
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
				
				
				
					$title= $this->input->post('title');
					$content= $this->input->post('content');
					$news_date= $this->input->post('news_date');
					$active= $this->input->post('active');
					$pic='';
					$up= $_FILES['up']['name'];
					if($up)
					{
						$config['upload_path']          = './uploads/slider/';
						$config['allowed_types']        = 'gif|jpg|png';
						$config['max_size']             = 2000;
						$config['max_width']            = 2000;
						$config['max_height']           = 2000;
						$config['file_name']			= (uniqid());
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
						}
					}
					$up2= $_FILES['up2']['name'];
					if($up2)
					{
						$config['upload_path']          = './uploads/slider/';
						$config['allowed_types']        = 'gif|jpg|png';
						$config['max_size']             = 2000;
						$config['max_width']            = 2000;
						$config['max_height']           = 2000;
						$config['file_name']			= (uniqid());
						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload('up2'))
						{
							$data['uploads_error'] = array('error' => $this->upload->display_errors());
						}
						else
						{
							$front=$this->upload->data('file_name');
							$config['image_library'] = 'gd2';
							$config['source_image'] = $this->upload->data('full_path');
							
						}
					}
					$ret= $this->slider_model->add_slider($title, $content, $news_date,$active,$pic,$thumbnail, $front);
					$data['inserted']=$ret;
				
			}
			
			
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['page_title'] = "إضافــة صورة";
			$data['editor'] = true;
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/slider/add', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
	
	
	public function view()
	{
		if($this->core_model->admin_can())
		{
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['page_title'] = "عرض الصـور";
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/slider/view', $data);
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
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			if(! $this->core_model->is_slider($id) )
			{
				$data['del']=0;
			}else
			{
				$data['del']=1;
				$this->load->model('admin/slider_model');
				$this->slider_model->del_slider($id);
			}
			$this->load->view( $this->core_model->admin_dir().'/slider/del', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
	
	public function save_order()
	{
		if($this->core_model->admin_can())
		{
			if( count( $this->input->post('slider_order') ) )
			{
				foreach( $this->input->post('slider_order') as $k=>$v )
				{
					$this->db->where("`ID`='{$k}'");
					$this->db->update("slider", array(
							"slider_order"=>$v,
							));
				}
				$data['admin_dir']= base_url().$this->core_model->admin_dir();
				$data['page_title'] = " ترتيب عناصر الاسلايدر";
				$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
				$this->load->view( $this->core_model->admin_dir().'/slider/save_order', $data);
				$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
			}
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
				
				
				$this->load->model('admin/slider_model');
				if( $this->core_model->is_slider($id) ==  true)
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
						$config['upload_path']          = './uploads/slider/';
						$config['allowed_types']        = 'gif|jpg|png';
						$config['max_size']             = 2000;
						$config['max_width']            = 2000;
						$config['max_height']           = 2000;
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
							$row=$this->core_model->slider_data($id);
	 						unlink("./uploads/slider/".$row['pic']);
	 						unlink("./uploads/slider/".$row['thumbnail']);
						}
					}
					$up2= $_FILES['up2']['name'];
					if($up2)
					{
						$config['upload_path']          = './uploads/slider/';
						$config['allowed_types']        = 'gif|jpg|png';
						$config['max_size']             = 2000;
						$config['max_width']            = 2000;
						$config['max_height']           = 2000;
						$config['file_name']			= (uniqid());
						$this->load->library('upload', $config);
						if ( ! $this->upload->do_upload('up2'))
						{
							$data['uploads_error'] = array('error' => $this->upload->display_errors());
						}
						else
						{
							$front=$this->upload->data('file_name');
							$config['image_library'] = 'gd2';
							$config['source_image'] = $this->upload->data('full_path');
							
						}
					}
					$this->slider_model->edit_slider($title, $content, $news_date,$active,$pic,$thumbnail,$front,$id);
					$data['updated']=true;
				}else{
					show_404();
				}
			}
			
			$data['edit']= $slug;
			$data['row']= $this->core_model->slider_data($slug);
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['page_title'] = "تعديل صورة \"". $data['row']['title'] ."\"";
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/slider/add', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
	
}
	
