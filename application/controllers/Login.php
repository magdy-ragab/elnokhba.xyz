<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
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
		$this->load->library('session');
	}

	public function index()
	{
		$data = array();
		$this->load->view('templates/header', $data);
		$this->load->view('login/login', $data);
		$this->load->view('templates/footer', $data);
	}

	function login()
	{
		$data = array();
		if ($this->input->post('submit_login')) {
			$email = strtolower($this->input->post('usermail'));
			$rows = $this->db->where(array("email" => $email, "user_type" => $this->input->post('type')))->get("user");

			if (!$rows->num_rows()) {
				$data['email_error'] = 1;
				$this->load->view('templates/header', $data);
				$this->load->view('login/login', $data);
				$this->load->view('templates/footer', $data);
			} else {
				$pwd = '';
				for ($i = 0; $i <= $this->hash_repeat; $i++) {
					$pwd .= $this->hash;
				}
				$row = $rows->row();
				$salt = $row->salt;
				$pwdFinal = sha1($salt . md5($pwd) . sha1($this->input->post('password')));
				if ($pwdFinal == $row->pwd) {
					if (isset($_POST['back'])) $back = $this->input->post('back');
					else $back = base_url();
					$data['back'] = $back;
					$this->session->set_userdata("i", $row->ID);
					$this->session->set_userdata("s", $salt);
					$this->session->set_userdata('hash', $pwdFinal);
					$this->session->set_userdata('type', $row->user_type);
					$_SESSION['wishlist'] = array();
					foreach ($this->db->where("uid='{$row->ID}'")->get('wishlist')->result() as $wishlist) {
						$_SESSION['wishlist'][] = $wishlist->item_id;
					}
					$this->load->view('templates/header', $data);
					$this->load->view('login/login_done', $data);
					$this->load->view('templates/footer', $data);
				} else {
					$data['email_error'] = 1;
					$this->load->view('templates/header', $data);
					$this->load->view('login/login', $data);
					$this->load->view('templates/footer', $data);
				}
			}
		}
	}
}
