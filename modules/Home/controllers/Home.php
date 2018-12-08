<?php

class Home extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Home_m');
		
	}


	function index()
	{
		//var_dump(uri_string());

		$data['content_view'] = 'Home/home_v';
		$data['pagetitle'] = "Home";
		$this->template->admin_template($data);
	}

	function home_graph_v()
	{
		$data['content_view'] = 'Home/home_graph_v';
		$data['pagetitle'] = "Home Graph";
		$this->template->admin_template($data);
	}
	function change_password()
	{
		$rules=$this->Home_m->_rules1;
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == TRUE)
		{
			if($this->Home_m->update_password())
			{
				return redirect('Home');
			}
		}
		$data['user'] = $this->Home_m->get_user();
		$data['content_view'] = 'Home/user_change_password_v';
		$data['pagetitle'] = "Change Password";
		$this->template->admin_template($data);
	}


}
