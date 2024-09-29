<?php
class Menu_model extends CI_Model
{
	
	public function add_menu($title, $url='', $active)
	{
		$url= $url;
		$query= $this->db->get_where("menu", "`url`='{$url}'");
		if($query->num_rows()>0)
		{
			return false;
		}else{
			$this->db->insert("menu", array(
					"title"=>$title,
					"active"=>$active,
					"parent_id"=> $this->input->post('parent_id') ,
					"has_subs"=> ($this->input->post('parent_id')?"Y":"") ,
					"url"=>$url));
			return $this->db->insert_id();
		}
	}
	
	
	public function edit_menu($title, $url='', $active,$id)
	{
			$this->db->where("`ID`='{$id}'");
			$this->db->update("menu", array(
					"title"=>$title,
					"active"=>$active,
					"parent_id"=> $this->input->post('parent_id') ,
					"has_subs"=> ($this->input->post('parent_id')?"Y":"") ,
					"url"=>$url));
			return $id;
	}
	
	public function menu_dupliated($title)
	{
		$url= preg_replace(array("/\ /","/\!|\@|\#|\$|\%|\^|\&|\*\(|\)/"), array("-","-") , $title);
		$query= $this->db->get_where("menu", "`url`='{$url}'");
		if($query->num_rows()>0)
		{
			return true;
		}else{
			return false;
		}
	}
	
	
	public function del_menu($id)
	{
		$this->db->where("ID",$id);
		$this->db->delete("menu");
	}
	
	
}