<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class discountCodes extends CI_Controller {

    var $titles;
    var $cont;
    var $has;

    public function __construct() {
	parent::__construct();
	$this->load->database();
	$this->load->helper(array('url', 'form'));
	$this->load->model('core_model');
	$this->load->model('admin/pages_model');
	$this->load->library(array('session', 'form_validation'));
	$this->titles = array('إضافة دولة', 'عرض الدول');
	$this->cont = $this->router->fetch_class();
	$this->has = array('title', 'date', 'pic', 'active', 'content');

	if (!$this->session->userdata('user')) {
	    redirect(base_url() . $this->core_model->admin_dir());
	}
    }

    public function add() {
	if ($this->core_model->admin_can()) {
	    if ($this->input->post('add_news')) {
		$thumbnail = '';
		$pic = '';
		$this->form_validation->set_rules('title', 'الاسم ', 'required', array('required' => '- لم تقم بكتابة %s.'));
		if ($this->form_validation->run() != false) {
		    $title = $this->input->post('title');
		    $content = $this->input->post('code');
		    $active = $this->input->post('active');
		    $meta = $this->input->post('discount');
		    $ret = $this->pages_model->add_pages($title, $content, '', $active, $pic, $thumbnail, 'discountcode', $meta);
		    $data['inserted'] = $ret;
		}
	    }


	    $data['admin_dir'] = base_url() . $this->core_model->admin_dir() . "";
	    $data['page_title'] = "اضافة كود خصم";
	    $data['titles'] = $this->titles;
	    $data['editor'] = true;
	    $data['has'] = $this->has;
	    $this->load->view($this->core_model->admin_dir() . '/templates/header', $data);
	    $this->load->view($this->core_model->admin_dir() . '/' . $this->cont . '/add', $data);
	    $this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
	} else {
	    $this->core_model->check_permission();
	}
    }

    public function view() {
	if ($this->core_model->admin_can()) {
	    $data['titles'] = $this->titles;
	    $data['admin_dir'] = base_url() . $this->core_model->admin_dir();
	    $data['page_title'] = "عرض الأكواد";
	    $this->load->view($this->core_model->admin_dir() . '/templates/header', $data);
	    $this->load->view($this->core_model->admin_dir() . '/' . $this->cont . '/view', $data);
	    $this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
	} else {
	    $this->core_model->check_permission();
	}
    }

    public function del($id) {
	if ($this->core_model->admin_can()) {
	    $data['admin_dir'] = base_url() . $this->core_model->admin_dir();
	    $data['page_title'] = "حذف";
	    $data['cont'] = $this->cont;
	    $this->load->view($this->core_model->admin_dir() . '/templates/header', $data);
	    if (!$this->core_model->is_pages($id)) {
		$data['del'] = 0;
	    } else {
		$data['del'] = 1;
		$this->load->model('admin/pages_model');
		$this->pages_model->del_pages($id);
	    }
	    $this->load->view($this->core_model->admin_dir() . '/' . $this->cont . '/del', $data);
	    $this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
	} else {
	    $this->core_model->check_permission();
	}
    }

    public function edit($slug) {
	if ($this->core_model->admin_can()) {
	    $id = $this->input->post('id');
	    $this->form_validation->set_rules('title', 'الاسم ', 'required', array('required' => '- لم تقم بكتابة %s.'));
	    if ($this->form_validation->run() != false) {

		$this->load->model('admin/pages_model');
		if ($this->core_model->is_pages($slug) == true) {
		    $title = $this->input->post('title');
		    $content = $this->input->post('code');
		    $active = $this->input->post('active');
		    $meta = $this->input->post('discount');



		    $this->pages_model->edit_pages($title, $content, '', $active, $pic, $thumbnail, $id, $meta);
		    $data['updated'] = true;
		}

		$data['titles'] = $this->titles;
		$data['edit'] = $slug;
		$data['row'] = $this->core_model->pages_data($slug);

		$data['has'] = $this->has;
		$data['admin_dir'] = base_url() . $this->core_model->admin_dir();
		$data['page_title'] = "تعديل كود \"" . $data['row']['title'] . "\"";
		$this->load->view($this->core_model->admin_dir() . '/templates/header', $data);
		$this->load->view($this->core_model->admin_dir() . '/' . $this->cont . '/add', $data);
		$this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
	    }
	} else {
	    $this->core_model->check_permission();
	}
    }
    
    
    function states($id)
    {
	if ($this->core_model->admin_can()) {
	    echo time();
	} else {
	    $this->core_model->check_permission();
	}
    }

}
