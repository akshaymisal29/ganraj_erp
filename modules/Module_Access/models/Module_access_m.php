<?php

class Module_access_m extends MY_Model
{
	protected $_table_name = 'siddhisugar_usermodule_map';
	protected $_order_by = '';
	public $_rules = array();
	protected $_timestamp = FALSE;
	
	
	public function get_details($id)
	{
		$query = $this->db->query('SELECT siddhisugar_modules.module_id,siddhisugar_modules.module_name, siddhisugar_usermodule_map.user_id FROM siddhisugar_modules LEFT JOIN siddhisugar_usermodule_map on siddhisugar_modules.module_id = siddhisugar_usermodule_map.module_id and siddhisugar_usermodule_map.user_id = '.$id.' order by siddhisugar_modules.module_name');
		return $query->result();
	}
	
	public function delete_access($role_id,$menu_id)
	{
		$query = $this->db->query('DELETE FROM siddhisugar_usermodule_map WHERE user_id='.$role_id.' and module_id = '.$menu_id);
	}
	
	public function get_user_name($id)
	{
		$query = $this->db->query('SELECT user_name FROM siddhisugar_login where user_id= '.$id);
		return $query->row('user_name');
	}
}