<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Langto extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('session')) ;
		$this->load->helper(array('cookie', 'url')) ;
	}

	
    
	public function index($countryCode, $coin)
	{
        $expires=time+(60*60*24*120);
		set_cookie('country',$countryCode, $expires);
        set_cookie('coin',$coin, $expires);
        redirect(base_url().$countryCode);
	}

	
}
