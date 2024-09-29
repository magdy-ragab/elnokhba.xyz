<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SellerData extends CI_Controller {
    var $hash= 'R41T0H45H';
    var $hash_repeat= 2;
    public function __construct() {
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->helper('form');
	    $this->load->database();
	    $this->load->model(array('core_model', 'Hijri'));
	    $this->load->library('session');
    }
	
    public function index() {
	$data= array();
	$this->load->view('templates/header',$data);
	if(isset($_SESSION['i']))
	{
	    $data['user']= $this->shop->userData( $_SESSION['i'] );
	    if( isset($_POST['saveUserData']) )
	    {
		$pic = $data['user']->pic;
                $up = $_FILES['pic']['name'];
                if ($up) {
                    $config['upload_path'] = './uploads/user/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = 100000;
                    $config['max_width'] = 20000;
                    $config['max_height'] = 20000;
                    $config['file_name'] = (uniqid());
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('pic')) {
                        $data['uploads_error'] = array('error' => $this->upload->display_errors());
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
                        $pic = $d['raw_name'] . '_thumb' . $d['file_ext'];
                    }
                }
		$this->db->where("ID='{$_SESSION['i']}'")->update("user" , 
		array(
		    "fname" => $this->input->post('fname') , 
		    "lname" => $this->input->post('lname') , 
		    "pic"   => $pic , 
		    "address"=> $this->input->post('address') ,
		    "country"=> $this->input->post('country') ,
		    "tel"   => $this->input->post('tel') ,
		    "about" => $this->input->post('about')
		)
		);
		$data["updated"]=1;
	    }
	    $data['user']= $this->shop->userData( $_SESSION['i'] );
	    $this->load->view('user_pages/sellerData', $data);
	}
	$this->load->view('templates/footer', $data);
    }

}

