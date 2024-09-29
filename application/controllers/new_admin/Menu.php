<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Menu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url','form'));
		$this->load->model('core_model');
		$this->load->model('admin/menu_model');
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
				$this->form_validation->set_rules('title', 'عنوان العنصر ', 'required',
					array('required' => '- لم تقم بكتابة %s.'));
				$this->form_validation->set_rules('url', 'رابط العنصر ', 'required',
					array('required' => '- لم تقم بكتابة %s.'));
				if($this->form_validation->run() != FALSE)
				{
				if($this->menu_model->menu_dupliated($this->input->post('title')) ==  true)
				{
					$data['duplicated']=1;
					$data['row']['title']= $this->input->post('title');
				}else{
						$title= $this->input->post('title');
						$url= $this->input->post('url');
						$active= $this->input->post('active');
						
						$ret= $this->menu_model->add_menu($title, $url, $active);
						$data['inserted']=$ret;
					}
				}
			}
			
			
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['page_title'] = "إضافــة عنصر";
			$data['editor'] = true;
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/menu/add', $data);
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
			$data['page_title'] = " القائمة الرئيسية";
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/menu/view', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
	
	
	public function save_order()
	{
		if($this->core_model->admin_can())
		{
			foreach( $this->input->post('menu_order') as $k=>$v )
			{
				$this->db->where("`ID`='{$k}'");
				$this->db->update("menu", array(
						"menu_order"=>$v,
						));
			}
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['page_title'] = " القائمة الرئيسية";
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/menu/save_order', $data);
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
		if(! $this->core_model->is_menu($id) )
		{
			$data['del']=0;
		}else
		{
			$data['del']=1;
			$this->load->model('admin/menu_model');
			$this->menu_model->del_menu($id);
		}
		$this->load->view( $this->core_model->admin_dir().'/menu/del', $data);
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
				$this->form_validation->set_rules('title', 'عنوان العنصر ', 'required',
						array('required' => '- لم تقم بكتابة %s.'));
				$this->form_validation->set_rules('url', 'رابط العنصر ', 'required',
						array('required' => '- لم تقم بكتابة %s.'));
				if($this->form_validation->run() != false )
				{
					$this->load->model('admin/menu_model');
					if( $this->core_model->is_menu($id) ==  true)
					{
						$title= $this->input->post('title');
						$url= $this->input->post('url');
						$news_date= $this->input->post('news_date');
						$active= $this->input->post('active');
						
						$this->menu_model->edit_menu($title, $url, $active, $id);
						$data['updated']=true;
					}else{
						show_404();
					}
				}
			}
			
			$data['edit']= $slug;
			$data['row']= $this->core_model->menu_data($slug);
			// var_dump($data['row']); die;
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['page_title'] = "تعديل عنصر \"". $data['row']['title'] ."\"";
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/menu/add', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
	
}
	
