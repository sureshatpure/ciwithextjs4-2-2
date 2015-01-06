<?php

class dailycall_model extends CI_Model
{
	public $country_id = null;
	public $i, $j;
	public $reporting_user = array();
	public $reporting_user_id = array();
	public $user_list_id;
	public $reportingid;
	public $user_report_id;
	
	function __construct()
	{
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->database();
		$db_dc=$this->load->database('forms', TRUE);
		$this->load->helper('language');
	  	$this->load->library('subquery');
		$this->load->library('session');
    
	}

	
	 function get_customerinfo_for_grid()
	 {
	 		
	 		@$get_assign_to_user_id = $this->session->userdata['get_assign_to_user_id'];
	 		//echo "assigntoid is ".@$get_assign_to_user_id; die;
	 		if(@$get_assign_to_user_id!="")
	 		{
	 		$sql = "SELECT * FROM vw_daily_call_viewpage_pot_prod where assignleadchk IN  (".$get_assign_to_user_id.")  ORDER BY createddate desc ";	
	 		}
	 		else
	 		{
	 			$sql = "SELECT * FROM vw_daily_call_viewpage_pot_prod  ORDER BY createddate desc ";
	 		}
	 		
	 		//$sql = "SELECT * FROM vw_daily_call_viewpage  ORDER BY company desc limit 10";
	 		//echo $sql; die;
			$result = $this->db->query($sql);
			
			$customerdetails = $result->result_array();
			// echo"count of all leads ".count($customerdetails); die;
			$all_customer_count = count($customerdetails);
			$this->session->set_userdata('all_customer_count',$all_customer_count);
			//return $customerdetails;


			$jTableResult = array();
			$jTableResult['custleaddetails'] = $customerdetails;
			$data = array();
			$i=0;
			while($i < count($jTableResult['custleaddetails']))
			{    
			$row = array();
			$row["leadid"] = $jTableResult['custleaddetails'][$i]["leadid"];
			if($jTableResult['custleaddetails'][$i]["leadid"]==0)
			{
				 $cust_type='Existing';	
			}
			else
			{
				$cust_type='Lead';
			}
			if($jTableResult['custleaddetails'][$i]["customergroup"]=="")
			{
				 $cust_group=$jTableResult['custleaddetails'][$i]["tempcustname"];
			}
			else
			{
			 $cust_group=$jTableResult['custleaddetails'][$i]["customergroup"];	
			}
			
			

			$row["cust_type"] = $cust_type;
			$row["total_potential"] =$jTableResult['custleaddetails'][$i]["potential"];
			$row["total_requirement"] =$jTableResult['custleaddetails'][$i]["quantity"];
			$row["company"] = $jTableResult['custleaddetails'][$i]["company"];
			$row["user_branch"] = $jTableResult['custleaddetails'][$i]["user_branch"];
			$row["leadsource"] = $jTableResult['custleaddetails'][$i]["leadsource"];

			$cust_group=trim($cust_group);
     			$cust_group=html_entity_decode($cust_group);
     			$cust_group = str_replace("'", "", $cust_group);
			$row["customergroup"] = $cust_group;	

			$row["product_group"] = $jTableResult['custleaddetails'][$i]["product_group"];
			$row["tempcustname"] = $jTableResult['custleaddetails'][$i]["tempcustname"];
			$row["leadstatus"] = $jTableResult['custleaddetails'][$i]["leadstatus"];
			$row["leadsubstsname"] = $jTableResult['custleaddetails'][$i]["leadsubstsname"];
			$row["assignleadchk"] = $jTableResult['custleaddetails'][$i]["assignleadchk"];
			$row["assign_to_name"] = $jTableResult['custleaddetails'][$i]["assign_to_name"];

			$row["created_date"] = substr($jTableResult['custleaddetails'][$i]["createddate"],0,-8);
			$date_cr = new DateTime($row["created_date"]);
			//$row["created_date"]= $date_cr->format('d-m-Y');
			$row["created_date"]= $date_cr->format('Y-m-d');

			$row["last_modified"] = substr($jTableResult['custleaddetails'][$i]["last_modified"],0,-8);
			$date_cr = new DateTime($row["last_modified"]);
			//$row["last_modified"]= $date_cr->format('d-m-Y');
			$row["last_modified"]= $date_cr->format('Y-m-d');
			//$row["created_date"]="";
			//$row["last_modified"]="";

			
			//		$date_mf = new DateTime($row["modified_date"]);
			//		$row["modified_date"] = $date_mf->format('d-M-Y');
			

			$data[$i] = $row;
			$i++;
			}
			$arr = "{\"data\":" .json_encode($data). "}";
			//	echo "{ rows: ".$arr." }";
			return $arr;
	 }
			

	 function get_customername($customer_id)
	 {
	 	$this->db->select('customer_name,tempcustname','customergroup');
		$this->db->where('id', $customer_id); 
		$query = $this->db->get('customermasterhdr');
		$customer_name=$query->result();
		if($customer_name[0]->customer_name=="")
		{
			return $customer_name[0]->tempcustname;
		}
		else
		{
			return $customer_name[0]->customer_name;
		}
		

		//select customer_name from  where id =2546
	 }

	  function get_customergroup($customer_id)
	 {
	 	$this->db->select('customer_name,tempcustname,customergroup');
		$this->db->where('id', $customer_id); 
		$query = $this->db->get('customermasterhdr');
		$customergroup=$query->result();
		
		if($customergroup[0]->customergroup=="")
		{
			return $customergroup[0]->tempcustname;
		}
		else
		{
			return $customergroup[0]->customergroup;
		}
		

		//select customer_name from  where id =2546
	 }


	
	 function get_visittypename($ids)
	 {
	 	$sql="SELECT visit_id,visit_name FROM dailycall_visittype WHERE visit_id IN (".$ids.")";
		$result = $this->db->query($sql);
		$visitdetails = $result->result_array();		
		return $visitdetails;
		
			
	 }
	  function get_visittypenames($ids)
	 {
	 	$sql="SELECT visit_name FROM dailycall_visittype WHERE visit_id IN (".$ids.")";
		$result = $this->db->query($sql);
		$visitdetails = $result->result_array();	
		$record_count = count($visitdetails);
		$data = array();
		$visitnames="";
		$i=0;
		while($i < count($visitdetails))
		{    
			$data[$i] = $visitdetails[$i]["visit_name"];
			$i++;
		}
	
		return $data;
		
	 }

	function get_customergroup_old($customer_id)
	 {
	 	$this->db->select(' customergroup');
		$this->db->where('id', $customer_id); 
		$query = $this->db->get('customermasterhdr');
		$customer_name=$query->result();
		if($customer_name[0]->customergroup=="")
		{
			return $customer_name[0]->customergroup;
		}
		else
		{
			return $customer_name[0]->customergroup;
		}
		

		//select customer_name from  where id =2546
	 }
	 function GetUserBranch($user_id)
	 {
	 	
	 	$this->db->select('location_user');
		$this->db->where('header_user_id', $user_id); 
		$query = $this->db->get('vw_web_user_login');
		$customer_branch=$query->result();
		if($customer_branch[0]->location_user=="")
		{
			return strtoupper($customer_branch[0]->location_user);
		}
		else
		{
			return strtoupper($customer_branch[0]->location_user);
		}
		

		//select customer_name from  where id =2546
	 }

	 public function GetLdAddressDetails($customer_id)
		{
			
				/*$sql="SELECT customermasterdtl.city,customermasterdtl.country,customermasterdtl.state,customermasterdtl.postal_code as pobox, customermasterdtl.country,customermasterhdr.contact_no,customermasterdtl.address1 FROM customermasterhdr,customermasterdtl WHERE customermasterdtl.id=customermasterhdr.id and customermasterdtl.id=".$customer_id." AND customermasterdtl.addresstypeid='".$addrestype."'";*/

				$sql="select city,code,state,pobox,country,phone,mobile_no,fax,lane,leadaddresstype,street  FROM leadaddress WHERE leadaddressid=(SELECT min(leadid) FROM leaddetails where company=".$customer_id.")";
				//echo $sql; die;
				$result = $this->db->query($sql);
				$addressdetails= $result->result_array();
				
        			return $addressdetails[0];
       // print_r($ld_status);
		}

		 public function GetCustAddressDetails($customer_id)
		{
		
				$sql="SELECT city,'' as code, state,postal_code as pobox, country,'' as phone, '' as mobile_no,'' as fax, '' as lane, address1 as street from customermasterdtl where id =".$customer_id." and addresstypeid='AddressType-1'";
				//echo $sql; die;
				$result = $this->db->query($sql);
				$addressdetails= $result->result_array();
				
        			return $addressdetails[0];
       // print_r($ld_status);
		}

 		function GetCountryCode($country)
		{
				$sql="select id from country  WHERE upper(name)='".$country."'";
				//echo $sql; die;
				$result = $this->db->query($sql);
				$addressdetails= $result->result_array();
				//print_r($addressdetails); die;
        			return $addressdetails[0]['id'];
		
		}
		function GetStateCode($state)
		{
				$sql="select statecode from states where upper(statename) ='".$state."'";
				//echo $sql; die;
				$result = $this->db->query($sql);
				$addressdetails= $result->result_array();
				//print_r($addressdetails); die;
        			return $addressdetails[0]['statecode'];
		
		}




		function save_onedclead_products($leadproducts)
		{
			$this->db->insert('leadproducts', $leadproducts);
       	 return $this->db->insert_id();	
	
		}

	/* function get_customerid($customer_group)
	 {
	 	$this->db->select('id');
		$this->db->where('customergroup', $customer_group); 
		$query = $this->db->get('custosmermasterhdr');
		$customer_name=$query->result();
		print_r($customer_name); die;
		if($customer_name[0]->id=="")
		{
			return $customer_name[0]->id;
		}
		else
		{
			return $customer_name[0]->id;
		}
		

		//select customer_name from  where id =2546
	 }*/
	  function get_customerid($customer_group)
	 {
	 	 
	 	 $customer_group = html_entity_decode($customer_group);
	 	 $customer_group = str_replace("'", "", $customer_group);
	 	 $sql="select  id  from customermasterhdr where trim(REPLACE(customergroup,'''',''))   like '".trim($customer_group)."'";
	 	 //echo $sql; die;
		$result = $this->db->query($sql);

		$customer_name =$result->result_array();
		//print_r($customer_name); 
		if($customer_name['0']['id']=="")
		{
			return $customer_name['0']['id'];
		}
		else
		{
			return $customer_name['0']['id'];
		}
		

		//select customer_name from  where id =2546
	 }

	 
	   function get_customer_exename($customer_group)
		 {
			$customer_group = html_entity_decode($customer_group);
			$customer_group = str_replace("'", "", $customer_group);

			$sql="SELECT executivename FROM customermasterhdr WHERE trim(REPLACE(customergroup,'''','')) ='".trim($customer_group)."'  GROUP BY executivename";


			$result = $this->db->query($sql);
			$customer_name =$result->result_array();
			return $customer_name['0']['executivename'];
		}
		



	  function get_industryname($industry_id=0)
	 {
	 	$this->db->select('industrysegment');
		$this->db->where('id', $industry_id); 
		$query = $this->db->get('industry_segment');
		$industry_name=$query->result();
		return $industry_name[0]->industrysegment;

	 }

	  function get_countryname($country_id)
	 {
	 	$this->db->select('name');
		$this->db->where('id', $country_id); 
		$query = $this->db->get('country');
		$country_name=$query->result();
		return $country_name[0]->name;

	 }

	  function get_statename($state_id)
	 {
	 	$this->db->select('statename');
		$this->db->where('statecode', $state_id); 
		$query = $this->db->get('states');
		$states_name=$query->result();
		return $states_name[0]->statename;

	 }

	 

	 

	  function get_leadstatus($customer_id)
	 {
	 	$this->db->select('leadstatusid');
		$this->db->where('company', $customer_id); 
		$query = $this->db->get('vw_dc_lead_viewpage_pot_qnty');
		$status=$query->result();
		return $status[0]->leadstatusid;

		//select customer_name from  where id =2546
	 }

	  function get_leadsubstatus($customer_id)
	 {
	 	$this->db->select('leadsubstatusid');
		$this->db->where('company', $customer_id); 
		$query = $this->db->get('vw_dc_lead_viewpage_pot_qnty');
		$substatus=$query->result();
		return $substatus[0]->leadsubstatusid;

		//select customer_name from  where id =2546
	 }
	 function get_ld_leadstatus($leadid)
	 {
	 	$this->db->select('leadstatusid');
		$this->db->where('leadid', $leadid); 
		$query = $this->db->get('vw_dc_lead_viewpage_pot_qnty');
		$status=$query->result();
		return $status[0]->leadstatusid;

		//select customer_name from  where id =2546
	 }

	  function get_ld_leadsubstatus($leadid)
	 {
	 	$this->db->select('leadsubstatusid');
		$this->db->where('leadid', $leadid); 
		$query = $this->db->get('vw_dc_lead_viewpage_pot_qnty');
		$substatus=$query->result();
		return $substatus[0]->leadsubstatusid;

		//select customer_name from  where id =2546
	 }

	 function get_leadstatus_order($statusid)
	 {
	 	$this->db->select('order_by');
		$this->db->where('leadstatusid', $statusid); 
		$query = $this->db->get('leadstatus');
		$substatus=$query->result();
		return $substatus[0]->order_by;

	 }

	 function getdailycall_hdrid($customerid)
	 {
	 	$this->db->select('dch_header_id');
		$this->db->where('dch_customerid', $customerid); 
		$query = $this->db->get('dailycall_hdr');
		$dchdrid=$query->result();
		return $dchdrid[0]->dch_header_id;
	 }

	 function get_leadsubstatus_order($substatusid)
	 {
	 	$this->db->select('lst_order_by');
		$this->db->where('lst_sub_id', $substatusid); 
		$query = $this->db->get('leadsubstatus');
		$substatus=$query->result();
		return $substatus[0]->lst_order_by;
	 }
	 function get_leadsubstatus_parent($substatusid)
	 {
	 	$this->db->select('lst_parentid');
		$this->db->where('lst_sub_id', $substatusid); 
		$query = $this->db->get('leadsubstatus');
		$substatus=$query->result();
		return $substatus[0]->lst_parentid;

	 }

 	  function get_assignto_name($assigntoid)
	 {
	 	$this->db->select('empname');
		$this->db->where('header_user_id', $assigntoid); 
		$query = $this->db->get('vw_web_user_login');
		$empname=$query->result();
		return $empname[0]->empname;
	 }
	  function get_assignto_branch($assigntoid)
	 {
	 	$this->db->select('location_user');
		$this->db->where('header_user_id', $assigntoid); 
		$query = $this->db->get('vw_web_user_login');
		$branch=$query->result();
		return $branch[0]->location_user;
	 }
	 function GetMaxValdc($table)
			{
				$sql ="select max(dch_header_id) from ".$table;
				$result = $this->db->query($sql);
				$daily_hdr_id = $result->result_array();
				return $daily_hdr_id[0]['max'];

			}
 		function GetMaxValdloghrd($table)
			{
				$sql ="select max(hdrlog_id) from ".$table;
				$result = $this->db->query($sql);
				$hdrlog_id = $result->result_array();
				return $hdrlog_id[0]['max'];

			}

			function GetNextLogDtlSeqVal($table)
			{
				$sql ="select max(dtllog_id) from ".$table;
				$result = $this->db->query($sql);
				$dtllog_id = $result->result_array();
				return $dtllog_id[0]['max'];

			}
		function save_dailyactivityhdr($daily_hdr)
		{

			if($this->db->insert('dailycall_hdr', $daily_hdr))
			return true;
			else
			return false;

		}
		function save_dailyvisitdetail($daily_visit_dtl)
		{

			if($this->db->insert('dailycall_visit_dtl', $daily_visit_dtl))
			return true;
			else
			return false;

		}
		function save_dailyactivityloghdr($daily_loghdr)
		{
			
			//print_r($daily_logdtl); die;

			if($this->db->insert('dailycall_log_hdr', $daily_loghdr))
			return true;
			else
			return false;

		}

		
		function save_dcpersonmet_details($daily_personmet)
		{
		
			return $this->db->insert_batch('dailycall_personmet', $daily_personmet);

		}

