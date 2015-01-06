<!DOCTYPE html>
<html>
<head>
	<title>Leads Substatus </title>
	<link rel="SHORTCUT ICON" href="#">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="<?= base_url()?>public/vdfiles/chosen.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/vdfiles/jquery-ui-1.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/vdfiles/select2.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/bootstrap/css/bootstrap.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/vdfiles/styles.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/vdfiles/validationEngine.css">
	<link rel="stylesheet" href="<?= base_url()?>public/vdfiles/select2.css">
	<link rel="stylesheet" href="<?= base_url()?>public/vdfiles/guiders-1.css">
	<link rel="stylesheet" href="<?= base_url()?>public/vdfiles/jquery_002.css">
	<link rel="stylesheet" href="<?= base_url()?>public/vdfiles/jquery_003.css">
	<link rel="stylesheet" media="screen" type="text/css" href="<?= base_url()?>public/vdfiles/datepicker.css">
	<link rel="stylesheet" href="<?= base_url()?>public/vdfiles/style.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/vdfiles/jquery.css" type="text/css" media="screen">
	<style type="text/css">@media print {.noprint { display:none; }}</style>
	<script type="text/javascript" src="<?= base_url()?>public/vdfiles/jquery_008.js"></script>
<!-- -->
  
<!-- -->
</head>
<body >

<div style="min-height: 636px;" class="bodyContents">
	<div class="mainContainer row-fluid">
		
		<div class="contentsDiv span10 marginLeftZero">
			<input id="recordId" value="21" type="hidden">
			<div class="detailViewContainer">
				
				<div class="detailViewInfo row-fluid">
					<div class=" span10  details">
						<table class="table table-bordered equalSplit detailview-table">
							<thead>
								<tr>
									<th class="blockHeader" colspan="7"><img class="cursorPointer alignMiddle blockToggle  hide  " src="<?= base_url()?>public/vdfiles/arrowRight.png" data-mode="hide" data-id="13"><img class="cursorPointer alignMiddle blockToggle " src="<?= base_url()?>public/vdfiles/arrowDown.png" data-mode="show" data-id="13">&nbsp;&nbsp;Sub Status Details
									</th>
								</tr>
							</thead>
							<tbody>
							<tr class="listViewHeaders">
									<td class="narrowWidthType"  id="Leads_detailView_fieldLabel_lane">
										<label class="muted pull-left marginRight65px">Parent Status</label>
									</td>
									<td class="narrowWidthType"  id="Leads_detailView_fieldLabel_lane">
										<label class="muted pull-left marginRight65px">Sub Status</label>
									</td>
										<td class="narrowWidthType"  id="Leads_detailView_fieldLabel_lane">
										<label class="muted pull-left marginRight65px">Created By</label>
									</td>
										<td class="narrowWidthType"  id="Leads_detailView_fieldLabel_lane">
										<label class="muted pull-left marginRight65px">Updated On</label>
									</td>	
									<td class="narrowWidthType"  id="Leads_detailView_fieldLabel_lane">
										<label class="muted pull-left marginRight65px">Updated By</label>
									</td>
									<td class="narrowWidthType"  id="Leads_detailView_fieldLabel_lane">
										<label class="muted pull-left marginRight65px">Assigned To</label>
									</td>
									
								</tr>
								<?php 
																
								foreach($ldsubstatuslog as $substatuslog)
								 {
								//print_r($substatuslog);
								?>
					
								<tr class="listViewEntries" data-id="21" id="Leads_listView_row_1">
									  <td class="narrowWidthType" data-field-type="salutation" nowrap="nowrap">
									 <?echo $substatuslog['lhsub_lh_lead_curr_status'];?>
									  </td>												
										<td class="narrowWidthType" data-field-type="salutation" nowrap="nowrap">
											<?echo $substatuslog['lhsub_lh_lead_curr_sub_status'];?>
									  </td>
									  <td class="narrowWidthType" data-field-type="salutation" nowrap="nowrap">
										<?echo $substatuslog['lhsub_created_user_name'];?>
									  </td>
										<td class="narrowWidthType" data-field-type="salutation" nowrap="nowrap">
											<?echo $substatuslog['lhsub_lh_updated_date'];?>
									  </td>


										<td class="narrowWidthType" data-field-type="salutation" nowrap="nowrap">
									<?echo $substatuslog['lhsub_modified_user_name'];?>
									 </td>
									 <td class="narrowWidthType" data-field-type="salutation" nowrap="nowrap">
											<?echo $substatuslog['lhsub_assignto_user_name'];?>
									 </td>
									
								</tr>
							<?php				
									}
							  	?>
									
								</tbody>
							</table>
					
				
				</div>
			
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
<input id="activityReminder" class="hide noprint" value="60" type="hidden">
<div id="userfeedback" class="feedback noprint"><a href="javascript:;" onclick="javascript:window.open('<?= base_url()?>product/feedback','feedbackwin','height=400,width=550,top=200,left=300')" class="handle">Feedback</a>
</div>
<footer class="noprint">
			<p align="center" style="margin-top:5px;margin-bottom:0;">Powered by Pure-Chemicals<a target="_blank" href="#">pure-chemical.com</a></p>
            </footer>
<script type="text/javascript" src="<?= base_url()?>public/js/html5.js"></script>

	
	

	<!-- Added in the end since it should be after less file loaded -->
	<script type="text/javascript" src="<?= base_url()?>public/vdfiles/less.js"></script></body></html>
