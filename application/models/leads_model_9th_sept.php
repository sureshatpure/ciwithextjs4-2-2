<?php

class Leads_model extends CI_Model
{
	public $country_id = null;
	public $i, $j;
	public $reporting_user = array();
	public $reporting_user_id = array();
	public $user_list_id;
	public $reportingid;
	public $user_report_id;
	public $bussinesscat;
	
	function __construct()
	{
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->database();
		$this->load->helper('language');
	  $this->load->library('subquery');
		$this->load->library('session');
    
	}

	public function get_leadstatus()
	{
		$options = $this->db->select('leadstatusid, leadstatus')->get('leadstatus')->result();
		$options_arr;
		$options_arr[''] = '-Please Select Lead Status-';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			$options_arr[$option->leadstatusid] = $option->leadstatus;
		}
		return $options_arr;
		
	}

  public function get_leadstatus_add()
	{
	  $this->db->order_by("order_by");
		//$this->db->limit(1);
		$this->db->where('leadstatusid <', 6); 
		$options = $this->db->select('leadstatusid, leadstatus')->get('leadstatus')->result();

		$options_arr;
		//$options_arr[''] = '-Please Select Lead Status-';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			$options_arr[$option->leadstatusid] = $option->leadstatus;
		}
		return $options_arr;
		
	}

	public function get_locationuser_add()
	{
	  $sql="select distinct branch from (select  header_user_id, upper(location_user) as branch from  vw_web_user_login ) a order by branch";
//echo $sql; die;
	$result = $this->db->query($sql);
	$options = $result->result_array();
		$options_arr;
		$options_arr[''] = '-Please Select Branch-';
		foreach ($options as $option) {
		//	$options_arr[$option->header_user_id] = strtoupper($option->location_user)."-".$option->empname;
		$options_arr[$option['branch']] = $option['branch'];
		}
		return $options_arr;
	
		
	}

	public function get_locationuser_add_order()
	{
		@$this->session->set_userdata($get_assign_to_user_id); 
		$get_assign_to_user_id = $this->session->userdata['get_assign_to_user_id'];
		$sql="select 	distinct branch from (select  header_user_id, upper(location_user) as branch from  vw_web_user_login ) a 	where 
	header_user_id IN (".$get_assign_to_user_id.")  order  	by branch";
		$result = $this->db->query($sql);
		$options = $result->result_array();
		$options_arr;
		$options_arr[''] = '-Please Select Branch-';
			foreach ($options as $option) {
				$options_arr[$option['branch']] = $option['branch'];
			}
		return $options_arr;
	
		
	}

	public function get_leadstatus_edit($lid,$l_order_id)
	{
		//$this->db->where('order_by =', $l_order_id);
		//$this->db->or_where("ordser_by > $l_order_id");
		//$this->db->where('order_by =', $l_order_id);
		$this->db->where("order_by >='$l_order_id'",NULL,FALSE);
		$this->db->order_by("order_by");
		//where("CHAR_LENGTH(empname) > '0'",NULL,FALSE)
		$options = $this->db->select('leadstatusid, leadstatus')->get('leadstatus')->result();
		$options_arr;
		$options_arr[''] = '-Please Select Lead Status-';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			$options_arr[$option->leadstatusid] = $option->leadstatus;
		}
		return $options_arr;
		
	}

	

	public function get_leadsource()
	{
		$options = $this->db->select('leadsourceid, leadsource')->get('leadsource')->result();
		$options_arr;
		$options_arr[''] = '-Please Select Lead Source-';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			$options_arr[$option->leadsourceid] = $option->leadsource;
		}
		return $options_arr;
		
	}
	public function get_leadcredit_assment()
	{
		$options = $this->db->select('crd_id, crd_name')->get('lead_credit_assesment')->result();
		$options_arr;
		$options_arr[''] = '-Select Credit Assesment-';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			$options_arr[$option->crd_id] = $option->crd_name;
		}
		return $options_arr;
		
	}

 public function get_industry()
	{
		$this->db->order_by('industrysegment');
		$options = $this->db->select('id, industrysegment')->get('industry_segment')->result();
		$options_arr;
		$options_arr[''] = '-Please Select Industry Type-';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
		//	$options_arr[$option->industrysegment] = $option->industrysegment;
			$options_arr[$option->id] = $option->industrysegment;
		}
		return $options_arr;
		
	}

	public function get_company()
	{
		$options = $this->db->select('id, tempcustname')->get('customermasterhdr')->result();
		$options_arr;
		$options_arr[''] = '-Please Select Company-';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			$options_arr[$option->id] = $option->tempcustname;
		}
		return $options_arr;
		
	}

	public function get_all_company()
	{
	//	$sql = 'select cast(temp_cust_sync_id as varchar(50)) as id, tempcustomermaster.temp_customername as tempcustname from  tempcustomermaster  union all select  cast(customermasterhdr.id as varchar(50)), customermasterhdr.tempcustname from customermasterhdr';
    		//$sql='SELECT 	distinct on (view_tempcustomermaster.tempcustname) view_tempcustomermaster.id,view_tempcustomermaster.tempcustname FROM 	view_tempcustomermaster ORDER BY  tempcustname ASC';

    		$sql='SELECT  view_tempcustomermaster.id,view_tempcustomermaster.tempcustname FROM 	view_tempcustomermaster ORDER BY  tempcustname ASC';
    	//echo $sql; die;
		$result = $this->db->query($sql);
	//	print_r($result->result_array());
		$options = $result->result_array();
		$options_arr;
		$options_arr[''] = '-Please Select Customer-';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			$options_arr[$option['id']] = $option['tempcustname'];
		}
		return $options_arr;
		
	}
	public function get_country()
	{
		$options = $this->db->select('id, name')->get('country')->result();
		$options_arr;
		$options_arr[''] = '--Please Select Country--';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			$options_arr[$option->id] = $option->name;
		}
		return $options_arr;
		
	}
  public function get_states_edit($cntid)
	{
		$this->db->where('countrycode',$cntid);
		$options = $this->db->select('statecode, statename')->get('states')->result();
		$options_arr;
		$options_arr[''] = '--Please Select state--';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			$options_arr[$option->statecode] = $option->statename;
		}
		return $options_arr;
		
	}

 public function get_substatus_edit($ld_sts_id)
	{
		$this->db->where('lst_sub_id',$ld_sts_id);
		$options = $this->db->select('lst_sub_id, lst_name')->get('leadsubstatus')->result();
		$options_arr;
		$options_arr[''] = '--Select Sub Status--';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			$options_arr[$option->lst_sub_id] = $option->lst_name;
		}
		return $options_arr;
		
	}

	public function get_substatus_edit_all($ld_sts_id,$lst_parentid_id,$lst_order_by_id)
	{
//		$this->db->where('lst_sub_id',$ld_sts_id);
//		$this->db->where("lst_order_by >='$lst_order_by_id'",NULL,FALSE);  commented to list all substatus - may-14th
		$this->db->where("lst_parentid",$lst_parentid_id);
		$this->db->order_by("lst_order_by");
		$options = $this->db->select('lst_sub_id, lst_name,lst_order_by')->get('leadsubstatus')->result();
		$options_arr;
		$options_arr[''] = '--Select Sub Status--';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			$options_arr[$option->lst_sub_id] = $option->lst_name;
		}
		return $options_arr;
		
	}



	public function get_city_edit($stid)
	{
		$this->db->where('statecode',trim($stid));
		$options = $this->db->select('statecode, cityname')->get('city')->result();
		$options_arr;
		$options_arr[''] = '--Please Select city--';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			$options_arr[$option->cityname] = $option->cityname;
		}
		return $options_arr;
		
	}

	function get_assignto_users()
	{
/*
		$this->db->order_by("location_user", "asc"); 
		$options = $this->db->select('header_user_id, empname,location_user')->where("CHAR_LENGTH(empname) > '0'",NULL,FALSE)->get('vw_web_user_login')->result();
*/
	$sql="select header_user_id,displayname from (select  header_user_id, upper(location_user) || '-' || upper(empname) as displayname from  vw_web_user_login ) a  order by displayname";

	$result = $this->db->query($sql);
	$options = $result->result_array();
		$options_arr;
		$options_arr[''] = '-Please Select User-';
		foreach ($options as $option) {
		//	$options_arr[$option->header_user_id] = strtoupper($option->location_user)."-".$option->empname;
		$options_arr[$option['header_user_id']] = $option['displayname'];
		}
		return $options_arr;
	}

	function get_assignto_users_order($user_id)
	{
	//global $get_assign_to_user_id;
//   echo"the value is ".$get_assign_to_user_id."<br>"; 
		@$this->session->set_userdata($get_assign_to_user_id); 
	//	print_r($this->session->userdata);
	$get_assign_to_user_id = $this->session->userdata['get_assign_to_user_id'];
//print_r($get_assign_to_user_id);die;
		$sql="select header_user_id,displayname from (select  header_user_id, upper(location_user) || '-' || upper(empname) as displayname from  vw_web_user_login ) a where header_user_id IN (".$get_assign_to_user_id.") order by displayname";

		//$sql="select header_user_id,displayname from (select  header_user_id, upper(location_user) || '-' || upper(empname) as displayname from  vw_web_user_login ) a where header_user_id IN (".$get_assign_to_user_id.") and upper(branch)='".$sel_branch." order by displayname";


		$result = $this->db->query($sql);
	//	print_r($result->result_array());
		$options = $result->result_array();

		$options_arr;
		$options_arr[''] = '-Please Select User-';
    if (count($options) > 0) 
		{
			foreach ($options as $option) {
				$options_arr[$option['header_user_id']] = $option['displayname'];
			}
 		}
	  else
		{	
      $user_id = $this->session->userdata['user_id'];
      $name = $this->session->userdata['username'];
      $options_arr[$user_id] = $name;
		}  
		return $options_arr;
/*
		$options = $this->get_subquery_users_order($user_id);
		$options_arr;
		$options_arr[''] = '-Please Select User-';
    if (count($options) > 0) 
		{
			foreach ($options as $option) {
				$options_arr[$option['header_user_id']] = $option['empname'];
			}
 		}
	  else
		{	
      $user_id = $this->session->userdata['user_id'];
      $name = $this->session->userdata['username'];
      $options_arr[$user_id] = $name;
		}  
		return $options_arr;
*/
	}

function get_assignto_users_order_edit($user_id,$branch)
	{
	//global $get_assign_to_user_id;
//   echo"the value is ".$get_assign_to_user_id."<br>"; 
		@$this->session->set_userdata($get_assign_to_user_id); 
	//	print_r($this->session->userdata);
	$get_assign_to_user_id = $this->session->userdata['get_assign_to_user_id'];
//print_r($get_assign_to_user_id);die;
	//	$sql="select header_user_id,displayname from (select  header_user_id, upper(location_user) || '-' || upper(empname) as displayname from  vw_web_user_login ) a where header_user_id IN (".$get_assign_to_user_id.") order by displayname";

		$sql="select header_user_id,displayname,branch from (select  header_user_id,upper(location_user) as branch, upper(location_user) || '-' || upper(empname) as displayname from  vw_web_user_login ) a where header_user_id IN (".$get_assign_to_user_id.") and upper(branch)='".$branch."' order by displayname";


		$result = $this->db->query($sql);
	//	print_r($result->result_array());
		$options = $result->result_array();

		$options_arr;
		$options_arr[''] = '-Please Select User-';
    if (count($options) > 0) 
		{
			foreach ($options as $option) {
				$options_arr[$option['header_user_id']] = $option['displayname'];
			}
 		}
	  else
		{	
      $user_id = $this->session->userdata['user_id'];
      $name = $this->session->userdata['username'];
      $options_arr[$user_id] = $name;
		}  
		return $options_arr;
/*
		$options = $this->get_subquery_users_order($user_id);
		$options_arr;
		$options_arr[''] = '-Please Select User-';
    if (count($options) > 0) 
		{
			foreach ($options as $option) {
				$options_arr[$option['header_user_id']] = $option['empname'];
			}
 		}
	  else
		{	
      $user_id = $this->session->userdata['user_id'];
      $name = $this->session->userdata['username'];
      $options_arr[$user_id] = $name;
		}  
		return $options_arr;
*/
	}

	function get_assignedto()
	{
		$this->db->select('header_user_id, empname');
			$query = $this->db->get('vw_web_user_login');
			$arr =  json_encode($query->result_array());
		//	echo "{ rows: ".$arr." }";
			return $arr;
	}
/* commented for using view from tempitemmaster
	function get_products()
	{
			$this->db->select('id, description');
			$this->db->order_by("id", "asc"); 
		//	$query = $this->db->get('itemmaster',10,20);
			$query = $this->db->get('itemmaster');
			$arr =  json_encode($query->result_array());
		//	echo "{ rows: ".$arr." }";
			return $arr;
	}
*/

