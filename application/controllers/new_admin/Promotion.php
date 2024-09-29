<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Promotion extends CI_Controller
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
		$this->titles = array('إضافة ترويج', 'عرض العروض السابقة');
		$this->cont =$this->router->fetch_class();
		$this->has =array('title', 'date', 'pic', 'active', 'content');
		if(! $this->session->userdata('user'))
		{
			redirect( base_url().$this->core_model->admin_dir() );
		}
	}
	
	public function prod($id)
	{
	    if($this->core_model->admin_can())
	    {
		if($this->input->post('add_news'))
		{
		    $this->form_validation->set_rules('title', 'عنوان الترويج ', 'required',
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
			//add_pages($title, $content='', $news_date='0000-00-00', $active='Y', $pic='',$thumbnail='', $module='pages', $meta='', $size='', $ar= array())
			$ret= $this->pages_model->add_pages($title, $content, $news_date,$active,$pic,$thumbnail, $this->cont, $this->input->post('count'),'', array("parent_id"=>$this->input->post('cat')) );
			$data['inserted']=$ret;
		    }
		}


		$data['admin_dir']= base_url().$this->core_model->admin_dir()."";
		$data['page_title'] = "إضافــة ترويج";
		$data['titles']= $this->titles;
		$data['editor'] = true;
		$data['has'] = $this->has;
		$data['id'] = $id;
		$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
		$this->load->view( $this->core_model->admin_dir().'/'.$this->cont.'/prod', $data);
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
		    $this->form_validation->set_rules('title', 'عنوان الترويج ', 'required',
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
			//add_pages($title, $content='', $news_date='0000-00-00', $active='Y', $pic='',$thumbnail='', $module='pages', $meta='', $size='', $ar= array())
			$ret= $this->pages_model->add_pages($title, $content, $news_date,$active,$pic,$thumbnail, $this->cont, $this->input->post('count'),'', array("parent_id"=>$this->input->post('cat')) );
			$data['inserted']=$ret;
		    }
		}


		$data['admin_dir']= base_url().$this->core_model->admin_dir()."";
		$data['page_title'] = "إضافــة ترويج";
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
			$data['page_title'] = "عرض العروض السابقة";
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
			$this->form_validation->set_rules('title', 'عنوان الترويج ', 'required',
			    array('required' => '- لم تقم بكتابة %s.'));
			$this->form_validation->run();

			$this->load->model('admin/pages_model');
			if( $this->core_model->is_pages($id) ==  true)
			{
			    $title= $this->input->post('title');
			    $content= $this->input->post('content');
			    $news_date= $this->input->post('news_date');
			    $active= $this->input->post('active');
			    //edit_pages($title, $content='', $news_date='0000-00-00', $active='Y', $pic='',$thumbnail='',$id,$ar= array(),$meta='')
			    $this->pages_model->edit_pages($title, $content, $news_date,$active,'','', $id, array("parent_id"=>$this->input->post('cat')), $this->input->post('count') );
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
		    $data['page_title'] = "تعديل ترويج \"". $data['row']['title'] ."\"";
		    $this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
		    $this->load->view( $this->core_model->admin_dir().'/'.$this->cont.'/add', $data);
		    $this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
	    }else{
		    $this->core_model->check_permission();
	    }
	}
	
}
	
