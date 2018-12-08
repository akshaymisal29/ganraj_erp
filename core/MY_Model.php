<?php

class MY_Model extends CI_Model
{

	protected $_table_name;
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $_rules = array();
	protected $_timestamp = FALSE;
	
	function __construct() {
		parent::__construct();
	}
	
	public function get($id = NULL, $single= FALSE)
	{
		if($id != NULL)
		{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key,$id);
			$method = 'row';
				
		}
		elseif ($single == TRUE)
		{
			$method = 'row';
		}
		else
		{
			$method ='result';
		}
	
		if(!count($this->db->order_by($this->_order_by)))
		{
			$this->db->order_by($this->_order_by);
		}
		return $this->db->get($this->_table_name)->$method();
	
	}
	public function get_by($where, $single= FALSE)
	{
		$this->db->where($where);
		return  $this->get(NULL, $single);
	}
	
	public function get_count()
	{
		return $this->db->get($this->_table_name)->num_rows();
	}
	
	public function get_count_01($where)
	{
		return $this->db->where($where)->get($this->_table_name)->num_rows();
	}
	
	public function get_by_limit($num = 5 , $start = 0)
	{
		$this->db->limit($num,  $start);
		return  $this->get(NULL, FALSE);
	}
	
	public function get_by_limit_01($num = 5 , $start = 0, $where)
	{
		$this->db->limit($num,  $start);
		return  $this->get_by($where, FALSE);
	}
	
	
	public function save($data, $id = NULL)
	{
		/* if($this->_timestamp == TRUE)
		{
			$now= date('Y-m-d H:i:s');
			$id || $data['created'] = $now;
			$data['modified'] = $now;
		} */
	//	$data['updated_by'] = $this->session->userdata('id');
	
		//Insert
		if($id === NULL)
		{
			!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id=  $this->db->insert_id();
		}
		//Update
		else
		{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key,$id);
			$this->db->update($this->_table_name);
		}
	
		return $id;
	}
	
 	public function delete($id)
	{
		$filter = $this->_primary_filter;
		$id = $filter($id);
	
		if(!$id)
		{
			return FALSE;
		}
		$this->db->where($this->_primary_key,$id);
		$this->db->limit(1);
		$this->db->delete($this->_table_name);
	} 
	
 	public function delete_updateStatus($id)
	{
		$filter = $this->_primary_filter;
		$id = $filter($id);
	
		if(!$id)
		{
			return FALSE;
		}
		$this->db->set('status', '2');
		$this->db->where($this->_primary_key,$id);
		
		$this->db->update($this->_table_name);
	} 
	
	public function loggedin()
	{
		return (bool) $this->session->userdata('loggedin');
	}
	
	public function getMenu()
	{
		$query = $this->db->query('SELECT * FROM menu_details join role_access on menu_details.menu_id=role_access.menu_id and role_access.role_id='.$this->session->userdata('role_id').' and display = 1 order by main_name,sub_name');
		return $query->result_array();
	}
	
	public function checkAccess()
	{
	$query = $this->db->query('SELECT count(*) as count FROM role_access join menu_details on menu_details.menu_id= role_access.menu_id and role_access.role_id='.$this->session->userdata('role_id').' and menu_details.link like "'.explode("/", uri_string())[0].'%"');
		return $query->row()->count;
	}
	
	
}
