<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Comments extends CI_Controller {

    var $titles;
    var $cont;
    var $has;

    public function __construct() {
	parent::__construct();
	$this->load->database();
	$this->load->helper(array('url', 'form'));
	$this->load->model('core_model');
	$this->load->library(array('session', 'form_validation'));
	$this->cont = $this->router->fetch_class();
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

    public function view() {
	$data['page_title'] = 'التعليقات';
	$data['admin_dir'] = base_url() . $this->core_model->admin_dir();
	$data['admin_data'] = $this->core_model->admin_data_by_hash($_SESSION['user']);
	$this->load->view($this->core_model->admin_dir() . '/templates/header', $data);
	$this->load->view($this->core_model->admin_dir() . '/comments/view', $data);
	$this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
    }
    
    
    public function user($id) {
	$data['user'] = $this->db->get_where("user", "ID='{$id}'")->row();
	$data['id']=$id; 
	$data['page_title'] = 'التعليقات' ." : ".$data['user']->username ;
	$data['admin_dir'] = base_url() . $this->core_model->admin_dir();
	$data['admin_data'] = $this->core_model->admin_data_by_hash($_SESSION['user']);
	$this->load->view($this->core_model->admin_dir() . '/templates/header', $data);
	$this->load->view($this->core_model->admin_dir() . '/comments/view', $data);
	$this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
    }

}
