<?php
class Excelreport_model extends CI_Model
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
		$this->load->model('Leads_model');
		$this->load->helper('language');
	  	$this->load->library('subquery');
		$this->load->library('session');
    
	}

	
		function get_all_leads_for_grid()
		{
				$jTableResult = array();
				$jTableResult['leaddetails'] = $this->get_all_leads();
				$data = array();
				
				$i=0;
				

				while($i < count($jTableResult['leaddetails']))
				{    
					$row = array();
					$row["leadid"] = $jTableResult['leaddetails'][$i]["leadid"];
					$row["lead_no"] = $jTableResult['leaddetails'][$i]["lead_no"];
					$row["email_id"] = $jTableResult['leaddetails'][$i]["email_id"];
					$row["firstname"] = $jTableResult['leaddetails'][$i]["firstname"];
					$row["lastname"] = $jTableResult['leaddetails'][$i]["lastname"];
					
/*					$row["endproducttype"] = $jTableResult['leaddetails'][$i]["endproducttype"];
					$row["productsaletype"] = $jTableResult['leaddetails'][$i]["productsaletype"];
					$row["presentsource"] = $jTableResult['leaddetails'][$i]["presentsource"];
					$row["suppliername"] = $jTableResult['leaddetails'][$i]["suppliername"];
					$row["decisionmaker"] = $jTableResult['leaddetails'][$i]["decisionmaker"];*/

				
					$row["branchname"] = $jTableResult['leaddetails'][$i]["branchname"];
					$row["comments"] = $jTableResult['leaddetails'][$i]["comments"];
					$row["converted"] = $jTableResult['leaddetails'][$i]["converted"];
					$row["uploadeddate"] = $jTableResult['leaddetails'][$i]["uploadeddate"];
					$row["description"] = $jTableResult['leaddetails'][$i]["description"];
					$row["phone_no"] = $jTableResult['leaddetails'][$i]["phone_no"];
					$row["mobile_no"] = $jTableResult['leaddetails'][$i]["mobile_no"];
					$row["address"] = $jTableResult['leaddetails'][$i]["address"];

					
					$row["secondaryemail"] = $jTableResult['leaddetails'][$i]["secondaryemail"];
					$row["assignedtouser"] = $jTableResult['leaddetails'][$i]["assignedtouser"];
					$row["createddate"] = $jTableResult['leaddetails'][$i]["createddate"];
					$row["createdby"] = $jTableResult['leaddetails'][$i]["createdby"];
					$row["lastupdatedate"] = $jTableResult['leaddetails'][$i]["lastupdatedate"];
					$row["updatedby"] = $jTableResult['leaddetails'][$i]["updatedby"];
					$row["sent_mail_alert"] = $jTableResult['leaddetails'][$i]["sent_mail_alert"];
					$row["leadsource"] = $jTableResult['leaddetails'][$i]["leadsource"];
					$row["lead_close_status"] = $jTableResult['leaddetails'][$i]["lead_close_status"];
					
					$row["primarystatus"] = $jTableResult['leaddetails'][$i]["primarystatus"];
					$row["substatusname"] = $jTableResult['leaddetails'][$i]["substatusname"];
					$row["loginname"] = $jTableResult['leaddetails'][$i]["loginname"];
					$row["prodqnty"] = $jTableResult['leaddetails'][$i]["prodqnty"];
					$row["repack"] = $jTableResult['leaddetails'][$i]["repack"];
					$row["intact"] = $jTableResult['leaddetails'][$i]["intact"];
					$row["bulk"] = $jTableResult['leaddetails'][$i]["bulk"];
					$row["small_packing"] = $jTableResult['leaddetails'][$i]["small_packing"];
					$row["single_tanker"] = $jTableResult['leaddetails'][$i]["single_tanker"];
					$row["part_tanker"] = $jTableResult['leaddetails'][$i]["part_tanker"];
					$row["productupdatedate"] = $jTableResult['leaddetails'][$i]["productupdatedate"];
					$row["created_date"] = $jTableResult['leaddetails'][$i]["created_date"];
					$row["prodcreatedby"] = $jTableResult['leaddetails'][$i]["prodcreatedby"];
					$row["produpdatedby"] = $jTableResult['leaddetails'][$i]["produpdatedby"];
					$row["prod_type_id"] = $jTableResult['leaddetails'][$i]["prod_type_id"];
					$row["leadpoten"] = $jTableResult['leaddetails'][$i]["leadpoten"];
					$row["industrysegment"] = $jTableResult['leaddetails'][$i]["industrysegment"];
					$row["productname"] = $jTableResult['leaddetails'][$i]["productname"];
					$row["itemgroup"] = $jTableResult['leaddetails'][$i]["itemgroup"];
					$row["organisation"] = $jTableResult['leaddetails'][$i]["organisation"];
					$row["uom"] = $jTableResult['leaddetails'][$i]["uom"];
					$row["uomeasure"] = $jTableResult['leaddetails'][$i]["uomeasure"];
					$row["customername"] = $jTableResult['leaddetails'][$i]["customername"];
					$row["customertype"] = $jTableResult['leaddetails'][$i]["customertype"];												
					$data[$i] = $row;
					$i++;
				}
				$arr = "{\"data\":" .json_encode($data). "}";
		//	echo "{ rows: ".$arr." }";
			return $arr;
	}

			function get_all_leads_for_grid_withfilter($branch,$sel_userid)
			{
				$jTableResult = array();
				$jTableResult['leaddetails'] = $this->get_all_leads_withfilter($branch,$sel_userid);
				$data = array();
				
				$i=0;
				while($i < count($jTableResult['leaddetails']))
				{    
					$row = array();
					$row["leadid"] = $jTableResult['leaddetails'][$i]["leadid"];
					$row["lead_no"] = $jTableResult['leaddetails'][$i]["lead_no"];
					$row["email_id"] = $jTableResult['leaddetails'][$i]["email_id"];
					$row["firstname"] = $jTableResult['leaddetails'][$i]["firstname"];
					$row["lastname"] = $jTableResult['leaddetails'][$i]["lastname"];
				
					$row["branchname"] = $jTableResult['leaddetails'][$i]["branchname"];
					$row["comments"] = $jTableResult['leaddetails'][$i]["comments"];
					$row["converted"] = $jTableResult['leaddetails'][$i]["converted"];
					$row["uploadeddate"] = $jTableResult['leaddetails'][$i]["uploadeddate"];
					$row["description"] = $jTableResult['leaddetails'][$i]["description"];
					$row["phone_no"] = $jTableResult['leaddetails'][$i]["phone_no"];
					$row["mobile_no"] = $jTableResult['leaddetails'][$i]["mobile_no"];
					$row["address"] = $jTableResult['leaddetails'][$i]["address"];

					
					$row["secondaryemail"] = $jTableResult['leaddetails'][$i]["secondaryemail"];
					$row["assignedtouser"] = $jTableResult['leaddetails'][$i]["assignedtouser"];
					$row["createddate"] = $jTableResult['leaddetails'][$i]["createddate"];
					$row["createdby"] = $jTableResult['leaddetails'][$i]["createdby"];
					$row["lastupdatedate"] = $jTableResult['leaddetails'][$i]["lastupdatedate"];
					$row["updatedby"] = $jTableResult['leaddetails'][$i]["updatedby"];
					$row["sent_mail_alert"] = $jTableResult['leaddetails'][$i]["sent_mail_alert"];
					$row["leadsource"] = $jTableResult['leaddetails'][$i]["leadsource"];
					$row["lead_close_status"] = $jTableResult['leaddetails'][$i]["lead_close_status"];
					
					$row["primarystatus"] = $jTableResult['leaddetails'][$i]["primarystatus"];
					$row["substatusname"] = $jTableResult['leaddetails'][$i]["substatusname"];
					$row["loginname"] = $jTableResult['leaddetails'][$i]["loginname"];
					$row["prodqnty"] = $jTableResult['leaddetails'][$i]["prodqnty"];
					$row["repack"] = $jTableResult['leaddetails'][$i]["repack"];
					$row["intact"] = $jTableResult['leaddetails'][$i]["intact"];
					$row["bulk"] = $jTableResult['leaddetails'][$i]["bulk"];
					$row["small_packing"] = $jTableResult['leaddetails'][$i]["small_packing"];
					$row["single_tanker"] = $jTableResult['leaddetails'][$i]["single_tanker"];
					$row["part_tanker"] = $jTableResult['leaddetails'][$i]["part_tanker"];
					$row["productupdatedate"] = $jTableResult['leaddetails'][$i]["productupdatedate"];
					$row["created_date"] = $jTableResult['leaddetails'][$i]["created_date"];
					$row["prodcreatedby"] = $jTableResult['leaddetails'][$i]["prodcreatedby"];
					$row["produpdatedby"] = $jTableResult['leaddetails'][$i]["produpdatedby"];
					$row["prod_type_id"] = $jTableResult['leaddetails'][$i]["prod_type_id"];
					$row["leadpoten"] = $jTableResult['leaddetails'][$i]["leadpoten"];
					$row["industrysegment"] = $jTableResult['leaddetails'][$i]["industrysegment"];
					$row["productname"] = $jTableResult['leaddetails'][$i]["productname"];
					$row["itemgroup"] = $jTableResult['leaddetails'][$i]["itemgroup"];
					$row["organisation"] = $jTableResult['leaddetails'][$i]["organisation"];
					$row["uom"] = $jTableResult['leaddetails'][$i]["uom"];
					$row["uomeasure"] = $jTableResult['leaddetails'][$i]["uomeasure"];
					$row["customername"] = $jTableResult['leaddetails'][$i]["customername"];
					$row["customertype"] = $jTableResult['leaddetails'][$i]["customertype"];												
					$data[$i] = $row;
					$i++;
				}
				$arr = "{\"data\":" .json_encode($data). "}";
		//	echo "{ rows: ".$arr." }";
			return $arr;
		}



		public function get_all_leads()
		{
			$sql="SELECT * FROM export_excel_horizontal_type ";		
				$result = $this->db->query($sql);
				$productdetails = $result->result_array();

        			$all_leads_count = count($productdetails);
				$this->session->set_userdata('all_leads_count',$all_leads_count);
				return $productdetails;
 
		}


		public function get_all_leads_withfilter($branch,$sel_userid)
		{
			//$sql="SELECT * FROM vw_lead_export_excel branchname='".$branch."'";		
			//echo $sel_userid;
		 if($sel_userid=="")
			 {
			 	$sql = "SELECT * FROM export_excel_horizontal_type WHERE  branchname='".strtoupper($branch)."'";		
			 }
			else
			{
			//	$sql = "SELECT * FROM vw_lead_export_excel WHERE  branchname='".$branch."' AND created_user IN (".$sel_userid.")";	
				$sql = "SELECT * FROM export_excel_horizontal_type WHERE  branchname='".strtoupper($branch)."' AND assignedtouser IN (".$sel_userid.")";	
				
			}


echo $sql; die;
				$result = $this->db->query($sql);
				$productdetails = $result->result_array();

        			$all_leads_count = count($productdetails);
				$this->session->set_userdata('all_leads_count',$all_leads_count);
				return $productdetails;
 
	}



		function get_leads_user_based_for_grid_withfilter($branch,$sel_userid)
		{
		
				$jTableResult = array();
				$jTableResult['leaddetails'] = $this->get_user_based_leads_withfilter($branch,$sel_userid);
				$data = array();
				
				$i=0;
				while($i < count($jTableResult['leaddetails']))
				{    
					$row = array();
					$row["leadid"] = $jTableResult['leaddetails'][$i]["leadid"];
					$row["lead_no"] = $jTableResult['leaddetails'][$i]["lead_no"];
					$row["email_id"] = $jTableResult['leaddetails'][$i]["email_id"];
					$row["firstname"] = $jTableResult['leaddetails'][$i]["firstname"];
					$row["lastname"] = $jTableResult['leaddetails'][$i]["lastname"];
					$row["endproducttype"] = $jTableResult['leaddetails'][$i]["endproducttype"];
					$row["productsaletype"] = $jTableResult['leaddetails'][$i]["productsaletype"];
					$row["presentsource"] = $jTableResult['leaddetails'][$i]["presentsource"];
					$row["suppliername"] = $jTableResult['leaddetails'][$i]["suppliername"];
					$row["decisionmaker"] = $jTableResult['leaddetails'][$i]["decisionmaker"];
					$row["branchname"] = $jTableResult['leaddetails'][$i]["branchname"];
					$row["comments"] = $jTableResult['leaddetails'][$i]["comments"];
					$row["uploadeddate"] = $jTableResult['leaddetails'][$i]["uploadeddate"];
					$row["description"] = $jTableResult['leaddetails'][$i]["description"];
					$row["secondaryemail"] = $jTableResult['leaddetails'][$i]["secondaryemail"];
					$row["assignedtouser"] = $jTableResult['leaddetails'][$i]["assignedtouser"];
					$row["createddate"] = $jTableResult['leaddetails'][$i]["createddate"];
					$row["createdby"] = $jTableResult['leaddetails'][$i]["createdby"];
					$row["last_modified"] = $jTableResult['leaddetails'][$i]["last_modified"];	
					$row["updatedby"] = $jTableResult['leaddetails'][$i]["updatedby"];
					$row["sent_mail_alert"] = $jTableResult['leaddetails'][$i]["sent_mail_alert"];
					$row["leadsource"] = $jTableResult['leaddetails'][$i]["leadsource"];
					$row["primarystatus"] = $jTableResult['leaddetails'][$i]["primarystatus"];
					$row["substatusname"] = $jTableResult['leaddetails'][$i]["substatusname"];
					$row["loginname"] = $jTableResult['leaddetails'][$i]["loginname"];
					$row["prodqnty"] = $jTableResult['leaddetails'][$i]["prodqnty"];
					$row["productupdatedate"] = $jTableResult['leaddetails'][$i]["productupdatedate"];
					//$row["updatedate"] = $jTableResult['leaddetails'][$i]["updatedate"];	
					$row["created_date"] = $jTableResult['leaddetails'][$i]["created_date"];
					$row["prodcreatedby"] = $jTableResult['leaddetails'][$i]["prodcreatedby"];
					$row["produpdatedby"] = $jTableResult['leaddetails'][$i]["produpdatedby"];
					$row["prod_type_id"] = $jTableResult['leaddetails'][$i]["prod_type_id"];
					$row["leadpoten"] = $jTableResult['leaddetails'][$i]["leadpoten"];
					$row["industrysegment"] = $jTableResult['leaddetails'][$i]["industrysegment"];
					$row["productname"] = $jTableResult['leaddetails'][$i]["productname"];
					$row["itemgroup"] = $jTableResult['leaddetails'][$i]["itemgroup"];
					$row["organisation"] = $jTableResult['leaddetails'][$i]["organisation"];
					$row["uom"] = $jTableResult['leaddetails'][$i]["uom"];
					$row["uomeasure"] = $jTableResult['leaddetails'][$i]["uomeasure"];
					$row["customername"] = $jTableResult['leaddetails'][$i]["customername"];
					$row["customertype"] = $jTableResult['leaddetails'][$i]["customertype"];												
					$data[$i] = $row;
					$i++;
				}
				$arr = "{\"data\":" .json_encode($data). "}";
		//	echo "{ rows: ".$arr." }";
			return $arr;
		}




	function get_all_leads_user_based($user_id)
	{
				$jTableResult = array();
				$jTableResult['leaddetails'] = $this->get_all_leads_reportingto($user_id);
				$data = array();
				
				$i=0;
				while($i < count($jTableResult['leaddetails']))
				{    
					$row = array();
					$row["leadid"] = $jTableResult['leaddetails'][$i]["leadid"];
					$row["lead_no"] = $jTableResult['leaddetails'][$i]["lead_no"];
					$row["email_id"] = $jTableResult['leaddetails'][$i]["email_id"];
					$row["firstname"] = $jTableResult['leaddetails'][$i]["firstname"];
					$row["lastname"] = $jTableResult['leaddetails'][$i]["lastname"];
					$row["endproducttype"] = $jTableResult['leaddetails'][$i]["endproducttype"];
					$row["productsaletype"] = $jTableResult['leaddetails'][$i]["productsaletype"];
					$row["presentsource"] = $jTableResult['leaddetails'][$i]["presentsource"];
					$row["suppliername"] = $jTableResult['leaddetails'][$i]["suppliername"];
					$row["decisionmaker"] = $jTableResult['leaddetails'][$i]["decisionmaker"];
					$row["branchname"] = $jTableResult['leaddetails'][$i]["branchname"];
					$row["comments"] = $jTableResult['leaddetails'][$i]["comments"];
					$row["uploadeddate"] = $jTableResult['leaddetails'][$i]["uploadeddate"];
					$row["description"] = $jTableResult['leaddetails'][$i]["description"];
					$row["secondaryemail"] = $jTableResult['leaddetails'][$i]["secondaryemail"];
					$row["assignedtouser"] = $jTableResult['leaddetails'][$i]["assignedtouser"];
					$row["createddate"] = $jTableResult['leaddetails'][$i]["createddate"];
					$row["createdby"] = $jTableResult['leaddetails'][$i]["createdby"];
					$row["last_modified"] = $jTableResult['leaddetails'][$i]["last_modified"];	
					$row["updatedby"] = $jTableResult['leaddetails'][$i]["updatedby"];
					$row["sent_mail_alert"] = $jTableResult['leaddetails'][$i]["sent_mail_alert"];
					$row["leadsource"] = $jTableResult['leaddetails'][$i]["leadsource"];
					$row["primarystatus"] = $jTableResult['leaddetails'][$i]["primarystatus"];
					$row["substatusname"] = $jTableResult['leaddetails'][$i]["substatusname"];
					$row["loginname"] = $jTableResult['leaddetails'][$i]["loginname"];
					$row["prodqnty"] = $jTableResult['leaddetails'][$i]["prodqnty"];
					$row["productupdatedate"] = $jTableResult['leaddetails'][$i]["productupdatedate"];
					//$row["updatedate"] = $jTableResult['leaddetails'][$i]["updatedate"];	
					$row["created_date"] = $jTableResult['leaddetails'][$i]["created_date"];
					$row["prodcreatedby"] = $jTableResult['leaddetails'][$i]["prodcreatedby"];
					$row["produpdatedby"] = $jTableResult['leaddetails'][$i]["produpdatedby"];
					$row["prod_type_id"] = $jTableResult['leaddetails'][$i]["prod_type_id"];
					$row["leadpoten"] = $jTableResult['leaddetails'][$i]["leadpoten"];
					$row["industrysegment"] = $jTableResult['leaddetails'][$i]["industrysegment"];
					$row["productname"] = $jTableResult['leaddetails'][$i]["productname"];
					$row["itemgroup"] = $jTableResult['leaddetails'][$i]["itemgroup"];
					$row["organisation"] = $jTableResult['leaddetails'][$i]["organisation"];
					$row["uom"] = $jTableResult['leaddetails'][$i]["uom"];
					$row["uomeasure"] = $jTableResult['leaddetails'][$i]["uomeasure"];
					$row["customername"] = $jTableResult['leaddetails'][$i]["customername"];
					$row["customertype"] = $jTableResult['leaddetails'][$i]["customertype"];												
					$data[$i] = $row;
					$i++;
				}
				$arr = "{\"data\":" .json_encode($data). "}";
		//	echo "{ rows: ".$arr." }";
			return $arr;
	}

	 function get_all_leads_reportingto($user_id)
	 {

	 global $reportingid;

	//	$reportingid = $this->session->userdata['reportingto'];
	 $reportingid = $this->session->userdata['loginname'];
	 $user_list_ids =$this->session->userdata['get_assign_to_user_id'];

	  //$user_list_ids = $this->Leads_model->get_user_list_ids($reportingid);
	
      //  $get_assign_to_user_id = array('get_assign_to_user_id'=>$user_list_ids); //set it
    //    $this->session->set_userdata($get_assign_to_user_id);

        //$sql="SELECT * FROM vw_lead_export_excel  WHERE   created_user IN (".$user_list_ids.")";
	  $sql="SELECT * FROM vw_lead_export_excel  WHERE   asignedto_userid IN (".$user_list_ids.")";


     // echo $sql; die;
		$result = $this->db->query($sql);
		$productdetails = $result->result_array();

		$user_leads_count = count($productdetails);
		$this->session->set_userdata('user_leads_count',$user_leads_count);
		return $productdetails;
	 }


	 function get_user_based_leads_withfilter($branch,$sel_userid)
	 {

		 if($sel_userid=="")
			 {
			 	$sql = "SELECT * FROM vw_lead_export_excel WHERE  branchname='".$branch."'";		
			 }
			else
			{
			//	$sql = "SELECT * FROM vw_lead_export_excel WHERE  branchname='".$branch."' AND created_user IN (".$sel_userid.")";	
				$sql = "SELECT * FROM vw_lead_export_excel WHERE  branchname='".$branch."' AND asignedto_userid IN (".$sel_userid.")";	
				
			}
//echo $sql; die;
				$result = $this->db->query($sql);
				$productdetails = $result->result_array();

        			$all_leads_count = count($productdetails);
				$this->session->set_userdata('all_leads_count',$all_leads_count);
				return $productdetails;

	 }

	 function get_leads_withbranchdatefilter($branch,$from_date,$to_date)
	 {
	 			//echo"branch ".$branch;  	echo" user id ".$user_id; die;
			 @$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];
			//print_r($this->session->userdata); die; 
			if ($get_assign_to_user_id =='')
				  {


						$sql="SELECT
									*
								from 
									vw_lead_export_excel 
								where 
									branchname='".$branch."'  AND 
								createddate::DATE  between '".$from_date."'::DATE  and '".$to_date."'::DATE ";
							
				   }
			else	
				    {

								 $sql="SELECT
										*
								from 
									vw_lead_export_excel 
								where 
							
								asignedto_userid IN (".$get_assign_to_user_id.") AND
								branchname='".$branch."'  AND 	createddate::DATE  between '".$from_date."'::DATE  and '".$to_date."'::DATE ";
							
							
				     }
                               // echo $sql; die;
						$jTableResult = array();
						//$sql='select  * from  vw_lead_aging_report';
				    
						$result = $this->db->query($sql);
						$jTableResult['leaddetails'] = $result->result_array();

						
						$data = array();
				
						$i=0;
						while($i < count($jTableResult['leaddetails']))
						{    
							$row = array();
							$row["leadid"] = $jTableResult['leaddetails'][$i]["leadid"];
							$row["lead_no"] = $jTableResult['leaddetails'][$i]["lead_no"];
							$row["email_id"] = $jTableResult['leaddetails'][$i]["email_id"];
							$row["firstname"] = $jTableResult['leaddetails'][$i]["firstname"];
							$row["lastname"] = $jTableResult['leaddetails'][$i]["lastname"];
							$row["endproducttype"] = $jTableResult['leaddetails'][$i]["endproducttype"];
							$row["productsaletype"] = $jTableResult['leaddetails'][$i]["productsaletype"];
							$row["presentsource"] = $jTableResult['leaddetails'][$i]["presentsource"];
							$row["suppliername"] = $jTableResult['leaddetails'][$i]["suppliername"];
							$row["decisionmaker"] = $jTableResult['leaddetails'][$i]["decisionmaker"];
							$row["branchname"] = $jTableResult['leaddetails'][$i]["branchname"];
							$row["comments"] = $jTableResult['leaddetails'][$i]["comments"];
							$row["uploadeddate"] = $jTableResult['leaddetails'][$i]["uploadeddate"];
							$row["description"] = $jTableResult['leaddetails'][$i]["description"];
							$row["secondaryemail"] = $jTableResult['leaddetails'][$i]["secondaryemail"];
							$row["assignedtouser"] = $jTableResult['leaddetails'][$i]["assignedtouser"];
							$row["createddate"] = $jTableResult['leaddetails'][$i]["createddate"];
							$row["createdby"] = $jTableResult['leaddetails'][$i]["createdby"];
							$row["last_modified"] = $jTableResult['leaddetails'][$i]["last_modified"];	
							$row["updatedby"] = $jTableResult['leaddetails'][$i]["updatedby"];
							$row["sent_mail_alert"] = $jTableResult['leaddetails'][$i]["sent_mail_alert"];
							$row["leadsource"] = $jTableResult['leaddetails'][$i]["leadsource"];
							$row["primarystatus"] = $jTableResult['leaddetails'][$i]["primarystatus"];
							$row["substatusname"] = $jTableResult['leaddetails'][$i]["substatusname"];
							$row["loginname"] = $jTableResult['leaddetails'][$i]["loginname"];
							$row["prodqnty"] = $jTableResult['leaddetails'][$i]["prodqnty"];
							$row["productupdatedate"] = $jTableResult['leaddetails'][$i]["productupdatedate"];
							//$row["updatedate"] = $jTableResult['leaddetails'][$i]["updatedate"];	
							$row["created_date"] = $jTableResult['leaddetails'][$i]["created_date"];
							$row["prodcreatedby"] = $jTableResult['leaddetails'][$i]["prodcreatedby"];
							$row["produpdatedby"] = $jTableResult['leaddetails'][$i]["produpdatedby"];
							$row["prod_type_id"] = $jTableResult['leaddetails'][$i]["prod_type_id"];
							$row["leadpoten"] = $jTableResult['leaddetails'][$i]["leadpoten"];
							$row["industrysegment"] = $jTableResult['leaddetails'][$i]["industrysegment"];
							$row["productname"] = $jTableResult['leaddetails'][$i]["productname"];
							$row["itemgroup"] = $jTableResult['leaddetails'][$i]["itemgroup"];
							$row["organisation"] = $jTableResult['leaddetails'][$i]["organisation"];
							$row["uom"] = $jTableResult['leaddetails'][$i]["uom"];
							$row["uomeasure"] = $jTableResult['leaddetails'][$i]["uomeasure"];
							$row["customername"] = $jTableResult['leaddetails'][$i]["customername"];
							$row["customertype"] = $jTableResult['leaddetails'][$i]["customertype"];		

							$data[$i] = $row;
							$i++;
						}
						$arr = "{\"data\":" .json_encode($data). "}";
				//	echo "{ rows: ".$arr." }";
					return $arr;
	 	

	 }


	 function get_leaddetails_userbased_withdatefilter($branch,$user_id,$from_date,$to_date)
	 {


			//echo"branch ".$branch;  	echo" user id ".$user_id; die;
			 @$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];
			//print_r($this->session->userdata); die; 
			if ($get_assign_to_user_id =='')
				  {
					 if($user_id=="")
							{
							$sql="SELECT
									*
								from 
									vw_lead_export_excel 
								where 
									branchname='".$branch."'  createddate::DATE  between '".$from_date."'::DATE  and '".$to_date."'::DATE ";
							}
							else
							{
								$sql="SELECT
									*
								from 
									vw_lead_export_excel 
								where  
									branchname='".$branch."' AND asignedto_userid IN (".$user_id.") AND 
								createddate::DATE  between '".$from_date."'::DATE  and '".$to_date."'::DATE";
							}
				   }
			else	
				    {


			     				if($user_id=="")
							{

								$sql="SELECT
									*
								from 
									vw_lead_export_excel 
								where 
									branchname='".$branch."' AND asignedto_userid IN (".$get_assign_to_user_id.") AND   createddate::DATE  between '".$from_date."'::DATE  and '".$to_date."'::DATE ";
								
							}
							else
							{

								$sql="SELECT
									*
								from 
									vw_lead_export_excel 
								where 
									branchname='".$branch."' AND asignedto_userid IN (".$get_assign_to_user_id.")  AND  asignedto_userid='".$user_id."' AND  createddate::DATE  between '".$from_date."'::DATE  and  '".$to_date."'::DATE";

							}
				     }
                               // echo $sql; die;
						$jTableResult = array();
						//$sql='select  * from  vw_lead_aging_report';
				    
						$result = $this->db->query($sql);
						$jTableResult['leaddetails'] = $result->result_array();
						$chart_leads_count = count($jTableResult['leaddetails']);
						$this->session->set_userdata('chart_leads_count',$chart_leads_count);
						$data = array();
				
						$i=0;
						while($i < count($jTableResult['leaddetails']))
						{    
							$row = array();
							$row["leadid"] = $jTableResult['leaddetails'][$i]["leadid"];
							$row["lead_no"] = $jTableResult['leaddetails'][$i]["lead_no"];
							$row["email_id"] = $jTableResult['leaddetails'][$i]["email_id"];
							$row["firstname"] = $jTableResult['leaddetails'][$i]["firstname"];
							$row["lastname"] = $jTableResult['leaddetails'][$i]["lastname"];
							$row["endproducttype"] = $jTableResult['leaddetails'][$i]["endproducttype"];
							$row["productsaletype"] = $jTableResult['leaddetails'][$i]["productsaletype"];
							$row["presentsource"] = $jTableResult['leaddetails'][$i]["presentsource"];
							$row["suppliername"] = $jTableResult['leaddetails'][$i]["suppliername"];
							$row["decisionmaker"] = $jTableResult['leaddetails'][$i]["decisionmaker"];
							$row["branchname"] = $jTableResult['leaddetails'][$i]["branchname"];
							$row["comments"] = $jTableResult['leaddetails'][$i]["comments"];
							$row["uploadeddate"] = $jTableResult['leaddetails'][$i]["uploadeddate"];
							$row["description"] = $jTableResult['leaddetails'][$i]["description"];
							$row["secondaryemail"] = $jTableResult['leaddetails'][$i]["secondaryemail"];
							$row["assignedtouser"] = $jTableResult['leaddetails'][$i]["assignedtouser"];
							$row["createddate"] = $jTableResult['leaddetails'][$i]["createddate"];
							$row["createdby"] = $jTableResult['leaddetails'][$i]["createdby"];
							$row["last_modified"] = $jTableResult['leaddetails'][$i]["last_modified"];	
							$row["updatedby"] = $jTableResult['leaddetails'][$i]["updatedby"];
							$row["sent_mail_alert"] = $jTableResult['leaddetails'][$i]["sent_mail_alert"];
							$row["leadsource"] = $jTableResult['leaddetails'][$i]["leadsource"];
							$row["primarystatus"] = $jTableResult['leaddetails'][$i]["primarystatus"];
							$row["substatusname"] = $jTableResult['leaddetails'][$i]["substatusname"];
							$row["loginname"] = $jTableResult['leaddetails'][$i]["loginname"];
							$row["prodqnty"] = $jTableResult['leaddetails'][$i]["prodqnty"];
							$row["productupdatedate"] = $jTableResult['leaddetails'][$i]["productupdatedate"];
							//$row["updatedate"] = $jTableResult['leaddetails'][$i]["updatedate"];	
							$row["created_date"] = $jTableResult['leaddetails'][$i]["created_date"];
							$row["prodcreatedby"] = $jTableResult['leaddetails'][$i]["prodcreatedby"];
							$row["produpdatedby"] = $jTableResult['leaddetails'][$i]["produpdatedby"];
							$row["prod_type_id"] = $jTableResult['leaddetails'][$i]["prod_type_id"];
							$row["leadpoten"] = $jTableResult['leaddetails'][$i]["leadpoten"];
							$row["industrysegment"] = $jTableResult['leaddetails'][$i]["industrysegment"];
							$row["productname"] = $jTableResult['leaddetails'][$i]["productname"];
							$row["itemgroup"] = $jTableResult['leaddetails'][$i]["itemgroup"];
							$row["organisation"] = $jTableResult['leaddetails'][$i]["organisation"];
							$row["uom"] = $jTableResult['leaddetails'][$i]["uom"];
							$row["uomeasure"] = $jTableResult['leaddetails'][$i]["uomeasure"];
							$row["customername"] = $jTableResult['leaddetails'][$i]["customername"];
							$row["customertype"] = $jTableResult['leaddetails'][$i]["customertype"];	
					

							$data[$i] = $row;
							$i++;
						}
						$arr = "{\"data\":" .json_encode($data). "}";
				//	echo "{ rows: ".$arr." }";
					return $arr;



	 }
	
} // End of Class
?>
