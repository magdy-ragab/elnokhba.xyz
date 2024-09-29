<?php
class Social extends CI_Controller
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
			if($this->input->post('edit_settings'))
			{
				foreach($_POST as $k=>$v):
					if($k != 'edit_settings'):
						$this->db->update("social", array( "{$k}"=>$v ) );
					endif;
				endforeach;
			}
			
			$data['admin_dir']= base_url().$this->core_model->admin_dir();
			$data['page_title'] = "وسائل التواصل";
			$data['editor'] = true;
			$data['row']= $this->core_model->get_social();
			$this->load->view( $this->core_model->admin_dir().'/templates/header', $data);
			$this->load->view( $this->core_model->admin_dir().'/'. $this->router->fetch_class() .'/social', $data);
			$this->load->view( $this->core_model->admin_dir().'/templates/footer', $data );
		}else{
			$this->core_model->check_permission();
		}
	}
}
