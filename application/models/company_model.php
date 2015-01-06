<?php

class Company_model extends CI_Model
{
	
	function __construct()
	{
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->database();
		$this->load->helper('language');
	  $this->load->library('subquery');
	}

	function save_company($companydata)
		{
	 // print_r($companydata);
		$this->db->insert('customermasterhdr', $companydata);
		//print_r($this->db); die;
       		//return $this->db->insert_id();	
		return 1;
		}

		function save_company_detail($company_detail)
		{
	  //print_r($company_detail); die;
		$this->db->insert('customermasterdtl', $company_detail);
      		// return $this->db->insert_id();	
		return 1;
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

	function GetNextTempCustIdMaxVal($id,$tablename)
	{
//select max(id) from customermasterhdr
		$query = "select max(".$id.") from ".$tablename." where  (cust_account_id=0 or cust_account_id isnull)";
//$this->db->where('leaddetails.leadid',$id);
		$result =$this->db->query($query);
		
		if ($result->num_rows() > 0)
		{
		   $row = $result->row(); 

		  // echo"next val " .$row->nextval;	die;
		}
		
		return $row->max;
	}

	function GetCurrVal($seq_id)
	{
//	select  CURRVAL('tempcustomermaster_id_seq')
		$query = "select CURRVAL('".$seq_id."')";
		$result =$this->db->query($query);
		if ($result->num_rows() > 0)
		{
		   $row = $result->row(); 

		  // echo"next val " .$row->nextval;	die;
		}
		
		return $row->currval;
	}

function GetNextVal($seq_id)
	{
//	select  CURRVAL('tempcustomermaster_id_seq')
		$query = "select NEXTVAL('".$seq_id."')";
		$result =$this->db->query($query);
		if ($result->num_rows() > 0)
		{
		   $row = $result->row(); 

		  // echo"next val " .$row->nextval;	die;
		}
		
		return $row->nextval;
	}

function GetLeadId($seq_id)
	{
//	select  CURRVAL('tempcustomermaster_id_seq')
		$query = "select NEXTVAL('".$seq_id."')";
		$result =$this->db->query($query);
		if ($result->num_rows() > 0)
		{
		   $row = $result->row(); 

		  // echo"next val " .$row->nextval;	die;
		}
		
		return $row->nextval;
	}

 function CheckCompanyName($cname)
 	{
    //$sql="SELECT  tempcustomermaster.temp_customername from tempcustomermaster where tempcustomermaster.temp_customername = '".$cname."'";
//		$sql="SELECT view_tempscustomermaster.tempcustname from view_tempcustomermaster where view_tempcustomermaster.tempcustname = '".$cname."'";
		$sql="SELECT view_tempcustomermaster.tempcustname from view_tempcustomermaster where view_tempcustomermaster.tempcustname LIKE upper( '%".$cname."%')";

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

}
?>

