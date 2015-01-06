<?php

class dailycall extends CI_Controller {

	public $data = array();
	public $post = array();
	public $daily_dtl = array();
	public $activitydata = array();	
	public $loginuser;
  	public $userid;
	public $loginname;
	public $reportingto;
	public $countryid;
	public $stateid;
	public $login_user_id;
	public $daily_hdr_id;
	public $daily_hdr_insert_status;
  	public $datagroup = array();
  	public $db_dc;

	function __construct()
	{
	 parent::__construct();
	 $this->load->library('admin_auth');
	 $this->lang->load('admin');
	 $this->load->database();
	 $this->load->database('forms', TRUE);
	 $this->load->helper('url');
	 $this->load->model('Leads_model');
	 $this->load->model('dailyactivity_model');
	 
	 $this->load->model('dailycall_model');
   	 $this->load->library('subquery');
	 $this->load->library('session');
	 $this->load->helper('html');

	}



	public function index()
	{
		

		@$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];
		
		 if (!$this->admin_auth->logged_in())
			{
				//redirect them to the login page
				redirect('admin/login', 'refresh');
			}
			elseif (!$this->admin_auth->is_admin())
			{
				$user = $this->admin_auth->user()->row();
				$allgroups =  $this->admin_auth->groups()->result();
				$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
				$activitydata['data']=$this->dailycall_model->get_customerinfo_for_grid();
				
				 $activitydata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
				$data = array();
				$i=0;
				$datagroup = array();					
				foreach($activitydata['permission'] as $key=>$val)
				{
					$row = array();

					$row["groupid"] = $key;
					$row["groupname"] = $val;
					$datagroup[$i] = $row;
					$i++;
				}

				$arr = json_encode($datagroup);
				$activitydata['grpperm'] =$arr;

			//	print_r($activitydata); die;
				$this->load->view('dailycall/viewdailycall',$activitydata);	
			} 
			else
		  	{
	 			redirect('admin/index', 'refresh');
			}
	}
	
	

		function gettypeofvisit()
		{
			$data = array();
			$data=$this->dailycall_model->get_typeofvisit();
			print_r($data);

		}
		function getldtypeofsales()
		{
			$data = array();
			$data=$this->dailycall_model->get_ldtypeofsales();
			print_r($data);

		}
		function getcontactmode()
		{
			$data = array();
			$data=$this->dailycall_model->get_contactmode();
			print_r($data);

		}
		
		function getdispatch_ld()
		{
			$data = array();
			$data=$this->dailycall_model->get_dispatch_ld();
			print_r($data);

		}

		function getdispatch()
		{
			$data = array();
			$data=$this->dailycall_model->get_dispatch();
			print_r($data);

		}
		function getmailalerts()
		{
			$data = array();
			$data=$this->dailycall_model->get_getmailalerts();
			print_r($data);

		}
		function getcustomercontacts($customer_id)
		{
			$data = array();
			$data=$this->dailycall_model->get_customercontacts($customer_id);
			print_r($data);

		}
		function getcustomerdesignation($customer_id)
		{
			$data = array();
			$data=$this->dailycall_model->get_customerdesignation($customer_id);
			print_r($data);

		}
		function getleadcontacts($leadid)
		{
			$activitydata['designation']=$this->dailycall_model->get_leadcontacts($leadid);
				//print_r($activitydata); die;
				//header('Content-Type: application/x-json; charset=utf-8');
			$viewdata = $activitydata['designation']; 
			echo $viewdata;
		}

		 function getleadsubstatus($parent_id)
		{
		$this->dailycall_model->parent_id = $parent_id;
		$substatus = $this->dailycall_model->get_dcleadsubstatus();
		header('Content-Type: application/x-json; charset=utf-8');
		echo json_encode($substatus);
		}



		function savedailycall_ld()
		{
				//echo"<pre>"; print_r($_POST); echo"<pre>"; 
				//$hdn_grid_row_data = json_decode($_POST['hdn_grid_row_data'],TRUE);
			//	echo"decode data";print_r($hdn_grid_row_data); die;

					$leadid = $_POST['hdn_leadid'];
					$hrd_currentdate = $_POST['visitdate'];
					$typeofvisit = $_POST['typeofvisit'];
					$timeinhrs = $_POST['timeinhrs'];
					$timeinmins = $_POST['timeinmins'];
					$modofcont_id = $_POST['modeofcontact'];
					$personmet =	$_POST['personmet'];
					$quotation_email = $_POST['quotation_email'];
					$visitname=$_POST['hdn_visitname'];
					$moc_name=$_POST['hdn_mocname'];
					$collection=$_POST['collection'];
					$statuory=$_POST['statuory'];
					$hrd_currentdate =implode("-", array_reverse(explode("-", $hrd_currentdate)));
			
			if($leadid!=0)
	   		{
				$leadstatus = $_POST['leadstatus'];
				$leadsubstatus = $_POST['leadsubstatus'];
				$hdn_status_id = $_POST['hdn_status_id'];
				$hdn_sub_status_id = $_POST['hdn_sub_status_id'];
				$hdncustomername = $_POST['hdncustomername'];
			}
				$customer_id = $_POST['hdn_customerid'];
				$leadid = $_POST['hdn_leadid'];
				$hdr_comments=$_POST['hdn_cmnts'];
				if($leadid!=0)
				{
				$lead_status_name= $this->Leads_model->GetLeadStatusName($leadstatus);
				$lead_substatus_name= $this->Leads_model->GetLeadSubStatusName($leadsubstatus);
				}
				$update_prod=0;
				$insert_prod=0;
				$hdn_grid_row_data = json_decode($_POST['hdn_grid_row_data'],TRUE);
			//	echo"decode data";print_r($hdn_grid_row_data); 

					//print_r( $this->session->userdata); die;
					$login_user_id = $this->session->userdata['user_id'];

					$login_username = $this->session->userdata['username'];
					$createddate = date('Y-m-d:H:i:s');
					$lastupdatedate = date('Y-m-d:H:i:s');
					$creationuser =$this->session->userdata['identity'];
					$lastupdateuser =$this->session->userdata['identity'];
					$execode = $this->session->userdata['empcode'];
					$exename = $this->session->userdata['identity'];
					$user1 = $this->session->userdata['loginname'];
					//$user1 = $this->session->userdata['username'];
				

				
					$hdncustomername = $_POST['hdncustomername'];
					$customer_id = $_POST['hdn_customerid'];
					$leadid = $_POST['hdn_leadid'];

					if($leadid!=0)
	   					{
	   						$leadstatus = $_POST['leadstatus'];
	   						$leadsubstatus = $_POST['leadsubstatus'];
							$hdn_status_id = $_POST['hdn_status_id'];
	   						$log_comments = "updated from dailycall";
	   						$sub_log_comments = "updated substatus from dailycall";
	   						$lead_status_name= $this->Leads_model->GetLeadStatusName($leadstatus);
	   						$lead_substatus_name= $this->Leads_model->GetLeadSubStatusName($leadsubstatus);
						}
				 		if (($_POST['leadstatus']!=$_POST['hdn_status_id']) ||( $_POST['leadsubstatus']!=$_POST['hdn_sub_status_id'] )|| (trim($_POST['description'])!=trim($_POST['hdn_cmnts'])))
						{
							 $update_log=1;
						}
						else
						{
							$update_log=0;
						}
						if (($_POST['leadstatus']!=$_POST['hdn_status_id']) || ($_POST['leadsubstatus']!=$_POST['hdn_sub_status_id']))
						{	
							$lead_status_update='Y';
						}
						else{	
							$lead_status_update='N';
						}
						$crm_first_soc_no = $_POST['txtLeadsoc'];
						if ($crm_first_soc_no=="")
						{
							$crm_first_soc_no=0;
							$ld_converted = 0;
						}
						else
						{	
							$crm_first_soc_no=$_POST['txtLeadsoc'];
							$ld_converted =1;
						}


						 $leaddetails = array(
							'leadstatus' => $_POST['leadstatus'],
							'company' => $_POST['hdn_customerid'],
							'customer_id' => $customer_id,
							'ldsubstatus' => $_POST['leadsubstatus'],
							'lead_crm_soc_no' =>$crm_first_soc_no, 
							'converted' =>$ld_converted, 
							'website' => $_POST['website'],
							'last_modified' => date('Y-m-d:H:i:s'),
							'last_updated_user' => $login_user_id
							);

					/*$leadaddress = array(
							'leadaddressid' => $leadid,
							'city' => $_POST['city'],
							'state' => $_POST['state'],
							'street' => $_POST['customeraddress'],
							'pobox' => $_POST['postalcode'],
							'phone' => $_POST['phone'],
							'country' => $_POST['country'],
							'mobile_no' => $_POST['mobile_no'],
							'fax' => $_POST['fax'],
							'last_modified' => date('Y-m-d:H:i:s')
							);*/

	                       $id =$this->Leads_model->update_lead($leaddetails,$leadid);
	                     //  $addid = $this->Leads_model->update_lead_address($leadaddress,$leadid);

	                     	  $lead_productids= array();
				//	echo"del count is ".count($_POST['deledct_val']);
					

					if(	(count(@$_POST['deledct_val'])>0 ) && (! in_array('undefined', @$_POST['deledct_val'],true) ) )
					{
						foreach ($_POST['deledct_val'] as $key => $value) 
						{
						//echo $sql ="delete from leadproducts where lpid =".$value;
						//$result
						$lead_productids[$key]=$value;
						}

						//echo"dct_delete_ids";print_r($dct_delete_ids);
						$delid = $this->dailycall_model->delete_leadproduct_details($lead_productids);	

					}
						if($_POST['visitdate']!=='')
						{

							$daily_hdr_id= $this->dailycall_model->GetMaxValdc('dailycall_hdr');
							$daily_hdr_id=$daily_hdr_id+1;


								$daily_hdr = array('dch_header_id' => $daily_hdr_id,
										'dch_customerid' => $customer_id,
										'dch_leadid' => $leadid,
										'dch_custname' => $hdncustomername,
										'dch_visittypeid' => $typeofvisit,
										'dch_visittypename' => $visitname,
										'dch_visitdate' => $hrd_currentdate,
										'dch_time_hrs' => $timeinhrs,
										'dch_time_mis' => $timeinmins,
										'dch_modofcont_id' => $modofcont_id,
										'dch_modofcontname'=>$moc_name,
										'dch_collection'=>$collection,
										'dch_statuory'=>$statuory,
										'dch_quotation_email' => $quotation_email,
										'dch_created_userid' => $login_user_id,
										'dch_created_usename' => $creationuser,
										'dch_created_date' => $createddate
										

							);
						}		
//print_r($daily_hdr); die;
							$daily_hdr_insert_status =$this->dailycall_model->save_dailyactivityhdr($daily_hdr);
							foreach($_POST['personmet'] as $key=>$val)
							{
							//	echo"key ".$key."<br>";
							//	print_r($val);
								
								$daily_preson[$key]['dc_hdr_personmet'] =$daily_hdr_id;
								$daily_preson[$key]['dc_personmet_name'] = $val[0];
								$daily_preson[$key]['dc_designation'] = $val[1];
								$daily_preson[$key]['dc_email_id'] = $val[2];
								$daily_preson[$key]['dc_phone_no'] = $val[3];


							}
				//print_r($daily_preson); 	
					  $daily_callpersonmet_id =$this->dailycall_model->save_dcpersonmet_details($daily_preson);

	                          $daily_hdrlog_id= $this->dailycall_model->GetMaxValdloghrd('daily_call_log_hdr');
					$daily_hdrlog_id=$daily_hdrlog_id+1;
					$hdr_comments="updated for log header ";

					$daily_hdrlog = array('hdrlog_id' => $daily_hdrlog_id,
					'hdr_status_id' => $hdn_status_id,
					'hdr_customer_id' => $customer_id,
					'hdr_leadid' => $leadid,
					'hdr_personmet' => $daily_hdr_id,
					'hdr_customer_name' => $hdncustomername,
					'hdr_visitdate' => $hrd_currentdate,
					'hdr_collection' => $collection,
					'hdr_time_hrs' => $timeinhrs,
					'hdr_time_mis' => $timeinmins,
					'hdr_statuory' => $statuory,
					'hdr_visittype_id' => $typeofvisit,
					'hdr_visittype_name' => $visitname,
					'hdr_modeofcontact_id' => $modofcont_id,
					'hdr_modeofcontact_name'=>$moc_name,
					'hdr_status_name' => $lead_status_name,
					'hdr_substs_id' => $hdn_sub_status_id,
					'hdr_substs_name' => $lead_substatus_name,
					'hdr_comments' => $hdr_comments,
					'hdr_updateddate' => $lastupdatedate,
					'hdr_updateduser'=>$login_user_id,
					'hdr_transtype' => "Update",
					'hdr_updateduser_name' => $login_username
					);
					//	print_r($daily_hdrlog); die;

					$daily_hdrlog_insert_status =$this->dailycall_model->save_dailyactivityloghdr($daily_hdrlog);

					if($daily_hdrlog_insert_status)
					{
						echo"log hdr inserted id is ".$daily_hdrlog_id."<br>";
					}

					$proddata = array();
					$proddatainsert = array();
					$dc_logdtl_id = array();
					$daily_logdtl = array();
				//	echo"<pre>";print_r($hdn_grid_row_data);echo"</pre>";


					foreach($hdn_grid_row_data as $key=>$val)
					{


						if($hdn_grid_row_data[$key]['dct_detail_id']=='undefined' || $hdn_grid_row_data[$key]['dct_detail_id']=="")
						{
							$insert_prod=1;
							//echo"in undefined <br>";
							//echo"New id ".$this->Leads_model->GetNextSeqVal('leadproducts_lpid_seq');
							$proddatainsert[$key]['leadid'] = $leadid;
							$proddatainsert[$key]['lpid'] = $this->Leads_model->GetNextSeqVal('leadproducts_lpid_seq');
							$proddatainsert[$key]['productid'] =$hdn_grid_row_data[$key]['dct_prodid']; 
							$proddatainsert[$key]['quantity'] = $hdn_grid_row_data[$key]['dct_quantity'];
							$proddatainsert[$key]['potential'] =  $hdn_grid_row_data[$key]['dct_potential'];
							$proddatainsert[$key]['prod_type_id'] =  $hdn_grid_row_data[$key]['dct_salestype_id'];
							$proddatainsert[$key]['annualpotential'] = (( $hdn_grid_row_data[$key]['dct_potential']) * 12);
							$proddatainsert[$key]['dct_sales'] =  $hdn_grid_row_data[$key]['dct_sales'];
							$proddatainsert[$key]['dct_actionplanned'] =  $hdn_grid_row_data[$key]['dct_actionplanned'];
/*							$proddatainsert[$key]['dct_collection'] =  $hdn_grid_row_data[$key]['dct_collection'];
							$proddatainsert[$key]['dct_statuory'] =  $hdn_grid_row_data[$key]['dct_statuory'];*/
							$proddatainsert[$key]['dct_marketinformation'] =  $hdn_grid_row_data[$key]['dct_marketinformation'];
							$proddatainsert[$key]['last_modified'] = date('Y-m-d:H:i:s');
							$proddatainsert[$key]['last_updated_user'] = $login_user_id;
						}
						else
						{
							$update_prod=1;
							$proddata[$key]['leadid'] = $leadid;
							$proddata[$key]['lpid'] = $hdn_grid_row_data[$key]['dct_detail_id'];
							$proddata[$key]['productid'] =$hdn_grid_row_data[$key]['dct_prodid']; 
							$proddata[$key]['quantity'] = $hdn_grid_row_data[$key]['dct_quantity'];
							$proddata[$key]['potential'] =  $hdn_grid_row_data[$key]['dct_potential'];
							$proddata[$key]['prod_type_id'] =  $hdn_grid_row_data[$key]['dct_salestype_id'];
							$proddata[$key]['annualpotential'] = (( $hdn_grid_row_data[$key]['dct_potential']) * 12);
							$proddata[$key]['dct_sales'] =  $hdn_grid_row_data[$key]['dct_sales'];
							$proddata[$key]['dct_actionplanned'] =  $hdn_grid_row_data[$key]['dct_actionplanned'];
/*							$proddata[$key]['dct_collection'] =  $hdn_grid_row_data[$key]['dct_collection'];
							$proddata[$key]['dct_statuory'] =  $hdn_grid_row_data[$key]['dct_statuory'];*/
							$proddata[$key]['dct_marketinformation'] =  $hdn_grid_row_data[$key]['dct_marketinformation'];
							$proddata[$key]['last_modified'] = date('Y-m-d:H:i:s');
							$proddata[$key]['last_updated_user'] = $login_user_id;
						}

						$dc_logdtl_id= $this->dailycall_model->GetNextLogDtlSeqVal('dailycall_log_dtl');
					//	$daily_logdtl[$key]['dtllog_id'] = $dc_logdtl_id;
						$daily_logdtl[$key]['dtllog_hdr_id'] = $daily_hdrlog_id;
						$daily_logdtl[$key]['dtllog_prodid'] = $hdn_grid_row_data[$key]['dct_prodid'];
						$daily_logdtl[$key]['dtllog_prodname'] =  $hdn_grid_row_data[$key]['productname']; 
						$daily_logdtl[$key]['dtllog_poten'] = $hdn_grid_row_data[$key]['dct_potential'];	
						$daily_logdtl[$key]['dtllog_qnty'] = $hdn_grid_row_data[$key]['dct_quantity'];
						$daily_logdtl[$key]['dtllog_salestype_id'] = $hdn_grid_row_data[$key]['dct_salestype_id'];
						$daily_logdtl[$key]['dtllog_salestype_name'] = $hdn_grid_row_data[$key]['dct_salestypename'];
						$daily_logdtl[$key]['dtllog_actionplanned'] = $hdn_grid_row_data[$key]['dct_actionplanned'];
						$daily_logdtl[$key]['dtllog_sales'] = $hdn_grid_row_data[$key]['dct_sales'];
						
/*						$daily_logdtl[$key]['dtllog_collection'] = $hdn_grid_row_data[$key]['dct_collection'];
						$daily_logdtl[$key]['dtllog_satutory'] = $hdn_grid_row_data[$key]['dct_statuory'];*/
						$daily_logdtl[$key]['dtllog_market_info'] = $hdn_grid_row_data[$key]['dct_marketinformation'];

						$daily_logdtl[$key]['dtllog_updateddate'] = date('Y-m-d:H:i:s');
						$daily_logdtl[$key]['dtllog_updateduser'] = $login_user_id;
						
/*
	   					echo"insert_prod ".$insert_prod."<br>";
	   					echo"update_prod ".$update_prod."<br>";
	   					echo"update log table ".$daily_logdtl."<br>";*/
	   				

					}
					/*echo"proddata update<pre>";print_r($proddata);echo"</pre>"; 
					echo"proddatainsert <pre>";print_r($proddatainsert);echo"</pre>"; 
					echo"update log table <pre>";print_r($daily_logdtl);echo"</pre>";die;*/
				
					


					$prdetid = $this->dailycall_model->update_leadproducts($proddata,$leadid);
					
					if ($insert_prod)
					{
						$prdetidins = $this->dailycall_model->save_dc_ldproducts($proddatainsert,$leadid);	
					}
					

					if ($daily_hdrlog_insert_status)
					{
						// print_r($daily_logdtl); die;
						// $daily_dlt_id =$this->dailycall_model->save_daily_details($daily_dtl);
						$daily_logdlt_id =$this->dailycall_model->save_dclogdtl_products($daily_logdtl);
						//
					}


					  $lead_log_details = array('lh_lead_id' => $leadid,
										'lh_user_id' => $login_user_id,
										'lh_lead_curr_status' => $lead_status_name,
										'lh_lead_curr_statusid' => $_POST['leadstatus'],
										'lh_updated_date' => date('Y-m-d:H:i:s'),
										'lh_last_updated_user' => $login_user_id,
										'lh_comments' => $log_comments,
										'action_type'=> 'Update',
										'modified_user_name'=> $login_username,
										'status_update'=> $lead_status_update
									);
							if($update_log==1)
							{
						 	  $logid = $this->Leads_model->create_leadlog($lead_log_details);
							}

							$lead_sublog_details = array(
										'lhsub_lh_id' => $logid,
										'lhsub_lh_lead_id' => $leadid,
										'lhsub_lh_user_id' => $login_user_id,
										'lhsub_lh_lead_curr_status' => $lead_status_name,
										'lhsub_lh_lead_curr_sub_status' => $lead_substatus_name,
										'lhsub_lh_lead_curr_statusid' => $_POST['leadstatus'],
										'lhsub_lh_updated_date' => date('Y-m-d:H:i:s'),
										'lhsub_lh_last_updated_user' => $login_user_id,
										'lhsub_lh_comments' => $sub_log_comments,
										'lhsub_action_type'=> 'Update',
										'lhsub_modified_user_name'=> $login_username,
										'lhsub_status_update'=> $lead_status_update
									);

							if($update_log==1)
							{
						   		$sublogid = $this->Leads_model->create_lead_sublog($lead_sublog_details);
							}
               					    $update_date = $this->Leads_model->update_prev_moddate($logid); 


				 $message = "Added record for visitdate  by ".$exename." for  the customer ".$hdncustomername;		
 	  			 $this->session->set_flashdata('message', $message);
				//redirect('dailycall/viewdiallycalldetailsbydate/'.$customer_id);
 	  			 redirect('dailycall/ldcustomerdetails/'.$customer_id.'/'.$leadid);
		}
		function savedailycall()
		{
		
					$leadid = 0;
					$seleced_customer_name= $_POST['select_customer'];
    					$hdnselect_customer_id  = $_POST['hdnselect_customer_id'];
    					$hdncustomername =  $_POST['hdncustomername'];
    					$customer_id= $_POST['hdncustomerid'];
    					
					$hrd_currentdate = $_POST['visitdate'];
					$typeofvisit = $_POST['typeofvisit'];
					$timeinhrs = $_POST['timeinhrs'];
					$timeinmins = $_POST['timeinmins'];
					$to_timeinhrs = $_POST['to_timeinhrs'];
					$to_timeinmins = $_POST['to_timeinmins'];
					$modofcont_id = $_POST['modeofcontact'];
					$moc_name=$_POST['hdn_mocname'];

				/*@$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];
		
				 if (!$this->admin_auth->logged_in())
					{
						//redirect them to the login page
						redirect('admin/login', 'refresh');
					}
					elseif (!$this->admin_auth->is_admin())
					{
						$user = $this->admin_auth->user()->row();
						$allgroups =  $this->admin_auth->groups()->result();
						$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
									
						$activitydata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
						$data = array();
						$i=0;
						$datagroup = array();					
						foreach($activitydata['permission'] as $key=>$val)
						{
							$row = array();

							$row["groupid"] = $key;
							$row["groupname"] = $val;
							$datagroup[$i] = $row;
							$i++;
						}

						$arr = json_encode($datagroup);
						$activitydata['grpperm'] =$arr;
					  }*/


				if (isset($_POST['hdnaddProdflag']))
				{
					$addProdflag =$_POST['hdnaddProdflag'];
				}
				else
				{
					$addProdflag =0;
				}
				echo"<pre>";print_r($_POST);echo"</pre>";
				$hdn_grid_row_data = json_decode($_POST['hdn_grid_row_data'],TRUE);
				$hdn_grid_row_data_pm = json_decode($_POST['hdn_grid_row_data_pm'],TRUE);
				echo" hdn_grid_row_data count ";echo"<pre>";echo count($hdn_grid_row_data);echo"</pre>";
				echo"decode data";echo"<pre>";print_r($hdn_grid_row_data); echo"</pre>";
				echo"decode pm data";echo"<pre>";print_r($hdn_grid_row_data_pm); echo"</pre>";
				$hdnencustomerinfo=unserialize($_POST['hdnencustomerinfo']);
				//echo"customer info decoded ";print_r($hdnencustomerinfo); 
			//	die;

				$visitdetails = $this->dailycall_model->get_visittypenames($typeofvisit);
					
				//	print_r($visitdetails);
					$visitnames= implode(",", $visitdetails);
					//echo"visitnames ".$visitnames;
					
					$hrd_currentdate =implode("-", array_reverse(explode("-", $hrd_currentdate)));
					$hdncustomergroup = $_POST['hdncustomergroup'];
					$leadstatus =7;
					$leadsubstatus = 29;
					$lead_status_name="Expanding And Build Relationship";
					$hdn_sub_status_id=29;
					$lead_substatus_name="Expanding And Build Relationship";
					$leadstatus=7;
					$new_lead_status="Prospect";
					$new_lead_status_id=1;
					$new_lead_substatus="Assigned";
					$new_lead_substatus_id=1;
					
					$update_prod=0;
					$insert_prod=0;
					$ld_pot=0;

					$login_user_id = $this->session->userdata['user_id'];
					$login_username = $this->session->userdata['username'];
					$createddate = date('Y-m-d:H:i:s');
					$lastupdatedate = date('Y-m-d:H:i:s');
					/*print_r($this->session->userdata); die;
[session_id] => 11c62db306e646c4229de42fe932ad74
[ip_address] => 10.1.2.40
[user_agent] => Mozilla/5.0 (X11; Linux x86_64; rv:30.0) Gecko/20100101 Firefox/30.0
[last_activity] => 1407404398
[user_data] => 
[default_user_id] => 319
[empcode] => 
[identity] => SATHYA
[username] => SATHYA
[loginname] => ISD5
[email] => psathyamoorthy@gmail.com
[user_id] => 319
[old_last_login] => 
[reportingto] => 
[all_leads_converted_count] => 305
[all_leads_count] => 5012
[run_time_lead_id] => 16940
[all_customer_count] => 32266*/
					$creationuser =$this->session->userdata['identity'];
					$lastupdateuser =$this->session->userdata['identity'];
					$execode = $this->session->userdata['empcode'];
					$exename = $this->session->userdata['identity'];
					$user1 = $this->session->userdata['loginname'];
					$branch = $this->dailycall_model->GetUserBranch($login_user_id);

					if($_POST['visitdate']!=='')
						{

							$daily_hdr_id= $this->dailycall_model->GetMaxValdc('dailycall_hdr');
							$daily_hdr_id=$daily_hdr_id+1;


								$daily_hdr = array('dch_header_id' => $daily_hdr_id,
										'dch_customerid' => $customer_id,
										'dch_leadid' => $leadid,
										'dch_custname' => $seleced_customer_name,
										'dch_custgroupname' => $hdncustomergroup,
										'dch_visittypeid' => $typeofvisit,
										'dch_visittypename' => $visitnames,
										'dch_visitdate' => $hrd_currentdate,
										'dch_time_hrs' => $timeinhrs,
										'dch_time_mis' => $timeinmins,
										'dch_modofcont_id' => $modofcont_id,
										'dch_modofcontname'=>$moc_name,
										'dch_created_userid' => $login_user_id,
										'dch_created_usename' => $creationuser,
										'dch_created_date' => $createddate
										

							);
						}
						$daily_hdr_insert_status =$this->dailycall_model->save_dailyactivityhdr($daily_hdr);

						foreach($hdn_grid_row_data_pm as $key=>$val)
							{

								if($val['soc_mail']=='undefined'){ $val['soc_mail']='false';}
								if($val['payment_mail']=='undefined'){ $val['payment_mail']='false';}
								if($val['general_mail']=='undefined'){ $val['general_mail']='false';}
								if($val['quotation_mail']=='undefined'){ $val['quotation_mail']='false';}
								if($val['dispatch_mail']=='undefined'){ $val['dispatch_mail']='false';}
								if($val['personmet']=='undefined'){ $val['personmet']='false';}
								


								$daily_preson[$key]['dc_header_id'] =$daily_hdr_id;
								$daily_preson[$key]['dc_cust_id'] = $customer_id;
								$daily_preson[$key]['dc_personmet_name'] = $val['contactperson'];
								$daily_preson[$key]['dc_designation'] = $val['designation'];
								$daily_preson[$key]['deptname'] = $val['deptname'];
								$daily_preson[$key]['dc_email_id'] = $val['contact_mailid']; 
								$daily_preson[$key]['dc_phone_no'] = $val['contact_no'];
								$daily_preson[$key]['dc_mobile_no'] = $val['mobile_no'];
								$daily_preson[$key]['soc_mail'] = $val['soc_mail'];
								$daily_preson[$key]['payment_mail'] = $val['payment_mail'];
								$daily_preson[$key]['general_mail'] = $val['general_mail'];
								$daily_preson[$key]['quotation_mail'] = $val['quotation_mail'];
								$daily_preson[$key]['dispatch_mail'] = $val['dispatch_mail'];
								$daily_preson[$key]['personmet'] = $val['personmet'];

								$dct_custid[$key]=$customer_id;

							}
				
							 $delid = $this->dailycall_model->delete_dcpersonmet_details($dct_custid);

					  $daily_callpersonmet_id =$this->dailycall_model->save_dcpersonmet_details($daily_preson);

	/* start visitdetail*/

								$dailyvisit_detail = array(
								'dcv_header_id' => $daily_hdr_id,
								'dcv_visit_id' => $typeofvisit,
								'dcv_custgroupname' => $hdncustomergroup,
								'dcv_customerid' => $customer_id,
								'dcv_customername' => $hdncustomername,
								'dcv_created_date' => $createddate,
								'dcv_created_userid' => $login_user_id,
								'dcv_created_usename' => $creationuser
								);
					$daily_visitdtl_insert_status =$this->dailycall_model->save_dailyvisitdetail($dailyvisit_detail);
/*end visitdetail */	


							$businesscat=array("0"=>"BULK", "1"=>"PART TANKER","2"=>"REPACK","3"=>"INTACT","4"=>"SINGLE - TANKER","5"=>"SMALL PACKING");
							$poten_cat = array("0"=>"bulk", "1"=>"part_tanker","2"=>"repack","3"=>"intact","4"=>"single_tanker","5"=>"small_packing");
							$businesscatprod=array("0"=>"bulk", "1"=>"small_packing","2"=>"part_tanker","3"=>"single_tanker","4"=>"intact","5"=>"repack");
							$poten_catprod = array("bulk"=>"173794", "part_tanker"=>"3","repack"=>"1","intact"=>"173795","single_tanker"=>"681045","small_packing"=>"681046");
							// insert only when the customer grid product has more dhan one rows - START
							if(count($hdn_grid_row_data)>0)
							{
/* Saving /update  Products start*/
								foreach($hdn_grid_row_data as $key=>$val)
								{
								$i=0;
								$j=0;
							//	 echo"one<br>".$hdn_grid_row_data[$key]['productgroup'];
							//	 echo"i value ".$i."<br>";
							//	 echo"j value ".$j."<br>";
								
								if ($_POST['visitdate']!="")
									{

										if($hdn_grid_row_data[$key]['dct_new_prod']=='1') 
										{

											for ($i=0;$i<=5;$i++)
											 {
											 //	echo"busness cat ".$businesscat[$i]."<br>";
											 	
											 	if(($hdn_grid_row_data[$key][$poten_cat[$i]]=="undefined") || ($hdn_grid_row_data[$key][$poten_cat[$i]]==""))
											 	 {$hdn_grid_row_data[$key][$poten_cat[$i]]=0;}
												$insert_dailycall=1;
												$dcprodinsert[$i]['dct_header_id'] =$daily_hdr_id;
												$dcprodinsert[$i]['dct_new_prod'] =$hdn_grid_row_data[$key]['dct_new_prod'];
												$dcprodinsert[$i]['dct_customergroup'] =$hdncustomergroup; 
												$dcprodinsert[$i]['dct_itemgroup'] = $hdn_grid_row_data[$key]['productgroup'];
												$dcprodinsert[$i]['dct_businesscategory'] =$businesscat[$i];
												$dcprodinsert[$i]['dct_executive_name'] =$exename;
												$dcprodinsert[$i]['dct_executive_code'] =$user1;
												$dcprodinsert[$i]['dct_industry_segment'] ="";
												$dcprodinsert[$i]['dct_customer_potential'] = $hdn_grid_row_data[$key][$poten_cat[$i]];
												$dcprodinsert[$i]['dct_current_yr_sale_qty'] =0;
												$dcprodinsert[$i]['dct_leadprod_refid'] =$hdn_grid_row_data[$key]['from_lead'];
												$dcprodinsert[$i]['dct_sales'] = $hdn_grid_row_data[$key]['dct_sales'];
												$dcprodinsert[$i]['dct_marketinformation'] = $hdn_grid_row_data[$key]['dct_marketinformation'];
												$dcprodinsert[$i]['dct_actionplanned'] = $hdn_grid_row_data[$key]['dct_actionplanned'];
												$dcprodinsert[$i]['dct_updated_date'] =date('Y-m-d:H:i:s');
												$dcprodinsert[$i]['dct_updated_userid'] = $login_user_id;
												$dcprodinsert[$i]['dct_updated_username'] = $creationuser;
											//	$daily_logdtl[$key]['dtllog_createddate'] = date('Y-m-d:H:i:s');
											//	$daily_logdtl[$key]['dtllog_createduser'] = $login_user_id;
											}
											 echo"<pre> in loop dcprodinsert data "; print_r($dcprodinsert);
										$prdetidins = $this->dailycall_model->save_daily_details($dcprodinsert);	
// generate new lead start
										$lead_no = 'LEAD-DCV';
										$industry_id=62;
										$leadsrc=13;
										$producttypeid = array("0"=>"173794", "1"=>"3","2"=>"1","3"=>"173795","4"=>"681045","5"=>"681046");
							   			 for($k=0;$k<=5;$k++) 
							    			 {
											$leaddetails = array('lead_no' => $lead_no,
															'leadstatus' =>1,
															'company' =>$customer_id,
															'customer_id' => $customer_id,
															'industry_id' => $industry_id,
															'leadsource' => $leadsrc,
															'ldsubstatus' => 1,
															'assignleadchk' => $login_user_id,
															'user_branch' => $branch,
															'description' => "This lead was created from daily call",
															'comments' => "This product was added from daily call",
															'producttype' => "This product was added from daily call",
															'createddate' => date('Y-m-d:H:i:s'),
															'last_modified' => date('Y-m-d:H:i:s'),
															'created_user' => $login_user_id
															);
							

										$insert_lead_id= $this->Leads_model->save_lead($leaddetails);

										$addressdetails = $this->dailycall_model->GetCustAddressDetails($customer_id);
										//$addressdetails = $this->dailycall_model->GetAddressDetails(11498,$addrestype);
										$country_code = $this->dailycall_model->GetCountryCode($addressdetails['country']);
										$state_code = $this->dailycall_model->GetStateCode($addressdetails['state']);
										

										//print_r($addressdetails); die;
		             						$leadaddress = array('leadaddressid' => $insert_lead_id,
										'city' => $addressdetails['city'],
										'street' => $addressdetails['street'],
										'state' => $state_code,
										'pobox' => $addressdetails['pobox'],
										'country' => $country_code,
										'mobile_no' =>$addressdetails['mobile_no'],
										'phone' =>$addressdetails['phone'],
										'fax' => $addressdetails['fax'],  
										'created_date' => date('Y-m-d:H:i:s'),
										'created_user' => $login_user_id
			            			 
										);
										$addid = $this->Leads_model->save_lead_address($leadaddress);


										$prodinsertdata= array('leadid' => $insert_lead_id,
										/*'productid' =>"TEMP116",*/
										'productid' => $hdn_grid_row_data[$key]['dct_prodid'],
										'quantity' => 0,
										'potential' => $hdn_grid_row_data[$key][$businesscatprod[$k]],
										'annualpotential' => ($hdn_grid_row_data[$key][$businesscatprod[$k]] * 12),
										'prod_type_id' => $poten_catprod[$businesscatprod[$k]],
										'actionpoints' => $hdn_grid_row_data[$key]['actionpoints'],
										'due_date' => $hdn_grid_row_data[$key]['due_date'],
										'discussion_points' => $hdn_grid_row_data[$key]['discussion_points'],
										'market_information' => $hdn_grid_row_data[$key]['market_information'],
										'created_date' => date('Y-m-d:H:i:s'),
										'created_user' => $login_user_id
										);	
										echo"prodinsertdata <pre>";print_r($prodinsertdata);echo"</pre>"; 
										$prdetid = $this->dailycall_model->save_onedclead_products($prodinsertdata);

										for($ld_pot=0;$ld_pot<=5;$ld_pot++)
										{ // Insert 5 more rows into lead_prod_potential_types start
											$slead_prod_poten_type[$ld_pot]['leadid']=$insert_lead_id;
											$slead_prod_poten_type[$ld_pot]['productid']=$hdn_grid_row_data[$key]['dct_prodid'];

											$slead_prod_poten_type[$ld_pot]['product_type_id']=$poten_catprod[$businesscatprod[$ld_pot]];
											if($poten_catprod[$businesscatprod[$ld_pot]]==$poten_catprod[$businesscatprod[$ld_pot]])
											{
											$slead_prod_poten_type[$ld_pot]['potential']=$hdn_grid_row_data[$key][$businesscatprod[$ld_pot]];	
											}
											else
											{
											$slead_prod_poten_type[$ld_pot]['potential']=0;
											}

										} // Insert 5 more rows into lead_prod_potential_types End
										$ld_pot=0;
		  								$lead_pord_poten_id =$this->Leads_model->save_leadprodpotentypes($slead_prod_poten_type);	
		  							} // end of for K loop
							     $k=0;	
							echo"prodinsertdata <pre>";print_r($prodinsertdata);echo"</pre>"; 
					      	echo"slead_prod_poten_type<pre>";print_r($slead_prod_poten_type);echo"</pre>"; 

// generate new lead end

										}
										else
										{
											for ($j=0;$j<=5;$j++)
											 {
												$update_dailycall=1;
												$dcprodupdate[$j]['dct_header_id'] =$daily_hdr_id;
												$dcprodupdate[$j]['dct_new_prod'] =$hdn_grid_row_data[$key]['dct_new_prod'];
												$dcprodupdate[$j]['dct_customergroup'] =$hdncustomergroup; 
												$dcprodupdate[$j]['dct_itemgroup'] = $hdn_grid_row_data[$key]['productgroup'];
												$dcprodupdate[$j]['dct_businesscategory'] =$businesscat[$j];
												$dcprodupdate[$j]['dct_executive_name'] =$exename;
												$dcprodupdate[$j]['dct_executive_code'] =$execode;
												$dcprodupdate[$j]['dct_industry_segment'] ="";
												$dcprodupdate[$j]['dct_customer_potential'] = $hdn_grid_row_data[$key][$poten_cat[$j]];
												$dcprodupdate[$j]['dct_current_yr_sale_qty'] =0;
												$dcprodupdate[$j]['dct_leadprod_refid'] =$hdn_grid_row_data[$key]['from_lead'];
												$dcprodupdate[$j]['dct_sales'] = $hdn_grid_row_data[$key]['dct_sales'];
												$dcprodupdate[$j]['dct_marketinformation'] = $hdn_grid_row_data[$key]['dct_marketinformation'];
												$dcprodupdate[$j]['dct_actionplanned'] = $hdn_grid_row_data[$key]['dct_actionplanned'];
												$dcprodupdate[$j]['dct_actionpoints'] = $hdn_grid_row_data[$key]['actionpoints'];
												$dcprodupdate[$j]['dct_due_date'] = $hdn_grid_row_data[$key]['due_date'];
												$dcprodupdate[$j]['dct_discussion_points'] = $hdn_grid_row_data[$key]['discussion_points'];
												
												

												$dcprodupdate[$j]['dct_updated_date'] =date('Y-m-d:H:i:s');
												$dcprodupdate[$j]['dct_updated_userid'] = $login_user_id;
												$dcprodupdate[$j]['dct_updated_username'] = $creationuser;
												
											 }
											  echo"<pre> in loop dcprodupdate data "; print_r($dcprodupdate);
										$prdetid = $this->dailycall_model->update_daily_details($dcprodupdate);
										}
															
									}
									$dcnewprodupdate['dct_new_prod']=0;
 									$prdetid = $this->dailycall_model->update_daily_newprod_details($dcnewprodupdate,$daily_hdr_id);
							



							
								 }	// end of foreach hdn_grid_row_data
								 /*hdr log table start*/
									$daily_hdrlog_id= $this->dailycall_model->GetMaxValdloghrd('dailycall_log_hdr');
									$daily_hdrlog_id=$daily_hdrlog_id+1;
									$hdr_comments="updated for log header ";
									$leadstatus =7;
									$leadsubstatus = 29;

									$daily_hdrlog = array('hdrlog_id' => $daily_hdrlog_id,
									'hdr_status_id' => $leadstatus,
									'hdr_customer_id' => $customer_id,
									'hdr_leadid' => $leadid,
									'hdr_personmet' => $daily_hdr_id,
									'hdr_customer_name' => $seleced_customer_name,
									'hdr_customer_group' => $hdncustomergroup,
									'hdr_visitdate' => $hrd_currentdate,
									'hdr_time_hrs' => $timeinhrs,
									'hdr_time_mis' => $timeinmins,
									'hdr_to_time_hrs' => $to_timeinhrs,
									'hdr_to_time_mis' => $to_timeinmins,
									'hdr_visittype_id' => $typeofvisit,
									'hdr_visittype_name' => $visitnames,
									'hdr_modeofcontact_id' => $modofcont_id,
									'hdr_modeofcontact_name'=>$moc_name,
									'hdr_status_name' => $lead_status_name,
									'hdr_substs_id' => $leadsubstatus,
									'hdr_substs_name' => $lead_substatus_name,
									'hdr_comments' => $hdr_comments,
									'hdr_updateddate' => $lastupdatedate,
									'hdr_updateduser'=>$login_user_id,
									'hdr_transtype' => "Update",
									'hdr_updateduser_name' => $login_username
									);
									//	print_r($daily_hdrlog); die;

									$daily_hdrlog_insert_status =$this->dailycall_model->save_dailyactivityloghdr($daily_hdrlog);
/*hdr log table end*/


/* Saving /update  Products end*/
								
/* Saving log details for prod start*/
								$n=0;
								foreach($hdn_grid_row_data as $key=>$val)
								{
								$m=0;
								$poten_catlog = array("0"=>"bulk", "1"=>"intact","2"=>"repack","3"=>"part_tanker","4"=>"single_tanker","5"=>"small_packing");
								$dc_logdtl_id= $this->dailycall_model->GetNextLogDtlSeqVal('dailycall_log_dtl');
								
									for($ld_pot=0;$ld_pot<=5;$ld_pot++)
									{ // Insert 5 more rows into lead_prod_potential_types start

								//	echo"new lead with potential value ".$hdn_grid_row_data[$key][$poten_cat[$ld_pot]]."<br>";
							        //	echo"new lead with sale type  name  ".$poten_cat[$ld_pot]."<br>";
							        	$daily_logdtl[$ld_pot]['dtllog_hdr_id'] = $daily_hdrlog_id;
									$daily_logdtl[$ld_pot]['dtllog_prodid'] = $hdn_grid_row_data[$key]['dct_detail_id'];
									$daily_logdtl[$ld_pot]['dtllog_prodgroup'] =  $hdn_grid_row_data[$key]['productgroup']; 
									$daily_logdtl[$ld_pot]['dtllog_salestype_name'] = $poten_cat[$ld_pot];
									 $daily_logdtl[$ld_pot]['dtllog_poten']=$hdn_grid_row_data[$key][$poten_cat[$ld_pot]];
									 $daily_logdtl[$ld_pot]['dtllog_market_info'] = $hdn_grid_row_data[$key]['dct_marketinformation'];
									$daily_logdtl[$ld_pot]['dtllog_updateddate'] = date('Y-m-d:H:i:s');
									$daily_logdtl[$ld_pot]['dtllog_updateduser'] = $login_user_id;

							   
								       

									} // Insert 5 more rows into lead_prod_potential_types End
								$ld_pot=0;
								}
		//echo"<pre> daily_logdtl";print_r($daily_logdtl);	echo"</pre>";							
								$daily_logdlt_id =$this->dailycall_model->save_dclogdtl_products($daily_logdtl);
/* Saving log details for prod end*/						




							}	// END of $_POST['visitdate']

 				$message = "Added record for visitdate ".$hrd_currentdate." by ".$exename." for  the customer ".$hdncustomername;		
 	  			 $this->session->set_flashdata('message', $message);
				//redirect('dailycall/viewdiallycalldetailsbydate/'.$customer_id);
 	  			 if($addProdflag==1)
 	  			 {
 	  			//	 redirect('leads/adddcproduct/'.$customer_id);
 	  			 	 
 	  			 }
 	  			 else
 	  			 {
	 	  			 //redirect('dailycall/customerdetails/'.$customer_id.'/'.$leadid);	 	  			 
	 	  		//	 redirect('dailycall/customerdetails/'.$hdncustomergroup.'/'.$leadid);
				}			  



		}

		
		 function update_lead_dailycall()
		 {
		//	echo"POST<pre>";print_r($_POST);echo"</pre>"; 
			$hdn_grid_row_data = json_decode($_POST['hdn_grid_row_data'],TRUE);
			$hdn_grid_row_data_pm = json_decode($_POST['hdn_grid_row_data_pm'],TRUE);
		//	echo"hdn_grid_row_data<pre>";print_r($hdn_grid_row_data);echo"</pre>"; 
		//	echo"hdn_grid_row_data_pm<pre>";print_r($hdn_grid_row_data_pm);echo"</pre>"; 
			
		 	
		 	@$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];
		
		 if (!$this->admin_auth->logged_in())
			{
				//redirect them to the login page
				redirect('admin/login', 'refresh');
			}
			elseif (!$this->admin_auth->is_admin())
			{
				$user = $this->admin_auth->user()->row();
				$allgroups =  $this->admin_auth->groups()->result();
				$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
							
				$activitydata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
				$data = array();
				$i=0;
				$datagroup = array();					
				foreach($activitydata['permission'] as $key=>$val)
				{
					$row = array();

					$row["groupid"] = $key;
					$row["groupname"] = $val;
					$datagroup[$i] = $row;
					$i++;
				}

				$arr = json_encode($datagroup);
				$activitydata['grpperm'] =$arr;
			  }