function get_products()
	{
/*
			$this->db->select('id, description');
			$this->db->distinct();
			$this->db->order_by("description", "asc"); 
			$query = $this->db->get('view_tempitemmaster');
*/
		//	$sql='SELECT  DISTINCT on (description) id, description FROM view_tempitemmaster_with_description_null ORDER BY description asc';
			//$sql='SELECT  DISTINCT on (description) id, description FROM view_tempitemmaster ORDER BY description asc';
		$sql='SELECT (itemmaster.itemid)::character varying(20) AS id, itemmaster.description FROM itemmaster UNION ALL SELECT tempitemmaster.temp_item_sync_id AS id, tempitemmaster.temp_itemname AS description FROM tempitemmaster';
		  $result = $this->db->query($sql);
			$arr =  json_encode($result->result_array());
		//	echo "{ rows: ".$arr." }";
			return $arr;
	}

function get_productsfordailycall()
	{
/*
			$this->db->select('id, description');
			$this->db->distinct();
			$this->db->order_by("description", "asc"); 
			$query = $this->db->get('view_tempitemmaster');
*/
		//	$sql='SELECT  DISTINCT on (description) id, description FROM view_tempitemmaster_with_description_null ORDER BY description asc';
			//$sql='SELECT  DISTINCT on (description) id, description FROM view_tempitemmaster ORDER BY description asc';
			//$sql="SELECT (itemmaster.itemid)::character varying(20) AS id, itemmaster.description,itemmaster.itemgroup FROM itemmaster UNION ALL SELECT tempitemmaster.temp_item_sync_id AS id, tempitemmaster.temp_itemname AS description,''::character varying as itemgroup FROM tempitemmaster";
			$sql="SELECT 
						(itemmaster.itemid)::character varying(20) AS id, 
						itemmaster.description,
						itemmaster.itemgroup 
					FROM 
						itemmaster 
					UNION ALL 
					SELECT 
						tempitemmaster.temp_item_sync_id AS id, 
						tempitemmaster.temp_itemname AS description,
						tempitemmaster.temp_itemname as itemgroup 
					FROM 
						tempitemmaster";
		//echo $sql; die;
		  $result = $this->db->query($sql);
			$arr =  json_encode($result->result_array());
		//	echo "{ rows: ".$arr." }";
			return $arr;
	}

	function get_synched_products($customer_id,$productname)
	{
		//echo" in model get_synched_products ".$customer_id; die;
/*
			$this->db->select('id, description');
			$this->db->distinct();
			$this->db->order_by("description", "asc"); 
			$query = $this->db->get('view_tempitemmaster');
*/
			//$sql='select id,tempcustid,tempcustname,stdname,cust_account_id,customer_number from customermasterhdr where cust_account_id > 0 ORDER BY creation_date desc ';
			
			//$sql='select * from vw_lead_get_soc_no where lead_cusomer_ref_id='.$customer_id.' ORDER BY qdate asc limit 1';
			//$sql="select * from vw_lead_get_soc_no_product where lead_cusomer_ref_id=".$customer_id." AND product ='".$productname."'";
			$sql="select * from vw_lead_get_soc_no_product where lead_cusomer_ref_id=".$customer_id." or product ='".$productname."'";

			
			//$sql='select id,tempcustid,tempcustname,stdname,cust_account_id,customer_number from customermasterhdr where cust_account_id > 0 and tempcustid ='.$customer_id.' ORDER BY creation_date desc ';



			//echo $sql; die;
		   $result = $this->db->query($sql);
			$arr =  json_encode($result->result_array());
		//	echo "{ rows: ".$arr." }";
			return $arr;
	}
	function get_leaddetails_for_grid()
	{
				$jTableResult = array();
				$jTableResult['leaddetails'] = $this->get_lead_details_all();
				$data = array();
				
				$i=0;
				while($i < count($jTableResult['leaddetails']))
				{    
					$row = array();
					$row["leadid"] = $jTableResult['leaddetails'][$i]["leadid"];
					$row["lead_no"] = $row["leadid"]."-".$jTableResult['leaddetails'][$i]["lead_no"];
					$row["leadstatus"] = $jTableResult['leaddetails'][$i]["leadstatus"];
					if($jTableResult['leaddetails'][$i]["lead_close_status"]==1)
					{
					 $closed="Closed";
					}
					else
					{
					  $closed="Open";	
					}
					$row["lead_close_status"] = $closed;
					$row["lead_close_option"] = $jTableResult['leaddetails'][$i]["lead_close_option"];
					$row["lead_close_comments"] = $jTableResult['leaddetails'][$i]["lead_close_comments"];
					$row["productname"] = $jTableResult['leaddetails'][$i]["productname"];
				/*	$row["salestype"] = $jTableResult['leaddetails'][$i]["salestype"];*/
					$row["productid"] = $jTableResult['leaddetails'][$i]["productid"];
					$row["branch"] = $jTableResult['leaddetails'][$i]["user_branch"];
					$row["leadsource"] = $jTableResult['leaddetails'][$i]["leadsource"];
					$row["assign_from_name"] = $jTableResult['leaddetails'][$i]["assign_from_name"];
					$row["tempcustname"] = $jTableResult['leaddetails'][$i]["tempcustname"];
					$row["empname"] = $jTableResult['leaddetails'][$i]["empname"];
					$row["created_date"] = substr($jTableResult['leaddetails'][$i]["createddate"],0,-8);

					$date_cr = new DateTime($row["created_date"]);
				
				  $row["created_date"]= $date_cr->format('Y-m-d');
	
					$row["modified_date"] = substr($jTableResult['leaddetails'][$i]["last_modified"],0,-8);
			//		$date_mf = new DateTime($row["modified_date"]);
			
					if($row["modified_date"] =="")
					{ 
						  $row["modified_date"] = substr($jTableResult['leaddetails'][$i]["createddate"],0,-8);
						  $date_mf = new DateTime($row["created_date"]);
					    $row["modified_date"] = $date_mf->format('Y-m-d');
					    
					}
					else
					{
						  $row["modified_date"] = substr($jTableResult['leaddetails'][$i]["last_modified"],0,-8);
							$date_mf = new DateTime($row["modified_date"]);
		  				  $row["modified_date"] = $date_mf->format('Y-m-d');
					}

					$data[$i] = $row;
					$i++;
				}
				$arr = "{\"data\":" .json_encode($data). "}";
		//	echo "{ rows: ".$arr." }";
			return $arr;
	}


function get_converted_for_grid()
	{
				$jTableResult = array();
				$jTableResult['leaddetails'] = $this->get_lead_converted_all();
				$data = array();
				
				$i=0;
				while($i < count($jTableResult['leaddetails']))
				{    
					$row = array();
					$row["leadid"] = $jTableResult['leaddetails'][$i]["leadid"];
					$row["lead_no"] = $row["leadid"]."-".$jTableResult['leaddetails'][$i]["lead_no"];
					$row["soc_number"] = $jTableResult['leaddetails'][$i]["lead_crm_soc_no"];
					$row["leadstatus"] = $jTableResult['leaddetails'][$i]["leadstatus"];
					$row["branch"] = $jTableResult['leaddetails'][$i]["user_branch"];
					$row["leadsource"] = $jTableResult['leaddetails'][$i]["leadsource"];
					$row["productname"] = $jTableResult['leaddetails'][$i]["productname"];
					$row["salestype"] = $jTableResult['leaddetails'][$i]["salestype"];
					$row["productid"] = $jTableResult['leaddetails'][$i]["productid"];
					$row["assign_from_name"] = $jTableResult['leaddetails'][$i]["assign_from_name"];
					$row["tempcustname"] = $jTableResult['leaddetails'][$i]["tempcustname"];
					$row["empname"] = $jTableResult['leaddetails'][$i]["empname"];
					$row["created_date"] = substr($jTableResult['leaddetails'][$i]["createddate"],0,-8);

					$date_cr = new DateTime($row["created_date"]);
				
				  $row["created_date"]= $date_cr->format('Y-m-d');
	
					$row["modified_date"] = substr($jTableResult['leaddetails'][$i]["last_modified"],0,-8);
			//		$date_mf = new DateTime($row["modified_date"]);
			
					if($row["modified_date"] =="")
					{ 
						  $row["modified_date"] = substr($jTableResult['leaddetails'][$i]["createddate"],0,-8);
						  $date_mf = new DateTime($row["created_date"]);
		  			    $row["modified_date"] = $date_mf->format('Y-m-d');
					    
					}
					else
					{
						  $row["modified_date"] = substr($jTableResult['leaddetails'][$i]["last_modified"],0,-8);
							$date_mf = new DateTime($row["modified_date"]);
					  
					  $row["modified_date"] = $date_mf->format('Y-m-d');
					}

					$data[$i] = $row;
					$i++;
				}
				$arr = "{\"data\":" .json_encode($data). "}";
		//	echo "{ rows: ".$arr." }";
			return $arr;
	}

	function get_dispatch()
	{
/*
			$this->db->select('id, description');
			$this->db->distinct();
			$this->db->order_by("description", "asc"); 
			$query = $this->db->get('view_tempitemmaster');
*/
			/*$sql='select  distinct n_value,n_value_id  from vw_sales_despatch_transaction_calss_fnd_flex_values_vl where flex_value_set_id=1014311 and  flex_value_id<>173796';*/

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
			$arr =  json_encode($result->result_array());
		//	echo "{ rows: ".$arr." }";
			return $arr;
	}

function get_getinitial_lead_sub()
	{
/*
			$this->db->select('id, description');
			$this->db->distinct();
			$this->db->order_by("description", "asc"); 
			$query = $this->db->get('view_tempitemmaster');
*/
			$sql='select * from leadsubstatus where lst_parentid =1 order by lst_order_by';
		  	$result = $this->db->query($sql);
			$arr =  json_encode($result->result_array());
		//	echo "{ rows: ".$arr." }";
			return $arr;
	}


	function get_states(){
		if(!is_null($this->country_id)){
			$this->db->select('statecode, statename');
			$this->db->where('countrycode', $this->country_id);
			$states = $this->db->get('states');

			// if there are suboptinos for this option...
			if($states->num_rows() > 0){
				$states_arr;

				// Format for passing into jQuery loop
				foreach ($states->result() as $state) {
					$states_arr[$state->statecode] = $state->statename;
				}
				return $states_arr;
			}
		}
		return;
	}

  function get_leadsubstatus()
	{
/*
		if(!is_null($this->parent_id)){
			$this->db->select('lst_sub_id, lst_name');
			$this->db->where('lst_parentid', $this->parent_id);
			$substatus = $this->db->get('leadsubstatus');

			// if there are suboptinos for this option...
			if($substatus->num_rows() > 0){
				$substatus_arr;

				// Format for passing into jQuery loop
				foreach ($substatus->result() as $substat) {
					$substatus_arr[$substat->lst_sub_id] = $substat->lst_name;
				}
				return $substatus_arr;
			}
		}
		return;
*/
			$sql="SELECT lst_sub_id, lst_name, lst_order_by FROM leadsubstatus WHERE lst_order_by >=(
select  ldsubstatus from  leaddetails where leadid=".$this->session->userdata['run_time_lead_id'].")  AND lst_parentid =".$this->parent_id;
		  	$result = $this->db->query($sql);
		$substatus = $result->result_array();

		$substatus_arr;
	foreach ($substatus as $substat) {
					$substatus_arr[$substat['lst_sub_id']] = $substat['lst_name'];
				}
				return $substatus_arr;
	}


		function get_leadsubstatus_add()
		{
		if(!is_null($this->parent_id)){
					$this->db->select('lst_sub_id, lst_name');
					$this->db->order_by('lst_order_by');
					$this->db->where('lst_parentid', $this->parent_id);
					$substatus = $this->db->get('leadsubstatus');

					// if there are suboptinos for this option...
					if($substatus->num_rows() > 0){
						$substatus_arr;

						// Format for passing into jQuery loop
						foreach ($substatus->result() as $substat) {
							$substatus_arr[$substat->lst_sub_id] = $substat->lst_name;
						}
						return $substatus_arr;
					}
				}
				return;
		}

		function get_assigned_tobranch()
		{
 //echo " check ".$this->brach_sel; die;
			@$this->session->set_userdata($get_assign_to_user_id); 
			@$get_assign_to_user_id = $this->session->userdata['get_assign_to_user_id'];
		  if ($get_assign_to_user_id=="")
			{
				$sql="select header_user_id,displayname , branch from 
								(select header_user_id,upper(location_user) as branch , upper(location_user) || '-' || upper(empname) as displayname from 				vw_web_user_login ) a where upper(branch)='".$this->brach_sel."' order by displayname";

			}
			else{
				$sql="select header_user_id,displayname , branch from 
								(select header_user_id,upper(location_user) as branch , upper(location_user) || '-' || upper(empname) as displayname from 				vw_web_user_login ) a where header_user_id IN (".$get_assign_to_user_id.")  and upper(branch)='".$this->brach_sel."' order by displayname";
			}
			
		//	echo $sql;
						$result = $this->db->query($sql);
			//	print_r($result->result_array());
				$options = $result->result_array();

				$options_arr;
				$options_arr[''] = '-Please Select User-';
				if (count($options) > 0) 
				{
					foreach ($options as $option) {
						$options_arr[$option['header_user_id']] = $option['displayname'];
					}
		 		}
				else
				{	
				  $user_id = $this->session->userdata['user_id'];
				  $name = $this->session->userdata['username'];
				  $options_arr[$user_id] = $name;
				}  
				return $options_arr;

		}



	function get_cities(){
		if(!is_null($this->state_id)){
			$this->db->select('statecode, cityname');
			$this->db->where('statecode', $this->state_id);
			$cities = $this->db->get('city');

			// if there are suboptinos for this option...
			if($cities->num_rows() > 0){
				$cities_arr;

				// Format for passing into jQuery loop
				foreach ($cities->result() as $city) {
					$cities_arr[$city->cityname] = $city->cityname;
				}
				return $cities_arr;
			}
		}
		return;
	}

	function save_lead($leaddata)
	{
		$this->db->insert('leaddetails', $leaddata);
        return $this->db->insert_id();	
	
	}
	function save_lead_address($leadaddress)
	{
		$this->db->insert('leadaddress', $leadaddress);
        return $this->db->insert_id();	
	
	}
	function save_lead_products_all($leadprods)
	{
		$this->db->insert('leadproducts', $leadprods);
        return $this->db->insert_id();	
	
	}
	
	function save_lead_products($leadprods)
	{
	 foreach($leadprods as $prod)
		{
		//echo"in model<br>";
		// echo"<pre>";print_r($prod);echo"</pre>";
		//$this->db->insert_batch('leadproducts', $prod);
		}
		return $this->db->insert_batch('leadproducts', $leadprods);
	}

	function save_potential_update($potential_updated)
	{
	 foreach($potential_updated as $potential)
		{
		//echo"in model<br>";
		// echo"<pre>";print_r($prod);echo"</pre>";
		//$this->db->insert_batch('leadproducts', $prod);
		}
		return $this->db->insert_batch('potential_updated_table', $potential_updated);
	}
	
