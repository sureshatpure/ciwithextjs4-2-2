<?php

class Dashboard extends CI_Controller {

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
	public $sel_user_id;
	public $branch;

	function __construct()
	{
	 parent::__construct();
	 $this->load->library('admin_auth');
	 $this->lang->load('admin');
	 $this->load->database();
	 $this->load->helper('url');
	 $this->load->model('Leads_model');
	 $this->load->model('dashboard_model');
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
						$leaddata = array();

         			 if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_dashboard();
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_chart();
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_dashboard();
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_chart();
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
					}
				   $leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
				 
				  $data = array();
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
		  	 	$this->load->view('dashboard/viewleadslist',$leaddata);	
			}
			else
		  {
			 			redirect('admin/index', 'refresh');
						//$this->load->view('leads/viewleads',$leaddata);	
			}
		}


			function showleads()
			{
				if (!$this->admin_auth->is_admin())
				{
			//        echo"1".$this->uri->segment(3);
			 //       echo"2".$this->uri->segment(4); 
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$leaddata = array();
				}	
					$status_id = $this->uri->segment(3);
					//str_replace(find,replace,string
					$no_of_days = str_replace('days','',$this->uri->segment(4));
					//      echo"no of days ".$no_of_days;
					//     echo"status_id ".$status_id;
			  		$data = array();     
 					$data['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
			  		 



					$i=0;
					$datagroup = array();					
					foreach($data['permission'] as $key=>$val)
					{
					$row = array();

					$row["groupid"] = $key;
					$row["groupname"] = $val;
					$datagroup[$i] = $row;
					$i++;
					}

					$arr = json_encode($datagroup);
					$data['grpperm'] =$arr;	


				$data['data']=$this->dashboard_model->get_leaddetails_for_grid($status_id,$no_of_days);
				$this->load->view('dashboard/showleads',$data);

			}

			function showsubleads()
			{
				if (!$this->admin_auth->is_admin())
				{
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
				
				}	
			//        echo"1".$this->uri->segment(3);
			 //       echo"2".$this->uri->segment(4); 
			        $sub_status_id = $this->uri->segment(3);
							//str_replace(find,replace,string
			        $no_of_days = str_replace('days','',$this->uri->segment(4));
			  //      echo"no of days ".$no_of_days;
			   //     echo"status_id ".$status_id;

				$data = array();

				$data['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					$i=0;
					$datagroup = array();					
					foreach($data['permission'] as $key=>$val)
					{
					$row = array();

					$row["groupid"] = $key;
					$row["groupname"] = $val;
					$datagroup[$i] = $row;
					$i++;
					}

					$arr = json_encode($datagroup);
					$data['grpperm'] =$arr;	
				$data['data']=$this->dashboard_model->get_subleaddetails_for_grid($sub_status_id,$no_of_days);
				$this->load->view('dashboard/showleads',$data);

			}

			
			function showsubleadsfilter()
			{

				if (!$this->admin_auth->is_admin())
				{
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
				
				}	
			        $sub_status_id = $this->uri->segment(3);
			        $no_of_days = str_replace('days','',$this->uri->segment(4));
			  
			        $branch = urldecode(str_replace('days','',$this->uri->segment(5)));
			        $user_id = str_replace('days','',$this->uri->segment(6));
			        $from_date = str_replace('days','',$this->uri->segment(7));
			        $to_date = str_replace('days','',$this->uri->segment(8));

				$data = array();
				$data['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
			//	echo "check ".$branch; 
				if(($branch=="Select%20Branch") || ($branch=="Select Branch"))
				{
					$branch="";
				}
				//	echo "test ".$branch; die;
					$i=0;
					$datagroup = array();					
					foreach($data['permission'] as $key=>$val)
					{
					$row = array();

					$row["groupid"] = $key;
					$row["groupname"] = $val;
					$datagroup[$i] = $row;
					$i++;
					}

					$arr = json_encode($datagroup);
					$data['grpperm'] =$arr;	
				$data['data']=$this->dashboard_model->get_subleaddetails_filter_for_grid($sub_status_id,$no_of_days,$branch,$user_id,$from_date,$to_date);
				$this->load->view('dashboard/showleads',$data);

			}


			function showleadsfilter()
			{

				if (!$this->admin_auth->is_admin())
				{
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
				
				}	
			        $sub_status_id = $this->uri->segment(3);
			        $no_of_days = str_replace('days','',$this->uri->segment(4));
			  
			        $branch = urldecode(str_replace('days','',$this->uri->segment(5)));
			        $user_id = str_replace('days','',$this->uri->segment(6));
			        $from_date = str_replace('days','',$this->uri->segment(7));
			        $to_date = str_replace('days','',$this->uri->segment(8));
				$data = array();     
				$data['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];

			//	echo "check ".$branch; 
				if(($branch=="Select%20Branch") || ($branch=="Select Branch"))
				{
					$branch="";
				}
				//	echo "test ".$branch; die;
				if ($user_id!="")
				{
					$data['data']=$this->dashboard_model->get_subleaddetailsfilter_for_grid($sub_status_id,$no_of_days,$branch,$user_id,$from_date,$to_date);	
				}
				else
				{
					$data['data']=$this->dashboard_model->get_subleaddetailsfilter_nouser_for_grid($sub_status_id,$no_of_days,$branch,$from_date,$to_date);	
				}
				

				 
			 	$i=0;
				$datagroup = array();					
				foreach($data['permission'] as $key=>$val)
				{
				$row = array();

				$row["groupid"] = $key;
				$row["groupname"] = $val;
				$datagroup[$i] = $row;
				$i++;
				}

				$arr = json_encode($datagroup);
				$data['grpperm'] =$arr;	
				$this->load->view('dashboard/showleads',$data);

			}

			
			
	
			function executivepipeline()
			{
				if (!$this->admin_auth->logged_in())
				{
					//redirect them to the login page
					redirect('admin/login', 'refresh');
				}
				elseif (!$this->admin_auth->is_admin())
				{
					$branch=urldecode($this->uri->segment(3));
					$user_id=$this->uri->segment(4);

					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_dashboard();
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_chart();
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count($branch,$user_id);
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_dashboard();
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_chart();
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count($branch,$user_id);
					}
					 $leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
							
					           if(($branch=="") or ($user_id=""))
					           {
							$leaddata['maxvalue'] = $leaddata['leadcount'];
							$leaddata['branch'] ='SelectBranch';
					           }
					           else
					           {
					           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
					           	$leaddata['branch'] ='Select Branch';
					           }
							//if $leaddata['maxvalue'] = $leaddata['leadcount'];
							//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
					          // echo"user id ". $user_id."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
					$data = array();
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
					$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_chart();
					$this->load->view('dashboard/viewleadexec',$leaddata);
				}
			}


			function subexecutivepipeline()
			{
				if (!$this->admin_auth->logged_in())
				{
					//redirect them to the login page
					redirect('admin/login', 'refresh');
				}
				elseif (!$this->admin_auth->is_admin())
				{
					$status_id=$this->uri->segment(3);
					$user_id=$this->uri->segment(4);
 				//	echo"branch ".$branch;  echo"user_id ".$user_id; die;
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_subleaddetails_aging_dashboard($status_id);
						$leaddata['datact']=$this->dashboard_model->get_subleaddetails_aging_chart($status_id);
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_sublead_user_branch_count($status_id);
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_subleaddetails_aging_dashboard($status_id);
						$leaddata['datact']=$this->dashboard_model->get_subleaddetails_aging_chart($status_id);
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_sublead_user_branch_count($status_id);
					}
					 $leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
							
					           if((@$branch=="") && ($user_id=""))
					           {
							$leaddata['maxvalue'] = $leaddata['leadcount'];
							$leaddata['branch'] ='SelectBranch';
					           }
					           else
					           {
					           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
					           	$leaddata['branch'] ='Select Branch';
					           }
							//if $leaddata['maxvalue'] = $leaddata['leadcount'];
							//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
					          // echo"user id ". $user_id."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
					$data = array();
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
					//$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_chart();
					$this->load->view('dashboard/showleadssub',$leaddata);
				}
			}

	  	function getbranches()
			{
				$branches = $this->dashboard_model->get_branches();
	 		//	$substatus = $this->Leads_model->get_assigned_tobranch();
				header('Content-Type: application/x-json; charset=utf-8');
				echo $branches;
			}


		function getassignedtobranch($brach_sel)
			{
				$this->dashboard_model->brach_sel = urldecode($brach_sel);
				$userlist = $this->dashboard_model->get_assigned_tobranch();
				header('Content-Type: application/x-json; charset=utf-8');
				echo $userlist;
			}

		function getusersforloginuser()
		{
				
				$userlist = $this->dashboard_model->get_usersfor_loginuser();
				header('Content-Type: application/x-json; charset=utf-8');
				echo $userlist;
		}

		function  getdatawithfilter()
		{
				$branch=urldecode($this->uri->segment(3));
				$sel_user_id=$this->uri->segment(4);


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
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_dashboard_withfilter($branch,$sel_user_id);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_chart_withfilter($branch,$sel_user_id);
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count($branch,$sel_user_id);
						$leaddata['branch'] = $branch;
						$leaddata['sel_user_id'] = $sel_user_id;
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_dashboard_withfilter($branch,$sel_user_id);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_chart_withfilter($branch,$sel_user_id);
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count($branch,$sel_user_id);
						$leaddata['branch'] = $branch;
						$leaddata['sel_user_id'] = $sel_user_id;

					}
						$leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					
						//if $leaddata['maxvalue'] = $leaddata['leadcount'];
						//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
 						if(($branch=="") && ($sel_user_id==""))
				           {
						$leaddata['maxvalue'] = $leaddata['leadcount'];
				           	$leaddata['branch'] = $branch;
				           	$leaddata['sel_user_id'] = $sel_user_id;
				           }
				           else
				           {
				           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
				           	$leaddata['branch'] = $branch;
				           	$leaddata['sel_user_id'] = $sel_user_id;
				           }
	 	// echo"user id ". $leaddata['sel_user_id']."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
						$data = array();
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
				//		print_r($leaddata); die;
				$this->load->view('dashboard/viewleadexec',$leaddata);	
				}
				else
				{
					redirect('admin/index', 'refresh');
				//$this->load->view('leads/viewleads',$leaddata);	
				}
		}

		function  getsubdatawithfilter()
		{
				$status_id=$this->uri->segment(3);
				$branch=$this->uri->segment(4);
				$sel_user_id=$this->uri->segment(5);
				
				$from_date=$this->uri->segment(6);
				$to_date=$this->uri->segment(7);


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
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_subleaddetails_aging_dashboard_withfilter($status_id,$branch,$sel_user_id);
						$leaddata['datact']=$this->dashboard_model->get_subleaddetails_aging_chart_withfilter($status_id,$branch,$sel_user_id);
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count($branch,$sel_user_id);
						$leaddata['branch'] = $branch;
						$leaddata['sel_user_id'] = $sel_user_id;
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_subleaddetails_aging_dashboard_withfilter($status_id,$branch,$sel_user_id);
						$leaddata['datact']=$this->dashboard_model->get_subleaddetails_aging_chart_withfilter($status_id,$branch,$sel_user_id);
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count($branch,$sel_user_id);
						$leaddata['branch'] = $branch;
						$leaddata['sel_user_id'] = $sel_user_id;

					}
						$leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					
						//if $leaddata['maxvalue'] = $leaddata['leadcount'];
						//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
 						if(($branch=="") or ($sel_user_id==""))
				           {
						$leaddata['maxvalue'] = $leaddata['leadcount'];
				           	$leaddata['branch'] = $branch;
				           	$leaddata['sel_user_id'] = $sel_user_id;
				           }
				           else
				           {
				           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
				           	$leaddata['branch'] = $branch;
				           	$leaddata['sel_user_id'] = $sel_user_id;
				           }
	 	// echo"user id ". $leaddata['sel_user_id']."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
						$data = array();
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
				//		print_r($leaddata); die;
				$this->load->view('dashboard/showleadssub',$leaddata);	
				}
				else
				{
					redirect('admin/index', 'refresh');
				//$this->load->view('leads/viewleads',$leaddata);	
				}
		}


		function  getdatawithdate_filter()
		{
				$branch=urldecode($this->uri->segment(3));
				$sel_user_id=$this->uri->segment(4);
				$from_date=$this->uri->segment(5);
				$to_date=$this->uri->segment(6);


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
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_dashboard_withdatefilter($branch,$sel_user_id,$from_date,$to_date);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_chart_withdatefilter($branch,$sel_user_id,$from_date,$to_date);
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count_datefilter($branch,$sel_user_id,$from_date,$to_date);
						$leaddata['branch'] = $branch;
						$leaddata['sel_user_id'] = $sel_user_id;
						$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_dashboard_withdatefilter($branch,$sel_user_id,$from_date,$to_date);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_chart_withdatefilter($branch,$sel_user_id,$from_date,$to_date);
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count_datefilter($branch,$sel_user_id,$from_date,$to_date);
						$leaddata['branch'] = $branch;
						$leaddata['sel_user_id'] = $sel_user_id;
						$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;

					}
						$leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					
						//if $leaddata['maxvalue'] = $leaddata['leadcount'];
						//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
 						if(($branch=="") or ($sel_user_id==""))
				           {
						$leaddata['maxvalue'] = $leaddata['leadcount'];
				           	$leaddata['branch'] = $branch;
				           	$leaddata['sel_user_id'] = $sel_user_id;
				           	$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
				           }
				           else
				           {
				           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
				           	$leaddata['branch'] = $branch;
				           	$leaddata['sel_user_id'] = $sel_user_id;
				           	$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
				           }
	 	// echo"user id ". $leaddata['sel_user_id']."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
						$data = array();
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
				//		print_r($leaddata); die;
				$this->load->view('dashboard/viewleadexec',$leaddata);	
				}
				else
				{
					redirect('admin/index', 'refresh');
				//$this->load->view('leads/viewleads',$leaddata);	
				}
		}


			function  getdatawithbranchfilter()
			{
				$branch=urldecode($this->uri->segment(3));
				$from_date=$this->uri->segment(4);
				$to_date=$this->uri->segment(5);


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
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_dashboard_withbranchdatefilter($branch,$from_date,$to_date);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_chart_withbranchdatefilter($branch,$from_date,$to_date);
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count_branchdatefilter($branch,$from_date,$to_date);
						$leaddata['branch'] = $branch;
						$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_dashboard_withbranchdatefilter($branch,$from_date,$to_date);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_chart_withbranchdatefilter($branch,$from_date,$to_date);
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count_branchdatefilter($branch,$from_date,$to_date);
						$leaddata['branch'] = $branch;
						
						$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;

					}
						$leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					
						//if $leaddata['maxvalue'] = $leaddata['leadcount'];
						//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
 						if($branch=="") 
				           {
						$leaddata['maxvalue'] = $leaddata['leadcount'];
				           	$leaddata['branch'] = $branch;
				           	
				           	$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
				           }
				           else
				           {
				           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
				           	$leaddata['branch'] = $branch;
				           	
				           	$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
				           }
	 	// echo"user id ". $leaddata['sel_user_id']."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
						$data = array();
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
				//		print_r($leaddata); die;
				$this->load->view('dashboard/viewleadexec',$leaddata);	
				}
				else
				{
					redirect('admin/index', 'refresh');
				//$this->load->view('leads/viewleads',$leaddata);	
				}
		}
			function  getadditional_withbranchfilter()
			{
				$branch=urldecode($this->uri->segment(3));
				$from_date=$this->uri->segment(4);
				$to_date=$this->uri->segment(5);


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
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_additional_withbranchdatefilter($branch,$from_date,$to_date);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_additional_chart_withbranchdatefilter($branch,$from_date,$to_date);
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count_branchdatefilter($branch,$from_date,$to_date);
						$leaddata['branch'] = $branch;
						$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_additional_withbranchdatefilter($branch,$from_date,$to_date);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_additional_chart_withbranchdatefilter($branch,$from_date,$to_date);
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count_branchdatefilter($branch,$from_date,$to_date);
						$leaddata['branch'] = $branch;
						
						$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;

					}
						$leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					
						//if $leaddata['maxvalue'] = $leaddata['leadcount'];
						//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
 						if($branch=="") 
				           {
						$leaddata['maxvalue'] = $leaddata['leadcount'];
				           	$leaddata['branch'] = $branch;
				           	
				           	$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
				           }
				           else
				           {
				           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
				           	$leaddata['branch'] = $branch;
				           	
				           	$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
				           }
	 	// echo"user id ". $leaddata['sel_user_id']."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
						$data = array();
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
				//		print_r($leaddata); die;
				$this->load->view('dashboard/additional',$leaddata);	
				}
				else
				{
					redirect('admin/index', 'refresh');
				//$this->load->view('leads/viewleads',$leaddata);	
				}
		}


			function  getsubdatawithdatefilter()
			{
				$status_id=$this->uri->segment(3);
				$branch=urldecode($this->uri->segment(4));
				$sel_user_id=$this->uri->segment(5);
				$from_date=$this->uri->segment(6);
				$to_date=$this->uri->segment(7);

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
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_subleaddetails_aging_dashboard_withdatefilter($status_id,$branch,$sel_user_id,$from_date,$to_date);
						$leaddata['datact']=$this->dashboard_model->get_subleaddetails_aging_chart_withdatefilter($status_id,$branch,$sel_user_id,$from_date,$to_date);
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count_datefilter($branch,$sel_user_id,$from_date,$to_date);
						$leaddata['branch'] = $branch;
						$leaddata['sel_user_id'] = $sel_user_id;
						$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_subleaddetails_aging_dashboard_withdatefilter($status_id,$branch,$sel_user_id,$from_date,$to_date);
						$leaddata['datact']=$this->dashboard_model->get_subleaddetails_aging_chart_withdatefilter($status_id,$branch,$sel_user_id,$from_date,$to_date);
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count_datefilter($branch,$sel_user_id,$from_date,$to_date);
						$leaddata['branch'] = $branch;
						$leaddata['sel_user_id'] = $sel_user_id;
						$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;

					}
						$leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					
						//if $leaddata['maxvalue'] = $leaddata['leadcount'];
						//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
 						if(($branch=="") or ($sel_user_id==""))
				           {
						$leaddata['maxvalue'] = $leaddata['leadcount'];
				           	$leaddata['branch'] = $branch;
				           	$leaddata['sel_user_id'] = $sel_user_id;
				           	$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
				           }
				           else
				           {
				           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
				           	$leaddata['branch'] = $branch;
				           	$leaddata['sel_user_id'] = $sel_user_id;
				           	$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
				           }
	 	// echo"user id ". $leaddata['sel_user_id']."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
						$data = array();
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
				//		print_r($leaddata); die;
				$this->load->view('dashboard/showleadssub',$leaddata);	
				}
				else
				{
					redirect('admin/index', 'refresh');
				//$this->load->view('leads/viewleads',$leaddata);	
				}
		}

		function  getsubdatawithbranchdatefilter()
			{
				$status_id=$this->uri->segment(3);
				$branch=urldecode($this->uri->segment(4));
				$from_date=$this->uri->segment(5);
				$to_date=$this->uri->segment(6);

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
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_subleaddetails_aging_dashboard_withbranchdatefilter($status_id,$branch,$from_date,$to_date);
						$leaddata['datact']=$this->dashboard_model->get_subleaddetails_aging_chart_withbranchdatefilter($status_id,$branch,$from_date,$to_date);
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count_branchdatefilter($branch,$from_date,$to_date);
						$leaddata['branch'] = $branch;
						
						$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_subleaddetails_aging_dashboard_withbranchdatefilter($status_id,$branch,$from_date,$to_date);
						$leaddata['datact']=$this->dashboard_model->get_subleaddetails_aging_chart_withbranchdatefilter($status_id,$branch,$from_date,$to_date);
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count_branchdatefilter($branch,$from_date,$to_date);
						$leaddata['branch'] = $branch;
						
						$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;

					}
						$leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					
						//if $leaddata['maxvalue'] = $leaddata['leadcount'];
						//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
 						if($branch=="") 
				           {
						$leaddata['maxvalue'] = $leaddata['leadcount'];
				           	$leaddata['branch'] = $branch;
				           	
				           	$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
				           }
				           else
				           {
				           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
				           	$leaddata['branch'] = $branch;
				           	
				           	$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
				           }
	 	// echo"user id ". $leaddata['sel_user_id']."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
						$data = array();
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
				//		print_r($leaddata); die;
				$this->load->view('dashboard/showleadssub',$leaddata);	
				}
				else
				{
					redirect('admin/index', 'refresh');
				//$this->load->view('leads/viewleads',$leaddata);	
				}
		}

		function daynoprogress()
			{
				if (!$this->admin_auth->logged_in())
				{
					//redirect them to the login page
					redirect('admin/login', 'refresh');
				}
				elseif (!$this->admin_auth->is_admin())
				{
					$branch=urldecode($this->uri->segment(3));
					$user_id=$this->uri->segment(4);

					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_daynoprogress_dashboard();
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_daynoprogress_chart();
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count($branch,$user_id);
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_daynoprogress_dashboard();
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_daynoprogress_chart();
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count($branch,$user_id);
					}
					 $leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
							
					           if(($branch=="") or ($user_id=""))
					           {
							$leaddata['maxvalue'] = $leaddata['leadcount'];
							$leaddata['branch'] ='SelectBranch';
					           }
					           else
					           {
					           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
					           	$leaddata['branch'] ='Select Branch';
					           }
							//if $leaddata['maxvalue'] = $leaddata['leadcount'];
							//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
					          // echo"user id ". $user_id."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
					$data = array();
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
					$this->load->view('dashboard/daynoprogress',$leaddata);
				}
			}


			function  daynoprogesswithfilter()
			{
				$branch=urldecode($this->uri->segment(3));
				$sel_user_id=$this->uri->segment(4);


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
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_daynop_withfilter($branch);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_daynop_withfilter_chart($branch);
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_daynop_branch_count($branch);
						$leaddata['branch'] = $branch;
						
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_daynop_withfilter($branch);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_daynop_withfilter_chart($branch);
						 
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_daynop_branch_count($branch);
						$leaddata['branch'] = $branch;
						

					}
						$leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					
						//if $leaddata['maxvalue'] = $leaddata['leadcount'];
						//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
 						if(($branch=="") && ($sel_user_id==""))
				           {
						$leaddata['maxvalue'] = $leaddata['leadcount'];
				           	$leaddata['branch'] = $branch;
				           	
				           }
				           else
				           {
				           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
				           	$leaddata['branch'] = $branch;
				           	
				           }
	 	// echo"user id ". $leaddata['sel_user_id']."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
						$data = array();
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
				//		print_r($leaddata); die;
				$this->load->view('dashboard/daynoprogress',$leaddata);	
				}
				else
				{
					redirect('admin/index', 'refresh');
				//$this->load->view('leads/viewleads',$leaddata);	
				}
		}

		function additional()
			{
				if (!$this->admin_auth->logged_in())
				{
					//redirect them to the login page
					redirect('admin/login', 'refresh');
				}
				elseif (!$this->admin_auth->is_admin())
				{
					$branch=urldecode($this->uri->segment(3));
					$user_id=$this->uri->segment(4);

					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_additional_aging_dashboard();
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_additional_aging_chart();
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_branch_count($branch);
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_additional_aging_dashboard();
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_additional_aging_chart();
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_branch_count($branch);
					}
					 $leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
							
					           if(($branch=="") or ($user_id==""))
					           {
							$leaddata['maxvalue'] = $leaddata['leadcount'];
							$leaddata['branch'] ='SelectBranch';
					           }
					           else
					           {
					           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
					           	$leaddata['branch'] ='Select Branch';
					           }
							//if $leaddata['maxvalue'] = $leaddata['leadcount'];
							//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
					          // echo"user id ". $user_id."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
					$data = array();
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
				//	$leaddata['datact']=$this->dashboard_model->get_leaddetails_additional_aging_chart();
					$this->load->view('dashboard/additional',$leaddata);
				}
			}

			function  additionalwithfilter()
			{
				$branch=urldecode($this->uri->segment(3));
				$sel_user_id=$this->uri->segment(4);


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
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_additional_withfilter($branch);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_additional_chart($branch);
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_branch_count($branch);
						$leaddata['branch'] = $branch;
						
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_additional_withfilter($branch);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_additional_chart($branch);
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_branch_count($branch);
						$leaddata['branch'] = $branch;
						

					}
						$leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					
						//if $leaddata['maxvalue'] = $leaddata['leadcount'];
						//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
 						if(($branch=="") && ($sel_user_id==""))
				           {
						$leaddata['maxvalue'] = $leaddata['leadcount'];
				           	$leaddata['branch'] = $branch;
				           	
				           }
				           else
				           {
				           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
				           	$leaddata['branch'] = $branch;
				           	
				           }
	 	// echo"user id ". $leaddata['sel_user_id']."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
						$data = array();
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
				//		print_r($leaddata); die;
				$this->load->view('dashboard/additional',$leaddata);	
				}
				else
				{
					redirect('admin/index', 'refresh');
				//$this->load->view('leads/viewleads',$leaddata);	
				}
		}


			function  getadditional_withdate_filter()
			{
				
				$from_date=$this->uri->segment(3);
				$to_date=$this->uri->segment(4);
				@$branch=="Select Branch";

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
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_additional_withdatefilter($from_date,$to_date);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_additional_withdatefilter_chart($from_date,$to_date);
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_date_count($from_date,$to_date);
						
						$leaddata['branch'] = @$branch;
						
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_additional_withdatefilter($from_date,$to_date);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_aging_additional_withdatefilter_chart($from_date,$to_date);
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_date_count($from_date,$to_date);
						
						$leaddata['branch'] = @$branch;
						

					}
						$leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					
						//if $leaddata['maxvalue'] = $leaddata['leadcount'];
						//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
 						if(@$branch=="") 
				           {
						$leaddata['maxvalue'] = $leaddata['leadcount'];
				           	$leaddata['branch'] = @$branch;
				           	
				           }
				           else
				           {
				           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
				           	$leaddata['branch'] = @$branch;
				           	
				           }
	 	// echo"user id ". $leaddata['sel_user_id']."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
						$data = array();
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
				//		print_r($leaddata); die;
				$this->load->view('dashboard/additional',$leaddata);	
				}
				else
				{
					redirect('admin/index', 'refresh');
				//$this->load->view('leads/viewleads',$leaddata);	
				}
		}

		function generadtedleads()
			{
				if (!$this->admin_auth->logged_in())
				{
					//redirect them to the login page
					redirect('admin/login', 'refresh');
				}
				elseif (!$this->admin_auth->is_admin())
				{
					$branch=urldecode($this->uri->segment(3));
					$user_id=$this->uri->segment(4);

					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_generatedleads_dashboard();
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_generatedleads_chart();
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count($branch,$user_id);
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_generatedleads_dashboard();
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_generatedleads_chart();
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count($branch,$user_id);
					}
					 $leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
							
					           if(($branch=="") or ($user_id=""))
					           {
							$leaddata['maxvalue'] = $leaddata['leadcount'];
						//	$leaddata['branch'] ='SelectBranch';
							$leaddata['branch'] ='AllBranches';
					           }
					           else
					           {
					           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
					           	//$leaddata['branch'] ='Select Branch';
					           	$leaddata['branch'] ='AllBranches';
					           }
							//if $leaddata['maxvalue'] = $leaddata['leadcount'];
							//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
					          // echo"user id ". $user_id."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
					$data = array();
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
					$this->load->view('dashboard/generatedleads',$leaddata);
				}
			}
			function  generadtedleadswithfilter()
			{
				$branch=urldecode($this->uri->segment(3));
				$sel_user_id=$this->uri->segment(4);


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
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_generatedleads_dashboard_withfilter($branch);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_generatedleads_chart_withfilter($branch);
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_branch_count($branch);
						$leaddata['branch'] = $branch;
						
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_generatedleads_dashboard_withfilter($branch);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_generatedleads_chart_withfilter($branch);
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_branch_count($branch);
						$leaddata['branch'] = $branch;
						

					}
						$leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					
						//if $leaddata['maxvalue'] = $leaddata['leadcount'];
						//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
 						if(($branch=="") && ($sel_user_id==""))
				           {
						$leaddata['maxvalue'] = $leaddata['leadcount'];
				           	$leaddata['branch'] = $branch;
				           	
				           }
				           else
				           {
				           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
				           	$leaddata['branch'] = $branch;
				           	
				           }
	 	// echo"user id ". $leaddata['sel_user_id']."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
						$data = array();
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
				//		print_r($leaddata); die;
				$this->load->view('dashboard/generatedleads',$leaddata);	
				}
				else
				{
					redirect('admin/index', 'refresh');
				//$this->load->view('leads/viewleads',$leaddata);	
				}
		}

		function generadtedleadswithdate_filter()
		{
			      $branch=urldecode($this->uri->segment(3));
				$from_date=$this->uri->segment(4);
				$to_date=$this->uri->segment(5);


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
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_generated_withbranchdatefilter($branch,$from_date,$to_date);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_generated_chart_withbranchdatefilter($branch,$from_date,$to_date);
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count_branchdatefilter($branch,$from_date,$to_date);
						$leaddata['branch'] = $branch;
						$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_generated_withbranchdatefilter($branch,$from_date,$to_date);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_generated_chart_withbranchdatefilter($branch,$from_date,$to_date);
						@$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count_branchdatefilter($branch,$from_date,$to_date);
						$leaddata['branch'] = $branch;
						$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;

					}
						$leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					
						//if $leaddata['maxvalue'] = $leaddata['leadcount'];
						//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
 						if($branch=="") 
				           {
						$leaddata['maxvalue'] = $leaddata['leadcount'];
				           	$leaddata['branch'] = $branch;
				           	
				           	$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
				           }
				           else
				           {
				           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
				           	$leaddata['branch'] = $branch;
				           	
				           	$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
				           }
	 	// echo"user id ". $leaddata['sel_user_id']."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
						$data = array();
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
				//		print_r($leaddata); die;
				$this->load->view('dashboard/generatedleads',$leaddata);	
				}
				else
				{
					redirect('admin/index', 'refresh');
				//$this->load->view('leads/viewleads',$leaddata);	
				}

		}


		function genleadsallbranches()
		{
			      $branch=urldecode($this->uri->segment(3));
				$from_date=$this->uri->segment(4);
				$to_date=$this->uri->segment(5);
/*				echo" branch ".$branch."<br>";
				echo" from_date ".$from_date."<br>";
				echo" to_date ".$to_date."<br>"; 
				branch AllBranches
				from_date 2014-05-31
				to_date 2014-05-31*/
				//die;

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
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_generated_allbranches($branch,$from_date,$to_date);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_generated_chart_allbranches($branch,$from_date,$to_date);
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count_allbranches($branch,$from_date,$to_date);
						$leaddata['branch'] = $branch;
						$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
					}
					else
					{
						$leaddata['data']=$this->dashboard_model->get_leaddetails_generated_allbranches($branch,$from_date,$to_date);
						$leaddata['datact']=$this->dashboard_model->get_leaddetails_generated_chart_allbranches($branch,$from_date,$to_date);
						@$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count_allbranches($branch,$from_date,$to_date);
						$leaddata['branch'] = $branch;
						$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;

					}
						$leaddata['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
					
						//if $leaddata['maxvalue'] = $leaddata['leadcount'];
						//$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
 						if($branch=="") 
				           {
						$leaddata['maxvalue'] = $leaddata['leadcount'];
				           	$leaddata['branch'] = $branch;
				           	
				           	$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
				           }
				           else
				           {
				           	$leaddata['maxvalue'] = $leaddata['lead_ub_count'];
				           	$leaddata['branch'] = $branch;
				           	
				           	$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
				           }
	 	// echo"user id ". $leaddata['sel_user_id']."<br>"; 	echo"branch  ". $leaddata['branch']."<br>"; 			die;
						$data = array();
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
				//		print_r($leaddata); die;
				$this->load->view('dashboard/generatedleads',$leaddata);	
				}
				else
				{
					redirect('admin/index', 'refresh');
				//$this->load->view('leads/viewleads',$leaddata);	
				}

		}

		/*Persu Codings start */
		function showleadsdata($branch,$selectedfield)
		{
				if (!$this->admin_auth->is_admin())
				{
			//        echo"1".$this->uri->segment(3);
			 //       echo"2".$this->uri->segment(4); 
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$leaddata = array();
				}	
					$status_id = $this->uri->segment(3);
					//str_replace(find,replace,string
					$no_of_days = str_replace('days','',$this->uri->segment(4));
					//      echo"no of days ".$no_of_days;
					//     echo"status_id ".$status_id;
			  		$data = array();     
 					$data['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
			  		 



					$i=0;
					$datagroup = array();					
					foreach($data['permission'] as $key=>$val)
					{
					$row = array();

					$row["groupid"] = $key;
					$row["groupname"] = $val;
					$datagroup[$i] = $row;
					$i++;
					}

					$arr = json_encode($datagroup);
					$data['grpperm'] =$arr;	


				$data['data']=$this->dashboard_model->get_leaddetails_for_branch_grid($status_id,$no_of_days);
				$this->load->view('dashboard/showbranchleads',$data);


			}
		/*Persu codings end*/


}
?>
