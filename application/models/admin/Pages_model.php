<?php
class Pages_model extends CI_Model
{

	public function add_pages($title, $content='', $news_date='0000-00-00', $active='Y', $pic='',$thumbnail='', $module='pages', $meta='', $size='', $ar= array())
	{
		/*$url= (preg_replace("/\ /", "-", $title));
		$query= $this->db->get_where("pages", "`url`='{$url}'");
		if($query->num_rows()>0)
		{
			return false;
		}else{*/
			$default_array=array_merge($ar,array("title"=>$title,
					"content"=>$content,
			"module"=>$module,
			"meta"=>$meta,
					"news_date"=>$news_date,"active"=>$active,"pic"=>$pic,"thumbnail"=>$thumbnail, "url"=>$url, "pic_size"=>$size));
			//print_r($default_array);die();
			$this->db->insert("pages", $default_array);
			return $this->db->insert_id();
		/*}*/
	}



	public function edit_pages($title, $content='', $news_date='0000-00-00', $active='Y', $pic='',$thumbnail='',$id,$ar= array(),$meta='')
	{
        $default_array=array_merge($ar,array(
	    "title"=>$title,
	    "content"=>$content,
	    "news_date"=>$news_date,
	    "active"=>$active,
	    "pic"=>$pic,
	    "meta"=>$meta,
	    "thumbnail"=>$thumbnail,
	    "url"=>$url
	    ));
	$url= (preg_replace("/\ /", "-", $title));
		    $this->db->where("`ID`='{$id}'");
		    $this->db->update("pages", $default_array);
		    return $id;
	}

	public function pages_dupliated($title)
	{
        return false;
		$url= preg_replace("/\ /", "-", $title);
		$query= $this->db->get_where("pages", "`url`='{$url}'");
		if($query->num_rows()>0)
		{
			return true;
		}else{
			return false;
		}
	}


	public function del_pages($id)
	{
		$this->db->where("ID",$id);
		$this->db->delete("pages");
	}



	public function uploadImage($pic ) : array
	{
		$data=[];
		$this->load->library('image_lib');
		$config['upload_path'] = './uploads/products/';
		$config['allowed_types'] = 'gif|jpg|png|webm|webp';
		$config['max_size'] = 2000;
		$config['max_width'] = 2000;
		$config['max_height'] = 2000;
		if ( isset($pic) && isset($_FILES[$pic]['name']) && $_FILES[$pic]['name'] ) {
			$info = getimagesize($_FILES[$pic]['tmp_name']);
			$newSize= min($info[0],$info[1]);
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload($pic)) {
				$data['uploads_error'] = array('error' => $this->upload->display_errors());
			} else {
				$config['source_image'] = $this->upload->data('full_path');
				$config['image_library'] = 'gd2';
				$config['create_thumb'] = true;
				$config['maintain_ratio'] = false;
				$config['width'] = $newSize;
				$config['height'] = $newSize;
				$config['y_axis'] = ($info[1] - $newSize) / 2;
				$config['x_axis'] = ($info[0] - $newSize) / 2;
				$this->image_lib->clear();

				$this->image_lib->initialize($config);

				if(!$this->image_lib->crop())
				{
					$data['uploads_error']= array('error' => $this->upload->display_errors());
				}else{
					$d= $this->upload->data();
					$d['thumbnail'] = $d['raw_name'].'_thumb'.$d['file_ext'];
					$d['thumbnail_path'] = $d['file_path'].$d['thumbnail'];
					$data = ['pic'=>$d['file_name'], "thumbnail"=>$d['thumbnail']];
					$this->resizeImage($d['thumbnail_path']);
				}
			}
		}
		return $data;
	}


	public function resizeImage(string $image,int $width=250, int $height=250)
	{
		$this->image_lib->clear();
		$config= ["source_image"=>$image,
			"width"=>$width,
			"height"=>$height,
			"create_thumb"=>false,
			"overwrite"=>true,
			"new_image"=>$image
		];
		$this->image_lib->initialize($config);
		if(!$this->image_lib->resize())
		{
			echo $this->image_lib->display_errors();
		}
	}


}