// update functions 
	function update_lead($leaddata,$leadid)
	
	{

		$this->db->where('leadid', $leadid);
		$this->db->update('leaddetails', $leaddata);
		return ($this->db->affected_rows() > 0);
	
	}

	function update_leadclosestatus($leaddata,$leadid)
	
	{

		$this->db->where('leadid', $leadid);
		$this->db->update('leaddetails', $leaddata);
		return ($this->db->affected_rows() > 0);
	
	}

	function update_lead_address($leadaddress,$leadid)
	{
		$this->db->where('leadaddressid', $leadid);
		$this->db->update('leadaddress', $leadaddress);
    return ($this->db->affected_rows() > 0);
	
	}

	function update_custmastrhdr_assignto($custmsthrdid,$customerid)
	{
		$updatedate=date('Y-m-d:H:i:s');
		$username= $this->session->userdata['username'];
		$userid=$this->session->userdata['user_id'];
		
	 $sql="update customermasterhdr t set executivename = k.aliasloginname,  execode =k.duser,lastupdatedate='".$updatedate."', lastupdateuser='".$username."' from (select duser,aliasloginname from 
     	vw_dusermaster where header_user_id= ".$custmsthrdid.") k where coalesce(t.cust_account_id,0) = 0 and id=".$customerid;

  //$sql="update customermasterhdr t set t.executivename = k.aliasloginname,  t.execode =k.duser from (select duser,aliasloginname from 
   //  	vw_dusermaster where header_user_id= ".$custmsthrdid.") k where coalesce(t.cust_account_id,0) = 0 and id=".$customerid;
  //echo $sql; die;
	  $result = $this->db->query($sql);

	}
	
	function update_lead_products($leadprods,$leadid)
	{
   	$prod=array();
	 foreach($leadprods as $prod)
		{
		  $data = array(
               'productid' => $prod['productid'],
               'quantity' => $prod['quantity'],
               'potential' => $prod['potential'],
                'prod_type_id' => $prod['prod_type'],
               'last_modified' => $prod['last_modified'],
               'last_updated_user' => $prod['last_updated_user'],
               'annualpotential' => $prod['annualpotential']
            );

			$this->db->where('lpid', $prod['lpid']);
			$this->db->where('leadid', $leadid);
			$this->db->update('leadproducts', $data); 


		}
	
	  return ($this->db->affected_rows() > 0);

	}
	function update_lead_products_alltype($leadprods,$leadid)
	{
   	$prod=array();
	 foreach($leadprods as $prod)
		{
		  $data = array(
               'productid' => $prod['productid'],
               'quantity' => $prod['quantity'],
               'last_modified' => $prod['last_modified'],
               'last_updated_user' => $prod['last_updated_user']
            );

			$this->db->where('lpid', $prod['lpid']);
			$this->db->where('leadid', $leadid);
			$this->db->update('leadproducts', $data); 


		}
	
	  return ($this->db->affected_rows() > 0);

	}

	function update_leadcustomer_potential_update($customer_poten,$leadid)
	{
   	$potential_update=array();
	 foreach($customer_poten as $potential_update)
		{
		  $data = array(
               'yearly_potential_qty' => $potential_update['yearly_potential_qty']
	           );

			$this->db->where('id', $potential_update['id']);
			$this->db->where('line_id', $potential_update['line_id']);
			$this->db->where('businesscategory', $potential_update['businesscategory']);
			$this->db->update('potential_updated_table', $data); 


		}
	
	  return ($this->db->affected_rows() > 0);

	}

	function update_leadprodpotentypes($lead_potential_types,$leadid)
	{
   	$potential_types=array();
	 foreach($lead_potential_types as $potential_types)
		{
		  $data = array(
               'productid' => $potential_types['productid'],
               'product_type_id' => $potential_types['product_type_id'],
               'potential' => $potential_types['potential']

            );

			$this->db->where('product_type_id', $potential_types['product_type_id']);
			$this->db->where('productid', $potential_types['productid']);
			$this->db->where('leadid', $leadid);
			$this->db->update('lead_prod_potential_types', $data); 


		}
	
	  return ($this->db->affected_rows() > 0);

	}

	function update_customer_potential($customer_poten,$leadid)
	{
		  $data = array(
						'customergroup' => $customer_poten[0]['customergroup'],
						'itemgroup' => $customer_poten[0]['itemgroup'],
						'yearly_potential_qty' => $customer_poten[0]['yearly_potential_qty'],
						'businesscategory' => $customer_poten[0]['businesscategory'],
						'collector' => $customer_poten[0]['collector'],
						'user1' => strtoupper($customer_poten[0]['user1']),
						'user_code' => $customer_poten[0]['user_code']
           				 );

			$this->db->where('line_id', $customer_poten[0]['line_id']);
			$this->db->where('id', $leadid);
			$this->db->update('potential_updated_table', $data); 

	  return ($this->db->affected_rows() > 0);

	}
	



	function GetNextSeqVal($seq)
	{
		$query = "select nextval('".$seq."')";
		$result =$this->db->query($query);
		
		if ($result->num_rows() > 0)
		{
		   $row = $result->row(); 

		  // echo"next val " .$row->nextval;	die;
		}
		
		return $row->nextval;
	}


	 function GetCurrSeqVal($seq)
	{
		$query = "select currval('".$seq."')";
		$result =$this->db->query($query);
		
		if ($result->num_rows() > 0)
		{
		   $row = $result->row(); 

		  // echo"next val " .$row->nextval;	die;
		}
		
		return $row->currval;
	}

	 function GetMaxVal($table,$col)
	{
		$query = "select max($col) from $table"; 
		$result =$this->db->query($query);
		
		if ($result->num_rows() > 0)
		{
		   $row = $result->row(); 

		  // echo"next val " .$row->nextval;	die;
		}
		
		return $row->max;
	}


