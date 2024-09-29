<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct() {
	parent::__construct();
	$this->load->helper('url');
	$this->load->database();
	$this->load->model('core_model');
	$this->load->library(array('session'));
	if (!$this->session->userdata('user')) {
	    redirect(base_url() . $this->core_model->admin_dir());
	}
    }

    public function getFields($catid, $product_id = 0) {
	//check if chacked
	/* $cat= $this->core_model->pages_data($catid);
	  if($cat['meta']):
	  echo $cat['meta'];
	  else: */
	$fields = $this->core_model->fieldList($catid);
	$ar = array();
	if (is_array($fields)) {
	    foreach ($fields as $field) {
		$ar[] = $this->core_model->gentrateFieldTag($field, $product_id);
	    }
	    $ar[] = '<script>$.validate({modules : \'date\'});</script>';
	    echo implode("", $ar);
	    /* $ar[]= "<!-- generate time (". date('Y-m-d H:i:s') .")-->";
	      $this->db->where(array("ID"=>$catid))->update("pages",array("meta"=> implode("", $ar) )); */
	} else {
	    echo '';
	}
	/* endif; */
    }

    public function adminJson() {
	$user = $this->core_model->admin_data_by_hash($this->session->user);
	if ($user->ID) {
	    $this->ajaxHeaders();
	    $ar = array("admin" => $this->session->user);
	    $num = 0;
	    if ($this->core_model->admin_can('contacts')) {
		$q = $this->db->where("`dateline` > ", $user->last_active)->get("contact")->num_rows();
		$contact_count = $this->db->where("`readed` = 'N' ")->get("contact")->num_rows();
		$ar['alert']['contacts'] = array("num" => $q, "title" => 'رسائل اتصل بنا', "url" => base_url() . $this->core_model->admin_dir() . "/contacts");
		$num += $q;
	    }
	    $ar['notifications_count'] = $num;
	    $ar['contact_count'] = $contact_count;
	    $ar['time'] = $user->last_active;
	    $this->db->set('last_active', 'NOW()', FALSE);
	    $this->db->where(array("hash" => $this->session->user))->update("admin", $data);

	    echo json_encode($ar);
	} else {
	    session_destroy();
	    delete_cookie("user");
	    echo '{"admin":0}';
	}
    }

    public function order_status() {
	$user = $this->core_model->admin_data_by_hash($this->session->user);
	if ($user->ID) {
	    $this->ajaxHeaders();
	    $v= $this->input->post('v');
	    $id=$this->input->post('id');
	    $this->db->where("id='{$id}'")->update("cart_items", array("order_status"=>$v));
	    $row=$this->db->where("ID='{$id}'")->get("cart_items")->row();
	    $balance= $row->count * ( ($row->discount)?$row->discount:$row->price ) ;
	    if( $v== 'sent' ):
		$this->db->insert("balance", array(
		    "uid"=>$row->buyer,
		    "balance"=>$balance,
		    "product_id"=>$row->product_item,
		    "product_title"=>$row->product_title,
		    "price"=>$row->price,
		    "discount"=>$row->discount,
		    "count"=>$row->count,
		    "cart_id"=>$row->ID,
		    "withdraw"=>'N',
		    "note"=> "الربح من بيع الطلب رقم  : ({$row->ID})"
		));
		$rows= $this->db->where("uid='{$row->buyer}'")->get("balance_history")->num_rows();
		if( $rows > 0 ):
		    $this->db->query("update `_d_balance_history` set `balance`=`balance`+{$balance} where `uid`='{$row->buyer}'");
		else:
		    $this->db->query("insert into `_d_balance_history` set `balance`=`balance`+{$balance} , `uid`='{$row->buyer}'");
		endif;
	    else:
		$rows= $this->db->where(array(
		    "uid"=>$row->buyer,
		    "product_id"=>$row->product_item,
		    "cart_id"=>$row->ID
		))->get("balance")->num_rows();
		//echo "{$rows}\r\n";
		if($rows > 0) :
		    $this->db->where(array(
			"uid"=>$row->buyer,
			"product_id"=>$row->product_item,
			"cart_id"=>$row->ID
		     ))->delete("balance");
		    $this->db->query("update `_d_balance_history` set `balance`=`balance`-{$balance} where `uid`='{$row->buyer}'");
		endif;
	    endif;
	    echo 1;
	} else {
	    session_destroy();
	    delete_cookie("user");
	    echo '{"admin":0}';
	}
    }

    public function moduleChooser($module) {
	$this->ajaxHeaders();
	$user = $this->core_model->admin_data_by_hash($this->session->user);
	if ($user->ID) {
	    if ($module == 'outside') {
		echo '{"url":"", "has_subs": "N", "title":"","index":"N"}';
	    } else {
		$row = $this->db->get_where("modules", array("menuable" => 'Y', "module" => $module))->row();
		if ($row->sub_pages == 'N') {
		    echo '{"url":"**' . $row->module . '", "has_subs": "N", "title":"' . $row->title . '","index":"N"}';
		} else {
		    $ar = array("has_subs" => "Y");
		    if ($row->menu_index == 'Y') {
			$ar['index'] = array("index" => "Y", "url" => "**{$row->module}", "title" => "رئيسية {$row->title}");
		    } else {
			$ar['index'] = "N";
		    }
		    foreach ($this->core_model->pages(array("module" => $module, "active" => "Y")) as $row) {
			$ar['subs'][] = array("url" => "**{$module}/{$row->ID}", "title" => $row->title);
		    }
		    echo json_encode($ar);
		}
	    }
	}
    }

    public function fillTables_gallery($module) {
	$this->ajaxHeaders();
	list($module, $order, $limit, $o) = explode("-", $module);
	echo json_encode($this->core_model->gallery_mini(array("module" => $module), $limit, 0, $order, $o));
    }

    public function fillTables($module) {
	$this->ajaxHeaders();
	list($module, $order, $limit, $o) = explode("-", $module);
	if ($module == 'gallery') {
	    echo json_encode($this->core_model->gallery_mini(array("module" => $module), $limit, 0, $order, $o));
	} else {
	    echo json_encode($this->core_model->pages_mini(array("module" => $module), $limit, 0, $order, $o));
	}
    }

    private function ajaxHeaders() {
	header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
    }

}
