<?php

class Role_access_m extends MY_Model
{
	protected $_table_name = 'role_access';
	protected $_primary_key = 'role_access_id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $_rules = array();
	protected $_timestamp = FALSE;
	
	
	public function get_details($id)
	{
		$query = $this->db->query('SELECT menu_details.menu_id,main_name,sub_name,role_id FROM menu_details LEFT JOIN role_access on menu_details.menu_id = role_access.menu_id and role_access.role_id = '.$id.' order by main_name,sub_name');
		return $query->result();
	}
	
	public function delete_access($role_id,$menu_id)
	{
		$query = $this->db->query('DELETE FROM role_access WHERE role_id='.$role_id.' and menu_id = '.$menu_id);
	}
}