function get_lead_details_all()
	{

// changed for missing leads - conflict with the customermasterhdr
$sql='SELECT
	lead_dtl.leadid,
	lead_dtl.lead_no,
	lead_dtl.email_id,
	lead_dtl.firstname,
	lead_dtl.lastname,
	lead_dtl.industry,
	lead_dtl.productid,
	lead_dtl.productname,
	/*lead_dtl.potential,
	lead_dtl.quantity,
	lead_dtl.SalesType,*/
	lead_dtl.website,
	lead_dtl.user_branch,
	lead_dtl.converted,
	lead_dtl.designation,
	lead_dtl.lead_crm_soc_no,
	lead_dtl.lead_close_status,
	lead_dtl.lead_close_option,
	lead_dtl.lead_close_comments,
	lead_dtl.comments,
	lead_dtl.uploaded_date,
	lead_dtl.description,
	lead_dtl.ldsubstatus,
	lead_dtl.secondaryemail,
	lead_dtl.assignleadchk,
	lead_dtl.createddate,
	lead_dtl.leadstatus,
	lead_dtl.leadsource,
	lead_dtl.company,
	lead_dtl.customer_id,
	lead_dtl.created_user,
	lead_dtl.last_modified,
	lead_dtl.last_updated_user,
	lead_dtl.sent_mail_alert,
	lead_dtl.industry_id,
	lead_dtl.assign_from_name,
	lead_dtl.empname,
	lead_dtl.tempcustname,
	lead_dtl.leadstatus,
	lead_dtl.leadsource
FROM
	(
		SELECT
			leaddetails.leadid,
			leaddetails.lead_no,
			leaddetails.email_id,
			leaddetails.firstname,
			leaddetails.lastname,
			leaddetails.industry,
			leaddetails.website,
			leaddetails.user_branch,
			leaddetails.converted,
			leaddetails.designation,
			leaddetails.lead_crm_soc_no,
			leaddetails.lead_close_status,
			leaddetails.lead_close_option,
			leaddetails.lead_close_comments,
			leaddetails.comments,
			leaddetails.uploaded_date,
			leaddetails.description,
			leaddetails.ldsubstatus,
			leaddetails.secondaryemail,
			leaddetails.assignleadchk,
			leaddetails.createddate,
			leaddetails.leadstatus AS leadstatusid,
			leaddetails.leadsource AS leadsourceid,
			leadstatus.leadstatus,
			leadsource.leadsource,
			leaddetails.company,
			leaddetails.customer_id,
			leaddetails.created_user,
			leaddetails.last_modified,
			leaddetails.last_updated_user,
			leaddetails.sent_mail_alert,
			leaddetails.industry_id,
			leadproducts.productid,
			/*leadproducts.quantity,
			lead_prod_potential_types.potential,*/
			view_tempitemmaster.description AS productname,
			/*vw_leads_getdispatch.n_value AS SalesType,*/
			T .assign_from_name,
			vw_web_user_login.empname,
			view_tempcustomermaster.tempcustname
		FROM
			leaddetails
		INNER JOIN leadstatus ON leadstatus.leadstatusid = leaddetails.leadstatus
		INNER JOIN leadsource ON leadsource.leadsourceid = leaddetails.leadsource
		INNER JOIN (
			SELECT
				header_user_id,
				empname AS assign_from_name
			FROM
				vw_web_user_login
		) T ON leaddetails.created_user = T .header_user_id
		INNER JOIN vw_web_user_login ON leaddetails.assignleadchk = vw_web_user_login.header_user_id
		INNER JOIN leadaddress ON leaddetails.leadid = leadaddress.leadaddressid
		INNER JOIN view_tempcustomermaster ON leaddetails.company = view_tempcustomermaster. ID
		LEFT OUTER JOIN leadproducts ON leadproducts.leadid = leaddetails.leadid
    LEFT OUTER JOIN lead_prod_potential_types ON lead_prod_potential_types.leadid = leaddetails.leadid
		LEFT OUTER JOIN view_tempitemmaster ON view_tempitemmaster. ID = leadproducts.productid
		INNER JOIN vw_leads_getdispatch ON (
			lead_prod_potential_types.product_type_id = vw_leads_getdispatch.n_value_id
		)
		UNION
			SELECT
				leaddetails.leadid,
				leaddetails.lead_no,
				leaddetails.email_id,
				leaddetails.firstname,
				leaddetails.lastname,
				leaddetails.industry,
				leaddetails.website,
				leaddetails.user_branch,
				leaddetails.converted,
				leaddetails.designation,
				leaddetails.lead_crm_soc_no,
				leaddetails.lead_close_status,
				leaddetails.lead_close_option,
				leaddetails.lead_close_comments,
				leaddetails.comments,
				leaddetails.uploaded_date,
				leaddetails.description,
				leaddetails.ldsubstatus,
				leaddetails.secondaryemail,
				leaddetails.assignleadchk,
				leaddetails.createddate,
				leaddetails.leadstatus AS leadstatusid,
				leaddetails.leadsource AS leadsourceid,
				leadstatus.leadstatus,
				leadsource.leadsource,
				leaddetails.company,
				leaddetails.customer_id,
				leaddetails.created_user,
				leaddetails.last_modified,
				leaddetails.last_updated_user,
				leaddetails.sent_mail_alert,
				leaddetails.industry_id,
				leadproducts.productid,
				/*leadproducts.quantity,
				lead_prod_potential_types.potential,*/
				view_tempitemmaster.description AS productname,
				/*vw_leads_getdispatch.n_value AS SalesType,*/
				T .assign_from_name,
				vw_web_user_login.empname,
				view_tempcustomermaster.tempcustname
			FROM
				leaddetails
			INNER JOIN leadstatus ON leadstatus.leadstatusid = leaddetails.leadstatus
			INNER JOIN leadsource ON leadsource.leadsourceid = leaddetails.leadsource
			INNER JOIN (
				SELECT
					header_user_id,
					empname AS assign_from_name
				FROM
					vw_web_user_login
			) T ON leaddetails.created_user = T .header_user_id
			INNER JOIN vw_web_user_login ON leaddetails.assignleadchk = vw_web_user_login.header_user_id
			INNER JOIN leadaddress ON leaddetails.leadid = leadaddress.leadaddressid
			INNER JOIN view_tempcustomermaster ON leaddetails.company = view_tempcustomermaster. ID
			LEFT OUTER JOIN leadproducts ON leadproducts.leadid = leaddetails.leadid
      			LEFT OUTER JOIN lead_prod_potential_types ON lead_prod_potential_types.leadid = leaddetails.leadid
			LEFT OUTER JOIN view_tempitemmaster ON view_tempitemmaster. ID = leadproducts.productid
			INNER JOIN vw_leads_getdispatch ON (
				lead_prod_potential_types.product_type_id = vw_leads_getdispatch.n_value_id
			)
	) lead_dtl
WHERE
	converted = 0

GROUP BY 
	lead_dtl.leadid,
			lead_dtl.lead_no,
			lead_dtl.email_id,
			lead_dtl.firstname,
			lead_dtl.lastname,
			lead_dtl.industry,
			lead_dtl.website,
			lead_dtl.user_branch,
			lead_dtl.converted,
			lead_dtl.designation,
			lead_dtl.lead_crm_soc_no,
			lead_dtl.lead_close_status,
			lead_dtl.lead_close_option,
			lead_dtl.lead_close_comments,
			lead_dtl.comments,
			lead_dtl.uploaded_date,
			lead_dtl.description,
			lead_dtl.ldsubstatus,
			lead_dtl.secondaryemail,
			lead_dtl.assignleadchk,
			lead_dtl.createddate,
			lead_dtl.leadstatus,
			lead_dtl.leadsource,
			lead_dtl.leadstatus,
			lead_dtl.leadsource,
			lead_dtl.company,
			lead_dtl.customer_id,
			lead_dtl.created_user,
			lead_dtl.last_modified,
			lead_dtl.last_updated_user,
			lead_dtl.sent_mail_alert,
			lead_dtl.industry_id,
			lead_dtl.productid,
			lead_dtl.productname,
			/*leadproducts.quantity,
			lead_prod_potential_types.potential,*/
			lead_dtl.description,
			/*vw_leads_getdispatch.n_value,*/
			lead_dtl.assign_from_name,
			lead_dtl.empname,
			lead_dtl.tempcustname

ORDER BY
	createddate DESC';
//echo $sql; die;
				$result = $this->db->query($sql);
				$productdetails = $result->result_array();
// echo"count of all leads ".count($productdetails); die;
				$this->get_lead_converted_all();
        $all_leads_count = count($productdetails);
				$this->session->set_userdata('all_leads_count',$all_leads_count);
				return $productdetails;
 
	}



	function get_lead_converted_all()
	{
$sql='SELECT 
            lead_dtl.leadid,
            lead_dtl.lead_no,
            lead_dtl.email_id, 
            lead_dtl.firstname, 
            lead_dtl.lastname, 
            lead_dtl.industry,
            lead_dtl.productid,
		lead_dtl.productname,
		lead_dtl.SalesType,
            lead_dtl.website,
            lead_dtl.user_branch, 
            lead_dtl.converted,
            lead_dtl.designation,
            lead_dtl.lead_crm_soc_no,
            lead_dtl.comments,
            lead_dtl.domestic_supplier_name,
            lead_dtl.uploaded_date,
            lead_dtl.description,
            lead_dtl.ldsubstatus,
            lead_dtl.secondaryemail,
            lead_dtl.assignleadchk, 
            lead_dtl.createddate, 
            lead_dtl.leadstatus,
            lead_dtl.leadsource,
            lead_dtl.company, 
            lead_dtl.customer_id, 
            lead_dtl.created_user, 
            lead_dtl.last_modified, 
            lead_dtl.last_updated_user, 
            lead_dtl.sent_mail_alert, 
            lead_dtl.industry_id,
            lead_dtl.assign_from_name,
            lead_dtl.empname,
            lead_dtl.tempcustname,	 
            lead_dtl.leadstatus,
		 lead_dtl.leadsource
 
FROM 
            ( 
                  SELECT 
                              leaddetails.leadid,
                              leaddetails.lead_no,
                              leaddetails.email_id,
                              leaddetails.firstname,
                              leaddetails.lastname,
                              leaddetails.industry,
                              leaddetails.website,
                              leaddetails.user_branch,
                              leaddetails.converted,
                              leaddetails.designation,
                              leaddetails.lead_crm_soc_no,
                              leaddetails.comments,
                              leaddetails.domestic_supplier_name,
                              leaddetails.uploaded_date,
                              leaddetails.description,
                              leaddetails.ldsubstatus,
                              leaddetails.secondaryemail,
                              leaddetails.assignleadchk,
                              leaddetails.createddate,
	                        leaddetails.leadstatus as leadstatusid,
					  leaddetails.leadsource as leadsourceid,
					  leadstatus.leadstatus,
					  leadsource.leadsource,
                              leaddetails.company,
                              leaddetails.customer_id,
                              leaddetails.created_user,
                              leaddetails.last_modified,
                              leaddetails.last_updated_user,
                              leaddetails.sent_mail_alert,
                              leaddetails.industry_id,
                              leadproducts.productid,
					  view_tempitemmaster.description AS productname,
					  vw_leads_getdispatch.n_value as SalesType,
                              t.assign_from_name,
                              vw_web_user_login.empname,
                              view_tempcustomermaster.tempcustname
                  FROM 
                              leaddetails 
                               INNER JOIN leadstatus ON leadstatus.leadstatusid = leaddetails.leadstatus 
                               INNER JOIN leadsource ON leadsource.leadsourceid= leaddetails.leadsource 
                               INNER JOIN (
                                                      SELECT 
                                                                  header_user_id,
                                                                  empname as assign_from_name 
                                                      FROM 
                                                                  vw_web_user_login 
                                                ) t ON leaddetails.created_user = t.header_user_id 
                              INNER JOIN vw_web_user_login ON leaddetails.assignleadchk = vw_web_user_login.header_user_id 
                              INNER JOIN leadaddress ON leaddetails.leadid = leadaddress.leadaddressid 
                              INNER JOIN view_tempcustomermaster ON leaddetails.company = view_tempcustomermaster.id
                              LEFT OUTER JOIN leadproducts ON leadproducts.leadid = leaddetails.leadid
					  LEFT OUTER JOIN view_tempitemmaster ON view_tempitemmaster. ID = leadproducts.productid
					  INNER JOIN vw_leads_getdispatch ON (leadproducts.prod_type_id =vw_leads_getdispatch.n_value_id)

               
            UNION
            SELECT 
                        leaddetails.leadid,
                        leaddetails.lead_no,
                        leaddetails.email_id,
                        leaddetails.firstname,
                        leaddetails.lastname,
                        leaddetails.industry,
                        leaddetails.website,
                        leaddetails.user_branch,
                        leaddetails.converted,
                        leaddetails.designation,
                        leaddetails.lead_crm_soc_no,
                        leaddetails.comments,
                        leaddetails.domestic_supplier_name,
                        leaddetails.uploaded_date,
                        leaddetails.description,
                        leaddetails.ldsubstatus,
                        leaddetails.secondaryemail,
                        leaddetails.assignleadchk,
                        leaddetails.createddate,
                        leaddetails.leadstatus as leadstatusid,
				  leaddetails.leadsource as leadsourceid,
				  leadstatus.leadstatus,
				  leadsource.leadsource,
                        leaddetails.company,
                        leaddetails.customer_id,
                        leaddetails.created_user,
                        leaddetails.last_modified,
                        leaddetails.last_updated_user,
                        leaddetails.sent_mail_alert,
                        leaddetails.industry_id,
                        leadproducts.productid,
				  view_tempitemmaster.description AS productname,
				 vw_leads_getdispatch.n_value as SalesType,
                        t.assign_from_name,
                        vw_web_user_login.empname,
                        view_tempcustomermaster.tempcustname

            FROM 
                        leaddetails 
                        INNER JOIN leadstatus ON leadstatus.leadstatusid = leaddetails.leadstatus 
                        INNER JOIN leadsource ON leadsource.leadsourceid= leaddetails.leadsource 
                        INNER JOIN 
                                          (
                                                SELECT 
                                                            header_user_id, 
                                                            empname as assign_from_name 
                                                FROM 
                                                            vw_web_user_login 
                                          ) t ON leaddetails.created_user = t.header_user_id 
                        INNER JOIN vw_web_user_login ON leaddetails.assignleadchk = vw_web_user_login.header_user_id 
                        INNER JOIN leadaddress ON leaddetails.leadid = leadaddress.leadaddressid
                        INNER JOIN view_tempcustomermaster ON leaddetails.company = view_tempcustomermaster.id 
                    	 LEFT OUTER JOIN leadproducts ON leadproducts.leadid = leaddetails.leadid
		            LEFT OUTER JOIN view_tempitemmaster ON view_tempitemmaster.ID = leadproducts.productid
		            INNER JOIN vw_leads_getdispatch ON (leadproducts.prod_type_id =vw_leads_getdispatch.n_value_id)
   
)

lead_dtl  WHERE converted =1  ORDER BY createddate desc';
//echo $sql; die;
				$result = $this->db->query($sql);
				$productdetails = $result->result_array();
// echocount of all leads ".count($productdetails); die;
        $all_leads_count = count($productdetails);
				//$this->session->set_userdata('all_leads_count',$all_leads_count);
				$this->session->set_userdata('all_leads_converted_count',$all_leads_count); // added by perusu
				return $productdetails;

	}
		

	function get_lead_details($id)
	{

	$this->get_lead_details_converted($id);
		global $reportingid;

	//	$reportingid = $this->session->userdata['reportingto'];
	 $reportingid = $this->session->userdata['loginname'];

	  $user_list_ids = $this->get_user_list_ids($reportingid);
	
        $get_assign_to_user_id = array('get_assign_to_user_id'=>$user_list_ids); //set it
        $this->session->set_userdata($get_assign_to_user_id);
	
		$sql='SELECT 
            lead_dtl.leadid,
            lead_dtl.lead_no,
            lead_dtl.email_id, 
            lead_dtl.firstname, 
            lead_dtl.lastname, 
            lead_dtl.industry,
		 lead_dtl.productid,
		 
	      lead_dtl.productname,
            lead_dtl.website,
            lead_dtl.user_branch, 
            lead_dtl.converted,
            lead_dtl.designation,
            lead_dtl.lead_crm_soc_no,
			lead_dtl.lead_close_status,
			lead_dtl.lead_close_option, 
			lead_dtl.lead_close_comments,
            lead_dtl.comments,
            lead_dtl.domestic_supplier_name,
            lead_dtl.uploaded_date,
            lead_dtl.description,
            lead_dtl.ldsubstatus,
            lead_dtl.secondaryemail,
            lead_dtl.assignleadchk, 
            lead_dtl.createddate, 
            lead_dtl.leadstatus,
            lead_dtl.leadsource,
            lead_dtl.company, 
            lead_dtl.customer_id, 
            lead_dtl.created_user, 
            lead_dtl.last_modified, 
            lead_dtl.last_updated_user, 
            lead_dtl.sent_mail_alert, 
            lead_dtl.industry_id,
            lead_dtl.assign_from_name,
            lead_dtl.empname,
            lead_dtl.tempcustname,
		 lead_dtl.leadstatus,
		 lead_dtl.leadsource
 
FROM 
            ( 
                  SELECT 
                              leaddetails.leadid,
                              leaddetails.lead_no,
                              leaddetails.email_id,
                              leaddetails.firstname,
                              leaddetails.lastname,
                              leaddetails.industry,
                              leaddetails.website,
                              leaddetails.user_branch,
                              leaddetails.converted,
                              leaddetails.designation,
                              leaddetails.lead_crm_soc_no,
						leaddetails.lead_close_status,
						leaddetails.lead_close_option, 
						leaddetails.lead_close_comments,
                              leaddetails.comments,
                              leaddetails.domestic_supplier_name,
                              leaddetails.uploaded_date,
                              leaddetails.description,
                              leaddetails.ldsubstatus,
                              leaddetails.secondaryemail,
                              leaddetails.assignleadchk,
                              leaddetails.createddate,
	                        leaddetails.leadstatus as leadstatusid,
					  leaddetails.leadsource as leadsourceid,
					  leadstatus.leadstatus,
					  leadsource.leadsource,
                              leaddetails.company,
                              leaddetails.customer_id,
                              leaddetails.created_user,
                              leaddetails.last_modified,
                              leaddetails.last_updated_user,
                              leaddetails.sent_mail_alert,
                              leaddetails.industry_id,
					  leadproducts.productid,
				       view_tempitemmaster.description AS productname,
				       
                              t.assign_from_name,
                              vw_web_user_login.empname,
                              view_tempcustomermaster.tempcustname
                  FROM 
                              "leaddetails" 
                               INNER JOIN "leadstatus" ON "leadstatus"."leadstatusid" = "leaddetails"."leadstatus" 
                               INNER JOIN "leadsource" ON "leadsource"."leadsourceid"= "leaddetails"."leadsource" 
                               INNER JOIN (
                                                      SELECT 
                                                                  header_user_id,
                                                                  empname as assign_from_name 
                                                      FROM 
                                                                  vw_web_user_login 
                                                ) t ON "leaddetails"."created_user" = "t"."header_user_id" 
                              INNER JOIN "vw_web_user_login" ON "leaddetails"."assignleadchk" = "vw_web_user_login"."header_user_id" 
                              INNER JOIN "leadaddress" ON "leaddetails"."leadid" = "leadaddress"."leadaddressid" 
                              INNER JOIN "view_tempcustomermaster" ON "leaddetails"."company" = "view_tempcustomermaster"."id"
                              LEFT OUTER JOIN leadproducts ON leadproducts.leadid = leaddetails.leadid
		                 LEFT OUTER JOIN view_tempitemmaster ON view_tempitemmaster.ID = leadproducts.productid
				    LEFT OUTER JOIN lead_prod_potential_types ON lead_prod_potential_types.leadid = leaddetails.leadid
				    INNER JOIN vw_leads_getdispatch ON (
				              lead_prod_potential_types.product_type_id = vw_leads_getdispatch.n_value_id
			           )
                  WHERE 
                              "leaddetails"."created_user" IN ('.$user_list_ids.') 
            UNION
            SELECT 
                        leaddetails.leadid,
                        leaddetails.lead_no,
                        leaddetails.email_id,
                        leaddetails.firstname,
                        leaddetails.lastname,
                        leaddetails.industry,
                        leaddetails.website,
                        leaddetails.user_branch,
                        leaddetails.converted,
                        leaddetails.designation,
                        leaddetails.lead_crm_soc_no,
					leaddetails.lead_close_status,
					leaddetails.lead_close_option, 
					leaddetails.lead_close_comments,
                        leaddetails.comments,
	                   leaddetails.domestic_supplier_name,
                        leaddetails.uploaded_date,
	                  leaddetails.description,
                        leaddetails.ldsubstatus,
                        leaddetails.secondaryemail,
                        leaddetails.assignleadchk,
                        leaddetails.createddate,
                        leaddetails.leadstatus as leadstatusid,
				  leaddetails.leadsource as leadsourceid,
				  leadstatus.leadstatus,
				  leadsource.leadsource,				  
                        leaddetails.company,
                        leaddetails.customer_id,
                        leaddetails.created_user,
                        leaddetails.last_modified,
                        leaddetails.last_updated_user,
                        leaddetails.sent_mail_alert,
                        leaddetails.industry_id,
				 leadproducts.productid,
				 view_tempitemmaster.description AS productname,
                        t.assign_from_name,
                        vw_web_user_login.empname,
                        view_tempcustomermaster.tempcustname
            FROM 
                        "leaddetails" 
                        INNER JOIN "leadstatus" ON "leadstatus"."leadstatusid" = "leaddetails"."leadstatus" 
                        INNER JOIN "leadsource" ON "leadsource"."leadsourceid"= "leaddetails"."leadsource" 
                        INNER JOIN 
                                          (
                                                SELECT 
                                                            header_user_id, 
                                                            empname as assign_from_name 
                                                FROM 
                                                            vw_web_user_login 
                                          ) t ON "leaddetails"."created_user" = "t"."header_user_id" 
                        INNER JOIN "vw_web_user_login" ON "leaddetails"."assignleadchk" = "vw_web_user_login"."header_user_id" 
                        INNER JOIN "leadaddress" ON "leaddetails"."leadid" = "leadaddress"."leadaddressid"
                        INNER JOIN "view_tempcustomermaster" ON "leaddetails"."company" = "view_tempcustomermaster"."id"
				  LEFT OUTER JOIN leadproducts ON leadproducts.leadid = leaddetails.leadid
				  LEFT OUTER JOIN view_tempitemmaster ON view_tempitemmaster.ID = leadproducts.productid
				    LEFT OUTER JOIN lead_prod_potential_types ON lead_prod_potential_types.leadid = leaddetails.leadid
				    INNER JOIN vw_leads_getdispatch ON (
				              lead_prod_potential_types.product_type_id = vw_leads_getdispatch.n_value_id
			           )
      WHERE 
                        "leaddetails"."assignleadchk" IN ('.$user_list_ids.') )

lead_dtl WHERE converted=0  ORDER BY createddate desc';
			$result = $this->db->query($sql);
				$productdetails = $result->result_array();

 				$user_leads_count = count($productdetails);
 				$this->session->set_userdata('user_leads_count',$user_leads_count);
				return $productdetails;

	}



	function get_lead_details_converted($id)
	{
		//echo"test ";die;
		global $reportingid;

	//	$reportingid = $this->session->userdata['reportingto'];
	 $reportingid = $this->session->userdata['loginname'];

	  $user_list_ids = $this->get_user_list_ids($reportingid);
	
        $get_assign_to_user_id = array('get_assign_to_user_id'=>$user_list_ids); //set it
        $this->session->set_userdata($get_assign_to_user_id);
	
		$sql='SELECT 
            lead_dtl.leadid,
            lead_dtl.lead_no,
            lead_dtl.email_id, 
            lead_dtl.firstname, 
            lead_dtl.lastname, 
            lead_dtl.industry,
            lead_dtl.productid,
		 lead_dtl.productname,
  		 lead_dtl.SalesType,
            lead_dtl.website,
            lead_dtl.user_branch, 
            lead_dtl.converted,
            lead_dtl.designation,
            lead_dtl.lead_crm_soc_no,
            lead_dtl.comments,
            lead_dtl.uploaded_date,
            lead_dtl.description,
            lead_dtl.ldsubstatus,
            lead_dtl.secondaryemail,
            lead_dtl.assignleadchk, 
            lead_dtl.createddate, 
            lead_dtl.leadstatus,
            lead_dtl.leadsource,
            lead_dtl.company, 
            lead_dtl.customer_id, 
            lead_dtl.created_user, 
            lead_dtl.last_modified, 
            lead_dtl.last_updated_user, 
            lead_dtl.sent_mail_alert, 
            lead_dtl.industry_id,
            lead_dtl.assign_from_name,
            lead_dtl.empname,
            lead_dtl.tempcustname,
		 lead_dtl.leadstatus,
		 lead_dtl.leadsource
 
FROM 
            ( 
                  SELECT 
                              leaddetails.leadid,
                              leaddetails.lead_no,
                              leaddetails.email_id,
                              leaddetails.firstname,
                              leaddetails.lastname,
                              leaddetails.industry,
                              leaddetails.website,
                              leaddetails.user_branch,
                              leaddetails.converted,
                              leaddetails.designation,
                              leaddetails.lead_crm_soc_no,
                              leaddetails.comments,
                              leaddetails.uploaded_date,
                              leaddetails.description,
                              leaddetails.ldsubstatus,
                              leaddetails.secondaryemail,
                              leaddetails.assignleadchk,
                              leaddetails.createddate,
	                        leaddetails.leadstatus as leadstatusid,
					  leaddetails.leadsource as leadsourceid,
					  leadstatus.leadstatus,
					  leadsource.leadsource,
                              leaddetails.company,
                              leaddetails.customer_id,
                              leaddetails.created_user,
                              leaddetails.last_modified,
                              leaddetails.last_updated_user,
                              leaddetails.sent_mail_alert,
                              leaddetails.industry_id,
                              leadproducts.productid,
					  view_tempitemmaster.description AS productname,
					  vw_leads_getdispatch.n_value as SalesType,
                              t.assign_from_name,
                              vw_web_user_login.empname,
                              view_tempcustomermaster.tempcustname
                  FROM 
                              leaddetails 
                               INNER JOIN leadstatus ON leadstatus.leadstatusid = leaddetails.leadstatus 
                               INNER JOIN leadsource ON leadsource.leadsourceid= leaddetails.leadsource 
                               INNER JOIN (
                                                      SELECT 
                                                                  header_user_id,
                                                                  empname as assign_from_name 
                                                      FROM 
                                                                  vw_web_user_login 
                                                ) t ON leaddetails.created_user = t.header_user_id 
                              INNER JOIN vw_web_user_login ON leaddetails.assignleadchk = vw_web_user_login.header_user_id 
                              INNER JOIN leadaddress ON leaddetails.leadid = leadaddress.leadaddressid 
                              INNER JOIN view_tempcustomermaster ON leaddetails.company = view_tempcustomermaster.id
					  LEFT OUTER JOIN leadproducts ON leadproducts.leadid = leaddetails.leadid
					  LEFT OUTER JOIN view_tempitemmaster ON view_tempitemmaster.ID = leadproducts.productid
					  INNER JOIN vw_leads_getdispatch ON (leadproducts.prod_type_id =vw_leads_getdispatch.n_value_id) 
                  WHERE 
                              leaddetails.created_user IN ('.$user_list_ids.') 
            UNION
            SELECT 
                        leaddetails.leadid,
                        leaddetails.lead_no,
                        leaddetails.email_id,
                        leaddetails.firstname,
                        leaddetails.lastname,
                        leaddetails.industry,
                        leaddetails.website,
                        leaddetails.user_branch,
                        leaddetails.converted,
                        leaddetails.designation,
                        leaddetails.lead_crm_soc_no,
                        leaddetails.comments,
                        leaddetails.uploaded_date,
                        leaddetails.description,
                        leaddetails.ldsubstatus,
                        leaddetails.secondaryemail,
                        leaddetails.assignleadchk,
                        leaddetails.createddate,
                        leaddetails.leadstatus as leadstatusid,
				  leaddetails.leadsource as leadsourceid,
				  leadstatus.leadstatus,
				  leadsource.leadsource,				  
                        leaddetails.company,
                        leaddetails.customer_id,
                        leaddetails.created_user,
                        leaddetails.last_modified,
                        leaddetails.last_updated_user,
                        leaddetails.sent_mail_alert,
                        leaddetails.industry_id,
                        t.assign_from_name,
                        vw_web_user_login.empname,
                        view_tempcustomermaster.tempcustname,
                        leadproducts.productid,
			       view_tempitemmaster.description AS productname,
			       vw_leads_getdispatch.n_value as SalesType
            FROM 
                        leaddetails 
                        INNER JOIN leadstatus ON leadstatus.leadstatusid = leaddetails.leadstatus 
                        INNER JOIN leadsource ON leadsource.leadsourceid= leaddetails.leadsource 
                        INNER JOIN 
                                          (
                                                SELECT 
                                                            header_user_id, 
                                                            empname as assign_from_name 
                                                FROM 
                                                            vw_web_user_login 
                                          ) t ON leaddetails.created_user = t.header_user_id 
                        INNER JOIN vw_web_user_login ON leaddetails.assignleadchk = vw_web_user_login.header_user_id 
                        INNER JOIN leadaddress ON leaddetails.leadid = leadaddress.leadaddressid
                        INNER JOIN view_tempcustomermaster ON leaddetails.company = view_tempcustomermaster.id
                        LEFT OUTER JOIN leadproducts ON leadproducts.leadid = leaddetails.leadid
		             LEFT OUTER JOIN view_tempitemmaster ON view_tempitemmaster. ID = leadproducts.productid
		             INNER JOIN vw_leads_getdispatch ON (leadproducts.prod_type_id =vw_leads_getdispatch.n_value_id) 
      WHERE 
                        leaddetails.assignleadchk IN ('.$user_list_ids.') )

lead_dtl where converted =1  ORDER BY createddate desc';
			$result = $this->db->query($sql);
				$productdetails = $result->result_array();

 				$user_leads_count = count($productdetails);
			//	$this->session->set_userdata('user_leads_count',$user_leads_count);
				$this->session->set_userdata('user_leads_converted_count',$user_leads_count); // added by perusu
				return $productdetails;

	}


	function get_leaddetails_reporting_to_for_grid($id)
	{

				$jTableResult = array();
				$jTableResult['leaddetails'] = $this->get_lead_details($id);
				$data = array();
			//	print_r($jTableResult['leaddetails'] );
				$i=0;
				while($i < count($jTableResult['leaddetails']))
				{    
					$row = array();
					$row["leadid"] = $jTableResult['leaddetails'][$i]["leadid"];
					$row["lead_no"] = $row["leadid"]."-".$jTableResult['leaddetails'][$i]["lead_no"];
					$row["leadstatus"] = $jTableResult['leaddetails'][$i]["leadstatus"];
					if($jTableResult['leaddetails'][$i]["lead_close_status"]==1)
					{
					 $closed="Closed";
					}
					else
					{
					  $closed="Open";	
					}
					$row["lead_close_status"] = $closed;
					$row["lead_close_option"] = $jTableResult['leaddetails'][$i]["lead_close_option"];
					$row["lead_close_comments"] = $jTableResult['leaddetails'][$i]["lead_close_comments"];
					$row["productid"] = $jTableResult['leaddetails'][$i]["productid"];
					$row["productname"] = $jTableResult['leaddetails'][$i]["productname"];
					/*$row["salestype"] = $jTableResult['leaddetails'][$i]["salestype"];*/
					$row["branch"] = $jTableResult['leaddetails'][$i]["user_branch"];
					$row["soc_number"] = $jTableResult['leaddetails'][$i]["lead_crm_soc_no"];
					$row["leadsource"] = $jTableResult['leaddetails'][$i]["leadsource"];
					$row["assign_from_name"] = $jTableResult['leaddetails'][$i]["assign_from_name"];
					$row["tempcustname"] = $jTableResult['leaddetails'][$i]["tempcustname"];
					$row["empname"] = $jTableResult['leaddetails'][$i]["empname"];
					$row["created_date"] = substr($jTableResult['leaddetails'][$i]["createddate"],0,-8);
					$row["modified_date"] = substr($jTableResult['leaddetails'][$i]["last_modified"],0,-8);
					$date_cr = new DateTime($row["created_date"]);
				      $row["created_date"]= $date_cr->format('Y-m-d'); 
	
					$row["modified_date"] = substr($jTableResult['leaddetails'][$i]["last_modified"],0,-8);
			//		$date_mf = new DateTime($row["modified_date"]);
			
					if($row["modified_date"] =="")
					{ 
					//	echo "in if"; 
						  $row["modified_date"] = substr($jTableResult['leaddetails'][$i]["createddate"],0,-8);
						  $date_mf = new DateTime($row["created_date"]);
					       $row["modified_date"] = $date_mf->format('Y-m-d');

					}
					else
					{
					//	echo "in else"; 
						 $row["modified_date"] = substr($jTableResult['leaddetails'][$i]["last_modified"],0,-8);
						$date_mf = new DateTime($row["modified_date"]);
					  	$row["modified_date"] = $date_mf->format('Y-m-d');
					}

					$data[$i] = $row;
					$i++;
				}
				$arr = "{\"data\":" .json_encode($data). "}";
		//	echo "{ rows: ".$arr." }"; die;
			return $arr;
	}
	

	function get_converted_reporting_to_for_grid($id)
	{

				$jTableResult = array();
				$jTableResult['leaddetails'] = $this->get_lead_details_converted($id);
				$data = array();
			//	print_r($jTableResult['leaddetails'] );
				$i=0;
				while($i < count($jTableResult['leaddetails']))
				{    
					$row = array();
					$row["leadid"] = $jTableResult['leaddetails'][$i]["leadid"];
					$row["lead_no"] = $row["leadid"]."-".$jTableResult['leaddetails'][$i]["lead_no"];
					$row["leadstatus"] = $jTableResult['leaddetails'][$i]["leadstatus"];
					$row["branch"] = $jTableResult['leaddetails'][$i]["user_branch"];
					$row["soc_number"] = $jTableResult['leaddetails'][$i]["lead_crm_soc_no"];
					$row["leadsource"] = $jTableResult['leaddetails'][$i]["leadsource"];
					$row["productid"] = $jTableResult['leaddetails'][$i]["productid"];
					$row["productname"] = $jTableResult['leaddetails'][$i]["productname"];
					$row["salestype"] = $jTableResult['leaddetails'][$i]["salestype"];
					$row["assign_from_name"] = $jTableResult['leaddetails'][$i]["assign_from_name"];
					$row["tempcustname"] = $jTableResult['leaddetails'][$i]["tempcustname"];
					$row["empname"] = $jTableResult['leaddetails'][$i]["empname"];
					$row["created_date"] = substr($jTableResult['leaddetails'][$i]["createddate"],0,-8);
					$row["modified_date"] = substr($jTableResult['leaddetails'][$i]["last_modified"],0,-8);
					$date_cr = new DateTime($row["created_date"]);
				      $row["created_date"]= $date_cr->format('Y-m-d'); 
	
					$row["modified_date"] = substr($jTableResult['leaddetails'][$i]["last_modified"],0,-8);
			//		$date_mf = new DateTime($row["modified_date"]);
			
					if($row["modified_date"] =="")
					{ 
					//	echo "in if"; 
						  $row["modified_date"] = substr($jTableResult['leaddetails'][$i]["createddate"],0,-8);
						  $date_mf = new DateTime($row["created_date"]);
					       $row["modified_date"] = $date_mf->format('Y-m-d');
					}
					else
					{
					//	echo "in else"; 
						 $row["modified_date"] = substr($jTableResult['leaddetails'][$i]["last_modified"],0,-8);
						$date_mf = new DateTime($row["modified_date"]);
					  	$row["modified_date"] = $date_mf->format('Y-m-d');
					}

					$data[$i] = $row;
					$i++;
				}
				$arr = "{\"data\":" .json_encode($data). "}";
		//	echo "{ rows: ".$arr." }"; die;
			return $arr;
	}

	function get_lead_edit_details($id)
		{

				$reportingid_edit = $this->session->userdata['reportingto'];
				$user_list_id_edit = $this->get_user_list_ids($reportingid_edit);
				//print_r($this->session->userdata['get_assign_to_user_id']); 
				//$user_list_id_edit = $this->session->userdata['get_assign_to_user_id'];
				$this->db->select('*');
				$this->db->from ('leaddetails');
				$this->db->join('leadstatus', 'leadstatus.leadstatusid = leaddetails.leadstatus', 'inner');
				$this->db->join('leadsubstatus', 'leadsubstatus.lst_sub_id = leaddetails.ldsubstatus', 'inner');
				$this->db->join('leadsource', 'leadsource.leadsourceid= leaddetails.leadsource', 'inner');
				$this->db->join('industry_segment', 'industry_segment.id= leaddetails.industry_id', 'inner');
				//	      $this->db->join('customermasterhdr', 'leaddetails.company = customermasterhdr.id', 'inner');
				//			  $this->db->join('customermasterhdr', 'leaddetails.company = cast("customermasterhdr"."id" as varchar(20))', 'inner');
				$this->db->join('vw_web_user_login', 'leaddetails.assignleadchk = vw_web_user_login.header_user_id', 'inner');
				$this->db->join('leadaddress', 'leaddetails.leadid = leadaddress.leadaddressid', 'inner');
				//	      $this->db->join('view_tempcustomermaster', 'leaddetails.company = view_tempcustomermaster.id', 'inner'); // customer missing for MPL
				$this->db->join('view_tempcustomermaster', 'leaddetails.company = view_tempcustomermaster.id', 'LEFT OUTER');
				$this->db->where('leaddetails.leadid',$id);
//				$this->db->where_in_int_array('leaddetails.assignleadchk',$user_list_id_edit);


		    $result = $this->db->get();
				$productdetails = $result->result_array();
				return $productdetails;
		}

		function get_lead_edit_details_all($id)
		{
		
			$this->db->select('*');
			$this->db->from ('leaddetails');
			$this->db->join('leadstatus', 'leadstatus.leadstatusid = leaddetails.leadstatus', 'inner');
     			$this->db->join('leadsubstatus', 'leadsubstatus.lst_sub_id = leaddetails.ldsubstatus', 'inner');
			$this->db->join('leadsource', 'leadsource.leadsourceid= leaddetails.leadsource', 'inner');
			$this->db->join('industry_segment', 'industry_segment.id= leaddetails.industry_id', 'inner');
			//	      $this->db->join('customermasterhdr', 'leaddetails.company = customermasterhdr.id', 'inner');
			//$this->db->join('customermasterhdr', 'leaddetails.company = cast("customermasterhdr"."id" as varchar(20))', 'inner');
			$this->db->join('view_tempcustomermaster', 'leaddetails.company = view_tempcustomermaster.id', 'inner');
			$this->db->join('vw_web_user_login', 'leaddetails.assignleadchk = vw_web_user_login.header_user_id', 'inner');
			$this->db->join('leadaddress', 'leaddetails.leadid = leadaddress.leadaddressid', 'inner');
			$this->db->where('leaddetails.leadid',$id);
			$result = $this->db->get();
			$productdetails = $result->result_array();
			return $productdetails;
		}

		function get_lead_product_details($id)
		{
			/*	$this->db->select('*');
				$this->db->from ('leadproducts');
				$this->db->where('leadid',$id);
		//		$this->db->order_by("lpid", "desc"); 
		    $result = $this->db->get();
				$productdetails = $result->result_array();
			  return $productdetails;*/
			  $sql="SELECT  
					(select description from view_tempitemmaster j WHERE j.id = lp.productid) as description
					,(select id from view_tempitemmaster j WHERE j.id = lp.productid) as productid
					,(select n_value FROM vw_leads_getdispatch j WHERE j.n_value_id = lp.product_type_id ) as n_value
					,(select n_value_id FROM vw_leads_getdispatch j WHERE j.n_value_id = lp.product_type_id ) as prod_type_id
					,( SELECT quantity from leadproducts j WHERE j.leadid = lp.leadid and lp .productid = j.productid ) as quantity
					,( SELECT lpid from leadproducts j WHERE j.leadid = lp.leadid and lp .productid = j.productid ) as lpid
					, potential 
									FROM
										lead_prod_potential_types lp

						WHERE       lp.leadid=".$id;
					$result = $this->db->query($sql);
				$productdetails = $result->result_array();

			/*	$this->db->select('*');
				$this->db->from ('leadproducts');
				$this->db->where('leadid',$id);
		    $result = $this->db->get();
				$productdetails = $result->result_array();*/
			  return $productdetails;
		}
		function get_lead_product_details_alltypes($id)
		{
			
			
			$sql="select 
			a.leadid,a.productid,a.quantity,a.lpid,a.potential as potential_old,a.annualpotential,a.added_in_lead,a.due_date,a.discussion_points,a.market_information,b.product_type_id as prod_type_id,b.potential

			FROM
			 leadproducts a,lead_prod_potential_types b
			  where a.leadid = b.leadid and b.leadid =".$id;
			
			  $result = $this->db->query($sql);
			  $productdetails = $result->result_array();
			 return $productdetails;			


	    
			

		}
		function get_productname($productid)
		{
			$this->db->select('*');
			$this->db->from ('view_tempitemmaster_grp');
			$this->db->where('id',$productid);	
			$result = $this->db->get();
			$ld_status= $result->result_array();
		//return $ld_status[0]['description'];
			//print_r($ld_status); die;
		return $ld_status[0]['itemgroup'];
		}
		function get_lead_product_details_view_detail($id)
		{

				/*$sql="SELECT distinct lp.*, ld.*,prd.*, dspt.n_value_id, dspt.n_value FROM leaddetails ld left outer join leadproducts 
					lp on ld.leadid = lp.leadid inner join vw_sales_despatch_transaction_calss_fnd_flex_values_vl_part_tanker dspt on lp.prod_type_id = dspt.n_value_id left outer join view_tempitemmaster prd on lp.productid = prd.id WHERE
						ld.leadid =".$id;*/
			$sql="SELECT  
						(select description from view_tempitemmaster j WHERE j.id = lp.productid) as description
						,(select n_value FROM vw_leads_getdispatch j WHERE j.n_value_id = lp.product_type_id ) as n_value
						,( SELECT quantity from leadproducts j WHERE j.leadid = lp.leadid and lp .productid = j.productid ) as quantity
						, potential 
				FROM
					lead_prod_potential_types lp

				WHERE       lp.leadid=".$id;

						


	    //echo $sql; die;
				$result = $this->db->query($sql);
				$productdetails = $result->result_array();

			/*	$this->db->select('*');
				$this->db->from ('leadproducts');
				$this->db->where('leadid',$id);
		    $result = $this->db->get();
				$productdetails = $result->result_array();*/
			  return $productdetails;
		}
		
		function GetLeadSourceVal($srcid)
		{
				$this->db->select('lead_src_displayname');
				$this->db->from ('leadsource');
				$this->db->where('leadsourceid',$srcid);	
			  $result = $this->db->get();
				$ld_src = $result->result_array();
        return $ld_src[0]['lead_src_displayname'];
       // print_r($ld_src);
		}
		function GetLeadCredit($srcid)
		{
				$this->db->select('crd_name');
				$this->db->from ('lead_credit_assesment');
				$this->db->where('crd_id',$srcid);	
			  $result = $this->db->get();
				$ld_src = $result->result_array();
        return $ld_src[0]['crd_name'];
       // print_r($ld_src);
		}
		

		public function GetAssigntoName($stsid)
		{
				$this->db->select('location_user,aliasloginname,duser');
				$this->db->from ('vw_web_user_login');
				$this->db->where('header_user_id',$stsid);	
			  $result = $this->db->get();
				$ld_status= $result->result_array();
     //   return $ld_status[0]['location_user']."-".$ld_status[0]['aliasloginname'];
        return $ld_status;
       // print_r($ld_status);
		}
