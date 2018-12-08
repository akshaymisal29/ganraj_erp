<?php 
class Category_m extends MY_Model
{
	protected $_table_name = 'category';
	protected $_primary_key = 'cat_id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $_rules = array(
			'cat_name' => array(
					'field' => 'cat_name',
					'label' => 'Category Name',
					'rules' => 'trim|required|is_unique[category.cat_name]'
			)
			
		);
		
		
		public $_rules1 = array(
			'cat_name' => array(
					'field' => 'cat_name',
					'label' => 'Category Name',
					'rules' => 'trim|required'
			)
			
		);
	
	protected $_timestamp = TRUE;
	
	
	public function getcategorylike($name)
	{
		$json = array();
		if(!empty($name))
		{
			$query = $this->db->query('SELECT cat_id as id,cat_name as text FROM category WHERE cat_name like "%'.$name.'%" and status = 1 ORDER by cat_name limit 10');
			
			$json     = $query->result();
			$jsonarry = json_encode($json);
			return json_encode($json);
		}
	}
	
	
	public function newCategory()
	{
		return $this->save_temp_category($this->input->post('other_category'));
	}
	
	public function save_temp_category($categoryname)
	{
		$save_data=	array(
				'cat_name' 			=> $categoryname,
				'status'			=> 1
		);
		return $this->save($save_data);
	}

	public function getCategory()
	{
		$cat_data= array();
		$categories= $this->category_m->getcat();
		
		foreach ($categories as $category)
		{
			$cat_data[$category->cat_id] = $category->cat_name;
		}
		return $cat_data;
	}
	
	public function getcat()
	{
		$query = $this->db->query('SELECT cat_id,cat_name FROM category WHERE status = 1 ORDER by cat_name');
		return $query->result();
	}
	
	
	public function get_cat_name($id)
	{
		$this->db->select('cat_name');
		$this->db->where('cat_id',$id);
	   
		$query = $this->db->get($this->_table_name);
		
		if($query->num_rows() > 0)		 	
		{
			return $query->row('cat_name');
		}
		else
		{
			return false;	
		}
		
	}
	
	public function check_cat($name,$id)
	{
		$where = " cat_id !='".$id."' and cat_name ='".$name."'";
		
		$this->db->where($where);
		$query = $this->db->get($this->_table_name);
		if ($query->num_rows() > 0)
		{
			echo "error";
			
		}
		else
		{
			echo "success";
			
		}
	}

	
	
	
}



?>