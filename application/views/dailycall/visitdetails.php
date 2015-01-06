<!DOCTYPE html>
<html>
<head>
	<title>Leads</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href=src="<?= base_url()?>public/css/chosen.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/css/jquery-ui-1.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/css/select2.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/css/bootstrap.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/css/styles.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/css/validationEngine.css">
	<link rel="stylesheet" href="<?= base_url()?>public/css/select2.css">
	<link rel="stylesheet" href="<?= base_url()?>public/css/guiders-1.css">
	<link rel="stylesheet" href="<?= base_url()?>public/css/jquery_002.css">
	<link rel="stylesheet" href="<?= base_url()?>public/css/jquery_003.css">
	<link rel="stylesheet" media="screen" type="text/css" href="<?= base_url()?>public/css/datepicker.css">
	<link rel="stylesheet" href="<?= base_url()?>public/css/style.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/css/jquery.css" type="text/css" media="screen">
	<style type="text/css">@media print {.noprint { display:none; }}</style>


	
</head>
<body>
<?php 
 //echo"<pre> Header Details ";print_r($custvisit_hdr_details);echo"</pre>";
// echo"<pre> Person Details ";print_r($custvisit_prod_details);echo"</pre>";
 // echo"<pre> Product Details ";print_r($custvisit_prod_details);echo"</pre>";
   ?>
<table class="table table-bordered blockContainer showInlineTable">
<tbody>

	<tr>
		<th class="blockHeader" colspan="4">Visit Details</th>
	</tr>
	<tr>
		<td class="fieldLabel narrowWidthType">
			<label class="muted pull-right marginRight10px">Date of Visit</label>
		</td>
		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
						<?php echo $custvisit_hdr_details[0]['hdr_visitdate'];?>
			</span>
				
			</div>
		</td>
		<td class="fieldLabel narrowWidthType">
			<label class="muted pull-right marginRight10px">Type of Call</label>
		</td>
		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
				<?php echo $custvisit_hdr_details[0]['hdr_visittype_name'];?>
				</span>
			</div>
		</td>
	</tr>
	<tr>
		<td class="fieldLabel narrowWidthType">
			<label class="muted pull-right marginRight10px">Time Spent</label>
		</td>
		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
						<?php echo $custvisit_hdr_details[0]['hdr_time_hrs'];?>  :&nbsp;&nbsp;&nbsp;&nbsp;
						<?php echo $custvisit_hdr_details[0]['hdr_time_mis'];?> 
			</span>
				
			</div>
		</td>
		<td class="fieldLabel narrowWidthType">
			<label class="muted pull-right marginRight10px">Mode of Contact</label>
		</td>
		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
				<?php echo $custvisit_hdr_details[0]['hdr_modeofcontact_name'];?>
				</span>
			</div>
		</td>
	</tr>
	<tr>
		<td class="fieldLabel narrowWidthType">
			<label class="muted pull-right marginRight10px">Collection </label>
		</td>
		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
						<?php echo $custvisit_hdr_details[0]['hdr_collection'];?>
			</span>
				
			</div>
		</td>
		<td class="fieldLabel narrowWidthType">
			<label class="muted pull-right marginRight10px">Statutory</label>
		</td>
		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
				<?php echo $custvisit_hdr_details[0]['hdr_statuory'];?>
				</span>
			</div>
		</td>
	</tr>
</tbody>
</table>

