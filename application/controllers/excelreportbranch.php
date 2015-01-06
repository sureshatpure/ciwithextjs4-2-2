<?php

class Excelreportbranch extends CI_Controller 
{

	
	public $leaddetails = array();

	function __construct()
	{
		 parent::__construct();
			
			$this->load->database();
                 $this->load->library('session');
			//load new PHPExcel library
			$this->load->library('excel');
			//activate worksheet number 1
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('test worksheet');
			//set cell A1 content with some text
			$this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
			//change the font size
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			//merge cell A1 until D1
			$this->excel->getActiveSheet()->mergeCells('A1:D1');
			//set aligment to center for that merged cell (A1 to D1)
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);



	
	}




		function exgetdatawithfilter($branch,$user_id=0)
		{
                @$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];
			 //$headings = array('leadid','lead_no','email_id','firstname','lastname','created_user','AssigndTo','Street','endproducttype','productsaletype','presentsource','suppliername','decisionmaker','branchname','comments','uploadeddate','description','secondaryemail','assignedtouser','createddate','createdby','last_modified','updatedby','sent_mail_alert','leadsource','primarystatus','substatusname','loginname','prodqnty','productupdatedate','created_date','prodcreatedby','produpdatedby','prod_type_id','leadpoten','industrysegment','productname','itemgroup','organisation','uom','uomeasure','customername','customertype');
                $headings = array('leadid','lead_no','email_id','firstname','lastname','Branch','Comments','Converted','uploadeddate','description','phone_no','mobile_no','address','secondaryemail','AssignedToUserID','AssignTo','Created Date','Created By','Lastupdate Date','Lastupdated By','sent_mail_alert','leadsource','lead_close_status','primarystatus','substatusname','loginname','prodqnty','Repack','Intact','Bulk','Small Packing','Single Tanker','Part Tanker','productupdatedate','created_date','prodcreatedby','produpdatedby','industrysegment','ProdcutId','productname','itemgroup','organisation','uom','uomeasure','customername','customertype');
              if($get_assign_to_user_id=="")
              {
                if($user_id=="")
                     {
                      $sql = "SELECT  * FROM export_excel_horizontal_type WHERE  branchname='".strtoupper($branch)."'";   
                     }
                    else
                    {
                      //$sql = "SELECT * FROM vw_lead_export_excel WHERE  branchname='".$branch."' AND created_user IN (".$user_id.")"; 
                      $sql = "SELECT  * FROM export_excel_horizontal_type WHERE  branchname='".strtoupper($branch)."' AND asignedto_userid IN (".$user_id.")";  
                    }
              }
              else
              {
                if($user_id=="")
                     {
                          $sql = "SELECT  * FROM export_excel_horizontal_type WHERE  branchname='".strtoupper($branch)."' AND asignedto_userid IN (".$get_assign_to_user_id.")";  
                     }
                    else
                    {
                      //$sql = "SELECT * FROM vw_lead_export_excel WHERE  branchname='".$branch."' AND created_user IN (".$user_id.")"; 
                      $sql = "SELECT  * FROM export_excel_horizontal_type WHERE  branchname='".strtoupper($branch)."' AND asignedto_userid IN (".$user_id.")";  
                    }

              }
			 
			
		//	echo $sql; die;
			$result = $this->db->query($sql);
		//	print_r($result); die;
			if (@$result ) 
			{
					// Create a new PHPExcel object 
					$objPHPExcel = new PHPExcel(); 
					$objPHPExcel->getActiveSheet()->setTitle('List of Users'); 

					$rowNumber = 1; 
					$col = 'A'; 
					foreach($headings as $heading) 
					{ 
						$objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$heading); 
						$col++; 
					} 
					// Loop through the result set 
					$rowNumber = 2; 
					$result = $this->db->query($sql);
					$leaddetails = $result->result_array();
					$count = $result->num_rows();
				//	print_r($leaddetails); die;

					for($i=0; $i<$count;$i++)
					{
						$col = 'A'; 
						foreach ($leaddetails[$i] as $row=>$cell) 
						{
							/*echo"col ".$col."<br>";
							echo"rowNumber ".$rowNumber."<br>";
							echo"cell ".$cell."<br>";*/

							$objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$cell); 
							$col++; 
						} 
						$rowNumber++; 
					}

					$objPHPExcel->getActiveSheet()->freezePane('A2'); 

					// Save as an Excel BIFF (xls) file 
					$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 

					header('Content-Type: application/vnd.ms-excel'); 
					header('Content-Disposition: attachment;filename="'.$branch.'LeadProductsList.xls"'); 
					//header('Content-Disposition: attachment;filename="LeadsProductsList.xls"'); 
					header('Cache-Control: max-age=0'); 

					$objWriter->save('php://output'); 
					exit(); 
			}
			else
			{
				echo"no records";
			}

		}

