<?php
class Tag_model extends CI_Model
{
	
	public function add_tags($cat_title, $cat_parent=0)
	{
		$url= preg_replace("/\ /", "-", $cat_title);
		$query= $this->db->get_where("tags", "`url`='{$url}'");
		if($query->num_rows()>0)
		{
			return false;
		}else{
			$this->db->insert("tags", array("title"=>$cat_title, "url"=>$url));
			return $this->db->insert_id();
		}
	}
	
	
	public function edit_tag($cat_title, $id=0)
	{
		//echo $cat_parent;
		$url= preg_replace("/\ /", "-", $cat_title);
		/*$query= $this->db->get_where("cat", "`url`='{$url}'");
		if($query->num_rows()>0)
		{
			return false;
		}else{*/
			$this->db->where("`ID`='{$id}'");
			$this->db->update("tags", array("title"=>$cat_title, "url"=>$url));
			return $id;
		//}
	}
	
	public function tags_dupliated($cat_title)
	{
		$url= preg_replace("/\ /", "-", $cat_title);
		$query= $this->db->get_where("tags", "`url`='{$url}'");
		if($query->num_rows()>0)
		{
			return true;
		}else{
			return false;
		}
	}
	
	
	public function del_tags($id)
	{
		$this->db->where("ID",$id);
		$this->db->delete("tags");
	}
	
	
}