/*copy of function start*/
					$leadid = $_POST['hdn_leadid'];
					$hrd_currentdate = $_POST['visitdate'];
					$typeofvisit = $_POST['typeofvisit'];
					$timeinhrs = $_POST['timeinhrs'];
					$timeinmins = $_POST['timeinmins'];
					$to_timeinhrs = $_POST['to_timeinhrs'];
					$to_timeinmins = $_POST['to_timeinmins'];
					$modofcont_id = $_POST['modeofcontact'];
					$moc_name=$_POST['hdn_mocname'];
					
					$visitdetails = $this->dailycall_model->get_visittypenames($typeofvisit);
					
				//	print_r($visitdetails);
					$visitnames= implode(",", $visitdetails);
					//echo"visitnames ".$visitnames;
					
					$hrd_currentdate =implode("-", array_reverse(explode("-", $hrd_currentdate)));
					$hdncustomergroup = $_POST['hdncustomergroup'];
					

			
				$customer_id = $_POST['hdn_customerid'];
				$customerid =$_POST['hdn_customerid'];
				$leadid = $_POST['hdn_leadid'];
				$hdr_comments=$_POST['hdn_cmnts'];
			
				$update_prod=0;
				$insert_prod=0;
				$ld_pot=0;
				$hdn_grid_row_data = json_decode($_POST['hdn_grid_row_data'],TRUE);
			//	echo"decode data";print_r($hdn_grid_row_data); 

					//print_r( $this->session->userdata); die;
					$login_user_id = $this->session->userdata['user_id'];

					$login_username = $this->session->userdata['username'];
					$createddate = date('Y-m-d:H:i:s');
					$lastupdatedate = date('Y-m-d:H:i:s');
					$creationuser =$this->session->userdata['identity'];
					$lastupdateuser =$this->session->userdata['identity'];
					$execode = $this->session->userdata['empcode'];
					$exename = $this->session->userdata['identity'];
					$user1 = $this->session->userdata['loginname'];
					//$user1 = $this->session->userdata['username'];
				

				
					$hdncustomername = $_POST['hdncustomername'];
					$customer_id = $_POST['hdn_customerid'];
					$leadid = $_POST['hdn_leadid'];

					$sub_log_comments = "updated substatus from dailycall";
					 $update_log=1;
				/*	if($leadid!=0)
	   					{
	   						$leadstatus = $_POST['leadstatus'];
	   						$leadsubstatus = $_POST['leadsubstatus'];
							$hdn_status_id = $_POST['hdn_status_id'];
	   						$log_comments = "updated from dailycall";
	   						$sub_log_comments = "updated substatus from dailycall";
	   						$lead_status_name= $this->Leads_model->GetLeadStatusName($leadstatus);
	   						$lead_substatus_name= $this->Leads_model->GetLeadSubStatusName($leadsubstatus);
						}
				 		if (($_POST['leadstatus']!=$_POST['hdn_status_id']) ||( $_POST['leadsubstatus']!=$_POST['hdn_sub_status_id'] ))
						{
							 $update_log=1;
						}
						else
						{
							$update_log=0;
						}
						if (($_POST['leadstatus']!=$_POST['hdn_status_id']) || ($_POST['leadsubstatus']!=$_POST['hdn_sub_status_id']))
						{	
							$lead_status_update='Y';
						}
						else{	
							$lead_status_update='N';
						}
						$crm_first_soc_no = $_POST['txtLeadsoc'];
						if ($crm_first_soc_no=="")
						{
							$crm_first_soc_no=0;
							$ld_converted = 0;
						}
						else
						{	
							$crm_first_soc_no=$_POST['txtLeadsoc'];
							$ld_converted =1;
						}


						 $leaddetails = array(
							'leadstatus' => $_POST['leadstatus'],
							'company' => $_POST['hdn_customerid'],
							'customer_id' => $customer_id,
							'ldsubstatus' => $_POST['leadsubstatus'],
							'lead_crm_soc_no' =>$crm_first_soc_no, 
							'converted' =>$ld_converted, 
							'last_modified' => date('Y-m-d:H:i:s'),
							'last_updated_user' => $login_user_id
							);

					/*$leadaddress = array(
							'leadaddressid' => $leadid,
							'city' => $_POST['city'],
							'state' => $_POST['state'],
							'street' => $_POST['customeraddress'],
							'pobox' => $_POST['postalcode'],
							'phone' => $_POST['phone'],
							'country' => $_POST['country'],
							'mobile_no' => $_POST['mobile_no'],
							'fax' => $_POST['fax'],
							'last_modified' => date('Y-m-d:H:i:s')
							);*/

	//                       $id =$this->Leads_model->update_lead($leaddetails,$leadid);
	                     //  $addid = $this->Leads_model->update_lead_address($leadaddress,$leadid);

	                     	  $lead_productids= array();
				//	echo"del count is ".count($_POST['deledct_val']);
					

					if(	(count(@$_POST['deledct_val'])>0 ) && (! in_array('undefined', @$_POST['deledct_val'],true) ) )
					{
						foreach ($_POST['deledct_val'] as $key => $value) 
						{
						//echo $sql ="delete from leadproducts where lpid =".$value;
						//$result
						$lead_productids[$key]=$value;
						}

						//echo"dct_delete_ids";print_r($dct_delete_ids);
						$delid = $this->dailycall_model->delete_leadproduct_details($lead_productids);	

					}
						if($_POST['visitdate']!=='')
						{

							$daily_hdr_id= $this->dailycall_model->GetMaxValdc('dailycall_hdr');
							$daily_hdr_id=$daily_hdr_id+1;


								$daily_hdr = array('dch_header_id' => $daily_hdr_id,
										'dch_customerid' => $customer_id,
										'dch_leadid' => $leadid,
										'dch_custname' => $hdncustomername,
										'dch_visittypeid' => $typeofvisit,
										'dch_visittypename' => $visitnames,
										'dch_visitdate' => $hrd_currentdate,
										'dch_time_hrs' => $timeinhrs,
										'dch_time_mis' => $timeinmins,
										'dch_modofcont_id' => $modofcont_id,
										'dch_modofcontname'=>$moc_name,
/*										'dch_collection'=>$collection,
										'dch_statuory'=>$statuory,
										'dch_quotation_email' => $quotation_email,*/
										'dch_created_userid' => $login_user_id,
										'dch_created_usename' => $creationuser,
										'dch_created_date' => $createddate
										

							);
						}		
