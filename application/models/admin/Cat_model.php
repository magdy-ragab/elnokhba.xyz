<?php
class Cat_model extends CI_Model
{
	/*public function __construct() {
		parent::__construct();
	} */
	
	
	public function add_cat($cat_title, $cat_parent=0)
	{
		$url= preg_replace("/\ /", "-", $cat_title);
		$query= $this->db->get_where("cat", "`url`='{$url}'");
		if($query->num_rows()>0)
		{
			return false;
		}else{
			$this->db->insert("cat", array("title"=>$cat_title, "catid"=>$cat_parent, "url"=>$url));
			return $this->db->insert_id();
		}
	}
	
	
	public function edit_cat($cat_title, $cat_parent=0, $id=0)
	{
		//echo $cat_parent;
		$url= preg_replace("/\ /", "-", $cat_title);
		/*$query= $this->db->get_where("cat", "`url`='{$url}'");
		if($query->num_rows()>0)
		{
			return false;
		}else{*/
			$this->db->where("`ID`='{$id}'");
			$this->db->update("cat", array("title"=>$cat_title, "catid"=>$cat_parent, "url"=>$url));
			return $id;
		//}
	}
	
	public function cats_dupliated($cat_title)
	{
		$url= preg_replace("/\ /", "-", $cat_title);
		$query= $this->db->get_where("cat", "`url`='{$url}'");
		if($query->num_rows()>0)
		{
			return true;
		}else{
			return false;
		}
	}
	
	
	public function del($id)
	{
		$this->db->where("ID",$id);
		$this->db->delete("cat");
	}
	
	
}