		function get_typeofvisit_nojason()
		{
			$options = $this->db->select('visit_id,visit_name')->get('dailycall_visittype')->result();
			$options_arr;
			$options_arr[''] = '-Please Select type of visit Source-';

			// Format for passing into form_dropdown function
			foreach ($options as $option) {
				$options_arr[$option->visit_id] = $option->visit_name;
			}
			//return $options_arr;
			$arr = "{\"data\":" .json_encode($options_arr). "}";
		}

		function get_typeofsales_no()
		{
			$options = $this->db->select('sale_id,sale_type_name')->get('dailycall_salestype')->result();
			$options_arr;
			$options_arr[''] = '-Please Select type';

			// Format for passing into form_dropdown function
			foreach ($options as $option) {
				$options_arr[$option->sale_id] = $option->sale_type_name;
			}
			//return $options_arr;
			$arr = "{\"data\":" .json_encode($options_arr). "}";
			return $arr;
		}

		function get_leadstatus_edit($lid,$l_order_id)
		{
			$sql="SELECT leadstatusid, leadstatus as leadstatusname FROM leadstatus WHERE order_by >=".$l_order_id." ORDER BY order_by";
			$result = $this->db->query($sql);
		//	$arr =  json_encode($result->result_array());
			$arr = "{\"leadstatus\":" .json_encode($result->result_array()). "}";
			return $arr;
		}
		function get_substatus_edit_all($ld_sts_id,$lst_parentid_id,$lst_order_by_id)
		{
		    $sql="SELECT lst_sub_id, lst_name, lst_order_by FROM leadsubstatus WHERE lst_parentid =".$lst_parentid_id." ORDER BY lst_order_by";
		   // echo $sql;
		    $result = $this->db->query($sql);
	//	    $arr =  json_encode($result->result_array());
		    $arr = "{\"leadsubstatus\":" .json_encode($result->result_array()). "}";
		    return $arr;

		}

		function get_typeofvisit()
		{

			$sql='select  visit_id,visit_name  from dailycall_visittype order by visit_order_id';
		  	$result = $this->db->query($sql);
			$arr =  json_encode($result->result_array());
			return $arr;
		}
		function get_ldtypeofsales()
		{

		/*	$sql='select  distinct n_value,n_value_id  from vw_sales_despatch_transaction_calss_fnd_flex_values_vl where flex_value_set_id=1014311 and  flex_value_id<>173796';*/
			$sql="SELECT  
					 	DISTINCT  
							CASE 
								WHEN 
									n_value ='Repacking' THEN 'Repack' 
					    			ELSE 
									n_value END n_value,
							n_value_id
					 	FROM   
					 		vw_sales_despatch_transaction_calss_fnd_flex_values_vl 
					 	WHERE 
					 		flex_value_set_id=1014311 AND  
					 		flex_value_id<>173796
					UNION ALL
					SELECT  'Part Tanker',3";
		  	$result = $this->db->query($sql);
		//	$arr =  json_encode($result->result_array());
			$arr = "{\"salestype\":" .json_encode($result->result_array()). "}";
			return $arr;
			
		}
		function get_contactmode()
		{

			$sql='select  moc_id,moc_name  from dailycall_modeofcontact order by moc_order_id';
		  	$result = $this->db->query($sql);
			$arr =  json_encode($result->result_array());
			return $arr;
		}
		function get_dispatch()
		{
			$sql='select  sale_id,sale_type_name  from dailycall_salestype order by sale_type_order';
			$result = $this->db->query($sql);
			$arr =  json_encode($result->result_array());
			return $arr;
		}
		function get_getmailalerts()
		{
			$sql='select  mailalert_id,mailalert_type  from dailycall_mailalerts order by mailalert_type_order';
			$result = $this->db->query($sql);
			$arr =  json_encode($result->result_array());

			return $arr;
		}
		function get_customercontacts($customer_id)
		{
			$sql="SELECT leaddetails.leadid,firstname  FROM leaddetails, customermasterhdr, leadaddress WHERE customermasterhdr.id = leaddetails.company AND leadaddress.leadaddressid= leaddetails.leadid AND leaddetails.company=".$customer_id;
			$result = $this->db->query($sql);
			$arr =  json_encode($result->result_array());

			return $arr;
		}
		function get_customerdesignation($customer_id)
		{
			$sql="SELECT leaddetails.leadid,designation  FROM leaddetails, customermasterhdr, leadaddress WHERE customermasterhdr.id = leaddetails.company AND leadaddress.leadaddressid= leaddetails.leadid AND leaddetails.company=".$customer_id;
			$result = $this->db->query($sql);
			$arr =  json_encode($result->result_array());

			return $arr;
		}

		function get_leadcontacts($leadid)
			{
				//echo " item ".$item."<br>"; 				echo " customer ".$customer."<br>";
		/*		$sql="SELECT leaddetails.leadid, designation, firstname, company, email_id, leadaddress.phone, leadaddress.mobile_no 
						FROM leaddetails,  leadaddress 
						WHERE leadaddress.leadaddressid= leaddetails.leadid AND leaddetails.leadid=".$leadid;*/
				$sql="SELECT designation
						FROM leaddetails,  leadaddress 
						WHERE leadaddress.leadaddressid= leaddetails.leadid AND leaddetails.leadid=".$leadid;
				//echo  $sql;
				$result = $this->db->query($sql);
				
				if($result->num_rows()==0)
				{
					$poten_val['0']['designation']=0;
				}
				else
				{
					$poten_val = $result->result_array();
				}
				$arr =  json_encode($poten_val);
				$arr =	 '{ "rows" :'.$arr.' }';
				return $arr;
				
			}
		
		
		function get_dispatch_ld()
		{
			$sql='select  distinct n_value,n_value_id  from vw_sales_despatch_transaction_calss_fnd_flex_values_vl where flex_value_set_id=1014311 and  flex_value_id<>173796';
			$result = $this->db->query($sql);
			$arr =  json_encode($result->result_array());
			return $arr;
		}