//print_r($daily_hdr); die;
							$daily_hdr_insert_status =$this->dailycall_model->save_dailyactivityhdr($daily_hdr);
							foreach($hdn_grid_row_data_pm as $key=>$val)
							{
//								echo"key ".$key."<br>";
//								echo"val";echo"<pre>";print_r($val);echo"</pre>";
//								echo"check".$val['contactperson'];
								if($val['soc_mail']=='undefined' || $val['soc_mail']==''){ $val['soc_mail']='false';}
								if($val['payment_mail']=='undefined' || $val['payment_mail']==''){ $val['payment_mail']='false';}
								if($val['general_mail']=='undefined' || $val['general_mail']==''){ $val['general_mail']='false';}
								if($val['quotation_mail']=='undefined' || $val['quotation_mail']==''){ $val['quotation_mail']='false';}
								if($val['dispatch_mail']=='undefined' || $val['dispatch_mail']==''){ $val['dispatch_mail']='false';}
								if($val['personmet']=='undefined' || $val['personmet']=='' ){ $val['personmet']='false';}
								if($val['leadid']=='undefined'){ $val['leadid']=0;}
								if($val['cust_id']=='undefined'){ $val['cust_id']=$customer_id;}


								$daily_preson[$key]['dc_header_id'] =$daily_hdr_id;
								$daily_preson[$key]['dc_leadid'] = $val['leadid'];
								$daily_preson[$key]['dc_cust_id'] = $val['cust_id'];
								$daily_preson[$key]['dc_personmet_name'] = $val['contactperson'];
								$daily_preson[$key]['dc_designation'] = $val['designation'];
								$daily_preson[$key]['deptname'] = $val['deptname'];
								$daily_preson[$key]['dc_email_id'] = $val['contact_mailid'];
								$daily_preson[$key]['dc_phone_no'] = $val['contact_no'];
								$daily_preson[$key]['dc_mobile_no'] = $val['mobile_no'];
								$daily_preson[$key]['soc_mail'] = $val['soc_mail'];
								$daily_preson[$key]['payment_mail'] = $val['payment_mail'];
								$daily_preson[$key]['general_mail'] = $val['general_mail'];
								$daily_preson[$key]['quotation_mail'] = $val['quotation_mail'];
								$daily_preson[$key]['dispatch_mail'] = $val['dispatch_mail'];
								$daily_preson[$key]['personmet'] = $val['personmet'];

								$dct_custid[$key]=$val['cust_id'];

							}
				//echo"<pre>dct_custid";print_r($dct_custid);echo"</pre>"; 
				//echo"<pre> daily_preson";print_r($daily_preson);echo"</pre>";  die;	
					 $delid = $this->dailycall_model->delete_dcpersonmet_details($dct_custid);	
					  $daily_callpersonmet_id =$this->dailycall_model->save_dcpersonmet_details($daily_preson);
