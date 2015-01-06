<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Desktop extends CI_Controller {
//class desktop extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
	}

	//redirect if needed, otherwise display the user list
	function index()
	{
		$this->load->view('desktop/index');

	
	}
	function welcome()
	{

		
	}

	//log the user in
	

}
