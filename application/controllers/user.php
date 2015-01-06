<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class User extends CI_Controller 
{

	function __construct(){
		   parent::__construct();
		   $this->load->helper('url');
	    }
 

  	public function Login()
  	{
	 $this->load->view('login');	
	} 
	public function verifyuser()	
	{ 
		$userName = $_POST['userName']; 
		$userPassword = $_POST['userPassword']; 
		$status = array("STATUS"=>"false"); 
		if($userName=='admin' && $userPassword=='admin')
		{ 
			$status = array("STATUS"=>"true");	
		} 
	echo json_encode ($status) ;	
	} 
} 
