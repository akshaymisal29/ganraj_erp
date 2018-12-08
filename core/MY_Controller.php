<?php 

class MY_Controller extends MX_Controller 
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->module('Template');
		$this->load->model('My_Model','my_model');
		
		date_default_timezone_set('Asia/Kolkata');
		
		$exception_uris=array(
				'Login',
				'Login/logout',
				'Webservices/wsLogin',
				'Webservices/wsGetCustomers',
				'Webservices/wsSaveBillingMaster',
				'Webservices/wsGetBookings',
				'Webservices1/wsSaveSampleData',
				'Webservices1/getView',
			
		
		);
		
		$value = explode("/", uri_string());
		
		if(in_array(uri_string(), $exception_uris) == FALSE)
		{
			if($this->my_model->loggedin()== FALSE)
			{
				redirect('Login');
			}
			
		}	
		
	}

}