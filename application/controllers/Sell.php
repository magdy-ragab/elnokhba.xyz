<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sell extends CI_Controller {

    public function __construct() {
	    parent::__construct();
	    $this->load->helper('url');
	    $this->load->helper('form');
	    $this->load->database();
	    $this->load->model(array('core_model', 'Hijri'));
	    $this->load->library('session');
    }
	
    public function index() {
	$this->load->view('templates/header',$data);
        if(isset( $_SESSION['i'] ))
        {
            $data['coins'] = $this->core_model->getActiveCurrencyToUSD();
            
            
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
                            "parent_id" => $this->input->post('cat'),
			    "content" => $this->input->post('content'),
			    "international_shipping" => $this->input->post('international_shipping'),
                            "module" => 'products',
                            "country" => $this->input->post('meta[country]'),
                            "availble" => $this->input->post('availble'),
			    "delivery" => $this->input->post('delivery'),
                            "meta" => json_encode($meta) ,
                            "pic" => $d['raw_name'].$d['file_ext'],
                            "thumbnail" => $d['raw_name'].'_thumb'.$d['file_ext'],
                            "active" => 'N',
                            "uid" => $_SESSION['i'],
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


            
            $this->load->view('user_pages/sell',$data);
        }else{
            $this->load->view('user_pages/please_login',$data);
        }
	$this->load->view('templates/footer', $data);
    }
    
    function view()
    {
        $this->load->view('templates/header',$data);
        if(isset( $_SESSION['i'] ))
        {
            $this->load->view('user_pages/view',$data);
        }else{
            $this->load->view('user_pages/please_login',$data);
        }
        $this->load->view('templates/footer',$data);
    }
    
    function availble($id, $availble)
    {
        if($availble =='Y') $ret="N"; else $ret='Y';
        $row= $this->core_model->product_data($id);
        if($row['uid']== $_SESSION['i'])
        {
            $this->db->where("ID='{$id}'")->update("pages", array("availble"=>$ret));
            redirect(base_url()."sell/view");
        }
    }
}
