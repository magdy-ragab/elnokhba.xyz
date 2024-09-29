<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->database();
		$this->load->model(array('core_model', 'Hijri'));
		$this->load->library(array('pagination', 'session'));
		$this->limit = 9 ;
	}

	public function index()
	{
		$data['home_cats'] = $this->shop->getHomeCats();
		$this->load->view('templates/header', $data);
		$this->load->view('category/cat-home', $data);
		$this->load->view('templates/footer', $data);
	}


	public function catList(int $catid, $orderByField = 'ID', $order = 'desc', $start = 0)
	{
		$this->limit = $this->core_model->get_settings("product_limit");
		
		$data['random'] = $this->shop->getProductList([],5, "RAND()");
		// var_dump($data['random']); die;
		$data['display_method'] = $this->core_model->get_settings("display_method");
		$data['row'] = $this->db->select("ID,title,pic")->where(["ID" => $catid])->get('pages')->row();
		$data['cats'] = $this->db->select("ID,title")->where(["parent_id" => 0, "module" => 'category'])->get('pages')->result();
		
		$result= $this->getRows($catid, $orderByField , $order , $start );

		$data['catid'] = $catid;
		$data['rows'] = $result['rows'];
		$this->db->where(["cat_id" => $catid]);
		$this->db->where(["input_id" => 'price']);
		$this->db->or_where(["input_id" => 'discount']);
		$data['min_max'] = $this->db->select("MIN(`value`) min_price, MAX(`value`) max_price")->get("product")->row();

		if ( $this->input->get('min_max') ) {
			$data['min_max_value']= $this->input->get('min_max');
		}else{
			if( isset($data['min_max']->max_price) ) {
				$data['min_max_value'] = $data['min_max']->max_price ;
			}else{
				$data['min_max_value']= $this->input->get('min_max');
			}
		}

		$data['select'] = "{$orderByField}/{$order}";
		$data['total'] = $result['total'];
		$data['limit'] = $this->limit;
		$data['currentpage'] = ceil((1 + $start) / $this->limit);
		$config['base_url'] = base_url("category/catList/{$catid}/{$orderByField}/{$order}");
		$config['total_rows'] = $data['total'];
		$config['full_tag_open'] = '<ul class="pagination pagination-small pagination-centered">';
		$config['full_tag_close'] = '</ul>';
		$config['per_page'] = $this->limit;
		$config['num_links'] = 5;
		$config['page_query_string'] = false;
		$config['prev_link'] = '&lt; السابق';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'التالي &gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
		$this->pagination->initialize($config);

		$data['page_title'] = $data['row']->title;

		$this->load->view('templates/header', $data);
		$this->load->view('category/category', $data);
		$this->load->view('templates/footer', $data);
	}

	private function getRows(int $catid, $orderByField = 'ID', $order = 'desc', $start = 0)
	{
		if ( $this->input->get('filter') && $this->input->get('filter') == 1 ) {
			if ( $this->input->get('min_max') ) {
				$price = (int) $this->input->get('min_max') ;
			}
			if ( $this->input->get('filter_star') ) {
				$star = 1;
			}
			$where= ["module" =>
				'products',
				"active" => 'Y',
				"parent_id" => $catid
				] ;
			if ( isset($star) && $star ==1  ) {
				$where['star'] =1 ;
			}
			if ( isset($price)  ) {
				$this->db->where( 'price <= ' , $price, TRUE);
			}
			$rows =  $this->db->order_by($orderByField, $order)->
				limit($this->limit, $start)->
				where($where)->
				get("pages")->
				result();
			if ( isset($price)  ) {
				$this->db->where( 'price <= ' , $price, TRUE);
			}
			$total = $this->db->order_by($orderByField, $order)->
				where($where)->
				get("pages")->
				num_rows();
			return ["rows"=>$rows, "total"=>$total];
		}else{
			$rows =  $this->db->order_by($orderByField, $order)->
				limit($this->limit, $start)->
				where(["module" => 	'products', "active" => 'Y', "parent_id" => $catid])->
				get("pages")->
				result();
			$total = $this->db->order_by($orderByField, $order)->
				where(["module" => 'products', "active" => 'Y',"parent_id" => $catid])->
				get("pages")->
				num_rows();
		}
		return ["rows"=>$rows, "total"=>$total];
	}
}
