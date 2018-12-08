<?php

class User_m extends MY_Model
{
	protected $_table_name = 'siddhisugar_login';
	protected $_primary_key = 'user_id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $_rules = array(
				
			'name' => array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'trim|required'
			),
			'username' => array(
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'trim|required|is_unique[siddhisugar_login.user_name]'
			),
			'pass' => array(
					'field' => 'pass',
					'label' => 'Password',
					'rules' => 'trim|required'
			),
			
		
	);
	
	public $_rules2 = array(
	
			
			'pass' => array(
					'field' => 'pass',
					'label' => 'Password',
					'rules' => 'trim|required|min_length[5]'
			),
			'cpass' => array(
					'field' => 'cpass',
					'label' => 'Confirm Password',
					'rules' => 'trim|required|min_length[5]|matches[pass]'
			)
	);
	public $_rules1 = array(
	
			'name' => array(
					'field' => 'name',
					'label' => 'Name',
					'rules' => 'trim|required'
			),
			'username' => array(
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'trim|required'
			),
			'pass' => array(
					'field' => 'pass',
					'label' => 'Password',
					'rules' => 'trim|required'
			),
	
	);
	protected $_timestamp = TRUE;
	
	
	public function get_by_limit($num = 5 , $start = 0)
	{
		$query = $this->db->query('SELECT users.id,name,users.role_id,users.dep_id,login_id,users.status,dep_name,role_name FROM users join roles on users.role_id =roles.role_id join departments on users.dep_id = departments.dep_id where users.id>0 LIMIT '.$start.','.$num);
		return $query->result();
	}
	
	
	public function get_Roles()
	{
		$role_data= array();
		$role_data[''] ='Select Role';
		$this->load->model('Role/Role_m');
		//$roles = $this->Role_m->get_by('status = 1');
 			$this->db->select('*');
		    $this->db->where('status',1);
		    $this->db->order_by("role_name","asc");
		    $this->db->from('roles');
		    $query= $this->db->get();
		    $roles = $query->result();
		    
		foreach ($roles as $role)
		{
			$role_data[$role->role_id] = $role->role_name;
		}
		return $role_data;
	}
	
	
	
	public function save_data()
	{
		
		$save_data=	array(
				'name' => $this->input->post('name'),
				'user_name' => $this->input->post('username'),
				'password' => $this->input->post('pass'),
				'status' => 1
		);
		return $this->save($save_data);
	}
	
	public function update_data()
	{
		
		$save_data=	array(
				'name' => $this->input->post('name'),
				'user_name' => $this->input->post('username'),
				'password' => $this->input->post('pass'),
				'status' => 1
		);
		return $this->save($save_data,$this->input->post('id'));
	}
	public function delete_data($id)
	{
		$this->load->model('Login/Login_m');
		$this->Login_m->delete($this->User_m->get($id)->login_id);
		return $this->delete($id);
	
	}
	
	public function update_pass()
	{
		$this->load->model('Login/Login_m');
		return $this->Login_m->reset_password();
	
	}
		
	public function check_user($name)
	{
		
		$query = $this->db->query(" select * from siddhisugar_login where user_name ='".$name."'");
		if ($query->num_rows() > 0)
		{
			echo "error";
			return "error";
		}
		else
		{
			echo "success";
			return "success";
		}
	}
	public function get_submitter_name($id)
	{
		$this->db->select('name');
		$this->db->where('id',$id);
	
		$query = $this->db->get($this->_table_name);
	
		if($query->num_rows() > 0)
		{
			return $query->row('name');
		}
		else
		{
			return false;
		}
	
	}
	
   public function get_approver_name($id)
	{
		$this->db->select('name');
		$this->db->where('id',$id);
	
		$query = $this->db->get($this->_table_name);
	
		if($query->num_rows() > 0)
		{
			return $query->row('name');
		}
		else
		{
			return false;
		}
	
	}
}