		 function get_dcleadsubstatus()
		{
			$sql="SELECT lst_sub_id, lst_name, lst_order_by FROM leadsubstatus WHERE lst_order_by >=(
			select  ldsubstatus from  leaddetails where leadid=".$this->session->userdata['run_time_dc_lead_id'].")  AND lst_parentid =".$this->parent_id;
			$result = $this->db->query($sql);
			$substatus = $result->result_array();
			$substatus_arr;
			foreach ($substatus as $substat) {
				$substatus_arr[$substat['lst_sub_id']] = $substat['lst_name'];
			}
			return $substatus_arr;
		}

	

		function check_dailyhdr_duplicates($hrd_currentdate,$user1)
			{
				$sql =  $this->db->select('exename')->from('dailyactivityhdr')->where(array('currentdate' => $hrd_currentdate, 'user1' => $user1))->get();
				//echo $sql->num_rows(); 	die;
			 return $sql->num_rows();
			}

			function save_daily_details($dcprodinserts)
			{
			 foreach($dcprodinserts as $dcprodinsert)
				{
				//echo"in save_daily_details model<br>";
			//	 echo"<pre>";print_r($dcprodinsert);echo"</pre>";
			//	$this->db->insert_batch('dailycall_dtl', $dcprodinserts);
				}
				return $this->db->insert_batch('dailycall_dtl', $dcprodinserts);
			
			}
			function update_daily_newprod_details($daily_hdr,$daily_hdr_id)
			{

				$this->db->where('dct_header_id', $daily_hdr_id);
				$this->db->update('dailycall_dtl', $daily_hdr);
				return ($this->db->affected_rows() > 0);
			}

			function save_personmet_details($dailypmdtls)
			{
			 foreach($dailypmdtls as $dailypmdtl)
				{
			//	echo"in save_daily_details model<br>";
				 //echo"<pre> save_personmet_details";print_r($dailypmdtls);echo"</pre>"; 
			//	$this->db->insert_batch('daily_call_dtl', $dailydtls);
				}
				return $this->db->insert_batch('dailycall_personmet', $dailypmdtls);
			}
			function save_dcvisit_details($dailyvisitdtls)
			{
			 foreach($dailyvisitdtls as $dailyvisitdtl)
				{
				//echo"in save_dcvisit_details model<br>";
				// echo"<pre>";print_r($dailyvisitdtl);echo"</pre>";
			//	$this->db->insert_batch('daily_call_dtl', $dailydtls);
				}
				return $this->db->insert_batch('dailycall_visit_dtl', $dailyvisitdtls);
			}

			function save_dclogdtl_products($daily_logdtl)
			{
		//	print_r($daily_logdtl); 
			 foreach($daily_logdtl as $daily_logdt)
				{
			//	echo"in save_dclogdtl_products model<br>";
			//	 echo"<pre>";print_r($daily_logdt);echo"</pre>";
			//	$this->db->insert_batch('daily_call_dtl', $dailydtls);
			    } 

			return $this->db->insert_batch('dailycall_log_dtl', $daily_logdtl);

		}

			function delete_daily_details($ids)
			{
				$this->db->where_in( dct_detail_id, $ids );
				$this->db->delete('dailycall_dtl');
			}
			function delete_leadproduct_details($ids)
			{
				$this->db->where_in( lpid, $ids );
				$this->db->delete('leadproducts');
			}
			function delete_dcpersonmet_details($dct_custid)
			{
				
				$this->db->where_in(dc_cust_id, $dct_custid );
				$this->db->delete('dailycall_personmet');
			}

			function update_daily_details($dcprodupdate)
			{
		   		
				 foreach($dcprodupdate as $produpdate)
				{
					$data = array(
					'dct_businesscategory' => $produpdate['dct_businesscategory'],
					'dct_businesscategory_dc' => $produpdate['dct_businesscategory'],
					'dct_executive_name' => $produpdate['dct_executive_name'],
					'dct_executive_code' => $produpdate['dct_executive_code'],
					'dct_customer_potential' => $produpdate['dct_customer_potential'],
					'dct_customer_potential_dc' => $produpdate['dct_customer_potential'],
					'dct_sales' => $produpdate['dct_sales'],
					'dct_actionpoints' => $produpdate['dct_actionpoints'],
					'dct_due_date' => $produpdate['dct_due_date'],
					'dct_discussion_points' => $produpdate['dct_discussion_points'],
					'dct_marketinformation' => $produpdate['dct_marketinformation'],
					'dct_updated_date' => $produpdate['dct_updated_date'],
					'dct_updated_userid' => $produpdate['dct_updated_userid'],
					'dct_updated_username' => $produpdate['dct_updated_username']
		            );

				$this->db->where('dct_new_prod', $produpdate['dct_new_prod']);
				$this->db->where('dct_itemgroup', $produpdate['dct_itemgroup']);
				$this->db->where('dct_customergroup', $produpdate['dct_customergroup']);
				$this->db->where('dct_businesscategory', $produpdate['dct_businesscategory']);
			
			//	$this->db->where('dct_header_id', $dch_header_id);
				$this->db->update('dailycall_dtl', $data); 


				}


			  return ($this->db->affected_rows() > 0);

			}

			function getactivity_data_column()
			{
				$jTableResult = array();
				//$sql = "SELECT id FROM dailyactivitydtl where id ='".$this->session->userdata['loginname']."'";
				$sql="select lower(dtl_fld) as datafield, lower(dlblch) as text,cellwidth  :: INTEGER*10 AS  width   from formdtl where formcode='SMKT140' and cellwidth>'0' order by seqno";
				//$sql="select lower(dtl_fld) as datafield, lower(dlblch) as text,cellwidth  :: INTEGER*10 AS  width,case when COALESCE(cellwidth,'0') :: INTEGER =0 then  'false' else 'true'  end as hidden   from formdtl where formcode='SMKT140'   order by seqno";

				$db_dc= $this->load->database('forms', TRUE);
			//	$db2->query($sql);
				$result = $db_dc->query($sql);
				$activitydetails = $result->result_array();
				$all_record_count = count($activitydetails);
				$this->session->set_userdata('all_record_count',$all_record_count);
									
            //  echo"count ".$all_record_count; print_r($activitydetails); die; 


				$data = array();
				
				$i=0;
				while($i < count($activitydetails))
				{    
					$row = array();
					$row["text"] = $activitydetails[$i]["text"];
					$row["datafield"] = $activitydetails[$i]["datafield"];
					$row["width"] = $activitydetails[$i]["width"];
					$data[$i] = $row;
					$i++;
				}
		//		$arr = "{\"data\":" .json_encode($data). "}";
				$data ='{ "columns": '.json_encode($data).'}';
//				$data =json_encode($data);
				$arr = $data;
		//	echo "{ rows: ".$arr." }";
   //    echo $arr; die;
		 		return $arr;
	}

	//function get_viewdiallycalldetails($header_id)
	//function get_viewdiallycalldetails($visitdate)
			function get_viewdiallycalldetails($exename)
				{

				$jTableResult = array();

				$loginname = $this->session->userdata['identity'];
				// $sql="SELECT id,custgroup,exename,branch,itemgroup,potentialqty,subactivity,modeofcontact,hour_s,minit,quantity,division,date,remarks,l1status,complaints, user_id,description,actionplanned,detailed_description from vw_web_daily_activity d where id ='".$header_id."'";
				if($exename==null or $exename=="")
				{
					
				 $sql="SELECT id,custgroup,exename,branch,itemgroup,potentialqty,subactivity,modeofcontact,hour_s,minit,quantity,division,date,remarks,l1status,complaints, user_id,description,actionplanned,detailed_description,sales,collection,statuory,marketinformation,comments
								 from vw_web_daily_activity_dc  where date::date='".$visitdate."'";
				}
				else
				{
				  $sql="SELECT id,custgroup,exename,branch,itemgroup,potentialqty,subactivity,modeofcontact,hour_s,minit,quantity,division,date,remarks,l1status,complaints, user_id,description,actionplanned,detailed_description,sales,collection,statuory,marketinformation,comments
 from vw_web_daily_activity_dc where exename ='".$exename."'";	 
				}	
				 

				//echo $sql; die;
				$result = $this->db->query($sql);
				$activitydetails = $result->result_array();
				$all_record_count = count($activitydetails);
				$this->session->set_userdata('all_record_count',$all_record_count);

				//  echo"count ".$all_record_count; print_r($activitydetails); die; 


				$data = array();
				
				$i=0;
				while($i < count($activitydetails))
				{    
					$row = array();
					$row["id"] = $activitydetails[$i]["id"];
					$row["custgroup"] = $activitydetails[$i]["custgroup"];
					$row["itemgroup"] = $activitydetails[$i]["itemgroup"];
					$row["potentialqty"] = $activitydetails[$i]["potentialqty"];
					$row["subactivity"] = $activitydetails[$i]["subactivity"];
					$row["exename"] = $activitydetails[$i]["exename"];
					$row["branch"] = $activitydetails[$i]["branch"];
					$row["modeofcontact"] = $activitydetails[$i]["modeofcontact"];
					$row["hour_s"] = $activitydetails[$i]["hour_s"];
					$row["minit"] = $activitydetails[$i]["minit"];
					$row["quantity"] = $activitydetails[$i]["quantity"];
					$row["division"] = $activitydetails[$i]["division"];
					$row["date"] = $activitydetails[$i]["date"];
					$row["remarks"] = $activitydetails[$i]["remarks"];
					$row["l1status"] = $activitydetails[$i]["l1status"];
					$row["complaints"] = $activitydetails[$i]["complaints"];
					$row["description"] = $activitydetails[$i]["description"];
					$row["actionplanned"] = $activitydetails[$i]["actionplanned"];
					$row["detailed_description"] = $activitydetails[$i]["detailed_description"];
					$row["sales"] = $activitydetails[$i]["sales"];
					$row["collection"] = $activitydetails[$i]["collection"];
					$row["statuory"] = $activitydetails[$i]["statuory"];
					$row["marketinformation"] = $activitydetails[$i]["marketinformation"];
					$row["comments"] = $activitydetails[$i]["comments"];

					$data[$i] = $row;
					$i++;
			}
			$arr = "{\"data\":" .json_encode($data). "}";
			//	echo "{ rows: ".$arr." }";
			return $arr;
	}

	function get_viewdiallycalldetails_bydate($visitdate)
				{

				$jTableResult = array();

				$loginname = $this->session->userdata['identity'];
				// $sql="SELECT id,custgroup,exename,branch,itemgroup,potentialqty,subactivity,modeofcontact,hour_s,minit,quantity,division,date,remarks,l1status,complaints, user_id,description,actionplanned,detailed_description from vw_web_daily_activity d where id ='".$header_id."'";
				if($visitdate!=0)
				{
					
				 $sql="SELECT id,custgroup,exename,branch,itemgroup,potentialqty,subactivity,modeofcontact,hour_s,minit,quantity,division,date,remarks,l1status,complaints, user_id,description,actionplanned,detailed_description,sales,collection,statuory,marketinformation,comments
								 from vw_web_daily_activity_dc  where date::date='".$visitdate."'";
				}
				else
				{
				  $sql="SELECT id,custgroup,exename,branch,itemgroup,potentialqty,subactivity,modeofcontact,hour_s,minit,quantity,division,date,remarks,l1status,complaints, user_id,description,actionplanned,detailed_description,sales,collection,statuory,marketinformation,comments
 from vw_web_daily_activity_dc limit 5";	 
				}	
				 

			//	echo $sql; die;
				$result = $this->db->query($sql);
				$activitydetails = $result->result_array();
				$all_record_count = count($activitydetails);
				$this->session->set_userdata('all_record_count',$all_record_count);

				//  echo"count ".$all_record_count; print_r($activitydetails); die; 


				$data = array();
				
				$i=0;
				while($i < count($activitydetails))
				{    
					$row = array();
				//	$row["id"] = $activitydetails[$i]["id"];
					$row["custgroup"] = $activitydetails[$i]["custgroup"];
					$row["itemgroup"] = $activitydetails[$i]["itemgroup"];
					$row["potentialqty"] = $activitydetails[$i]["potentialqty"];
					$row["subactivity"] = $activitydetails[$i]["subactivity"];
					$row["exename"] = $activitydetails[$i]["exename"];
					$row["branch"] = $activitydetails[$i]["branch"];
					$row["modeofcontact"] = $activitydetails[$i]["modeofcontact"];
					$row["hour_s"] = $activitydetails[$i]["hour_s"];
					$row["minit"] = $activitydetails[$i]["minit"];
					$row["quantity"] = $activitydetails[$i]["quantity"];
					$row["division"] = $activitydetails[$i]["division"];
					$row["date"] = $activitydetails[$i]["date"];
					$row["remarks"] = $activitydetails[$i]["remarks"];
					$row["l1status"] = $activitydetails[$i]["l1status"];
					$row["complaints"] = $activitydetails[$i]["complaints"];
					$row["description"] = $activitydetails[$i]["description"];
					$row["actionplanned"] = $activitydetails[$i]["actionplanned"];
					$row["detailed_description"] = $activitydetails[$i]["detailed_description"];
					$row["sales"] = $activitydetails[$i]["sales"];
					$row["collection"] = $activitydetails[$i]["collection"];
					$row["statuory"] = $activitydetails[$i]["statuory"];
					$row["marketinformation"] = $activitydetails[$i]["marketinformation"];
					$row["comments"] = $activitydetails[$i]["comments"];

					$data[$i] = $row;
					$i++;
			}
			$arr = "{\"data\":" .json_encode($data). "}";
			//	echo "{ rows: ".$arr." }";
			return $arr;
	}

	

		function get_producttype_info($customer_id)
		{
				$sql="SELECT  
						s.sale_type_name,
						t.dct_salestypeid,
						--t.dct_header_id, 
						sum(t.dct_potential) as totpot, 
						sum(t.dct_quantity) as totqnt 
				FROM  
							dailycall_dtl t,
							dailycall_hdr h,
							dailycall_salestype s
				WHERE
							t.dct_salestypeid =s.sale_id AND 
							t.dct_header_id =  h.dch_header_id AND
							h.dch_customerid =".$customer_id." 
			          
				GROUP BY 
						--t.dct_header_id,
						t.dct_salestypeid,
						s.sale_type_name";

			//echo $sql; die;
				$result = $this->db->query($sql);
				$customerdetails = $result->result_array();

				

					$jTableResult = array();
					$jTableResult['custleaddetails'] = $customerdetails;
					$data = array();
					$i=0;
					while($i < count($jTableResult['custleaddetails']))
					{    
					$row = array();
			//		$row["leadid"] = $jTableResult['custleaddetails'][$i]["dct_header_id"];
					$row["n_value"] = $jTableResult['custleaddetails'][$i]["sale_type_name"];
					$row["prod_type_id"] = $jTableResult['custleaddetails'][$i]["dct_salestypeid"];
					$row["totpot"] = $jTableResult['custleaddetails'][$i]["totpot"];
					$row["totqnt"] = $jTableResult['custleaddetails'][$i]["totqnt"];
				//	$row["annualpotential"] = $jTableResult['custleaddetails'][$i]["annualpotential"];
					$data[$i] = $row;
					$i++;
					}
				$arr = "{\"data\":" .json_encode($data). "}";
			//	$arr = $data;
			 		return $arr;

		}
		function get_producttype_sum_from_businessplan($customer_id)
		{
				$sql="SELECT 
							bdt.businesscategory, 
							sum(COALESCE(bdt.customer_potential,0)) as totpot,
							/*sum(COALESCE(bdt.quantity,0)) as totqnt*/
							sum(COALESCE(bdt.current_yr_sale_qty,0)) as totqnt
							
					FROM
								 customermasterhdr hdr,
								 businessplandtl bdt
					WHERE
					  hdr.customergroup =   bdt.customergroup AND 
					  hdr.id = ".$customer_id."
					GROUP BY
					  bdt.businesscategory";




			//echo $sql; die;
				$result = $this->db->query($sql);
				$customerdetails = $result->result_array();

				

					$jTableResult = array();
					$jTableResult['custleaddetails'] = $customerdetails;
					$data = array();
					$i=0;
					while($i < count($jTableResult['custleaddetails']))
					{    
					$row = array();
			//		$row["leadid"] = $jTableResult['custleaddetails'][$i]["dct_header_id"];
					$row["n_value"] = $jTableResult['custleaddetails'][$i]["businesscategory"];
				//	$row["prod_type_id"] = $jTableResult['custleaddetails'][$i]["dct_salestypeid"];
					$row["totpot"] = $jTableResult['custleaddetails'][$i]["totpot"];
					$row["totqnt"] = $jTableResult['custleaddetails'][$i]["totqnt"];
				//	$row["annualpotential"] = $jTableResult['custleaddetails'][$i]["annualpotential"];
					$data[$i] = $row;
					$i++;
					}
				$arr = "{\"data\":" .json_encode($data). "}";
			//	$arr = $data;
			 		return $arr;

		}

		function get_producttype_sum_from_businessplan_custgroup($customer_group)
		{
					
					$customer_group = str_replace("'", "", $customer_group);
					$customer_group = html_entity_decode($customer_group);
/*
					$sql="SELECT 
								dct_businesscategory as businesscategory, 
								sum(COALESCE(dct_customer_potential,0)) as totpot, 
								sum(COALESCE(dct_current_yr_sale_qty,0)) as totqnt, 
								REPLACE(dct_customergroup,'''',''), 
								max(dct_updated_date::DATE) 
							FROM 
								dailycall_dtl 
							WHERE 
								REPLACE(dct_customergroup,'''','') like '%".trim($customer_group)."%' 
							GROUP BY 
								REPLACE(dct_customergroup,'''',''),dct_businesscategory";*/
					/*$sql="SELECT 
								dct_businesscategory as businesscategory, 
								sum(COALESCE(dct_customer_potential,0)) as totpot, 
								sum(COALESCE(dct_current_yr_sale_qty,0)) as totqnt, 
								REPLACE(dct_customergroup,'''',''), 
								max(dct_updated_date::DATE) 
							FROM 
								dailycall_dtl 
							WHERE 
								REPLACE(dct_customergroup,'''','') like '".trim($customer_group)."' 
							GROUP BY 
								REPLACE(dct_customergroup,'''',''),dct_businesscategory";*/

								$sql="SELECT * FROM fn_sum_pot_req_for_bp('".trim($customer_group)."','2014-2015')";



					

			//echo $sql; die;
				$result = $this->db->query($sql);
				$customerdetails = $result->result_array();

				

					$jTableResult = array();
					$jTableResult['custleaddetails'] = $customerdetails;
					$data = array();
					$i=0;
					while($i < count($jTableResult['custleaddetails']))
					{    
					$row = array();
			//		$row["leadid"] = $jTableResult['custleaddetails'][$i]["dct_header_id"];
					$row["businesscategory"] = $jTableResult['custleaddetails'][$i]["businesscategory"];
				//	$row["prod_type_id"] = $jTableResult['custleaddetails'][$i]["dct_salestypeid"];
					$row["totpot"] = $jTableResult['custleaddetails'][$i]["potential"];
					$row["totqnt"] = $jTableResult['custleaddetails'][$i]["requirement"];
				//	$row["annualpotential"] = $jTableResult['custleaddetails'][$i]["annualpotential"];
					$data[$i] = $row;
					$i++;
					}
				$arr = "{\"data\":" .json_encode($data). "}";
			//	$arr = $data;
			 		return $arr;

		}

		
		function get_leadproducttype_info($customer_id)
		{
					$sql="select * from  vw_dc_lead_cust_prod_grouping where company =".$customer_id;
					//echo $sql; die;
					$result = $this->db->query($sql);
					$customerdetails = $result->result_array();
					$jTableResult = array();
					$jTableResult['custleaddetails'] = $customerdetails;
					$data = array();
					$i=0;
					while($i < count($jTableResult['custleaddetails']))
					{    
						$row = array();
				//		$row["leadid"] = $jTableResult['custleaddetails'][$i]["dct_header_id"];
						$row["n_value"] = $jTableResult['custleaddetails'][$i]["n_value"];
						$row["prod_type_id"] = $jTableResult['custleaddetails'][$i]["prod_type_id"];
						$row["totpot"] = $jTableResult['custleaddetails'][$i]["totpot"];
						$row["totqnt"] = $jTableResult['custleaddetails'][$i]["totqnt"];
					//	$row["annualpotential"] = $jTableResult['custleaddetails'][$i]["annualpotential"];
						$data[$i] = $row;
						$i++;
					}
				$arr = "{\"data\":" .json_encode($data). "}";
			//	$arr = $data;
			 	return $arr;

		}

		function get_custprod_info($customer_id)
		{
				$sql="SELECT  
						s.sale_type_name,
						t.*,
						h.*
				FROM  
						dailycall_dtl t,
						dailycall_hdr h,
						dailycall_salestype s
				WHERE
						t.dct_businesscategory =s.sale_type_name AND 
						t.dct_header_id =  h.dch_header_id AND
						h.dch_customerid =".$customer_id; 

			//	echo $sql; die;
				$result = $this->db->query($sql);
				$customerdetails = $result->result_array();
				$jTableResult = array();
				$jTableResult['custprodinfo'] = $customerdetails;
				$data = array();
				$i=0;
			
				while($i < count($jTableResult['custprodinfo']))
				{    
				$row = array();
				$row["from_lead"] = 0;
				$row["dct_header_id"] = $jTableResult['custprodinfo'][$i]["dct_header_id"];
				$row["dct_detail_id"] = $jTableResult['custprodinfo'][$i]["dct_detail_id"];
				$row["dct_prodname"] = $jTableResult['custprodinfo'][$i]["dct_prodname"];
				$row["dct_prodid"] = $jTableResult['custprodinfo'][$i]["dct_prodid"];
				$row["dct_potential"] = $jTableResult['custprodinfo'][$i]["dct_potential"];
				$row["dct_quantity"] = $jTableResult['custprodinfo'][$i]["dct_quantity"];
				$row["dct_salestype_id"] = $jTableResult['custprodinfo'][$i]["dct_salestypeid"];
				$row["dct_salesid"] = $jTableResult['custprodinfo'][$i]["dct_salestypeid"];
				$row["dct_salestypename"] = $jTableResult['custprodinfo'][$i]["sale_type_name"];
				$row["dct_prodstatusname"] = $jTableResult['custprodinfo'][$i]["dct_prodstatusname"];
				$row["dct_prodsub_stsname"] = $jTableResult['custprodinfo'][$i]["dct_prodsub_stsname"];
			
				$row["dct_actionplanned"] = $jTableResult['custprodinfo'][$i]["dct_actionplanned"];
				$row["dct_sales"] = $jTableResult['custprodinfo'][$i]["dct_sales"];
				$row["dct_collection"] = $jTableResult['custprodinfo'][$i]["dct_collection"];
				
				$row["dct_statuory"] = $jTableResult['custprodinfo'][$i]["dct_statuory"];
				$row["dct_marketinformation"] = $jTableResult['custprodinfo'][$i]["dct_marketinformation"];
			
				$data[$i] = $row;
				$i++;
				}
			$arr = "{\"cust_prod_data\":" .json_encode($data). "}";
		//	$arr = $data;

	 		return $arr;

		}

		function get_custprod_busnessplandtl_info($customer_group)
		{
			$customer_group = str_replace("'", "", $customer_group);
			$customer_group = html_entity_decode($customer_group);

				
					/*$sql="select 
								m.*,k.dct_new_prod,k.dct_actionpoints,k.dct_due_date,k.dct_discussion_points,k.dct_marketinformation
								,sum(po_repack+po_bulk+po_intact+po_small_packing+po_single_tanker+po_part_tanker) as total_potential
								,sum(tr_repack+tr_bulk+tr_intact+tr_small_packing+tr_single_tanker+tr_part_tanker) as total_tr
								,sum(ac_repack+ac_bulk+ac_intact+ac_small_packing+ac_single_tanker+ac_part_tanker) as total_ac
								,COALESCE(n.ac_repack,0) as ac_repack
								,COALESCE(n.ac_bulk,0) as ac_bulk
								,COALESCE(n.ac_intact,0) as ac_intact
								,COALESCE(n.ac_intact,0) as ac_small_packing
								,COALESCE(n.ac_intact,0) as ac_single_tanker
								,COALESCE(n.ac_intact,0) as ac_part_tanker
								 from 
								fn_bp_pot_tra_qty('".trim($customer_group)."','2014-2015') m LEFT OUTER JOIN 
								fn_bp_pot_Actual_qty('".trim($customer_group)."','2014-2015') n
								ON 
								REPLACE(m.customergroup,'''','')=REPLACE(n.customergroup,'''','')
								and m.itemgroup=n.itemgroup
								LEFT OUTER JOIN dailycall_dtl k on m.customergroup=k.dct_customergroup
								GROUP BY m.customergroup,m.itemgroup,po_repack,po_bulk,po_intact,po_small_packing,po_single_tanker,po_part_tanker,tr_repack,tr_bulk,tr_intact,tr_small_packing,tr_single_tanker,tr_part_tanker,ac_repack,ac_bulk,ac_intact,ac_small_packing,ac_single_tanker,ac_part_tanker,k.dct_actionpoints,k.dct_due_date,k.dct_discussion_points,k.dct_marketinformation,k.dct_new_prod";*/

					$sql="select distinct a.*,
							k.dct_actionpoints,k.dct_due_date,k.dct_discussion_points,k.dct_marketinformation,k.dct_new_prod 
							from (SELECT
								m.customergroup,m.itemgroup,
								po_repack + po_bulk + po_intact + po_small_packing + po_single_tanker + po_part_tanker 	AS total_potential,
								tr_repack + tr_bulk + tr_intact + tr_small_packing + tr_single_tanker + tr_part_tanker 	AS total_tr,
								ac_repack + ac_bulk + ac_intact + ac_small_packing + ac_single_tanker + ac_part_tanker  AS total_ac,
								po_repack ,po_bulk,po_intact,po_small_packing,po_single_tanker,po_part_tanker,
  								tr_repack,tr_bulk,tr_intact,tr_small_packing,tr_single_tanker,tr_part_tanker,
								COALESCE (n.ac_repack, 0) AS ac_repack,
								COALESCE (n.ac_bulk, 0) AS ac_bulk,
								COALESCE (n.ac_intact, 0) AS ac_intact,
								COALESCE (n.ac_intact, 0) AS ac_small_packing,
								COALESCE (n.ac_intact, 0) AS ac_single_tanker,
								COALESCE (n.ac_intact, 0) AS ac_part_tanker
							FROM
								fn_bp_pot_tra_qty('".trim($customer_group)."','2014-2015') m LEFT OUTER JOIN 
								fn_bp_pot_Actual_qty('".trim($customer_group)."','2014-2015') n
								ON REPLACE (M.customergroup, '''', '') = REPLACE (n.customergroup, '''', '')
							AND M .itemgroup = n.itemgroup
							LEFT OUTER JOIN dailycall_dtl K ON M .customergroup = K .dct_customergroup
							) a
							LEFT OUTER JOIN 
							(
							select k.dct_customergroup,k.dct_itemgroup,k.dct_actionpoints,k.dct_due_date,k.dct_discussion_points,k.dct_marketinformation,k.dct_new_prod from  dailycall_dtl k
							) k ON
							a.customergroup=k.dct_customergroup
							and a.itemgroup=dct_itemgroup";



				//echo $sql; die;
				$result = $this->db->query($sql);
				$customerdetails = $result->result_array();
				$jTableResult = array();
				$jTableResult['custprodinfo'] = $customerdetails;
				$data = array();
				$i=0;
		
				while($i < count($jTableResult['custprodinfo']))
				{    
				$row = array();
				$row["from_lead"] = 0;
				$row["dct_header_id"] = 0;
				$row["dct_detail_id"] = 0;
				$row["dct_prodid"] = 0;
				$row["dct_new_prod"] = $jTableResult['custprodinfo'][$i]["dct_new_prod"];
				$row["itemgroup"] = $jTableResult['custprodinfo'][$i]["itemgroup"];
				$row["po_bulk"] = $jTableResult['custprodinfo'][$i]["po_bulk"];
				$row["po_intact"] = $jTableResult['custprodinfo'][$i]["po_intact"];
				$row["po_repack"] = $jTableResult['custprodinfo'][$i]["po_repack"];
				$row["po_part_tanker"] = $jTableResult['custprodinfo'][$i]["po_part_tanker"];
				$row["po_single_tanker"] = $jTableResult['custprodinfo'][$i]["po_single_tanker"];
				$row["po_small_packing"] = $jTableResult['custprodinfo'][$i]["po_small_packing"];
				$row["total_potential"] = $jTableResult['custprodinfo'][$i]["total_potential"];

				$row["tr_bulk"] = $jTableResult['custprodinfo'][$i]["tr_bulk"];
				$row["tr_intact"] = $jTableResult['custprodinfo'][$i]["tr_intact"];
				$row["tr_repack"] = $jTableResult['custprodinfo'][$i]["tr_repack"];
				$row["tr_part_tanker"] = $jTableResult['custprodinfo'][$i]["tr_part_tanker"];
				$row["tr_single_tanker"] = $jTableResult['custprodinfo'][$i]["tr_single_tanker"];
				$row["tr_small_packing"] = $jTableResult['custprodinfo'][$i]["tr_small_packing"];
				$row["total_tr"] = $jTableResult['custprodinfo'][$i]["total_tr"];	

				$row["ac_bulk"] = $jTableResult['custprodinfo'][$i]["ac_bulk"];
				$row["ac_intact"] = $jTableResult['custprodinfo'][$i]["ac_intact"];
				$row["ac_repack"] = $jTableResult['custprodinfo'][$i]["ac_repack"];
				$row["ac_part_tanker"] = $jTableResult['custprodinfo'][$i]["ac_part_tanker"];
				$row["ac_single_tanker"] = $jTableResult['custprodinfo'][$i]["ac_single_tanker"];
				$row["ac_small_packing"] = $jTableResult['custprodinfo'][$i]["ac_small_packing"];
				$row["total_ac"] = $jTableResult['custprodinfo'][$i]["total_ac"];	

				$row["dct_prodstatusname"] = "Expanding And Build Relationship";
				$row["dct_prodsub_stsname"] = "Expanding And Build Relationship";
				$row["dct_prodsub_stsid"] = 7;
				$row["dct_prodstatusid"] = 29;
				$row["actionpoints"] = $jTableResult['custprodinfo'][$i]["dct_actionpoints"];	
				$row["due_date"] = $jTableResult['custprodinfo'][$i]["dct_due_date"];	
				$row["discussion_points"] = $jTableResult['custprodinfo'][$i]["dct_discussion_points"];	
				$row["dct_actionplanned"] = "";	
				$row["dct_sales"] = "";
				$row["dct_collection"] = "";
				$row["dct_statuory"] = "";
				$row["dct_marketinformation"] = $jTableResult['custprodinfo'][$i]["dct_marketinformation"];
			
				$data[$i] = $row;
				$i++;
				}
			$arr = "{\"cust_prod_data\":" .json_encode($data). "}";
		//	$arr = $data;

	 		return $arr;

		}

		function get_custprod_busnessplandtl_info_old($customer_group)
		{
			$customer_group = str_replace("'", "", $customer_group);
			$customer_group = html_entity_decode($customer_group);
					/*$sql="SELECT 
							dct_customergroup, 
							dct_itemgroup as itemgroup, 
							dct_businesscategory as businesscategory, 
						 	COALESCE(dct_customer_potential,0) as dct_potential, 
						 	COALESCE(dct_current_yr_sale_qty,0) as dct_quantity 
						FROM 
							dailycall_dtl 
						WHERE 
							REPLACE(dct_customergroup,'''','') like '%".trim($customer_group)."%'";*/

					$sql="SELECT
							dct_new_prod,
							REPLACE(dct_customergroup,'''','')  as dct_customergroup,
							itemgroup,
							SUM (bulk) AS bulk,
							SUM (intact) AS intact,
							SUM (repack) AS repack,
							SUM (part_tanker) AS part_tanker,
							SUM (single_tanker) AS single_tanker,
							SUM (small_packing) AS small_packing,
					   		SUM( bulk + intact + repack + part_tanker + single_tanker +small_packing ) as total_potential
					FROM
						(
							SELECT
							      dct_new_prod,
								itemgroup,
								dct_customergroup,
								CASE
								WHEN businesscategory = 'BULK' THEN
								total_potent
								ELSE
								0
								END AS bulk,
								CASE
								WHEN businesscategory = 'INTACT' THEN
								total_potent
								ELSE
								0
								END AS intact,
								CASE
								WHEN businesscategory = 'REPACK' THEN
								total_potent
								ELSE
								0
								END AS repack,
								CASE
								WHEN businesscategory = 'PART TANKER' THEN
								total_potent
								ELSE
								0
								END AS part_tanker,
								CASE
								WHEN businesscategory = 'SINGLE - TANKER' THEN
								total_potent
								ELSE
								0
								END AS single_tanker,
								CASE
								WHEN businesscategory = 'SMALL PACKING' THEN
								total_potent
								ELSE
								0
								END AS small_packing
						FROM
							vw_dailycall_salestype_all
						WHERE
							
							REPLACE(dct_customergroup,'''','') like '".trim($customer_group)."'
							) M
						GROUP BY
							dct_new_prod,
							itemgroup,
							REPLACE(dct_customergroup,'''','')
					     ORDER BY 
					     itemgroup";


			//	echo $sql; die;
				$result = $this->db->query($sql);
				$customerdetails = $result->result_array();
				$jTableResult = array();
				$jTableResult['custprodinfo'] = $customerdetails;
				$data = array();
				$i=0;
		
				while($i < count($jTableResult['custprodinfo']))
				{    
				$row = array();

				$row["from_lead"] = 0;
				$row["dct_header_id"] = 0;
				$row["dct_detail_id"] = 0;
				$row["dct_prodid"] = 0;
				$row["dct_new_prod"] = $jTableResult['custprodinfo'][$i]["dct_new_prod"];
				$row["itemgroup"] = $jTableResult['custprodinfo'][$i]["itemgroup"];
				$row["bulk"] = $jTableResult['custprodinfo'][$i]["bulk"];
				$row["intact"] = $jTableResult['custprodinfo'][$i]["intact"];
				$row["repack"] = $jTableResult['custprodinfo'][$i]["repack"];
				$row["part_tanker"] = $jTableResult['custprodinfo'][$i]["part_tanker"];
				$row["single_tanker"] = $jTableResult['custprodinfo'][$i]["single_tanker"];
				$row["small_packing"] = $jTableResult['custprodinfo'][$i]["small_packing"];
				$row["total_potential"] = $jTableResult['custprodinfo'][$i]["total_potential"];	
				$row["dct_prodstatusname"] = "Expanding And Build Relationship";
				$row["dct_prodsub_stsname"] = "Expanding And Build Relationship";
				$row["dct_prodsub_stsid"] = 7;
				$row["dct_prodstatusid"] = 29;
				$row["actionpoints"] = "";
				$row["due_date"] = "2014-10-10";
				$row["discussion_points"] = "";
				$row["dct_actionplanned"] = "";	
				$row["dct_sales"] = "";
				$row["dct_collection"] = "";
				$row["dct_statuory"] = "";
				$row["dct_marketinformation"] = "";
			
				$data[$i] = $row;
				$i++;
				}
			$arr = "{\"cust_prod_data\":" .json_encode($data). "}";
		//	$arr = $data;

	 		return $arr;

		}

		function get_custprod_busnessplandtl_info_update($customer_group)
		{
			$customer_group = str_replace("'", "", $customer_group);
			$customer_group = html_entity_decode($customer_group);
					/*$sql="SELECT 
							dct_customergroup, 
							dct_itemgroup as itemgroup, 
							dct_businesscategory as businesscategory, 
						 	COALESCE(dct_customer_potential,0) as dct_potential, 
						 	COALESCE(dct_current_yr_sale_qty,0) as dct_quantity 
						FROM 
							dailycall_dtl 
						WHERE 
							REPLACE(dct_customergroup,'''','') like '%".trim($customer_group)."%'";*/

					$sql="SELECT
							dct_new_prod,
							dct_actionpoints, 
							dct_due_date, 
							dct_discussion_points, 
							dct_marketinformation,
							REPLACE(dct_customergroup,'''','')  as dct_customergroup,
							itemgroup,
							SUM (bulk) AS bulk,
							SUM (intact) AS intact,
							SUM (repack) AS repack,
							SUM (part_tanker) AS part_tanker,
							SUM (single_tanker) AS single_tanker,
							SUM (small_packing) AS small_packing,
					   		SUM( bulk + intact + repack + part_tanker + single_tanker +small_packing ) as total_potential
					FROM
						(
							SELECT
							      dct_new_prod,
								itemgroup,
								dct_customergroup,
								dct_actionpoints, 
								dct_due_date, 
								dct_discussion_points, 
								dct_marketinformation,
								CASE
								WHEN businesscategory = 'BULK' THEN
								total_potent
								ELSE
								0
								END AS bulk,
								CASE
								WHEN businesscategory = 'INTACT' THEN
								total_potent
								ELSE
								0
								END AS intact,
								CASE
								WHEN businesscategory = 'REPACK' THEN
								total_potent
								ELSE
								0
								END AS repack,
								CASE
								WHEN businesscategory = 'PART TANKER' THEN
								total_potent
								ELSE
								0
								END AS part_tanker,
								CASE
								WHEN businesscategory = 'SINGLE - TANKER' THEN
								total_potent
								ELSE
								0
								END AS single_tanker,
								CASE
								WHEN businesscategory = 'SMALL PACKING' THEN
								total_potent
								ELSE
								0
								END AS small_packing
						FROM
							vw_dailycall_salestype_all
						WHERE
							
							REPLACE(dct_customergroup,'''','') like '".trim($customer_group)."'
							) M
						GROUP BY
							dct_new_prod,
							itemgroup,
							REPLACE(dct_customergroup,'''',''),
							dct_actionpoints, 
							dct_due_date, 
							dct_discussion_points, 
							dct_marketinformation
					     ORDER BY 
					     itemgroup";


			//	echo $sql; die;
				$result = $this->db->query($sql);
				$customerdetails = $result->result_array();
				$jTableResult = array();
				$jTableResult['custprodinfo'] = $customerdetails;
				$data = array();
				$i=0;
		
				while($i < count($jTableResult['custprodinfo']))
				{    
				$row = array();

				$row["from_lead"] = 0;
				$row["dct_header_id"] = 0;
				$row["dct_detail_id"] = 0;
				$row["dct_prodid"] = 0;
				$row["dct_new_prod"] = $jTableResult['custprodinfo'][$i]["dct_new_prod"];
				$row["itemgroup"] = $jTableResult['custprodinfo'][$i]["itemgroup"];
				$row["bulk"] = $jTableResult['custprodinfo'][$i]["bulk"];
				$row["intact"] = $jTableResult['custprodinfo'][$i]["intact"];
				$row["repack"] = $jTableResult['custprodinfo'][$i]["repack"];
				$row["part_tanker"] = $jTableResult['custprodinfo'][$i]["part_tanker"];
				$row["single_tanker"] = $jTableResult['custprodinfo'][$i]["single_tanker"];
				$row["small_packing"] = $jTableResult['custprodinfo'][$i]["small_packing"];
				$row["total_potential"] = $jTableResult['custprodinfo'][$i]["total_potential"];	
				$row["dct_prodstatusname"] = "Expanding And Build Relationship";
				$row["dct_prodsub_stsname"] = "Expanding And Build Relationship";
				$row["dct_prodsub_stsid"] = 7;
				$row["dct_prodstatusid"] = 29;
				$row["actionpoints"] = $jTableResult['custprodinfo'][$i]["dct_actionpoints"];	
				$row["due_date"] = $jTableResult['custprodinfo'][$i]["dct_due_date"];	
				$row["discussion_points"] = $jTableResult['custprodinfo'][$i]["dct_discussion_points"];	
				$row["dct_actionplanned"] = "";	
				$row["dct_sales"] = "";
				$row["dct_collection"] = "";
				$row["dct_statuory"] = "";
				$row["dct_marketinformation"] = $jTableResult['custprodinfo'][$i]["dct_marketinformation"];	
			
				$data[$i] = $row;
				$i++;
				}
			$arr = "{\"cust_prod_data\":" .json_encode($data). "}";
		//	$arr = $data;

	 		return $arr;

		}

		function get_lead_contact_info($lead_id,$customer_id)
		{
			
					$sql="SELECT leaddetails.leadid as leadid, designation as dc_designation, firstname as dc_personmet_name, company as dc_cust_id, customermasterhdr.tempcustname, email_id as dc_email_id, leadaddress.phone as dc_phone_no, leadaddress.mobile_no as dc_mobile_no FROM leaddetails, customermasterhdr, leadaddress WHERE customermasterhdr.id = leaddetails.company AND leadaddress.leadaddressid= leaddetails.leadid AND leaddetails.company=".$customer_id." GROUP BY leaddetails.leadid, company , email_id, customermasterhdr.tempcustname, firstname, designation, leadaddress.phone, leadaddress.mobile_no";

					/*$sql="SELECT
											leaddetails.leadid,
											designation, 
											firstname, 
											company, 
											customermasterhdr.tempcustname,
											email_id,
											leadaddress.phone,
											leadaddress.mobile_no
							FROM 
											leaddetails, 
											customermasterhdr,
											leadaddress 
							WHERE 
										customermasterhdr.id = leaddetails.company 
										AND leadaddress.leadaddressid= leaddetails.leadid
										AND leaddetails.company=".$customer_id."
										
							GROUP BY 
									leaddetails.leadid,
									company ,
									email_id,
									customermasterhdr.tempcustname,
									firstname,
									designation,
									leadaddress.phone,
									leadaddress.mobile_no";*/
			
						

			//	echo $sql; die;
				$result = $this->db->query($sql);
				$customerdetails = $result->result_array();
				$jTableResult = array();
				$jTableResult['custprodinfo'] = $customerdetails;
				$data = array();
				$i=0;
		
				while($i < count($jTableResult['custprodinfo']))
				{    
				$row = array();
				$row["leadid"] = $jTableResult['custprodinfo'][$i]["leadid"];
				$row["cust_id"] = $jTableResult['custprodinfo'][$i]["dc_cust_id"];
				$row["customer_name"] = $jTableResult['custprodinfo'][$i]["tempcustname"];
				$row["contact_person"] = $jTableResult['custprodinfo'][$i]["dc_personmet_name"];
				$row["contact_no"] = $jTableResult['custprodinfo'][$i]["dc_phone_no"];
				$row["mobile_no"] = $jTableResult['custprodinfo'][$i]["dc_mobile_no"];
				$row["contact_mailid"] = $jTableResult['custprodinfo'][$i]["dc_email_id"];	
				$row["designation"] =$jTableResult['custprodinfo'][$i]["dc_designation"];
				$row["general_mail"] = "";
				$row["soc_mail"] = "";
				$row["payment_mail"] = "";
				$row["quotation_mail"] = "";
				$row["dispatch_mail"] = "";
				$row["personmet"] = "";
				
			//	$row["dct_prodstatusname"] = $jTableResult['custprodinfo'][$i]["dct_prodstatusname"];
			//	$row["dct_prodsub_stsname"] = $jTableResult['custprodinfo'][$i]["dct_prodsub_stsname"];
			
					
				$data[$i] = $row;
				$i++;
				}
			$arr = "{\"lead_contact_data\":" .json_encode($data). "}";
		//	$arr = $data;

	 		return $arr;

		}

		function get_noof_rows_savedlead_contactinfo($lead_id,$customer_id)
		{
			
					$sql="SELECT
					                
					              dc_personmet_id,
					              dc_header_id,
					              dc_personmet_name,
					              dc_designation,
					              deptname,
					              dc_phone_no,
					              dc_email_id,
					              dc_mailalert_to,
					              dc_cust_id,
					              soc_mail,
					              payment_mail,
					              general_mail,
					              quotation_mail,
					              dispatch_mail,
					              personmet,
					              dc_mobile_no

					              FROM 

					              dailycall_personmet ,
					              dailycall_hdr 

					              WHERE  dailycall_personmet.dc_header_id =dailycall_hdr.dch_header_id
					              AND dailycall_hdr.dch_customerid =".$customer_id;

				//echo $sql; die;

				$result = $this->db->query($sql);
				$rowcount= $result->num_rows();
				return $rowcount;
				

		}

		function get_saved_lead_contact_info($lead_id,$customer_id)
		{

			//$customer_group = str_replace("'", "", $customer_group);
			//$customer_group = html_entity_decode($customer_group);

/*
					$sql="SELECT
					             dc_personmet_id, dc_leadid,dc_header_id,dc_personmet_name,dc_designation,deptname,
					              dc_phone_no,dc_email_id,dc_mailalert_to,dc_cust_id,soc_mail,payment_mail,general_mail,
					              quotation_mail,dispatch_mail,personmet,dc_mobile_no
					              FROM 
					              dailycall_personmet ,
					              dailycall_hdr 

					              WHERE  dailycall_personmet.dc_header_id =dailycall_hdr.dch_header_id
					              AND dailycall_hdr.dch_customerid =".$customer_id;*/

					 $sql="SELECT dc_personmet_id, dc_leadid,dc_header_id,dc_personmet_id, dc_leadid,dc_header_id,dc_personmet_name, 
					 			dc_designation, deptname, dc_phone_no, dc_email_id, dc_mailalert_to, dc_cust_id, soc_mail, payment_mail, 
					 			general_mail, quotation_mail, dispatch_mail, personmet, dc_mobile_no FROM dailycall_personmet , dailycall_hdr 
					 			WHERE 
								dailycall_personmet.dc_header_id =dailycall_hdr.dch_header_id 
								AND dailycall_personmet.dc_header_id in 
								(SELECT max(dc_header_id) FROM dailycall_personmet   WHERE dc_cust_id=".$customer_id." GROUP BY dc_cust_id) ";
						


			//echo $sql; die;

				$result = $this->db->query($sql);
				$customerdetails = $result->result_array();
				$jTableResult = array();
				$jTableResult['custprodinfo'] = $customerdetails;
				$data = array();
				$i=0;
		
				while($i < count($jTableResult['custprodinfo']))
				{    
				$row = array();
				$row["leadid"] = $jTableResult['custprodinfo'][$i]["dc_leadid"];
				$row["cust_id"] = $jTableResult['custprodinfo'][$i]["dc_cust_id"];
			//	$row["customer_name"] = $jTableResult['custprodinfo'][$i]["customer_name"];
				$row["contact_person"] = $jTableResult['custprodinfo'][$i]["dc_personmet_name"];
				$row["contact_no"] = $jTableResult['custprodinfo'][$i]["dc_phone_no"];
				$row["contact_mailid"] = $jTableResult['custprodinfo'][$i]["dc_email_id"]; 
				$row["designation"] = $jTableResult['custprodinfo'][$i]["dc_designation"];
				$row["deptname"] = $jTableResult['custprodinfo'][$i]["deptname"];
				$row["mobile_no"] = $jTableResult['custprodinfo'][$i]["dc_mobile_no"];
				$row["general_mail"] = $jTableResult['custprodinfo'][$i]["general_mail"];
				$row["soc_mail"] = $jTableResult['custprodinfo'][$i]["soc_mail"];
				$row["payment_mail"] = $jTableResult['custprodinfo'][$i]["payment_mail"];
				$row["quotation_mail"] = $jTableResult['custprodinfo'][$i]["quotation_mail"];
				$row["dispatch_mail"] = $jTableResult['custprodinfo'][$i]["dispatch_mail"];
				$row["personmet"] = $jTableResult['custprodinfo'][$i]["personmet"];
			//	$row["dct_prodsub_stsname"] = $jTableResult['custprodinfo'][$i]["dct_prodsub_stsname"];
			
					
				$data[$i] = $row;
				$i++;
				}
			$arr = "{\"cust_contact_data\":" .json_encode($data). "}";
		//	$arr = $data;

	 		return $arr;

		}
		


		function get_cust_contact_info($customer_group,$customer_id)
		{
			$customer_group = str_replace("'", "", $customer_group);
			$customer_group = html_entity_decode($customer_group);
/*			$sql="SELECT
								
								contact_persion,
								contact_no,
								contact_mailid,
								branch_manager_mailid,
								old_contact_mailid,
								block_mailid,
								purchase_contact_person,
								purchase_contact_no,
								purchase_mailid,
								despatch_contact_person,
								despatch_contact_no,
								despatch_mailid,
								commercial_manager
 						FROM 
							customermasterhdr 
						
						WHERE  REPLACE(trim(customergroup),'''','') ='".trim($customer_group)."'

						GROUP BY 

							contact_persion,
							contact_no,
							contact_mailid,
							branch_manager_mailid,
							old_contact_mailid,
							block_mailid,
							purchase_contact_person,
							purchase_contact_no,
							purchase_mailid,
							despatch_contact_person,
							despatch_contact_no,
							despatch_mailid,
							commercial_manager";*/
							$sql="SELECT
									dc_personmet_id,
									deptname,
									dc_personmet_name,
									dc_designation,
									dc_phone_no,
									dc_mobile_no,
									dc_email_id,
									soc_mail,
									payment_mail,
									general_mail,
									quotation_mail,
									dispatch_mail,
									personmet,
									ref_table
								FROM
									(
										SELECT
											0 AS dc_personmet_id,
											'ACCOUNTS' AS deptname,
											contact_persion AS dc_personmet_name,
											NULL dc_designation,
											contact_no AS dc_phone_no,
											NULL AS dc_mobile_no,
											contact_mailid AS dc_email_id,
											'false' :: TEXT AS soc_mail,
											'false' :: TEXT AS payment_mail,
											'false' :: TEXT AS general_mail,
											'false' :: TEXT AS quotation_mail,
											'false' :: TEXT AS dispatch_mail,
											'false' :: TEXT AS personmet,
											'customermasterhdr' :: TEXT AS ref_table,
											REPLACE (customergroup, '''', '') AS customergroup
										FROM
											customermasterhdr
										WHERE
											LENGTH (
												COALESCE (contact_mailid, '')
											) > 0
										UNION
											SELECT
												0 AS dc_personmet_id,
												'PURCHASE' AS deptname,
												purchase_contact_person AS dc_personmet_name,
												NULL dc_designation,
												purchase_contact_no AS dc_phone_no,
												NULL AS dc_mobile_no,
												purchase_mailid AS dc_email_id,
												'false' :: TEXT AS soc_mail,
												'false' :: TEXT AS payment_mail,
												'false' :: TEXT AS general_mail,
												'false' :: TEXT AS quotation_mail,
												'false' :: TEXT AS dispatch_mail,
												'false' :: TEXT AS personmet,
												'customermasterhdr' :: TEXT AS ref_table,
												REPLACE (customergroup, '''', '') AS customergroup
											FROM
												customermasterhdr
											WHERE
												LENGTH (
													COALESCE (purchase_mailid, '')
												) > 0
											UNION
												SELECT
													0 AS dc_personmet_id,
													'DESPATCH' AS deptname,
													despatch_contact_person AS dc_personmet_name,
													NULL dc_designation,
													despatch_contact_no AS dc_phone_no,
													NULL AS dc_mobile_no,
													despatch_mailid AS dc_email_id,
													'false' :: TEXT AS soc_mail,
													'false' :: TEXT AS payment_mail,
													'false' :: TEXT AS general_mail,
													'false' :: TEXT AS quotation_mail,
													'false' :: TEXT AS dispatch_mail,
													'false' :: TEXT AS personmet,
													'customermasterhdr' :: TEXT AS ref_table,
													REPLACE (customergroup, '''', '') AS customergroup
												FROM
													customermasterhdr
												WHERE
													LENGTH (
														COALESCE (despatch_mailid, '')
													) > 0
									) chdr
								WHERE
									REPLACE(trim(customergroup),'''','') ='".trim($customer_group)."'";



			//	echo $sql; die;
				$result = $this->db->query($sql);
				$customerdetails = $result->result_array();
				$jTableResult = array();
				$jTableResult['custprodinfo'] = $customerdetails;
				$data = array();
				$i=0;
		//dc_personmet_id,deptname,dc_personmet_name,dc_designation,dc_phone_no,dc_mobile_no,dc_email_id,soc_mail,payment_mail,general_mail,quotation_mail,dispatch_mail,personmet,ref_table
				while($i < count($jTableResult['custprodinfo']))
				{    
				$row = array();
				if (($jTableResult['custprodinfo'][$i]["deptname"]=="PURCHASE") || ($jTableResult['custprodinfo'][$i]["deptname"]=="ACCOUNTS"))
					{$row["payment_mail"]="true";} else{$row["payment_mail"]="false";}
				if ($jTableResult['custprodinfo'][$i]["deptname"]=="DESPATCH") 
					{$row["dispatch_mail"]="true";} else{$row["dispatch_mail"]="false";}
				$row["cust_id"] = $jTableResult['custprodinfo'][$i]["dc_personmet_id"];
				//$row["customer_name"] = $jTableResult['custprodinfo'][$i]["customer_name"];
				$row["contact_person"] = $jTableResult['custprodinfo'][$i]["dc_personmet_name"];
				$row["contact_no"] = $jTableResult['custprodinfo'][$i]["dc_phone_no"];
				$row["mobile_no"] = $jTableResult['custprodinfo'][$i]["dc_mobile_no"];
				
				$row["contact_mailid"] = $jTableResult['custprodinfo'][$i]["dc_email_id"];
				$row["designation"] = $jTableResult['custprodinfo'][$i]["dc_designation"];
				$row["deptname"] = $jTableResult['custprodinfo'][$i]["deptname"];
				$row["general_mail"] =  $jTableResult['custprodinfo'][$i]["general_mail"];
				$row["soc_mail"] =  $jTableResult['custprodinfo'][$i]["soc_mail"];
			//	$row["payment_mail"] =  $jTableResult['custprodinfo'][$i]["payment_mail"];
				$row["quotation_mail"] =  $jTableResult['custprodinfo'][$i]["quotation_mail"];
			//	$row["dispatch_mail"] = $jTableResult['custprodinfo'][$i]["dispatch_mail"];
				$row["personmet"] =  $jTableResult['custprodinfo'][$i]["personmet"];
			
					
				$data[$i] = $row;
				$i++;
				}
			$arr = "{\"cust_contact_data\":" .json_encode($data). "}";
		//	$arr = $data;

	 		return $arr;

		}
		function get_noof_rows_savedcust_contactinfo($customer_group,$customer_id)
		{
			$customer_group = str_replace("'", "", $customer_group);
			$customer_group = html_entity_decode($customer_group);


					$sql="SELECT
                					dc_personmet_id,
							dc_header_id,
							dc_personmet_name,
							dc_designation,
							deptname,
							dc_phone_no,
							dc_email_id,
							dc_mailalert_to,
							dc_cust_id,
							soc_mail,
							payment_mail,
							general_mail,
							quotation_mail,
							dispatch_mail,
							personmet,
							dc_mobile_no

							FROM 

							dailycall_personmet ,
							dailycall_hdr 

							WHERE  dailycall_personmet.dc_header_id =dailycall_hdr.dch_header_id
							AND dailycall_hdr.dch_custgroupname = '".trim($customer_group)."'";
						


			//echo $sql; die;

				$result = $this->db->query($sql);
				$rowcount= $result->num_rows();
				return $rowcount;


		}

		function get_saved_cust_contact_info($customer_group,$customer_id)
		{

			$customer_group = str_replace("'", "", $customer_group);
			$customer_group = html_entity_decode($customer_group);


					$sql="SELECT
                
							dc_personmet_id,
							dc_header_id,
							dc_personmet_name,
							dc_designation,
							deptname,
							dc_phone_no,
							dc_email_id,
							dc_mailalert_to,
							dc_cust_id,
							soc_mail,
							payment_mail,
							general_mail,
							quotation_mail,
							dispatch_mail,
							personmet,
							dc_mobile_no

							FROM 

							dailycall_personmet ,
							dailycall_hdr 

							WHERE  dailycall_personmet.dc_header_id =dailycall_hdr.dch_header_id
							AND dailycall_hdr.dch_custgroupname = '".trim($customer_group)."'";
						


			//echo $sql; die;

				$result = $this->db->query($sql);
				$customerdetails = $result->result_array();
				$jTableResult = array();
				$jTableResult['custprodinfo'] = $customerdetails;
				$data = array();
				$i=0;
		
				while($i < count($jTableResult['custprodinfo']))
				{    
				$row = array();
				$row["cust_id"] = $jTableResult['custprodinfo'][$i]["dc_cust_id"];
				//$row["customer_name"] = $jTableResult['custprodinfo'][$i]["customer_name"];
				$row["contact_person"] = $jTableResult['custprodinfo'][$i]["dc_personmet_name"];
				$row["contact_no"] = $jTableResult['custprodinfo'][$i]["dc_phone_no"];
				$row["contact_mailid"] = $jTableResult['custprodinfo'][$i]["dc_email_id"]; 
				$row["designation"] = $jTableResult['custprodinfo'][$i]["dc_designation"];
				$row["deptname"] = $jTableResult['custprodinfo'][$i]["deptname"];
				$row["mobile_no"] = $jTableResult['custprodinfo'][$i]["dc_mobile_no"];
				$row["general_mail"] = $jTableResult['custprodinfo'][$i]["general_mail"];
				$row["soc_mail"] = $jTableResult['custprodinfo'][$i]["soc_mail"];
				$row["payment_mail"] = $jTableResult['custprodinfo'][$i]["payment_mail"];
				$row["quotation_mail"] = $jTableResult['custprodinfo'][$i]["quotation_mail"];
				$row["dispatch_mail"] = $jTableResult['custprodinfo'][$i]["dispatch_mail"];
				$row["personmet"] = $jTableResult['custprodinfo'][$i]["personmet"];
			//	$row["dct_prodsub_stsname"] = $jTableResult['custprodinfo'][$i]["dct_prodsub_stsname"];
			
					
				$data[$i] = $row;
				$i++;
				}
			$arr = "{\"cust_contact_data\":" .json_encode($data). "}";
		//	$arr = $data;

	 		return $arr;

		}


			function get_leadcustprod_info($customer_id,$leadid)
			{
				/*$sql="SELECT  
							a.id
							,a.customer_name
							,a.tempcustname
							,b.leadid
							,b.company
							,c.productid as dct_prodid
							,c.quantity as dct_potential
							,c.potential as dct_quantity
							,c.lpid as dct_detail_id
							,c.prod_type_id
							,v.n_value as sale_type_name
							,v.n_value_id 
							, p.description as dct_prodname
						FROM 
							customermasterhdr a
							,leaddetails b
							,leadproducts c
							, (select   distinct  n_value,n_value_id from vw_sales_despatch_transaction_calss_fnd_flex_values_vl v  where 1=1 AND v.flex_value_set_id=1014311 ) v
							,view_tempitemmaster p
						WHERE 
								  a.id= b.company 
							AND c.leadid = b.leadid  
							AND b.leadid = ".$leadid." 
							AND b.company = ".$customer_id."  
							AND v.n_value_id = c.prod_type_id
							AND c.productid = p.id 	";*/

				//$sql="SELECT  *  FROM vw_daily_call_leadproducts WHERE company = ".$customer_id;
				$sql="SELECT 
							leadid,id, customer_name,dct_prodname,dct_quantity,dct_prodid,dct_detail_id,dct_prodstatusid,dct_prodstatusname,dct_prodsub_stsid,dct_prodsub_stsname,actionpoints,due_date,discussion_points,market_information,
							SUM(bulk) as Bulk,
							SUM(small_packing) as small_packing,
							SUM(part_tanker) as part_tanker,
							SUM(intact) as intact,
							SUM(repack) as repack,
							SUM(single_tanker) as single_tanker,
							SUM ( bulk+ small_packing+part_tanker+intact+repack+single_tanker) as total_potential
						FROM 
							(
								SELECT 
								leadid,id, customer_name,dct_prodname,dct_quantity,dct_prodid,dct_detail_id,dct_prodstatusid,dct_prodstatusname,dct_prodsub_stsid,dct_prodsub_stsname,prod_type_id,actionpoints,due_date,discussion_points,market_information,
								CASE 
								WHEN sale_type_name='Bulk' THEN
								total_potent
								ELSE 
								0
								END AS bulk,
								CASE
								WHEN sale_type_name = 'Small Packing' THEN
								total_potent
								ELSE
								0
								END AS small_packing,
								CASE
								WHEN sale_type_name = 'Part Tanker' THEN
								total_potent
								ELSE
								0
								END AS part_tanker,
								CASE
								WHEN sale_type_name = 'Intact' THEN
								total_potent
								ELSE
								0
								END AS intact,
								CASE
								WHEN sale_type_name = 'Single - Tanker' THEN
								total_potent
								ELSE
								0
								END AS single_tanker,
								CASE
								WHEN sale_type_name = 'Repack' THEN
								total_potent
								ELSE
								0
								END AS repack
								FROM
								lead_prod_type_horizontal_display_all WHERE id = ".$customer_id."
							) m
						group by	
						leadid,id, customer_name,dct_prodname,dct_quantity,dct_prodid,dct_detail_id,dct_prodstatusid,dct_prodstatusname,dct_prodsub_stsid,dct_prodsub_stsname,actionpoints,due_date,discussion_points,market_information";
			//	echo $sql; die;
				$result = $this->db->query($sql);
				$customerdetails = $result->result_array();

				

					$jTableResult = array();
					$jTableResult['custprodinfo'] = $customerdetails;
					$data = array();
					$i=0;
				//leadid,id,customer_name,dct_prodname,dct_prodid,dct_detail_id,dct_prodstatusid,dct_prodstatusname,dct_prodsub_stsid,dct_prodsub_stsname,bulk,small_packing,part_tanker,intact,repack,total_potential
					while($i < count($jTableResult['custprodinfo']))
					{    
					$row = array();
					$row["leadid"] = $jTableResult['custprodinfo'][$i]["leadid"];
					$row["dct_detail_id"] = $jTableResult['custprodinfo'][$i]["dct_detail_id"];
					$row["dct_prodname"] = $jTableResult['custprodinfo'][$i]["dct_prodname"];
					$row["dct_prodid"] = $jTableResult['custprodinfo'][$i]["dct_prodid"];
					/*$row["prod_type_id"] = $jTableResult['custprodinfo'][$i]["prod_type_id"];*/
					$row["bulk"] = $jTableResult['custprodinfo'][$i]["bulk"];
					$row["intact"] = $jTableResult['custprodinfo'][$i]["intact"];
					$row["small_packing"] = $jTableResult['custprodinfo'][$i]["small_packing"];
					$row["single_tanker"] = $jTableResult['custprodinfo'][$i]["single_tanker"];
					$row["part_tanker"] = $jTableResult['custprodinfo'][$i]["part_tanker"];
					$row["repack"] = $jTableResult['custprodinfo'][$i]["repack"];
					$row["total_potential"] = $jTableResult['custprodinfo'][$i]["total_potential"];
					$row["actionpoints"] = $jTableResult['custprodinfo'][$i]["actionpoints"];
					$row["due_date"] = $jTableResult['custprodinfo'][$i]["due_date"];
					$row["discussion_points"] =$jTableResult['custprodinfo'][$i]["discussion_points"];
					$row["dct_quantity"] = $jTableResult['custprodinfo'][$i]["dct_quantity"];
					$row["dct_salestypename"] = "";
					$row["dct_salestype_id"] = 0;
					$row["dct_description"] = "updated from dailycall product update";

					$row["dct_prodstatusid"] = $jTableResult['custprodinfo'][$i]["dct_prodstatusid"];
					$row["dct_prodsub_stsid"] = $jTableResult['custprodinfo'][$i]["dct_prodsub_stsid"];
					$row["dct_prodstatusname"] = $jTableResult['custprodinfo'][$i]["dct_prodstatusname"];
					$row["dct_prodsub_stsname"] = $jTableResult['custprodinfo'][$i]["dct_prodsub_stsname"];
					
				
					$row["dct_actionplanned"] = "";
					$row["dct_sales"] = "";
					$row["dct_collection"] = "";
					
					$row["dct_statuory"] = "";
					$row["dct_marketinformation"] ="";
					$row["market_information"] = $jTableResult['custprodinfo'][$i]["market_information"];
				
					$data[$i] = $row;
					$i++;
					}
				$arr = "{\"cust_prod_data\":" .json_encode($data). "}";
			//	$arr = $data;

		 		return $arr;

		}

			function get_dccustprod_info($customer_id)
			{
				

				$sql="SELECT  *  FROM vw_daily_call_prod_text WHERE  company = ".$customer_id;
			//echo $sql; die;
				$result = $this->db->query($sql);
				$customerdetails = $result->result_array();

				

					$jTableResult = array();
					$jTableResult['custprodinfo'] = $customerdetails;
					$data = array();
					$i=0;
				
					while($i < count($jTableResult['custprodinfo']))
					{    
					$row = array();
					$row["from_lead"] = $jTableResult['custprodinfo'][$i]["from_lead"];
					$row["dct_detail_id"] = $jTableResult['custprodinfo'][$i]["dct_detail_id"];
					$row["dct_prodname"] = $jTableResult['custprodinfo'][$i]["dct_prodname"];
					$row["dct_prodid"] = $jTableResult['custprodinfo'][$i]["dct_prodid"];
					$row["dct_potential"] = $jTableResult['custprodinfo'][$i]["dct_potential"];
					$row["dct_quantity"] = $jTableResult['custprodinfo'][$i]["dct_quantity"];
					$row["dct_salestypename"] = $jTableResult['custprodinfo'][$i]["sale_type_name"];
					$row["dct_salestype_id"] = $jTableResult['custprodinfo'][$i]["prod_type_id"];
					$row["dct_description"] = "updated from dailycall product update";

				//	$row["dct_prodstatusname"] = $jTableResult['custprodinfo'][$i]["dct_prodstatusname"];
				//	$row["dct_prodsub_stsname"] = $jTableResult['custprodinfo'][$i]["dct_prodsub_stsname"];
				
					$row["dct_actionplanned"] = $jTableResult['custprodinfo'][$i]["dct_actionplanned"];
					$row["dct_sales"] = $jTableResult['custprodinfo'][$i]["dct_sales"];
					$row["dct_collection"] = $jTableResult['custprodinfo'][$i]["dct_collection"];
					
					$row["dct_statuory"] = $jTableResult['custprodinfo'][$i]["dct_statuory"];
					$row["dct_marketinformation"] = $jTableResult['custprodinfo'][$i]["dct_marketinformation"];
				
					$data[$i] = $row;
					$i++;
					}
				$arr = "{\"cust_prod_data\":" .json_encode($data). "}";
			//	$arr = $data;

		 		return $arr;

		}

			function get_customerdetails($company_id,$leadid)
			{
				if($leadid=="")
				{
					$sql="SELECT
								*
						FROM 
							vw_daily_call_lead_customerinfo 
						where company =".$company_id;
				}
				else
				{
					$sql="SELECT
								*
						FROM 
							vw_daily_call_lead_customerinfo 
						where company =".$company_id." AND leadid=".$leadid;
				}
		
			//echo $sql; die;
				$result = $this->db->query($sql);
				$customerdetails = $result->result_array();
					$jTableResult = array();
					$jTableResult['custleaddetails'] = $customerdetails;
					$data = array();
					$i=0;
					while($i < count($jTableResult['custleaddetails']))
					{    

					$row = array();
					$row["leadid"] = $jTableResult['custleaddetails'][$i]["leadid"];
					$row["company"] = $jTableResult['custleaddetails'][$i]["company"];
					$row["firstname"] = $jTableResult['custleaddetails'][$i]["firstname"];
					$row["lastname"] = $jTableResult['custleaddetails'][$i]["lastname"];
					$row["credit_assesment"] = $jTableResult['custleaddetails'][$i]["credit_assesment"];
					$row["designation"] = $jTableResult['custleaddetails'][$i]["designattion"];
					$row["website"] = $jTableResult['custleaddetails'][$i]["website"];
					$row["description"] = $jTableResult['custleaddetails'][$i]["description"];
					$row["industry_id"] = $jTableResult['custleaddetails'][$i]["industry_id"];
					$row["email_id"] = $jTableResult['custleaddetails'][$i]["email_id"];
					$row["user_branch"] = $jTableResult['custleaddetails'][$i]["user_branch"];
					$row["leadsource"] = $jTableResult['custleaddetails'][$i]["leadsource"];
					$row["leadsourceid"] = $jTableResult['custleaddetails'][$i]["leadsourceid"];
					$row["tempcustname"] = $jTableResult['custleaddetails'][$i]["tempcustname"];
					$row["leadstatusid"] = $jTableResult['custleaddetails'][$i]["leadstatusid"];
					$row["leadstatus"] = $jTableResult['custleaddetails'][$i]["leadstatus"];
					$row["leadsubstatusid"] = $jTableResult['custleaddetails'][$i]["leadsubstatusid"];
					$row["leadsubstsname"] = $jTableResult['custleaddetails'][$i]["leadsubstsname"];
					$row["assignleadchk"] = $jTableResult['custleaddetails'][$i]["assignleadchk"];
					$row["assign_to_name"] = $jTableResult['custleaddetails'][$i]["assign_to_name"];
					$row["createddate"] = $jTableResult['custleaddetails'][$i]["createddate"];
					$row["leadid"] = $jTableResult['custleaddetails'][$i]["leadid"];
					$row["last_modified"] = $jTableResult['custleaddetails'][$i]["last_modified"];
					
					$row["customeraddress"] = $jTableResult['custleaddetails'][$i]["customeraddress"];
					$row["city"] = $jTableResult['custleaddetails'][$i]["city"];
					$row["fax"] = $jTableResult['custleaddetails'][$i]["fax"];
					$row["country"] = $jTableResult['custleaddetails'][$i]["country"];
					$row["postal_code"] = $jTableResult['custleaddetails'][$i]["postal_code"];
					$row["state"] = $jTableResult['custleaddetails'][$i]["state"];
					$row["phone"] = $jTableResult['custleaddetails'][$i]["phone"];
					$row["mobile_no"] = $jTableResult['custleaddetails'][$i]["mobile_no"];

					$row["actionpoints"] = $jTableResult['custleaddetails'][$i]["actionpoints"];
					$row["discussion_points"] = $jTableResult['custleaddetails'][$i]["discussion_points"];
					$row["due_date"] = $jTableResult['custleaddetails'][$i]["due_date"];

					$data[$i] = $row;
					$i++;
					}
				//$arr = "{\"data\":" .json_encode($data). "}";
				$arr = $data;

		 		return $arr;

	}

			function get_customerdetailsgrp($customergroup,$leadid)
			{
				
				$customergroup = str_replace("'", "", $customergroup);
				$customergroup = html_entity_decode($customergroup);
				if($leadid=="")
				{
					$sql="SELECT
								*
						FROM 
							vw_daily_call_customerinfo_new 


						WHERE REPLACE(customergroup,'''','') like '".trim($customergroup)."' ";
				}
				else
				{
					$sql="SELECT
								*
						FROM 
							vw_daily_call_customerinfo_new 
						 
						  WHERE REPLACE(customergroup,'''','') like '".trim($customergroup)."' and leadid =".$leadid." LIMIT 1";
				}
		
			//echo $sql; die;
				$result = $this->db->query($sql);
				$customerdetails = $result->result_array();
				//print_r($customerdetails); die;
					$jTableResult = array();
					$jTableResult['custleaddetails'] = $customerdetails;
					$data = array();
					$i=0;
					while($i < count($jTableResult['custleaddetails']))
					{    

					$row = array();
					$row["leadid"] = $jTableResult['custleaddetails'][$i]["leadid"];
					$row["company"] = $jTableResult['custleaddetails'][$i]["company"];
					$row["firstname"] = $jTableResult['custleaddetails'][$i]["firstname"];
					$row["lastname"] = $jTableResult['custleaddetails'][$i]["lastname"];
					$row["website"] = $jTableResult['custleaddetails'][$i]["website"];
					$row["description"] = $jTableResult['custleaddetails'][$i]["description"];
					$row["industry_id"] = $jTableResult['custleaddetails'][$i]["industry_id"];
					$row["email_id"] = $jTableResult['custleaddetails'][$i]["email_id"];
					$row["user_branch"] = $jTableResult['custleaddetails'][$i]["user_branch"];
					$row["leadsource"] = $jTableResult['custleaddetails'][$i]["leadsource"];
					$row["leadsourceid"] = $jTableResult['custleaddetails'][$i]["leadsourceid"];
					$row["tempcustname"] = $jTableResult['custleaddetails'][$i]["tempcustname"];
					$row["leadstatusid"] = $jTableResult['custleaddetails'][$i]["leadstatusid"];
					$row["leadstatus"] = $jTableResult['custleaddetails'][$i]["leadstatus"];
					$row["leadsubstatusid"] = $jTableResult['custleaddetails'][$i]["leadsubstatusid"];
					$row["leadsubstsname"] = $jTableResult['custleaddetails'][$i]["leadsubstsname"];
					$row["assignleadchk"] = $jTableResult['custleaddetails'][$i]["assignleadchk"];
					$row["assign_to_name"] = $jTableResult['custleaddetails'][$i]["assign_to_name"];
					$row["createddate"] = $jTableResult['custleaddetails'][$i]["createddate"];
					$row["leadid"] = $jTableResult['custleaddetails'][$i]["leadid"];
					$row["last_modified"] = $jTableResult['custleaddetails'][$i]["last_modified"];
					$row["customerid"] = $jTableResult['custleaddetails'][$i]["customerid"];
					$row["cust_account_id"] = $jTableResult['custleaddetails'][$i]["cust_account_id"];
					$row["customeraddress"] = $jTableResult['custleaddetails'][$i]["customeraddress"];
					$row["city"] = $jTableResult['custleaddetails'][$i]["city"];
					$row["fax"] = $jTableResult['custleaddetails'][$i]["fax"];
					$row["country"] = $jTableResult['custleaddetails'][$i]["country"];
					$row["postal_code"] = $jTableResult['custleaddetails'][$i]["postal_code"];
					$row["state"] = $jTableResult['custleaddetails'][$i]["state"];
					$row["phone"] = $jTableResult['custleaddetails'][$i]["phone"];
					$row["mobile_no"] = $jTableResult['custleaddetails'][$i]["mobile_no"];
					
					$row["companycode"] = $jTableResult['custleaddetails'][$i]["companycode"];
					$row["customergroup"] = $jTableResult['custleaddetails'][$i]["customergroup"];
					$row["executivename"] = $jTableResult['custleaddetails'][$i]["executivename"];
					$row["technicalexecutive"] = $jTableResult['custleaddetails'][$i]["technicalexecutive"];
					$row["contact_persion"] = $jTableResult['custleaddetails'][$i]["contact_persion"];
					$row["contact_no"] = $jTableResult['custleaddetails'][$i]["contact_no"];
					$row["contact_mailid"] = $jTableResult['custleaddetails'][$i]["email_id"];
					$row["branch_manager_mailid"] = $jTableResult['custleaddetails'][$i]["branch_manager_mailid"];
					$row["received_branch"] = $jTableResult['custleaddetails'][$i]["received_branch"];
					$row["industry_segment"] = $jTableResult['custleaddetails'][$i]["industry_segment"];
					$row["purchase_contact_person"] = $jTableResult['custleaddetails'][$i]["purchase_contact_person"];
					$row["purchase_contact_no"] = $jTableResult['custleaddetails'][$i]["purchase_contact_no"];
					$row["purchase_mailid"] = $jTableResult['custleaddetails'][$i]["purchase_mailid"];
					$row["despatch_contact_person"] = $jTableResult['custleaddetails'][$i]["despatch_contact_person"];
					$row["despatch_contact_no"] = $jTableResult['custleaddetails'][$i]["despatch_contact_no"];
					$row["despatch_mailid"] = $jTableResult['custleaddetails'][$i]["despatch_mailid"];
					$row["commercial_manager"] = $jTableResult['custleaddetails'][$i]["commercial_manager"];

					$data[$i] = $row;
					$i++;
					}

				//$arr = "{\"data\":" .json_encode($data). "}";
				$arr = $data;

		 		return $arr;

	}

	function get_cust_group_credit_limit($customergroup)
	{
		$sql="select customer_credit_limit_group('".$customergroup."')";
		$result = $this->db->query($sql);
		$credit_limit = $result->result_array();
		//echo"credit limit is ".$credit_limit[0]['customer_credit_limit']."<br>";
		return $credit_limit[0]['customer_credit_limit_group'];
	}

	function get_credit_limit($customergroup)
	{
		$customergroup = str_replace("'", "", $customergroup);
		$customergroup = html_entity_decode($customergroup);
		$sql="SELECT
						cust_account_id
				FROM 
						customermasterhdr 

				WHERE REPLACE(trim(customergroup),'''','') like '".trim($customergroup)."'";
          
        //  echo $sql; die;
		 		$result = $this->db->query($sql);
				$customerdetails = $result->result_array();
			//	print_r($customerdetails); die;
					
					
					$data = array();
					$sum = 0;
					foreach($customerdetails as $key => $value) {
					   //$sum += $value; 
						
						$sum += $this->get_customer_creditlimit($value['cust_account_id']);
						
					}
				//	$data['tot_credit_limit'] = $sum;
				return $sum;

	}

			function get_customer_creditlimit($customer_number)
			{
				$sql="select customer_credit_limit(".$customer_number.")";
			
				$result = $this->db->query($sql);
				$credit_limit = $result->result_array();
				//echo"credit limit is ".$credit_limit[0]['customer_credit_limit']."<br>";
				return $credit_limit[0]['customer_credit_limit'];


			}

		/*function get_custprodhdr($company_id)
		{
			
					$sql="SELECT
							*
					FROM 
						daily_call_hdr 
					where dch_customerid =".$company_id;
				//	echo $sql; die;
					$result = $this->db->query($sql);
					$customerdetails = $result->result_array();

				

					$jTableResult = array();
					$jTableResult['custprodhdr'] = $customerdetails;
					$data = array();
					$i=0;
					while($i < count($jTableResult['custprodhdr']))
					{    

					$row = array();
					$row["dch_header_id"] = $jTableResult['custprodhdr'][$i]["dch_header_id"];
					$row["dch_visittypename"] = $jTableResult['custprodhdr'][$i]["dch_visittypename"];
					$row["dch_modofcontname"] = $jTableResult['custprodhdr'][$i]["dch_modofcontname"];
					$row["dch_statusname"] = $jTableResult['custprodhdr'][$i]["dch_statusname"];
					$row["dch_substatusname"] = $jTableResult['custprodhdr'][$i]["dch_substatusname"];
					$row["dch_personmet"] = $jTableResult['custprodhdr'][$i]["dch_personmet"];
					$row["dch_quotation_email"] = $jTableResult['custprodhdr'][$i]["dch_quotation_email"];
					$row["dch_created_date"] = $jTableResult['custprodhdr'][$i]["dch_created_date"];
					$row["dch_created_userid"] = $jTableResult['custprodhdr'][$i]["dch_created_userid"];
					$row["dch_created_usename"] = $jTableResult['custprodhdr'][$i]["dch_created_usename"];
					$row["dch_updated_date"] = $jTableResult['custprodhdr'][$i]["dch_updated_date"];
					$row["dch_updated_userid"] = $jTableResult['custprodhdr'][$i]["dch_updated_userid"];
					$row["dch_updated_username"] = $jTableResult['custprodhdr'][$i]["dch_updated_username"];
					$row["dch_visitdate"] = $jTableResult['custprodhdr'][$i]["dch_visitdate"];
					
					$data[$i] = $row;
					$i++;
					}
				//$arr = "{\"data\":" .json_encode($data). "}";
				$arr = $data;

		 		return $arr;

		}*/


		function get_custprodhdr($company_id)
		{
			
					$sql="SELECT 	*  FROM dailycall_log_hdr  where hdr_customer_id =".$company_id." order by	hdrlog_id desc ";
					//echo $sql; die;
					$result = $this->db->query($sql);
					$customerdetails = $result->result_array();
					$jTableResult = array();
					$jTableResult['custprodhdr'] = $customerdetails;
					$data = array();
					$i=0;
					while($i < count($jTableResult['custprodhdr']))
					{    

					$row = array();

					$row["dch_header_id"] = $jTableResult['custprodhdr'][$i]["hdrlog_id"];
					$row["dch_visittypename"] = $jTableResult['custprodhdr'][$i]["hdr_visittype_name"];
					$row["dch_modofcontname"] = $jTableResult['custprodhdr'][$i]["hdr_modeofcontact_name"];
					$row["dch_statusname"] = $jTableResult['custprodhdr'][$i]["hdr_status_name"];
					$row["dch_substatusname"] = $jTableResult['custprodhdr'][$i]["hdr_substs_name"];
					$row["dch_personmet"] = $jTableResult['custprodhdr'][$i]["hdr_personmet"];
					$row["dch_quotation_email"] = $jTableResult['custprodhdr'][$i]["hdr_quotation_email_id"];
					$row["dch_created_date"] = $jTableResult['custprodhdr'][$i]["hdr_createdate"];
					$row["dch_created_userid"] = $jTableResult['custprodhdr'][$i]["hdr_createduser"];
					$row["dch_created_username"] = $jTableResult['custprodhdr'][$i]["hdr_createduser_name"];
					$row["dch_updated_username"] = $jTableResult['custprodhdr'][$i]["hdr_updateduser_name"];
					$row["dch_updated_date"] = $jTableResult['custprodhdr'][$i]["hdr_updateddate"];
					$row["dch_updated_userid"] = $jTableResult['custprodhdr'][$i]["hdr_updateduser"];
					$row["dch_updated_userid"] = $jTableResult['custprodhdr'][$i]["hdr_updateduser"];
					$row["dch_comments"] = $jTableResult['custprodhdr'][$i]["hdr_comments"];
					$row["dch_visitdate"] = $jTableResult['custprodhdr'][$i]["hdr_visitdate"];
					
					$data[$i] = $row;
					$i++;
					}
				//$arr = "{\"data\":" .json_encode($data). "}";
				$arr = $data;

		 		return $arr;

		}
		function get_custprodhdrgrp($customergroup)
		{
						$customergroup = str_replace("'", "", $customergroup);
			
					
					$sql="SELECT 	*  FROM dailycall_log_hdr WHERE upper(trim(REPLACE(hdr_customer_group,'''','')))  = '".$customergroup."' order by	hdrlog_id desc "; 
				
					//echo $sql; die;
					$result = $this->db->query($sql);
					$customerdetails = $result->result_array();
					$jTableResult = array();
					$jTableResult['custprodhdr'] = $customerdetails;
					$data = array();
					$i=0;
					while($i < count($jTableResult['custprodhdr']))
					{    

					$row = array();
		//hdrlog_id,hdr_status_id,hdr_customer_id,hdr_customer_name,hdr_status_name,hdr_substs_id,hdr_visitdate,hdr_substs_name,hdr_comments,hdr_createdate,hdr_updateddate,hdr_createduser,hdr_createduser_name,hdr_updateduser,hdr_visittype_name,hdr_visittype_id,hdr_modeofcontact_name,hdr_modeofcontact_id,hdr_personmet,hdr_quotation_email_id,hdr_transtype,hdr_updateduser_name,hdr_time_hrs,hdr_time_mis,hdr_collection,hdr_statuory,hdr_leadid,hdr_customer_group,hdr_to_time_hrs,hdr_to_time_mis

					$row["dch_header_id"] = $jTableResult['custprodhdr'][$i]["hdrlog_id"];
					$row["dch_visittypename"] = $jTableResult['custprodhdr'][$i]["hdr_visittype_name"];
					$row["dch_modofcontname"] = $jTableResult['custprodhdr'][$i]["hdr_modeofcontact_name"];
					$row["dch_statusname"] = $jTableResult['custprodhdr'][$i]["hdr_status_name"];
					$row["dch_substatusname"] = $jTableResult['custprodhdr'][$i]["hdr_substs_name"];
					$row["dch_personmet"] = $jTableResult['custprodhdr'][$i]["hdr_personmet"];
					$row["dch_quotation_email"] = $jTableResult['custprodhdr'][$i]["hdr_quotation_email_id"];
					$row["dch_created_date"] = $jTableResult['custprodhdr'][$i]["hdr_createdate"];
					$row["dch_created_userid"] = $jTableResult['custprodhdr'][$i]["hdr_createduser"];
					$row["dch_created_username"] = $jTableResult['custprodhdr'][$i]["hdr_createduser_name"];
					$row["dch_updated_username"] = $jTableResult['custprodhdr'][$i]["hdr_updateduser_name"];
					$row["dch_updated_date"] = $jTableResult['custprodhdr'][$i]["hdr_updateddate"];
					$row["dch_updated_userid"] = $jTableResult['custprodhdr'][$i]["hdr_updateduser"];
					$row["dch_updated_userid"] = $jTableResult['custprodhdr'][$i]["hdr_updateduser"];
					$row["dch_comments"] = $jTableResult['custprodhdr'][$i]["hdr_comments"];
					$row["dch_visitdate"] = $jTableResult['custprodhdr'][$i]["hdr_visitdate"];
					
					$data[$i] = $row;
					$i++;
					}
				//$arr = "{\"data\":" .json_encode($data). "}";
				$arr = $data;

		 		return $arr;

		}
		function get_custvisit_hdrdetails($log_id)
		{
					$sql="SELECT distinct  hdrlog_id,hdr_status_id,hdr_status_name,hdr_substs_id,hdr_substs_name,hdr_comments,hdr_createdate,hdr_updateddate,hdr_createduser,hdr_updateduser,hdr_visittype_name,hdr_visittype_id,hdr_modeofcontact_name,hdr_modeofcontact_id,hdr_personmet,hdr_quotation_email_id,hdr_transtype,hdr_createduser_name,hdr_customer_id,hdr_customer_name,hdr_visitdate,hdr_updateduser_name,hdr_collection,hdr_statuory,hdr_time_hrs,hdr_time_mis  from vw_dc_visit_details where dtllog_hdr_id=".$log_id;
				
					//echo $sql; 
					$result = $this->db->query($sql);
					$customerdetails = $result->result_array();
					
					$arr = $customerdetails;

		 		return $arr;
		}
		
		function get_custvisit_persondetails($log_id)
		{
					$sql="SELECT  distinct dc_personmet_id,dc_header_id,dc_personmet_name,dc_designation,dc_phone_no,dc_mobile_no,dc_email_id,dc_mailalert_to,dc_cust_id,soc_mail,payment_mail,general_mail,quotation_mail,dispatch_mail,hdr_personmet from vw_dc_visit_details WHERE dc_header_id=".$log_id;
				
					//echo $sql; 
					$result = $this->db->query($sql);
					$customerdetails = $result->result_array();
					
					$arr = $customerdetails;

		 		return $arr;
		}
		function get_custvisit_proddetails($log_id)
		{
					$sql="SELECT DISTINCT hdr_updateduser_name,dtllog_id,dtllog_hdr_id,dtllog_prodid,dtllog_prodname,dtllog_poten,dtllog_qnty,dtllog_salestype_id,dtllog_salestype_name,dtllog_actionplanned,dtllog_sales,dtllog_collection,dtllog_satutory,dtllog_market_info,dtllog_createddate,dtllog_createduser,dtllog_updateddate,dtllog_updateduser,dtllog_prodgroup  from vw_dc_visit_details where dtllog_hdr_id=".$log_id;
				
				//	echo $sql; 
					$result = $this->db->query($sql);
					$customerdetails = $result->result_array();
					
					$arr = $customerdetails;

		 		return $arr;
		}

		function get_dc_leadsubstatus($parent_id,$leadid)
		{
			//$sql="SELECT lst_sub_id, lst_name, lst_order_by FROM leadsubstatus WHERE lst_order_by >=(
	//select  ldsubstatus from  leaddetails where leadid=".$this->session->userdata['run_time_dc_lead_id'].")  AND lst_parentid =".$this->parent_id;
			$sql="SELECT lst_sub_id, lst_name, lst_order_by FROM leadsubstatus WHERE lst_order_by >=(
	select  ldsubstatus from  leaddetails where leadid=".$leadid.")  AND lst_parentid =".$this->parent_id;
		//	echo $sql;
			  	$result = $this->db->query($sql);
				$substatus = $result->result_array();

			$substatus_arr=array();
			foreach ($substatus as $substat) {
						$substatus_arr[$substat['lst_sub_id']] = $substat['lst_name'];
					}
					return $substatus_arr;
		}
		function get_dc_leadsubstatusgrid($parent_id,$leadid)
		{
			
			$sql="SELECT lst_sub_id, lst_name, lst_order_by FROM leadsubstatus WHERE lst_order_by >=(
	select  ldsubstatus from  leaddetails where leadid=".$leadid.")  AND lst_parentid =".$this->parent_id." ORDER BY lst_order_by ";
		//	echo $sql;
			  	$result = $this->db->query($sql);
				$arr =  json_encode($result->result_array());
					return $arr;
		}

		function get_leadgrid_substatus($parent_id)
		{
			//$sql="SELECT lst_sub_id, lst_name, lst_order_by FROM leadsubstatus WHERE lst_parentid=".$parent_id." ORDER BY lst_order_by";
			//$sql="SELECT lst_sub_id, lst_name, lst_order_by FROM leadsubstatus WHERE lst_name='".$parent_id."' ORDER BY lst_order_by";
			$sql="SELECT lst_sub_id, lst_name, lst_order_by FROM leadsubstatus WHERE lst_parentid=(SELECT leadstatusid from leadstatus where trim(leadstatus)='".trim($parent_id)."' ) ORDER BY lst_order_by";
		//	echo $sql;   die;
			$result = $this->db->query($sql);
	//	    $arr =  json_encode($result->result_array());
		    $arr = "{\"leadsubstatus\":" .json_encode($result->result_array()). "}";
		    return $arr;
		}


		function check_duplicates_daillycall($visit_date,$customergroup,$user1)
		{
				$customergroup = str_replace("'", "", $customergroup);
				//$sql="SELECT h.dch_created_usename FROM daily_call_hdr h ,daily_call_dtl d WHERE  h.dch_visitdate ='".$visit_date."' AND 	h.dch_created_usename= 'SATHYA' AND h.dch_custname='".$customername."'";
				//$sql="SELECT dch_created_usename FROM daily_call_hdr WHERE  dch_visitdate ='".$visit_date."' AND dch_created_usename= '".$user1."' AND dch_custname='".$customername."'";
				$sql="SELECT dch_created_usename  FROM dailycall_hdr WHERE dch_visitdate='".$visit_date."' AND dch_created_usename= '".$user1."' AND  REPLACE(dch_custgroupname,'''','')   like '".trim($customergroup)."'";

				

				// $sql= "SELECT exename FROM dailyactivityhdr,dailyactivitydtl WHERE currentdate ='".$visit_date."' AND user1= '".$user1."' and dailyactivitydtl.id=dailyactivityhdr.id and dailyactivitydtl.custgroup='".$customername."'";
				 //echo $sql; die;
				 $result = $this->db->query($sql);
				 $rowcount= $result->num_rows();
				 if ($rowcount==0)
				 {
				 	return "true";
				 }
				 {
				 	return "false";
				 }
		}

		function check_prodduplicates_daillycall($prodid,$customerid,$user1)
		{

				 $sql= "SELECT dct_prodid FROM dailycall_hdr h,dailycall_dtl d WHERE h.dch_header_id = d.dct_header_id AND h.dch_customerid =".$customerid." AND  d.dct_prodid=".$prodid;
				// echo $sql;	die;				
				 $result = $this->db->query($sql);
				 $rowcount= $result->num_rows();
				 if ($rowcount==0)
				 {
				 	return "true";
				 }
				 {
				 	return "false";
				 }
		}

		function check_prodnameduplicates_daillycall($prodname,$customerid,$customergroup,$user1)
		{

				// $sql= "SELECT dct_prodid FROM daily_call_hdr h,daily_call_dtl d WHERE h.dch_header_id = d.dct_header_id AND h.dch_customerid =".$customerid." AND  d.dct_prodid=".$prodid;
 				//$sql= "SELECT dct_itemgroup from dailycall_dtl WHERE dct_customergroup ='".$prodname."'  AND dct_itemgroup ='".$customerid."'";
 			//   $sql= "SELECT dct_itemgroup from dailycall_dtl WHERE dct_customergroup ='".$prodname."'  AND dct_itemgroup ='".$prodname."'";
 				$sql="SELECT dct_itemgroup, dct_businesscategory,dct_customer_potential  from dailycall_dtl WHERE dct_customergroup ='".$customergroup."'   AND dct_itemgroup ='".$prodname."'";

				// echo $sql;	die;				
				 $result = $this->db->query($sql);
				 $rowcount= $result->num_rows();

				/* $sql_lead="SELECT 
								i.description as productname,
								i.itemgroup as productgroup,
								i.id as Prodid,
								d.leadid, 
								p.productid,
								d.company 
								FROM 
								leadproducts p, leaddetails d, view_tempitemmaster_grp i
								WHERE 	
								p.leadid = d.leadid
								and d.company=".$customerid."
								and p.productid = i.id
								and i.itemgroup='".$prodname."'";

				// echo $sql;	die;				
				 $resultlead = $this->db->query($sql_lead);
				 $rowcountlead= $resultlead->num_rows();*/

				
				// if(($rowcountlead==0) AND ($rowcount==0))
				 if ($rowcount==0)
				 {
				 	return "true";
				 }
				 {
				 	return "false";
				 }
		}
		function check_prodnameduplicates_lead($prodname,$customerid,$customergroup,$user1)
		{

				// $sql= "SELECT dct_prodid FROM daily_call_hdr h,daily_call_dtl d WHERE h.dch_header_id = d.dct_header_id AND h.dch_customerid =".$customerid." AND  d.dct_prodid=".$prodid;
 				//$sql= "SELECT dct_itemgroup from dailycall_dtl WHERE dct_customergroup ='".$prodname."'  AND dct_itemgroup ='".$customerid."'";
 			//   $sql= "SELECT dct_itemgroup from dailycall_dtl WHERE dct_customergroup ='".$prodname."'  AND dct_itemgroup ='".$prodname."'";
 				$sql="SELECT 
								i.description as productname,
								i.itemgroup as productgroup,
								i.id as Prodid,
								d.leadid, 
								p.productid,
								d.company 
								FROM 
								leadproducts p, leaddetails d, view_tempitemmaster_grp i
								WHERE 	
								p.leadid = d.leadid
								and d.company=".$customerid."
								and p.productid = i.id
								and i.itemgroup='".$prodname."'";

				// echo $sql;	die;				
				 $result = $this->db->query($sql);
				 $rowcount= $result->num_rows();
				 if ($rowcount==0)
				 {
				 	return "true";
				 }
				 {
				 	return "false";
				 }
		}


		

		function check_customerbyname_dailycall($customername,$customergroup,$customerid,$user1)
		{

				// $sql= "SELECT dct_prodid FROM daily_call_hdr h,daily_call_dtl d WHERE h.dch_header_id = d.dct_header_id AND h.dch_customerid =".$customerid." AND  d.dct_prodid=".$prodid;
 				//$sql= "SELECT dct_itemgroup from dailycall_dtl WHERE dct_customergroup ='".$prodname."'  AND dct_itemgroup ='".$customerid."'";
 			//   $sql= "SELECT dct_itemgroup from dailycall_dtl WHERE dct_customergroup ='".$prodname."'  AND dct_itemgroup ='".$prodname."'";
 				$sql="SELECT dct_itemgroup from dailycall_dtl WHERE dct_customergroup ='".$customergroup."'   AND dct_itemgroup ='".$prodname."'";

				// echo $sql;	die;				
				 $result = $this->db->query($sql);
				 $rowcount= $result->num_rows();
				 if ($rowcount==0)
				 {
				 	return "true";
				 }
				 {
				 	return "false";
				 }
		}

		function checkdc_leadprod_duplicates($prodid,$customerid,$user1)
		{

				// $sql= "SELECT dct_prodid FROM daily_call_hdr h,daily_call_dtl d WHERE h.dch_header_id = d.dct_header_id AND h.dch_customerid =".$customerid." AND  d.dct_prodid=".$prodid;

				// $sql='SELECT (itemmaster.itemid)::character varying(20) AS id, itemmaster.description FROM itemmaster UNION ALL SELECT tempitemmaster.temp_item_sync_id AS id, tempitemmaster.temp_itemname AS description FROM tempitemmaster';
				$sql= "SELECT  dct_prodname,leadid,dct_prodid FROM vw_daily_call_leadproducts WHERE  company::character varying ='".$customerid."' AND dct_prodid::character varying='".$prodid."'";


			//	 echo $sql;	die;				
				 $result = $this->db->query($sql);
				 $rowcount= $result->num_rows();
				 if ($rowcount==0)
				 {
				 	return "true";
				 }
				 {
				 	return "false";
				 }
		}

		function get_viewdiallycalldetails_bycustomer($customername)
				{

				$jTableResult = array();

				$loginname = $this->session->userdata['identity'];
				// $sql="SELECT id,custgroup,exename,branch,itemgroup,potentialqty,subactivity,modeofcontact,hour_s,minit,quantity,division,date,remarks,l1status,complaints, user_id,description,actionplanned,detailed_description from vw_web_daily_activity d where id ='".$header_id."'";
				if($customername==null or $customername=="")
				{
					
				 $sql="SELECT id,custgroup,exename,branch,itemgroup,potentialqty,subactivity,modeofcontact,hour_s,minit,quantity,division,date,remarks,l1status,complaints, user_id,description,actionplanned,detailed_description,sales,collection,statuory,marketinformation,comments
								 from vw_web_daily_activity_dc  limit 10";
				}
				else
				{
				  $sql="SELECT id,custgroup,exename,branch,itemgroup,potentialqty,subactivity,modeofcontact,hour_s,minit,quantity,division,date,remarks,l1status,complaints, user_id,description,actionplanned,detailed_description,sales,collection,statuory,marketinformation,comments
 from vw_web_daily_activity_dc where custgroup ='".$customername."'";	 
				}	
				 

			//	echo $sql; die;
				$result = $this->db->query($sql);	
				$activitydetails = $result->result_array();
				$all_record_count = count($activitydetails);
				$this->session->set_userdata('all_record_count',$all_record_count);
				$data = array();
				
				$i=0;
				while($i < count($activitydetails))
				{    
					$row = array();
				//	$row["id"] = $activitydetails[$i]["id"];
					$row["custgroup"] = $activitydetails[$i]["custgroup"];
					$row["itemgroup"] = $activitydetails[$i]["itemgroup"];
					$row["potentialqty"] = $activitydetails[$i]["potentialqty"];
					$row["subactivity"] = $activitydetails[$i]["subactivity"];
					$row["exename"] = $activitydetails[$i]["exename"];
					$row["branch"] = $activitydetails[$i]["branch"];
					$row["modeofcontact"] = $activitydetails[$i]["modeofcontact"];
					$row["hour_s"] = $activitydetails[$i]["hour_s"];
					$row["minit"] = $activitydetails[$i]["minit"];
					$row["quantity"] = $activitydetails[$i]["quantity"];
					$row["division"] = $activitydetails[$i]["division"];
					$row["date"] = $activitydetails[$i]["date"];
					$row["remarks"] = $activitydetails[$i]["remarks"];
					$row["l1status"] = $activitydetails[$i]["l1status"];
					$row["complaints"] = $activitydetails[$i]["complaints"];
					$row["description"] = $activitydetails[$i]["description"];
					$row["actionplanned"] = $activitydetails[$i]["actionplanned"];
					$row["detailed_description"] = $activitydetails[$i]["detailed_description"];
					$row["sales"] = $activitydetails[$i]["sales"];
					$row["collection"] = $activitydetails[$i]["collection"];
					$row["statuory"] = $activitydetails[$i]["statuory"];
					$row["marketinformation"] = $activitydetails[$i]["marketinformation"];
					$row["comments"] = $activitydetails[$i]["comments"];

					$data[$i] = $row;
					$i++;
			}
			$arr = "{\"data\":" .json_encode($data). "}";
			//	echo "{ rows: ".$arr." }";
			return $arr;
		}

		function deteled_dailyactivitydtl($dtl_id)
			{
				if(isset($dtl_id) && !empty($dtl_id))
		            {
		              	$this->db->where('id',$dtl_id);
		              	$this->db->delete('dailyactivitydtl');
		              	return  $this->db->affected_rows();	
		          
		           	 }
			}

			function update_dailyactivityhdr($daily_hdr,$daily_hdr_id)
			{

				$this->db->where('id', $daily_hdr_id);
				$this->db->update('dailyactivityhdr', $daily_hdr);
				return ($this->db->affected_rows() > 0);
			}

			function get_productsfordc()
			{
				$sql='SELECT  DISTINCT on (description) id, description FROM view_tempitemmaster ORDER BY description asc';
				$result = $this->db->query($sql);
				$arr =  json_encode($result->result_array());
				return $arr;
		  }



		  function get_allproducts($sql)
		  {
				$result = $this->db->query($sql);
				$arr =  json_encode($result->result_array());
				$arr =	 '{ "rows" :'.$arr.' }';
				return $arr;
		  }
		   function get_customers($sql)
		  {
				$result = $this->db->query($sql);
				$arr =  json_encode($result->result_array());
				$arr =	 '{ "rows" :'.$arr.' }';
				return $arr;
		  }

		function update_leadproducts($leadprods,$leadid)
			{

		   		$prod=array();
		   		 foreach($leadprods as $prod)
				{
					 $data = array(
					'productid' => $prod['productid'],
					'quantity' => $prod['quantity'],
					
					'last_modified' => $prod['last_modified'],
					'last_updated_user' => $prod['last_updated_user'],
					
					'dct_actionplanned' => $prod['dct_actionplanned'],
					'dct_sales' => $prod['dct_sales'],
					'dct_collection' => $prod['dct_collection'],
					'dct_statuory' => $prod['dct_statuory'],
					'actionpoints' => $prod['actionpoints'],
					'due_date' => $prod['due_date'],
					'discussion_points' => $prod['discussion_points'],
					'market_information' => $prod['market_information']
					);
		   	
				 $this->db->where('lpid', $prod['lpid']);
				$this->db->where('leadid', $prod['leadid']);
				//$this->db->where('prod_type_id', $prod['prod_type_id']);
				$this->db->update('leadproducts', $data);

				}
 				return ($this->db->affected_rows() > 0);
			}
			function update_leaddetails_status($leadstatusdc,$leadid)
			{
				
					
		   		$leadsts=array();
		   		 foreach($leadstatusdc as $leadsts)
				{
					 $leadata = array(
					'leadstatus' => $leadsts['leadstatus'],
					'ldsubstatus' => $leadsts['ldsubstatus'],
					'last_modified' => $leadsts['last_modified'],
					'last_updated_user' => $leadsts['last_updated_user']
				
					);
		   	
				 
				$this->db->where('leadid', $leadsts['leadid']);
				$this->db->update('leaddetails', $leadata);

				}
 				return ($this->db->affected_rows() > 0);
			}
			

			function create_newlead($leaddetails)
			{
			 
				return $this->db->insert_batch('leaddetails', $leaddetails);
			}

			function save_dc_ldproducts($leadprods,$leadid)
			{
			 foreach($leadprods as $prod)
				{
				//echo"in model<br>";
				// echo"<pre>";print_r($prod);echo"</pre>";
				//$this->db->insert_batch('leadproducts', $prod);
				}
				return $this->db->insert_batch('leadproducts', $leadprods);
			}


			function save_dclead_products($leadprods)
			{
			 foreach($leadprods as $prod)
				{
				//echo"in model<br>";
				// echo"<pre>";print_r($prod);echo"</pre>";
				//$this->db->insert_batch('leadproducts', $prod);
				}
				return $this->db->insert_batch('leadproducts', $leadprods);
			}



			function update_dcproducts($dcalldetails,$customer_id)
			{

				$dcalldetail=array();
				 foreach($dcalldetails as $dcalldetail)
					{

						  $data = array(
				               'dct_prodid' => $dcalldetail['dct_prodid'],
				               'dct_prodname' => $dcalldetail['dct_prodname'],
				               'dct_quantity' => $dcalldetail['dct_quantity'],
				                'dct_potential' => $dcalldetail['dct_potential'],
				               'dct_salestypeid' => $dcalldetail['dct_salestype_id'],
				               'dct_salestypename' => $dcalldetail['dct_salestypename'],
				               'dct_actionplanned' => $dcalldetail['dct_actionplanned'],
				               'dct_sales' => $dcalldetail['dct_sales'],
				               'dct_collection' => $dcalldetail['dct_collection'],
				               'dct_statuory' => $dcalldetail['dct_statuory'],
				               'dct_marketinformation' => $dcalldetail['dct_marketinformation'],
				               'dct_updated_date' => $dcalldetail['dct_updated_date'],
				               'dct_updated_userid' => $dcalldetail['dct_updated_userid'],
				               'dct_updated_username' => $dcalldetail['dct_updated_username']
				            );
	//echo"<pre>";print_r($dcalldetail);echo"</pre>"; echo $dcalldetail['dct_detail_id'];

					$this->db->where('dct_detail_id', $dcalldetail['dct_detail_id']);
					$this->db->update('dailycall_dtl', $data); 
				}

 		 	return ($this->db->affected_rows() > 0);
		}





} // End of Class

?>

