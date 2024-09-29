<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
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
	$this->load->view('profile/myorders', $data);
	$this->load->view('templates/footer', $data);
    }

    function myorders()
    {
	$data= array();
	$this->load->view('templates/header',$data);
	$this->load->view('profile/myorders', $data);
	$this->load->view('templates/footer', $data);
    }
    
    function addProduct()
    {
	$data= array();
	if ($this->input->post('add_news')) {
	print_r($_POST);
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
		    $d= array('raw_name'=>'','file_ext'=>'');
		    $meta=array();
		    $up= $_FILES['pic']['name'];
		    $config['upload_path']          = './uploads/products/';
		    $config['allowed_types']        = 'gif|jpg|png';
		    $config['max_size']             = 2000;
		    $config['max_width']            = 2000;
		    $config['max_height']           = 2000;
		    if($up)
		    {
			$info= getimagesize($_FILES['pic']['tmp_name']);
			$config['file_name']			= (uniqid());
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('pic'))
			{
			    $data['uploads_error'] = array('error' => $this->upload->display_errors());
			}
			else
			{
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
			    $meta= array("w"=>$info[0], "h"=>$info[1], "type"=>$info['mime']);
			}
		    }else{
			    $data['no_upload']=1;
		    }
		    $pics= array();

		    for($i=1; $i<=4; $i++)
		    {
			if($_FILES['pics_'.$i]['name'])
			{
			    $info= getimagesize($_FILES['pics_'.$i]['tmp_name']);
			    $config['file_name']= (uniqid());
			    if ( ! $this->upload->do_upload('pics_'.$i))
			    {
				$data['uploads_error'] = array('error' => $this->upload->display_errors());
			    }else
			    {
				$pic=$this->upload->data('file_name');
				$config['image_library'] = 'gd2';
				$config['source_image'] = $this->upload->data('full_path');
				$config['create_thumb'] = TRUE;
				$config['maintain_ratio'] = TRUE;
				$config['width']         = 250;
				$config['height']       = 250;
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$d1=$ds[]=$this->upload->data();
				$thumbnails[] = $d1['raw_name'].'_thumb'.$d1['file_ext'];
				$metas[]= array("w"=>$info[0], "h"=>$info[1], "type"=>$info['mime']);

			    }
			}
		    }

		    $this->db->insert("pages", array(
			"title" => $this->input->post('title'),
			"brand" => $this->input->post('brand'),
			"parent_id" => $this->input->post('cat'),
			"content" => $this->input->post('content'),
			"international_shipping" => $this->input->post('international_shipping'),
			"module" => 'products',
			"country" => $this->input->post('meta[country]'),
			"delivery" => $this->input->post('delivery'),
			"meta" => json_encode($meta) ,
			"availble" => $this->input->post('availble'),
			"pic" => $d['raw_name'].$d['file_ext'],
			"thumbnail" => $d['raw_name'].'_thumb'.$d['file_ext'],
			"active" => $this->input->post('active'),
			"uid"=>$_SESSION['i']
		    ));

		    $id = $this->db->insert_id();
		    for( $i=0; $i<count( $ds ) ; $i++ )
		    {
			$this->db->insert("pages", array(
			    "title" => "pic_{$i}",
			    "parent_id" => $id,
			    "module" => 'products_pic',
			    "country" => $this->input->post('meta[country]'),
			    "meta" => json_encode($metas[$i]) ,
			    "pic" => $ds[$i]['raw_name'].$ds[$i]['file_ext'],
			    "thumbnail" => $thumbnails[$i],
			    "p_order"=> $i+1,
			    "active" => $this->input->post('active')
			));
		    }
		    if (!empty($this->input->post('meta')) && is_array($this->input->post('meta'))) {
			foreach ($this->input->post('meta') as $meta_id => $meta_value) {
			    if (is_array($meta_value)) {
				$meta_value = json_encode($meta_value);
			    }
			    $this->db->insert("product", array(
				"input_id" => $meta_id,
				"value" => $meta_value,
				"product_id" => $id
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
	$data['rows']= $this->db->order_by("ID","desc")->where(array("module"=>'products',"uid"=>$_SESSION['i']))->get("pages")->result() ;
	$this->load->view('templates/header',$data);
	$this->load->view('profile/addproduct', $data);
	$this->load->view('templates/footer', $data);
    }
    
    function sellback($id)
    {
	$data= array();
	$row= $this->db->where("ID='{$id}'")->get("cart_items")->row();
	if( $row->uid== $_SESSION['i'] )
	{
	    if($_POST['back_new'])
	    {
		$this->db->where("ID={$id}")->update("cart_items", array("back_requested"=>"Y", "user_experience"=>$this->input->post('reason','xss_clean')));
		$data['back']=1;
	    }
	    
	    $data['prod']=$this->core_model->product_data($row->product_item);
	    $this->load->view('templates/header',$data);
	    $this->load->view('profile/sellback', $data);
	    $this->load->view('templates/footer', $data);
	}
    }
    
    
    function viewProducts()
    {
	$data= array();
	$this->load->view('templates/header',$data);
	$this->load->view('profile/addproduct', $data);
	$this->load->view('templates/footer', $data);
    }
    
    

    public function edit($slug) {
            if ($this->input->post('edit_news')) {
                $row = $this->core_model->product_data($slug);
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
                        $id = $this->input->post('id');
                        $d= array('raw_name'=>'','file_ext'=>'');
                        $meta=array();
                        $up= $_FILES['pic']['name'];
                        $config['upload_path']          = './uploads/products/';
                        $config['allowed_types']        = 'gif|jpg|png';
                        $config['max_size']             = 2000;
                        $config['max_width']            = 2000;
                        $config['max_height']           = 2000;
                        if($up)
                        {
                            $info= getimagesize($_FILES['pic']['tmp_name']);
                            $config['file_name']			= (uniqid());
                            $this->load->library('upload', $config);
                            if ( ! $this->upload->do_upload('pic'))
                            {
                                $data['uploads_error'] = array('error' => $this->upload->display_errors());
                            }
                            else
                            {
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
                                $uploaded_pic= $d['raw_name'].$d['file_ext'];
                                $thumbnail_pic= $d['raw_name'].'_thumb'.$d['file_ext'];
                                $meta= array("w"=>$info[0], "h"=>$info[1], "type"=>$info['mime']);
                                if( is_file("uploads/products/".$row['pic']) )
                                {
                                    unlink("uploads/products/".$row['pic']);
                                    unlink("uploads/products/".$row['thumbnail']);
                                }
                            }
                        }else{
                            $uploaded_pic= $row['pic'];
                            $thumbnail_pic= $row['thumbnail'];
                            $meta= (array) $row['meta'];
                        }
                        $pics= array();
                        
                        for($i=1; $i<=4; $i++)
                        {
                            
                            if($_FILES['pics_'.$i]['name'])
                            {
                                $info= getimagesize($_FILES['pics_'.$i]['tmp_name']);
                                $config['file_name']= (uniqid());
                                if ( ! $this->upload->do_upload('pics_'.$i))
                                {
                                    $data['uploads_error'] = array('error' => $this->upload->display_errors());
                                }else
                                {
                                    $pic=$this->upload->data('file_name');
                                    $config['image_library'] = 'gd2';
                                    $config['source_image'] = $this->upload->data('full_path');
                                    $config['create_thumb'] = TRUE;
                                    $config['maintain_ratio'] = TRUE;
                                    $config['width']         = 250;
                                    $config['height']       = 250;
                                    $this->load->library('image_lib', $config);
                                    $this->image_lib->resize();
                                    $d1=$ds[]=$this->upload->data();
                                    $thumbnails = $d1['raw_name'].'_thumb'.$d1['file_ext'];
                                    $metas= array("w"=>$info[0], "h"=>$info[1], "type"=>$info['mime']);
				    $pic1=$this->db->where("`module`='products_pic' and `title`='pic_{$i}'")->get('page')->row();
				    unlink("uploads/products/".$pic1->pic);
				    unlink("uploads/products/".$pic1->thumbnail);
				    $this->db->where("`module`='products_pic' and `title`='pic_{$i}'")->delete('page')->row();
				    $this->db->insert("pages", array(
					"title" => "pic_{$i}",
					"parent_id" => $id,
					"module" => 'products_pic',
					"country" => $this->input->post('meta[country]'),
					"meta" => json_encode($metas) ,
					"pic" => $d1['raw_name'].$d1['file_ext'],
					"thumbnail" => $thumbnails,
					"p_order"=> $i,
					"active" => $this->input->post('active')
				    ));
                                }
                            }
                        }
                        
                        $this->db->where(array("ID" => $id))->update("pages", array(
                            "title" => $this->input->post('title'),
			    "brand" => $this->input->post('brand'),
                            "content" => $this->input->post('content'),
                            "parent_id" => $this->input->post('cat'),
                            "international_shipping" => $this->input->post('international_shipping'),
                            "delivery" => $this->input->post('delivery'),
                            "module" => 'products',
                            "meta" => json_encode($meta) ,
                            "pic" => $uploaded_pic,
                            "thumbnail" => $thumbnail_pic,
                            "active" => $this->input->post('active')
                        ));
			
			for( $i=0; $i<count( $ds ) ; $i++ )
                        {
                            $this->db->insert("pages", array(
                                "title" => "pic_{$i}",
                                "parent_id" => $id,
                                "module" => 'products_pic',
                                "country" => $this->input->post('meta[country]'),
                                "meta" => json_encode($metas[$i]) ,
                                "pic" => $ds[$i]['raw_name'].$ds[$i]['file_ext'],
                                "thumbnail" => $thumbnails[$i],
                                "p_order"=> $i+1,
                                "active" => $this->input->post('active')
                            ));
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
                                    
                                ));
                            }
                        }
                        $data['updated'] = $id;
                    }
                }else {
                    $error_array[] = "برجاء تحديد قسم <br />";
                    $data['error'] = $error_array;
                }
            }

            $data['titles'] = $this->titles;
            $data['edit'] = $slug;
            $row = $this->core_model->product_data($slug);
            $data['row'] = $row;
            $data['amount'] = $this->db->where("uid='{$_SESSION['i']}'")->get("balance")->row()->balance;;
            $data['has'] = $this->has;
            $data['admin_dir'] = base_url() . $this->core_model->admin_dir();
            $data['page_title'] = "تعديل  \"" . $data['row']['title'] . "\"";
            $this->load->view('templates/header',$data);
	$this->load->view('profile/addproduct', $data);
	$this->load->view('templates/footer', $data);
        
    }
}
