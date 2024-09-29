<?php

class Settings extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('session', 'form_validation'));
		$this->load->helper(array('url', 'form'));
		$this->load->model(array('core_model', 'admin/comics_model'));
		if (!$this->session->userdata('user')) {
			redirect(base_url() . $this->core_model->admin_dir());
		}
	}

	public function index()
	{
		if ($this->core_model->admin_can()) {
			if ($this->input->post('edit_settings')) {
				$config['upload_path'] = 'uploads/site/';
				$config['allowed_types'] = 'gif|jpg|png|ico';
				$config['max_size'] = 1024;
				$config['max_width'] = 1024;
				$config['max_height'] = 768;
				$config['overwrite'] = true;
				$config['remove_spaces'] = true;

				$this->load->library('upload', $config);

				if ($_FILES['news_img']['name']) {
					if (!$this->upload->do_upload('news_img')) {
						$data['error'] = array('error' => $this->upload->display_errors());
					} else {
						$data['upload_data'] = $this->upload->data();
						$news_img = $data['upload_data'];
					}
				} else {
					$news_img['file_name'] = $this->input->post('oldnews_img');
				}


				if ($_FILES['favicon']['name']) {
					if (!$this->upload->do_upload('favicon')) {
						$data['error'] = array('error' => $this->upload->display_errors());
					} else {
						$data['upload_data'] = $this->upload->data();
						$fav = $data['upload_data'];
					}
				} else {
					$fav['file_name'] = $this->input->post('oldfav');
				}

				if ($_FILES['image']['name']) {
					if (!$this->upload->do_upload('image')) {
						$data['error'] = array('error' => $this->upload->display_errors());
					} else {
						$data['upload_data'] = $this->upload->data();
						$site_image = $data['upload_data'];
					}
				} else {
					$site_image['file_name'] = $this->input->post('oldsite_image');
				}

				if (!$data['error']) {
					$this->form_validation->set_rules('title', 'اسم الموقع', 'required', array('required' => '- لم تقم بكتابة %s.'));
					$this->form_validation->set_rules('description', 'description', 'required', array('required' => '- لم تقم بكتابتها %s.'));
					$this->form_validation->set_rules('description', 'keywords', 'required', array('required' => '- لم تقم بكتابتها %s.'));
					if ($this->form_validation->run()) {

						$this->db->Where(array("ID" => 1))->update("settings", array(
							"title" => $this->input->post('title'),
							"display_method" => $this->input->post('display_method'),
							"product_limit" => $this->input->post('product_limit'),
							"fav" => $fav['file_name'],
							"news_img" => $news_img['file_name'],
							"site_image" => $site_image['file_name'],
							"keywords" => $this->input->post('keywords'),
							"description" => $this->input->post('description'),
							"publisher" => $this->input->post('publisher'),
							"author" => $this->input->post('author'),
							"creator" => $this->input->post('creator'),
							"load_mycountry" => $this->input->post('load_mycountry'),
							"default_country" => $this->input->post('default_country'),
							"rate" => $this->input->post('rate'),
							"sandbox" => $this->input->post('sandbox'),
							"email" => $this->input->post('email'),
							"color_theme" => $this->input->post('color_theme'),
							"shipping_size_0" => $this->input->post('shipping_size_0'),
							"shipping_size_1" => $this->input->post('shipping_size_1'),
							"shipping_size_2" => $this->input->post('shipping_size_2')
						));
					}
					$data['saved'] = true;
				}
			}

			$data['admin_dir'] = base_url() . $this->core_model->admin_dir();
			$data['page_title'] = "اﻹعدادات";
			$data['editor'] = true;
			$data['row'] = $this->core_model->get_settings();
			$this->load->view($this->core_model->admin_dir() . '/templates/header', $data);
			$this->load->view($this->core_model->admin_dir() . '/' . $this->router->fetch_class() . '/settings', $data);
			$this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
		} else {
			$this->core_model->check_permission();
		}
	}

	function catsettings()
	{
		if ($this->core_model->admin_can()) {
			if ($this->input->post('edit_settings')) {
				$this->db->update("options", array("option_value" => serialize($_POST['option'])));
			}
			$row = unserialize($this->db->where(array("option_name" => "main_cat_order"))->get("options")->row()->option_value);
			$data['admin_dir'] = base_url() . $this->core_model->admin_dir();
			$data['page_title'] = "اﻹعدادات";
			$data['editor'] = true;
			array_flip($row['order']);
			$data['cat_settings'] = $row;
			if (!is_array($data['cat_settings'])){
				$data['cat_settings'] = array();
			}
			$this->load->view($this->core_model->admin_dir() . '/templates/header', $data);
			$this->load->view($this->core_model->admin_dir() . '/' . $this->router->fetch_class() . '/catSettings', $data);
			$this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
		} else {
			$this->core_model->check_permission();
		}
	}
}
