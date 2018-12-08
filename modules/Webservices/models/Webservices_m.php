<?php

class Webservices_m extends MY_Model
{
	
	public function checkLogin($username,$password)
	{
			$query = $this->db->query("select ld.user_id from login_master ld where ld.username='".$username."' and ld.password='".$password."' AND ld.status=1");
			$result=$query->row();
			
			if(!empty($result))				
				return $result->user_id;
			else
				return -1;
	}
	
	public function getUserDetails($user_id)
	{
		//print_r("SELECT lm.user_id, lm.company_id, ifnull((Select company_name from company_master where company_id=lm.company_id),"-") as company_name from login_master lm where lm.user_id=".$user_id);exit;
		$query = $this->db->query('SELECT lm.user_id, lm.company_id, ifnull((Select company_name from company_master where company_id=lm.company_id),"-") as company_name from login_master lm where lm.user_id='.$user_id);
		$result=$query->row();
		if(!empty($result))
		{
			return $result;
		}
		else
		{
			return "";
		}
	}
	
	public function getCustomers($company_id)
	{
	
		$query = $this->db->query("SELECT * FROM customer_master WHERE status=1 and company_id=".$company_id);
		return $query->result();
	}
	
	public function generateBillno($company_id)
	{
	
		$query = $this->db->query('SELECT COUNT(b.bill_id)+1 as bill_id, ifnull((SELECT cm.company_name FROM company_master cm where cm.company_id='.$company_id.'),"-") as company_name from bill_master b where b.company_id='.$company_id);
		return $query->row();
	}
	
	public function saveCustomerData($data,$login_id)
	{
	
		$date = date_default_timezone_set('Asia/Kolkata');
		$now= date('Y-m-d H:i:s');
		$now1 =date('Y-m-d');
		$time =date('H:i:s');
	
		$data1=array(
				"created_by"=>$login_id,
				"created_date"=>$now,
				"status"=>1,
				"updated_by"=>$login_id,
				"updated_date"=>$now,
				"company_id"=>$data['company_id'],
				"customer_name"=>$data['customer_name'],
				"mobile_number"=>$data['mobile_number']
			
	
		);
			
		$this->db->insert('customer_master', $data1);
		return $this->db->insert_id();
	
	}
	
	public function saveBillingData($data,$login_id,$customer_id)
	{
	
		$date = date_default_timezone_set('Asia/Kolkata');
		$now= date('Y-m-d H:i:s');
		$now1 =date('Y-m-d');
		$time =date('H:i:s');
		$filename="";
		if($data['img_path']!="")
		{
			$filename = $this->do_upload($data['img_path'],$customer_id);
		}
		else
		{
			$filename="";
		}
		
	//	$row = $this->generateBillno($data['company_id']);
	//	$bill_no = $row->company_name."-".$row->bill_id;
		
		$data1=array(
				"created_by"=>$login_id,
				"created_date"=>$now,
				"status"=>1,
				"updated_by"=>$login_id,
				"updated_date"=>$now,
				"bill_no"=>$data['bill_no'],
				"company_id"=>$data['company_id'],
				"customer_id"=>$customer_id,
				"product_code"=>$data['product_code'],
				"bill_date"=>$data['bill_date'],
				"delivery_date"=>$data['delivery_date'],
				"bill_amount"=>$data['bill_amount'],
				"paid_amount"=>$data['paid_amount'],
				"img_path"=>$filename
	
		);
			
		$this->db->insert('bill_master', $data1);
		$bill_id = $this->db->insert_id();
		
		/*if($bill_id>0)
		{
			$data2=array(
					"created_by"=>$login_id,
					"created_date"=>$now,
					"status"=>1,
					"updated_by"=>$login_id,
					"updated_date"=>$now,
					"bill_id	"=>$bill_id,
					"company_id"=>$data['company_id'],
					"customer_id"=>$customer_id,
					"transaction_date"=>$now,
					"paid_amount"=>$data['paid_amount']
			);
				
			$this->db->insert('transaction_master', $data2);
			return $this->db->insert_id();
		}*/
		
			return array($bill_id,$filename);
		
	
	}
	
	
	
	
	
