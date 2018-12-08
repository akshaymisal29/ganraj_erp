<?php

class Login_m extends MY_Model
{
	protected $_table_name = 'siddhisugar_login';
	protected $_primary_key = 'user_id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $_rules = array(
			'username' => array(
					'field' => 'username',
					'label' => 'User Name',
					'rules' => 'trim|required'
			) ,
			'pass' => array(
					'field' => 'pass',
					'label' => 'Password',
					'rules' => 'trim|required'
			));
	protected $_timestamp = FALSE;


	public function login()
	{
		$user = $this->get_by(array(
				'user_name' => $this->input->post('username'),
				'password' => $this->hash($this->input->post('pass')),
				'status' => 5
		),TRUE);
		if(count($user))
		{
			$user_data = $this->get_session_details($user->user_id);
			$data = array(
					'id' => $user_data->user_id,
					'name' =>  $user_data->name,
					'user_name' =>  $user_data->user_name,
					'role_name' => 'Superadmin',
					'loggedin' => TRUE
			);
			$this->session->set_userdata($data);
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
	}

	public function hash($string)
	{
		//return sha1($string);
		return $string;
	}

	public function get_session_details($id)
	{
		$query = $this->db->query('SELECT * FROM siddhisugar_login where user_id = '.$id);
		return $query->row();

	}

	public function add_data($username,$pass)
	{
		$data=array(
				'username' =>$username,
				'pass' => $this->hash($pass),
				'status' => 1
		);
		return $this->save($data);

	}

	/* public function update_password()
	{
		$user = $this->get_by(array(
				'login_id' => $this->session->userdata('login_id'),
				'pass' => $this->hash($this->input->post('curr_pass')),
				'status' => 1
		),TRUE);
		if(count($user))
		{
			$save_data1=	array(
					'pass' => $this->hash($this->input->post('pass'))
			);
			$logid=$this->save($save_data1,$this->session->userdata('login_id'));
			$this->session->set_flashdata('Message',"Password Updated Successfully.");
			$this->session->set_flashdata('Message_class','alert-success');
			return True;
		}
		else
		{
			$this->session->set_flashdata('Message',"Current password is not matching");
			$this->session->set_flashdata('Message_class','alert-danger');
			return false;
		}
	} */
	
	public function update_password()
	{
		$user = $this->get_by(array(
				'user_id' => $this->session->userdata('id'),
				'password' => $this->input->post('curr_pass'),
				'status' => 5
		),TRUE);
		if(count($user))
		{
			$save_data1=	array(
					'password' => $this->hash($this->input->post('pass'))
			);
			$logid=$this->save($save_data1,$this->session->userdata('id'));
			$this->session->set_flashdata('Message',"Password Updated Successfully.");
			$this->session->set_flashdata('Message_class','alert-success');
			return True;
		}
		else
		{
			$this->session->set_flashdata('Message',"Current password is not matching");
			$this->session->set_flashdata('Message_class','alert-danger');
			return false;
		}
	}
	
	
}