/* start visitdetail*/




										$dailyvisit_detail = array(
										'dcv_header_id' => $daily_hdr_id,
										'dcv_visit_id' => $typeofvisit,
										'dcv_custgroupname' => $hdncustomergroup,
										'dcv_customerid' => $leadid,
										'dcv_customername' => $hdncustomername,
										'dcv_created_date' => $createddate,
										'dcv_created_userid' => $login_user_id,
										'dcv_created_usename' => $creationuser
									
							            );
						$daily_visitdtl_insert_status =$this->dailycall_model->save_dailyvisitdetail($dailyvisit_detail);

/*end visitdetail */



	                       $daily_hdrlog_id= $this->dailycall_model->GetMaxValdloghrd('dailycall_log_hdr');
					$daily_hdrlog_id=$daily_hdrlog_id+1;
					$hdr_comments="updated for log header ";
					$log_comments="log from daily call update";

					$daily_hdrlog = array('hdrlog_id' => $daily_hdrlog_id,
					'hdr_customer_id' => $customer_id,
					'hdr_leadid' => $leadid,
					'hdr_personmet' => $daily_hdr_id,
					'hdr_customer_name' => $hdncustomername,
					'hdr_visitdate' => $hrd_currentdate,
					'hdr_time_hrs' => $timeinhrs,
					'hdr_time_mis' => $timeinmins,
					'hdr_to_time_hrs' => $to_timeinhrs,
					'hdr_to_time_mis' => $to_timeinmins,
/*					'hdr_statuory' => $statuory,
					'hdr_collection' => $collection,*/
					'hdr_visittype_id' => $typeofvisit,
					'hdr_visittype_name' => $visitnames,
					'hdr_modeofcontact_id' => $modofcont_id,
					'hdr_modeofcontact_name'=>$moc_name,
	/*				'hdr_status_name' => $lead_status_name,
					'hdr_substs_id' => $hdn_sub_status_id,
					'hdr_substs_name' => $lead_substatus_name,
					'hdr_status_id' => $hdn_status_id,*/
					'hdr_comments' => $hdr_comments,
					'hdr_updateddate' => $lastupdatedate,
					'hdr_updateduser'=>$login_user_id,
					'hdr_transtype' => "Update",
					'hdr_updateduser_name' => $login_username
					);
					//	print_r($daily_hdrlog); die;

					$daily_hdrlog_insert_status =$this->dailycall_model->save_dailyactivityloghdr($daily_hdrlog);

					if($daily_hdrlog_insert_status)
					{
						$daily_hdrlog_id;
					}

					$proddata = array();
					$leaddatainsert = array();
					$proddatainsert = array();
					$dc_logdtl_id = array();
					$daily_logdtl = array();
					$addressdetails =array();
					$lead_prod_poten_type=array();
					$slead_prod_poten_type=array();
					$update_leaddetails=array();
					
					
					$k=0;
				//	echo"<pre>";print_r($hdn_grid_row_data);echo"</pre>";

					$customer_id = $this->Leads_model->GetTempCustId($customer_id); 
					$branch = $this->dailycall_model->GetUserBranch($login_user_id);
					
					foreach($hdn_grid_row_data as $key=>$val)
					{

						$businesscat=array("0"=>"bulk", "1"=>"small_packing","2"=>"part_tanker","3"=>"single_tanker","4"=>"intact","5"=>"repack");
						$poten_cat = array("bulk"=>"173794", "part_tanker"=>"3","repack"=>"1","intact"=>"173795","single_tanker"=>"681045","small_packing"=>"681046");

						$sale_type_name= array_search($hdn_grid_row_data[$key]['prod_type_id'],$poten_cat);

						///echo " sale_type_name array search  ".$sale_type_name."<br>";
						//echo"the potential found is ".$hdn_grid_row_data[$key][$sale_type_name]."<br>";
						/*echo "bussines cat ".$businesscat[$key]."<br>";
						echo "poten_cat  ".$poten_cat[$businesscat[$key]]."<br>";
*/
					//	echo"testing".$hdn_grid_row_data[$key]['dct_detail_id'];

						if($hdn_grid_row_data[$key]['dct_detail_id']=='undefined' || $hdn_grid_row_data[$key]['dct_detail_id']=="")
						{
							$insert_prod=1;
							$lead_no = 'LEAD-DCV';
							$industry_id=62;
							$leadsrc=13;
							$lead_status_update="N";
							
							$producttypeid = array("0"=>"173794", "1"=>"3","2"=>"1","3"=>"173795","4"=>"681045","5"=>"681046");
							     for($k=0;$k<=5;$k++) 
							     {

							     //   echo"in the for loop for to insert ".$hdn_grid_row_data[$key][$businesscat[$k]]."<br>";
							     //   echo"in the for loop for to strlen ".strlen($hdn_grid_row_data[$key][$businesscat[$k]])."<br>";
							       if(($hdn_grid_row_data[$key][$businesscat[$k]]=="undefined")|| (trim($hdn_grid_row_data[$key][$businesscat[$k]])=="") )
							    //    if($hdn_grid_row_data[$key][$businesscat[$k]]>=0)
							        { 
							       //    echo"No new lead <br>";
							        } 
							        else// Generate New leads start
							        {
							        	/*echo"new lead with potential value ".$hdn_grid_row_data[$key][$businesscat[$k]]."<br>";
							        	echo"new lead with sale type  name  ".$businesscat[$k]."<br>";
							        	echo"new lead with sale type  id  ".$poten_cat[$businesscat[$k]]."<br>";*/
							        
							        $leaddetails = array('lead_no' => $lead_no,
								'leadstatus' =>1,
								'company' =>$customerid,
								'customer_id' => $customerid,
								'industry_id' => $industry_id,
								'leadsource' => $leadsrc,
								'ldsubstatus' => 1,
								'assignleadchk' => $login_user_id,
								'user_branch' => $branch,
								'description' => "This lead was created from daily call",
								'comments' => "This product was added from daily call",
								'producttype' => "This product was added from daily call",
								'createddate' => date('Y-m-d:H:i:s'),
								'last_modified' => date('Y-m-d:H:i:s'),
								'created_user' => $login_user_id
								);
							

								$insert_lead_id= $this->Leads_model->save_lead($leaddetails);
							
								$addressdetails = $this->dailycall_model->GetLdAddressDetails($customerid);
								//$addressdetails = $this->dailycall_model->GetAddressDetails(11498,$addrestype);
								//print_r($addressdetails); die;
             						$leadaddress = array('leadaddressid' => $insert_lead_id,
								'city' => $addressdetails['city'],
								'street' => $addressdetails['street'],
								'state' => $addressdetails['state'],
								'pobox' => $addressdetails['pobox'],
								'country' => $addressdetails['country'],
								'mobile_no' =>$addressdetails['mobile_no'],
								'phone' =>$addressdetails['phone'],
								'fax' => $addressdetails['fax'],  
								'created_date' => date('Y-m-d:H:i:s'),
								'created_user' => $login_user_id
	            			 
								);
								$addid = $this->Leads_model->save_lead_address($leadaddress);

						

								$prodinsertdata= array('leadid' => $insert_lead_id,
								'productid' => $hdn_grid_row_data[$key]['dct_prodid'],
								'quantity' => $hdn_grid_row_data[$key]['dct_quantity'],
								'potential' => $hdn_grid_row_data[$key][$businesscat[$k]],
								'annualpotential' => ($hdn_grid_row_data[$key][$businesscat[$k]] * 12),
								'prod_type_id' => $poten_cat[$businesscat[$k]],
								'actionpoints' => $hdn_grid_row_data[$key]['actionpoints'],
								'due_date' => $hdn_grid_row_data[$key]['due_date'],
								'discussion_points' => $hdn_grid_row_data[$key]['discussion_points'],
								'market_information' => $hdn_grid_row_data[$key]['market_information'],
								'created_date' => date('Y-m-d:H:i:s'),
								'created_user' => $login_user_id
								);	


								$prdetid = $this->dailycall_model->save_onedclead_products($prodinsertdata);
								for($ld_pot=0;$ld_pot<=5;$ld_pot++)
								{ // Insert 5 more rows into lead_prod_potential_types start
									  $slead_prod_poten_type[$ld_pot]['leadid']=$insert_lead_id;
								        $slead_prod_poten_type[$ld_pot]['productid']=$hdn_grid_row_data[$key]['dct_prodid'];

								        $slead_prod_poten_type[$ld_pot]['product_type_id']=$poten_cat[$businesscat[$ld_pot]];
									        if($poten_cat[$businesscat[$ld_pot]]==$poten_cat[$businesscat[$k]])
									        {
									        	 $slead_prod_poten_type[$ld_pot]['potential']=$hdn_grid_row_data[$key][$businesscat[$k]];	
									        }
									        else
									        {
									        	$slead_prod_poten_type[$ld_pot]['potential']=0;
									        }
								       

								} // Insert 5 more rows into lead_prod_potential_types End
								$ld_pot=0;
  								$lead_pord_poten_id =$this->Leads_model->save_leadprodpotentypes($slead_prod_poten_type);		

							        }// Generate New leads start


							     }
							     $k=0;	
						//	echo"prodinsertdata <pre>";print_r($prodinsertdata);echo"</pre>"; 
					       //	echo"slead_prod_poten_type<pre>";print_r($slead_prod_poten_type);echo"</pre>"; 
										
							 
														
						
					       
						//	echo"proddata update<pre>";print_r($proddata);echo"</pre>"; 
					       	
						
						}
						else
						{	//echo"=============update lead data===========<br>";


							      $lead_status_update="Y";
							   	$update_leaddetails[$key]['leadid'] = $hdn_grid_row_data[$key]['leadid'];
								$update_leaddetails[$key]['leadstatus'] = $hdn_grid_row_data[$key]['status_id'];
								$update_leaddetails[$key]['ldsubstatus'] =$hdn_grid_row_data[$key]['substatus_id']; 
								$update_leaddetails[$key]['comments'] = "This product was updated from daily call";
								$update_leaddetails[$key]['producttype'] =   "This product was added from daily call";
								$update_leaddetails[$key]['last_modified'] =  date('Y-m-d:H:i:s');
								$update_leaddetails[$key]['last_updated_user'] =  $login_user_id;

							$i=0;
							for ($i=0;$i<=5;$i++)
							{
								/*echo"i val inside loop  ".$i."<br>";
								echo"key val ".$key."<br>";
								echo"lpid ".$hdn_grid_row_data[$key]['dct_detail_id']."<br>";
								echo"pot cat id is ".$poten_cat[$businesscat[$i]]."<br>";
								echo"potential is ".$hdn_grid_row_data[$key][$businesscat[$i]]."<br>";
								echo"========================<br>";*/
								if ($hdn_grid_row_data[$key]['dct_quantity']=="null")
									{ $hdn_grid_row_data[$key]['dct_quantity']=0; }

								$update_prod=1;
								$leadid=$hdn_grid_row_data[$key]['leadid'];
								$proddata[$i]['leadid'] = $hdn_grid_row_data[$key]['leadid'];
								$proddata[$i]['lpid'] = $hdn_grid_row_data[$key]['dct_detail_id'];
								$proddata[$i]['productid'] =$hdn_grid_row_data[$key]['dct_prodid']; 
								$proddata[$i]['quantity'] = $hdn_grid_row_data[$key]['dct_quantity'];
								$proddata[$i]['potential'] =  $hdn_grid_row_data[$key][$businesscat[$i]];
								$proddata[$i]['prod_type_id'] =  $poten_cat[$businesscat[$i]];
								$proddata[$i]['annualpotential'] = (( $hdn_grid_row_data[$key][$sale_type_name]) * 12);
								$proddata[$i]['dct_sales'] =  $hdn_grid_row_data[$key]['dct_sales'];
								$proddata[$i]['dct_actionplanned'] =  $hdn_grid_row_data[$key]['dct_actionplanned'];
								$proddata[$i]['dct_collection'] =  $hdn_grid_row_data[$key]['dct_collection'];
								$proddata[$i]['dct_statuory'] =  $hdn_grid_row_data[$key]['dct_statuory'];
							//	$proddata[$i]['dct_marketinformation'] =  $hdn_grid_row_data[$key]['dct_marketinformation'];
								$proddata[$i]['actionpoints'] =  $hdn_grid_row_data[$key]['actionpoints'];
								$proddata[$i]['due_date'] =  $hdn_grid_row_data[$key]['due_date'];
								$proddata[$i]['discussion_points'] =  $hdn_grid_row_data[$key]['discussion_points'];
								$proddata[$i]['market_information'] =  $hdn_grid_row_data[$key]['market_information'];
								$proddata[$i]['last_modified'] = date('Y-m-d:H:i:s');
								$proddata[$i]['last_updated_user'] = $login_user_id;

								$lead_prod_poten_type[$i]['leadid']=$leadid;
								$lead_prod_poten_type[$i]['productid']=$hdn_grid_row_data[$key]['dct_prodid'];
								$lead_prod_poten_type[$i]['product_type_id']=$poten_cat[$businesscat[$i]];
								$lead_prod_poten_type[$i]['potential']=$hdn_grid_row_data[$key][$businesscat[$i]];

								
							}
							//echo"leaddetails update<pre>";print_r($update_leaddetails);echo"</pre>"; 
							$prdetid = $this->dailycall_model->update_leaddetails_status($update_leaddetails,$leadid);
							$prdetid = $this->dailycall_model->update_leadproducts($proddata,$leadid);
							
							
							$lead_pord_poten_id =$this->Leads_model->update_leadprodpotentypes($lead_prod_poten_type,$leadid);

					/*	$update_leaddetails[$key]['leadid'] = $hdn_grid_row_data[$key]['leadid'];
						$update_leaddetails[$key]['leadstatus'] = $hdn_grid_row_data[$key]['status_id'];
						$update_leaddetails[$key]['ldsubstatus'] =$hdn_grid_row_data[$key]['substatus_id']; */
							$lead_status_name= $this->Leads_model->GetLeadStatusName($hdn_grid_row_data[$key]['status_id']);
	   						$lead_substatus_name= $this->Leads_model->GetLeadSubStatusName($hdn_grid_row_data[$key]['substatus_id']);

						  $lead_log_details = array('lh_lead_id' => $hdn_grid_row_data[$key]['leadid'],
											'lh_user_id' => $login_user_id,
											'lh_lead_curr_status' => $lead_status_name,
											'lh_lead_curr_statusid' => $hdn_grid_row_data[$key]['status_id'],
											'lh_updated_date' => date('Y-m-d:H:i:s'),
											'lh_last_updated_user' => $login_user_id,
											'lh_comments' => $log_comments,
											'action_type'=> 'Update',
											'modified_user_name'=> $login_username,
											'status_update'=> $lead_status_update
										);
						//  echo"lead_log_details <pre>";print_r($lead_log_details); echo"</pre>";
						  @$logid = $this->Leads_model->create_leadlog($lead_log_details);


						   $lead_sublog_details = array(
										'lhsub_lh_id' => @$logid,
										'lhsub_lh_lead_id' => $hdn_grid_row_data[$key]['leadid'],
										'lhsub_lh_user_id' => $login_user_id,
										'lhsub_lh_lead_curr_status' => $lead_status_name,
										'lhsub_lh_lead_curr_sub_status' => $lead_substatus_name,
										'lhsub_lh_lead_curr_statusid' => $hdn_grid_row_data[$key]['status_id'],
										'lhsub_lh_updated_date' => date('Y-m-d:H:i:s'),
										'lhsub_lh_last_updated_user' => $login_user_id,
										'lhsub_lh_comments' => $sub_log_comments,
										'lhsub_action_type'=> 'Update',
										'lhsub_modified_user_name'=> $login_username,
										'lhsub_status_update'=> $lead_status_update
									);

						   $sublogid = $this->Leads_model->create_lead_sublog($lead_sublog_details);
						     $update_date = $this->Leads_model->update_prev_moddate(@$logid); 
						}

						$dc_logdtl_id= $this->dailycall_model->GetNextLogDtlSeqVal('dailycall_log_dtl');
					//	$daily_logdtl[$key]['dtllog_id'] = $dc_logdtl_id;
						$daily_logdtl[$key]['dtllog_hdr_id'] = $daily_hdrlog_id;
						$daily_logdtl[$key]['dtllog_prodid'] = $hdn_grid_row_data[$key]['dct_prodid'];
						$daily_logdtl[$key]['dtllog_prodname'] =  $hdn_grid_row_data[$key]['productname']; 
						$daily_logdtl[$key]['dtllog_poten'] = $hdn_grid_row_data[$key]['total_potential'];	
						$daily_logdtl[$key]['dtllog_qnty'] = $hdn_grid_row_data[$key]['dct_quantity'];
						$daily_logdtl[$key]['dtllog_salestype_id'] = $hdn_grid_row_data[$key]['prod_type_id'];
						$daily_logdtl[$key]['dtllog_salestype_name'] = $hdn_grid_row_data[$key]['dct_salestypename'];
						$daily_logdtl[$key]['dtllog_actionplanned'] = $hdn_grid_row_data[$key]['dct_actionplanned'];
						$daily_logdtl[$key]['dtllog_sales'] = $hdn_grid_row_data[$key]['dct_sales'];
						
						$daily_logdtl[$key]['dtllog_collection'] = $hdn_grid_row_data[$key]['dct_collection'];
						$daily_logdtl[$key]['dtllog_satutory'] = $hdn_grid_row_data[$key]['dct_statuory'];
						$daily_logdtl[$key]['dtllog_market_info'] = $hdn_grid_row_data[$key]['market_information'];

						$daily_logdtl[$key]['dtllog_updateddate'] = date('Y-m-d:H:i:s');
						$daily_logdtl[$key]['dtllog_updateduser'] = $login_user_id;
						
/*
	   					echo"insert_prod ".$insert_prod."<br>";
	   					echo"update_prod ".$update_prod."<br>";
	   					echo"update log table ".$daily_logdtl."<br>";*/
	   				

					}
					
					/*echo"leaddatainsert <pre>";print_r($leaddatainsert);echo"</pre>"; 
					echo"update log table <pre>";print_r($daily_logdtl);echo"</pre>";*/
				
					


					//$prdetid = $this->dailycall_model->update_leadproducts($proddata,$leadid);
					
					if ($insert_prod)
					{
						//$prdetidins = $this->dailycall_model->save_dc_ldproducts($leaddatainsert,$leadid);	
						//generate a new lead with the new product 
						/*$this->dailycall_model->create_newlead($leaddatainsert);
						$this->dailycall_model->create_newlead_address($address_datainsert);
						$this->dailycall_model->create_newlead_products($proddatainsert);*/
					}
					

					if ($daily_hdrlog_insert_status)
					{
						// print_r($daily_logdtl); die;
						// $daily_dlt_id =$this->dailycall_model->save_daily_details($daily_dtl);
						$daily_logdlt_id =$this->dailycall_model->save_dclogdtl_products($daily_logdtl);
						//
					}

					/*$update_leaddetails[$key]['leadid'] = $hdn_grid_row_data[$key]['leadid'];
					$update_leaddetails[$key]['leadstatus'] = $hdn_grid_row_data[$key]['status_id'];
					$update_leaddetails[$key]['ldsubstatus'] =$hdn_grid_row_data[$key]['substatus_id']; 

					  $lead_log_details = array('lh_lead_id' => $leadid,
										'lh_user_id' => $login_user_id,
										'lh_lead_curr_status' => $lead_status_name,
										'lh_lead_curr_statusid' => $_POST['leadstatus'],
										'lh_updated_date' => date('Y-m-d:H:i:s'),
										'lh_last_updated_user' => $login_user_id,
										'lh_comments' => $log_comments,
										'action_type'=> 'Update',
										'modified_user_name'=> $login_username,
										'status_update'=> $lead_status_update
									);*/
							if($update_log==1)
							{
						 	//  @$logid = $this->Leads_model->create_leadlog($lead_log_details);
							}


							$lead_sublog_details = array(
										'lhsub_lh_id' => @$logid,
										'lhsub_lh_lead_id' => $leadid,
										'lhsub_lh_user_id' => $login_user_id,
										'lhsub_lh_lead_curr_status' => $lead_status_name,
										'lhsub_lh_lead_curr_sub_status' => $lead_substatus_name,
										'lhsub_lh_lead_curr_statusid' => $_POST['leadstatus'],
										'lhsub_lh_updated_date' => date('Y-m-d:H:i:s'),
										'lhsub_lh_last_updated_user' => $login_user_id,
										'lhsub_lh_comments' => $sub_log_comments,
										'lhsub_action_type'=> 'Update',
										'lhsub_modified_user_name'=> $login_username,
										'lhsub_status_update'=> $lead_status_update
									);

							if($update_log==1)
							{
						   		//$sublogid = $this->Leads_model->create_lead_sublog($lead_sublog_details);
							}
               					 //   $update_date = $this->Leads_model->update_prev_moddate(@$logid); 


				 $message = "Added record for visitdate  by ".$exename." for  the customer ".$hdncustomername;		
 	  			 $this->session->set_flashdata('message', $message);
				//redirect('dailycall/viewdiallycalldetailsbydate/'.$customer_id);
 	  			 redirect('dailycall/ldcustomerdetails/'.$customerid.'/'.$leadid);
