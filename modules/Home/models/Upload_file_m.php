<?php

class Upload_file_m extends MY_Model
{
	protected $_table_name = 'uploaded_files';
	protected $_primary_key = 'file_id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	public $_rules = array();
	protected $_timestamp = TRUE;


public function update_status_tab($id,$value)
{
	$save_data=	array(
		'status' =>$value
	);
	$this->save($save_data,$id);
}

function delete_upload($file_id)
{
		$status = 'error';
		if(null!=$file_id)
		{//$_POST()
			$value= $this->get($file_id);
			if(null!=$value)
			{
				unlink("./uploads/".$value->server_file_name);
				$this->delete($file_id);
				return 1;
			}
		}
		return 0;
}

}
