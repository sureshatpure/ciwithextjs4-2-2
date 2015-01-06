<?php

class Product_model extends CI_Model
{
	public $country_id = null;
	public $i, $j;
	public $reporting_user = array();
	public $reporting_user_id = array();
	public $user_list_id;
	public $reportingid;
	public $user_report_id;

	function __construct()
	{
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->database();
		$this->load->helper('language');
	  $this->load->library('subquery');
	}

	public function get_leadstatus()
	{
	
		$options = $this->db->select('leadstatusid, leadstatus')->get('leadstatus')->result();
		$options_arr;
		$options_arr[''] = '-Please Select Lead Status-';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			$options_arr[$option->leadstatusid] = $option->leadstatus;
		}
		return $options_arr;
		
	}

	function get_products_new()
	{
/*			$this->db->select('itemid, description');
			$this->db->order_by("itemid", "asc"); 
			$query = $this->db->get('itemmaster');
			$arr =  json_encode($query->result_array());
			return $arr;
*/
			$sql='SELECT  DISTINCT on (description) id, description FROM view_tempitemmaster ORDER BY description asc';
		  $result = $this->db->query($sql);
			$arr =  json_encode($result->result_array());
			return $arr;

	}

	public function get_leadsource()
	{
		$options = $this->db->select('leadsourceid, leadsource')->get('leadsource')->result();
		$options_arr;
		$options_arr[''] = '-Please Select Lead Source-';

		// Format for passing into form_dropdown function
		foreach ($options as $option) {
			$options_arr[$option->leadsourceid] = $option->leadsource;
		}
		return $options_arr;
		
	}

 
function CheckProductName($pname)
 	{
    //$sql="SELECT  tempcustomermaster.temp_customername from tempcustomermaster where tempcustomermaster.temp_customername = '".$cname."'";
		$sql="SELECT view_tempitemmaster.description from view_tempitemmaster where view_tempitemmaster.description = '".$pname."'";
    $query = $this->db->query($sql);

		if ($query->num_rows()==0)
		{
     return false;

		}
		else
		{
	  return true;
		}
			
	}
	
  function save_tempitem($productdata)
		{
	 // print_r($companydata);
		$this->db->insert('tempitemmaster', $productdata);
       return $this->db->insert_id();	
		}

function GetNextMaxVal($id,$tablename)
	{
//select max(id) from customermasterhdr
		$query = "select max(".$id.") from ".$tablename;
		$result =$this->db->query($query);
		
		if ($result->num_rows() > 0)
		{
		   $row = $result->row(); 

		  // echo"next val " .$row->nextval;	die;
		}
		
		return $row->max;
	}


}
?>