/*copy of function end*/
			  


		 }
		function updatedailycall_ld()
		{
				$leadid = $_POST['hdn_leadid'];
				$customer_id = $_POST['hdn_customerid'];
				$leadid = $_POST['hdn_leadid'];
				$hdr_comments=$_POST['hdn_cmnts'];
				$login_user_id = $this->session->userdata['user_id'];
				$login_username = $this->session->userdata['username'];
				$createddate = "";
				$lastupdatedate = date('Y-m-d:H:i:s');
				$creationuser ="";
				$lastupdateuser =$this->session->userdata['identity'];
				$execode = $this->session->userdata['empcode'];
				$exename = $this->session->userdata['identity'];
				$user1 = $this->session->userdata['loginname'];
				//$user1 = $this->session->userdata['username'];

				$hdncustomername = $_POST['hdncustomername'];
				$customer_id = $_POST['hdn_customerid'];
				$leadid = $_POST['hdn_leadid'];
			
				$leaddetails = array(
				'company' => $_POST['hdn_customerid'],
				'customer_id' => $customer_id,
				'description' => $_POST['description'],
				'website' => $_POST['website'],
				'last_modified' => date('Y-m-d:H:i:s'),
				'last_updated_user' => $login_user_id
				);

				$id =$this->Leads_model->update_lead($leaddetails,$leadid);
			//	$message = "Added record for visitdate  by".trim($exename)." for  the customer ".trim($hdncustomername);		
			  	$message = "Record updated sucessfully";		
				$this->session->set_flashdata('message', $message);
				redirect('dailycall/ldcustomerdetails/'.$customer_id.'/'.$leadid);
		}
		function dcupdateexcustomer($customergroup,$leadid=0)
		{
			$customergroup = str_replace("'", "", $customergroup);
			$customergroup = str_replace("'", "", $customergroup);
			//echo $leadid; 
			if (isset($_SERVER['HTTP_REFERER']))
			{
				 $reffer=@$_SERVER['HTTP_REFERER'];
		       }
		      // $reffer="http://10.1.2.40/salescrm/leads/adddcproduct/13275";

				@$path = explode('/', @$_SERVER['HTTP_REFERER']); 
				//print_r($path); die;
				@$leadpath=@$path[4];
		       		 
			$leadid = $this->uri->segment(4);
			@$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];
			@$run_time_dc_lead_id = $this->session->userdata['run_time_dc_lead_id'];
					
			
			 if (!$this->admin_auth->logged_in())
				{
					//redirect them to the login page
					redirect('admin/login', 'refresh');
				}
				elseif (!$this->admin_auth->is_admin())
				{
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$activitydata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					$data = array();
					$i=0;
					$datagroup = array();					
					foreach($activitydata['permission'] as $key=>$val)
					{
						$row = array();

						$row["groupid"] = $key;
						$row["groupname"] = $val;
						$datagroup[$i] = $row;
						$i++;
					}

					$arr = json_encode($datagroup);
					$activitydata['grpperm'] =$arr;
				
					$user_name= $this->session->userdata['identity'];

					
					$activitydata['leadpath'] =$leadpath;
					$customer_group = urldecode($customergroup);
					$activitydata['customerid'] = $this->dailycall_model->get_customerid($customer_group);


				//	$customer_group = $this->dailycall_model->get_customergroup($customer_id);

					//$activitydata['customername'] =addslashes($this->dailycall_model->get_customername($customer_id));
					$activitydata['customername'] ="test";
					$activitydata['customergroup']=trim($customer_group);
/*					$activitydata['customergroup']=html_entity_decode($customer_group);
					$activitydata['customergroup']=str_replace("'", "", $customer_group);*/


					$activitydata['exe_name'] =$user_name;
					//$activitydata['customerinfo']= $this->dailycall_model->get_customerdetails($customer_id,$leadid);
					$activitydata['customerinfo']= $this->dailycall_model->get_customerdetailsgrp($customer_group,$leadid);
					
					$activitydata['customerinfo'][0]['about_the_customer']="welcome to the about the customer info";
					//$activitydata['customerinfo'][0]['credit_limit']=number_format($this->dailycall_model->get_custprod_busnessplandtl_info_update_limit($customer_group));
					$activitydata['customerinfo'][0]['credit_limit']=1090;
					
				//	$activitydata['data']= $this->dailycall_model->get_producttype_info($customer_id);
				//	$activitydata['data']= $this->dailycall_model->get_producttype_sum_from_businessplan($customer_id);
					$activitydata['data']= $this->dailycall_model->get_producttype_sum_from_businessplan_custgroup($customer_group);
					
				
					$activitydata['cust_prod_data']= $this->dailycall_model->get_custprod_busnessplandtl_info_update($customer_group);

				      $activitydata['cust_contact_row_count']= $this->dailycall_model->get_noof_rows_savedcust_contactinfo($customer_group,$activitydata['customerid']);
				          //echo" row count ".$activitydata['cust_contact_row_count']; die;
				          if($activitydata['cust_contact_row_count']>0)
				          {
				          $activitydata['cust_contact_data']= $this->dailycall_model->get_saved_cust_contact_info($customer_group,$activitydata['customerid']); 
				          }
				          else
				          {
				          $activitydata['cust_contact_data']= $this->dailycall_model->get_cust_contact_info($customer_group,$activitydata['customerid']); 
          				  }
          
					$activitydata['custprodhdr']= $this->dailycall_model->get_custprodhdrgrp($activitydata['customergroup']);

					/*print_r($activitydata['cust_prod_data']); 
					echo "count of ".count($activitydata['cust_prod_data']);
					die;*/
	
					if($leadid!=0)
					{
					$activitydata['leadid'] =$leadid;
					$industry_id = $activitydata['customerinfo'][0]['industry_id']; 
					$state_code = $activitydata['customerinfo'][0]['state'];
					$country = $activitydata['customerinfo'][0]['country'];
					$activitydata['customerinfo']['industry_name'] =$this->dailycall_model->get_industryname($industry_id);
					$activitydata['customerinfo']['country'] =$this->dailycall_model->get_countryname($country);
					$activitydata['customerinfo']['state'] =$this->dailycall_model->get_statename($state_code);
					}
					else
					{
					$activitydata['leadid'] =0;
					$activitydata['customerinfo']['industry_name'] ="Nil";
					$activitydata['customerinfo']['country'] =	$activitydata['customerinfo'][0]['country'];
					$activitydata['customerinfo']['state'] =$activitydata['customerinfo'][0]['state'];
					}
					//print_r($activitydata); die;

					$this->load->view('dailycall/customerdailycallupdate',$activitydata);	
				} 
				else
			  	{
		 			redirect('admin/index', 'refresh');
				}

		}

		function dcupdatelead($customer_id,$leadid)
		{
			
			
			//echo"<pre>post"; print_r($_POST); echo"<pre>"; die;
			//echo $leadid; 
			$leadid = $this->uri->segment(4);
			@$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];
			@$run_time_dc_lead_id = $this->session->userdata['run_time_dc_lead_id'];
			
				if (isset($_SERVER['HTTP_REFERER']))
				{
				 $reffer=@$_SERVER['HTTP_REFERER'];
		       	}
		      // $reffer="http://10.1.2.40/salescrm/leads/adddcproduct/13275";

				@$path = explode('/', @$_SERVER['HTTP_REFERER']); 
				//print_r($path); die;
				@$leadpath=@$path[4];	
			
			 if (!$this->admin_auth->logged_in())
				{
					//redirect them to the login page
					redirect('admin/login', 'refresh');
				}
				elseif (!$this->admin_auth->is_admin())
				{
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$activitydata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					$data = array();
					$i=0;
					$datagroup = array();					
					foreach($activitydata['permission'] as $key=>$val)
					{
						$row = array();

						$row["groupid"] = $key;
						$row["groupname"] = $val;
						$datagroup[$i] = $row;
						$i++;
					}
					$activitydata['leadpath'] =$leadpath;
					$arr = json_encode($datagroup);
					$activitydata['grpperm'] =$datagroup;
				
					$user_name= $this->session->userdata['identity'];
					$activitydata['customerid'] =$customer_id;

					$activitydata['customername'] =$this->dailycall_model->get_customername($customer_id);
					$activitydata['customergroup'] =$this->dailycall_model->get_customergroup($customer_id);
					

					$activitydata['exe_name'] =$user_name;
					$activitydata['customerinfo']= $this->dailycall_model->get_customerdetails($customer_id,$leadid);
					//print_r($activitydata['customerinfo']); die;
					//$activitydata['closedlead'] = $activitydata['customerinfo']['0']['lead_close_status'];
					$activitydata['closedlead'] = 0;
					$activitydata['data']= $this->dailycall_model->get_leadproducttype_info($customer_id);
					$activitydata['cust_prod_data']= $this->dailycall_model->get_leadcustprod_info($customer_id,$leadid);

					$activitydata['custprodhdr']= $this->dailycall_model->get_custprodhdr($customer_id);

	
	
					if($leadid!=0)
					{
					$activitydata['leadid'] =$leadid;

					    $activitydata['lead_contact_row_count']= $this->dailycall_model->get_noof_rows_savedlead_contactinfo($activitydata['leadid'],$customer_id);
				        //  echo" row count ".$activitydata['lead_contact_row_count']; die;
				          if($activitydata['lead_contact_row_count']>0)
				          {
				          $activitydata['lead_contact_data']= $this->dailycall_model->get_saved_lead_contact_info($activitydata['leadid'],$customer_id);
				          }
				          else
				          {
				          $activitydata['lead_contact_data']= $this->dailycall_model->get_lead_contact_info($activitydata['leadid'],$customer_id);
				          }
					//$activitydata['lead_contact_data']= $this->dailycall_model->get_lead_contact_info($activitydata['leadid'],$customer_id);
					/**/
					$leadstusid =$this->dailycall_model->get_ld_leadstatus($leadid);
					$substatusid=$this->dailycall_model->get_ld_leadsubstatus($leadid);

					$leadstus_order_id = $this->dailycall_model->get_leadstatus_order($leadstusid);
					$lst_order_by_id = $this->dailycall_model->get_leadsubstatus_order($substatusid);
					$lst_parentid_id = $this->dailycall_model->get_leadsubstatus_parent($substatusid);

			
					$activitydata['leadid'] = $leadid;
					$activitydata['leadstatusid'] = $leadstusid;
					$activitydata['ldsubstatus'] = $substatusid;
					$activitydata['lst_parentid_id'] = $lst_parentid_id;

					$activitydata['leadstus_order_id'] = $leadstus_order_id;
					$activitydata['lst_order_by_id'] = $lst_order_by_id;

					$activitydata['optionslst'] = $this->Leads_model->get_leadstatus_edit($leadstusid,$leadstus_order_id);
					$activitydata['optionslsubst'] = $this->Leads_model->get_substatus_edit_all($substatusid,$lst_parentid_id,$lst_order_by_id);
					
					}
				}
					
					$activitydata['optionsvisittype'] = $this->dailycall_model->get_typeofvisit_nojason();

				$activitydata['exe_name'] =$user_name;
			$this->load->view('dailycall/lddailycallupdate',$activitydata);	
		}
		function updatedailycall()
		{
				echo"<pre>post"; print_r($_POST); echo"<pre>"; die;
			 	$leadid = $_POST['hdn_leadid'];
				$customer_id = $_POST['hdn_customerid'];
				$leadid = $_POST['hdn_leadid'];
				$hdr_comments=$_POST['hdn_cmnts'];
				$login_user_id = $this->session->userdata['user_id'];
				$login_username = $this->session->userdata['username'];
				$createddate = "";
				$lastupdatedate = date('Y-m-d:H:i:s');
				$creationuser ="";
				$lastupdateuser =$this->session->userdata['identity'];
				$execode = $this->session->userdata['empcode'];
				$exename = $this->session->userdata['identity'];
				$user1 = $this->session->userdata['loginname'];
				//$user1 = $this->session->userdata['username'];

				$hdncustomername = $_POST['hdncustomername'];
				$customer_id = $_POST['hdn_customerid'];
				$leadid = $_POST['hdn_leadid'];
			
				$leaddetails = array(
				'company' => $_POST['hdn_customerid'],
				'customer_id' => $customer_id,
				'description' => $_POST['description'],
				'website' => $_POST['website'],
				'last_modified' => date('Y-m-d:H:i:s'),
				'last_updated_user' => $login_user_id
				);
				$id =$this->Leads_model->update_lead($leaddetails,$leadid);
			//	$message = "Added record for visitdate  by".trim($exename)." for  the customer ".trim($hdncustomername);		
			  	$message = "Record updated sucessfully";		
				
				//redirect('dailycall/viewdiallycalldetailsbydate/'.$customer_id);
 	  			 redirect('dailycall/customerdetails/'.$customer_id.'/'.$leadid);

		}

		function ldcustomerdetails($customer_id,$leadid)
		{
			//echo $leadid; 
			$leadid = $this->uri->segment(4);
			@$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];
			@$run_time_dc_lead_id = $this->session->userdata['run_time_dc_lead_id'];
			
				if (isset($_SERVER['HTTP_REFERER']))
				{
				 $reffer=@$_SERVER['HTTP_REFERER'];
		       	}
		      // $reffer="http://10.1.2.40/salescrm/leads/adddcproduct/13275";

				@$path = explode('/', @$_SERVER['HTTP_REFERER']); 
				//print_r($path); die;
				@$leadpath=@$path[4];	
			
			 if (!$this->admin_auth->logged_in())
				{
					//redirect them to the login page
					redirect('admin/login', 'refresh');
				}
				elseif (!$this->admin_auth->is_admin())
				{
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$activitydata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					$data = array();
					$i=0;
					$datagroup = array();					
					foreach($activitydata['permission'] as $key=>$val)
					{
						$row = array();

						$row["groupid"] = $key;
						$row["groupname"] = $val;
						$datagroup[$i] = $row;
						$i++;
					}
					$activitydata['leadpath'] =$leadpath;
					$arr = json_encode($datagroup);
					$activitydata['grpperm'] =$datagroup;
				
					$user_name= $this->session->userdata['identity'];
					$activitydata['customerid'] =$customer_id;

					$activitydata['customername'] =$this->dailycall_model->get_customername($customer_id);
					$activitydata['customergroup'] =$this->dailycall_model->get_customergroup($customer_id);
					

					$activitydata['exe_name'] =$user_name;
					$activitydata['customerinfo']= $this->dailycall_model->get_customerdetails($customer_id,$leadid);
					//print_r($activitydata['customerinfo']); die;
					//$activitydata['closedlead'] = $activitydata['customerinfo']['0']['lead_close_status'];
					$activitydata['closedlead'] = 0;
					$activitydata['data']= $this->dailycall_model->get_leadproducttype_info($customer_id);
					$activitydata['cust_prod_data']= $this->dailycall_model->get_leadcustprod_info($customer_id,$leadid);

					$activitydata['custprodhdr']= $this->dailycall_model->get_custprodhdr($customer_id);

	
	
					if($leadid!=0)
					{
					$activitydata['leadid'] =$leadid;

					    
				          $activitydata['lead_contact_row_count']= $this->dailycall_model->get_noof_rows_savedlead_contactinfo($activitydata['leadid'],$customer_id);
				        //  echo" row count ".$activitydata['lead_contact_row_count']; die;
				          if($activitydata['lead_contact_row_count']>0)
				          {
				          $activitydata['lead_contact_data']= $this->dailycall_model->get_saved_lead_contact_info($activitydata['leadid'],$customer_id);
				          }
				          else
				          {
				          $activitydata['lead_contact_data']= $this->dailycall_model->get_lead_contact_info($activitydata['leadid'],$customer_id);
				          }
          
          
				//	$activitydata['lead_contact_data']= $this->dailycall_model->get_lead_contact_info($activitydata['leadid'],$customer_id);
					/**/
					$leadstusid =$this->dailycall_model->get_ld_leadstatus($leadid);
					$substatusid=$this->dailycall_model->get_ld_leadsubstatus($leadid);

					$leadstus_order_id = $this->dailycall_model->get_leadstatus_order($leadstusid);
					$lst_order_by_id = $this->dailycall_model->get_leadsubstatus_order($substatusid);
					$lst_parentid_id = $this->dailycall_model->get_leadsubstatus_parent($substatusid);

			
					$activitydata['leadid'] = $leadid;
					$activitydata['leadstatusid'] = $leadstusid;
					$activitydata['ldsubstatus'] = $substatusid;
					$activitydata['lst_parentid_id'] = $lst_parentid_id;

					$activitydata['leadstus_order_id'] = $leadstus_order_id;
					$activitydata['lst_order_by_id'] = $lst_order_by_id;

					$activitydata['optionslst'] = $this->Leads_model->get_leadstatus_edit($leadstusid,$leadstus_order_id);
					$activitydata['optionslsubst'] = $this->Leads_model->get_substatus_edit_all($substatusid,$lst_parentid_id,$lst_order_by_id);
					/**/
					}
					/*else
					{
					$activitydata['leadid'] =0;
					$activitydata['customerinfo']['industry_name'] ="Nil";
					$activitydata['customerinfo']['country'] =	$activitydata['customerinfo'][0]['country'];
					$activitydata['customerinfo']['state'] =$activitydata['customerinfo'][0]['state'];
					


					$leadstusid =$this->dailycall_model->get_leadstatus($customer_id);
					$substatusid=$this->dailycall_model->get_leadsubstatus($customer_id);

					$leadstus_order_id = $this->dailycall_model->get_leadstatus_order($leadstusid);
					$lst_order_by_id = $this->dailycall_model->get_leadsubstatus_order($substatusid);
					$lst_parentid_id = $this->dailycall_model->get_leadsubstatus_parent($substatusid);

					$activitydata['leadid'] = 0;
					$activitydata['leadstatusid'] = 0;
					$activitydata['ldsubstatus'] = 0;
					
					}*/
					//print_r($activitydata); die;
				$activitydata['optionsvisittype'] = $this->dailycall_model->get_typeofvisit_nojason();

				$activitydata['exe_name'] =$user_name;
				//$activitydata['data']=$this->Leads_model->get_synched_products($customer_id);

				$this->load->view('dailycall/ldviewcustomerdetails',$activitydata);	
				} 
				else
			  	{
		 			redirect('admin/index', 'refresh');
				}
		}
		function get_leadstatus($leadstusid,$leadstus_order_id)
		{
			//echo"leadstusid ".$leadstusid."<br>";
		//	echo"leadstus_order_id ".$leadstus_order_id."<br>";
			$data = array();
			$data= $this->dailycall_model->get_leadstatus_edit($leadstusid,$leadstus_order_id);	
			print_r($data);
		}
		function get_leadsubstatus($substatusid,$lst_parentid_id,$lst_order_by_id)
		{

			$data = array();
			//$data=$this->dailycall_model->get_ldtypeofsales();
			$data=$this->dailycall_model->get_substatus_edit_all($substatusid,$lst_parentid_id,$lst_order_by_id);
			print_r($data);
		}
		function get_leadgridsubstatus($leadstatus_id)
		{
			//echo"leadstatus_id ".$leadstatus_id."<br>"; die;
			$leadstatus_id = urldecode($leadstatus_id);
			$data = array();
			//$data=$this->dailycall_model->get_ldtypeofsales();
			$data=$this->dailycall_model->get_leadgrid_substatus($leadstatus_id);
			print_r($data);

						
		}
					


		
		function customerdetails($customergroup,$leadid=0)
		{
			$customergroup = str_replace("'", "", $customergroup);
			$customergroup = str_replace("'", "", $customergroup);
			//echo $leadid; 
			if (isset($_SERVER['HTTP_REFERER']))
			{
				 $reffer=@$_SERVER['HTTP_REFERER'];
		       }
		      // $reffer="http://10.1.2.40/salescrm/leads/adddcproduct/13275";

				@$path = explode('/', @$_SERVER['HTTP_REFERER']); 
				//print_r($path); die;
				@$leadpath=@$path[4];
		       		 
			$leadid = $this->uri->segment(4);
			@$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];
			@$run_time_dc_lead_id = $this->session->userdata['run_time_dc_lead_id'];
					
			
			 if (!$this->admin_auth->logged_in())
				{
					//redirect them to the login page
					redirect('admin/login', 'refresh');
				}
				elseif (!$this->admin_auth->is_admin())
				{
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$activitydata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					$data = array();
					$i=0;
					$datagroup = array();					
					foreach($activitydata['permission'] as $key=>$val)
					{
						$row = array();

						$row["groupid"] = $key;
						$row["groupname"] = $val;
						$datagroup[$i] = $row;
						$i++;
					}

					$arr = json_encode($datagroup);
					$activitydata['grpperm'] =$arr;
				
					$user_name= $this->session->userdata['identity'];

					
					$activitydata['leadpath'] =$leadpath;
					$customer_group = urldecode($customergroup);
					$activitydata['customerid'] = $this->dailycall_model->get_customerid($customer_group);
					
					//print_r($activitydata['customerinfo'][0]['executivename']); die;
				//	$customer_group = $this->dailycall_model->get_customergroup($customer_id);

					//$activitydata['customername'] =addslashes($this->dailycall_model->get_customername($customer_id));
					$activitydata['customername'] ="test";
					$activitydata['customergroup']=trim($customer_group);
/*					$activitydata['customergroup'] = str_replace("'", "", $customer_group);
					$activitydata['customergroup'] = html_entity_decode($customer_group);*/

					$activitydata['exe_name'] =$user_name;
					//$activitydata['customerinfo']= $this->dailycall_model->get_customerdetails(v$customer_id,$leadid);
					$activitydata['customerinfo']= $this->dailycall_model->get_customerdetailsgrp($customer_group,$leadid);
					
					$activitydata['customerinfo'][0]['about_the_customer']="welcome to the about the customer info";
					$activitydata['customerinfo'][0]['credit_limit']=number_format($this->dailycall_model->get_cust_group_credit_limit($customer_group));
					//$activitydata['customerinfo'][0]['credit_limit']=1090;
					$activitydata['customerinfo'][0]['executivename'] =$this->dailycall_model->get_customer_exename($customer_group);
				//	$activitydata['data']= $this->dailycall_model->get_producttype_info($customer_id);
				//	$activitydata['data']= $this->dailycall_model->get_producttype_sum_from_businessplan($customer_id);
					$activitydata['data']= $this->dailycall_model->get_producttype_sum_from_businessplan_custgroup($customer_group);
					
				
					$activitydata['cust_prod_data']= $this->dailycall_model->get_custprod_busnessplandtl_info($customer_group);
					
					
					$activitydata['cust_contact_row_count']= $this->dailycall_model->get_noof_rows_savedcust_contactinfo($customer_group,$activitydata['customerid']);
					//echo" row count ".$activitydata['cust_contact_row_count']; die;
					if($activitydata['cust_contact_row_count']>0)
					{
					$activitydata['cust_contact_data']= $this->dailycall_model->get_saved_cust_contact_info($customer_group,$activitydata['customerid']);	
					}
					else
					{
					$activitydata['cust_contact_data']= $this->dailycall_model->get_cust_contact_info($customer_group,$activitydata['customerid']);	
					}
					
					


					//$activitydata['custprodhdr']= $this->dailycall_model->get_custprodhdr($activitydata['customerid']);
					$activitydata['custprodhdr']= $this->dailycall_model->get_custprodhdrgrp($activitydata['customergroup']);

					/*print_r($activitydata['cust_prod_data']); 
					echo "count of ".count($activitydata['cust_prod_data']);
					die;*/
	
				
					$activitydata['leadid'] =0;
				/*	$activitydata['customerinfo']['industry_name'] ="Nil";
					$activitydata['customerinfo']['country'] =	$activitydata['customerinfo'][0]['country'];
					$activitydata['customerinfo']['state'] =$activitydata['customerinfo'][0]['state'];*/

				
					//print_r($activitydata); die;

					$this->load->view('dailycall/viewcustomerdetails',$activitydata);	
				} 
				else
			  	{
		 			redirect('admin/index', 'refresh');
				}
		}


		//function viewdiallycalldetails($visitdate=0)
		function viewdiallycalldetails($assign_to_id=0)
		{
		//	echo "assign_to_id ".$assign_to_id;
			@$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];
			$exename =  $this->dailycall_model->get_assignto_name($assign_to_id); 
			$branch =  $this->dailycall_model->get_assignto_branch($assign_to_id); 
			
			 if (!$this->admin_auth->logged_in())
				{
					//redirect them to the login page
					redirect('admin/login', 'refresh');
				}
				elseif (!$this->admin_auth->is_admin())
				{
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$activitydata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					$data = array();
					$i=0;
					$datagroup = array();					
					foreach($activitydata['permission'] as $key=>$val)
					{
						$row = array();

						$row["groupid"] = $key;
						$row["groupname"] = $val;
						$datagroup[$i] = $row;
						$i++;
					}

					$arr = json_encode($datagroup);
					$activitydata['grpperm'] =$arr;
				
					$user_name= $this->session->userdata['identity'];
				}

					$activitydata['data']= $this->dailycall_model->get_viewdiallycalldetails($exename);
				//	$activitydata['data']= $this->dailycall_model->get_viewdiallycalldetails_bydate($exename);
					$activitydata['executive']=$exename;
					$activitydata['branch']=$branch;
					
					$this->load->view('dailycall/viewdiallycalldetails',$activitydata);	

		}
		function viewdiallycalldetailsbydate($visitdate=0)
		
		{
		//	echo "visitdate ".$visitdate;
			@$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];
			
			 if (!$this->admin_auth->logged_in())
				{
					//redirect them to the login page
					redirect('admin/login', 'refresh');
				}
				elseif (!$this->admin_auth->is_admin())
				{
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$activitydata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					$data = array();
					$i=0;
					$datagroup = array();					
					foreach($activitydata['permission'] as $key=>$val)
					{
						$row = array();

						$row["groupid"] = $key;
						$row["groupname"] = $val;
						$datagroup[$i] = $row;
						$i++;
					}

					$arr = json_encode($datagroup);
					$activitydata['grpperm'] =$arr;
				
					$user_name= $this->session->userdata['identity'];
				}

					$activitydata['data']= $this->dailycall_model->get_viewdiallycalldetails_bydate($visitdate);
					$this->load->view('dailycall/viewdiallycalldetailsdate',$activitydata);	

		}




		function dcgetleadsubstatus($parent_id,$leadid)
		{

			$this->dailycall_model->parent_id = $parent_id;
	   
			$substatus = $this->dailycall_model->get_dc_leadsubstatus($parent_id,$leadid);
			header('Content-Type: application/x-json; charset=utf-8');
			echo json_encode($substatus);
		}
		function dcgetleadsubstatusgrid($parent_id,$leadid)
		{

			$this->dailycall_model->parent_id = $parent_id;

			

			$substatus = $this->dailycall_model->get_dc_leadsubstatusgrid($parent_id,$leadid);
			//header('Content-Type: application/x-json; charset=utf-8');
			print_r($substatus);
		}

		function checkdate($date,$customergroup,$username)
		{
			
			
			
			/*echo "exe_name ".$_POST['exe_name'];echo"<br>";
			echo "customergroup ".$_POST['customergroup'];echo"<br>";
			echo "visit_date ".$_POST['visit_date'];echo"<br>";*/

			$login_username = $this->session->userdata['username'];
			$exename=$_POST['exe_name'];
			//$customername= $_POST['customername'];
			$customergroup= $_POST['customergroup'];
			$visit_date= $_POST['visit_date'];
			$user1 = $this->session->userdata['loginname'];

			$visit_date =implode("-", array_reverse(explode("-", $visit_date)));
			$activitydata['response']= $this->dailycall_model->check_duplicates_daillycall($visit_date,$customergroup,$login_username);
		//	echo $activitydata['response'];
			if($activitydata['response']=='false')
			{
						$response = array(
						    'ok' => false, 
						    'msg' => "<font color=red>Customer Visit already entered in this date</font>");
			} else 
			{  
		  		$response = array(
		    				'ok' => true, 
		    				'msg' => "<font color=green>Yes..!You can use this date</font>");
			}
		
	       echo json_encode($response);
			
			
		}

		function checkproduct($prodid,$customer_id)
		{
			
			
			
		/*	echo "prodid ".$_POST['prodid'];echo"<br>";
			echo "customerid ".$_POST['customerid'];echo"<br>";
			echo "visit_date ".$_POST['visit_date'];echo"<br>";*/


			$prodid=$_POST['prodid'];
			$customerid= $_POST['customerid'];
			$user1 = $this->session->userdata['loginname'];

			//$visit_date =implode("-", array_reverse(explode("-", $visit_date)));
			//$activitydata['response']= $this->dailycall_model->check_duplicates_daillycall($visit_date,$customername,$user1);
			$activitydata['response']= $this->dailycall_model->check_prodduplicates_daillycall($prodid,$customer_id,$user1);

		//	echo $activitydata['response'];
			if($activitydata['response']=='false')
			{
						$response = array(
						    'ok' => false, 
						    'msg' => "<font color=red>This product has been already added to this customer</font>");
			} else 
			{  
		  		$response = array(
		    				'ok' => true, 
		    				'msg' => "<font color=green>Yes..!You can use this product</font>");
			}
		
	       echo json_encode($response);
			
			
		}
		
		function checkproductbyname($prodname,$customer_id,$customergroup)
		{
			
			
			
		/*	echo "prodid ".$_POST['prodid'];echo"<br>";
			echo "customerid ".$_POST['customerid'];echo"<br>";
			echo "visit_date ".$_POST['visit_date'];echo"<br>";*/


			 $prodname=$_POST['prodname'];
			 $customerid= $_POST['customerid'];
			 $customergroup= $_POST['customergroup'];
			$customergroup=urldecode($customergroup);
			 $user1 = $this->session->userdata['loginname'];

			//$visit_date =implode("-", array_reverse(explode("-", $visit_date)));
			//$activitydata['response']= $this->dailycall_model->check_duplicates_daillycall($visit_date,$customername,$user1);
			$activitydata['responsedc']= $this->dailycall_model->check_prodnameduplicates_daillycall($prodname,$customer_id,$customergroup,$user1);
			$activitydata['responseld']= $this->dailycall_model->check_prodnameduplicates_lead($prodname,$customer_id,$customergroup,$user1);

			if ($activitydata['responseld']=='true' && $activitydata['responsedc']=='true')
			{
				$response = array(
		    				'ok' => true, 
		    				'msg' => "<font color=green>Yes..!You can use this product product</font>");
			}
			else if ($activitydata['responseld']=='false')
			{
						$response = array(
						    'ok' => false, 
						    'msg' => "<font color=red>This product group has been already added in lead</font>");
			} else if ($activitydata['responsedc']=='false')
			{  
		  		
		    				$response = array(
						    'ok' => false, 
						    'msg' => "<font color=red>This product group has been already added to this customer</font>");
			}

		//	echo $activitydata['response'];

			/*if ($activitydata['responseld']=='false')
			{
						$response = array(
						    'ok' => false, 
						    'msg' => "<font color=red>This product group has been already added in lead</font>");
			} else 
			{  
		  		$response = array(
		    				'ok' => true, 
		    				'msg' => "<font color=green>Yes..!You can use this product product</font>");
			}



			if($activitydata['responsedc']=='false')
			{
						$response = array(
						    'ok' => false, 
						    'msg' => "<font color=red>This product group has been already added to this customer</font>");
			} else 
			{  
		  		$response = array(
		    				'ok' => true, 
		    				'msg' => "<font color=green>Yes..!You can use this product product</font>");
			}*/
		
	       echo json_encode($response);
			
			
		}
		function checkcustomerbyname($customername,$customergroup,$customerid)
		{
			$customername=$_POST['custname'];
			$customergroup= $_POST['customergroup'];
			$customerid= $_POST['customerid'];
			$user1 = $this->session->userdata['loginname'];
//custname	VIKRAM RESINS & POLYMERS customergroup	VIKRAM RESINS & POLYMERS customerid	1303

			$activitydata['response']= $this->dailycall_model->check_customerbyname_dailycall($customername,$customergroup,$customerid,$user1);

		//	echo $activitydata['response'];
			if($activitydata['response']=='false')
			{
						$response = array(
						    'ok' => false, 
						    'msg' => "<font color=red>This product group has been already added to this customer</font>");
			} else 
			{  
		  		$response = array(
		    				'ok' => true, 
		    				'msg' => "<font color=green>Yes..!You can use this product product</font>");
			}
		
	       echo json_encode($response);
		}
		




		function checkleadproducts($prodid,$customer_id)
		{
			
			
			
		/*	echo "prodid ".$_POST['prodid'];echo"<br>";
			echo "customerid ".$_POST['customerid'];echo"<br>";
			echo "visit_date ".$_POST['visit_date'];echo"<br>";*/


			$prodid=$_POST['prodid'];
			$customerid= $_POST['customerid'];
			$user1 = $this->session->userdata['loginname'];

			//$visit_date =implode("-", array_reverse(explode("-", $visit_date)));
			//$activitydata['response']= $this->dailycall_model->check_duplicates_daillycall($visit_date,$customername,$user1);
			$activitydata['response']= $this->dailycall_model->checkdc_leadprod_duplicates($prodid,$customer_id,$user1);

		//	echo $activitydata['response'];
			if($activitydata['response']=='false')
			{
						$response = array(
						    'ok' => false, 
						    'msg' => "<font color=red>This product has been already added to this customer</font>");
			} else 
			{  
		  		$response = array(
		    				'ok' => true, 
		    				'msg' => "<font color=green>Yes..!You can use this product</font>");
			}
		
	       echo json_encode($response);
			
			
		}

		function viewdccustomerdetails($customer_id=0)
		{
		//	echo "assign_to_id ".$assign_to_id;
			@$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];
			//$exename =  $this->dailycall_model->get_assignto_name($assign_to_id); 
			//$branch =  $this->dailycall_model->get_assignto_branch($assign_to_id); 
			$customername = $this->dailycall_model->get_customername($customer_id);

			 if (!$this->admin_auth->logged_in())
				{
					//redirect them to the login page
					redirect('admin/login', 'refresh');
				}
				elseif (!$this->admin_auth->is_admin())
				{
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$activitydata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					$data = array();
					$i=0;
					$datagroup = array();					
					foreach($activitydata['permission'] as $key=>$val)
					{
						$row = array();

						$row["groupid"] = $key;
						$row["groupname"] = $val;
						$datagroup[$i] = $row;
						$i++;
					}

					$arr = json_encode($datagroup);
					$activitydata['grpperm'] =$arr;
				
					$user_name= $this->session->userdata['identity'];
				}

					$activitydata['data']= $this->dailycall_model->get_viewdiallycalldetails_bycustomer($customername);
				//	$activitydata['data']= $this->dailycall_model->get_viewdiallycalldetails_bydate($exename);
					$activitydata['customername']="test";
					$activitydata['branch']="Test Branch";
					$activitydata['executive']=$user_name;
					
					
					$this->load->view('dailycall/viewdccustomerdetails',$activitydata);	

		}


			function edit($customer_id)
			{
	
			$leadid = $this->uri->segment(4);
				//	echo"customer id ".$customer_id;echo"leadid ".$leadid; die;
			$this->session->set_userdata('run_time_dc_lead_id',$leadid); 	

			@$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];
			@$run_time_dc_lead_id = $this->session->userdata['run_time_dc_lead_id'];
					
			
			 if (!$this->admin_auth->logged_in())
				{
					//redirect them to the login page
					redirect('admin/login', 'refresh');
				}
				elseif (!$this->admin_auth->is_admin())
				{
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$activitydata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					$data = array();
					$i=0;
					$datagroup = array();					
					foreach($activitydata['permission'] as $key=>$val)
					{
						$row = array();

						$row["groupid"] = $key;
						$row["groupname"] = $val;
						$datagroup[$i] = $row;
						$i++;
					}

					$arr = json_encode($datagroup);
					$activitydata['grpperm'] =$arr;
				
					$user_name= $this->session->userdata['identity'];
					$activitydata['customerid'] =$customer_id;

					$activitydata['customername'] =$this->dailycall_model->get_customername($customer_id);
					$activitydata['exe_name'] =$user_name;
					$activitydata['customerinfo']= $this->dailycall_model->get_customerdetails($customer_id,$leadid);

					
					//$activitydata['custprodhdr']= $this->dailycall_model->get_custprodhdr($customer_id);


					//echo"<pre>";print_r($activitydata);echo"</pre>"; die;
	
					
					
					$activitydata['leadid'] =0;

				//	$activitydata['cust_prod_data']= $this->dailycall_model->get_dccustprod_info($customer_id);
					$activitydata['cust_prod_data']= $this->dailycall_model->get_custprod_info($customer_id,$leadid);
					
					$this->load->view('dailycall/editexcustomerdetails',$activitydata);	
				
					//print_r($activitydata); die;

					//$this->load->view('dailycall/editexcustomerdetails',$activitydata);	
				} 
				else
			  	{
		 			redirect('admin/index', 'refresh');
				}
				
		
			}

			function editld($customer_id,$leadid)
			{
		//	echo"customer id ".$customer_id;echo"leadid ".$leadid; die;
			$this->session->set_userdata('run_time_dc_lead_id',$leadid); 	
			$leadid = $this->uri->segment(4);
			@$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];
			@$run_time_dc_lead_id = $this->session->userdata['run_time_dc_lead_id'];
					
			
			 if (!$this->admin_auth->logged_in())
				{
					//redirect them to the login page
					redirect('admin/login', 'refresh');
				}
				elseif (!$this->admin_auth->is_admin())
				{
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$activitydata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					$data = array();
					$i=0;
					$datagroup = array();					
					foreach($activitydata['permission'] as $key=>$val)
					{
						$row = array();

						$row["groupid"] = $key;
						$row["groupname"] = $val;
						$datagroup[$i] = $row;
						$i++;
					}

					$arr = json_encode($datagroup);
					$activitydata['grpperm'] =$arr;
				
					$user_name= $this->session->userdata['identity'];
					$activitydata['customerid'] =$customer_id;

					$activitydata['customername'] =$this->dailycall_model->get_customername($customer_id);
					$activitydata['exe_name'] =$user_name;
					$activitydata['customerinfo']= $this->dailycall_model->get_customerdetails($customer_id,$leadid);

					if($leadid!=0)
					{
						$activitydata['leadid'] =$leadid;
						
						$this->load->view('dailycall/editcustomerdetails',$activitydata);	
					}
					
					//print_r($activitydata); die;

					//$this->load->view('dailycall/editexcustomerdetails',$activitydata);	
				} 
				else
			  	{
		 			redirect('admin/index', 'refresh');
				}
				
		
			}

			


			function selectproductfordc()
			{
				$customerhdid = $this->uri->segment(4);	
				$data = array();
			//	$data['body']="Select products from the dropdown";
				$data['customerhdid']=$customerhdid;
				$data['data']=$this->dailycall_model->get_productsfordc();
     			  // print_r($data); die;
				$this->load->view('dailycall/selectproducts',$data);
			}


			function selectleadproductfordc()
			{
				$customerhdid = $this->uri->segment(4);	
				$data = array();
			//	$data['body']="Select products from the dropdown";
				$data['customerhdid']=$customerhdid;
				$data['data']=$this->dailycall_model->get_productsfordc();
     			  // print_r($data); die;
				$this->load->view('dailycall/selectleadproducts',$data);
			}

			function get_dataitemmaster()
			{

				$sql='SELECT  DISTINCT on (description) id, description FROM view_tempitemmaster ORDER BY description asc';
				//$sql='SELECT    itemgroup as id,  itemgroup as description FROM itemmaster  WHERE length(itemgroup) >1  GROUP BY itemgroup  ORDER BY itemgroup asc';
			//		$sql='SELECT    id,  itemgroup as description FROM itemmaster  WHERE length(itemgroup) >1  GROUP BY itemgroup  ORDER BY itemgroup asc';
				$activitydata['dataitemmaster']=$this->dailycall_model->get_allproducts($sql);
			//	$viewdata = '['.$activitydata['dataitemmaster'].']'; 
				$viewdata = $activitydata['dataitemmaster']; 
		    		header('Content-Type: application/x-json; charset=utf-8');
				echo $viewdata;

			}
			function get_datacustomer($customergroup)
			{
				$customergroup = urldecode($customergroup);
				$customergroup = html_entity_decode($customergroup);
			//	$sql='SELECT  DISTINCT on (description) id, description FROM view_tempitemmaster ORDER BY description asc';
				$sql="SELECT id,customer_name FROM customermasterhdr WHERE customergroup ='".$customergroup."'"; 
				//echo $sql;
			//	$sql="SELECT id,customer_name FROM customermasterhdr WHERE customergroup ='TURBO ENERGY LIMITED'"; 	
				$activitydata['datacustomer']=$this->dailycall_model->get_customers($sql);
			//	$viewdata = '['.$activitydata['dataitemmaster'].']'; 
				$viewdata = $activitydata['datacustomer']; 
		    		header('Content-Type: application/x-json; charset=utf-8');
				echo $viewdata;

			}
			function getcustomervisitdetails($hdr_logid)
			{
				$activitydata['custvisit_hdr_details']= $this->dailycall_model->get_custvisit_hdrdetails($hdr_logid);
				$activitydata['custvisit_person_details']= $this->dailycall_model->get_custvisit_persondetails($hdr_logid);
				$activitydata['custvisit_prod_details']= $this->dailycall_model->get_custvisit_proddetails($hdr_logid);
				$this->load->view('dailycall/visitdetails',$activitydata);
			}




} // End of Class
?>
