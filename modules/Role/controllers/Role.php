<?php

class Role extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Role_m');
	}
	
	
	function index($start=0)
	{
		$data['roles_list']= $this->Role_m->get();
		
		$data['content_view'] = 'Role/role_v';
		$data['pagetitle'] = "Role List";
		$this->template->admin_template($data);
	}
	
	
	function edit($id)
	{
		if($id > 5)
		{
			$rules=$this->Role_m->_rules1;
			$this->form_validation->set_rules($rules);
			if($this->form_validation->run() == TRUE)
			{
				$save_data=	array(
						'role_name' => $this->input->post('role_name'),
	
						'status' => ($this->input->post('status')=='on')?'1':'0'
				);
					
				if($this->Role_m->save($save_data, $this->input->post('id')))
				{
					$this->session->set_flashdata('Message',"Role Updated Successfully.");
					$this->session->set_flashdata('Message_class','alert-success');
					return redirect('Role');
				}
				else
				{
					$this->session->set_flashdata('Message',"Error Occure While Updating Role..Please Try Again");
					$this->session->set_flashdata('Message_class','alert-danger');
					return redirect('Role');
				}
			}
			$data['role'] = $this->Role_m->get($id);
			$data['content_view'] = 'Role/role_edit_v';
			$data['pagetitle'] = "Edit Role";
			$this->template->admin_template($data);
		}
		else
		{
			$this->session->set_flashdata('Message',"You are trying to edit non editable value.");
			$this->session->set_flashdata('Message_class','alert-danger');
			return redirect('Role');
		}
			
	}
	
	function add_new()
	{
		$rules=$this->Role_m->_rules;
		$this->form_validation->set_rules($rules);
		if($this->form_validation->run() == TRUE)
		{
			$save_data=	array(
	
					'role_name' => $this->input->post('role_name'),
						
					'status' => ($this->input->post('status')=='on')?'1':'0'
		
			);
			if($this->Role_m->save($save_data))
			{
				$this->session->set_flashdata('Message',"Role Added Successfully.");
				$this->session->set_flashdata('Message_class','alert-success');
				return redirect('Role');
			}
			else
			{
				$this->session->set_flashdata('Message',"Error Occure While Updating Role..Please Try Again");
				$this->session->set_flashdata('Message_class','alert-danger');
				return redirect('Role');
			}
		}
		
		$data['content_view'] = 'Role/role_addnew_v';
		$data['pagetitle'] = "Add Role";
		$this->template->admin_template($data);
	}
	
	function delete()
	{
	
		$id = $this->input->post('id');
		if($id > 5)
		{
			$this->Role_m->delete_updateStatus($id);
			$this->session->set_flashdata('Message',"Role Deleted Successfully.");
			$this->session->set_flashdata('Message_class','alert-success');
			return true;
		}
		else
		{
			$this->session->set_flashdata('Message',"You are trying to delete non editable value.");
			$this->session->set_flashdata('Message_class','alert-danger');
			return true;
		}
	}
	
	
	function check_role()
	{
	
		$name = $this->input->post('name');
		$check_name = $this->Role_m->check_role($name);
		return $check_name;
	
	}
	
	
}