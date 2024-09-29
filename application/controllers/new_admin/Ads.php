<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ads extends CI_Controller
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
		$this->titles = array('إضافة إعلان', 'عرض الإعلانات');
		$this->cont =$this->router->fetch_class();
		$this->has =array('title', 'date', 'pic', 'active', 'content');
        
		if(! $this->session->userdata('user'))
		{
			redirect( base_url().$this->core_model->admin_dir() );
		}
	}
    
    
    public function save_order()
	{
		if($this->core_model->admin_can())
		{
			foreach( $this->input->post('menu_order') as $k=>$v )
			{
				$this->db->where("`ID`='{$k}'");
				$this->db->update("pages", array(
						"p_order"=>$v,
						));
			}
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['page_title'] = " ترتيب الإعلانات";
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/country/save_order', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
    
    public function city($country_id)
    {
        if($this->core_model->admin_can())
		{
            if($this->input->post('add_news'))
			{
				$this->form_validation->set_rules('title', 'المدن ', 'required',
					array('required' => '- لم تقم بكتابة %s.'));
				if($this->form_validation->run() != false )
				{
					foreach(explode("\r\n" , $this->input->post('title') ) as $title)
                    {
                        $ret= $this->pages_model->add_pages($title, $content, '',$active,'','', 'city', '', '', array("parent_id"=>$this->input->post('country')  )) ;
                    }
					$data['inserted']=$ret;
				
                }
			}
            
            $data['admin_dir']= base_url().$this->core_model->admin_dir()."";
			$data['page_title'] = "اضافة المدن";
			$data['titles']= $this->titles;
			$data['editor'] = true;
			$data['has'] = $this->has;
            $data['country']=$this->core_model->pages_data($country_id);
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/'.$this->cont.'/city', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
        }else{
			$this->core_model->check_permission();
		}
    }
    
    public function city_edit($country_id)
    {
        if($this->core_model->admin_can())
		{
            if($this->input->post('edit_news'))
			{
				$this->form_validation->set_rules('title', 'الاسم ', 'required',
					array('required' => '- لم تقم بكتابة %s.'));
				if($this->form_validation->run() != false )
				{
					$title= $this->input->post('title');
                    //edit_pages($title, $content='', $news_date='0000-00-00', $active='Y', $pic='',$thumbnail='',$id,$ar= array())
					$ret= $this->pages_model->edit_pages($title, '', '',$active,'','', $this->input->post('id'), array("parent_id"=>$this->input->post('country') , )) ;
					$data['updated']=1;
				
                }
			}
            
            $data['admin_dir']= base_url().$this->core_model->admin_dir()."";
			$data['page_title'] = "اضافة المدن";
			$data['titles']= $this->titles;
			$data['editor'] = true;
			$data['has'] = $this->has;
            $data['row']= $this->core_model->pages_data($country_id);
            $data['edit']= $country_id;
            $data['country']=$this->core_model->pages_data($data['row']['parent_id']);
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/'.$this->cont.'/city', $data);
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
		$thumbnail='';$pic='';
		$this->form_validation->set_rules('title', 'الاسم ', 'required',
		array('required' => '- لم تقم بكتابة %s.'));
		if($this->form_validation->run() != false )
		{
		    $title= $this->input->post('title');
		    $content= $this->input->post('content');
		    $active= $this->input->post('active');
		    $up= $_FILES['up']['name'];
		    
		    if($up)
                        {
                            $config['upload_path']          = './uploads/'.$this->cont.'/';
                            $config['allowed_types']        = 'gif|jpg|png';
                            $config['max_size']             = 2000;
                            $config['max_width']            = 2000;
                            $config['max_height']           = 2000;
                            $config['file_name']			= (uniqid());
                            $this->load->library('upload', $config);
                            if ( ! $this->upload->do_upload('up'))
                            {
                                $data['uploads_error']=array('error'=>$this->upload->display_errors());
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
		    //add_pages($title, $content='', $news_date='0000-00-00', $active='Y', $pic='',$thumbnail='', $module='pages', $meta='', $size='', $ar= array())
		    $ret= $this->pages_model->add_pages($title, $content, '',$active,$pic,$thumbnail, 'ads','','') ;
		    $data['inserted']=$ret;
		}
	    }


	    $data['admin_dir']= base_url().$this->core_model->admin_dir()."";
	    $data['page_title'] = "اضافة إعلان";
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
			$data['page_title'] = "عرض الإعلانات";
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
				$pic= $this->input->post('pic');
				$thumbnail= $this->input->post('thumb');
				$this->form_validation->set_rules('title', 'اسم القسم ', 'required',
						array('required' => '- لم تقم بكتابة %s.'));
                		if($this->form_validation->run() != false )
				{
				
				$this->load->model('admin/pages_model');
				if( $this->core_model->is_pages($slug) ==  true)
				{
				    $title= $this->input->post('title');
				    $active= $this->input->post('active');
				    $content= $this->input->post('content');
				    $up= $_FILES['up']['name'];
		    
				if($up)
				{
				    $config['upload_path']          = './uploads/'.$this->cont.'/';
				    $config['allowed_types']        = 'gif|jpg|png';
				    $config['max_size']             = 2000;
				    $config['max_width']            = 2000;
				    $config['max_height']           = 2000;
				    $config['file_name']			= (uniqid());
				    $this->load->library('upload', $config);
				    if ( ! $this->upload->do_upload('up'))
				    {
					$data['uploads_error']=array('error'=>$this->upload->display_errors());
				    }
				    else
				    {
					@unlink("uploads/brands/".$pic);
					@unlink("uploads/brands/".$thumbnail);
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
				    $this->pages_model->edit_pages($title, $content, '',$active,$pic,$thumbnail, $id,array('url'=>$this->input->post('url')) );
				    $data['updated']=true;
				}
                }else{
					show_404();
				}
			}
			
			$data['titles']= $this->titles;
			$data['edit']= $slug;
			$data['row']= $this->core_model->pages_data($slug);
			$meta= unserialize($data['row']['meta']);
			if(is_array($meta))
			{
				     $data['row']= array_merge( $meta, $data['row'] ) ;
			}
			$data['has'] = $this->has;
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['page_title'] = "تعديل إعلان \"". $data['row']['title'] ."\"";
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/'.$this->cont.'/add', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
	
	public function customize()
	{
	    if($this->core_model->admin_can())
		{
			if($this->input->post('add_news'))
			{
			    $this->db->where("ID!=''")->delete("ads_positions");
			    foreach( $this->input->post('ad') as $k=>$v )
			    {
				$this->db->insert("ads_positions", array("ad"=>$v, "position"=>$k) );
			    }
			    $data['inserted']=1;
			}
			
			$data['titles']= $this->titles;
			$data['edit']= $slug;
			$data['row']= $this->core_model->pages_data($slug);
			$meta= unserialize($data['row']['meta']);
			if(is_array($meta))
			{
				     $data['row']= array_merge( $meta, $data['row'] ) ;
			}
			$data['has'] = $this->has;
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['page_title'] = "تخصيص الإعلانات ";
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/'.$this->cont.'/customize', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
}
	
