<?php

class Role_Access extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Role_access_m');
	}
	
	function edit($name,$id=-1)
	{
		
		if($id>=0)
		{
			$menu_list=$this->Role_access_m->get_details($id);
			if($this->input->post('submit')=='Save')
			{
				foreach($menu_list as $menu)
				{
					if($menu->role_id==NULL)
					{
						if($this->input->post('menu_'.$menu->menu_id)=='on')
						{
							$data = array(
									'role_id' => $id,
									'menu_id' => $menu->menu_id
							);
							$this->Role_access_m->save($data);
						}
	
					}
					else
					{
						if($this->input->post('menu_'.$menu->menu_id)!='on')
						{
							$this->Role_access_m->delete_access($id,$menu->menu_id);
						}
					}
				}
				$this->session->set_flashdata('Message',"Access Successfully Updated.");
				$this->session->set_flashdata('Message_class','alert-success');
				return redirect('Role');
	
			}

			
			
			$this->load->library('pagination');
			$config['base_url'] = base_url().'Role_Access/edit/'.$name.'/'.$id;
			$config['total_rows'] = $this->Role_access_m->get_count();
			$config['per_page'] = 10;
			$choice = $config["total_rows"]/$config["per_page"];
			$config["num_links"] = floor($choice);
			
			// integrate bootstrap pagination
			$config['full_tag_open'] = '<ul class="pagination">';
			$config['full_tag_close'] = '</ul>';
			$config['first_link'] = false;
			$config['last_link'] = false;
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['prev_link'] = 'Previous';
			$config['prev_tag_open'] = '<li class="prev">';
			$config['prev_tag_close'] = '</li>';
			$config['next_link'] = 'Next';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="active"><a href="#">';
			$config['cur_tag_close'] = '</a></li>';
			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$this->pagination->initialize($config);
			
			
			$data['total_rows'] = $config['total_rows'];
			$data['pages'] =$this->pagination->create_links();
			
			$this->pagination->initialize($config);
			$data['pages'] =$this->pagination->create_links();
			
			
			$data['menu_list']= $menu_list;
			$data['role_id'] = $id;
			$data['role_name'] = $name;
			$data['content_view'] = 'Role_Access/role_access_v';
			$data['pagetitle'] = "Assign Role";
			$this->template->admin_template($data);
		}
		else
		{
			return redirect("Role");
		}
	
	}
	
	
	
	function index()
	{
		return redirect("Home");
	}
	
	
}