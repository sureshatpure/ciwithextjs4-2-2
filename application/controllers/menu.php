<?php

class Menu extends CI_Controller {

	
	function __construct()
	{
	 parent::__construct();
	 $this->load->library('admin_auth');
	 $this->lang->load('admin');
	 $this->load->database();
	 $this->load->helper('url');
	
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
				
					$user = $this->admin_auth->user()->row();
					$allgroups =  $this->admin_auth->groups()->result();
					$usergroups =  $this->admin_auth->group($this->session->userdata['user_id']);
			 	 


//					$this->load->view('leads/viewleadsnew',$leaddata);	
		  	$this->load->view('menu/showmenulist');	
			}
			else
		  {
			 			redirect('admin/index', 'refresh');
						//$this->load->view('leads/viewleads',$leaddata);	
			}
	}
	



}
?>
