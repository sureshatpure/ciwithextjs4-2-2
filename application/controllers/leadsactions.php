<?php

class Leadsactions extends CI_Controller {

	public $data = array();
	public $post = array();
	public $proddata = array();
	public $leaddata = array();	
	public $loginuser;
	public $leadid= array();
	public $lead_no= array();
	public $leadstatus= array();
	public $leadsource= array();
	public $assign_from_name= array();
	public $tempcustname= array();
 public $datagroup = array();

			
	function __construct()
	{
	 parent::__construct();
	 $this->load->library('admin_auth');
	 $this->lang->load('admin');
	 $this->load->database();
	 $this->load->helper('url');
	 $this->load->model('Leads_model');
   $this->load->library('subquery');
	 $this->load->library('session');
	 $this->load->helper('html');

	}

		public function index()
		{
			echo"in index function"; die;
		}

		public function listleads()
		{
		global $leadid;
		global $lead_no;
		global $leadstatus;
		global $leadsource;
		global $assign_from_name;
		global $tempcustname;
		 if (!$this->admin_auth->logged_in())
			{
				//redirect them to the login page
				redirect('admin/login', 'refresh');
			}
			elseif (!$this->admin_auth->is_admin())
		/*	{
			 	$data = array();
				$data['data']=$this->Leads_model->get_leaddetails_for_grid();

				$user = $this->admin_auth->user()->row();
				$allgroups =  $this->admin_auth->groups()->result();
				$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
				$data['permission'] = $usergroups->_cache_user_in_group[$this->session->userdata['user_id']];
				$i=0;
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
				$this->load->view('leads/viewleadsnewsort',$data);
		
			} */
			{
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
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
	



}
?>
