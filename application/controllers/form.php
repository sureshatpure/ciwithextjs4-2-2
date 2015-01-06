<?php

class Form extends CI_Controller {

	function index()
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');

		$config = array(
               array(
                     'field'   => 'username',
                     'label'   => 'Username',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'password',
                     'label'   => 'Password',
                     'rules'   => 'required'
                  ),
               array(
                     'field'   => 'passconf',
                     'label'   => 'Password Confirmation',
                     'rules'   => 'required'
                  ),   
               array(
                     'field'   => 'email',
                     'label'   => 'Email',
                     'rules'   => 'required'
                  )
            );

		$this->form_validation->set_rules($config); 
		

	

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('myform');
		}
		else
		{
			$this->load->view('formsuccess');
		}
	}
}
?>