/* commented for using view from tempitemmaster
	public function get_products_edit()
	{
		$options = $this->db->select('id, description')->get('itemmaster')->result();
		$options_arr;
		$options_arr[''] = '--Please Select Product--';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			$options_arr[$option->id] = $option->description;
		}
		return $options_arr;
		
	}
*/

		public function GetLeadStatusName($toid)
		{
				$this->db->select('*');
				$this->db->from ('leadstatus');
				$this->db->where('leadstatusid',$toid);	
			  $result = $this->db->get();
				$ld_status= $result->result_array();
        return $ld_status[0]['leadstatus'];
       // print_r($ld_status);
		}
		public function GetLeadSubStatusName($substs_id)
		{
				$this->db->select('*');
				$this->db->from ('leadsubstatus');
				$this->db->where('lst_sub_id',$substs_id);	
			  $result = $this->db->get();
				$ld_status= $result->result_array();
        return $ld_status[0]['lst_name'];
       // print_r($ld_status);
		}

		public function GetTempCustId($tem_cust_id)
		{
				$this->db->select('*');
				$this->db->from ('customermasterhdr');
				$this->db->where('id',$tem_cust_id);	
			  	$result = $this->db->get();
				$ld_status= $result->result_array();
        			return $ld_status[0]['tempcustid'];
       // print_r($ld_status);
		}
			public function GetNextlpid($leadid)
		{
				$this->db->select('lpid');
				$this->db->from ('leadproducts');
				$this->db->where('leadid',$leadid);	
			  	$result = $this->db->get();
				$ld_status= $result->result_array();
        			return $ld_status[0]['lpid'];
       // print_r($ld_status);
		}
		
		public function GetCustomerdetails($company)
		{
				$this->db->select('tempcustname,customergroup,customer_number,customer_name');
				$this->db->from ('customermasterhdr');
				$this->db->where('id',$company);	
			  	$result = $this->db->get();
				$ld_status= $result->result_array();
        			return $ld_status[0];
        //print_r($ld_status);
		}
		public function GetItemgroup($item_id)
		{
				$sql="SELECT * FROM view_tempitemmaster_grp WHERE id::character varying ='".$item_id."'";
	   
				$result = $this->db->query($sql);
				$productdetails = $result->result_array();

		  return $productdetails[0];
		}
		

		public function CheckNewCustomer($tem_cust_id)
		{
				$this->db->select('*');
				$this->db->from ('customermasterhdr');
				$this->db->where('id',$tem_cust_id);	
				//$this->db->where('cust_account_id = 0');	
			  	$result = $this->db->get();
				$ld_status= $result->result_array();
        //			return $ld_status[0]['tempcustid'];
//	echo "no of rows ".$result->num_rows(); die;
//			print_r($ld_status);		  
			 return $ld_status[0]['cust_account_id'];


		}

	public function get_products_edit()
	{
//$this->db->order_by("description", "asc"); 
		//$options = $this->db->select('id, description')->order_by("description", "asc")->get('view_tempitemmaster')->result();
		//$sql='SELECT  DISTINCT on (description) id, description FROM view_tempitemmaster_with_description_null ORDER BY description asc';
		$sql='SELECT (itemmaster.itemid)::character varying(20) AS id, itemmaster.description FROM itemmaster UNION ALL SELECT tempitemmaster.temp_item_sync_id AS id, tempitemmaster.temp_itemname AS description FROM tempitemmaster';
	//	echo $sql; die;
		$result = $this->db->query($sql);
		$options=$result->result_array();
		$options_arr;
	//	$options_arr[''] = '--Please Select Product--';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			
			$options_arr[$option['id']] = $option['description'];
		}
		return $options_arr;
		
	}

	public function get_products_dispatch()
	{
      
		/*$sql='select flex_value,flex_value_set_id,flex_value_id  from vw_sales_despatch_transaction_calss_fnd_flex_values_vl where flex_value_set_id=1014311 and  flex_value_id<>173796'; 
*/
	//$sql='select  distinct n_value,n_value_id  from vw_sales_despatch_transaction_calss_fnd_flex_values_vl where flex_value_set_id=1014311 and  flex_value_id<>173796';
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
		$options=$result->result_array();
		$options_arr;
	//	$options_arr[''] = '-- Select Product Type--';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			
			$options_arr[$option['n_value_id']] = $option['n_value'];
		}
		return $options_arr;
	}

   function get_subquery_customerhdr($duser)
	{
  $data = array(
		             'executivename' => $leadid,
								 'execode' =>$leadid
						);
		$sub = $this->subquery->start_subquery('select');
		$sub->select('aliasloginname,duser')->from('vw_dusermaster k');
		$sub->where('header_user_id',$duser);
		$this->subquery->end_subquery('reportingto');
	 $this->db->update('tempcustomermaster', $data);
	}


 function get_subquery_users($duser)
	{
  
		$this->db->select('header_user_id,duser,empname,location_user,reportingto');
		$sub = $this->subquery->start_subquery('select');
		$sub->select('duser')->from('dusermaster');
		$sub->where('vw_web_user_login.duser like $duser');
		$this->subquery->end_subquery('reportingto');
		$this->db->from('vw_web_user_login');
		$this->db->where('reportingto', 'test');
	}


 		function get_subquery_users_order($parent_id=0) 
		{
		global $j,$i;
		global $reporting_user;
    		$j=$i; 
				$this->db->select('header_user_id,duser, empname, location_user,reportingto')->from('vw_web_user_login');
				$sub = $this->subquery->start_subquery('where_in');
				$sub->select('duser')->from('vw_web_user_login')->where('duser', $parent_id);
				$this->subquery->end_subquery('reportingto', TRUE);
				$this->db->order_by('location_user asc');
			//	echo $this->db->_compile_select();
				$query = $this->db->get();
			
			 $branch = array();
    		if (!empty($query) && $query->num_rows() > 0) 
				{
        	$branch = $query->result_array();
        	foreach ($branch as $key=>$val) 
					{
					 $i++;
           // echo" reporting ".$val['reportingto']."<br>";
					 if ($val['reportingto']!="")
						{
							$reporting_user[$i]['empname']=strtoupper($val['location_user'])."-".$val['empname'];
							$reporting_user[$i]['header_user_id']=$val['header_user_id'];
							$user = $val['duser'];
							$branch[$key]	= $this->get_subquery_users_order($user);
			
						}
      		} 
			 	 $j=$i;
		             unset($key);
		             unset($val);
     	}

    return $reporting_user;

	}
  
  function get_user_list_ids($user_report_id)
	{
// Hierarchry
	 global $user_list_id;
//	echo"user_report_id ".$user_report_id; 
//	print_r($this->session->userdata);
   $arrid = array();
   $userids = $this->get_subquery_user_ids($user_report_id);
//   echo "count ".count($userids);
// print_r($userids);  
// echo"array ".is_array($userids); echo"<br>"; echo "count in get_user_list_ids ".count($userids); echo"<br>";
    if(count($userids)>0) 
			{
			foreach($userids as $key => $idval)
					{
	//				  echo"in for loop key ".$key."<br>";
	//				  echo"in for loop idval ";print_r($idval);echo"<br>";
							$id =$idval['header_user_id'];
						if ($id !="") 
							{ 
								$user_list_id .= $id . ","; 
					 		}
	//				 echo" after user_list_id ".$user_list_id;
					}
//						$user_list_id =substr_replace($user_list_id, "0", -1);
							//$user_list_id =substr_replace($user_list_id, ",", -1).$this->session->userdata['user_id'];
              $user_list_id = $user_list_id.$this->session->userdata['user_id'];
//echo" after replace ".$user_list_id;
					 return $user_list_id;
					//return $arrid;
			}
			else
			{
   //    echo "in else"; echo"returning value is".$this->session->userdata['user_id']; 
			 return $this->session->userdata['user_id'];
			}
 	//  echo"<pre>";print_r($user_list_id);echo"</pre>"; 
	}

  function get_subquery_user_ids($parent_id=0) 
		{
		global $j,$i;
		global $reporting_user_id;
  //  echo " parent_id ".$parent_id; echo " reporting_user_id ".$reporting_user_id; 
    $j=$i; 
				$this->db->select('header_user_id,duser, empname, location_user,reportingto')->from('vw_web_user_login');
				$sub = $this->subquery->start_subquery('where_in');
				$sub->select('duser')->from('vw_web_user_login')->where('duser', $parent_id);
				$this->subquery->end_subquery('reportingto', TRUE);
				$this->db->order_by('location_user asc');
				$query = $this->db->get();

		 $branch = array();
     if (!empty($query) && $query->num_rows() > 0) 
			{
        $branch = $query->result_array();
        foreach ($branch as $key=>$val) 
				{
				 $i++;


					if ($val['reportingto']!="")
										{
										//	$reporting_user_id[$i]['empname']=$val['empname'];
											$reporting_user_id[$i]['header_user_id']=$val['header_user_id'];
											$user = $val['duser'];
											$branch[$key]	= $this->get_subquery_user_ids($user);
						  
										}
        } 
			  $j=$i;
        unset($key);
        unset($val);
			return $reporting_user_id;
     }
     else
		{
		 return;
		}

   // return $reporting_user_id;

	}

  function update_tempcustmaster_leadid($leadid,$customer_id,$user_id)
	{
  // echo"leadid ".$leadid."<br>";
  // echo"customer_id ".$customer_id."<br>";
  // echo"user_id ".$user_id."<br>";

	 $data = array(
		             'lead_id' => $leadid
						);
		$this->db->where('user_id', $user_id);
		$this->db->where('temp_cust_sync_id', $customer_id);
		$this->db->update('tempcustomermaster', $data);

		return ($this->db->affected_rows() > 0);
	}


