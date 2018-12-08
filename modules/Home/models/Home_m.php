<?php

class Home_m extends MY_Model
{
	protected $_table_name = 'users';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $_rules = array();
	protected $_timestamp = FALSE;
	
	public $_rules1 = array(
	
			'curr_pass' => array(
					'field' => 'curr_pass',
					'label' => 'Current Password',
					'rules' => 'trim|required|min_length[5]'
			),
			'pass' => array(
					'field' => 'pass',
					'label' => 'New Password',
					'rules' => 'trim|required|min_length[5]'
			),
			'cpass' => array(
					'field' => 'cpass',
					'label' => 'Confirm Password',
					'rules' => 'trim|required|min_length[5]|matches[pass]'
			)
	);
	
	public function get_user()
	{
		$this->load->model('User/User_m');
		$user=$this->User_m->get($this->session->userdata('id'));
	}
	
	public function update_password()
	{
		$this->load->model('Login/Login_m');
		return $this->Login_m->update_password();
	
	}
	
	public function get_result()
	{
		
		
			$query = $this->db->query('select sm.product_id ,SUM(sm.quantity) as quantity, pd.product_name,un.unit_name,pd.product_code,pd.min_stock_limit  from stock_master as sm, product as pd, unit as un
where sm.product_id=pd.product_id
and pd.unit=un.unit_id AND pd.status =1
group by product_id');
		
		return $query->result();
	
	}
	
	function getMachine($id)
	{
		$query = $this->db->query('SELECT mm.machine_name,mm.type_master_id,mm.machine_master_id,mm.vehicle_number,(SELECT lbm.log_book_date FROM log_book_master AS lbm WHERE lbm.log_book_date="'.$id.'" AND lbm.machine_id=mm.machine_master_id) as dt FROM machine_master AS mm');
		
		return $query->result();
	}
	
	function getWorkCount($date1)
	{
		$query = $this->db->query('SELECT (SELECT COUNT(*) FROM log_book_master AS lb1 WHERE lb1.entry_type=1 AND lb1.log_book_date="'.$date1.'") as work_count,(SELECT COUNT(*) FROM log_book_master AS lb1 WHERE lb1.entry_type=2 AND lb1.log_book_date="'.$date1.'") AS non_work_count');
	
		return $query->row();
	}
	
	function  getWorkingCount($date1)
	{
		$query = $this->db->query('SELECT machine_id,(SELECT type_master_id FROM machine_master WHERE lbm.machine_id = machine_master_id) as type FROM log_book_master as lbm WHERE entry_type=1 AND log_book_date="'.$date1.'"');
		
		return $query->result();
	}
	function getMaintainance($date1)
	{
		$query = $this->db->query('select sm.maintainance_id,pd.maintainance_option,COUNT(sm.maintainance_id) as cnt  from log_book_master as sm, maintainance as pd
where sm.maintainance_id=pd.maintainance_id and log_book_date="'.$date1.'"
group by maintainance_id');
		
		return $query->result();
	}
	
	function get_current_details()
	{
		$query = $this->db->query('Select machine_master_id,machine_name,vehicle_number,expected_average_min,expected_average_max,ifnull((select average from machine_average_master where vehicle_id=machine_master.machine_master_id order by average_id desc limit 1),0) as average,(select created from machine_average_master where vehicle_id=machine_master.machine_master_id order by average_id desc limit 1) as created from machine_master where status=1');
	
		return $query->result();
	}
	
	function approval_status()
	{
		$query = $this->db->query('select users.name,ifnull((select count(*) from oil_diesel_issue_master where approver_id=users.id and status=1),0) as oil_count,ifnull((select count(*) from material_issue_master where approver_id=users.id and approve_status=1),0) as issue_count,ifnull((select count(*) from supply_slip_master where approver_id=users.id and approve_status=1),0) as supply_count,ifnull((select count(*) from log_book_master where (incharge_id=users.id OR engineer_id=users.id) and status=2),0) as log_count from users');
	
		return $query->result();
	}
	
	function vehicle_graph($vehicle_id)
	{
		$query = $this->db->query('select machine_average_master.average,machine_average_master.created,ifnull((select  machine_name from machine_master where machine_master_id=machine_average_master.vehicle_id ),0) as vehicle_name,ifnull((select expected_average_min from machine_master where machine_master_id=machine_average_master.vehicle_id ),0) as expected_average_min,ifnull((select  expected_average_max from machine_master where machine_master_id=machine_average_master.vehicle_id ),0) as expected_average_max from machine_average_master WHERE vehicle_id='.$vehicle_id.' ORDER BY average_id DESC LIMIT 6');
	
		return $query->result();
	}
	
	function receiptCount1($id)
	{
		$query = $this->db->query('SELECT actual_quantity FROM supply_slip_details WHERE product_id='.$id.' ORDER BY supply_slip_details_id DESC LIMIT 10');
	
		return $query->result();
	}
	
	function issueCount1($id)
	{
		$query = $this->db->query('SELECT qty FROM material_issue_details WHERE product_id='.$id.' ORDER BY material_issue_details_id DESC LIMIT 10');
	
		return $query->result();
	}
	function issueCount($id)
	{
		$query = $this->db->query('select machine_average_master.average,machine_average_master.created,ifnull((select  machine_name from machine_master where machine_master_id=machine_average_master.vehicle_id ),0) as vehicle_name,ifnull((select expected_average_min from machine_master where machine_master_id=machine_average_master.vehicle_id ),0) as expected_average_min,ifnull((select  expected_average_max from machine_master where machine_master_id=machine_average_master.vehicle_id ),0) as expected_average_max from machine_average_master WHERE vehicle_id='.$vehicle_id.' ORDER BY average_id DESC LIMIT 6');
	
		return $query->result();
	}
	function highest_moving()
	{
		$query = $this->db->query('select product.product_name,product.product_code,ifnull((select  count(*) from stock_master where product_id=product.product_id ),0) as material_count from product ORDER BY material_count DESC LIMIT 8');
	
		return $query->result();
	}
	function less_moving()
	{
		$query = $this->db->query('select product.product_name,product.product_code,ifnull((select  count(*) from stock_master where product_id=product.product_id ),0) as material_count from product ORDER BY material_count LIMIT 8');
	
		return $query->result();
	}
}