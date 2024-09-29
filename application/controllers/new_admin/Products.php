<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{

	var $titles;
	var $cont;
	var $has;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url', 'form'));
		$this->load->model(['core_model','admin/pages_model','admin/admin']);
		$this->load->library(array('session', 'form_validation'));
		$this->titles = array('إضافة منتج', 'عرض المنتجات');
		$this->cont = $this->router->fetch_class();
		$this->has = array('title', 'date', 'pic', 'active', 'content');
		if (!$this->session->userdata('user')) {
			redirect(base_url() . $this->core_model->admin_dir());
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
			$data['admin_dir'] = base_url() . $this->core_model->admin_dir();
			$data['page_title'] = " القائمة الرئيسية";
			$this->load->view($this->core_model->admin_dir() . '/templates/header', $data);
			$this->load->view($this->core_model->admin_dir() . '/' . $this->cont . '/save_order', $data);
			$this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
		} else {
			$this->core_model->check_permission();
		}
	}

	public function fields($catId)
	{
		if ($this->input->post('add_field')) {
			$this->form_validation->set_rules('title', 'اسم الحقل ', 'required', array('required' => '- لم تقم بكتابة %s.'));
			$this->form_validation->set_rules('input_type', 'نوع الحقل ', 'required', array('required' => '- لم تقم بكتابة %s.'));
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
				$data['inserted'] = $id;
			}
		}


		$data['admin_dir'] = base_url() . $this->core_model->admin_dir() . "";
		$data['cat'] = $this->core_model->pages_data($catId);
		$data['page_title'] = "اضافة اقسام";
		$data['titles'] = $this->titles;
		$data['editor'] = true;
		$data['has'] = $this->has;

		$this->load->view($this->core_model->admin_dir() . '/templates/header', $data);
		$this->load->view($this->core_model->admin_dir() . '/' . $this->cont . '/fields', $data);
		$this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
	}

	public function edit_field($id)
	{
		if ($this->input->post('edit_field')) {
			$this->form_validation->set_rules('title', 'اسم الحقل ', 'required', array('required' => '- لم تقم بكتابة %s.'));
			$this->form_validation->set_rules('input_type', 'نوع الحقل ', 'required', array('required' => '- لم تقم بكتابة %s.'));
			if ($this->form_validation->run() != false) {
				$this->db->where(array("ID" => $id))->update("filed_input", array(
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
				));
				$data['updated'] = $id;
			}
		}


		$data['admin_dir'] = base_url() . $this->core_model->admin_dir() . "";
		$data['row'] = $this->db->where(array("ID" => $id))->get("filed_input")->row_array();
		$data['cat'] = $this->core_model->pages_data($data['row']['parent_id']);
		$data['page_title'] = "اضافة اقسام";
		$data['titles'] = $this->titles;
		$data['editor'] = true;
		$data['has'] = $this->has;

		$this->load->view($this->core_model->admin_dir() . '/templates/header', $data);
		$this->load->view($this->core_model->admin_dir() . '/' . $this->cont . '/fields', $data);
		$this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
	}

	public function add()
	{
		if ($this->core_model->admin_can()) {
			if ($this->input->post('add_news')) {
				
				
				$error_array = array();
				if ($this->input->post('meta[parent_id]')) {
					foreach ($this->core_model->fieldList($this->input->post('meta[parent_id]')) as $field) {
						if ($field->input_required == 'Y') {
							if ($_POST['meta'][$field->input_id] == '') {
								$error_array[] = "<b>{$field->title}</b> مطلوب";
							}
						}
					}

					if (count($error_array)) {
						$data['error'] = $error_array;
					} else {
						$d = array('raw_name' => '', 'file_ext' => '');
						$meta = array();
						$up = $_FILES['pic']['name'];
						$config['upload_path']          = './uploads/products/';
						$config['allowed_types']        = 'gif|jpg|png';
						$config['max_size']             = 2000;
						$config['max_width']            = 2000;
						$config['max_height']           = 2000;
						if ($up) {
							$uploadedImage = $this->admin->uploadPic('pic');
							// var_dump($uploadedImage); die;
							if (!isset($uploadedImage['pic'])) {
								$uploadedImage = ["pic", "thumbnail"];
							}
						} else {
							$data['no_upload'] = 1;
						}
						$pics = array();

						for ($i = 1; $i <= 4; $i++) {
							if ($_FILES['pics_' . $i]['name']) {
								$pics_ar = $this->admin->uploadPic('pics_'.$i);
								$pic_ar[]=$pics_ar['pic'];
								$thumbnails[]=$pics_ar['thumbnail'];
							}
						}

						$this->db->insert("pages", array(
							"stock" => $this->input->post('stock'),
							"title" => $this->input->post('title'),
							"price" => ($this->input->post('meta[discount]') ?
								$this->input->post('meta[discount]') :
								$this->input->post('meta[price]')
							),
							"vedio_1" => $this->input->post('vedio_1'),
							"vedio_2" => $this->input->post('vedio_2'),
							"brand" => $this->input->post('brand'),
							"parent_id" => $this->input->post('cat'),
							"content" => $this->input->post('content'),
							"full_content" => $this->input->post('full_content'),
							"international_shipping" => $this->input->post('international_shipping'),
							"module" => 'products',
							"country" => $this->input->post('meta[country]'),
							"delivery" => $this->input->post('delivery'),
							"meta" => json_encode($meta),
							"availble" => $this->input->post('availble'),
							"pic" => $uploadedImage['pic'],
							"thumbnail" => $uploadedImage['thumbnail'],
							"active" => $this->input->post('active'),
							"code" => $this->input->post('code'),
							"cat_chain" => $this->input->post('cat_chain'),
							"SKU" => $this->input->post('SKU'),
							"availble" => $this->input->post('availble'),
							"star" => $this->input->post('star'),
							"shipping_size" => $this->input->post('shipping_size'),
							"rate" => $this->input->post('rate'),

						));

						$id = $this->db->insert_id();
						if( isset($ds) && is_array($ds) && count( $ds ) ) {
							for ($i = 0; $i < count($ds); $i++) {
								$this->db->insert("pages", array(
									"title" => "pic_{$i}",
									"parent_id" => $id,
									"module" => 'products_pic',
									"pic" => $pic_ar[$i],
									"thumbnail" => $thumbnails[$i],
									"p_order" => $i + 1,
									"active" => $this->input->post('active')
								));
							}
						}
						if (!empty($this->input->post('meta')) && is_array($this->input->post('meta'))) {
							foreach ($this->input->post('meta') as $meta_id => $meta_value) {
								if (is_array($meta_value)) {
									$meta_value = json_encode($meta_value);
								}
								$this->db->insert("product", array(
									"input_id" => $meta_id,
									"value" => $meta_value,
									"product_id" => $id,
									"cat_id" => $this->input->post('cat')
								));
							}
						}
						$data['id'] = $id;
					}
				} else {
					$error_array[] = "برجاء تحديد قسم <br />";
					$data['error'] = $error_array;
				}
			}


			$data['admin_dir'] = base_url() . $this->core_model->admin_dir() . "";
			$data['page_title'] = "اضافة منتجات";
			$data['titles'] = $this->titles;
			$data['editor'] = true;
			$data['has'] = $this->has;
			//$data['coins'] = $this->core_model->getActiveCurrencyToUSD();

			$this->load->view($this->core_model->admin_dir() . '/templates/header', $data);
			$this->load->view($this->core_model->admin_dir() . '/' . $this->cont . '/add', $data);
			$this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
		} else {
			$this->core_model->check_permission();
		}
	}

	public function star()
	{
		if ($this->core_model->admin_can()) {
			$data['titles'] = $this->titles;
			$data['admin_dir'] = base_url() . $this->core_model->admin_dir();
			$data['page_title'] = "العروض الخاصة";
			$this->load->view($this->core_model->admin_dir() . '/templates/header', $data);
			$this->load->view($this->core_model->admin_dir() . '/' . $this->cont . '/view2', $data);
			$this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
		} else {
			$this->core_model->check_permission();
		}
	}
	public function view()
	{
		if ($this->core_model->admin_can()) {
			$data['titles'] = $this->titles;
			$data['admin_dir'] = base_url() . $this->core_model->admin_dir();
			$data['page_title'] = "عرض المنتجات";
			$this->load->view($this->core_model->admin_dir() . '/templates/header', $data);
			$this->load->view($this->core_model->admin_dir() . '/' . $this->cont . '/view', $data);
			$this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
		} else {
			$this->core_model->check_permission();
		}
	}

	public function del($id)
	{
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
				$this->db->where(array("product_id" => $id))->delete("product");
			}
			$this->load->view($this->core_model->admin_dir() . '/' . $this->cont . '/del', $data);
			$this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
		} else {
			$this->core_model->check_permission();
		}
	}

	public function del_field($id)
	{
		if ($this->core_model->admin_can()) {
			$data['admin_dir'] = base_url() . $this->core_model->admin_dir();
			$data['page_title'] = "حذف";
			$data['cont'] = $this->cont;
			$this->load->view($this->core_model->admin_dir() . '/templates/header', $data);
			/* if(! $this->core_model->is_pages($id) )
			  {
			  $data['del']=0;
			  }else
			  { */
			$data['del'] = 1;
			$this->db->where(array("ID" => $id))->delete('filed_input');
			//}
			$this->load->view($this->core_model->admin_dir() . '/' . $this->cont . '/del', $data);
			$this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
		} else {
			$this->core_model->check_permission();
		}
	}

	public function edit($slug)
	{
		
		if ($this->core_model->admin_can()) {
			if ($this->input->post('edit_news')) {
				$row = $this->core_model->product_data($slug);
				$error_array = array();
				if ($this->input->post('meta[parent_id]')) {
					foreach ($this->core_model->fieldList(
						$this->input->post('meta[parent_id]')
					) as $field) {
						if ($field->input_required == 'Y') {
							if ($_POST['meta'][$field->input_id] == '') {
								$error_array[] = "<b>{$field->title}</b> مطلوب";
							}
						}
					}
					if (count($error_array)) {
						$data['error'] = $error_array;
					} else {
						$id = $this->input->post('id');
						$d = array('raw_name' => '', 'file_ext' => '');
						$meta = array();
						$up = $_FILES['pic']['name'];
						$config['upload_path']          = 'uploads/products/';
						$config['allowed_types']        = 'gif|jpg|png';
						$config['max_size']             = 2000;
						$config['max_width']            = 2000;
						$config['max_height']           = 2000;
						if ($up) {
							$uploadedImage = $this->admin->uploadPic('pic', [
								$this->input->post('old_pic'),
								$this->input->post('old_thumb')
							]);
							// var_dump($uploadedImage); die;
							if (!isset($uploadedImage['pic'])) {
								$uploadedImage = [
									"pic"=>$this->input->post('old_pic'),
									"thumbnail"=>$this->input->post('old_thumb')
								];
							}
						} else {
							$uploadedImage = [
								"pic"=>$this->input->post('old_pic'),
								"thumbnail"=>$this->input->post('old_thumb')
							];
						}
						

						for ($i = 1; $i <= 4; $i++) {
							if ($_FILES['pics_' . $i]['name']) {
								$pics_ar = $this->admin->uploadPic('pics_'.$i);
								$pic_ar=$pics_ar['pic'];
								$thmb_ar=$pics_ar['thumbnail'];
									$pic1 = $this->db->
										where("`module`='products_pic' and `title`='pic_{$i}'")->
										get('pages')->
										row();
									@unlink("uploads/products/" . $pic1->pic);
									@unlink("uploads/products/" . $pic1->thumbnail);
									if ($this->db->
										where("`module`='products_pic' and `title`='pic_{$i}'")->
										get("pages")->
										num_rows()
									) {
										$this->db->
										where("`module`='products_pic' and `title`='pic_{$i}'")->
										delete('pages')->
										row();
									}
									$this->db->insert("pages", array(
										"title" => "pic_{$i}",
										"parent_id" => $id,
										"module" => 'products_pic',
										"pic" => $pic_ar,
										"thumbnail" => $thmb_ar,
										"p_order" => $i,
										"active" => $this->input->post('active')
									));
								
							}
						}

						$this->db->where(array("ID" => $id))->update("pages", array(
							"title" => $this->input->post('title'),
							"brand" => $this->input->post('brand'),
							"vedio_1" => $this->input->post('vedio_1'),
							"vedio_2" => $this->input->post('vedio_2'),
							"price" => ($this->input->post('meta[discount]') ?
								$this->input->post('meta[discount]') :
								$this->input->post('meta[price]')
							),
							"content" => $this->input->post('content'),
							"full_content" => $this->input->post('full_content'),
							"parent_id" => $this->input->post('cat'),
							"international_shipping" => $this->input->post('international_shipping'),
							"delivery" => $this->input->post('delivery'),
							"module" => 'products',
							"meta" => json_encode($meta),
							"pic" => $uploadedImage['pic'],
							"thumbnail" => $uploadedImage['thumbnail'],
							"active" => $this->input->post('active'),
							"code" => $this->input->post('code'),
							"cat_chain" => $this->input->post('cat_chain'),
							"SKU" => $this->input->post('SKU'),
							"availble" => $this->input->post('availble'),
							"star" => $this->input->post('star'),
							"stock" => $this->input->post('stock'),
							"shipping_size" => $this->input->post('shipping_size'),
							"rate" => $this->input->post('rate'),

						));

						if (isset($ds) && is_array($ds)) {
							for ($i = 0; $i < count($ds); $i++) {
								$this->db->insert("pages", array(
									"title" => "pic_{$i}",
									"parent_id" => $id,
									"module" => 'products_pic',
									"country" => $this->input->post('meta[country]'),
									"meta" => json_encode($metas[$i]),
									"pic" => $ds[$i]['raw_name'] . $ds[$i]['file_ext'],
									"thumbnail" => $thumbnails[$i],
									"p_order" => $i + 1,
									"active" => $this->input->post('active')
								));
							}
						}

						$this->db->where(array("product_id" => $id))->delete("product");
						if (!empty($this->input->post('meta')) && is_array($this->input->post('meta'))) {
							foreach ($this->input->post('meta') as $meta_id => $meta_value) {
								if (is_array($meta_value))
									$meta_value = json_encode($meta_value);
								$this->db->insert("product", array(
									"input_id" => $meta_id,
									"value" => $meta_value,
									"product_id" => $id,
									"cat_id" => $this->input->post('cat')
								));
							}
						}
						$data['updated'] = $id;
					}
				} else {
					$error_array[] = "برجاء تحديد قسم <br />";
					$data['error'] = $error_array;
				}
			}

			$data['titles'] = $this->titles;
			$data['edit'] = $slug;
			$row = $this->core_model->product_data($slug);
			// var_dump($row); die;
			$data['row'] = $row;
			$data['has'] = $this->has;
			$data['admin_dir'] = base_url() . $this->core_model->admin_dir();
			$data['page_title'] = "تعديل قسم \"" . $data['row']['title'] . "\"";
			$this->load->view($this->core_model->admin_dir() . '/templates/header', $data);
			$this->load->view($this->core_model->admin_dir() . '/' . $this->cont . '/add', $data);
			$this->load->view($this->core_model->admin_dir() . '/templates/footer', $data);
		} else {
			$this->core_model->check_permission();
		}
	}
}