	public function saveTransactionData($data,$login_id)
	{
	
		$date = date_default_timezone_set('Asia/Kolkata');
		$now= date('Y-m-d H:i:s');
		$now1 =date('Y-m-d');
		$time =date('H:i:s');
			
		$data2=array(
					"created_by"=>$login_id,
					"created_date"=>$now,
					"status"=>1,
					"updated_by"=>$login_id,
					"updated_date"=>$now,
					"bill_id	"=>$data['bill_id'],
					"company_id"=>$data['company_id'],
					"customer_id"=>$data['customer_id'],
					"transaction_date"=>$now,
					"paid_amount"=>$data['paid_amount']
			);
				
		$this->db->insert('transaction_master', $data2);
		$trans_id=$this->db->insert_id();
		if($trans_id>0)
		{
			
			$data1=array(
				"status"=>2,
				"updated_date"=>$now,
				"updated_by"=>$login_id,
			);
			$this->db->where('bill_id',$data['bill_id']);
			$this->db->update('bill_master',$data1);
			return 1;
		}
		else
		{
			return 0;
		}
	
	
	}
	
	
	public function getBookingsByNumber($company_id,$bill_no)
	{
		$query = $this->db->query("SELECT cm.customer_id, cm.customer_name,cm.mobile_number, bm.bill_no, bm.product_code, bm.bill_id,
				 bm.paid_amount, bm.bill_amount, bm.delivery_date, bm.bill_date, bm.img_path from 
customer_master cm, bill_master bm WHERE cm.customer_id=bm.customer_id AND bm.status=1 and  bm.bill_no='".$bill_no."' AND cm.company_id=".$company_id);
		return $query->result();
	}
	
	public function getBookingsByName($company_id,$customer_name)
	{
		$query = $this->db->query("SELECT cm.customer_id, cm.customer_name,cm.mobile_number, bm.bill_no, bm.product_code, bm.bill_id,
 bm.paid_amount, bm.bill_amount, bm.delivery_date, bm.bill_date, bm.img_path from
customer_master cm, bill_master bm WHERE cm.customer_id=bm.customer_id AND bm.status=1 and cm.customer_name LIKE '".$customer_name."' AND cm.company_id=".$company_id);
		return $query->result();
	}
	
	public function getBookingsByMobNumber($company_id,$mobile_number)
	{
		$query = $this->db->query("SELECT cm.customer_id, cm.customer_name,cm.mobile_number, bm.bill_no, bm.product_code, bm.bill_id,
 bm.paid_amount, bm.bill_amount, bm.delivery_date, bm.bill_date, bm.img_path from
customer_master cm, bill_master bm WHERE cm.customer_id=bm.customer_id AND bm.status=1 and cm.mobile_number='".$mobile_number."' AND cm.company_id=".$company_id);
		return $query->result();
	}
	
	public function getBookingsByTrackingId($company_id,$bill_id)
	{
		$query = $this->db->query("SELECT cm.customer_id, cm.customer_name,cm.mobile_number, bm.bill_no, bm.product_code, bm.bill_id,
 bm.paid_amount, bm.bill_amount, bm.delivery_date, bm.bill_date, bm.img_path from
customer_master cm, bill_master bm WHERE cm.customer_id=bm.customer_id AND bm.status=1 and bm.bill_id=".$bill_id." AND cm.company_id=".$company_id);
		return $query->result();
	}
	
	public function getDeliveryReport($from_date,$to_date,$company_id)
	{
		$query = $this->db->query("select customer_master.customer_name,customer_master.mobile_number,bill_master.product_code,bill_master.bill_date,bill_master.bill_no,bill_master.bill_amount, bill_master.paid_amount,bill_master.status,bill_master.img_path,bill_master.delivery_date,ifnull((select sum(transaction_master.paid_amount) from transaction_master where transaction_master.bill_id=bill_master.bill_id),0) as paid2 FROM customer_master,bill_master where customer_master.customer_id=bill_master.customer_id and bill_master.company_id=".$company_id." and bill_master.bill_date >= '".$from_date."' and bill_master.bill_date <= '".$to_date."'");
		return $query->result();
	}
	public function getDashboard($company_id)
	{
		$query=$this->db->query("select ifnull((SELECT COUNT(*) from bill_master where company_id=".$company_id."),0) as bookings,ifnull((select COUNT(*) from bill_master WHERE company_id=".$company_id." and status=2),0) as delivered,'a' from dual");
		return $query->result();
	}
	public function getSenderId($company_id)
	{
		$query=$this->db->query("select sender_id,company_name,mobile_number from company_master where sms_flag=1 and company_id=".$company_id);
		return $query->result();	
	}
	public function do_upload($img,$id) {
		$this->load->helper('file');
	
		$filename ='';
		$pathtoupload = 'uploads/';
		if($img!=NULL)
		{
		
	
			$filename = $id.'_'.md5(time()).'.png';
			$base=$img;
			$binary = base64_decode($base);
			if ( ! write_file(FCPATH.$pathtoupload.$filename, $binary))
			{
				return 'Unable to write the file';
			}
			else
			{
				return $filename;
			}
		}
		return $filename;
	}
	
	
	
	//function to send notifications
	public function sendNotification($user_id,$body,$title)
	{
		$query = $this->db->query("select device_id from device_details where user_id=".$user_id." and status=1 limit 1");
		
			$result=$query->row();
			
			//
			if(!empty($result))				
			{
				$date = date_default_timezone_set('Asia/Kolkata');
				$now= date('Y-m-d H:i:s');
				$device_id=$result->device_id;
			
				//$api_key='AAAA5o05i6Q:APA91bFB1G8Rzt0XeB5n9cXPBlK5_frVsVl_H1zV7uqLuLiiHfyUg83Oxow0i_bRZLstF_2QBOQQe6040pv2GK-BeJU0Iss-ukIy3Ugi21IA9JNZWh2yAzMrSpCMiUG4usL9qds4DJXZ';
				$api_key = 'AAAA7n5WvVY:APA91bFKSvfol6MgRFQtpMhX7SqXm22DxUt-tm6rtFKHrEMAOji3Y_KRkgKWqWAm2AhQiy_HVXTncmXYP58QB7jqlWDCAWI5xs0M69zR7sEac07-Sr_8wtAL5V-R1BSY0OA9GG_wMk_P';
				#prep the bundle
				$msg = array
				(
				'body' 	=> $body,
				'title'	=> $title,
				'todays_date' => $now."",
			//			'icon'	=> 'myicon',/*Default Icon*/
				'sound' => 'default'/*Default sound*/
				);
				$registrationIds = $device_id;
				$fields = array
				(
					'to'		=> $registrationIds,
					'data' => $msg,
					'notification'	=> $msg
				);
				
				
				$headers = array
				(
					'Authorization: key=' . $api_key,
					'Content-Type: application/json'
				);
				#Send Reponse To FireBase Server	
				$ch = curl_init();
				curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
				curl_setopt( $ch,CURLOPT_POST, true );
				curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
				curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
				curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
				curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
				$result = curl_exec($ch );
				curl_close( $ch );
					
				return "success";
			}
			else
				return "error";
	}
}