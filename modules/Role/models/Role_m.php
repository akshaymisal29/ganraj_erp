<?php

class Role_m extends MY_Model
{
	protected $_table_name = 'roles';
	protected $_primary_key = 'role_id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $_rules = array(
			'role_name' => array(
					'field' => 'role_name',
					'label' => 'Role Name',
					'rules' => 'trim|required|is_unique[roles.role_name]'
			));

	
	public $_rules1 = array(
			'role_name' => array(
					'field' => 'role_name',
					'label' => 'Role Name',
					'rules' => 'trim|required'
			));
	protected $_timestamp = TRUE;
	
	
	public function check_role($name)
	{
		$query = $this->db->query(" select * from roles where role_name = '".$name."'");
	
	
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
	
}