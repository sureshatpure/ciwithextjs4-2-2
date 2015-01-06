<?php

class Product extends CI_Controller {
	public $data = array();	

	function __construct()
	{
	 parent::__construct();
	 $this->load->library('admin_auth');
	 $this->lang->load('admin');
	 $this->load->database();
	 $this->load->helper('url');
	 $this->load->model('Leads_model');
	 $this->load->model('Product_model');
	 $this->load->model('Company_model');
   $this->load->library('subquery');
	 $this->load->library('session');
	 $this->load->library('Profiler');
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
						$leaddata['leaddetails'] = $this->Leads_model->get_lead_details_all();
					}
					else
					{
						$leaddata['leaddetails'] = $this->Leads_model->get_lead_details($this->session->userdata['reportingto']);
					}
					$this->load->view('leads/viewleads',$leaddata);	
			}
			else
		  {
			 			redirect('admin/index', 'refresh');
						//$this->load->view('leads/viewleads',$leaddata);	
			}
	}

	function addnewproduct()
	{

	 $data['leadid']=$this->uri->segment(3);
	 $this->load->view('product/newproduct',$data);
	}

	function getproductsnew()
	{
		$datap = array();
		$datap=$this->Product_model->get_products_new();
		echo $datap;

	}
  
	function saveleadproduct()
	{
   			$message ="";
	  		$prdetid="";
				$lead_id =$_POST['hdn_leadid'];
				$proddata = array();
				$proddataf = array();
				foreach($_POST['customFieldName'] as $key=>$val)
				{
					$lpid_seq= $this->Leads_model->GetNextSeqVal('leadproducts_lpid_seq');
					$lpid_seq = $lpid_seq+1;
					$proddata[$key]['lpid'] = $lpid_seq;
					$proddata[$key]['leadid'] = $lead_id;
					$proddata[$key]['productid'] = $_POST['customFieldName'][$key];
					$proddata[$key]['quantity'] = $_POST['customFieldValue'][$key];
					$proddata[$key]['potential'] = $_POST['customFieldPoten'][$key];
				
				}
					if(($_POST['customFieldValue'][0]!='') && ($_POST['customFieldPoten'][0]!=''))
						{
							$prdetid = $this->Leads_model->save_lead_products($proddata);
 						//	echo"last prdetid id ".$prdetid;
							$message = "Product added sucessfully";
		
						}
						else
					 {
						$message = "Please enter the product Quantity and Potential. Close this window and try again";
						$data['body'] = $message;
						$data['title'] = "Error Adding Products";
						$this->load->view('product/retry_view',$data);
					 }
      if ($prdetid)
						{
						//$message="Added products sucessfully ";
						$data['body'] = $message;
						$data['title'] = "Add lead Products";
						$this->load->view('product/success_view',$data);
						}
					  else
						{
						  $message="";						
						}
					// 	redirect('leads/edit/'.$lead_id);
			
				
				
	}
	
	function addnewitem()
	{

	 $data['userid']=$this->uri->segment(3);
//	 print_r($data);	
   $this->load->view('product/newitem',$data);
	}
	

	function check_itemname()
	{
//action=check_itemname&item_name=produ
			if (@$_POST['action'] == 'check_itemname') 	
			{
		   $prod_n = strtoupper($_POST['item_name']);
			 $json_out = $this->check_itemmastername($prod_n);
	       echo json_encode($json_out);
				}
			else
			{
			 
			}
	}
	
		function check_itemmastername($productname)
		{


		$productname = trim($productname); // strip any white space
		$response = array(); // our response

			if (!$productname) 
			{
		  $response = array(
		    'ok' => false, 
		    'msg' => "Please specify a Product Name");
		// if the companyname does not match a-z or '.', '-', '_' then it's not valid
			} else if (!preg_match('/^[a-z0-9.-_() ]+$/', $productname)) 
			{
		  
			$response = array(
		    'ok' => false, 
		    'msg' => "Your Product Name can only contain alphanumerics and period, dash and underscore ._");
		    
		// this would live in an external library just to check if the companyname is taken
			} else if ($this->item_exists($productname))
		 	{
		  $response = array(
		    'ok' => false, 
		    'msg' => "<font color=red>Product Name already exists</font>");
		// it's all good
			} else {  
		  $response = array(
		    'ok' => true, 
		    'msg' => "<font color=green>Yes..!You can add this Product</font>");
			}
			return $response;        


		}

		function item_exists($productname)
  	{
		 if($this->Product_model->CheckProductName($productname))
			{
				return true;
			}

			else
			{
				return false;
			}
		}

		function savenewitem()
			{
			//	print_r($_POST);
				if($this->input->post('savenewitem'))
				{
					 $lead_id = $this->Company_model->GetNextMaxVal('leadid','leaddetails');
					 $leadid = $lead_id+1; 
					 $product_currval= $this->Product_model->GetNextMaxVal('temp_item_id','tempitemmaster');
					//$company_currval= $this->Company_model->GetCurrVal('tempcustomermaster_id_seq');
				//	$company_currval= $this->Company_model->GetNextVal('tempcustomermaster_id_seq');
					$product_nextid=$product_currval+1;
		//tempcustomer_id_seq
		//INSERT INTO tempcustomermaster (temp_cust_sync_id,temp_customername,creationdate)
		//VALUES	('TEMP'||CURRVAL('tempcustomermaster_id_seq'),'Pures Chemicals','2013-09-27:09:20:35')
			 			$item_syn_id = "TEMP".$product_nextid;
						$user_id 	= $this->input->post('hdn_userid');
						$productdetails = array(
																	'temp_item_sync_id' => $item_syn_id,
																	'temp_itemname' => strtoupper($this->input->post('temp_itemname')),
																	'user_id' => $this->input->post('hdn_userid'),
																	//'lead_id' => $leadid,			
																	'creationdate' => date('Y-m-d h:i:s')
																	);
						$id =$this->Product_model->save_tempitem($productdetails);
				   // echo "the returned id is ".$id."<br>";
						if ($id!="")
						{
						 $data['body']="Product Added Sucessfully";
						 $this->load->view('product/sucessitem_view',$data);
						}
						else
						{
						 $data['body']="Please Try Again";
						 $this->load->view('product/retryitem_view',$data);
						}
						//redirect('leads');	

				}
			}
		function feedback()
		{
     echo"Feedback comming soon..!";
		}

		function delete($pid)
		{
					if(isset($pid) && !empty($pid))
	            {
	              $this->db->where('lpid',$pid);
	              if($this->db->delete('leadproducts'))
								{
									 //echo json_encode($states);
									 //echo json_encode(array("success" => true));  
								 echo"true";
								}
								else{
//									echo json_encode(array("success" => false));  
								 echo"false";
								}
	            	 
	            }
		}
		function selectproduct()
		{

	//	echo"in product controller"; die;


				$data = array();
			//	$data['body']="Select products from the dropdown";
				$data['data']=$this->Leads_model->get_products();
       // print_r($data); die;
				$this->load->view('product/selectproducts',$data);
		}

		function selectproductfordc()
		{

	//	echo"in product controller"; die;


				$data = array();
			//	$data['body']="Select products from the dropdown";
				$data['data']=$this->Leads_model->get_productsfordailycall();
       // print_r($data); die;
				$this->load->view('product/selectproductsdc',$data);
		}

		

   function add_gridProduct()
	 {
		echo"in add_gridProduct"; 
		print_r($_POST);
	//	print_r($this->session->userdata);			
					
			if (isset($_POST['insert']))
			{
				$lead_id = $this->Company_model->GetNextMaxVal('leadid','leaddetails');
				$leadid = $lead_id+1; 
				$product_currval= $this->Product_model->GetNextMaxVal('temp_item_id','tempitemmaster');
				$product_nextid=$product_currval+1;
				$item_syn_id = "TEMP".$product_nextid;
//				$user_id 	= $this->input->post('hdn_userid');
				$user_id 	= $this->session->userdata['user_id'];

				$productdetails = array(
									'temp_item_sync_id' => $item_syn_id,
//									'temp_itemname' => strtoupper($this->input->post('temp_itemname')),
									'temp_itemname' => strtoupper($_POST['description']),
//									'user_id' => $this->input->post('hdn_userid'),
									'user_id' => $this->session->userdata['user_id'],
									'creationdate' => date('Y-m-d h:i:s')
									);
				$id =$this->Product_model->save_tempitem($productdetails);
				if($id!='')
				{
					echo"done";
				}
			}


	 }	

}
?>
