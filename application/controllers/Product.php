<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
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

	public function single($catId, $productId)
	{
		$data = array();
		if ($_POST['mk_comment']) {
			if (isset($_SESSION['i'])) {
				$user = $this->db->where("ID='{$_SESSION['i']}'")->get("user")->row();
				$name = $user->username;
				$email = $user->email;
			} else {
				$name = $this->input->post('username');
				$email = $this->input->post('email');
			}
			$comment = $this->input->post('comment');
			$parent_id = ($this->input->post('parent_id') == $productId) ? $this->input->post('parent_id') : $productId;
			$active = ($_SESSION['i']) ? 'Y' : 'N';
			$this->db->insert("pages", array(
				"meta" => serialize(array("name" => $name, "email" => $email)),
				"content" => strip_tags($comment), "module" => 'comment', "parent_id" => $productId, "active" => $active
			));
			$data['mk_comment'] = 1;
		}
		$single = $this->core_model->product_data($productId);
		$data['cat'] = $this->db->where("ID='".$single['parent_id']."'")->get("pages")->row_array();
		// echo "<!-- zzzzz ";var_dump($single); echo " -->";
		if ($_SESSION['i']) {
			$this->db->insert("last", array("uid" => $_SESSION['i'], "item_id" => $productId));
		}
		$this->db->where("ID='{$productId}'")->update("pages", array("view" => $single['view'] + 1));
		$data['single'] = $single;
		$data['url'] = base_url("{$single['parent_id']}/{$single['ID']}.html");
		$data['page_title'] = $single['title'];
		$data['next_prev']= [
			"next"=>$this->shop->getNextProduct($productId),
			"prev"=>$this->shop->getPrevProduct($productId),
		];
		$data['similar']=$this->shop->getSimilarProducts($single['title'],$productId);
		
		
		$data['lightbox'] = true;

		$data['share_img']= $this->shop->shop_img(
			"uploads/products/{$single['pic']}",
			"assets/share.jpg"
		);

		$this->load->view('templates/header', $data);
		$this->load->view('product/single', $data);
		$this->load->view('templates/footer', $data);
	}
}
