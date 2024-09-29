<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {
    public function __construct() {
	parent::__construct();
	$this->load->library('session');
    }
	public function index()
	{
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->library('form_validation');
		
		
		$data['page_title']='اتصل بنا';
		$this->load->model('core_model');
		$data['show_slider']= false;
		//$data['form_validate']= true;
		
		if($this->input->post('send-contact')  )
		{
			
			$this->form_validation->set_rules('uname', 'الاسم مطلوبة', 'required', array('required'=>"خانة {field} "));
			$this->form_validation->set_rules('mobile', 'خانة الجوال إلزامية', 'required', array('required'=>"خانة {field} "));
			$this->form_validation->set_rules('email', 'خانة البريد اﻹلكتروني إلزامية', 'required', array('required'=>"خانة {field} "));
			$this->form_validation->set_rules('subject', 'موضوع الرسالة ؟', 'required', array('required'=>"خانة {field} "));
			$this->form_validation->set_rules('message', 'نص الرسالة لم يتم كتاتبه', 'required', array('required'=>"خانة {field} "));
			if($this->form_validation->run() != false )
			{
				$this->core_model->contact_insert($this->input->post());
				$data['inserted']=1;
			}else{
				$data['errors'] = validation_errors();
			}
		}
		
		$title="اتصل بنا";
		$data['page_keywords']=str_replace(" ",",",$title).",".$this->core_model->get_settings('keywords');
		$data['page_description']=$title." ".$this->core_model->get_settings('description');
		$data['row']=$this->core_model->get_settings();
		
		$this->load->view('templates/header',$data);
		$this->load->view('contacts/contacts', $data);
		// echo(__LINE__.' '.time()); die();
		$this->load->view('templates/footer', $data);
	}
}
