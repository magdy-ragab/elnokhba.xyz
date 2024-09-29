<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{

	var $titles;
	var $cont;
	var $has;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url', 'form'));
		$this->load->model('core_model');
		$this->load->model('admin/pages_model');
		$this->load->library(array('session', 'form_validation'));
		$this->titles = array('إضافة قسم', 'عرض الاقسام');
		$this->cont = $this->router->fetch_class();
		$this->has = array('title', 'date', 'pic', 'active', 'content');
		$this->adminDir= $this->core_model->admin_dir();
		if (!$this->session->userdata('user')) {
			redirect(base_url() . $this->adminDir);
		}
	}

	public function save_order()
	{
		if ($this->core_model->admin_can()) {
			foreach ($this->input->post('menu_order') as $k => $v) {
				$this->db->where("`ID`='{$k}'");
				$this->db->update("filed_input", array(
					"input_order" => $v,
				));
			}
			$data['admin_dir'] = base_url() . $this->adminDir;
			$data['page_title'] = " القائمة الرئيسية";
			$this->load->view($this->adminDir . '/templates/header', $data);
			$this->load->view($this->adminDir . '/' . $this->cont . '/save_order', $data);
			$this->load->view($this->adminDir . '/templates/footer', $data);
		} else {
			$this->core_model->check_permission();
		}
	}

	public function brands($id)
	{
		if ($this->input->post('add_news')) {
			$this->form_validation->set_rules('title', 'اسم hgtzm ', 'required', 
				['required' => '- لم تقم بكتابة %s.']
			);
			if ($this->form_validation->run() != false) {


				$title = $this->input->post('title');
				$active = $this->input->post('active');
				$pic = '';
				$up = $_FILES['up']['name'];
				if ($up) {
					$config['upload_path'] = './uploads/' . $this->cont . '/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = 200000;
					$config['max_width'] = 20000;
					$config['max_height'] = 20000;
					$config['file_name'] = (uniqid());
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('up')) {
						$data['uploads_error'] = ['error' => $this->upload->display_errors()];
					} else {
						$pic = $this->upload->data('file_name');
						$config['image_library'] = 'gd2';
						$config['source_image'] = $this->upload->data('full_path');
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 250;
						$config['height'] = 250;
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$d = $this->upload->data();
						$thumbnail = $d['raw_name'] . '_thumb' . $d['file_ext'];
					}
				}
				$ret = $this->pages_model->add_pages(
					$title,
					"",
					"",
					$active,
					$pic,
					$thumbnail,
					'brands',
					'',
					'',
					["parent_id" => $this->input->post('parent_id')]
				);
				$data['inserted'] = $ret;
			}
		}


		$data['admin_dir'] = base_url() . $this->adminDir . "";
		//$data['cat']= $this->core_model->pages_data($data['row']['parent_id']);
		$data['page_title'] = "الفئات";
		$data['titles'] = $this->titles;
		$data['editor'] = true;
		$data['parent'] = $id;
		$data['has'] = $this->has;
		$this->load->view($this->adminDir . '/templates/header', $data);
		$this->load->view($this->adminDir . '/' . $this->cont . '/brands', $data);
		$this->load->view($this->adminDir . '/templates/footer', $data);
	}

	public function edit_brand($parent_id, $id)
	{
		if ($this->input->post('edit_news')) {
			$this->form_validation->set_rules('title',
				'اسم البراند ',
				'required',
				['required' => '- لم تقم بكتابة %s.']
			);
			if ($this->form_validation->run() != false) {


				$title = $this->input->post('title');
				$active = $this->input->post('active');
				$pic = $this->input->post('old');
				$thumbnail = $this->input->post('thumb');
				$up = $_FILES['up']['name'];
				if ($up) {
					$config['upload_path'] = './uploads/' . $this->cont . '/';
					$config['allowed_types'] = 'gif|jpg|png|jpeg';
					$config['max_size'] = 200000;
					$config['max_width'] = 20000;
					$config['max_height'] = 20000;
					$config['file_name'] = (uniqid());
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('up')) {
						$data['uploads_error'] = ['error' => $this->upload->display_errors()];
					} else {
						$pic = $this->upload->data('file_name');
						$config['image_library'] = 'gd2';
						$config['source_image'] = $this->upload->data('full_path');
						$config['create_thumb'] = TRUE;
						$config['maintain_ratio'] = TRUE;
						$config['width'] = 250;
						$config['height'] = 250;
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$d = $this->upload->data();
						$thumbnail = $d['raw_name'] . '_thumb' . $d['file_ext'];
						@unlink("uploads/" . $this->input->post('old'));
						@unlink("uploads/" . $this->input->post('thumbnail'));
					}
				}
				$this->pages_model->edit_pages(
					$title,
					"",
					"",
					$active,
					$pic,
					$thumbnail,
					$id
				);
				$data['updated'] = 1;
			}
		}


		$data['admin_dir'] = base_url() . $this->adminDir . "";
		$data['row'] = $this->core_model->pages_data($id);
		$data['cat'] = $this->core_model->pages_data($data['row']['parent_id']);
		$data['page_title'] = "الفئات";
		$data['titles'] = $this->titles;
		$data['editor'] = true;
		$data['parent'] = $id;
		$data['has'] = $this->has;
		$this->load->view($this->adminDir . '/templates/header', $data);
		$this->load->view($this->adminDir . '/' . $this->cont . '/brands', $data);
		$this->load->view($this->adminDir . '/templates/footer', $data);
	}

	public function getExchange()
	{
		$code = "USDEGP";
		$file = "http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20yahoo.finance".
			".xchange%20where%20pair%20in%20(%22{$code}%22)&env=".
			"store://datatables.org/alltableswithkeys";
		$json = json_decode(json_encode(simplexml_load_file($file)), TRUE);
		echo $rate = $json['results']['rate']['Rate'];
		return ($rate);
	}

	public function fields($catId)
	{
		if ($this->input->post('add_field')) {
			$this->form_validation->set_rules(
				'title',
				'اسم الحقل ',
				'required',
				['required' => '- لم تقم بكتابة %s.']
			);
			$this->form_validation->set_rules(
				'input_type',
				'نوع الحقل ',
				'required',
				['required' => '- لم تقم بكتابة %s.']
			);
			if ($this->form_validation->run() != false) {
				$id = $this->db->insert("filed_input", array(
					"parent_id" => $this->input->post('parent_id'),
					"title" => $this->input->post('title'),
					"input_type" => $this->input->post('input_type'),
					"default_value" => $this->input->post('default_value'),
					"searchable" => $this->input->post('searchable'),
					"input_required" => $this->input->post('input_required'),
					"error_msg" => $this->input->post('error_msg'),
					"number_min" => $this->input->post('number_min'),
					"number_max" => $this->input->post('number_max'),
					"pic_thumb" => $this->input->post('pic_thumb'),
					"thumb_width" => $this->input->post('thumb_width'),
					"thumb_height" => $this->input->post('thumb_height'),
					"no_prev_date" => $this->input->post('no_prev_date'),
					"module" => $this->input->post('module'),
					"multi_color" => $this->input->post('multi_color'),
					"input_id" => uniqid("input_" . $this->input->post('input_type') . "_")
				));
				$this->db->
					where(["ID" => $this->input->post('parent_id')])->
					update("pages", ["meta" => '']);
				$data['inserted'] = $id;
			}
		}


		$data['admin_dir'] = base_url() . $this->adminDir . "";
		$data['cat'] = $this->core_model->pages_data($catId);
		$data['page_title'] = "اضافة اقسام";
		$data['titles'] = $this->titles;
		$data['editor'] = true;
		$data['has'] = $this->has;

		$this->load->view($this->adminDir . '/templates/header', $data);
		$this->load->view($this->adminDir . '/' . $this->cont . '/fields', $data);
		$this->load->view($this->adminDir . '/templates/footer', $data);
	}

	public function edit_field($id)
	{
		if ($this->input->post('edit_field')) {
			$this->form_validation->set_rules(
				'title',
				'اسم الحقل ',
				'required',
				['required' => '- لم تقم بكتابة %s.']
			);
			$this->form_validation->set_rules(
				'input_type',
				'نوع الحقل ',
				'required',
				['required' => '- لم تقم بكتابة %s.']
			);
			if ($this->form_validation->run() != false) {
				$this->db->
					where(["ID" => $id])->
					update("filed_input", [
						"parent_id" => $this->input->post('parent_id'),
						"title" => $this->input->post('title'),
						"input_type" => $this->input->post('input_type'),
						"default_value" => $this->input->post('default_value'),
						"searchable" => $this->input->post('searchable'),
						"input_required" => $this->input->post('input_required'),
						"error_msg" => $this->input->post('error_msg'),
						"number_min" => $this->input->post('number_min'),
						"number_max" => $this->input->post('number_max'),
						"pic_thumb" => $this->input->post('pic_thumb'),
						"thumb_width" => $this->input->post('thumb_width'),
						"thumb_height" => $this->input->post('thumb_height'),
						"no_prev_date" => $this->input->post('no_prev_date'),
						"module" => $this->input->post('module'),
						"multi_color" => $this->input->post('multi_color')
					]
				);
				$data['updated'] = $id;
				$this->db->
					where(["ID" => $this->input->post('parent_id')])->
					update("pages", ["meta" => '']);
			}
		}


		$data['admin_dir'] = base_url() . $this->adminDir . "";
		$data['row'] = $this->db->
			where(["ID" => $id])->
			get("filed_input")->
			row_array();
		$data['cat'] = $this->core_model->pages_data($data['row']['parent_id']);
		$data['page_title'] = "اضافة اقسام";
		$data['titles'] = $this->titles;
		$data['editor'] = true;
		$data['has'] = $this->has;

		$this->load->view($this->adminDir . '/templates/header', $data);
		$this->load->view($this->adminDir . '/' . $this->cont . '/fields', $data);
		$this->load->view($this->adminDir . '/templates/footer', $data);
	}

	public function add()
	{
		if ($this->core_model->admin_can()) {
			if ($this->input->post('add_news')) {
				$this->form_validation->set_rules(
					'title',
					'اسم القسم ',
					'required',
					['required' => '- لم تقم بكتابة %s.']
				);
				if ($this->form_validation->run() != false) {
					$title = $this->input->post('title');
					$content = $this->input->post('content');
					$news_date = $this->input->post('news_date');
					$active = $this->input->post('active');
					$pic = '';
					$thumbnail = '';
					$up = $_FILES['up']['name'];
					$up2 = $_FILES['up2']['name'];
					if ($up) {
						$config['upload_path'] = './uploads/' . $this->cont . '/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size'] = 200000;
						$config['max_width'] = 200000;
						$config['max_height'] = 200000;
						$config['file_name'] = (uniqid());
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('up')) {
							$data['uploads_error'] = ['error' => $this->upload->display_errors()];
						}
						$pic = $this->upload->data('file_name');
					}
					if ($up2) {
						$config['upload_path'] = './uploads/category/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size'] = 1000;
						$config['max_width'] = 500;
						$config['max_height'] = 500;
						$config['file_name'] = (uniqid());
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('up2')) {
							$data['uploads_error'] = ['error' => $this->upload->display_errors()];
						}
						$thumbnail = $this->upload->data('file_name');
					}
					$ret = $this->pages_model->add_pages(
						$title,
						$content,
						$news_date,
						$active,
						$pic,
						$thumbnail,
						$this->cont,
						'',
						'',
						[
							"icon" => $this->input->post('icon'),
							"description" => $this->input->post('description'),
							"keywords" => $this->input->post('keywords'),
							"parent_id" => $this->input->post('parent_id'),
							"price" => $this->input->post('price')
						]
					);
					$data['inserted'] = $ret;
				}
			}


			$data['admin_dir'] = base_url() . $this->adminDir . "";
			$data['page_title'] = "اضافة اقسام";
			$data['titles'] = $this->titles;
			$data['editor'] = true;
			$data['has'] = $this->has;
			
			$this->load->view($this->adminDir . '/templates/header', $data);
			$this->load->view($this->adminDir . '/' . $this->cont . '/add', $data);
			$this->load->view($this->adminDir . '/templates/footer', $data);
		} else {
			$this->core_model->check_permission();
		}
	}

	public function view()
	{
		if ($this->core_model->admin_can()) {
			$data['titles'] = $this->titles;
			$data['admin_dir'] = base_url() . $this->adminDir;
			$data['page_title'] = "عرض الاقسام";
			$this->load->view($this->adminDir . '/templates/header', $data);
			$this->load->view($this->adminDir . '/' . $this->cont . '/view', $data);
			$this->load->view($this->adminDir . '/templates/footer', $data);
		} else {
			$this->core_model->check_permission();
		}
	}

	public function del($id)
	{
		if ($this->core_model->admin_can()) {
			$data['admin_dir'] = base_url() . $this->adminDir;
			$data['page_title'] = "حذف";
			$data['cont'] = $this->cont;
			$this->load->view($this->adminDir . '/templates/header', $data);
			if (!$this->core_model->is_pages($id)) {
				$data['del'] = 0;
			} else {
				$data['del'] = 1;
				$this->load->model('admin/pages_model');
				$this->pages_model->del_pages($id);
			}
			$this->load->view($this->adminDir . '/' . $this->cont . '/del', $data);
			$this->load->view($this->adminDir . '/templates/footer', $data);
		} else {
			$this->core_model->check_permission();
		}
	}

	public function del_field($id)
	{
		if ($this->core_model->admin_can()) {
			$data['admin_dir'] = base_url() . $this->adminDir;
			$data['page_title'] = "حذف";
			$data['cont'] = $this->cont;
			$this->load->view($this->adminDir . '/templates/header', $data);
			
			$data['del'] = 1;
			$this->db->where(["ID" => $id])->delete('filed_input');
			
			$this->load->view($this->adminDir . '/' . $this->cont . '/del', $data);
			$this->load->view($this->adminDir . '/templates/footer', $data);
		} else {
			$this->core_model->check_permission();
		}
	}

	public function edit($slug)
	{
		if ($this->core_model->admin_can()) {
			if ($this->input->post('edit_news')) {
				$id = $this->input->post('id');
				$this->form_validation->set_rules(
					'title',
					'اسم القسم ',
					'required',
					['required' => '- لم تقم بكتابة %s.']
				);
				if ($this->form_validation->run() != false) {

					$this->load->model('admin/pages_model');
					
					$title = $this->input->post('title');
					$content = $this->input->post('content');
					$news_date = $this->input->post('news_date');
					$active = $this->input->post('active');
					$pic = $this->input->post('old');
					$thumbnail = $this->input->post('thumb');
					$up = $_FILES['up']['name'];
					$up2 = $_FILES['up2']['name'];
					if ($up) {
						$config['upload_path'] = './uploads/' . $this->cont . '/';
						$config['allowed_types'] = 'gif|jpg|png|jpeg';
						$config['max_size'] = 200000;
						$config['max_width'] = 200000;
						$config['max_height'] = 200000;
						$config['file_name'] = uniqid();
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('up')) {
							$data['uploads_error'] = ['error' => $this->upload->display_errors()];
						} else {
							$pic = $this->upload->data('file_name');
							@unlink("./uploads/'.$this->cont.'/" . $row['pic']);
						}
					}

					if ($up2) {
						$config['upload_path'] = './uploads/category/';
						$config['allowed_types'] = 'gif|jpg|png';
						$config['max_size'] = 1000;
						$config['max_width'] = 500;
						$config['max_height'] = 500;
						$config['file_name'] = (uniqid());
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('up2')) {
							$data['uploads_error'] = ['error' => $this->upload->display_errors()];
						}
						@unlink("./uploads/'.$this->cont.'/" . $row['thumbnail']);
						$thumbnail = $this->upload->data('file_name');
					}
					$this->pages_model->edit_pages(
						$title,
						$content,
						$news_date,
						$active,
						$pic,
						$thumbnail,
						$id,
						[
							"icon" => $this->input->post('icon'),
							"description" => $this->input->post('description'),
							"keywords" => $this->input->post('keywords'),
							"parent_id" => $this->input->post('parent_id'),
							"price" => $this->input->post('price')
							]
						);
					$data['updated'] = true;
				}
			}

			$data['titles'] = $this->titles;
			$data['edit'] = $slug;
			$data['row'] = $this->core_model->pages_data($slug);
			$data['has'] = $this->has;
			$data['admin_dir'] = base_url() . $this->adminDir;
			$data['page_title'] = "تعديل قسم \"" . $data['row']['title'] . "\"";
			$this->load->view($this->adminDir . '/templates/header', $data);
			$this->load->view($this->adminDir . '/' . $this->cont . '/add', $data);
			$this->load->view($this->adminDir . '/templates/footer', $data);
		} else {
			$this->core_model->check_permission();
		}
	}
}
