<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    var $hash = 'R41T0H45H';
    var $hash_repeat = 2;

    public function __construct() {
	parent::__construct();
	$this->load->helper('url');
	$this->load->helper('form');
	$this->load->database();
	$this->load->model(array('core_model', 'Hijri'));
	$this->load->library(array( 'session'));
    }

    public function index() {
	$data = array();
	$data['row']= $this->db->where("`ID`='{$_SESSION['i']}' and `salt`='{$_SESSION['s']}'")->get("user")->row_array();
	//var_dump($_SESSION);
	$this->load->view('templates/header', $data);
	$this->load->view('setting/setting', $data);
	$this->load->view('templates/footer', $data);
    }
    
    
    public function user_data()
    {
	$row= $this->db->where("`ID`='{$_SESSION['i']}' and `salt`='{$_SESSION['s']}'")->get("user")->row_array();
	$salt= $row['salt'];
	$hash= $this->hash;
	$repeat=$this->hash_repeat;
	$pwd='';
	for($i=0; $i<=$repeat; $i++)
	{
	    $pwd .= $this->hash ;
	}
	$pwdFinal=sha1($salt.md5($pwd).sha1($this->input->post('current_password'))) ;
	if( $pwdFinal != $row['pwd'] ):
	    $this->session->set_flashdata("worng_password",1);
	else:
	    $up= $_FILES['up']['name'];
	    if($up):
		$config['upload_path']          = './uploads/user/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 2000;
		$config['max_width']            = 2000;
		$config['max_height']           = 2000;
		$config['file_name']			= (uniqid());
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('up')):
		    $data['uploads_error'] = array('error' => $this->upload->display_errors());
		    $this->session->set_flashdata("worng_file",1);
		    redirect(base_url()."setting");
		else:
		
		    $pic=$this->upload->data('file_name');
		    $config['image_library'] = 'gd2';
		    $config['source_image'] = $this->upload->data('full_path');
		    $config['create_thumb'] = TRUE;
		    $config['maintain_ratio'] = TRUE;
		    $config['width']         = 250;
		    $config['height']       = 250;
		    $this->load->library('image_lib', $config);
		    $this->image_lib->resize();
		    $d=$this->upload->data();
		    $thumbnail = $d['raw_name'].'_thumb'.$d['file_ext'];
		endif;
	    else:
		$pic= $row['pic']; 
	    endif;
	    $this->db->where("`ID`='{$_SESSION['i']}' and `salt`='{$_SESSION['s']}'")->update("user", array(
		"username"=>$this->input->post("username"),
		"tel"=>$this->input->post("tel"),
		"address"=>$this->input->post("address"),
		"pic"=>$pic,
	    ));
	    $this->session->set_flashdata("success",1);
	endif;
	redirect(base_url()."setting");
	
    }
    
    
    public function change_password()
    {
	$row= $this->db->where("`ID`='{$_SESSION['i']}' and `salt`='{$_SESSION['s']}'")->get("user")->row_array();
	$salt= $row['salt'];
	$hash= $this->hash;
	$repeat=$this->hash_repeat;
	$pwd='';
	for($i=0; $i<=$repeat; $i++)
	{
	    $pwd .= $this->hash ;
	}
	$pwdFinal=sha1($salt.md5($pwd).sha1($this->input->post('current_password'))) ;
	if( $pwdFinal != $row['pwd'] ):
	    $this->session->set_flashdata("worng_password2",1);
	else:
	    if( $this->input->post('pwd1') ==  $this->input->post('pwd2')):
		$newPassword=sha1($salt.md5($pwd).sha1($this->input->post('pwd1'))) ;
		$this->db->where("`ID`='{$_SESSION['i']}' and `salt`='{$_SESSION['s']}'")->update("user", array(
		    "pwd"=>$newPassword
		));
		$this->session->set_flashdata("success2",1);
	    else:
		$this->session->set_flashdata("umatch_password",1);
	    endif;
	endif;
	redirect(base_url()."setting");
	
    }

}

