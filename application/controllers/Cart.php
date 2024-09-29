<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
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
		if ($_POST['updateCartCounts']) {
			foreach ($_POST['productCount'] as $k => $v) {
				$_SESSION['cart'][$k]['count'] = $v;
			}
			redirect(base_url() . 'cart');
		}
		$this->load->view('templates/header', $data);
		$this->load->view('cart/cart', $data);
		$this->load->view('templates/footer', $data);
	}

	function shipment()
	{
		$data = array();
		$data['flash'] = $this->session->flashdata('code_Result');
		$this->load->view('templates/header', $data);
		$this->load->view('shipment/shipment', $data);
		$this->load->view('templates/footer', $data);
	}

	function saveShipmentData()
	{
		//print_r($_POST);
		$data = array();
		$price = 0;
		$discount = 0;
		if ($this->input->post('save_data')) {
			$data['post'] = $this->input->post();
		} else if ($this->input->post('acceptShipmenyData')) {
			$shpment = sha1(uniqid("Raitotec_"));
			//print_r($_SESSION['cart']); die;
			foreach ($_SESSION['cart'] as $k => $v) {
				$row = $this->db->where("`ID`='{$k}'")->get('pages')->row();
				if ($row->discount) {
					$price += ($row->discount * $v['count']);
					$discount += ($row->discount);
				} else {
					$price += ($row->price * $v['count']);
				}
				$this->db->set("stock", "stock - {$v['count']}", FALSE) ;
				$this->db->where("ID='{$k}'")->update("pages");
			}
			$id = $this->db->insert("cart_cache", array(
				"uid" => $_SESSION['i'],
				"cart_id" => $shpment,
				"price" => $price,
				"qty" => $v['count'],
				"discount" => $discount,
				"fname" => $this->input->post('fname'),
				"paymethod" => $this->input->post('paymethod'),
				"lname" => $this->input->post('lname'),
				"email" => $this->input->post('email'),
				"city" => $this->input->post('city'),
				"notes" => $this->input->post('notes'),
				"address" => $this->input->post('address'),
				"phone" => $this->input->post('phone'),
				"shipping_price"=> $this->shop->getShippingPrices()
			));
			foreach ($_SESSION['cart'] as $k => $v) {
				$row = $this->core_model->product_data($k);
				//echo "<pre dir=ltr align=left>";var_dump($row); echo "</pre> ";
				if ($row->discount) {
					$price = $row->discount;
				} else {
					$price = $row->price;
				}
				$this->db->insert("cart_items", array(
					"cart_id" => $shpment,
					"product_item" => $row['ID'],
					"product_title" => $row['title'],
					"price" => $row['price'],
					"discount" => $row['discount'],
					"count" => $v['count'],
					"total" => (($v['count'] * $price) + $this->shop->getShippingPrices()),
					"uid" => $_SESSION['i'],
					"buyer" => $row['uid'],
					"shipping_price"=>  $this->shop->getShippingPrices()
				));
			}
			$data['shipmentID'] = $shpment;
			$_SESSION['shipmentID'] = $shpment;
		}
		$data['userData'] = $this->shop->getUserData($_SESSION['i']);
		$this->load->view('templates/header', $data);
		$this->load->view('shipment/shipmentCheck', $data);
		$this->load->view('templates/footer', $data);
	}

	function checkOut()
	{
		$data = array();
		$data['user_data'] = $this->shop->getUserData($_SESSION['i']);
		$data['cart_cache_data'] = $this->shop->getCartCasheData($_SESSION['shipmentID']);
		$data['post'] = (array) $data['cart_cache_data'];
		$data['rate'] = $this->core_model->egp2usd();
		$this->load->view('templates/header', $data);
		$this->load->view('cart/checkOut', $data);
		$this->load->view('templates/footer', $data);
	}

	function applyCode()
	{
		if ($_POST['applyDiscountCode']) {
			$code = $this->input->post('code');
			$row = $this->db->where(array("content" => $code, "module" => 'discountcode'))->get('pages')->row();
			if (!$row->ID) {
				$this->session->set_flashdata('code_Result', 'NotCode');
			} else if ($row->active == 'N') {
				$this->session->set_flashdata('code_Result', 'unActive');
			} else {
				$this->session->set_flashdata('code_Result', 'apply');
				$_SESSION['cart']['code'] = array("title" => $row->title, "discount" => $row->meta, "code" => $row->content);
			}
			redirect('cart/shipment');
		}
	}
}
