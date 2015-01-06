<?php

class Leads extends CI_Controller {

	public $data = array();
	public $post = array();
	public $proddata = array();
	public $leaddata = array();	
	public $loginuser;
  	public $userid;
	public $loginname;
	public $reportingto;
	public $countryid;
	public $stateid;
	public $login_user_id;
	public $prdetid;
	public $temp_custmaster_id;
  	public $datagroup = array();
  	public $last_word;

	function __construct()
	{
	 parent::__construct();
	 $this->load->library('admin_auth');
	 $this->lang->load('admin');
	 $this->load->database();
	 $this->load->helper('url');
	 $this->load->model('Leads_model');
   	 $this->load->library('subquery');
   	 $this->load->library('user_agent');
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
		

		 if (!$this->admin_auth->logged_in())
			{
				//redirect them to the login page
				redirect('admin/login', 'refresh');
			}
			elseif (!$this->admin_auth->is_admin())
			{
				
					$user = $this->admin_auth->user()->row();
				//	print_r($user);
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
   			//	print_r($usergroups);  die;
			 	  $leaddata = array();

          				if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['leaddetails'] = $this->Leads_model->get_lead_details_all();
						$leaddata['data']=$this->Leads_model->get_leaddetails_for_grid();
					}
					else
					{
						$leaddata['leaddetails'] = $this->Leads_model->get_lead_details($this->session->userdata['reportingto']);
						$leaddata['data']=$this->Leads_model->get_leaddetails_reporting_to_for_grid($this->session->userdata['reportingto']);
					}
				   $leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
				 
				$data = array();
			//	$leaddata['data']=$this->Leads_model->get_leaddetails_for_grid();
				//$leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
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


//					$this->load->view('leads/viewleadsnew',$leaddata);	
$this->load->view('leads/viewleadsnewsort',$leaddata);	
			}
			else
		  {
			 			redirect('admin/index', 'refresh');
						//$this->load->view('leads/viewleads',$leaddata);	
			}
	}

	public function convertedleads()
	{
		
		 if (!$this->admin_auth->logged_in())
			{
				//redirect them to the login page
				redirect('admin/login', 'refresh');
			}
			elseif (!$this->admin_auth->is_admin())
			{
				
					$user = $this->admin_auth->user()->row();
				//	print_r($user);
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
   			//	print_r($usergroups);  die;
			 	  $leaddata = array();

          				if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['leaddetails'] = $this->Leads_model->get_lead_converted_all();
						$leaddata['data']=$this->Leads_model->get_converted_for_grid();
					}
					else
					{
						$leaddata['leaddetails'] = $this->Leads_model->get_lead_details_converted($this->session->userdata['reportingto']);
						$leaddata['data']=$this->Leads_model->get_converted_reporting_to_for_grid($this->session->userdata['reportingto']);
					}
				   $leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
				 
				$data = array();
			//	$leaddata['data']=$this->Leads_model->get_leaddetails_for_grid();
				//$leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
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


//					$this->load->view('leads/viewleadsnew',$leaddata);	
		  	$this->load->view('leads/viewleadsconverted',$leaddata);	
			}
			else
		  {
			 			redirect('admin/index', 'refresh');
						//$this->load->view('leads/viewleads',$leaddata);	
			}
	}


	public function add()
	{
			if (!$this->admin_auth->logged_in())
			{
				//redirect them to the login page
				redirect('admin/login', 'refresh');
			}
			if (isset($_SERVER['HTTP_REFERER']))
			{
				 $reffer=@$_SERVER['HTTP_REFERER'];
				preg_match("/[^\/]+$/", $reffer, $matches);
			@$last_word = $matches[0];
			}
			else
			{
				$last_word="";
			}
		

//echo "last word is ".@$last_word; die;
		/*http://10.1.2.40/salescrm/ http://10.1.2.40/salescrm/dailycall */
		
  //  echo"Rep To ".$this->session->userdata['reportingto'];
		$this->load->helper(array('form', 'url'));
                
               
		$data = $this->Leads_model->get_leadstatus_add();
                		
//
//		$data['optionscrd'] = $this->Leads_model->get_leadcredit_assment();
//		$data['optionslsr'] = $this->Leads_model->get_leadsource();
//		$data['optionscmp'] = $this->Leads_model->get_all_company();
//		$data['optionscnt'] = $this->Leads_model->get_country();
//		$data['optionsinds'] = $this->Leads_model->get_industry();

		$data['optionsexp'] = $options = array(
													 ''  => 'Select Option',
													'EOU'  => 'EOU',
													'Domestic'    => 'Domestic',
													'Domestic and EOU'   => 'Domestic and EOU'
												  );
		$data['optionsprestsrc'] = $options = array(
													 ''  => 'Select Option',
													'Import'  => 'Import',
													'Domestic'    => 'Domestic',
													'Domestic and Import'    => 'Domestic and Import'
												  );
 		if (@$this->session->userdata['reportingto']=="")
		{
			$data['optionsasto'] = $this->Leads_model->get_assignto_users();
			$data['optionslocuser'] = $this->Leads_model->get_locationuser_add();
		}
		else
		{
//			$data['optionsasto'] = $this->Leads_model->get_assignto_users_order($this->session->userdata['reportingto']);
			$data['optionsasto'] = $this->Leads_model->get_assignto_users_order($this->session->userdata['reportingto']);
			$data['optionslocuser'] = $this->Leads_model->get_locationuser_add_order();

		}
		$data['reffer_page']=$last_word;
	  	$this->load->view('leads/leadsaddnew',$data);
	 // 	$this->load->view('leads/leads',$data);
		
	}

	public function adddcproduct($customer_id)
	{
			if (!$this->admin_auth->logged_in())
			{
				//redirect them to the login page
				redirect('admin/login', 'refresh');
			}
			if (isset($_SERVER['HTTP_REFERER']))
			{
				
				$reffer=@$_SERVER['HTTP_REFERER']; 
				 //http://10.1.2.40/salescrm/dailycall/customerdetails/21336/0
				preg_match("/[^\/]+$/", $reffer, $matches);
				//print_r($matches);
			@$last_word = $matches[0];
			// echo"last word ".$last_word;
			 
			}
			else
			{
				$last_word="";
			}
		
		
//echo "last word is ".@$last_word; die;
		/*http://10.1.2.40/salescrm/ http://10.1.2.40/salescrm/dailycall */
		
  //  echo"Rep To ".$this->session->userdata['reportingto'];
		$this->load->helper(array('form', 'url'));
		$data['optionslst'] = $this->Leads_model->get_leadstatus_add();
		

		$data['optionslsr'] = $this->Leads_model->get_leadsource();
//		$data['optionscmp'] = $this->Leads_model->get_company();
//		$leaddata['optionscmp'] = $this->Leads_model->get_all_company();
		$data['customerinfo'] = $this->Leads_model->get_customerdetails($customer_id);
      	
            
			$company_id=$data['customerinfo'][0]['company'];
			$industry_id=$data['customerinfo'][0]['industry_id'];
			
			if (strlen($data['customerinfo'][0]['country']>2))
			{
				$countryid =  $this->Leads_model->get_country_idbyname(strtolower($data['customerinfo'][0]['country']));
			}
			else
			{
				$countryid = $data['customerinfo'][0]['country'];
			}
			$countryid."<br>";
			$stateid =  $this->Leads_model->get_state_idbyname(strtolower($data['customerinfo'][0]['state']));
			
			$data['customerinfo'][0]['country']=$countryid;
			$data['customerinfo'][0]['state']=$stateid;
			$data['customerinfo'][0]['city']=$this->Leads_model->get_city_byname(strtolower($data['customerinfo'][0]['city']));

			/*$leadstusid =  $leaddata['customerinfo'][0]['leadstatusid'];
			$leadstus_order_id =  $leaddata['customerinfo'][0]['order_by'];
			$lst_order_by_id =  $leaddata['customerinfo'][0]['lst_order_by'];
			$lst_parentid_id =  $leaddata['customerinfo'][0]['lst_parentid'];
			$userbranch =  $leaddata['customerinfo'][0]['user_branch'];
			$countryid =  $leaddata['customerinfo'][0]['country'];
			$substatusid =  $leaddata['customerinfo'][0]['ldsubstatus'];*/
			$data['optionsst'] = $this->Leads_model->get_states_edit($countryid);
			$data['optionsct'] = $this->Leads_model->get_city_edit($stateid);










		//print_r($data['customerinfo']); 

		$data['optionscmp'] = $this->Leads_model->get_all_company();
		$data['optionsinds'] = $this->Leads_model->get_industry();

		$data['optionscnt'] = $this->Leads_model->get_country();
		$data['optionsinds'] = $this->Leads_model->get_industry();
		$data['optionsexp'] = $options = array(
													 ''  => 'Select Option',
													'EOU'  => 'EOU',
													'Domestic'    => 'Domestic',
													'Domestic and EOU'   => 'Domestic and EOU'
												  );
		$data['optionsprestsrc'] = $options = array(
													 ''  => 'Select Option',
													'Import'  => 'Import',
													'Domestic'    => 'Domestic',
													'Domestic and Import'    => 'Domestic and Import'
												  );
 		if (@$this->session->userdata['reportingto']=="")
		{
			$data['optionsasto'] = $this->Leads_model->get_assignto_users();
			$data['optionslocuser'] = $this->Leads_model->get_locationuser_add();
		}
		else
		{
//			$data['optionsasto'] = $this->Leads_model->get_assignto_users_order($this->session->userdata['reportingto']);
			$data['optionsasto'] = $this->Leads_model->get_assignto_users_order($this->session->userdata['reportingto']);
			$data['optionslocuser'] = $this->Leads_model->get_locationuser_add_order();

		}
		$data['reffer_page']='dailycall';
	  	$this->load->view('leads/leadsadddaily',$data);
	 // 	$this->load->view('leads/leads',$data);
		
		
	}


	function edit($id)
	{
 		$this->session->set_userdata('run_time_lead_id',$id); 
	
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
	               
	           	 }   

			if ($this->session->userdata['reportingto']=="")
			{
			 	$leaddata['leaddetails'] = $this->Leads_model->get_lead_edit_details_all($id);
			}
			else
			{
				$leaddata['leaddetails'] = $this->Leads_model->get_lead_edit_details($id);
			}
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

    //print_r($leaddata['leaddetails']); $customer_id=$leaddata['leaddetails'][0]['customer_id'];  echo "customer id ".$customer_id; die;
				
		//	$customer_id=$leaddata['leaddetails'][0]['customer_id'];
			$crd_name=$leaddata['leaddetails'][0]['crd_assesment'];
			$crd_id=$leaddata['leaddetails'][0]['crd_id'];
			$company_id=$leaddata['leaddetails'][0]['company'];
			$leadstusid =  $leaddata['leaddetails'][0]['leadstatusid'];
			$leadstus_order_id =  $leaddata['leaddetails'][0]['order_by'];
			$lst_order_by_id =  $leaddata['leaddetails'][0]['lst_order_by'];
			$lst_parentid_id =  $leaddata['leaddetails'][0]['lst_parentid'];
			$userbranch =  $leaddata['leaddetails'][0]['user_branch'];
			$countryid =  $leaddata['leaddetails'][0]['country'];
			$substatusid =  $leaddata['leaddetails'][0]['ldsubstatus'];
			

			$stateid =  $leaddata['leaddetails'][0]['state'];
			$leaddata['optionslst'] = $this->Leads_model->get_leadstatus_edit($leadstusid,$leadstus_order_id);
			$leaddata['optionslsr'] = $this->Leads_model->get_leadsource();
			$leaddata['optionscrd'] = $this->Leads_model->get_leadcredit_assment();
	//		$leaddata['optionscmp'] = $this->Leads_model->get_company();
			$leaddata['optionscmp'] = $this->Leads_model->get_all_company();
			$leaddata['optionscnt'] = $this->Leads_model->get_country();
		    $leaddata['optionsinds'] = $this->Leads_model->get_industry();
		    $leaddata['optionsexp'] = $options = array(
													 ''  => 'Select Option',
													'EOU'  => 'EOU',
													'Domestic'    => 'Domestic',
													'Domestic and EOU'   => 'Domestic and EOU'
												  );
		$leaddata['optionsprestsrc'] = $options = array(
													 ''  => 'Select Option',
													'Import'  => 'Import',
													'Domestic'    => 'Domestic',
													'Domestic and Import'   => 'Domestic and Import'
												  );
			$leaddata['optionsst'] = $this->Leads_model->get_states_edit($countryid);
