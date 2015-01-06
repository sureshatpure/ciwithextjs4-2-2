<?php

class Company extends CI_Controller 
{

	public $data = array();
	public $post = array();
	public  $proddata = array();
	public $leaddata = array();	
	function __construct()
	{
	 parent::__construct();
	 $this->load->database();
	 $this->load->helper('url');
	 $this->load->model('Company_model');
	}

	public function index()
	{
		echo"in customer index";
	}
	

	function addnewcustomer()
	{
	 $this->load->view('company/newcompany');
	}


	/*function savenewcompany()
	{
		if($this->input->post('savecustomer'))
		{
			$lead_id = $this->Company_model->GetNextMaxVal('leadid','leaddetails');
			$leadid = $lead_id+1; 
			$company_currval= $this->Company_model->GetNextMaxVal('temp_cust_id','tempcustomermaster');
			$company_nextid=$company_currval+1;

			$cust_syn_id = "TEMP".$company_nextid;
			$user_id 	= $this->input->post('hdn_userid');
				$companydetails = array(
				'temp_cust_sync_id' => $cust_syn_id,
				'temp_customername' => strtoupper($this->input->post('companyname')),
				'user_id' => $this->input->post('hdn_userid'),
				//'lead_id' => $leadid,			
				'creationdate' => date('Y-m-d h:i:s')
				);
			$id =$this->Company_model->save_company($companydetails);

			if ($id!="")
			{
				$data['body']="Company Added Sucessfully";
				$this->load->view('company/sucess_view',$data);
				//echo"done";
			}
			else
			{
				$data['body']="Please Try Again";
				$this->load->view('company/retry_view',$data);
				//echo"not done";
			}
			//redirect('leads');	

		}
	}*/

	function savenewcompany()
	{
		if($this->input->post('savecustomer'))
		{
			$lead_id = $this->Company_model->GetNextMaxVal('leadid','leaddetails');
			$leadid = $lead_id+1; 
			$company_currval= $this->Company_model->GetNextMaxVal('id','customermasterhdr');
			$temp_custid= $this->Company_model->GetNextTempCustIdMaxVal('tempcustid','customermasterhdr');

			$company_nextid=$company_currval+1;
			$temp_custid_nextid=$temp_custid+1;
			

			//$cust_syn_id = "TEMP".$company_nextid;
			$cust_ref_id = "TEMP/".$temp_custid;
			
			$user_id       = $this->input->post('hdn_userid');
				$companydetails = array(
				'id' => $company_nextid,
//			'tempcustid' => $temp_custid_nextid, changed on 21-Nov-2013
				'tempcustid' => $company_nextid,
				'customergroup' => strtoupper($this->input->post('companyname')),
				'tempcustname' => strtoupper($this->input->post('companyname')),
				'stdcode' => $temp_custid_nextid,
				'stdname' => strtoupper($this->input->post('companyname')),
				'companycode' => "PPC",
				'user1' => "ALL",
				'cust_ref_id' => $cust_ref_id ,
				'creation_date' => date('Y-m-d h:i:s'),
				'lead_customer'=>1
				);
			$id =$this->Company_model->save_company($companydetails);


			
			$customer_master_dtl = array(
				'id' => $company_nextid,
				'addresstypeid' => "AddressType-1"
				);
			       $id_dt =$this->Company_model->save_company_detail($customer_master_dtl);

			if ($id!="")
			{
				$data['body']="Company Added Sucessfully";
				$this->load->view('company/sucess_view',$data);
				//echo"done";
			}
			else
			{
				$data['body']="Please Try Again";
				$this->load->view('company/retry_view',$data);
				//echo"not done";
			}
			//redirect('leads');	

		}
	}

 	function check_customername()
	{
			if (@$_POST['action'] == 'check_companyname') 	
			{
		   $comp_n = strtoupper($_POST['company_name']);

			 $json_out = $this->check_companyname($comp_n);
	       echo json_encode($json_out);
				}
			else
			{
			 
			}
	}


  function company_exists($companyname)
  {
		 if($this->Company_model->CheckCompanyName($companyname))
			{
				return true;
			}

			else
			{
				return false;
			}
	}


  function check_companyname($companyname) 
	{
		//echo"return value".$this->validate_username($companyname); die;
		$companyname = trim($companyname); // strip any white space
		$response = array(); // our response

			if (!$companyname) 
			{

		  $response = array(
		    'ok' => false, 
		    'msg' => "Please specify a Customer Name");
		// if the companyname does not match a-z or '.', '-', '_' then it's not valid
			} 
			//else if (!preg_match('/^[a-z0-9.-_() ]+$/i', $companyname)) 
			//else if (!preg_match('!^[\w @.-]*$!', $companyname)) 
			//else if (preg_match('/[^-_@. 0-9A-Za-z]/', $companyname)) 
			//else if (!preg_match('/[^a-z\d\.\s]/i', $companyname))  // disallow all symbols except .
			else if (!$this->validate_username($companyname))
			{
		  	 
			$response = array(
		    'ok' => false, 
		    'msg' => "Your Customer Name can only contain alphanumerics and period, dash and underscore ._");
		    
		// this would live in an external library just to check if the companyname is taken
			} else if ($this->company_exists($companyname))
		 	{
		  $response = array(
		    'ok' => false, 
		    'msg' => "<font color=red>Customer Name already exists</font>");
		// it's all good
			} else {  
		  $response = array(
		    'ok' => true, 
		    'msg' => "<font color=green>Yes..!You can add this customer</font>");
			}
		return $response;        
	}	

		
		function validate_username($str) 
		{
			//echo "str ".$str;
		    //$allowed = array(".", "-", "_", "@", " "); // you can add here more value, you want to allow.
		    $allowed = array("-", "_", "@", " "); // you can add here more value, you want to allow.
		    $allowed = array("-", " "); // you can add here more value, you want to allow.
		    if(ctype_alnum(str_replace($allowed, '', $str ))) 
		    {
		       // return $str;
		    	 return 1;
		    } else {
		      //  $str = "Invalid Username";
		       // return $str;
		        return 0;
		    }
		}


}
?>
