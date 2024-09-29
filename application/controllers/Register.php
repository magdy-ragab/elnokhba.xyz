<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Register extends CI_Controller
{
	var $hash = 'R41T0H45H';
	var $hash_repeat = 2;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->model(array('core_model', 'Hijri'));
		$this->load->library(['session', 'form_validation']);
	}

	public function index()
	{
		$data = array();
		$this->load->view('templates/header', $data);
		$this->load->view('register/register', $data);
		$this->load->view('templates/footer', $data);
	}

	function registerUser()
	{
		$data = array();
		if ($this->input->post('submit_register2')) {

			$this->form_validation->set_rules('email', 'البريد اﻹلكتروني', 'trim|required');
			$this->form_validation->set_rules('username', 'اسم المستخدم', 'trim|required');
			$this->form_validation->set_rules('password', 'كلمة المرور', 'trim|required');

			// echo time(); die;

			if ($this->form_validation->run() == false) {
				$data['errors'] = validation_errors() ;
				$this->load->view('templates/header', $data);
				$this->load->view('register/register', $data);
				$this->load->view('templates/footer', $data);
			}else{
				$salt = rand(10, 99);
				$hash = $this->hash;
				$repeat = $this->hash_repeat;
				$email = strtolower($this->input->post('email'));
				//FIXING ERROR :::  str_repeat() expects parameter 2 to be long, string given
				$rows = $this->db->where(array("email" => $email))->get("user");
				if ($rows->num_rows()) {
					$data['email_error_'] = 1;
					$this->load->view('templates/header', $data);
					$this->load->view('register/register', $data);
					$this->load->view('templates/footer', $data);
				} else {
					$pwd = '';
					for ($i = 0; $i <= $repeat; $i++) {
						$pwd .= $this->hash;
					}
					$pwdFinal = sha1($salt . md5($pwd) . sha1($this->input->post('password')));
					$this->db->insert("user", array(
						"username"  => $this->input->post('username'),
						"user_type"  => $this->input->post('type'),
						"email" => $email,
						"pwd" => $pwdFinal,
						"salt" => $salt
					));
					$id = $this->db->insert_id();
					$this->session->set_userdata("i", $id);
					$this->session->set_userdata("s", $salt);
					$this->session->set_userdata('hash', $pwdFinal);
					$this->session->set_userdata('type', $this->input->post('user_type'));
					$this->load->view('templates/header', $data);
					$this->load->view('register/register_done', $data);
					$this->load->view('templates/footer', $data);
				}
			}
		}
	}
}