//			$leaddata['optionslsubst'] = $this->Leads_model->get_substatus_edit($substatusid);
			$leaddata['optionslsubst'] = $this->Leads_model->get_substatus_edit_all($substatusid,$lst_parentid_id,$lst_order_by_id);
			$leaddata['optionsct'] = $this->Leads_model->get_city_edit($stateid);
			if ($this->session->userdata['reportingto']=="")
			{
				$leaddata['optionsasto'] = $this->Leads_model->get_assignto_users();
				$leaddata['optionslocuser'] = $this->Leads_model->get_locationuser_add();
				
			}
			else
			{
			$leaddata['optionslocuser'] = $this->Leads_model->get_locationuser_add_order();
//				$leaddata['optionsasto'] = $this->Leads_model->get_assignto_users_order($this->session->userdata['reportingto']);
			$leaddata['optionsasto'] = $this->Leads_model->get_assignto_users_order_edit($this->session->userdata['reportingto'],$userbranch);

			}

			$leaddata['leadproducts'] = $this->Leads_model->get_lead_product_details($id);
			//$leaddata['leadproducts'] = $this->Leads_model->get_lead_product_details_alltypes($id);
			//echo "product id ".$leaddata['leadproducts'][0]['productid'];
			$product_name= $this->Leads_model->get_productname($leaddata['leadproducts'][0]['productid']); 

			$leaddata['optionsproedit'] = $this->Leads_model->get_products_edit();
			$leaddata['optionsprotypeedit'] = $this->Leads_model->get_products_dispatch();

			//$leaddata['data']=$this->Leads_model->get_synched_products($customer_id);
			$leaddata['data']=$this->Leads_model->get_synched_products($company_id,$product_name);
			
			//print_r($leaddata['data']); die;
		//	  $this->load->view('leads/editleads',$leaddata);	
	  	$this->load->view('leads/editleadsnew',$leaddata);	
		
	
		
		
	}
	
	/*function getleadsstatus()
	{
		
		$data['options'] = $this->Leads_model->get_leadstatus();
		$this->load->view('leads/leads',$data);
	}*/
	function getleadssource()
	{
		
		$data['options'] = $this->Leads_model->get_leadssource();
		$this->load->view('leads/leads',$data);
	}

	function getproducts()
	{
		$data = array();
		$data=$this->Leads_model->get_products();
		print_r($data);

	}

	

	function getcompanyjson()
	{
		$data = array();
		$data=$this->Leads_model->get_all_company_json();
		print_r($data);

	}
	function getdispatch()
	{
		$data = array();
		$data=$this->Leads_model->get_dispatch();
		print_r($data);

	}
	function getinitial_lead_sub()
	{
		$data = array();
		$data=$this->Leads_model->get_getinitial_lead_sub();
		print_r($data);

	}
	function getstates($country_id)
	{
		$this->Leads_model->country_id = $country_id;
		$states = $this->Leads_model->get_states();
		header('Content-Type: application/x-json; charset=utf-8');
		echo json_encode($states);
	}

  function getleadsubstatus($parent_id)
	{

		$this->Leads_model->parent_id = $parent_id;
   
		$substatus = $this->Leads_model->get_leadsubstatus();
		header('Content-Type: application/x-json; charset=utf-8');
		echo json_encode($substatus);
	}
	function getleadsubstatusadd($parent_id)
	{

		$this->Leads_model->parent_id = $parent_id;
   
		$substatus = $this->Leads_model->get_leadsubstatus_add();
		header('Content-Type: application/x-json; charset=utf-8');
		echo json_encode($substatus);
	}

	function getassignedtobranch($brach_sel)
	{

		$this->Leads_model->brach_sel = $brach_sel;
   
		$substatus = $this->Leads_model->get_assigned_tobranch();
		header('Content-Type: application/x-json; charset=utf-8');
		echo json_encode($substatus);
	}



	function getcities($state_id)
	{
		$this->Leads_model->state_id = $state_id;
		$cities = $this->Leads_model->get_cities();
		header('Content-Type: application/x-json; charset=utf-8');
		echo json_encode($cities);
	}

	function savelead()
	{
 

	$dte  =$this->input->post('uploaded_date');
	$reffer_page =$this->input->post('hdn_refferer');  //dailycall
	
	$dt   = new DateTime();
	$date = $dt->createFromFormat('d/m/Y', $dte);
	$dates = $date->format('Y-m-d');
	$time=date('H:i:s');
	$uploaded_time = $dates." ".$time;
//echo" uploaded_time ".$uploaded_time."<br>";
//	echo"current date and time ".date('Y-m-d:H:i:s')."<br>";



	 echo"<pre>";print_r($_POST);   echo"</pre>"; 
		$hdn_grid_row_data = json_decode($_POST['hdn_grid_row_data'],TRUE);
		echo" hdn_grid_row_data <pre>";print_r($hdn_grid_row_data);   echo"</pre>"; 
	 	
	 die();
		$customFieldPoten =array();


		if( $this->input->post('saveleads') || $this->input->post('hdn_saveleads'))
		{
		       $login_user_id = $this->session->userdata['user_id'];
			 $login_username = $this->session->userdata['username'];

			 
			$duser = $this->session->userdata['loginname'];
			//$lead_seq1= $this->Leads_model->GetNextSeqVal('leaddetails_leadid_seq');
			//$lead_seq1= $this->Leads_model->GetCurrSeqVal('leaddetails_leadid_seq');


			
		//	echo " lead_seq1 ".$lead_seq1; die;
			$lead_status_name= $this->Leads_model->GetLeadStatusName($this->input->post('leadstatus'));
			$lead_sub_status_name = $this->Leads_model->GetLeadSubStatusName($this->input->post('leadsubstatus'));

			$assign_to_array = $this->Leads_model->GetAssigntoName($this->input->post('assignedto'));
			$lead_assign_name= $assign_to_array['0']['location_user']."-".$assign_to_array['0']['aliasloginname'];
			$duser = $assign_to_array['0']['duser'];
			

			$cust_account_id = $this->Leads_model->CheckNewCustomer($this->input->post('company')); 
		
			$lead_seq1= $this->Leads_model->GetMaxVal('leaddetails','leadid');
			$lead_seq1 = $lead_seq1+1;
		 	
		 	
			$lead_src = $this->Leads_model->GetLeadSourceVal($this->input->post('leadsource'));
			 $lead_crd = $this->Leads_model->GetLeadCredit($this->input->post('credit_assesment'));
			
//			$lead_no = $lead_no = 'LEAD'.$lead_seq1;
			$lead_no = 'LEAD-'.$lead_src;
			$customer_id = $this->Leads_model->GetTempCustId($this->input->post('company')); 
			$customer_details = $this->Leads_model->GetCustomerdetails($this->input->post('company')); 

			$customer_number =$customer_details['customer_number'];	
			$customer_name =$customer_details['customer_name'];	
		
			if($customer_details['customergroup']!="")
			{
				$customergroup = $customer_details['customergroup'];	
			}
			else
			{
				$customergroup = $customer_details['tempcustname'];		
			}
			
			 if($this->input->post('presentsource')=="Domestic and Import" || $this->input->post('presentsource')=="Domestic")
			{
				$domestic_supplier_name  =trim($this->input->post('txtDomesticSource'));
			}
			else
			{
				$domestic_supplier_name  ="";
			}

		 	if ($this->input->post('designation')=="")
			{
				 $leaddetails = array('lead_no' => $lead_no,
								'leadstatus' => $this->input->post('leadstatus'),
								'company' => $this->input->post('company'),
								'customer_id' => $customer_id,
								'email_id' => trim($this->input->post('email_id')),
								'firstname' => $this->input->post('firstname'),
								'industry_id' => $this->input->post('industry'),
								'lastname' => $this->input->post('lastname'),
								'uploaded_date' => $uploaded_time,
								'leadsource' => $this->input->post('leadsource'),
								//'designation' => $this->input->post('designation'),
								'crd_id' => $this->input->post('credit_assesment'),
								'crd_assesment' => $lead_crd,
								'ldsubstatus' => $this->input->post('leadsubstatus'),
								'assignleadchk' => $this->input->post('assignedto'),
								'user_branch' => $this->input->post('branch'),
								'description' => trim($this->input->post('description')),
								'comments' => trim($this->input->post('comments')),
								'producttype' => trim($this->input->post('producttype')),
								'exporttype' => trim($this->input->post('exportdomestic')),
								'presentsource' => trim($this->input->post('presentsource')),
								'decisionmaker' => trim($this->input->post('purchasedecision')),
								'domestic_supplier_name' =>$domestic_supplier_name,
								'createddate' => date('Y-m-d:H:i:s'),
								'last_modified' => date('Y-m-d:H:i:s'),
								'created_user' => $login_user_id

					);
			}
			else
			{
				 $leaddetails = array('lead_no' => $lead_no,
								'leadstatus' => $this->input->post('leadstatus'),
								'company' => $this->input->post('company'),
								'customer_id' => $customer_id,
								'email_id' => trim($this->input->post('email_id')),
								'firstname' => $this->input->post('firstname'),
								'industry_id' => $this->input->post('industry'),
								'lastname' => $this->input->post('lastname'),
								'uploaded_date' => $uploaded_time,
								'leadsource' => $this->input->post('leadsource'),
								'designation' => $this->input->post('designation'),
								'crd_id' => $this->input->post('credit_assesment'),
								'crd_assesment' => $lead_crd,
								'ldsubstatus' => $this->input->post('leadsubstatus'),
								'assignleadchk' => $this->input->post('assignedto'),
								'user_branch' => $this->input->post('branch'),
								'description' => trim($this->input->post('description')),
								'comments' => trim($this->input->post('comments')),
								'producttype' => trim($this->input->post('producttype')),
								'exporttype' => trim($this->input->post('exportdomestic')),
								'presentsource' => trim($this->input->post('presentsource')),
								'decisionmaker' => trim($this->input->post('purchasedecision')),
								'domestic_supplier_name' =>$domestic_supplier_name,
								'createddate' => date('Y-m-d:H:i:s'),
								'last_modified' => date('Y-m-d:H:i:s'),
								'created_user' => $login_user_id

					);
			}

             		/*	$leadaddress = array('leadaddressid' => $lead_seq1,
								'city' => $this->input->post('city'),
								'street' => $this->input->post('street'),
								'state' => $this->input->post('state'),
								'pobox' => $this->input->post('postalcode'),
								'country' => $this->input->post('country'),
								'mobile_no' => $this->input->post('mobile'),
								'phone' => $this->input->post('phone'),
								'fax' => $this->input->post('fax'),  
								'created_date' => date('Y-m-d:H:i:s'),
								'created_user' => $login_user_id
	            			 
						);*/


				$proddata = array();
				$potential_updated = array();
				$lead_prod_poten_type =array();
				$lead_customer_pontential=array();
				$k=0;

				foreach($hdn_grid_row_data as $key=>$val)
				{

					if($hdn_grid_row_data[$key]['product_id']!="")
					{
						 $lead_id =$this->Leads_model->save_lead($leaddetails);
						 if($lead_id>0)
			  			 {

			  			 	$leadaddress = array('leadaddressid' => $lead_id,
													'city' => $this->input->post('city'),
													'street' => $this->input->post('street'),
													'state' => $this->input->post('state'),
													'pobox' => $this->input->post('postalcode'),
													'country' => $this->input->post('country'),
													'mobile_no' => $this->input->post('mobile'),
													'phone' => $this->input->post('phone'),
													'fax' => $this->input->post('fax'),  
													'created_date' => date('Y-m-d:H:i:s'),
													'created_user' => $login_user_id
												);
							//echo"<pre>leadaddress ";print_r($leadaddress);echo"</pre>";	
							$addid = $this->Leads_model->save_lead_address($leadaddress);

							//echo"key ".$key."<br>";
							
								$itemgroup_name= $this->Leads_model->GetItemgroup($hdn_grid_row_data[$key]['product_id']);
								if($itemgroup_name['itemgroup']!="")
								{
									$itemgroup_name=$itemgroup_name['itemgroup'];
								}
								else
								{
									$itemgroup_name=$itemgroup_name['description'];
								}
								if ($hdn_grid_row_data[$key]['requirment']=="")
								{
									$hdn_grid_row_data[$key]['requirment']=0;
								}
							     $leadproducts = array('leadid' => $lead_id,
													'productid' =>$hdn_grid_row_data[$key]['product_id'],
													'quantity' => $hdn_grid_row_data[$key]['requirment'],
													'created_date' => date('Y-m-d:H:i:s'),
													'created_user' => $login_user_id
												);
							     	$proddata[$key]['leadid'] = $lead_id;
								$proddata[$key]['productid'] = $hdn_grid_row_data[$key]['product_id'];
								
  							//echo"<pre>leadproducts ";print_r($leadproducts);echo"</pre>";	 						
							$prdetid = $this->Leads_model->save_lead_products_all($leadproducts);
							

							if($hdn_grid_row_data[$key]['product_id']!='')
							{

								/* start for inserting other prodtype in lead_prod_potential_types */

								$producttypeid = array("0"=>"173794", "1"=>"1","2"=>"681046","3"=>"173795","4"=>"3","5"=>"681045");
								$potential_cat_type = array("0"=>"bulk", "1"=>"repack","2"=>"small_packing","3"=>"intact","4"=>"part_tanker","5"=>"single_tanker");
									$lpid_seq= $this->Leads_model->GetNextlpid($lead_id);
								 $lpid_seq = $lpid_seq;
								 for($k=0;$k<=5;$k++) 
								 {

								 	//echo "lpid_seq ".$lpid_seq."<br>";
								 	$lead_prod_poten_type[$k]['leadid']=$lead_id;
								 	$lead_prod_poten_type[$k]['productid']=$hdn_grid_row_data[$key]['product_id'];
					 				$lead_prod_poten_type[$k]['product_type_id']=$producttypeid[$k];
					 				if($hdn_grid_row_data[$key][$potential_cat_type[$k]]!="")
					 				{
					 					$lead_prod_poten_type[$k]['potential']=$hdn_grid_row_data[$key][$potential_cat_type[$k]];
					 				}
					 				else
					 				{
					 				$lead_prod_poten_type[$k]['potential']=0;
					 				}
						 			

								 }
								// echo"<pre>lead_prod_poten_type ";print_r($lead_prod_poten_type);echo"</pre>";
								   $lead_pord_poten_id =$this->Leads_model->save_leadprodpotentypes($lead_prod_poten_type);
							
								 $k=0;
								// die;
								/* end for inserting other prodtype in lead_prod_potential_types */

								/* Start for potential_update table 
									Single - Tanker		681045
									Repack				1
									Bulk			     173794
									Small Packing	    681046
									Intact	               173795
									Part Tanker	    3
									*/
											
								/*End for Potential update table */
								//echo " saved_business_cat ".$saved_business_cat = trim($business_cat)."<br>";
								//echo " saved_business_cat  len " .strlen($business_cat)."<br>";
								/* start for inserting other business type in Potential update table */
								$business_cat_type = array("0"=>"BULK", "1"=>"REPACK","2"=>"SMALL PACKING","3"=>"INTACT","4"=>"PART TANKER","5"=>"SINGLE - TANKER");

								 for($m=0;$m<=5;$m++) 
								 {
								 	//echo "lpid_seq ".$lpid_seq."<br>";
								 	
										$lead_customer_pontential[$m]['id']= $lead_id;
										$lead_customer_pontential[$m]['line_id']= $lpid_seq;
										$lead_customer_pontential[$m]['user1'] = strtoupper($duser);
										$lead_customer_pontential[$m]['customergroup']= $customergroup;
										$lead_customer_pontential[$m]['itemgroup']= $itemgroup_name;

										$lead_customer_pontential[$m]['customer_number']= $customer_number;
										$lead_customer_pontential[$m]['customer_name']= $customer_name;

										$lead_customer_pontential[$m]['types'] ="LEAD";
										$lead_customer_pontential[$m]['collector'] = $this->input->post('branch');  
										$lead_customer_pontential[$m]['lead_created_date'] = date('Y-m-d:H:i:s');
										$lead_customer_pontential[$m]['user_code'] = $this->input->post('assignedto');
						 				$lead_customer_pontential[$m]['businesscategory']=$business_cat_type[$m];
								 		if($hdn_grid_row_data[$key][$potential_cat_type[$m]]!="")
								 		{
								 			//echo"in if ---";
								 			$lead_customer_pontential[$m]['yearly_potential_qty']=($hdn_grid_row_data[$key][$potential_cat_type[$m]] * 12);


								 		}
								 		else
								 		{
								 			//echo"in else --- ";
								 			$lead_customer_pontential[$m]['yearly_potential_qty']=0;
								 		}
								 		
								 	

								 }
								 $m=0;
								//  echo"<pre>lead_customer_pontential ";print_r($lead_customer_pontential);echo"</pre>";
								 $lead_pord_poten_id =$this->Leads_model->save_leadcustomer_potential_update($lead_customer_pontential);
								
								   /* end for inserting other business in Potential update table */
 						
							}
				    			

			   			}




/* log details*/
									$lead_log_details = array('lh_lead_id' => $lead_id,
												'lh_user_id' => $login_user_id,
												'lh_lead_curr_status' => $lead_status_name,
												'lh_lead_curr_statusid' => $this->input->post('leadstatus'),
												'lh_created_date' => date('Y-m-d:H:i:s'),
												'lh_created_user' => $login_user_id,
												'lh_comments' => $this->input->post('comments'),
												'action_type'=> 'Insert',
												'created_user_name'=> $login_username,
												'assignto_user_id '=> $this->input->post('assignedto'),
												'assignto_user_name'=> $lead_assign_name
											);
						 $logid = $this->Leads_model->create_leadlog($lead_log_details);

				  	       $lead_sublog_details = array(
												'lhsub_lh_id' => $logid,
												'lhsub_lh_lead_id' => $lead_id,
												'lhsub_lh_user_id' => $login_user_id,
												'lhsub_lh_lead_curr_status' => $lead_status_name,
												'lhsub_lh_lead_curr_statusid' => $this->input->post('leadstatus'),
												'lhsub_lh_lead_curr_sub_status' => $lead_sub_status_name,
												'lhsub_lh_lead_curr_sub_statusid' => $this->input->post('leadsubstatus'),
												'lhsub_lh_comments' => $this->input->post('comments'),
												'lhsub_lh_created_date' => date('Y-m-d:H:i:s'),
												'lhsub_lh_created_user' => $login_user_id,
												'lhsub_action_type'=> 'Insert',
												'lhsub_created_user_name'=> $login_username,
												'lhsub_assignto_user_id '=> $this->input->post('assignedto'),
												'lhsub_assignto_user_name'=> $lead_assign_name
											);
            
					 
					  $sublogid = $this->Leads_model->create_lead_sublog($lead_sublog_details);
/* end log details*/

						$temp_itemmaster_id = $this->Leads_model->update_tempitemmaster_leadid($lead_id,$proddata,$login_user_id);
					} // end of customFieldName //
				
				}
				//echo"<pre>";print_r($leadproducts);echo"</pre>";


				//$prdetid = $this->Leads_model->save_lead_products($proddata);
				//$prdetid = $this->Leads_model->save_lead_products_all($proddata);
				
				//$prdpoten = $this->Leads_model->save_potential_update($potential_updated);
				if ($prdetid>0)
							{
							  $message="Saved lead with products";
							}
							else
							{
							  $message="";						
							}
		

			  
				//  echo"last inserted id ".$lead_id;
 					if ($addid>0)
						{
						  $message="Saved Lead details ";
						}
					  else
						{
						  $message="";						
						}
					// 	redirect('leads');

						 $custmastrhdr = array(
													'executivename' => $lead_assign_name,
													'execode' => $this->session->userdata['loginname']
												);
				// before updating customermaster check if it is only a new customer.
						if($cust_account_id == "")
						{
							$temp_custmasterhdr_id = $this->Leads_model->update_custmastrhdr_assignto($this->input->post('assignedto'),$this->input->post('company')); 
						}
						//$temp_custmaster_id = $this->Leads_model->update_tempcustmaster_leadid($lead_id,$this->input->post('company'),$login_user_id);
      			 		

							

						$this->session->set_flashdata('message', "Lead Created Successfully");
						//echo "ref page ".$reffer_page; 		echo $url =base_url();
						
					 	if($reffer_page=="dailycall")
					 	{
							redirect($url.'dailycall');
					 	}
					 	else
					 	{
							redirect('leads');	
					 	}
					 	
				 
	    }

		
	}	
	function saveleaddailycall()
	{
 
	//	$update = DateTime::createFromFormat('d/m/Y',$this->input->post('uploaded_date'));
/*
	$dates = date('Y-m-d', strtotime('26/12/2013'));
	echo"date ".$dates; 
	$time=date('h:i:s');
	$uploaded_time = $dates." ".$time;
		//echo"changed format ".$dates->format('Y-m-d');
	echo" uploaded_time ".$uploaded_time."<br>";
	echo"current date and time ".date('Y-m-d:H:i:s')."<br>";
	*/

	$dte  =$this->input->post('uploaded_date');
	$from_leadpage  =$this->input->post('from_leadpage');
	$hdncustomer_id= $this->input->post('hdncustomer_id');
	$reffer_page =$this->input->post('hdn_refferer');  //dailycall
	
	$dt   = new DateTime();
	$date = $dt->createFromFormat('d/m/Y', $dte);
	$dates = $date->format('Y-m-d');
	$time=date('H:i:s');
	$uploaded_time = $dates." ".$time;
//echo" uploaded_time ".$uploaded_time."<br>";
//	echo"current date and time ".date('Y-m-d:H:i:s')."<br>";


	// echo"<pre>";print_r($_POST);   echo"</pre>"; die;

//print_r($_POST); 
		if($this->input->post('saveleads'))
		{
		       $login_user_id = $this->session->userdata['user_id'];
			$login_username = $this->session->userdata['username'];
			$lead_seq1= $this->Leads_model->GetNextSeqVal('leaddetails_leadid_seq');
			$lead_status_name= $this->Leads_model->GetLeadStatusName($this->input->post('leadstatus'));
			$lead_sub_status_name = $this->Leads_model->GetLeadSubStatusName($this->input->post('leadsubstatus'));
						
			$assign_to_array = $this->Leads_model->GetAssigntoName($this->input->post('assignedto'));
			$lead_assign_name= $assign_to_array['0']['location_user']."-".$assign_to_array['0']['aliasloginname'];
			$duser = $assign_to_array['0']['duser'];

			$cust_account_id = $this->Leads_model->CheckNewCustomer($this->input->post('company')); 
		

		 	$lead_seq1 = $lead_seq1+1;
			$lead_src = $this->Leads_model->GetLeadSourceVal($this->input->post('leadsource'));
//			$lead_no = $lead_no = 'LEAD'.$lead_seq1;
			$lead_no = 'LEAD-'.$lead_src;
			$customer_id = $this->Leads_model->GetTempCustId($this->input->post('company')); 
			 if($this->input->post('presentsource')=="Domestic and Import" || $this->input->post('presentsource')=="Domestic")
			{
				$domestic_supplier_name  =trim($this->input->post('txtDomesticSource'));
			}
			else
			{
				$domestic_supplier_name  ="";
			}
/*
	[producttype] => Microcarbon
    [exportdomestic] => EOU
    [purchasedecision] => Manager
    [presentsource] => Import
    [txtDomesticSource] => 
*/
		  $leaddetails = array('lead_no' => $lead_no,
								'leadstatus' => $this->input->post('leadstatus'),
								'company' => $this->input->post('company'),
								'customer_id' => $customer_id,
								'email_id' => trim($this->input->post('email_id')),
								'firstname' => $this->input->post('firstname'),
								'industry_id' => $this->input->post('industry'),
								'lastname' => $this->input->post('lastname'),
								'uploaded_date' => $uploaded_time,
								'leadsource' => $this->input->post('leadsource'),
								'ldsubstatus' => $this->input->post('leadsubstatus'),
								'assignleadchk' => $this->input->post('assignedto'),
								'user_branch' => $this->input->post('branch'),
								'description' => trim($this->input->post('description')),
								'comments' => trim($this->input->post('comments')),
								'producttype' => trim($this->input->post('producttype')),
								'exporttype' => trim($this->input->post('exportdomestic')),
								'presentsource' => trim($this->input->post('presentsource')),
								'decisionmaker' => trim($this->input->post('purchasedecision')),
								'domestic_supplier_name' =>$domestic_supplier_name,
								'createddate' => date('Y-m-d:H:i:s'),
								'last_modified' => date('Y-m-d:H:i:s'),
								'created_user' => $login_user_id

					);

             $leadaddress = array('leadaddressid' => $lead_seq1,
								'city' => $this->input->post('city'),
								'street' => $this->input->post('street'),
								'state' => $this->input->post('state'),
								'pobox' => $this->input->post('postalcode'),
								'country' => $this->input->post('country'),
								'mobile_no' => $this->input->post('mobile'),
								'phone' => $this->input->post('phone'),
								'fax' => $this->input->post('fax'),  
								'created_date' => date('Y-m-d:H:i:s'),
								'created_user' => $login_user_id
	            			 
						);


				$proddata = array();
				foreach($_POST['customFieldName'] as $key=>$val)
				{
					if ($_POST['customFieldName'][$key]!="")
					{
						$lpid_seq= $this->Leads_model->GetNextSeqVal('leadproducts_lpid_seq');
						$lpid_seq = $lpid_seq+1;
						$proddata[$key]['lpid'] = $lpid_seq;
						$proddata[$key]['leadid'] = $lead_seq1;
						//$proddata[$key]['productid'] = $_POST['customFieldName'][$key];
						$proddata[$key]['productid'] = $_POST['hdncustomFieldName'][$key];

						$proddata[$key]['quantity'] = $_POST['customFieldValue'][$key];
						$proddata[$key]['potential'] = $_POST['customFieldPoten'][$key];
						$proddata[$key]['annualpotential'] = ($_POST['customFieldPoten'][$key] * 12);

						if(empty($_POST['customFieldValue'][$key]))
						{
						$proddata[$key]['quantity']=0;
						}
						else
						{
						$proddata[$key]['quantity'] = $_POST['customFieldValue'][$key];
						}

						if($_POST['customFieldPoten'][$key]=="")
						{
						$proddata[$key]['potential']=0;
						}
						else
						{
						$proddata[$key]['potential'] = $_POST['customFieldPoten'][$key];
						}

						$proddata[$key]['prod_type_id'] = $_POST['customDispatch'][$key];
						$proddata[$key]['created_date'] = date('Y-m-d:H:i:s');
						$proddata[$key]['created_user'] = $login_user_id;
					}
					
				
				}
	 
		  	   $lead_id =$this->Leads_model->save_lead($leaddetails);
		

			   if($lead_id>0)
			   {
					$addid = $this->Leads_model->save_lead_address($leadaddress);
//					if($_POST['customFieldValue'][0]!='') insert into product table only if product is selected
					if($_POST['customFieldName'][0]!='')

						{
							$prdetid = $this->Leads_model->save_lead_products($proddata);
 							//echo"last prdetid id ".$prdetid;
		
						}
				    if ($prdetid>0)
						{
						  $message="Saved lead with products";
						}
					  else
						{
						  $message="";						
						}

			   }
				//  echo"last inserted id ".$lead_id;
 					if ($addid>0)
						{
						  $message="Saved Lead details ";
						}
					  else
						{
						  $message="";						
						}
					// 	redirect('leads');


/*save products into dailycall_dtl table START*/	
							$dcprodinsert = array();
							$businesscat=array("0"=>"BULK", "1"=>"PART TANKER","2"=>"REPACK","3"=>"INTACT","4"=>"SINGLE - TANKER","5"=>"SMALL PACKING");
							$poten_cat = array("0"=>"bulk", "1"=>"part_tanker","2"=>"repack","3"=>"intact","4"=>"single_tanker","5"=>"small_packing");
							$getindustry_name =	$this->Leads_model->get_industry_name($this->input->post('industry'));
							$customergroup = $this->Leads_model->get_customergroup($this->input->post('company'));
								foreach($_POST['customFieldName'] as $key=>$val)
								{
											$item_group = $this->Leads_model->get_productgroupname($_POST['hdncustomFieldName'][$key]);
											$getbusinesscat =	$this->Leads_model->get_businesscategory($_POST['customDispatch'][$key]);

											//echo" potential ".$_POST['customFieldPoten'][$key]."<br>";
										//	echo" quantity ".$_POST['customFieldValue'][$key]."<br>";


											for ($i=0;$i<=5;$i++)
											 {
											// 	echo" businesscat returned ".$getbusinesscat."<br>"; 
											 //	echo" array cat  ".$businesscat[$i]."<br>"; 
											 	if($businesscat[$i]==$getbusinesscat)
											 	{
											 	  $potential	=$_POST['customFieldPoten'][$key];
											 	  $quantity= $_POST['customFieldValue'][$key];
											 	}
											 	else
											 	{
											 	  $potential	=0; $quantity=0;
											 	}
											 //	echo"busness cat ".$businesscat[$i]."<br>";
												$insert_dailycall=1;
												$dcprodinsert[$i]['dct_customergroup'] =$customergroup; 
												$dcprodinsert[$i]['dct_itemgroup'] = $item_group;
												$dcprodinsert[$i]['dct_businesscategory'] =$businesscat[$i];
												$dcprodinsert[$i]['dct_executive_name'] =$login_username;
												$dcprodinsert[$i]['dct_executive_code'] =$this->session->userdata['loginname'];
												$dcprodinsert[$i]['dct_industry_segment'] =$getindustry_name;
												$dcprodinsert[$i]['dct_customer_potential'] = $potential;
												$dcprodinsert[$i]['dct_current_yr_sale_qty'] =$quantity;
												$dcprodinsert[$i]['dct_leadprod_refid'] =$lead_id;
												$dcprodinsert[$i]['dct_updated_date'] =date('Y-m-d:H:i:s');
												$dcprodinsert[$i]['dct_updated_userid'] = $login_user_id;
												$dcprodinsert[$i]['dct_updated_username'] = $login_username;
											//	$daily_logdtl[$key]['dtllog_createddate'] = date('Y-m-d:H:i:s');
											//	$daily_logdtl[$key]['dtllog_createduser'] = $login_user_id;

											}
										//	 echo"<pre> in loop dcprodinsert data "; print_r($dcprodinsert);
										$prdetidins = $this->Leads_model->save_daily_details($dcprodinsert);	
										
								}
								
/* save products into dailycall_dtl table END*/					

						 $custmastrhdr = array(
													'executivename' => $lead_assign_name,
													'execode' => $this->session->userdata['loginname']
																	);
				// before updating customermaster check if it is only a new customer.
						if($cust_account_id == "")
						{
							$temp_custmasterhdr_id = $this->Leads_model->update_custmastrhdr_assignto($this->input->post('assignedto'),$this->input->post('company')); 
						}
						//$temp_custmaster_id = $this->Leads_model->update_tempcustmaster_leadid($lead_id,$this->input->post('company'),$login_user_id);
      			 			$temp_itemmaster_id = $this->Leads_model->update_tempitemmaster_leadid($lead_id,$proddata,$login_user_id);
							$lead_log_details = array('lh_lead_id' => $lead_id,
												'lh_user_id' => $login_user_id,
												'lh_lead_curr_status' => $lead_status_name,
												'lh_lead_curr_statusid' => $this->input->post('leadstatus'),
												'lh_created_date' => date('Y-m-d:H:i:s'),
												'lh_created_user' => $login_user_id,
												'lh_comments' => $this->input->post('comments'),
												'action_type'=> 'Insert',
												'created_user_name'=> $login_username,
												'assignto_user_id '=> $this->input->post('assignedto'),
												'assignto_user_name'=> $lead_assign_name
											);
						 $logid = $this->Leads_model->create_leadlog($lead_log_details);

				  	       $lead_sublog_details = array(
												'lhsub_lh_id' => $logid,
												'lhsub_lh_lead_id' => $lead_id,
												'lhsub_lh_user_id' => $login_user_id,
												'lhsub_lh_lead_curr_status' => $lead_status_name,
												'lhsub_lh_lead_curr_statusid' => $this->input->post('leadstatus'),
												'lhsub_lh_lead_curr_sub_status' => $lead_sub_status_name,
												'lhsub_lh_lead_curr_sub_statusid' => $this->input->post('leadsubstatus'),
												'lhsub_lh_comments' => $this->input->post('comments'),
												'lhsub_lh_created_date' => date('Y-m-d:H:i:s'),
												'lhsub_lh_created_user' => $login_user_id,
												'lhsub_action_type'=> 'Insert',
												'lhsub_created_user_name'=> $login_username,
												'lhsub_assignto_user_id '=> $this->input->post('assignedto'),
												'lhsub_assignto_user_name'=> $lead_assign_name
											);
            
					 
					 	 $sublogid = $this->Leads_model->create_lead_sublog($lead_sublog_details);

						$this->session->set_flashdata('message', "Lead Created Successfully");
						echo "ref page ".$reffer_page; 		echo $url=base_url();
					
					 	if($reffer_page=="dailycall")
					 	{
							//redirect($url.'dailycall/customerdetails/'.$hdncustomer_id.'/0');
							redirect($url.'dailycall/customerdetails/'.$customergroup.'/0');
					 	}	
					 	else
					 	{
					 		redirect('leads');	
					 	}
					 	
				 
	    }

		
	}	

	function updatelead($id)
	{
   //echo"<pre>";print_r($_POST); echo"</pre>"; 

    $login_user_id = $this->session->userdata['user_id'];
    $login_username = $this->session->userdata['username'];
    $duser = $this->session->userdata['loginname'];

		if($this->input->post('updatelead'))
		{
		//$lead_seq1= $this->Leads_model->GetNextSeqVal('leaddetails_leadid_seq');
   			$leadid = $id;
			$lead_seq1= $this->Leads_model->GetNextSeqVal('leaddetails_leadid_seq');
			$lead_status_name= $this->Leads_model->GetLeadStatusName($this->input->post('leadstatus'));
			$lead_substatus_name= $this->Leads_model->GetLeadSubStatusName($this->input->post('leadsubstatus'));
			$lead_crd = $this->Leads_model->GetLeadCredit($this->input->post('credit_assesment'));
			$assign_to_array = $this->Leads_model->GetAssigntoName($this->input->post('assignedto'));
			$lead_assign_name= $assign_to_array['0']['location_user']."-".$assign_to_array['0']['aliasloginname'];
			$duser_for_update=  $assign_to_array['0']['duser'];
			$duser = $assign_to_array['0']['duser'];
			$customer_id = $this->Leads_model->GetTempCustId($this->input->post('company')); 

			$cust_account_id = $this->Leads_model->CheckNewCustomer($this->input->post('company')); 
			$customer_details = $this->Leads_model->GetCustomerdetails($this->input->post('company')); 
			$itemgroup_name= $this->Leads_model->GetItemgroup($_POST['customFieldName'][0]);
					if($itemgroup_name['itemgroup']!="")
					{
						$itemgroup_name=$itemgroup_name['itemgroup'];
					}
					else
					{
						$itemgroup_name=$itemgroup_name['description'];
					}

			if($customer_details['customergroup']!="")
			{
				$customergroup = $customer_details['customergroup'];	
			}
			else
			{
				$customergroup = $customer_details['tempcustname'];		
			}
			$customer_number =$customer_details['customer_number'];	
			$customer_name =$customer_details['customer_name'];		


		  //$lead_no = $lead_no = 'LEAD'.$lead_seq1;
		 $lead_desc = $this->input->post('hdn_desc')."-".$this->input->post('description');
			if ($this->input->post('leadstatus')!=$this->input->post('hdn_status_id')||$this->input->post('leadsubstatus')!=$this->input->post('hdn_sub_status_id') ||$this->input->post('assignedto')!=$this->input->post('hdn_assign_to') || trim($this->input->post('comments'))!=trim($this->input->post('hdn_cmnts')))
			{
				 $update_log=1;
			}
			else
			{
				$update_log=0;
			}

			if ($this->input->post('leadstatus')!=$this->input->post('hdn_status_id')|| ($this->input->post('leadsubstatus')!=$this->input->post('hdn_sub_status_id'))){	
					$lead_status_update='Y';
			}
			else{	
				$lead_status_update='N';
			}


			$crm_first_soc_no = $this->input->post('txtLeadsoc');
			if ($crm_first_soc_no=="")
			{
				$crm_first_soc_no=0;
				$ld_converted = 0;
			}
		  else
			  {	
			  	$crm_first_soc_no=$this->input->post('txtLeadsoc');
			  	$ld_converted =1;
			 }
			if($this->input->post('presentsource')=="Domestic and Import" || $this->input->post('presentsource')=="Domestic")
			{
				$domestic_supplier_name  =trim($this->input->post('txtDomesticSource'));
			}
			else
			{
				$domestic_supplier_name  ="";
			}

		 $leaddetails = array(
						'leadstatus' => $this->input->post('leadstatus'),
						'company' => $this->input->post('company'),
						'customer_id' => $customer_id,
						'leadsource' => $this->input->post('leadsource'),
						'user_branch' => $this->input->post('branch'),
						'industry_id' => $this->input->post('industry'),
						'email_id' => $this->input->post('email_id'),
						'firstname' => $this->input->post('firstname'),
						'lastname' => $this->input->post('lastname'),
						'leadsource' => $this->input->post('leadsource'),
						'designation' => $this->input->post('designation'),
						'crd_id' => $this->input->post('credit_assesment'),
						'crd_assesment' => $lead_crd,
						'assignleadchk' => $this->input->post('assignedto'),
						'description' => $this->input->post('description'),
						'ldsubstatus' => $this->input->post('leadsubstatus'),
						'lead_crm_soc_no' =>$crm_first_soc_no, 
						'converted' =>$ld_converted, 
						'comments' => $this->input->post('comments'),
						'producttype' => trim($this->input->post('producttype')),
						'exporttype' => trim($this->input->post('exportdomestic')),
						'presentsource' => trim($this->input->post('presentsource')),
						'decisionmaker' => trim($this->input->post('purchasedecision')),
						'domestic_supplier_name' =>$domestic_supplier_name,
						'website' => $this->input->post('website'),
						'nextstepdate' => date('Y-m-d'),
						'last_modified' => date('Y-m-d:H:i:s'),
						'last_updated_user' => $login_user_id
					);

            	 		$leadaddress = array('leadaddressid' => $leadid,
									'city' => $this->input->post('city'),
									'state' => $this->input->post('state'),
									'street' => $this->input->post('street'),
									'pobox' => $this->input->post('postalcode'),
									'phone' => $this->input->post('phone'),
									'country' => $this->input->post('country'),
									'mobile_no' => $this->input->post('mobile_no'),
									'fax' => $this->input->post('fax'),
									'last_modified' => date('Y-m-d:H:i:s')
					);


				$proddata = array();
				$potential_updated = array();
				$lead_customer_pontential= array();
				$k=0;
				$producttypeid = array("0"=>"1", "1"=>"681045","2"=>"173794","3"=>"681046","4"=>"173795","5"=>"3");
				$business_cat_type = array("0"=>"REPACK", "1"=>"SINGLE - TANKER","2"=>"BULK","3"=>"SMALL PACKING","4"=>"INTACT","5"=>"PART TANKER");
					$proddata[0]['lpid'] = $_POST['leadprodid'][0];
					$proddata[0]['productid'] = $_POST['customFieldName'][0];
					$proddata[0]['quantity'] = $_POST['customFieldValue'][0];
					$proddata[0]['last_modified'] = date('Y-m-d:H:i:s');
					$proddata[0]['last_updated_user'] = $login_user_id;
 				//	echo"<pre>proddata ";print_r($proddata);echo"</pre>";
				foreach($_POST['customDispatch'] as $key=>$val)
				{
			
					//echo"testing <br>";
					//echo" cat type id is ".$_POST['customDispatch'][$key]."<br>";
					//echo" potential for  cat type  is ".$_POST['customFieldPoten'][$key]."<br>";
					$businesscat_type_name = array_search($_POST['customDispatch'][$key], $producttypeid); // $key = 2;
					//echo"businesscat is ".$businesscat_type_name."<br>";
					//echo"businesscat name is  ".$business_cat_type[$businesscat_type_name]."<br>";
					
					 	$lead_prod_poten_type[$key]['leadid']=$leadid;
						$lead_prod_poten_type[$key]['productid']=$_POST['customFieldName'][0];
		 				$lead_prod_poten_type[$key]['product_type_id']=$_POST['customDispatch'][$key];
		 				$lead_prod_poten_type[$key]['potential']=$_POST['customFieldPoten'][$key];

		 				$lead_customer_pontential[$key]['id']= $leadid;
						$lead_customer_pontential[$key]['line_id']= $_POST['leadprodid'][$key];
						$lead_customer_pontential[$key]['user1'] = strtoupper($duser_for_update);
						$lead_customer_pontential[$key]['customergroup']= $customergroup;
						$lead_customer_pontential[$key]['user_code']= $_POST['assignedto'];
						$lead_customer_pontential[$key]['customer_number']= $customer_number; 
						$lead_customer_pontential[$key]['customer_name']= $customer_name;
						$lead_customer_pontential[$key]['itemgroup']= $itemgroup_name;

						$lead_customer_pontential[$key]['types'] ="LEAD";
						$lead_customer_pontential[$key]['collector'] = $this->input->post('branch');  
						$lead_customer_pontential[$key]['lead_created_date'] = date('Y-m-d:H:i:s');
						

						$lead_customer_pontential[$key]['yearly_potential_qty']=($_POST['customFieldPoten'][$key] * 12);
		 				$lead_customer_pontential[$key]['businesscategory']=$business_cat_type[$businesscat_type_name];

					
				
				} // End of For Loop
			
     				 $lead_pord_poten_id =$this->Leads_model->update_leadprodpotentypes($lead_prod_poten_type,$leadid);
     			
				  $lead_pord_poten_id =$this->Leads_model->update_leadcustomer_potential_update($lead_customer_pontential,$leadid);

		  		$id =$this->Leads_model->update_lead($leaddetails,$leadid);
				if($cust_account_id == "")
								{
									$temp_custmasterhdr_id = $this->Leads_model->update_custmastrhdr_assignto($this->input->post('assignedto'),$this->input->post('company')); 
								}

			   if($id)
			   {
					$addid = $this->Leads_model->update_lead_address($leadaddress,$leadid);
					if($_POST['customFieldValue'][0]!='')
						{
						  
							$prdetid = $this->Leads_model->update_lead_products_alltype($proddata,$leadid);
 							//echo"last prdetid id ".$prdetid;
		
						}

				 	//$prdpot = $this->Leads_model->update_customer_potential($potential_updated,$leadid);

			   }
				
 					if ($addid)
						{
						  $message="Updated Lead details ";
						}
					  else
						{
						  $message="";						
						}

						  $lead_log_details = array('lh_lead_id' => $leadid,
										'lh_user_id' => $login_user_id,
										'lh_lead_curr_status' => $lead_status_name,
										'lh_lead_curr_statusid' => $this->input->post('leadstatus'),
										'lh_updated_date' => date('Y-m-d:H:i:s'),
										'lh_last_updated_user' => $login_user_id,
										'lh_comments' => trim($this->input->post('comments')),
										'action_type'=> 'Update',
										'modified_user_name'=> $login_username,
										'assignto_user_id '=> $this->input->post('assignedto'),
										'assignto_user_name'=> $lead_assign_name,
										'status_update'=> $lead_status_update
									);
							if($update_log==1)
							{
						  	 @$logid = $this->Leads_model->create_leadlog($lead_log_details);
							}

							$lead_sublog_details = array(
										'lhsub_lh_id' => @$logid,
										'lhsub_lh_lead_id' => $leadid,
										'lhsub_lh_user_id' => $login_user_id,
										'lhsub_lh_lead_curr_status' => $lead_status_name,
										'lhsub_lh_lead_curr_statusid' => $this->input->post('leadstatus'),
										'lhsub_lh_lead_curr_sub_status' => $lead_substatus_name,
										'lhsub_lh_lead_curr_sub_statusid' => $this->input->post('leadsubstatus'),
										'lhsub_lh_updated_date' => date('Y-m-d:H:i:s'),
										'lhsub_lh_last_updated_user' => $login_user_id,
										'lhsub_lh_comments' => trim($this->input->post('comments')),
										'lhsub_action_type'=> 'Update',
										'lhsub_modified_user_name'=> $login_username,
										'lhsub_assignto_user_id '=> $this->input->post('assignedto'),
										'lhsub_assignto_user_name'=> $lead_assign_name,
										'lhsub_status_update'=> $lead_status_update
									);

							if($update_log==1)
							{
						  	 $sublogid = $this->Leads_model->create_lead_sublog($lead_sublog_details);
							}
               				$update_date = $this->Leads_model->update_prev_moddate($logid); 

					 	//redirect('leads');
					 	redirect('leads/viewleaddetails/'.$leadid);

	    }

		
	}	
	function colselead($id)
	{
		//print_r($_POST); 
		//print($this->input->post);

		   $leadid = $id; 

				$login_user_id = $this->session->userdata['user_id'];
				$login_username = $this->session->userdata['username'];
				$leaddetails = array(
				'lead_close_status' => 1,
				'lead_close_option'=>$_POST['closeleadoptions'],
				'lead_close_comments'=>$_POST['closingcomments'],
				'last_modified' => date('Y-m-d:H:i:s'),
				'last_updated_user' => $login_user_id
				);
    
			$id =$this->Leads_model->update_leadclosestatus($leaddetails,$leadid);
			//$this->load->view('leads/viewleadsnewsort');	
			 $this->session->set_flashdata('message', "Lead closed Successfully");
			redirect('leads');
			//$this->index();
		
	}
	
	function editstatus($id)
	{
			if (!$this->admin_auth->logged_in())
				{
					//redirect them to the login page
					redirect('admin/login', 'refresh');
				}
			$this->session->set_userdata('run_time_lead_id',$id); 
			if ($this->session->userdata['reportingto']=="")
			{

			 $leaddata['leaddetails'] = $this->Leads_model->get_lead_edit_details_all($id);
			}
			else
			{
			 $leaddata['leaddetails'] = $this->Leads_model->get_lead_edit_details($id);
			}
  //echo"<pre>";print_r($leaddata['leaddetails']);echo"</pre>"; die;
  			//$customer_id=$leaddata['leaddetails'][0]['customer_id'];
  			$company_id=$leaddata['leaddetails'][0]['company'];
			$leadassigntoid =  $leaddata['leaddetails'][0]['assignleadchk'];  
			$leadstusid =  $leaddata['leaddetails'][0]['leadstatusid'];
			$substatusid =  $leaddata['leaddetails'][0]['ldsubstatus'];

			$leadstus_order_id =  $leaddata['leaddetails'][0]['order_by'];
			$lst_order_by_id =  $leaddata['leaddetails'][0]['lst_order_by'];
			$lst_parentid_id =  $leaddata['leaddetails'][0]['lst_parentid'];

			$countryid =  $leaddata['leaddetails'][0]['country'];
			$stateid =  $leaddata['leaddetails'][0]['state'];
			$leaddata['optionslst'] = $this->Leads_model->get_leadstatus_edit($leadstusid,$leadstus_order_id);
			$leaddata['optionslsubst'] = $this->Leads_model->get_substatus_edit_all($substatusid,$lst_parentid_id,$lst_order_by_id);
			$leaddata['optionslsr'] = $this->Leads_model->get_leadsource();
	//		$leaddata['optionscmp'] = $this->Leads_model->get_company();
			$leaddata['optionscmp'] = $this->Leads_model->get_all_company();
			$leaddata['optionscnt'] = $this->Leads_model->get_country();
		  $leaddata['optionsinds'] = $this->Leads_model->get_industry();
			$leaddata['optionsst'] = $this->Leads_model->get_states_edit($countryid);
			$leaddata['optionsct'] = $this->Leads_model->get_city_edit($stateid);
			if ($this->session->userdata['reportingto']=="")
			{
				$leaddata['optionsasto'] = $this->Leads_model->get_assignto_users();
			}
			else
			{
				$leaddata['optionsasto'] = $this->Leads_model->get_assignto_users_order($this->session->userdata['reportingto']);
			}
			$leaddata['leadproducts'] = $this->Leads_model->get_lead_product_details($id);
			$product_name= $this->Leads_model->get_productname($leaddata['leadproducts'][0]['productid']); 
			$leaddata['closedlead'] = $leaddata['leaddetails']['0']['lead_close_status'];
			$leaddata['optionsproedit'] = $this->Leads_model->get_products_edit();
			//$leaddata['data']=$this->Leads_model->get_synched_products($company_id);
			$leaddata['data']=$this->Leads_model->get_synched_products($company_id,$product_name);

//	  $this->load->view('leads/editleads',$leaddata);	
	  	$this->load->view('leads/editleadsstatus',$leaddata);	
		
	
		
		
	}