/* Start - exgetdatabranch_user_dt_filter*/
function exgetdatabranch_user_dt_filter($branch,$user_id,$from_date,$to_date)
    {
    //  print_r($this->session->userdata);
      @$reportingto = $this->session->userdata['reportingto'];

      @$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];

      $headings = array('leadid','lead_no','email_id','firstname','lastname','Branch','Comments','Converted','uploadeddate','description','phone_no','mobile_no','address','secondaryemail','AssignedToUserID','AssignTo','Created Date','Created By','Lastupdate Date','Lastupdated By','sent_mail_alert','leadsource','lead_close_status','primarystatus','substatusname','loginname','prodqnty','Repack','Intact','Bulk','Small Packing','Single Tanker','Part Tanker','productupdatedate','created_date','prodcreatedby','produpdatedby','industrysegment','ProdcutId','productname','itemgroup','organisation','uom','uomeasure','customername','customertype');

       if($get_assign_to_user_id=="")
       {
        $sql = "SELECT  * FROM export_excel_horizontal_type WHERE  branchname='".$branch."'  AND asignedto_userid IN (".$user_id.") AND createddate::DATE  between '".$from_date."'::DATE  and '".$to_date."'::DATE"; 
       }
      else
      {
        //$sql = "SELECT * FROM vw_lead_export_excel WHERE  branchname='".$branch."' AND created_user IN (".$user_id.")"; 
        $sql = "SELECT  * FROM export_excel_horizontal_type WHERE  branchname='".$branch."' AND asignedto_userid IN (".$user_id.") AND createddate::DATE  between '".$from_date."'::DATE  and '".$to_date."'::DATE"; 
      }
      
     // echo $sql; die;
      $result = $this->db->query($sql);
    //  print_r($result); die;
      if (@$result ) 
      {
          // Create a new PHPExcel object 
          $objPHPExcel = new PHPExcel(); 
          $objPHPExcel->getActiveSheet()->setTitle('List of Users'); 

          $rowNumber = 1; 
          $col = 'A'; 
          foreach($headings as $heading) 
          { 
            $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$heading); 
            $col++; 
          } 
          // Loop through the result set 
          $rowNumber = 2; 
          $result = $this->db->query($sql);
          $leaddetails = $result->result_array();
          $count = $result->num_rows();
        //  print_r($leaddetails); die;

          for($i=0; $i<$count;$i++)
          {
            $col = 'A'; 
            foreach ($leaddetails[$i] as $row=>$cell) 
            {
              /*echo"col ".$col."<br>";
              echo"rowNumber ".$rowNumber."<br>";
              echo"cell ".$cell."<br>";*/

              $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$cell); 
              $col++; 
            } 
            $rowNumber++; 
          }

          $objPHPExcel->getActiveSheet()->freezePane('A2'); 

          // Save as an Excel BIFF (xls) file 
          $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 

          header('Content-Type: application/vnd.ms-excel'); 
          header('Content-Disposition: attachment;filename="'.$branch.$user_id.'-'.$from_date.'_'.$to_date.'LeadProductsList.xls"'); 
          //header('Content-Disposition: attachment;filename="LeadsProductsList.xls"'); 
          header('Cache-Control: max-age=0'); 

          $objWriter->save('php://output'); 
          exit(); 
      }
      else
      {
        echo"no records";
      }



    }
/* End - exgetdatabranch_user_dt_filter*/

