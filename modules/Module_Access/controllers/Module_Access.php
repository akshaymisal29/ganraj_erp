<?php

class Module_Access extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Module_access_m');
	}
	
	function edit($id=-1)
	{
		
		if($id>=0)
		{
			
			$menu_list=$this->Module_access_m->get_details($id);
			
			if($this->input->post('submit')=='Save')
			{
				foreach($menu_list as $menu)
				{
					if($menu->user_id==NULL)
					{
						if($this->input->post('menu_'.$menu->module_id)=='on')
						{
							$data = array(
									'user_id' => $id,
									'module_id' => $menu->module_id
							);
							$this->Module_access_m->save($data);
						}
	
					}
					else
					{
						if($this->input->post('menu_'.$menu->module_id)!='on')
						{
							$this->Module_access_m->delete_access($id,$menu->module_id);
						}
					}
				}
				$this->session->set_flashdata('Message',"Access Successfully Updated.");
				$this->session->set_flashdata('Message_class','alert-success');
				return redirect('User');
	
			}

			
			
			$this->load->library('pagination');
			$config['base_url'] = base_url().'Role_Access/edit/'.$id;
			$config['total_rows'] = $this->Module_access_m->get_count();
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
			$data['role_name']=$this->Module_access_m->get_user_name($id);
			$data['role_id'] = $id;
			$data['content_view'] = 'Module_Access/role_access_v';
			$data['pagetitle'] = "Assign Module";
			$this->template->admin_template($data);
		}
		else
		{
			return redirect("User");
		}
	
	}
	
	
	
	function index()
	{
		return redirect("Home");
	}
	
	
}