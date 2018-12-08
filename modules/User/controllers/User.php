<?php

class User extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('User_m');
		$this->load->model('Role/Role_m');
		
	
	}
	
	function index($start=0)
	{
		$data['user_list']= $this->User_m->get_by('status=1');
		$data['content_view'] = 'User/user_v';
		$data['pagetitle'] = "User List";
		
		$this->template->admin_template($data);
	}
	
	function edit($id)
	{
		$rules=$this->User_m->_rules1;
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == TRUE)
		{
		
			if($this->User_m->update_data())
			{
				$this->session->set_flashdata('Message',"Record Updated Successfully.");
				$this->session->set_flashdata('Message_class','alert-success');
				return redirect('User');
			}
			else
			{
				$this->session->set_flashdata('Message',"Error Occure While Updating Record..Please Try Again");
				$this->session->set_flashdata('Message_class','alert-danger');
				return redirect('User');
			}
		}
		$data['user'] = $this->User_m->get($id);
		$data['pagetitle'] = "Edit User";
		$data['content_view'] = 'User/user_edit_v';
		$this->template->admin_template($data);
	}
	
	function changepwd($id)
	{
		
		$rules=$this->User_m->_rules2;
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == TRUE)
		{
			if($this->User_m->update_pass())
			{
				$this->session->set_flashdata('Message',"Record Updated Successfully.");
				$this->session->set_flashdata('Message_class','alert-success');
				return redirect('User');
			}
			else
			{
				$this->session->set_flashdata('Message',"Error Occure While Updating Record..Please Try Again");
				$this->session->set_flashdata('Message_class','alert-danger');
				return redirect('User');
			}
		}
		$data['user'] = $this->User_m->get($id);
		$data['pagetitle'] = "User paasword change";
		$data['content_view'] = 'User/user_changepwd_v';
		$this->template->admin_template($data);
	}
	
	function add_new()
	{
		$rules=$this->User_m->_rules;
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == TRUE)
		{
					
			if($this->User_m->save_data())
			{
				$this->session->set_flashdata('Message',"Record Added Successfully.");
				$this->session->set_flashdata('Message_class','alert-success');
				return redirect('User');
			}
			else
			{
				$this->session->set_flashdata('Message',"Error Occure While Updating Record..Please Try Again");
				$this->session->set_flashdata('Message_class','alert-danger');
				return redirect('User');
			}
		}
		
		$data['pagetitle'] = "Add User";
		$data['content_view'] = 'User/user_addnew_v';
		$this->template->admin_template($data);
	}
	
	function delete()
	{
		$id = $this->input->post('id');
		$this->User_m->delete_data($id);
		$this->session->set_flashdata('Message',"Record Deleted Successfully.");
		$this->session->set_flashdata('Message_class','alert-success');
		return true;
	}
	
	function check_user()
	{
	
		$name = $this->input->post('username');
		$check_name = $this->User_m->check_user($name);
		return $check_name;
	}
	
}