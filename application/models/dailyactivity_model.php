<?php

class dailyactivity_model extends CI_Model
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
		$db_dc=$this->load->database('forms', TRUE);
		$this->load->helper('language');
	  	$this->load->library('subquery');
		$this->load->library('session');
    
	}

	
	function getactivity_data_all()
	{

		@$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];

			$jTableResult = array();
			 $sql = "SELECT distinct d.id,d.currentdate :: date,d.creationdate :: date,d.execode,d.exename,d.branch from vw_web_daily_activity d   order by id desc";
			//$sql="SELECT distinct d.id,d.currentdate :: date ,d.execode,d.exename from vw_web_daily_activity d  where user_id=302 order by id desc";

			$result = $this->db->query($sql);
			$activitydetails = $result->result_array();
			$all_record_count = count($activitydetails);
			$this->session->set_userdata('all_record_count',$all_record_count);
			$data = array();
				
				$i=0;
				while($i < count($activitydetails))
				{    
					$row = array();
					$row["id"] = $activitydetails[$i]["id"];
					$row["currentdate"] = $activitydetails[$i]["currentdate"];
					$row["execode"] = $activitydetails[$i]["execode"];
					$row["exename"] = $activitydetails[$i]["exename"];
					$row["branch"] = $activitydetails[$i]["branch"];
					$row["creationdate"] = $activitydetails[$i]["creationdate"];
/*
					$row["subactivity"] = $activitydetails[$i]["subactivity"];
					$row["hour_s"] = $activitydetails[$i]["hour_s"];
					$row["modeofcontact"] = $activitydetails[$i]["modeofcontact"];
					$row["Quantity"] = $activitydetails[$i]["Quantity"];
					$row["Division"] = $activitydetails[$i]["Division"]);
					$row["Date"] = substr($activitydetails[$i]["Date"],0,-8);
					$row["Remarks"] = $activitydetails[$i]["Remarks"];
					$row["L1Status"] = $activitydetails[$i]["L1Status"];
					$row["Complaints"] = $activitydetails[$i]["Complaints"];

*/
/*
					$date_cr = new DateTime($row["created_date"]);
				  $row["created_date"]= $date_cr->format('d-M-Y'); 
	
					$row["modified_date"] = substr($jTableResult['leaddetails'][$i]["last_modified"],0,-8);
			//		$date_mf = new DateTime($row["modified_date"]);
			//		$row["modified_date"] = $date_mf->format('d-M-Y');
					if($row["modified_date"] =="")
					{ 
						  $row["modified_date"] = substr($jTableResult['leaddetails'][$i]["createddate"],0,-8);
						  $date_mf = new DateTime($row["created_date"]);
					    $row["modified_date"] = $date_mf->format('d-M-Y');
					}
					else
					{
						  $row["modified_date"] = substr($jTableResult['leaddetails'][$i]["last_modified"],0,-8);
							$date_mf = new DateTime($row["modified_date"]);
					  $row["modified_date"] = $date_mf->format('d-M-Y');
					}
*/
					$data[$i] = $row;
					$i++;
				}
		//		$arr = "{\"data\":" .json_encode($data). "}";
				$arr = json_encode($data);
		//	echo "{ rows: ".$arr." }";
   //    echo $arr; die;
		 	return $arr;
	}

	function getactivity_data($user_id)
	{

		@$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];

			$jTableResult = array();
			 $sql = "SELECT distinct d.id,d.currentdate :: date,d.creationdate :: date,d.execode,d.exename,d.branch from vw_web_daily_activity d  where d.user_id IN(".$get_assign_to_user_id.") OR d.user_id = ".$user_id."  order by id desc";
			 // echo $sql; die;

			//$sql="SELECT distinct d.id,d.currentdate :: date ,d.execode,d.exename from vw_web_daily_activity d  where user_id=302 order by id desc";

			$result = $this->db->query($sql);
			$activitydetails = $result->result_array();
			$all_record_count = count($activitydetails);
			$this->session->set_userdata('all_record_count',$all_record_count);
			$data = array();
				
				$i=0;
				while($i < count($activitydetails))
				{    
					$row = array();
					$row["id"] = $activitydetails[$i]["id"];
					$row["currentdate"] = $activitydetails[$i]["currentdate"];
					$row["execode"] = $activitydetails[$i]["execode"];
					$row["exename"] = $activitydetails[$i]["exename"];
					$row["branch"] = $activitydetails[$i]["branch"];
					$row["creationdate"] = $activitydetails[$i]["creationdate"];
/*
					$row["subactivity"] = $activitydetails[$i]["subactivity"];
					$row["hour_s"] = $activitydetails[$i]["hour_s"];
					$row["modeofcontact"] = $activitydetails[$i]["modeofcontact"];
					$row["Quantity"] = $activitydetails[$i]["Quantity"];
					$row["Division"] = $activitydetails[$i]["Division"]);
					$row["Date"] = substr($activitydetails[$i]["Date"],0,-8);
					$row["Remarks"] = $activitydetails[$i]["Remarks"];
					$row["L1Status"] = $activitydetails[$i]["L1Status"];
					$row["Complaints"] = $activitydetails[$i]["Complaints"];

*/
/*
					$date_cr = new DateTime($row["created_date"]);
				  $row["created_date"]= $date_cr->format('d-M-Y'); 
	
					$row["modified_date"] = substr($jTableResult['leaddetails'][$i]["last_modified"],0,-8);
			//		$date_mf = new DateTime($row["modified_date"]);
			//		$row["modified_date"] = $date_mf->format('d-M-Y');
					if($row["modified_date"] =="")
					{ 
						  $row["modified_date"] = substr($jTableResult['leaddetails'][$i]["createddate"],0,-8);
						  $date_mf = new DateTime($row["created_date"]);
					    $row["modified_date"] = $date_mf->format('d-M-Y');
					}
					else
					{
						  $row["modified_date"] = substr($jTableResult['leaddetails'][$i]["last_modified"],0,-8);
							$date_mf = new DateTime($row["modified_date"]);
					  $row["modified_date"] = $date_mf->format('d-M-Y');
					}
*/
					$data[$i] = $row;
					$i++;
				}
		//		$arr = "{\"data\":" .json_encode($data). "}";
				$arr = json_encode($data);
		//	echo "{ rows: ".$arr." }";
   //    echo $arr; die;
		 	return $arr;
	}


			function geteditdata($id)
			{
				$sql = "SELECT custgroup,itemgroup,potentialqty,subactivity,hour_s,minit,modeofcontact,quantity,division,Date,
							Remarks,L1Status,Complaints from vw_web_daily_activity d  where id=".$id."order by id";

				$result = $this->db->query($sql);
				$activitydetails = $result->result_array();
				$all_record_count = count($activitydetails);
				$this->session->set_userdata('all_record_count',$all_record_count);

				$data = array();
				
				$i=0;
				while($i < count($activitydetails))
				{    
					$row = array();
					$row["custgroup"] = $activitydetails[$i]["custgroup"];
					$row["itemgroup"] = $activitydetails[$i]["itemgroup"];
					$row["potentialqty"] = $activitydetails[$i]["potentialqty"];
					$row["subactivity"] = $activitydetails[$i]["subactivity"];

					$row["hour_s"] = $activitydetails[$i]["hour_s"];
					$row["minit"] = $activitydetails[$i]["minit"];
					$row["modeofcontact"] = $activitydetails[$i]["modeofcontact"];
					$row["quantity"] = $activitydetails[$i]["quantity"];

					$row["division"] = $activitydetails[$i]["division"];
					$row["Date"] = $activitydetails[$i]["date"];
					$row["Remarks"] = $activitydetails[$i]["remarks"];
					$row["L1Status"] = $activitydetails[$i]["l1status"];
					$row["Complaints"] = $activitydetails[$i]["complaints"];
				

					$data[$i] = $row;

					$i++;
				}
				$arr = json_encode($data);
				return $arr;
//				echo $arr;

			}

			function getactivity_data_column()
			{

				$jTableResult = array();


				//$sql = "SELECT id FROM dailyactivitydtl where id ='".$this->session->userdata['loginname']."'";
				$sql="select lower(dtl_fld) as datafield, lower(dlblch) as text,cellwidth  :: INTEGER*10 AS  width   from formdtl where formcode='SMKT140' and cellwidth>'0' order by seqno";
				//$sql="select lower(dtl_fld) as datafield, lower(dlblch) as text,cellwidth  :: INTEGER*10 AS  width,case when COALESCE(cellwidth,'0') :: INTEGER =0 then  'false' else 'true'  end as hidden   from formdtl where formcode='SMKT140'   order by seqno";

				$db_dc= $this->load->database('forms', TRUE);
			//	$db2->query($sql);
				$result = $db_dc->query($sql);
				$activitydetails = $result->result_array();
				$all_record_count = count($activitydetails);
				$this->session->set_userdata('all_record_count',$all_record_count);
									
            //  echo"count ".$all_record_count; print_r($activitydetails); die; 


				$data = array();
				
				$i=0;
				while($i < count($activitydetails))
				{    
					$row = array();
					$row["text"] = $activitydetails[$i]["text"];
					$row["datafield"] = $activitydetails[$i]["datafield"];
					$row["width"] = $activitydetails[$i]["width"];
					$data[$i] = $row;
					$i++;
				}
		//		$arr = "{\"data\":" .json_encode($data). "}";
				$data ='{ "columns": '.json_encode($data).'}';
//				$data =json_encode($data);
				$arr = $data;
		//	echo "{ rows: ".$arr." }";
   //    echo $arr; die;
		 		return $arr;
	}



		/*	function getactivity_data_row($header_id)
			{

				$jTableResult = array();


				 $sql="SELECT id,custgroup,exename,branch,itemgroup,potentialqty,subactivity,modeofcontact,hour_s,minit,quantity,division,date,remarks,l1status,complaints, user_id from vw_web_daily_activity d where id ='".$header_id."'";


				$result = $this->db->query($sql);
				$activitydetails = $result->result_array();
				$all_record_count = count($activitydetails);
				$this->session->set_userdata('all_record_count',$all_record_count);

				//  echo"count ".$all_record_count; print_r($activitydetails); die; 


				$data = array();
				
				$i=0;
				while($i < count($activitydetails))
				{    
					$row = array();
				//	$row["id"] = $activitydetails[$i]["id"];
					$row["custgroup"] = $activitydetails[$i]["custgroup"];
					$row["itemgroup"] = $activitydetails[$i]["itemgroup"];
					$row["potentialqty"] = $activitydetails[$i]["potentialqty"];
					$row["subactivity"] = $activitydetails[$i]["subactivity"];
					$row["exename"] = $activitydetails[$i]["exename"];
					$row["branch"] = $activitydetails[$i]["branch"];
					$row["modeofcontact"] = $activitydetails[$i]["modeofcontact"];
					$row["hour_s"] = $activitydetails[$i]["hour_s"];
					$row["minit"] = $activitydetails[$i]["minit"];
					$row["quantity"] = $activitydetails[$i]["quantity"];
					$row["division"] = $activitydetails[$i]["division"];
					$row["date"] = $activitydetails[$i]["date"];
					$row["remarks"] = $activitydetails[$i]["remarks"];
					$row["l1status"] = $activitydetails[$i]["l1status"];
					$row["complaints"] = $activitydetails[$i]["complaints"];


					$data[$i] = $row;
					$i++;
				}
		//		$arr = "{\"data\":" .json_encode($data). "}";
				$data ='{ "rows": '.json_encode($data).'}';
//				$data =json_encode($data);
				$arr = $data;
		//	echo "{ rows: ".$arr." }";
   //    echo $arr; die;
		 	return $arr;
	}*/

		function getactivity_data_row($header_id)
			{

				$jTableResult = array();


				 $sql="SELECT id,custgroup,exename,branch,itemgroup,potentialqty,subactivity,modeofcontact,hour_s,minit,quantity,division,date,remarks,l1status,complaints, user_id,description,actionplanned,detailed_description from vw_web_daily_activity d where id ='".$header_id."'";


				$result = $this->db->query($sql);
				$activitydetails = $result->result_array();
				$all_record_count = count($activitydetails);
				$this->session->set_userdata('all_record_count',$all_record_count);

				//  echo"count ".$all_record_count; print_r($activitydetails); die; 


				$data = array();
				
				$i=0;
				while($i < count($activitydetails))
				{    
					$row = array();
				//	$row["id"] = $activitydetails[$i]["id"];
					$row["custgroup"] = $activitydetails[$i]["custgroup"];
					$row["itemgroup"] = $activitydetails[$i]["itemgroup"];
					$row["potentialqty"] = $activitydetails[$i]["potentialqty"];
					$row["subactivity"] = $activitydetails[$i]["subactivity"];
					$row["exename"] = $activitydetails[$i]["exename"];
					$row["branch"] = $activitydetails[$i]["branch"];
					$row["modeofcontact"] = $activitydetails[$i]["modeofcontact"];
					$row["hour_s"] = $activitydetails[$i]["hour_s"];
					$row["minit"] = $activitydetails[$i]["minit"];
					$row["quantity"] = $activitydetails[$i]["quantity"];
					$row["division"] = $activitydetails[$i]["division"];
					$row["date"] = $activitydetails[$i]["date"];
					$row["remarks"] = $activitydetails[$i]["remarks"];
					$row["l1status"] = $activitydetails[$i]["l1status"];
					$row["complaints"] = $activitydetails[$i]["complaints"];
					$row["description"] = $activitydetails[$i]["description"];
					$row["actionplanned"] = $activitydetails[$i]["actionplanned"];
					$row["detailed_description"] = $activitydetails[$i]["detailed_description"];



					$data[$i] = $row;
					$i++;
				}
		//		$arr = "{\"data\":" .json_encode($data). "}";
				$data ='{ "rows": '.json_encode($data).'}';
//				$data =json_encode($data);
				$arr = $data;
		//	echo "{ rows: ".$arr." }";
   //    echo $arr; die;
		 	return $arr;
	}
			function get_products($sql)
			{
				//$sql='SELECT  DISTINCT  itemgroup FROM itemmaster ORDER BY description asc';
				$result = $this->db->query($sql);
				$arr =  json_encode($result->result_array());
				$arr =	 '{ "rows" :'.$arr.' }';
				return $arr;
			}
			function get_customers($sql)
			{
				//$sql='SELECT  DISTINCT  itemgroup FROM itemmaster ORDER BY description asc';
				$result = $this->db->query($sql);
				$arr =  json_encode($result->result_array());
				$arr =	 '{ "rows" :'.$arr.' }';
				return $arr;
			}


			function get_field()
			{
				$result = $this->db->list_fields('itemmaster');
				foreach($result as $field)
				{
					$data[] = $field;
					return $data;
				}
			}
			function GetMaxVal($table)
			{
				$sql ="select max(id) from ".$table;
				$result = $this->db->query($sql);
				//print_r($result->result_array());
				$daily_hdr_id = $result->result_array();
			//	print_r($daily_hdr_id);
				//echo"max id is ".$daily_hdr_id[0]['max'];
				return $daily_hdr_id[0]['max'];

			}
			function save_dailyactivityhdr($daily_hdr)
			{

				if($this->db->insert('dailyactivityhdr', $daily_hdr))
					return true;
				else
					return false;
        			
			}

			function save_daily_details($dailydtls)
			{
			 foreach($dailydtls as $daliydtl)
				{
				//echo"in model<br>";
				// echo"<pre>";print_r($prod);echo"</pre>";
			//	$this->db->insert_batch('dailyactivitydtll', $dailydtls);
				}
				return $this->db->insert_batch('dailyactivitydtl', $dailydtls);
			}

			function check_dailyhdr_duplicates($hrd_currentdate,$user1)
			{
				$sql =  $this->db->select('exename')->from('dailyactivityhdr')->where(array('currentdate' => $hrd_currentdate, 'user1' => $user1))->get();
				//echo $sql->num_rows(); 	die;
			 return $sql->num_rows();
			}
			function get_dailyhdr_update_id($hrd_currentdate,$user1)
			{
				$sql =  $this->db->select('id')->from('dailyactivityhdr')->where(array('currentdate' => $hrd_currentdate, 'user1' => $user1))->get();
				//echo $sql->num_rows(); 	die;
				//$sql ="SELECT id FROM dailyactivityhdr WHERE currentdate = '".$hrd_currentdate."' AND user1 = '".$user1."'";
				//echo $sql;
			//	$result = $this->db->query($sql);
				$daily_hdr_id = $sql->result_array();
			//	print_r($daily_hdr_id);
				//echo" id is ".$daily_hdr_id[0]['id'];
				return $daily_hdr_id[0]['id'];
			// return $sql->num_rows();
			}

			function deteled_dailyactivitydtl($dtl_id)
			{
				if(isset($dtl_id) && !empty($dtl_id))
		            {
		              	$this->db->where('id',$dtl_id);
		              	$this->db->delete('dailyactivitydtl');
		              	return  $this->db->affected_rows();	
		          
		           	 }
			}

			function update_dailyactivityhdr($daily_hdr,$daily_hdr_id)
			{

				$this->db->where('id', $daily_hdr_id);
				$this->db->update('dailyactivityhdr', $daily_hdr);
				return ($this->db->affected_rows() > 0);
			}

			function get_potential_item_customer($item,$customer)
			{
				//echo " item ".$item."<br>"; 				echo " customer ".$customer."<br>";
				$sql="select potential  from vw_potential  where customergroup='".$item."' AND itemgroup ='".$customer."'";
				//echo  $sql;
				$result = $this->db->query($sql);
				
				if($result->num_rows()==0)
				{
					$poten_val['0']['potential']=0;
				}
				else
				{
					$poten_val = $result->result_array();
				}
/*	Array
	(
		[0] => Array
			(
			    [potential] => 100
			)

	)
*/		
				$arr =  json_encode($poten_val);
				$arr =	 '{ "rows" :'.$arr.' }';
				return $arr;
				
			}

			

}
?>