<table class="table table-bordered blockContainer showInlineTable">
<tbody>

	<tr>
	<th class="blockHeader" colspan="5">Person Met Details</th>
	</tr>	
	<tr class="listViewHeaders">
              <td class="narrowWidthType" id="">
                        <label class="muted pull-left marginRight50px">Contact Name</label>
                      </td>
                      <td class="narrowWidthType" id="">
                        <label class="muted pull-left marginRight50px">Designation</label>
                      </td>
                      <td class="narrowWidthType" id="">
                        <label class="muted pull-left marginRight50px">Phone Number</label>
                       </td>
                         <td class="narrowWidthType" id="">
                        <label class="muted pull-left marginRight50px">Mobile Number</label>
                       </td>
                        <td class="narrowWidthType" id="">
                        <label class="muted pull-left marginRight50px">Email Id</label>
                       </td>
                       <td>
                       	<table class="table table-bordered blockContainer showInlineTable">
                       		<tr class="listViewHeaders">
                       			<th class="narrowWidthType" colspan="4">Mail Alerts</th>
                       		</tr>
                       		<tr>
                       			<td  class="narrowWidthType">
                       				 <label class="muted pull-left marginRight50px">Soc</label>
                       			</td>
                       			<td  class="narrowWidthType">
                       				 <label class="muted pull-left marginRight50px">Payment</label>
                       			</td>
                       			<td  class="narrowWidthType">
                       				 <label class="muted pull-left marginRight50px">General</label>
                       			</td>
                       			<td  class="narrowWidthType">
                       				 <label class="muted pull-left marginRight50px">Quotation</label>
                       			</td>
                       		</tr>
                       	</table>
                       </td>
                  
		</tr>
	  <?php if (count($custvisit_person_details)>0)
                 {
                  for($i=0; $i<count($custvisit_person_details); $i++)
                  {?>
              
	<tr>
		

		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
						<?php echo $custvisit_person_details[$i]['dc_personmet_name'];?>
			</span>
				
			</div>
		</td>
		
		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
				<?php echo $custvisit_person_details[$i]['dc_designation'];?>
				</span>
			</div>
		</td>
		
		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
				<?php echo $custvisit_person_details[$i]['dc_phone_no'];?>
				</span>
			</div>
		</td>
		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
				<?php echo $custvisit_person_details[$i]['dc_mobile_no'];?>
				</span>
			</div>
		</td>
		
		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
				<?php echo $custvisit_person_details[$i]['dc_email_id'];?>
				</span>
			</div>
		</td>
		   <td>
                       	<table class="table table-bordered blockContainer showInlineTable">
                       		
                       		<tr>
                       			<td class="fieldValue narrowWidthType">
                       				 <div class="row-fluid">
								<span class="span10">
								<?php echo $custvisit_person_details[$i]['soc_mail'];?>
								</span>
							</div>
                       			</td>
                       			<td class="fieldValue narrowWidthType">
                       				 <div class="row-fluid">
								<span class="span10">
								<?php echo $custvisit_person_details[$i]['payment_mail'];?>
								</span>
							</div>
                       			</td>
                       		<td class="fieldValue narrowWidthType">
                       				 <div class="row-fluid">
								<span class="span10">
								<?php echo $custvisit_person_details[$i]['general_mail'];?>
								</span>
							</div>
                       			</td>
                       		<td class="fieldValue narrowWidthType">
                       				 <div class="row-fluid">
								<span class="span10">
								<?php echo $custvisit_person_details[$i]['quotation_mail'];?>
								</span>
							</div>
                       			</td>
                       		</tr>
                       	</table>
                       </td>
		
	</tr>
	  <?php 
                  }
                  ?>

                
                 <?php } else {?>
                 <tr>  <td colspan="3" class="fieldValue narrowWidthType" style="text-align: center;"><font color="blue"> No data to display </font></td> </tr>
                 <?php } ?>
         </tbody>
       </table>
       <table class="table table-bordered blockContainer showInlineTable">
<tbody>

	<tr>
		<th class="blockHeader" colspan="7">Product  Details updated By <?php echo $custvisit_prod_details[0]['hdr_updateduser_name']; ?></th>
	</tr>	
	<tr class="listViewHeaders">
		    <td class="narrowWidthType" id="">
                        <label class="muted pull-left marginRight50px">Product Name</label>
                      </td>
                      <td class="narrowWidthType" id="">
                        <label class="muted pull-left marginRight50px">Potential</label>
                      </td>
                      <td class="narrowWidthType" id="">
                        <label class="muted pull-left marginRight50px">Quantity</label>
                       </td>
                        <td class="narrowWidthType" id="">
                        <label class="muted pull-left marginRight50px">Sales Type</label>
                       </td>
                        <td class="narrowWidthType" id="">
                        <label class="muted pull-left marginRight50px">Action Planned</label>
                       </td>
                        <td class="narrowWidthType" id="">
                        <label class="muted pull-left marginRight50px">Sales</label>
                       </td>
                        <td class="narrowWidthType" id="">
                        <label class="muted pull-left marginRight50px">Market Information</label>
                       </td>
                 
		</tr>
	  <?php if (count($custvisit_prod_details)>0)
                 {
                  for($i=0; $i<count($custvisit_prod_details); $i++)
                  {?>
              
	<tr>
	

		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
						<?php echo $custvisit_prod_details[$i]['dtllog_prodgroup'];?>
			</span>
				
			</div>
		</td>
		
		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
				<?php echo $custvisit_prod_details[$i]['dtllog_poten'];?>
				</span>
			</div>
		</td>
		
		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
				<?php echo $custvisit_prod_details[$i]['dtllog_qnty'];?>
				</span>
			</div>
		</td>
		
		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
				<?php echo $custvisit_prod_details[$i]['dtllog_salestype_name'];?>
				</span>
			</div>
		</td>
		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
				<?php echo $custvisit_prod_details[$i]['dtllog_actionplanned'];?>

				</span>
			</div>
		</td>
		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
				<?php echo $custvisit_prod_details[$i]['dtllog_sales'];?>
				</span>
			</div>
		</td>
		<td class="fieldValue narrowWidthType">
			<div class="row-fluid">
				<span class="span10">
				<?php echo $custvisit_prod_details[$i]['dtllog_market_info'];?>
				</span>
			</div>
		</td>
	</tr>
	  <?php 
                  }
                  ?>

                
                 <?php } else {?>
                 <tr>  <td colspan="3" class="fieldValue narrowWidthType" style="text-align: center;"><font color="blue"> No data to display </font></td> </tr>
                 <?php } ?>
         </tbody>
       </table>
</body>
</html>
