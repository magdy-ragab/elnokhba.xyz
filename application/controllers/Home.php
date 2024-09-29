<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url', 'form', 'text'));
		$this->load->library('session');
		$this->load->model('core_model');
	}


	public function index()
	{
		$data=[];
		$this->limit = $this->core_model->get_settings("product_limit");

		$data['display_method'] = $this->core_model->get_settings("display_method");
		$data['last'] = $this->shop->getLastProducts(12,"ID DESC");
		$data['home_4_cats'] = $this->shop->getHomeCats(4,"RAND()");
		$data['home_cats_order'] = $this->shop->getHomeCatsByOrder();

		// echo "<pre>";print_r($data['home_cats_order']); die;

		$this->load->view('templates/header', $data);
		$this->load->view('home/home', $data);
		$this->load->view('templates/footer', $data);
	}

	public function page404()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$data['page_title'] = 'خطأ 404 - الصفحة غير موجودة';
		$this->load->model('core_model');
		$data['show_slider'] = false;
		$data['show_left'] = false;
		$this->load->view('templates/header', $data);
		$this->load->view('home/page404', $data);
		$this->load->view('templates/footer', $data);
	}


	function country($countryCode = '')
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->model('core_model');
		$data['countryCode'] = $countryCode;
		$this->load->view('templates/header', $data);
		$this->load->view('home/home', $data);
		$this->load->view('templates/footer', $data);
	}
}
