<?php

class Exportexcel extends CI_Controller 
{

    public $leaddetails = array();
	function __construct()
		{
		 parent::__construct();
			 $this->load->database();
			 $this->load->helper('url');
			 $this->load->model('Exportexcel_model');
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


           function index()
		{

             

		  $sql = 'SELECT 
                                lead_dtl.leadid,
                                lead_dtl.lead_no,
                                lead_dtl.email_id, 
                                lead_dtl.firstname, 
                                lead_dtl.lastname, 
                                lead_dtl.industry,
                                lead_dtl.website,
                                lead_dtl.user_branch, 
                                lead_dtl.designation,
                                lead_dtl.comments,
                                lead_dtl.uploaded_date,
                                lead_dtl.description,
                                lead_dtl.ldsubstatus,
                                lead_dtl.secondaryemail,
                                lead_dtl.assignleadchk, 
                                lead_dtl.createddate, 
                                lead_dtl.leadstatus,
                                lead_dtl.leadsource,
                                lead_dtl.company, 
                                lead_dtl.customer_id, 
                                lead_dtl.created_user, 
                                lead_dtl.last_modified, 
                                lead_dtl.last_updated_user, 
                                lead_dtl.sent_mail_alert, 
                                lead_dtl.industry_id,
                                lead_dtl.assign_from_name,
                                lead_dtl.empname,
                                lead_dtl.tempcustname as CustomerName
                     
                    FROM 
                                ( 
                                      SELECT 
                                                  leaddetails.leadid,
                                                  leaddetails.lead_no,
                                                  leaddetails.email_id,
                                                  leaddetails.interest,
                                                  leaddetails.firstname,
                                                  leaddetails.salutation,
                                                  leaddetails.lastname,
                                                  leaddetails.annualrevenue,
                                                  leaddetails.industry,
                                                  leaddetails.website,
                                                  leaddetails.user_branch,
                                                  leaddetails.converted,
                                                  leaddetails.designation,
                                                  leaddetails.lead_crm_soc_no,
                                                  leaddetails.comments,
                                                  leaddetails.producttype,
                                                  leaddetails.exporttype,
                                                  leaddetails.presentsource,
                                                  leaddetails.decisionmaker,
                                                  leaddetails.domestic_supplier_name,
                                                  leaddetails.uploaded_date,
                                                  leaddetails.nextstepdate,
                                                  leaddetails.fundingsituation,
                                                  leaddetails.description,
                                                  leaddetails.transferdate,
                                                  leaddetails.revenuetype,
                                                  leaddetails.ldsubstatus,
                                                  leaddetails.secondaryemail,
                                                  leaddetails.assignleadchk,
                                                  leaddetails.createddate,
                                                  leaddetails.leadstatus as leadstatusid,
                                                  leaddetails.leadsource as leadsourceid,
                                                  leadstatus.leadstatus,
                                                  leadsource.leadsource,
                                                  leaddetails.company,
                                                  leaddetails.customer_id,
                                                  leaddetails.created_user,
                                                  leaddetails.last_modified,
                                                  leaddetails.last_updated_user,
                                                  leaddetails.sent_mail_alert,
                                                  leaddetails.industry_id,
                                                  t.assign_from_name,
                                                  vw_web_user_login.empname,
                                                  view_tempcustomermaster.tempcustname
                                      FROM 
                                                  "leaddetails" 
                                                   INNER JOIN "leadstatus" ON "leadstatus"."leadstatusid" = "leaddetails"."leadstatus" 
                                                   INNER JOIN "leadsource" ON "leadsource"."leadsourceid"= "leaddetails"."leadsource" 
                                                   INNER JOIN (
                                                                          SELECT 
                                                                                      header_user_id,
                                                                                      empname as assign_from_name 
                                                                          FROM 
                                                                                      vw_web_user_login 
                                                                    ) t ON "leaddetails"."created_user" = "t"."header_user_id" 
                                                  INNER JOIN "vw_web_user_login" ON "leaddetails"."assignleadchk" = "vw_web_user_login"."header_user_id" 
                                                  INNER JOIN "leadaddress" ON "leaddetails"."leadid" = "leadaddress"."leadaddressid" 
                                                  INNER JOIN "view_tempcustomermaster" ON "leaddetails"."company" = "view_tempcustomermaster"."id" 
                                   
                                UNION
                                SELECT 
                                            leaddetails.leadid,
                                            leaddetails.lead_no,
                                            leaddetails.email_id,
                                            leaddetails.interest,
                                            leaddetails.firstname,
                                            leaddetails.salutation,
                                            leaddetails.lastname,
                                            leaddetails.annualrevenue,
                                            leaddetails.industry,
                                            leaddetails.website,
                                            leaddetails.user_branch,
                                            leaddetails.converted,
                                            leaddetails.designation,
                                            leaddetails.lead_crm_soc_no,
                                            leaddetails.comments,
                                            leaddetails.producttype,
                                            leaddetails.exporttype,
                                            leaddetails.presentsource,
                                            leaddetails.decisionmaker,
                                            leaddetails.domestic_supplier_name,
                                            leaddetails.uploaded_date,
                                            leaddetails.nextstepdate,
                                            leaddetails.fundingsituation,
                                            leaddetails.description,
                                            leaddetails.transferdate,
                                            leaddetails.revenuetype,
                                            leaddetails.ldsubstatus,
                                            leaddetails.secondaryemail,
                                            leaddetails.assignleadchk,
                                            leaddetails.createddate,
                                            leaddetails.leadstatus as leadstatusid,
                                            leaddetails.leadsource as leadsourceid,
                                            leadstatus.leadstatus,
                                            leadsource.leadsource,
                                            leaddetails.company,
                                            leaddetails.customer_id,
                                            leaddetails.created_user,
                                            leaddetails.last_modified,
                                            leaddetails.last_updated_user,
                                            leaddetails.sent_mail_alert,
                                            leaddetails.industry_id,
                                            t.assign_from_name,
                                            vw_web_user_login.empname,
                                            view_tempcustomermaster.tempcustname
                                FROM 
                                            "leaddetails" 
                                             LEFT OUTER  JOIN "leadstatus" ON "leadstatus"."leadstatusid" = "leaddetails"."leadstatus" 
                                             LEFT OUTER  JOIN "leadsource" ON "leadsource"."leadsourceid"= "leaddetails"."leadsource" 
                                             LEFT OUTER  JOIN 
                                                              (
                                                                    SELECT 
                                                                                header_user_id, 
                                                                                empname as assign_from_name 
                                                                    FROM 
                                                                                vw_web_user_login 
                                                              ) t ON "leaddetails"."created_user" = "t"."header_user_id" 
                                            LEFT OUTER  JOIN "vw_web_user_login" ON "leaddetails"."assignleadchk" = "vw_web_user_login"."header_user_id" 
                                             LEFT OUTER  JOIN "leadaddress" ON "leaddetails"."leadid" = "leadaddress"."leadaddressid"
                                             LEFT OUTER  JOIN "view_tempcustomermaster" ON "leaddetails"."company" = "view_tempcustomermaster"."id"
                                ) lead_dtl ORDER BY leadid'; 

                $headings = array('leadid','lead_no','email_id','firstname','lastname','industry','website','user_branch','designation','comments',' uploaded_date','description','ldsubstatus','secondaryemail','assignleadchk','createddate','leadstatus','leadsource','company','customer_id','created_user','last_modified','last_updated_user','sent_mail_alert','industry_id','assign_from_name','empname','customername'); 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                 
              //echo $sql; die;
              $result = $this->db->query($sql);
              //print_r($result); die;
              if ($result ) 
              {
                  // Create a new PHPExcel object 
                  $objPHPExcel = new PHPExcel(); 
                  $objPHPExcel->getActiveSheet()->setTitle('List of Users'); 

                  $rowNumber = 1; 
                  $col = 'A'; 
                  foreach($headings as $heading) { 
                    $objPHPExcel->getActiveSheet()->setCellValue($col.$rowNumber,$heading); 
                    $col++; 
                  } 
                  // Loop through the result set 
                  $rowNumber = 2; 
                  $result = $this->db->query($sql);
                  $leaddetails = $result->result_array();
                  $count = $result->num_rows();
                  //print_r($leaddetails);

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
                  header('Content-Disposition: attachment;filename="LeadList.xls"'); 
                  header('Cache-Control: max-age=0'); 

                  $objWriter->save('php://output'); 
                  exit(); 
		}
    }

      function leadproductsreport()
      {

      $sql = "SELECT 
                              leaddetails.leadid,
                              leaddetails.lead_no,
                              leaddetails.email_id,
                              leaddetails.firstname,
                              leaddetails.lastname,
                              leaddetails.created_user,
                              leaddetails.producttype As EndProductType,
                              leaddetails.exporttype as ProductSaleType,
                              leaddetails.presentsource as PresentSource,
                              leaddetails.domestic_supplier_name as SupplierName,
                              leaddetails.decisionmaker as DecisionMaker,
                              leaddetails.user_branch as BranchName,
                              leaddetails.comments,
                              leaddetails.uploaded_date as UploadedDate,
                              leaddetails.description,
                              leaddetails.secondaryemail,
                              (  select DISTINCT aliasloginname from vw_web_user_login where header_user_id = leaddetails.assignleadchk      ) as AssignedToUser,
                              leaddetails.createddate as CreatedDate,
                              (  select DISTINCT aliasloginname from vw_web_user_login where header_user_id = leaddetails.created_user      ) as CreatedBy,
                              leaddetails.last_modified,
                              (  select DISTINCT aliasloginname from vw_web_user_login where header_user_id = leaddetails.last_updated_user      ) as UpdatedBY,
                              leaddetails.sent_mail_alert,
                              leadsource.leadsource as LeadSource,
                              leadstatus.leadstatus as PrimaryStatus,
                              leadsubstatus.lst_name as SubStatusName,
                              vw_web_user_login.aliasloginname as LoginName,
                              leadproducts.quantity as ProdQnty,
                              leadproducts.last_modified as ProductUpdateDate,
                              leadproducts.created_date,
                              (  select DISTINCT aliasloginname from vw_web_user_login where header_user_id = leadproducts.created_user      ) as ProdCreatedBy,
                              (  select DISTINCT aliasloginname from vw_web_user_login where header_user_id = leadproducts.last_updated_user      ) as ProdUpdatedBy,
                              leadproducts.prod_type_id,
                              leadproducts.potential as LeadPoten,
                              industry_segment.industrysegment,
                              itemmaster.description as ProductName,
                              itemmaster.itemgroup,
                              itemmaster.organisation,
                              itemmaster.uom,
                              itemmaster.uomeasure,
                              customermasterhdr.tempcustname as CustomerName,

                              CASE 
                                WHEN customermasterhdr.cust_account_id=0 THEN 'NewCustomer'
                                        ELSE 'ExistingCustomer'
                                    END as customertype

                          FROM
                              leaddetails 

                              INNER JOIN  leadsource    ON (leaddetails.leadsource = leadsource.leadsourceid)
                              INNER JOIN  leadstatus    ON (leaddetails.leadstatus = leadstatus.leadstatusid)
                              LEFT OUTER JOIN  leadsubstatus    ON (leaddetails.ldsubstatus = leadsubstatus.lst_sub_id)
                              LEFT OUTER JOIN  vw_web_user_login    ON (leaddetails.assignleadchk = vw_web_user_login.header_user_id)
                              LEFT OUTER JOIN  leadproducts    ON (leaddetails.leadid = leadproducts.leadid)
                              LEFT OUTER JOIN  industry_segment    ON (leaddetails.industry_id = industry_segment.id)
                              LEFT OUTER JOIN  itemmaster ON (leadproducts.productid = itemmaster.itemid)
                              LEFT OUTER JOIN  customermasterhdr ON (leaddetails.customer_id = customermasterhdr.id)
                              LEFT OUTER JOIN  web_lead_loghistory ON (leaddetails.leadid = web_lead_loghistory.lh_lead_id 
                              AND leaddetails.assignleadchk = web_lead_loghistory.assignto_user_id)

                          ORDER BY 
                              leaddetails.leadid"; 

          //      $headings = array('leadid','lead_no','email_id','firstname','lastname','industry','website','user_branch','designation','comments',' uploaded_date','description','ldsubstatus','secondaryemail','assignleadchk','createddate','leadstatus','leadsource','company','customer_id','created_user','last_modified','last_updated_user','sent_mail_alert','industry_id','assign_from_name','empname','customername'); 
            
                  $headings = array('leadid','lead_no','email_id','firstname','lastname','created_user','endproducttype','productsaletype','presentsource','suppliername','decisionmaker','branchname','comments','uploadeddate','description','secondaryemail','assignedtouser','createddate','createdby','last_modified','updatedby','sent_mail_alert','leadsource','primarystatus','substatusname','loginname','prodqnty','productupdatedate','created_date','prodcreatedby','produpdatedby','prod_type_id','leadpoten','industrysegment','productname','itemgroup','organisation','uom','uomeasure','customername','customertype');

        //      echo $sql; die;
              $result = $this->db->query($sql);
              //print_r($result); die;
              if ($result ) 
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
                  //print_r($leaddetails);

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
                  header('Content-Disposition: attachment;filename="LeadsProductsList.xls"'); 
                  header('Cache-Control: max-age=0'); 

                  $objWriter->save('php://output'); 
                  exit(); 
   
    }
      }
  

}