function updateleadstatus($id)
	{
   //print_r($_POST); die;

   /*
Array
(
    [updateleadstatus] => updateleadstatus
    [leadstatus] => 6
    [txtLeadsoc] => 86258
    [leadsubstatus] => 28
    [comments] => converting
    [hdn_cmnts] => converted
    [hdn_status_id] => 6
    [hdn_sub_status_id] => 28
    [hdn_assignto_id] => 82
)
   */
    $login_user_id = $this->session->userdata['user_id'];
    $login_username = $this->session->userdata['username'];

		if($this->input->post('updateleadstatus'))
		{
		//$lead_seq1= $this->Leads_model->GetNextSeqVal('leaddetails_leadid_seq');
   		$leadid = $id;
			$lead_seq1= $this->Leads_model->GetNextSeqVal('leaddetails_leadid_seq');
			$lead_status_name= $this->Leads_model->GetLeadStatusName($this->input->post('leadstatus'));
			$lead_substatus_name = $this->Leads_model->GetLeadSubStatusName($this->input->post('leadsubstatus'));
		  //$lead_no = $lead_no = 'LEAD'.$lead_seq1;
		// $lead_desc = $this->input->post('hdn_desc')."-".$this->input->post('description');
			if (($this->input->post('leadstatus')!=$this->input->post('hdn_status_id'))|| ($this->input->post('leadsubstatus')!=$this->input->post('hdn_sub_status_id'))||(trim($this->input->post('comments'))!=""))
			{
			 $update_log=1;
			}
			else
			{
				$update_log=0;
			}

		if ($this->input->post('leadstatus')!=$this->input->post('hdn_status_id')||($this->input->post('leadsubstatus')!=$this->input->post('hdn_sub_status_id') ))
		{	$lead_status_update='Y';}
		else
		{	$lead_status_update='N';}

			$crm_first_soc_no = $this->input->post('txtLeadsoc');
			if ($crm_first_soc_no=="")
			{
				$crm_first_soc_no=0;
				$ld_converted = 0;
			}
		  else
			  {	
			  	$crm_first_soc_no=$this->input->post('txtLeadsoc');
			  	$ld_converted =1;
			 }
//echo"status_update ".$lead_status_update."<br>"; echo"update_log ".$update_log."<br>"; die;
		/* $leaddetails = array(
						'leadstatus' => $this->input->post('leadstatus'),
						'ldsubstatus' => $this->input->post('leadsubstatus'),
						'description' => $this->input->post('description'),
						'comments' => $this->input->post('comments'),
						'nextstepdate' => date('Y-m-d'),
						'last_modified' => date('Y-m-d:H:i:s'),
						'last_updated_user' => $login_user_id
					);*/
 		$leaddetails = array(
						'leadstatus' => $this->input->post('leadstatus'),
						'ldsubstatus' => $this->input->post('leadsubstatus'),
						'comments' => $this->input->post('comments'),
						'lead_crm_soc_no' =>$crm_first_soc_no, 
					 	'converted' =>$ld_converted, 
						'nextstepdate' => date('Y-m-d'),
						'last_modified' => date('Y-m-d:H:i:s'),
						'last_updated_user' => $login_user_id
					);

            
  

		  	$id =$this->Leads_model->update_lead($leaddetails,$leadid);
		

//			  echo"last update id ".$id; 
 							$lead_log_details = array('lh_lead_id' => $leadid,
								'lh_user_id' => $login_user_id,
								'lh_lead_curr_status' => $lead_status_name,
								'lh_lead_curr_statusid' => $this->input->post('leadstatus'),
								'lh_updated_date' => date('Y-m-d:H:i:s'),
								'lh_last_updated_user' => $login_user_id,
								'lh_comments' => trim($this->input->post('comments')),
								'action_type'=> 'Update',
								'modified_user_name'=> $login_username,
								'assignto_user_id '=> $this->input->post('hdn_assignto_id'),
								'assignto_user_name'=> $lead_assign_name,
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
							'lhsub_lh_lead_curr_statusid' => $this->input->post('leadstatus'),
							'lhsub_lh_lead_curr_sub_status' => $lead_substatus_name,
							'lhsub_lh_lead_curr_sub_statusid' => $this->input->post('leadsubstatus'),
							'lhsub_lh_updated_date' => date('Y-m-d:H:i:s'),
							'lhsub_lh_last_updated_user' => $login_user_id,
							'lhsub_lh_comments' => trim($this->input->post('comments')),
							'lhsub_action_type'=> 'Update',
							'lhsub_modified_user_name'=> $login_username,
							'lhsub_assignto_user_id '=> $this->input->post('hdn_assignto_id'),
							'lhsub_assignto_user_name'=> $lead_assign_name,
							'lhsub_status_update'=> $lead_status_update
							);
							if($update_log==1)
							{
						  
 								$sublogid = $this->Leads_model->create_lead_sublog($lead_sublog_details);
							}
						$update_date = $this->Leads_model->update_prev_moddate($logid); 
//echo"last updatedate id ".$update_date; die;

					 	//redirect('leads');
						redirect('leads/viewleaddetails/'.$leadid);

	    }

		
	}	



	function addnewcustomer()
	{
	 $this->load->view('company/newcompany');
	}

  function test()
	{
	 $loginuser = $this->session->userdata['loginname'];
   //$user_tree = $this->Leads_model->get_subquery_users_order($loginuser);
	// $lead_src = $this->Leads_model->GetLeadSourceVal(3);
   print_r($this->session->userdata);
	}

 
	  function userTree($parent_id=0) 
		{
     $query = $this->db->select('header_user_id, empname,duser')->get_where('vw_web_user_login',array('reportingto'=>$parent_id,'active'=>1));

     $branch = array();
     if (!empty($query) && $query->num_rows() > 0) 
			{
        $branch = $query->result();
        foreach ($branch as $key=>$child) 
				{
                   $branch[$key]->reportingto = $this->userTree($child->header_user_id);
        }  
        unset($key);
        unset($child);
     }

    return $branch;
	}
  
 	function check()
	{
		print($this->session->userdata);
		global $loginuser;
		$loginuser = 'CheSal6';
		$reporting_users = $this->subquery($loginuser);
	}

	function query_union()
	{
		$q = 'select cast(temp_cust_sync_id as varchar(50)) as id, tempcustomermaster.temp_customername from tempcustomermaster  union all
select  cast(customermasterhdr.id as varchar(50)), customermasterhdr.tempcustname from customermasterhdr LIMIT 10';
$result = $this->db->query($q);
//print_r($result->result_array());
$options = $result->result_array();
$options_arr;
$options_arr[''] = '-Please Select Company-';
foreach ($options as $option) {
			$options_arr[$option['id']] = $option['temp_customername'];
     // echo"id ".$option['id']."<br>";
     // echo"customername ".$option['temp_customername']."<br>";
		}
//	return $options_arr;
print_r($options_arr);
//return $result;;

	}
	
   function viewleaddetails($lead_id)
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
	                   
	                 }
				$login_user_id = $this->session->userdata['user_id'];
				$this->session->set_userdata('run_time_lead_id',$lead_id); 
		   		if ($this->session->userdata['reportingto']!="")
				{
			 		$leaddata['leaddetails'] = $this->Leads_model->get_lead_edit_details($lead_id);
				}
				else
				{

					 $leaddata['leaddetails'] = $this->Leads_model->get_lead_edit_details_all($lead_id);
				}
				// echo $leaddata['leaddetails']['0']['lead_close_status']; die;
				 $leaddata['country'] =$this->Leads_model->get_countryname($leaddata['leaddetails']['0']['country']);
				 $leaddata['state'] =$this->Leads_model->get_statename($leaddata['leaddetails']['0']['state']);
				// print_r($leaddata);

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

				$leaddata['grpperm'] =$datagroup;
                
				$leaddata['ldstatuslog'] = $this->Leads_model->get_lead_status_details($lead_id,$login_user_id);
				$leaddata['closedlead'] = $leaddata['leaddetails']['0']['lead_close_status'];
				//SELECT 'lh_updated_date'::timestamp - 'lh_last_modified'::timestamp  as Days;
				$leaddata['leadproducts'] = $this->Leads_model->get_lead_product_details_view_detail($lead_id);

				$this->load->view('leads/viewleaddetails',$leaddata);
  	}
  	 function viewleaddetailsconverted($lead_id)
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
	                   
	                 }
				$login_user_id = $this->session->userdata['user_id'];
				$this->session->set_userdata('run_time_lead_id',$lead_id); 
		   		if ($this->session->userdata['reportingto']!="")
				{
			 		$leaddata['leaddetails'] = $this->Leads_model->get_lead_edit_details($lead_id);
				}
				else
				{

					 $leaddata['leaddetails'] = $this->Leads_model->get_lead_edit_details_all($lead_id);
				}
				// echo $leaddata['leaddetails']['0']['country'];
				 $leaddata['country'] =$this->Leads_model->get_countryname($leaddata['leaddetails']['0']['country']);
				 $leaddata['state'] =$this->Leads_model->get_statename($leaddata['leaddetails']['0']['state']);
				// print_r($leaddata);

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

				$leaddata['grpperm'] =$datagroup;
                
				$leaddata['ldstatuslog'] = $this->Leads_model->get_lead_status_details($lead_id,$login_user_id);
				//SELECT 'lh_updated_date'::timestamp - 'lh_last_modified'::timestamp  as Days;
				$leaddata['leadproducts'] = $this->Leads_model->get_lead_product_details_view_detail($lead_id);

				$this->load->view('leads/viewleaddetailsconverted',$leaddata);
  	}

 

  function getallcompany()
	{
		$data = array();
		$data=$this->Leads_model->get_all_company_json();
		print_r($data);

	}

	function delete($ld_id)
	{
		$created_date = date('Y-m-d:H:i:s');
		
		$login_user_id = $this->session->userdata['user_id'];
		$login_username = $this->session->userdata['username'];
		$created_user_name = $login_username;

		if(isset($ld_id) && !empty($ld_id))
	            {
	            	 echo" delete id passed is".$ld_id;
	            	// code for inserting into delete log table start
	            	$insert_del_log = $this->Leads_model->insertlead_deletelog($created_date,$login_user_id,$login_username,$ld_id);
	     
	            	// code for inserting into delete log table end
		            	if($insert_del_log>0)
		            	{
		            		$this->db->where('leadid',$ld_id);
		         	      $this->db->delete('leaddetails');
		         	      $this->session->set_flashdata('message', "Lead deleted Successfully");
		         	      redirect('leads');
		            	}
		            	else
		            	{
		            		 $this->session->set_flashdata('message', "Error in Deleting the Lead");
		         	      redirect('leads');
		            	}

	            }
		 //	redirect('leads');
	}

  function substatus($parent_status_id)
	{
	//echo"parent_status_id ".$parent_status_id."<br>"; 
  //echo"leadid ".$this->session->userdata['run_time_lead_id'];
	$lead_id = $this->session->userdata['run_time_lead_id'];
	$leaddata['ldsubstatuslog'] = $this->Leads_model->get_lead_sub_status_details($lead_id,$parent_status_id);
	$this->load->view('leads/leadsubstatus',$leaddata);
	}

 	function data()
 	{
 		$this->load->view('leads/data/contact');
 	}

 	function selectproducts_all()
			{

				$sql='SELECT  DISTINCT on (description) id, description FROM view_tempitemmaster ORDER BY description asc';
				//$sql='SELECT    itemgroup as id,  itemgroup as description FROM itemmaster  WHERE length(itemgroup) >1  GROUP BY itemgroup  ORDER BY itemgroup asc';
			//		$sql='SELECT    id,  itemgroup as description FROM itemmaster  WHERE length(itemgroup) >1  GROUP BY itemgroup  ORDER BY itemgroup asc';
				$activitydata['dataitemmaster']=$this->Leads_model->get_all_products($sql);
			//	$viewdata = '['.$activitydata['dataitemmaster'].']'; 
				$viewdata = $activitydata['dataitemmaster']; 
		    		header('Content-Type: application/x-json; charset=utf-8');
				echo $viewdata;

			}

		function checkduplicate_product($prodid,$customerid)
		{
			$prodid=$_POST['prodid'];
			$customerid= $_POST['customerid'];
			$user1 = $this->session->userdata['loginname'];
			//echo "prodid ".$prodid; 			echo "customerid ".$customerid; die;
			$leaddata['response']= $this->Leads_model->check_prodnameduplicates_lead($prodid,$customerid);
		//	echo $activitydata['response'];
			if($leaddata['response']=='false')
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

}
?>
