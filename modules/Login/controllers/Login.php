<?php

class Login extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Login_m');
	}
	
	
	function index()
	{
		$dashboard = 'Home';
		$this->Login_m->loggedin() == FALSE || redirect($dashboard);
		
		$rules=$this->Login_m->_rules;
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == TRUE)
		{
			// login and redirect
			if($this->Login_m->login() == TRUE)
			{
				redirect($dashboard);
			}
			else 
			{
				$this->session->set_flashdata('error','<p class="text-red">The username/password combination does not exist</p>');
				redirect('Login','refresh');
			}
		}
		
		
		$data['webtitle']= "SIDDHI SUGAR";
		$data['pagetitle'] = "Login";
		$this -> load-> view("Login/login_v",$data);
		
	}
	
	function logout()
	{
		$this->Login_m->logout();
		redirect('Login','refresh');
	}
	
	
}