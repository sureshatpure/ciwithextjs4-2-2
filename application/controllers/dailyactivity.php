<?php

class dailyactivity extends CI_Controller {

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
	 //$this->load->model('Leads_model');
	 $this->load->model('dailyactivity_model');
   	 $this->load->library('subquery');
	 $this->load->library('session');
	 $this->load->helper('html');

	}

/*	
  public function index()
	{
		$leaddata = array();
	  //$leaddata = $this->Leads_model->get_lead_details();
	  $leaddata['leaddetails'] = $this->Leads_model->get_lead_details();
 //echo"<pre>";print_r($leaddata);echo"</pre>";
		$this->load->view('leads/viewleads',$leaddata);	
	}
*/

	public function index()
	{
			//print_r($this->session->userdata); 

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
			 	  $activitydata = array();
       /* if ($this->session->userdata['reportingto']=="")
					{
						$activitydata['leaddetails'] = $this->Leads_model->get_lead_details_all();
						$activitydata['data']=$this->Leads_model->get_leaddetails_for_grid();
					}
					else
					{
						$activitydata['leaddetails'] = $this->Leads_model->get_lead_details($this->session->userdata['reportingto']);
						$activitydata['data']=$this->Leads_model->get_leaddetails_reporting_to_for_grid($this->session->userdata['reportingto']);
					}
				   $activitydata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
				 */ 
				$data = array();
			//	$leaddata['data']=$this->Leads_model->get_leaddetails_for_grid();
				$activitydata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
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

				//  $this->load->view('leads/viewleadsnew',$leaddata);	
		
		 		if ($this->session->userdata['reportingto']=="")
		 		{

					$activitydata['data']=$this->dailyactivity_model->getactivity_data_all();
		 		}
		 		else
		 		{
		 		  $activitydata['data']=$this->dailyactivity_model->getactivity_data($this->session->userdata['user_id']);
		 		}
				
				
			//	$this->load->view('dailyactivity/viewdailyactivity');
				$sql='SELECT  DISTINCT  itemgroup FROM itemmaster ORDER BY itemgroup asc';
				$activitydata['dataitemmaster']=$this->dailyactivity_model->get_products($sql);
				$this->load->view('dailyactivity/viewdailyactivity',$activitydata);	
			} 

			else
		  {
			 			redirect('admin/index', 'refresh');
						//$this->load->view('leads/viewleads',$leaddata);	
			}
	}
	
			function get_edit_data()
			{
				$header_id = $this->uri->segment(3);
				$activitydata['datacolumn']=$this->dailyactivity_model->getactivity_data_column();
				$activitydata['datarow']=$this->dailyactivity_model->getactivity_data_row($header_id);
				$viewdata = '['.$activitydata['datacolumn'].','.$activitydata['datarow'].']'; 
		    		header('Content-Type: application/x-json; charset=utf-8');
				echo $viewdata;
			 }

			 function get_data_addgrid()
			{
				
				$activitydata['datacolumn']=$this->dailyactivity_model->getactivity_data_column();
				$viewdata = '['.$activitydata['datacolumn'].']'; 
		    		header('Content-Type: application/x-json; charset=utf-8');
				echo $viewdata;
			 }

			  function get_data_itemmaster()
			{
				
				$sql='SELECT  DISTINCT  itemgroup FROM itemmaster ORDER BY itemgroup asc';
				$activitydata['dataitemmaster']=$this->dailyactivity_model->get_products($sql);
			//	$viewdata = '['.$activitydata['dataitemmaster'].']'; 
				$viewdata = $activitydata['dataitemmaster']; 
		    		header('Content-Type: application/x-json; charset=utf-8');
				echo $viewdata;
			 }

			 function get_potentialquantity()
			 {
			 	$item = urldecode($this->uri->segment(4));
			 	$customer= urldecode($this->uri->segment(3));
				$activitydata['potential_quantity']=$this->dailyactivity_model->get_potential_item_customer($item,$customer);
				//print_r($activitydata); die;
				//header('Content-Type: application/x-json; charset=utf-8');
				$viewdata = $activitydata['potential_quantity']; 
				echo $viewdata;
			 }


			  function get_data_customermaster()
			{
				
				//$sql='SELECT 	distinct on (view_tempcustomermaster.tempcustname) view_tempcustomermaster.id,view_tempcustomermaster.tempcustname FROM 	view_tempcustomermaster ORDER BY  tempcustname ASC';

				$sql="SELECT distinct  replace(customergroup,'''','')   as customergroup FROM customermasterhdr order by customergroup";
				//$sql="SELECT distinct   customergroup FROM customermasterhdr order by customergroup";
			//	echo $sql; die;
				$activitydata['datacustomermaster']=$this->dailyactivity_model->get_customers($sql);
			//	$viewdata = '['.$activitydata['dataitemmaster'].']'; 
				$viewdata = $activitydata['datacustomermaster']; 
		    		header('Content-Type: application/x-json; charset=utf-8');
				echo $viewdata;
			 }


			public function index1()
			{
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
						 	  $activitydata = array();
						 /* if ($this->session->userdata['reportingto']=="")
								{
									$activitydata['leaddetails'] = $this->Leads_model->get_lead_details_all();
									$activitydata['data']=$this->Leads_model->get_leaddetails_for_grid();
								}
								else
								{
									$activitydata['leaddetails'] = $this->Leads_model->get_lead_details($this->session->userdata['reportingto']);
									$activitydata['data']=$this->Leads_model->get_leaddetails_reporting_to_for_grid($this->session->userdata['reportingto']);
								}
								 $activitydata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
							 */ 
							$data = array();
						//	$leaddata['data']=$this->Leads_model->get_leaddetails_for_grid();
							$leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
							$i=0;
							$datagroup = array();					
							foreach($leaddata['permission'] as $key=>$val)
							{
								$row = array();

								$row["groupid"] = $key;
								$row["groupname"] = $val;
								$datagroup[$i] = $row;
								$i++;
							}

							$arr = json_encode($datagroup);
							$leaddata['grpperm'] =$arr;
					//  $this->load->view('leads/viewleadsnew',$leaddata);	
							$activitydata['datarow']=$this->dailyactivity_model->getactivity_data_row();
							$activitydata['datacolumn']=$this->dailyactivity_model->getactivity_data_column();

							//print_r($activitydata['datacolumn']);
							//print_r($activitydata['datarow']);

						$this->load->view('dailyactivity/viewdailyactivity1',$activitydata);	
						} 

						else
						{
						 			redirect('admin/index', 'refresh');
									//$this->load->view('leads/viewleads',$leaddata);	
						}
			}

			function additemmaster()
			{
				$createddate = date('Y-m-d:H:i:s');
				$lastupdatedate = date('Y-m-d:H:i:s');
				$creationuser = $this->session->userdata['identity'];
				$lastupdateuser ="";
				$execode = $this->session->userdata['empcode'];
				$exename = $this->session->userdata['identity'];
				$user1 = $this->session->userdata['loginname'];
				//echo"post values";print_r($_POST);
				//echo "current_date ".$_POST[0]['currentdate']; die;
				$hrd_currentdate = $_POST[0]['currentdate'];
                          $grid_data = array_slice($_POST, 1,null,true);
                      
                          //echo"the count a grid_data ".count($grid_data);
                       $check_duplicates = $this->dailyactivity_model->check_dailyhdr_duplicates($hrd_currentdate,$user1);
                     //  echo $check_duplicates; die;
                       if ($check_duplicates==0)
                       {
                       	if($_POST['save']=='true')
					{

						$daily_hdr_id= $this->dailyactivity_model->GetMaxVal('dailyactivityhdr');
						$daily_hdr_id=$daily_hdr_id+1;
						$daily_hdr = array('id' => $daily_hdr_id,
									'currentdate' => $hrd_currentdate,
									'execode' => $execode,
									'exename' => $exename,
									'companycode' => 'PPC',
									'accperiod' => '2013-2014',
									'user1' => $user1,
								//	'timestamp' => $this->input->post('lastname'),
									'creationuser' => $creationuser,
									'creationdate' => $createddate,
									'lastupdateuser' => $lastupdateuser
								//	'lastupdatedate' => $lastupdatedate

						);
						$daily_hdr_insert_status =$this->dailyactivity_model->save_dailyactivityhdr($daily_hdr);
	   				//	echo "return val is  ".$daily_hdr_insert_status;

							foreach($grid_data as $key=>$val)
							{
								 if($val['potentialqty']=="" || $val['potentialqty']=='undefined' ) 
								 {
									     	$val['potentialqty']=0;
								}
								 if($val['itemgroup']=="" || $val['itemgroup']=='undefined' ) 
								 {
									     	$val['itemgroup']=0;
								}
						           if($val['Remarks']=="" || $val['Remarks']=='undefined' ) 
								 {
									     	$val['Remarks']=0;
								}
								if($val['quantity']=="" || $val['quantity']=='undefined' ) 
								 {
									     	$val['quantity']=0;
								}
							
								$daily_dtl[$key]['id'] = $daily_hdr_id;
								$daily_dtl[$key]['date'] = $val['currentdate'];
								$daily_dtl[$key]['itemgroup'] = $val['itemgroup'];
								$daily_dtl[$key]['custgroup'] = $val['custgroup'];
								$daily_dtl[$key]['potentialqty'] = $val['potentialqty'];	
								$daily_dtl[$key]['subactivity'] = $val['subactivity'];	
								$daily_dtl[$key]['hour_s'] = $val['hour_s'];
								$daily_dtl[$key]['minit'] = $val['minit'];
								$daily_dtl[$key]['modeofcontact'] = $val['modeofcontact'];
								$daily_dtl[$key]['quantity'] = $val['quantity'];
								$daily_dtl[$key]['division'] = $val['division'];
								$daily_dtl[$key]['date'] = $val['Date'];
								$daily_dtl[$key]['remarks'] = $val['Remarks'];
								$daily_dtl[$key]['creationdate'] =date('Y-m-d:H:i:s');
								$daily_dtl[$key]['creationuser'] = $creationuser;
								$daily_dtl[$key]['description'] = $val['description'];
								$daily_dtl[$key]['actionplanned'] = $val['actionplanned'];
								$daily_dtl[$key]['detailed_description'] = $val['detailed_description'];
						
							}


	   					if ($daily_hdr_insert_status)
	   					{
							//	 print_r($daily_dtl);
								 
								 $daily_dlt_id =$this->dailyactivity_model->save_daily_details($daily_dtl);
	   					}
					}
				//	$message = "Daily Activity Created Successfully";
					$message = "true";
                       }
                       else
                       {
                       // echo "duplicate exists";	
                        $message = "Duplicate Record exists in the date ".$hrd_currentdate." for the executive ".$exename;
                       
                       }
                       header('Content-Type: application/x-json; charset=utf-8');
				echo $message;
					
				//$this->session->set_flashdata('message', "Daily Activity Created Successfully");
				//redirect('dailyactivity');

				 

				
		}

			function updateitemmaster()
			{
			//	print_r($_POST); 
				$createddate = date('Y-m-d:H:i:s');
				$lastupdatedate = date('Y-m-d:H:i:s');
				$creationuser = $this->session->userdata['identity'];
				$lastupdateuser =$this->session->userdata['identity'];
				$execode = $this->session->userdata['empcode'];
				$exename = $this->session->userdata['identity'];
				$user1 = $this->session->userdata['loginname'];
				//echo"post values";print_r($_POST);
				//echo "current_date ".$_POST[0]['currentdate']; die;
				$hrd_currentdate = $_POST[0]['currentdate'];
				$hdn_hdr_id = $_POST[0]['hdn_hdr_id'];
				
                          $grid_data = array_slice($_POST, 1,null,true);
                      
                          //echo"the count a grid_data ".count($grid_data);
                      
					//$get_update_id = $this->dailyactivity_model->get_dailyhdr_update_id($hrd_currentdate,$user1);
                       	$get_update_id=$hdn_hdr_id;
					$daily_dtl_delete_status =$this->dailyactivity_model->deteled_dailyactivitydtl($get_update_id);
					// $daily_dtl_delete_status =$this->dailyactivity_model->deteled_dailyactivitydtl(5);
					//      echo"no of rows deleted ".$daily_dtl_delete_status; 
	                       if ($daily_dtl_delete_status>0)
	                       {
		                       if($_POST['update']=='true')
							{

								//$daily_hdr_id= $this->dailyactivity_model->GetMaxVal('dailyactivityhdr');
								$daily_hdr_id=$get_update_id;
								$daily_hdr = array('id' => $daily_hdr_id,
											'currentdate' => $hrd_currentdate,
											'execode' => $execode,
											'exename' => $exename,
											'companycode' => 'PPC',
											'accperiod' => '2013-2014',
											'user1' => $user1,
										//	'timestamp' => $this->input->post('lastname'),
										//	'creationuser' => $creationuser,
										//	'creationdate' => $createddate,
											'lastupdateuser' => $lastupdateuser,
											'lastupdatedate' => $lastupdatedate

								);
								$daily_hdr_update_status =$this->dailyactivity_model->update_dailyactivityhdr($daily_hdr,$daily_hdr_id);
								
			   				//	echo "return val is  ".$daily_hdr_insert_status;

									foreach($grid_data as $key=>$val)
									{
									     	if($val['potentialqty']=="" || $val['potentialqty']=='undefined' ) 
									     {
									     	$val['potentialqty']=0;
									     }

										if($val['itemgroup']=="" || $val['itemgroup']=='undefined' ) 
										 {
											     	$val['itemgroup']=0;
										}
								           if($val['Remarks']=="" || $val['Remarks']=='undefined' ) 
										 {
											     	$val['Remarks']=0;
										}
										if($val['quantity']=="" || $val['quantity']=='undefined' ) 
										 {
											     	$val['quantity']=0;
										}
										$daily_dtl[$key]['id'] = $daily_hdr_id;
										$daily_dtl[$key]['date'] = $val['currentdate'];
										$daily_dtl[$key]['itemgroup'] = $val['itemgroup'];
										$daily_dtl[$key]['custgroup'] = $val['custgroup'];
										$daily_dtl[$key]['potentialqty'] = $val['potentialqty'];	
										$daily_dtl[$key]['subactivity'] = $val['subactivity'];	
										$daily_dtl[$key]['hour_s'] = $val['hour_s'];
										$daily_dtl[$key]['minit'] = $val['minit'];
										$daily_dtl[$key]['modeofcontact'] = $val['modeofcontact'];
										$daily_dtl[$key]['quantity'] = $val['quantity'];
										$daily_dtl[$key]['division'] = $val['division'];
										$daily_dtl[$key]['date'] = $val['Date'];
										$daily_dtl[$key]['remarks'] = $val['Remarks'];
										//$daily_dtl[$key]['creationdate'] =date('Y-m-d:H:i:s');
										//$daily_dtl[$key]['creationuser'] = $creationuser;
										$daily_dtl[$key]['lastupdatedate'] =date('Y-m-d:H:i:s');
										$daily_dtl[$key]['lastupdateuser'] = $creationuser;
										$daily_dtl[$key]['description'] = $val['description'];
										$daily_dtl[$key]['actionplanned'] = $val['actionplanned'];
										$daily_dtl[$key]['detailed_description'] = $val['detailed_description'];

								
									}


			   					if ($daily_hdr_update_status)
			   					{

									$daily_dlt_id =$this->dailyactivity_model->save_daily_details($daily_dtl);

			   					}

							}
							$message = "true";
					 }
					 else
					 {
					 	  $message = "Duplicate Record exists in the date ".$hrd_currentdate." for the executive ".$exename;
					 }
					  header('Content-Type: application/x-json; charset=utf-8');
					  echo $message;
		
			}

}
?>
