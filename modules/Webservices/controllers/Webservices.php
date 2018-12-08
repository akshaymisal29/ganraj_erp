<?php

class Webservices extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Webservices_m');
		$date = date_default_timezone_set('Asia/Kolkata');
	}
	
	function index($start=0)
	{
		
	}
	function wsLogin()
	{
		
		$decoded_postdata = json_decode(file_get_contents('php://input'), true);
        if ((json_last_error() == JSON_ERROR_NONE))
        {    
			$_POST = $decoded_postdata;
			
			
			$msg="";
			$login=array();
			$data=array();
			$status="";
			 
			$user_id=$this->Webservices_m->checkLogin($_POST['username'],$_POST['password']);
			
			if($user_id==-1)
			{
				$msg="Login Failed";
				$data=array();
			    $status="error";
			}
			else
			{
				$result=$this->Webservices_m->getUserDetails($user_id);
				
				if(!empty($result))
				{
										
					$login=array(
						"user_id"=> intval($result->user_id),
						"company_name"=> $result->company_name,
						"company_id"=> intval($result->company_id),
						"date"=> date('Y-m-d'),
						"username"=> $_POST['username'],
						"password"=> $_POST['password']
							);
				
				}
				
				$msg="Login Success";
				$status="success";
			}
			$data=array("login"=>$login);
			$result=array("msg"=>$msg,"data"=>$data,"status"=>$status);
			print_r(json_encode($result));
		}
		
	
	}
	
	function wsGetCustomers()
	{
		
		$decoded_postdata = json_decode(file_get_contents('php://input'), true);
		if ((json_last_error() == JSON_ERROR_NONE))
		{
			
			$_POST = $decoded_postdata;
			$msg="";
			$login=array();
			$data=array();
			$status="";
			$user_id=$this->Webservices_m->checkLogin($_POST['username'],$_POST['password']);
			
			if($user_id==-1)
			{
				$msg="Customer load failed";
				$status="Error";
			}
			else
			{
				$result=$this->Webservices_m->getCustomers($_POST['company_id']);
				
				$string="";
				if (!empty($result))
					{
					foreach($result as $row)
					{
						$string = $string . "(".$row->customer_id.", '".$row->customer_name."', '".$row->mobile_number."'),";
					}
	
					$string=rtrim($string,',');
				}
				$data=array("values"=>$string);
				$msg="Customer load successfully";
				$status="success";
			}
			$result=array("msg"=>$msg,"data"=>$data,"status"=>$status);
			print_r(json_encode($result));
		}
	}
	
	
	
	function wsSaveBillingMaster()
	{
		$time =date('H:i:s');
		$decoded_postdata = json_decode(file_get_contents('php://input'), true);
		//echo "wsSaveBillingMaster";
		if ((json_last_error() == JSON_ERROR_NONE))
		{
			$_POST = $decoded_postdata;
			//echo "wsSaveBillingMaster";
			//print_r($_POST);;exit;
			$msg="Details Added Successfully";
			$status="success";
				
			$user_id=$this->Webservices_m->checkLogin($_POST['username'],$_POST['password']);
			if($user_id==-1)
			{
				$msg="Login Failed";
				$status="Error";
			}
			else
			{
				$customer_id=$this->Webservices_m->saveCustomerData($_POST,$user_id);
				if($customer_id>0)
				{
					$result = $this->Webservices_m->saveBillingData($_POST,$user_id,$customer_id);
					$bill_id=$result[0];
					$image_path="http://patil.miraclenx.com/uploads/".$result[1];
					if($result[0]<=0)
					{
						$msg="Details not Updated";
						$status="Error";
					
					}
					else
					{
						$msg="Details Added Successfully";
						$status = "success";
						try{
							//trying to send sms
							$result=$this->Webservices_m->getSenderId($_POST['company_id']);
							if (!empty($result))
							{
								$senderId="";
								$company_name="";
								$company_number="";
							foreach($result as $row)
							{
								$senderId = $row->sender_id;
								$company_name=$row->company_name;
								$company_number=$row->mobile_number;
							}
							//echo $senderId;
								if($senderId!="" && $company_name!="")
								{
									$mobile=$_POST['mobile_number'];
									$xml_data ='<?xml version="1.0"?>
<parent>
<child>
<user>Soft71</user>
<key>b10a4f73a0XX</key>
<mobile>+91'.$mobile.'</mobile>
<message>'.$company_name.' मध्ये गणपती बाप्पाचे बुकिंग केल्या बद्दल खुप धन्यवाद
तुमचा बुकिंग नंबर: '.$_POST['bill_no'].'
एकूण किंमत: '.$_POST['bill_amount'].'
जमा रक्कम: '.$_POST['paid_amount'].'
बाकी रक्कम: '.($_POST['bill_amount'] - $_POST['paid_amount']).'
ट्रॅकिंग नं :'.$bill_id.'
गणपती फोटो:'.$image_path.'
तुमचा विश्वासू‚
'.$company_name.'['.$company_number.']</message>
<accusage>1</accusage>
<senderid>'.$senderId.'</senderid>
<unicode>1</unicode>
</child>
</parent>';
//echo $xml_data;

$URL = "http://msg.softtantra.com/submitsms.jsp?"; 

			$ch = curl_init($URL);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_ENCODING, 'UTF-8');
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
			curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$output = curl_exec($ch);
			curl_close($ch);

//print_r($output); exit;
								}
							}
								
						}
						catch(Exeception $e)
						{
							//echo "error in sms".$e;
						}
					}
				}
				else 
				{
					$msg="Details not Added";
					$status="Error";
				}
			}
			$result=array("msg"=>$msg,"status"=>$status);
			print_r(json_encode($result));
		}
	}
	
	
	
	
	function wsSaveTransaction()
	{
		$time =date('H:i:s');
		$decoded_postdata = json_decode(file_get_contents('php://input'), true);
		if ((json_last_error() == JSON_ERROR_NONE))
		{
			$_POST = $decoded_postdata;
	
			$msg="Details Added Successfully";
			$status="success";
				
			$user_id=$this->Webservices_m->checkLogin($_POST['username'],$_POST['password']);
			if($user_id==-1)
			{
				$msg="Login Failed";
				$status="Error";
			}
			else
			{
				$trans_id=$this->Webservices_m->saveTransactionData($_POST,$user_id);
				if($trans_id>0)
				{
						$msg="Details Updated";
						$status="Success";
				}
				else 
				{
					$msg="Details not Added";
					$status="Error";
				}
			}
			$result=array("msg"=>$msg,"status"=>$status);
			print_r(json_encode($result));
		}
	}
	
	function wsGetBookings()
	{
	
		$decoded_postdata = json_decode(file_get_contents('php://input'), true);
		if ((json_last_error() == JSON_ERROR_NONE))
		{
				
			$_POST = $decoded_postdata;
			$msg="";
			$login=array();
			$data=array();
			$status="";
			$user_id=$this->Webservices_m->checkLogin($_POST['username'],$_POST['password']);
				
			if($user_id==-1)
			{
				$msg="Booking load failed";
				$status="Error";
			}
			else
			{
				if($_POST['bill_no']!="")
				{
					$result=$this->Webservices_m->getBookingsByNumber($_POST['company_id'],$_POST['bill_no']);
				}
				else if($_POST['customer_name']!="")
				{
					$result=$this->Webservices_m->getBookingsByName($_POST['company_id'],$_POST['customer_name']);
				}
				else if($_POST['mobile_number']!="")
				{
					$result=$this->Webservices_m->getBookingsByMobNumber($_POST['company_id'],$_POST['mobile_number']);
				}
				else 
				{
					$result=$this->Webservices_m->getBookingsByTrackingId($_POST['company_id'],$_POST['tracking_id']);
				}
	
				$string="";
				if (!empty($result))
				{
					foreach($result as $row)
					{
						$pending_amount = $row->bill_amount - $row->paid_amount;
						$string = $string . "(".$row->customer_id.", '".$row->customer_name."', '".$row->mobile_number."', '".$row->bill_no."', '".$row->product_code."', ".$row->bill_id.", '".$row->paid_amount."', '".$row->bill_amount."', '".$row->delivery_date."', '".$row->bill_date."', '".$row->img_path."',".$pending_amount."),";
					}
	
					$string=rtrim($string,',');
				}
				
				$data=array("values"=>$string);
				$msg="Customer load successfully";
				$status="success";
			}
			$result=array("msg"=>$msg,"data"=>$data,"status"=>$status);
			print_r(json_encode($result));
		}
	}
	
	//dashboard
	function wsGetDashboard()
	{
		$decoded_postdata = json_decode(file_get_contents('php://input'), true);
		if ((json_last_error() == JSON_ERROR_NONE))
		{
				
			$_POST = $decoded_postdata;
			$msg="";
			$login=array();
			$data=array();
			$status="";
			$user_id=$this->Webservices_m->checkLogin($_POST['username'],$_POST['password']);
				
			if($user_id==-1)
			{
				$msg="Loading failed";
				$status="Error";
			}
			else
			{
				if($_POST['company_id']!="")
				{
					$result=$this->Webservices_m->getDashboard($_POST['company_id']);
				}
				$booking="";
				$delivered="";
				if (!empty($result))
				{
					foreach($result as $row)
					{
						
						$booking=$row->bookings;
						$delivered=$row->delivered;
					}
	
					//$string=rtrim($string,',');
				}
				
				$data=array("booking"=>$booking,"delivered"=>$delivered);
				$msg="Dashboard Report load successfully";
				$status="success";
			}
			$result=array("msg"=>$msg,"data"=>$data,"status"=>$status);
			print_r(json_encode($result));
		}
	}
	
	//delivery report 
	function wsGetDeliveryReport()
	{
	
		$decoded_postdata = json_decode(file_get_contents('php://input'), true);
		if ((json_last_error() == JSON_ERROR_NONE))
		{
				
			$_POST = $decoded_postdata;
			$msg="";
			$login=array();
			$data=array();
			$status="";
			$user_id=$this->Webservices_m->checkLogin($_POST['username'],$_POST['password']);
				
			if($user_id==-1)
			{
				$msg="Loading failed";
				$status="Error";
			}
			else
			{
				if($_POST['from_date']!="" && $_POST['to_date']!="" && $_POST['company_id']!="")
				{
					$result=$this->Webservices_m->getDeliveryReport($_POST['from_date'],$_POST['to_date'],$_POST['company_id']);
				}
				$string="";
				if (!empty($result))
				{
					foreach($result as $row)
					{
						$paid_amount = $row->bill_amount - ($row->paid_amount + $row->paid2);
						$string = $string . "('".$row->customer_name."', '".$row->mobile_number."', '".$row->bill_no."', '".$row->product_code."','".$row->bill_amount."','".$paid_amount."','".$row->bill_date."', '".$row->delivery_date."', '".$row->img_path."','".$row->status."'),";
					}
	
					$string=rtrim($string,',');
				}
				
				$data=array("values"=>$string);
				$msg="Delivery Report load successfully";
				$status="success";
			}
			$result=array("msg"=>$msg,"data"=>$data,"status"=>$status);
			print_r(json_encode($result));
		}
	}
	
		
}
