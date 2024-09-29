<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rss extends CI_Controller {
	public function index()
	{
		$this->load->helper('url');
		$this->load->database();
		$this->load->model('core_model');
		header('Content-Type: text/xml');
		echo '<?xml version="1.0" encoding="UTF-8" ?>'?><rss version="2.0">
		<channel>
		   <title><?php echo $this->core_model->get_settings('title'); ?></title>
		   <link><?php echo base_url(); ?></link>
		   <description><?php $this->core_model->get_settings('description');?></description>
		   <image>
		     <url><?php echo base_url()."uploads/site/". $this->core_model->get_settings('site_image'); ?></url>
		     <title><?php echo $this->core_model->get_settings('title'); ?></title>
		     <link><?php echo base_url()?></link>
		   </image>
		   <?php foreach($this->db->order_by("ID","desc")->get_where("pages", "active='Y' and `module`<>'gallery'")->result() as $r){ ?>
		   <item>
		     <title><?php echo $r->title?></title>
		     <link><?php echo base_url() .$r->module."/{$r->ID}"; ?></link>
		     <description><?php echo  mb_substr(strip_tags( $r->content), 0, 255, "utf-8");?></description>
		   </item>
		   <?php }?>
		 </channel>
		</rss>
	<?php }
}
