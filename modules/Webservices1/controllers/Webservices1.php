<?php

class Webservices1 extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Webservices1_m');
		$date = date_default_timezone_set('Asia/Kolkata');
	}
	
	function index($start=0)
	{
		
	}
	
	function wsSaveSampleData()
	{
		$time =date('H:i:s');
		$decoded_postdata = json_decode(file_get_contents('php://input'), true);
		if ((json_last_error() == JSON_ERROR_NONE))
		{
			$_POST = $decoded_postdata;
	
			$msg="Details Added Successfully";
			$status="success";
				
			$trans_id=$this->Webservices1_m->saveSampleData($_POST);
			if($trans_id>0)
			{
					$msg="Details Updated";
					$status="Success";
			}
			else 
			{
				$msg="Details not Added";
				$status="Error";
			}
			
			$result=array("msg"=>$msg,"status"=>$status);
			print_r(json_encode($result));
		}
	}
	
	function checkLogin()
	{
		if($this->Webservices1_m->checkLogin($_GET['username'],$_GET['password']))
		{
			echo "{ \"status\" : \"1\" , \"msg\" : \"login Successful\" }";
		}
		else
		{
			echo "{ \"status\" : \"2\" , \"msg\" : \"login Failed\" }";
		}
	}
	
	function getView()
	{
		$modules = $this->Webservices1_m->getModules($_GET);
		$result = $this->Webservices1_m->getSampleData();
		$this->Webservices1_m->deleteSampleData($result->id);
		$sample_data = json_decode($result->sample_data);
		$data['result'] = $sample_data;
		$data['lastupdate'] = $result->created_date;
		//print_r($modules);
		$data['modules'] = $modules;
		$data['content_view'] = 'Webservices1/Details_view_v';
		$data['pagetitle'] = "Details View";
		$this->template->admin_mobile_template($data);
	
	}
	
		
}
