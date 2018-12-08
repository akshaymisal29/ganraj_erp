<?php

class Webservices1_m extends MY_Model
{
	public function saveSampleData($data)
	{
	
		$date = date_default_timezone_set('Asia/Kolkata');
		$now= date('Y-m-d H:i:s');
		$now1 =date('Y-m-d');
		$time =date('H:i:s');
			
		$data2=array(
					
					"created_date"=>$now,
					"sample_data"=>$data['sample_data']
			);
				
		$this->db->insert('sample_table', $data2);
		return $this->db->insert_id();
	}
	
	public function checkLogin($userid,$userpassword)
	{
		$query = $this->db->query("SELECT count(*) as count FROM siddhisugar_login where user_name = '".$userid."' and password = '".$userpassword."' and status = 1 ");
		$row =$query->row();
		if($row->count==1)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}
	
	public function getSampleData()
	{
		
		$query = $this->db->query("SELECT * FROM sample_table order by id desc limit 1");
		return $query->row();
	}

	public function getModules($inputdata)
	{
		$module = [];
		//if(isset($inputdata['username']) && isset($inputdata['password'])  )
		{
			//$query = $this->db->query("select m.module_id from siddhisugar_usermodule_map m, siddhisugar_login u, siddhisugar_modules dm where u.USER_NAME = '".$inputdata['username']."' and u.PASSWORD = '".$inputdata['password']."' and m.user_id = u.user_id and m.module_id = dm.module_id and dm.status = '1'");
			$query = $this->db->query("select m.module_id from siddhisugar_usermodule_map m, siddhisugar_login u, siddhisugar_modules dm where m.user_id = u.user_id and m.module_id = dm.module_id and dm.status = '1'");
			
			$i= 0;
			foreach ($query->result() as $row)
			{
					$module[$i] = $row->module_id;
					$i++;
			}
		}
        return $module;

	}

	
	public function deleteSampleData($id)
	{
		$query = $this->db->query("Delete FROM sample_table where id < ".$id);
	}
	
}