/* Start - exgetdatabranch_dt_filter*/
function exgetdatabranch_dt_filter($branch,$from_date,$to_date)
    {
    //   @$reportingto = $this->session->userdata['reportingto'];
       @$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];
      $headings = array('leadid','lead_no','email_id','firstname','lastname','Branch','Comments','Converted','uploadeddate','description','phone_no','mobile_no','address','secondaryemail','AssignedToUserID','AssignTo','Created Date','Created By','Lastupdate Date','Lastupdated By','sent_mail_alert','leadsource','lead_close_status','primarystatus','substatusname','loginname','prodqnty','Repack','Intact','Bulk','Small Packing','Single Tanker','Part Tanker','productupdatedate','created_date','prodcreatedby','produpdatedby','industrysegment','ProdcutId','productname','itemgroup','organisation','uom','uomeasure','customername','customertype');
       if($get_assign_to_user_id=="")
       {
        $sql = "SELECT  * FROM export_excel_horizontal_type WHERE  branchname='".$branch."' AND createddate::DATE  between '".$from_date."'::DATE  and '".$to_date."'::DATE"; 
       }
      else
      {
        
      //  $sql = "SELECT * FROM vw_lead_export_excel WHERE  branchname='".$branch."' AND asignedto_userid IN (".$user_id.") AND createddate::DATE  between '".$from_date."'::DATE  and '".$to_date."'::DATE"; 
        $sql = "SELECT * FROM export_excel_horizontal_type WHERE  branchname='".$branch."' AND asignedto_userid IN (".$get_assign_to_user_id.") AND createddate::DATE  between '".$from_date."'::DATE  and '".$to_date."'::DATE"; 
      }
      
      //echo $sql; die;
      $result = $this->db->query($sql);
    //  print_r($result); die;
      if (@$result ) 
      {
          // Create a new PHPExcel object 
          $objPHPExcel = new PHPExcel(); 
          $objPHPExcel->getActiveSheet()->setTitle('List of Users'); 

          $rowNumber = 1; 
          $col = 'A'; 
          foreach($headings as $heading) 
          { 
            $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$heading); 
            $col++; 
          } 
          // Loop through the result set 
          $rowNumber = 2; 
          $result = $this->db->query($sql);
          $leaddetails = $result->result_array();
          $count = $result->num_rows();
        //  print_r($leaddetails); die;

          for($i=0; $i<$count;$i++)
          {
            $col = 'A'; 
            foreach ($leaddetails[$i] as $row=>$cell) 
            {
              /*echo"col ".$col."<br>";
              echo"rowNumber ".$rowNumber."<br>";
              echo"cell ".$cell."<br>";*/

              $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$cell); 
              $col++; 
            } 
            $rowNumber++; 
          }

          $objPHPExcel->getActiveSheet()->freezePane('A2'); 

          // Save as an Excel BIFF (xls) file 
          $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 

          header('Content-Type: application/vnd.ms-excel'); 
          header('Content-Disposition: attachment;filename="'.$branch.'-'.$from_date.'_'.$to_date.'LeadProductsList.xls"'); 
          //header('Content-Disposition: attachment;filename="LeadsProductsList.xls"'); 
          header('Cache-Control: max-age=0'); 

          $objWriter->save('php://output'); 
          exit(); 
      }
      else
      {
        echo"no records";
      }

    }
/* End - exgetdatabranch_dt_filter */





    function exgetallleaddata()
    {

           $headings = array('leadid','lead_no','email_id','firstname','lastname','Branch','Comments','Converted','uploadeddate','description','phone_no','mobile_no','address','secondaryemail','AssignedToUserID','AssignTo','Created Date','Created By','Lastupdate Date','Lastupdated By','sent_mail_alert','leadsource','lead_close_status','primarystatus','substatusname','loginname','prodqnty','Repack','Intact','Bulk','Small Packing','Single Tanker','Part Tanker','productupdatedate','created_date','prodcreatedby','produpdatedby','industrysegment','ProdcutId','productname','itemgroup','organisation','uom','uomeasure','customername','customertype');
          @$get_assign_to_user_id=$this->session->userdata['get_assign_to_user_id'];

        if ($this->session->userdata['reportingto']=="")
          {
            $sql = "SELECT  * FROM export_excel_horizontal_type";    
          }
          else
          {
          //$sql = "SELECT * FROM vw_lead_export_excel WHERE  branchname='".$branch."' AND created_user IN (".$user_id.")"; 
            $sql = "SELECT  * FROM export_excel_horizontal_type WHERE asignedto_userid IN (".$get_assign_to_user_id.")"; 
          }

        //    echo $sql; die;
          $result = $this->db->query($sql);
          //  print_r($result); die;
          if (@$result ) 
          {
              // Create a new PHPExcel object 
              $objPHPExcel = new PHPExcel(); 
              $objPHPExcel->getActiveSheet()->setTitle('List of Users'); 

              $rowNumber = 1; 
              $col = 'A'; 
              foreach($headings as $heading) 
              { 
                $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$heading); 
                $col++; 
              } 
              // Loop through the result set 
              $rowNumber = 2; 
              $result = $this->db->query($sql);
              $leaddetails = $result->result_array();
              $count = $result->num_rows();
              //  print_r($leaddetails); die;

              for($i=0; $i<$count;$i++)
              {
                  $col = 'A'; 
                  foreach ($leaddetails[$i] as $row=>$cell) 
                  {
                    $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$cell); 
                    $col++; 
                  } 
                  $rowNumber++; 
              }

              $objPHPExcel->getActiveSheet()->freezePane('A2'); 

              // Save as an Excel BIFF (xls) file 
              $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5'); 

              header('Content-Type: application/vnd.ms-excel'); 
              header('Content-Disposition: attachment;filename="AllLeadProductsList.xls"'); 
              //header('Content-Disposition: attachment;filename="LeadsProductsList.xls"'); 
              header('Cache-Control: max-age=0'); 

              $objWriter->save('php://output'); 
              exit(); 
          }
          else
          {
            echo"no records";
          }



    }

		

		

} // End of Class
?>
