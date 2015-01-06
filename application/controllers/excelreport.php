<?php

class Excelreport extends CI_Controller 
{

	
	public $leaddetails = array();

	function __construct()
	{
		 parent::__construct();
			
			$this->load->database();
 			$this->load->library('admin_auth');
	 		$this->lang->load('admin');
	 		
	 		$this->load->model('Excelreport_model');
	 		$this->load->model('dashboard_model');
			//load new PHPExcel library
			$this->load->library('excel');
			//activate worksheet number 1
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('test worksheet');
			//set cell A1 content with some text
			$this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
			//change the font size
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			//merge cell A1 until D1
			$this->excel->getActiveSheet()->mergeCells('A1:D1');
			//set aligment to center for that merged cell (A1 to D1)
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



	
	}


	
			public function index()
			{
				if (!$this->admin_auth->logged_in())
				{
					//redirect them to the login page
					redirect('admin/login', 'refresh');
				}
				elseif (!$this->admin_auth->is_admin())
				{
					$branch=$this->uri->segment(3);
					$user_id=$this->uri->segment(4);

					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
					$leaddata = array();

					if ($this->session->userdata['reportingto']=="")
					{
						//$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_dashboard();
					//	$leaddata['data']=$this->Excelreport_model->get_all_leads_for_grid();
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count($branch,$user_id);
					}
					else
					{
						//$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_dashboard();
					//	$leaddata['data']=$this->Excelreport_model->get_all_leads_user_based($this->session->userdata['reportingto']);
						
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
					$this->load->view('excelreport/viewallleads',$leaddata);
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
				$this->dashboard_model->brach_sel = $brach_sel;
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


		function exgetdatawithfilter($branch)
		{
			 //$headings = array('leadid','lead_no','email_id','firstname','lastname','created_user','AssigndTo','Street','endproducttype','productsaletype','presentsource','suppliername','decisionmaker','branchname','comments','uploadeddate','description','secondaryemail','assignedtouser','createddate','createdby','last_modified','updatedby','sent_mail_alert','leadsource','primarystatus','substatusname','loginname','prodqnty','productupdatedate','created_date','prodcreatedby','produpdatedby','prod_type_id','leadpoten','industrysegment','productname','itemgroup','organisation','uom','uomeasure','customername','customertype');
			   $headings = array('leadid','lead_no','email_id','firstname','lastname','Branch','Comments','Converted','uploadeddate','description','phone_no','mobile_no','address','secondaryemail','comments','AssignTo','Created By','Lastupdate Date','Updated By','sent_mail_alert','leadsource','lead_close_status','primarystatus','substatusname','loginname','prodqnty','Repack','Intact','Bulk','Small Packing','Single Tanker','Part Tanker','productupdatedate','created_date','prodcreatedby','produpdatedby','industrysegment','productname','itemgroup','organisation','uom','uomeasure','customername','customertype');
			$sql = "SELECT * FROM export_excel_horizontal_type WHERE  branchname='".$branch."' limit 3";	
		//	echo $sql; die;
			$result = $this->db->query($sql);
		//	print_r($result); die;
			if ($result ) 
			{
					// Create a new PHPExcel object 
					$objPHPExcel = new PHPExcel(); 
					$objPHPExcel->getActiveSheet()->setTitle('List of Users'); 

					$rowNumber = 1; 
					$col = 'A'; 
					foreach($headings as $heading) 
					{ 
						$objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$heading); 
						$col++; 
					} 
					// Loop through the result set 
					$rowNumber = 2; 
					$result = $this->db->query($sql);
					$leaddetails = $result->result_array();
					$count = $result->num_rows();
				//	print_r($leaddetails); die;

					for($i=0; $i<$count;$i++)
					{
						$col = 'A'; 
						foreach ($leaddetails[$i] as $row=>$cell) 
						{
							echo"col ".$col."<br>";
							echo"rowNumber ".$rowNumber."<br>";
							echo"cell ".$cell."<br>";

							$objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$cell); 
							$col++; 
						} 
						$rowNumber++; 
					}

					/*$objPHPExcel->getActiveSheet()->freezePane('A2'); 

					// Save as an Excel BIFF (xls) file 
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 

					header('Content-Type: application/vnd.ms-excel'); 
					header('Content-Disposition: attachment;filename="LeadProductsList.xls"'); 
					header('Cache-Control: max-age=0'); 

					$objWriter->save('php://output'); 
					exit(); */
			}

		}


		function  getdatawithfilter($branch,$sel_user_id=0)
		{
				 $branch=$this->uri->segment(3);
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
						//$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_dashboard();
						$leaddata['data']=$this->Excelreport_model->get_all_leads_for_grid_withfilter($branch,$sel_user_id);
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count($branch,$sel_user_id);
					}
					else
					{
						//$leaddata['data']=$this->dashboard_model->get_leaddetails_aging_dashboard();
						//$leaddata['data']=$this->Excelreport_model->get_all_leads_user_based($this->session->userdata['reportingto']);
						$leaddata['data']=$this->Excelreport_model->get_leads_user_based_for_grid_withfilter($branch,$sel_user_id);
						
						$leaddata['leadcount']=$this->session->userdata['user_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count($branch,$sel_user_id);
					}

					/*if ($this->session->userdata['reportingto']=="")
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

					}*/
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
				$this->load->view('excelreport/viewallleads',$leaddata);
				}
				else
				{
					redirect('admin/index', 'refresh');
				//$this->load->view('leads/viewleads',$leaddata);	
				}
		}

		function getdatawithbranchdtfilter()
		{

				$branch=$this->uri->segment(3);
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
						$leaddata['data']=$this->Excelreport_model->get_leads_withbranchdatefilter($branch,$from_date,$to_date);
						
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count_branchdatefilter($branch,$from_date,$to_date);
						$leaddata['branch'] = $branch;
						$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
					}
					else
					{
						$leaddata['data']=$this->Excelreport_model->get_leads_withbranchdatefilter($branch,$from_date,$to_date);
						
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


				
				$this->load->view('excelreport/viewallleads',$leaddata);
				}
				else
				{
					redirect('admin/index', 'refresh');
				//$this->load->view('leads/viewleads',$leaddata);	
				}

		}

		function getuserwithdate_filter()
		{

				$branch=$this->uri->segment(3);
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
						$leaddata['data']=$this->Excelreport_model->get_leaddetails_userbased_withdatefilter($branch,$sel_user_id,$from_date,$to_date);
						
						$leaddata['leadcount']=$this->session->userdata['all_leads_count'];
						$leaddata['lead_ub_count']=$this->dashboard_model->get_lead_user_branch_count_datefilter($branch,$sel_user_id,$from_date,$to_date);
						$leaddata['branch'] = $branch;
						$leaddata['sel_user_id'] = $sel_user_id;
						$leaddata['from_date'] = $from_date;
						$leaddata['to_date'] = $to_date;
					}
					else
					{
						$leaddata['data']=$this->Excelreport_model->get_leaddetails_userbased_withdatefilter($branch,$sel_user_id,$from_date,$to_date);
						
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
					$this->load->view('excelreport/viewallleads',$leaddata);

				}
				else
				{
					redirect('admin/index', 'refresh');
				//$this->load->view('leads/viewleads',$leaddata);	
				}



		}

		

} // End of Class
?>
