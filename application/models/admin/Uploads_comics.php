<?php
class uploads_comics extends CI_model
{
	public function up()
	{

		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		
		$tags= $this->input->get('tags');
		$news= $this->input->get('news');
		$title= $this->input->get('title');
		$desc= $this->input->get('desc');
		$cats= explode("-",$this->input->get('cat'));
		if($cats[1]) { $maincat=$cats[0]; $cat=$cats[1]; }else{$cat=$maincat=$cats[0];}
		$img= $this->input->get('img');
		$im= getimagesize("uploads/uploads_tmp/{$img}");
		$size= filesize("uploads/uploads_tmp/{$img}");
		//echo $size; die;
		$w=$im[0];
		$h=$im[1];
		$extx= preg_split("/\//", $im['mime']) ;
		$ext= strtolower( $extx[1]);
		
		$fingerPrint= $this->core_model->imgFingerPrint($w,$h,$im['mime'], $size);
		
		$query= $this->db->get_where("comics", array("fingerprint"=>$fingerPrint));
		$num= $query->num_rows();
		if($num>0)
		{
			$images= array();
			$rows= $query->result();
			//var_dump($rows);die;
			foreach($rows as $row)
			{
				$images[]=array("id"=> $row->ID, "title"=>$row->title);
			}
			$o= array("result"=>"error", "msg"=>"هذه الكوميك موجودة من قبل", "images"=>$images);
			echo json_encode($o);
		}else{
			$newname= date('Y-m-d')."-".uniqid();
			rename("uploads/uploads_tmp/{$img}", "uploads/comics/{$newname}.{$ext}");
			
			
			$config['image_library'] = 'gd2';
			$config['source_image'] = "uploads/comics/{$newname}.{$ext}";
			$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width']         = 250;
			$config['height']       = 250;
			
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			
			$this->db->insert("comics", array("title"=>$title,"desc"=>$desc,"cat"=>$cat,"width"=>$w,"height"=>$h,
					"type"=>$im['mime'], "ext"=>$ext,"cat"=>$cat,"maincat"=>$maincat,"image"=>"{$newname}.{$ext}", 
					"thumb"=>"{$newname}_thumb.{$ext}","url"=>str_replace(" ", "-", $title) ,
					"fingerprint"=>$fingerPrint, "size"=> $size
			));
			$id= $this->db->insert_id();
			$o= array("result"=>"success", "msg"=>"تمت اﻹضافة");
			if($tags)
			{
				$tags_ar= explode(",", $tags);
				foreach($tags_ar as $t)
				{
					$this->db->insert("comics_tags", array("tag_id"=>$t, "comic_id"=>$id));
				}
			}
			if($news)
			{
				$this->db->insert("comics_news", array("news_id"=>$t, "comic_id"=>$id));
			}
			
			
			echo json_encode($o);
		}
	}
}