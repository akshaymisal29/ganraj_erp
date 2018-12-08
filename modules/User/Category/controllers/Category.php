<?php

class Category extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Category_m');
	}

   function search()
	{
		echo $this->Category_m->getcategorylike($this->input->get("q"));
	}
	
	function index($start=0)
	{
		
		$data['category_list']= $this->Category_m->get();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'Category/index';
		$config['total_rows'] = $this->Category_m->get_count();
		$config['per_page'] = 10;
		
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
		$data['pages'] =$this->pagination->create_links();
		
		$data['content_view'] = 'Category/category_master_v';
		$data['pagetitle'] = "Category";
		$data['total_rows'] = $config['total_rows'];
		$this->template->admin_template($data);
	}

	function add_new()
	{
		$rules=$this->Category_m->_rules;
		$this->form_validation->set_rules($rules);
		
		if($this->form_validation->run() == TRUE)
		{
			 $save_data=	array(
				'cat_name' 			=> $this->input->post('cat_name'),
				'status' 				=> ($this->input->post('status')=='on')?'1':'0'
			);
			
			if($this->Category_m->save($save_data))
			{
				$this->session->set_flashdata('Message',"Record Added Successfully.");	
				$this->session->set_flashdata('Message_class','alert-success');	
				return redirect('Category');
			}
			else
			{
				$this->session->set_flashdata('Message',"Error Occure While Inserting Record..Please Try Again");	
				$this->session->set_flashdata('Message_class','alert-danger');	
				return redirect('Category');
			}	
		}
		
		
		$data['content_view'] = 'Category/category_addnew_v';
		$data['pagetitle'] = "Add Category";
		$this->template->admin_template($data);	
	}

	function edit($id)
	{
		$unique_val = "";
		$rules1 =$this->Category_m->_rules1;
		$this->form_validation->set_rules($rules1);
		
		if($this->form_validation->run() == TRUE) 
		{
			$save_data=	array(
					'cat_name' 			=> $this->input->post('cat_name'),
					'status' 				=> ($this->input->post('status')=='on')?'1':'0'
			);
				
				
			if($this->Category_m->save($save_data, $id))
			{
				$this->session->set_flashdata('Message',"Record Updated Successfully.");	
				$this->session->set_flashdata('Message_class','alert-success');	
				return redirect('Category');
			}
			else
			{
				$this->session->set_flashdata('Message',"Error Occure While Updating Record..Please Try Again");	
				$this->session->set_flashdata('Message_class','alert-danger');	
				return redirect('Category');
			}
		}
		
		
		$data['area_details'] = $this->Category_m->get($id);
		$data['content_view'] = 'Category/category_edit_v';
		$data['pagetitle'] = "Edit Category";
		$this->template->admin_template($data);
	}
	
	function delete()
	{
		$id = $this->input->post('id');
	
		$this->Category_m->delete($id);
		$this->session->set_flashdata('Message',"Record Deleted Successfully.");	
		$this->session->set_flashdata('Message_class','alert-success');	
		return true;	
		
	}
	
	
	function checkcat()
	{
		
		$id = $this->input->post('id');
		$name = $this->input->post('cat_name');
		$check_name = $this->Category_m->check_cat($name,$id);
		return $check_name;
		
	}



}
?>