function update_tempitemmaster_leadid($leadid,$productids,$user_id)
	{
  /*echo"leadid ".$leadid."<br>";
   echo"product_id ";print_r($productids);echo"<br>";
   echo"user_id ".$user_id."<br>";*/

	 
		$prodid=array();
	 foreach($productids as $prodid)
		{
	/*	echo"in model<br>";
		 echo"<pre>";print_r($prodid);echo"</pre>";*/
	//$this->db->insert_batch('leadproducts', $prod);
		//$this->db->where('leadid', $leadid);
		//$this->db->where('productid', $prod['productid']);

		  $data = array(
               'lead_id' => $prodid['leadid']
            );
//  echo "check ".$prodid['productid'];
 //echo"<pre> data";print_r($data);echo"</pre>";
		$this->db->where('user_id', $user_id);
		$this->db->where('temp_item_sync_id', $prodid['productid']);
		$this->db->update('tempitemmaster', $data);


		}

		return ($this->db->affected_rows() > 0);
	}

	function create_leadlog($lead_log_details)
	{
			$this->db->insert('web_lead_loghistory', $lead_log_details);
						  return $this->db->insert_id();	
	}
	function create_lead_sublog($lead_sublog_details)
	{
			$this->db->insert('web_leadsubsts_loghistory', $lead_sublog_details);
						  return $this->db->insert_id();	
	}

  function get_lead_status_details($lead_id,$user_id)
	{
/*
				$this->db->select('*');
				$this->db->from ('web_lead_loghistory');
				//$this->db->where('lh_user_id ',$user_id);
				$this->db->where('lh_lead_id ',$lead_id);
				$this->db->order_by("lh_lead_curr_statusid", "asc"); 
		    $result = $this->db->get();
				$lead_log_detatils = $result->result_array();
			  return $lead_log_detatils;
*/
/*
   						$sql="SELECT
							lh_id,
							lh_lead_id,
							lh_user_id,
							lh_lead_curr_status,
							lh_lead_curr_statusid,
							lh_last_modified,
							lh_created_date,
							lh_created_user,
							lh_last_updated_user,
							action_type,
							lh_comments,
							modified_user_name,
							created_user_name,
							lh_updated_date,
							assignto_user_id,
							assignto_user_name, 
							lh_last_modified::date - lh_created_date:: date AS Daysc,
							lh_last_modified::date - lh_updated_date:: date AS Days,   
							TRUNC(DATE_PART('Days', lh_last_modified::timestamp - lh_created_date::timestamp)/7) AS Weekc,
							TRUNC(DATE_PART('Days', lh_last_modified::timestamp - lh_updated_date::timestamp)/7) AS Week
			
						FROM
							web_lead_loghistory
						WHERE
							lh_lead_id = ".$lead_id."
						ORDER BY lh_id,
							lh_lead_curr_statusid ASC";
*/
// changed on Nov 9th for adding Substatus 

					$sql="SELECT
						lh_id,
						lh_lead_id,
						lh_user_id,
						lh_lead_curr_status,
						lh_lead_curr_statusid,
					lhsub_lh_lead_curr_sub_status,
					lhsub_lh_lead_curr_sub_statusid,
						lh_last_modified,
						lh_created_date,
						lh_created_user,
						lh_last_updated_user,
						action_type,
						lh_comments,
						modified_user_name,
						created_user_name,
						lh_updated_date,
						assignto_user_id,
						assignto_user_name,
						TRUNC(DATE_PART('Days',current_date - lh_created_date)) as idle_days,
						lh_last_modified::date - lh_created_date:: date AS Daysc,
						lh_last_modified::date - lh_updated_date:: date AS Days,   
						TRUNC(DATE_PART('Days', lh_last_modified::timestamp - lh_created_date::timestamp)/7) AS Weekc,
						TRUNC(DATE_PART('Days', lh_last_modified::timestamp - lh_updated_date::timestamp)/7) AS Week

					FROM
						web_lead_loghistory,
					web_leadsubsts_loghistory
					WHERE
						lh_lead_id = ".$lead_id." and lhsub_lh_id = 	lh_id
					ORDER BY lh_id,
						lh_lead_curr_statusid ASC";

		//echo $sql; die;				
	$result = $this->db->query($sql);
	//	print_r($result->result_array());
	return $lead_log_detatils = $result->result_array();
	}


	function get_lead_sub_status_details($lead_id,$parent_status_id)
	{


	$sql="SELECT * FROM web_leadsubsts_loghistory where lhsub_lh_lead_id = ".$lead_id." and lhsub_lh_lead_curr_statusid =".$parent_status_id;
	$result = $this->db->query($sql);
	//	print_r($result->result_array());
	return $lead_sublog_detatils = $result->result_array();
	}
	
	function update_prev_moddate($log_id)
		{
			$log_id = $log_id-1;
				$data = array(
		             'lh_last_modified' => date('Y-m-d:H:i:s')
						);

		$this->db->where('lh_id', $log_id);
		$this->db->update('web_lead_loghistory', $data);
		return ($this->db->affected_rows() > 0);
		}

	function get_all_company_json()
	{
/*
			$this->db->select('id, description');
			$this->db->distinct();
			$this->db->order_by("description", "asc"); 
			$query = $this->db->get('view_tempitemmaster');

			$sql='SELECT 	distinct on (view_tempcustomermaster.tempcustname) view_tempcustomermaster.id,view_tempcustomermaster.tempcustname FROM 	view_tempcustomermaster ORDER BY  tempcustname ASC ';
*/
		//	$sql='SELECT 	view_tempcustomermaster.id,view_tempcustomermaster.tempcustname FROM 	view_tempcustomermaster';

				$sql='SELECT 	distinct on (view_tempcustomermaster.tempcustname) view_tempcustomermaster.id,view_tempcustomermaster.tempcustname FROM 	view_tempcustomermaster ORDER BY  tempcustname ASC';
		  $result = $this->db->query($sql);
			$arr =  json_encode($result->result_array());
		//	echo "{ rows: ".$arr." }";
			return $arr;


	}

	function get_countryname($country_id)
	{
		$this->db->select('*');
		$this->db->from ('country');
		$this->db->where('id',$country_id);	
		$result = $this->db->get();
		$ld_status= $result->result_array();
		return $ld_status[0]['name'];
	}
	function get_country_idbyname($country_name)
	{
		$this->db->select('*');
		$this->db->from ('country');
		$this->db->where('LOWER(name)',$country_name);	
		$result = $this->db->get();
		$ld_status= $result->result_array();
		return $ld_status[0]['id'];
	}

	function get_state_idbyname($state_name)
	{
		$this->db->select('*');
		$this->db->from ('states');
		$this->db->where('LOWER(statename)',$state_name);	
		$result = $this->db->get();
		$ld_status= $result->result_array();
		return @$ld_status[0]['statecode'];
	}

	function get_statename($state_id)
	{
		$this->db->select('*');
		$this->db->from ('states');
		$this->db->where('statecode',$state_id);	
		$result = $this->db->get();
		$ld_status= $result->result_array();
		return $ld_status[0]['statename'];
	}
	function get_city_byname($city)
	{
		$this->db->select('*');
		$this->db->from ('city');
		$this->db->where('LOWER(cityname)',$city);	
		$result = $this->db->get();
		$ld_status= $result->result_array();
		return @$ld_status[0]['cityname'];
	}
	
	function insertlead_deletelog($created_date,$created_userid,$created_user_name,$leadid)
	{
		//return $this->db->insert_batch('leadproducts', $leadprods);
		$sql="INSERT INTO 
			web_lead_deletedlog 
(leadid,lead_no,email_id,firstname,lastname,created_user,asignedto_userid,street,endproducttype,productsaletype,presentsource,suppliername,decisionmaker,branchname,comments,uploadeddate,description,secondaryemail,assignedtouser,createddate,createdby,last_modified,updatedby,sent_mail_alert,leadsource,primarystatus,substatusname,loginname,prodqnty,productupdatedate,created_date,prodcreatedby,produpdatedby,prod_type_id,leadpoten,industrysegment,productname,itemgroup,organisation,uom,uomeasure,customername,customertype,deleteddate,deleted_userid,deleted_username)
SELECT 
     leadid,lead_no,email_id,firstname,lastname,created_user,asignedto_userid,street,endproducttype,productsaletype,presentsource,suppliername,decisionmaker,branchname,comments,uploadeddate,description,secondaryemail,assignedtouser,createddate,createdby,last_modified,updatedby,sent_mail_alert,leadsource,primarystatus,substatusname,loginname,prodqnty,productupdatedate,created_date,prodcreatedby,produpdatedby,prod_type_id,leadpoten,industrysegment,productname,itemgroup,organisation,uom,uomeasure,customername,customertype,'".$created_date."',".$created_userid.",'".$created_user_name."' FROM vw_lead_export_excel where leadid=".$leadid;
 //echo $sql; 
   $result = $this->db->query($sql);
  // echo $this->db->affected_rows();
   
   return ($this->db->affected_rows() > 0);
	}

	function get_customerdetails($company_id)
			{
				if($company_id!="")
				{
					$sql="SELECT
								*
						FROM 
							vw_daily_call_customerinfo_new 
						where company =".$company_id;
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

	function get_productgroupname($prodid)
	{
		/*$this->db->select('itemgroup');
		$this->db->where('itemid', $prodid); 
		$query = $this->db->get('itemmaster');
		$item_name=$query->result();
		return $item_name[0]->itemgroup;*/
		//$sql="SELECT itemgroup FROM itemmaster WHERE itemid::character varying = '".$prodid."'";
		$sql="SELECT t.id,t.description,t.itemgroup FROM 
				(
				SELECT 
						(itemmaster.itemid)::character varying(20) AS id, 
						itemmaster.description,
						itemmaster.itemgroup 
				FROM 
						itemmaster 
				UNION ALL 
				SELECT 
						tempitemmaster.temp_item_sync_id AS id, 
						tempitemmaster.temp_itemname AS description,
						tempitemmaster.temp_itemname as itemgroup 
				FROM 
					tempitemmaster
				) t

				WHERE 
					t.id= '".$prodid."'";
		//	echo $sql; die;
			$result = $this->db->query($sql);
			$item_name=$result->result_array();
		//print_r($item_name); 
		
			return $item_name[0]['itemgroup'];

	}
	function get_businesscategory($catid)
	{
		$this->db->select('n_value');
		$this->db->where('n_value_id', $catid); 
		$query = $this->db->get('vw_leads_getdispatch');
		$item_name=$query->result();


/*		Bulk
Intact
Repacking
Single - Tanker
Small Packing
$businesscat=array("0"=>"BULK", "1"=>"PART TANKER","2"=>"REPACK","3"=>"INTACT","4"=>"SINGLE - TANKER","5"=>"SMALL PACKING");*/
		
		if($item_name[0]->n_value=='Bulk')
		{
		 @$bussinesscat="BULK";

		}
		else  if($item_name[0]->n_value=='INTACT')
		{
		 @$bussinesscat="BULK";

		}
		else  if($item_name[0]->n_value=='Repacking')
		{
		 @$bussinesscat="REPACK";

		}
		else  if($item_name[0]->n_value=='Single - Tanker')
		{
		 @$bussinesscat="SINGLE - TANKER";

		}
		else  if($item_name[0]->n_value=='Small Packing')
		{
		 @$bussinesscat="SMALL PACKING";

		}
		return @$bussinesscat;
	}
	
	function get_industry_name($industry_id)
	{
		$this->db->select('industrysegment');
		$this->db->where('id', $industry_id); 
		$query = $this->db->get('industry_segment');
		$indus_name=$query->result();
		return $indus_name[0]->industrysegment;
	}

	function get_customergroup($customer_id)
	{
		$this->db->select('customergroup');
		$this->db->where('id', $customer_id); 
		$query = $this->db->get('customermasterhdr');
		$cust_name=$query->result();
		return $cust_name[0]->customergroup;
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

		 function save_leadprodpotentypes($lead_potential_types)
		{
		
			return $this->db->insert_batch('lead_prod_potential_types', $lead_potential_types);

		}

			 function save_leadcustomer_potential_update($lead_customer_pontential)
		{
		
			return $this->db->insert_batch('potential_updated_table', $lead_customer_pontential);

		}

		function get_all_products($sql)
		  {
				$result = $this->db->query($sql);
				$arr =  json_encode($result->result_array());
				$arr =	 '{ "rows" :'.$arr.' }';
				return $arr;
		  }

		  function check_prodnameduplicates_lead($prodid,$customerid)
		{

				// $sql= "SELECT dct_prodid FROM daily_call_hdr h,daily_call_dtl d WHERE h.dch_header_id = d.dct_header_id AND h.dch_customerid =".$customerid." AND  d.dct_prodid=".$prodid;
 				//$sql= "SELECT dct_itemgroup from dailycall_dtl WHERE dct_customergroup ='".$prodname."'  AND dct_itemgroup ='".$customerid."'";
 			//   $sql= "SELECT dct_itemgroup from dailycall_dtl WHERE dct_customergroup ='".$prodname."'  AND dct_itemgroup ='".$prodname."'";
 				$sql="SELECT leaddetails.leadid FROM leaddetails,leadproducts WHERE leaddetails.leadid= leadproducts.leadid AND  leaddetails.company=".$customerid." AND leadproducts.productid::TEXT='".$prodid."'";

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


}
?>

