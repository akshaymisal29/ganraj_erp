<?php

class Template extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('Template_m');
	}
	
	

	function admin_template($data = NULL)
	{
		$data['webtitle']= "SIDDHI SUGAR";
	/* 
		$data['menu_view'] = $this->Template_m->getMenu();
		$data['menu_count'] = count($data['menu_view']); */
		
		
		$this -> load-> view("Template/admin_template_v",$data);
	}
	
	function admin_mobile_template($data = NULL)
	{
		$this -> load-> view("Template/admin_template_m",$data);
	}
}