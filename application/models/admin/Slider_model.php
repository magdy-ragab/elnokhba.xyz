<?php
class Slider_model extends CI_Model
{
	
	public function add_slider($title, $content='', $news_date='0000-00-00', $active='Y', $pic='',$thumbnail='',$front='')
	{
		$url= (preg_replace("/\ /", "-", $title));
		$query= $this->db->get_where("slider", "`url`='{$url}'");
		if($query->num_rows()>0)
		{
			return false;
		}else{
			$this->db->insert("slider", array("title"=>$title,
					"content"=>$content,
					"news_date"=>$news_date,
					"active"=>$active,
					"pic"=>$pic,
					"thumbnail"=>$thumbnail,
					"url"=>$url,
					"front_pic"=>$front));
			return $this->db->insert_id();
		}
	}
	
	
	public function edit_slider($title, $content='', $news_date='0000-00-00', $active='Y', $pic='',$thumbnail='',$front='',$id)
	{
		$url= (preg_replace("/\ /", "-", $title));
			$this->db->where("`ID`='{$id}'");
			$this->db->update("slider", array(
					"title"=>$title,
					"content"=>$content,
					"news_date"=>$news_date,
					"active"=>$active,
					"pic"=>$pic,
					"thumbnail"=>$thumbnail,
					"front_pic"=>$front,
					"url"=>$url
					
			));
			return $id;
	}
	
	public function slider_dupliated($title)
	{
		$url= preg_replace("/\ /", "-", $title);
		$query= $this->db->get_where("slider", "`url`='{$url}'");
		if($query->num_rows()>0)
		{
			return true;
		}else{
			return false;
		}
	}
	
	
	public function del_slider($id)
	{
		$q= $this->db->get_where("slider", "`ID`='{$id}'");
		$row=$q->row_array();
		@unlink("uploads/slider/".$row['pic']);
		@unlink("uploads/slider/".$row['thumbnail']);
		@unlink("uploads/slider/".$row['front_pic']);
		$this->db->where("ID",$id);
		$this->db->delete("slider");
	}
	
	
}