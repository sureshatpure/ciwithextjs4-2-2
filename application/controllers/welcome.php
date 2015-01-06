<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->library('admin_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');

		
		$this->load->database();

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('admin');
		$this->load->helper('language');
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
			//redirect them to the home page because they must be an administrator to view this
			//redirect('/', 'refresh');
			$this->load->view('welcome_message');
		}
		else // if the logged in user is admin then redirect him to admin controller
		{
			redirect('admin/create_user', 'refresh');
		}
		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */