<!DOCTYPE html>
<html>
<head>
	<title>Leads</title>
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
<div id="page">
	<!-- container which holds data temporarly for pjax calls -->
	<div id="pjaxContainer" class="hide noprint"></div>
	<div class="navbar navbar-fixed-top  navbar-inverse noprint" style="min-width:1050px">
		<div class="navbar" id="topMenus">
			<div class="navbar-inner" id="nav-inner">
				<div class="menuBar row-fluid">
					<div class="span9" style="height: 30px;">
						<ul class="nav modulesList">
							<li class="tabs"><a class="alignMiddle " href="#"><img src="<?= base_url()?>public/vdfiles/home.png" alt="Home" title="Home"></a>
							</li>
							<li class="tabs"><a id="menubar_item_Leads" href="<?= base_url()?>leads" class="selected">Leads</a>
							</li>
							<li class="" id="moreMenu"><a data-toggle="dropdown" href="#moreMenu"><b class="caret"></b></a>
								<div class="dropdown-menu moreMenus">
								<a id="menubar_item_moduleManager" href="#" class="pull-right"></a>
								</div>
							</li>
						</ul>
					</div>
					<div class="span3 row-fluid" id="headerLinks">
						<span class="pull-right headerLinksContainer">
							<span class="dropdown span settingIcons "><a id="menubar_item_right_LBL_CRM_SETTINGS" class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="<?= base_url()?>public/vdfiles/setting.png" alt="CRM Settings" title="CRM Settings"></a>
								<ul class="dropdown-menu pull-right">
									<li><a target="" id="menubar_item_right_LBL_CRM_SETTINGS" href="#">CRM Settings</a>
									</li>
								</ul>
							</span>
							<span class="dropdown span">
								<span class="dropdown-toggle row-fluid" data-toggle="dropdown" href="#"><a id="menubar_item_right_Administrator" class="userName textOverflowEllipsis span" title="User"><?php  echo @$this->session->userdata['username']."-".@$this->session->userdata['user_id']."-".@$this->session->userdata['reportingto'];?> <i class="caret"></i> </a>
								</span>
								<ul class="dropdown-menu pull-right">
									<li><a target="" id="menubar_item_right_LBL_MY_PREFERENCES" href="#">My Preferences</a>
									</li>
									<li class="divider">&nbsp;
									</li>
									<li><a target="" id="menubar_item_right_LBL_SIGN_OUT" href="<?=base_url()?>admin/logout">Sign Out</a>
									</li>
								</ul>
							</span>
						</span>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		
		<input value="Leads" id="module" name="module" type="hidden">
		<input value="" id="parent" name="parent" type="hidden">
		<input value="Detail" id="view" name="view" type="hidden">

<div class="navbar commonActionsContainer noprint">
	<div style="position: relative; top: 5px; left: 5.14999px;" class="actionsContainer row-fluid">
		<div class="span2">
			<span class="companyLogo"><img src="<?= base_url()?>public/vdfiles/logo.png" title="logo.png" alt="logo.png">&nbsp;</span>
		</div>
	
		</div>
	</div>
</div>
</div>
</div>
</div>
<div style="min-height: 636px;" class="bodyContents">

	<div class="mainContainer row-fluid">
		<div class="span2 row-fluid">
			<div class="row-fluid">
				<div class="sideBarContents">
					<div class="quickLinksDiv">
						<p onclick="window.location.href='#'" id="Leads_sideBar_link_LBL_RECORDS_LIST" class="unSelectedQuickLink"><a class="quickLinks" href="<?= base_url()?>leads"><strong>Leads List</strong></a>
						</p>
						<p onclick="window.location.href='#'" id="Leads_sideBar_link_LBL_DASHBOARD" class="unSelectedQuickLink"><a class="quickLinks" href="<?= base_url()?>dashboard"><strong>Dashboard</strong></a></p>
					</div>
					<div class="clearfix">
					</div>
					<div class="quickWidgetContainer accordion">
						<div class="quickWidget">
							<div class="accordion-heading accordion-toggle quickWidgetHeader" data-target="#Leads_sideBar_LBL_RECENTLY_MODIFIED" data-toggle="collapse" data-parent="#quickWidgets" data-label="LBL_RECENTLY_MODIFIED" data-widget-url="module=Leads&amp;view=IndexAjax&amp;mode=showActiveRecords">
								<span class="pull-left"><img class="imageElement" data-rightimage="layouts/vlayout/skins/images/rightArrowWhite.png" data-downimage="layouts/vlayout/skins/images/downArrowWhite.png" src="<?= base_url()?>public/vdfiles/rightArrowWhite.png">
								</span><h5 class="title widgetTextOverflowEllipsis pull-right" title="Recently Modified">Recently Modified</h5>
								<div class="loadingImg hide pull-right">
									<div class="loadingWidgetMsg"><strong>Loading Widget</strong>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="widgetContainer accordion-body collapse" id="Leads_sideBar_LBL_RECENTLY_MODIFIED" data-url="module=Leads&amp;view=IndexAjax&amp;mode=showActiveRecords">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="contentsDiv span10 marginLeftZero">
			
			<input id="recordId" value="21" type="hidden">
			<div class="detailViewContainer">
				<div class="row-fluid detailViewTitle">
					<div class="span10">
						<div class="row-fluid">
							<div class="span14">
								<div class="row-fluid">
									<span class="span14"><img src="<?= base_url()?>public/vdfiles/summary_Leads.png" class="summaryImg">
									</span>
									<span class="span14 margin0px">
										<span class="row-fluid">
											<span class="recordLabel font-x-x-large textOverflowEllipsis pushDown span" title="">
												<span class="firstname"><?php  echo $leaddetails['0']['tempcustname'];?></span>&nbsp;
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="salutation">Sale Order Ref No: <?php  echo $leaddetails['0']['lead_crm_soc_no'];?></span>&nbsp;
											
												
										
											</span>
										</span>
										<span class="row-fluid">
											<span class="designation_label"></span>
											<span class="company_label"></span>
										</span>
									</span>
								</div>
							</div>
							<!--<div class="span5">
								<div class="pull-right detailViewButtoncontainer">
									<div class="btn-toolbar">
										
										<span class="btn-group">
											<button class="btn" id="Leads_detailView_basicAction_LBL_SEND_EMAIL" onclick='#'><strong>Send Email</strong>
											</button>
										</span>
										<span class="btn-group">
											<button class="btn" id="Leads_detailView_basicAction_LBL_CONVERT_LEAD" onclick='#'><strong>Convert Lead</strong>
											</button>
										</span>
									</div>
								</div>
							</div>-->
						</div>
					</div>
					<div class="span2 detailViewPagingButton">
						<span class="btn-group pull-right">
							<button class="btn" id="detailViewPreviousRecordButton" disabled="disabled">
								<i class="icon-chevron-left"></i>
							</button>
							<button class="btn" id="detailViewNextRecordButton" onclick="window.location.href='#'"><i class="icon-chevron-right"></i>
							</button>
						</span>
					</div>
				</div>
				<div class="detailViewInfo row-fluid">
					<div class=" span11  details">
						<form id="detailView" data-name-fields="[&quot;firstname&quot;,&quot;lastname&quot;]">
							<div class="contents">
							<input name="timeFormatOptions" data-value="" type="hidden">
							<table class="table table-bordered equalSplit detailview-table">
								<thead>
									<tr>
										<th class="blockHeader" colspan="4"><img class="cursorPointer alignMiddle blockToggle  hide  " src="<?= base_url()?>public/vdfiles/arrowRight.png" data-mode="hide" data-id="13"><img class="cursorPointer alignMiddle blockToggle " src="<?= base_url()?>public/vdfiles/arrowDown.png" data-mode="show" data-id="13">&nbsp;&nbsp;Lead Details
										</th>
									</tr>
								</thead>
								<tbody>
									<tr>
<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_lead_no">
											<label class="muted pull-right marginRight10px">Lead Number</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_lead_no">
											<span class="value" data-field-type="string"><?php echo $leaddetails['0']['leadid']."-". $leaddetails['0']['lead_no']; ?></span>
										</td>
									<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_lastname"><label class="muted pull-right marginRight10px">Industry Type</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_lastname"><span class="value" data-field-type="string"><?php echo $leaddetails['0']['industrysegment']; ?></span>
										
										</td>
					
										
									</tr>
<!-- Start -->
									<tr>
										<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_lead_no">
											<label class="muted pull-right marginRight10px">Customer Finished Goods / End Products</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_lead_no">
											<span class="value" data-field-type="string">
												<?php echo $leaddetails['0']['producttype'];?>
											</span>
										</td>
										<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_lastname">
											<label class="muted pull-right marginRight10px">Customer End Product Sale Type</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_lastname">
											<span class="value" data-field-type="string"><?php echo $leaddetails['0']['exporttype']; ?></span>
										</td>
									</tr>
									<tr>
										<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_lead_no">
											<label class="muted pull-right marginRight10px">Purchase Decision Maker </label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_lead_no">
											<span class="value" data-field-type="string">
												<?php echo $leaddetails['0']['decisionmaker'];?>
											</span>
										</td>
										<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_lastname">
											<label class="muted pull-right marginRight10px">Present Procurement / Purchase source </label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_lastname">
											<span class="value" data-field-type="string"><?php echo $leaddetails['0']['presentsource']; ?>
											<?php if($leaddetails['0']['presentsource']=="Domestic and Import" || $leaddetails['0']['presentsource']=="Domestic") {?>
											<label><font color="blue">Suplier Name is : </font><?php echo $leaddetails['0']['domestic_supplier_name']; ?> </label>		
											<?php } ?>
											</span>
										</td>
									</tr>
<!-- End  -->
									<tr>
										<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_firstname"><label class="muted pull-right marginRight10px">First Name:</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_firstname"><span class="value" data-field-type="salutation"><?php echo $leaddetails['0']['lastname']; ?></span>
											
										</td>
										<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_lastname"><label class="muted pull-right marginRight10px">Last Name</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_lastname"><span class="value" data-field-type="string"><?php echo set_value('email_id',$leaddetails['0']['firstname']); ?></span>
											
										</td>
									
									</tr>
								<tr>
								
									<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_company"><label class="muted pull-right marginRight10px">Lead Source</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_company"><span class="value" data-field-type="string"><?php echo $leaddetails['0']['leadsource']; ?>	</span>
										
										</td>

											<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_company"><label class="muted pull-right marginRight10px">Current Status</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_company"><span class="value" data-field-type="string"><?php echo set_value('email_id',$leaddetails['0']['leadstatus']); ?>	</span>
										
										</td>
									</tr>
									<tr>
								
									<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_company"><label class="muted pull-right marginRight10px">Email-Id</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_company"><span class="value" data-field-type="string"><?php echo $leaddetails['0']['email_id']; ?>	</span>
										
										</td>

											<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_company"><label class="muted pull-right marginRight10px">P.O.Box</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_company"><span class="value" data-field-type="string"><?php echo set_value('email_id',$leaddetails['0']['pobox']); ?>	</span>
										
										</td>
									</tr>

									<tr>
								
									<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_company"><label class="muted pull-right marginRight10px">Phone No:</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_company"><span class="value" data-field-type="string"><?php echo $leaddetails['0']['phone']; ?>	</span>
										
										</td>

											<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_company"><label class="muted pull-right marginRight10px">Mobile No:</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_company"><span class="value" data-field-type="string"><?php echo $leaddetails['0']['mobile_no']; ?>	</span>
										
										</td>
									</tr>

									<tr>
								
									<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_company"><label class="muted pull-right marginRight10px">Street Address:</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_company"><span class="value" data-field-type="string"><?php echo $leaddetails['0']['street']; ?>	</span>
										
										</td>

											<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_company"><label class="muted pull-right marginRight10px">Fax No:</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_company"><span class="value" data-field-type="string"><?php echo $leaddetails['0']['fax']; ?>	</span>
										
										</td>
									</tr>

									<tr>
								
									<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_company"><label class="muted pull-right marginRight10px">Country:</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_company"><span class="value" data-field-type="string"><?php echo $country; ?>	</span>
										
										</td>

											<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_company"><label class="muted pull-right marginRight10px">State:</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_company"><span class="value" data-field-type="string"><?php echo $state; ?></span>
										
										</td>
									</tr>


									<tr>
								
									<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_company"><label class="muted pull-right marginRight10px">City</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_company"><span class="value" data-field-type="string"><?php echo $leaddetails['0']['city']; ?>	</span>
										
										</td>

											<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_company"><label class="muted pull-right marginRight10px">Website:</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_company"><span class="value" data-field-type="string"><?php echo $leaddetails['0']['website']; ?></span>
										
										</td>
									</tr>




									<tr>
										<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_lastname">
											<label class="muted pull-right marginRight10px">Description</label>
										</td>
										<td colspan="3" class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_lastname"><span class="value" data-field-type="string"><?php echo $leaddetails['0']['description']; ?></span>
										
										</td>
										
									</tr>
								
							</tbody>
						</table>
						<input name="timeFormatOptions" data-value="" type="hidden">
<!-- product details start-->
	<table class="table table-bordered equalSplit detailview-table">
							<thead>
								<tr>
									<th class="blockHeader" colspan="8"><img class="cursorPointer alignMiddle blockToggle  hide  " src="<?= base_url()?>public/vdfiles/arrowRight.png" data-mode="hide" data-id="13"><img class="cursorPointer alignMiddle blockToggle " src="<?= base_url()?>public/vdfiles/arrowDown.png" data-mode="show" data-id="13">&nbsp;&nbsp;Product Details
										</th>
								</tr>
							</thead>
							<tbody>
							<tr class="listViewHeaders">
									<td class="narrowWidthType"  id="Leads_detailView_fieldLabel_lane">
										<label class="muted pull-left marginRight65px">Product Name</label>
									</td>
									<td class="narrowWidthType"  id="Leads_detailView_fieldLabel_lane">
										<label class="muted pull-left marginRight65px">Potential (MT/Mon)</label>
									</td>
									<td class="narrowWidthType"  id="Leads_detailView_fieldLabel_lane">
										<label class="muted pull-left marginRight65px">Requirement (MT/Mon)</label>
									</td>
										<td class="narrowWidthType"  id="Leads_detailView_fieldLabel_lane">
										<label class="muted pull-left marginRight65px">Packing Type</label>
									</td>
									
								</tr>
										<?php 
 																		$atts = array(
											              'width'      => '900',
											              'height'     => '400',
											              'scrollbars' => 'yes',
											              'status'     => 'yes',
											              'resizable'  => 'yes',
											              'screenx'    => '0',
											              'screeny'    => '0'
											            ); 
									 foreach($leadproducts as $products)
										 {
										//echo"<pre>";print_r($products);echo"<pre>";
										?>
									<tr class="listViewEntries" data-id="21" id="Leads_listView_row_1">
											  <td class="narrowWidthType" data-field-type="salutation">
													<?php echo $products['description'];?>
												
											  </td>		
												<td class="narrowWidthType" data-field-type="salutation" >
													<a href="#"><?php echo $products['quantity'];?></a>
											  </td>
									
												<td class="narrowWidthType" data-field-type="salutation">
													<a href="#"><?php echo $products['potential'];?></a>
											  </td>
											  <td class="narrowWidthType" data-field-type="salutation" nowrap="nowrap">
													<a href="#"><?php echo $products['n_value'];?></a>
											  </td>
											
												
									</tr>
										<?php				
										}
								  	?>
									
								</tbody>
							</table>


<!-- Product details end-->
						<table class="table table-bordered equalSplit detailview-table">
							<thead>
								<tr>
									<th class="blockHeader" colspan="9"><img class="cursorPointer alignMiddle blockToggle  hide  " src="<?= base_url()?>public/vdfiles/arrowRight.png" data-mode="hide" data-id="13"><img class="cursorPointer alignMiddle blockToggle " src="<?= base_url()?>public/vdfiles/arrowDown.png" data-mode="show" data-id="13">&nbsp;&nbsp;Status Details
										</th>
								</tr>
							</thead>
							<tbody>
							<tr class="listViewHeaders">
									<td class="narrowWidthType"  id="Leads_detailView_fieldLabel_lane">
										<label class="muted pull-left marginRight55px">Status Changed</label>
									</td>
									<td class="narrowWidthType"  id="Leads_detailView_fieldLabel_lane">
										<label class="muted pull-left marginRight65px">Substatus</label>
									</td>
									<td class="narrowWidthType"  id="Leads_detailView_fieldLabel_lane">
										<label class="muted pull-left marginRight65px">Comments</label>
									</td>
									<td class="narrowWidthType"  id="Leads_detailView_fieldLabel_lane">
										<label class="muted pull-left marginRight65px">Created On</label>
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
									<td class="narrowWidthType"  id="Leads_detailView_fieldLabel_lane">
										<label class="muted pull-left marginRight65px">Duration</label>
									</td>
								</tr>
										<?php 
 																		$atts = array(
											              'width'      => '900',
											              'height'     => '400',
											              'scrollbars' => 'yes',
											              'status'     => 'yes',
											              'resizable'  => 'yes',
											              'screenx'    => '0',
											              'screeny'    => '0'
											            ); 
										foreach($ldstatuslog as $statuslog)
										 {
									//	print_r($statuslog);
										?>
									<tr class="listViewEntries" data-id="21" id="Leads_listView_row_1">
											  <td class="narrowWidthType" data-field-type="salutation"  title="Click here to view substatus" alt="Click here to view substatus">
												<?php echo anchor_popup('leads/substatus/'.@$statuslog[lh_lead_curr_statusid],$statuslog['lh_lead_curr_status'],$atts);?>
											  </td>		
												<td class="narrowWidthType" data-field-type="salutation" >
													<a href="#"><?echo $statuslog['lhsub_lh_lead_curr_sub_status'];?></a>
											  </td>
											  	<td class="narrowWidthType" data-field-type="salutation" >
													<a href="#"><?echo $statuslog['lh_comments'];?></a>
											  </td>
						
									
												<td class="narrowWidthType" data-field-type="salutation">
													<a href="#"><?echo $statuslog['lh_created_date'];?></a>
											  </td>
											  <td class="narrowWidthType" data-field-type="salutation" nowrap="nowrap">
													<a href="#"><?echo $statuslog['created_user_name'];?></a>
											  </td>
												<td class="narrowWidthType" data-field-type="salutation" nowrap="nowrap">
													<a href="#"><? if($statuslog['lh_last_modified']!=''){
																				echo $statuslog['lh_last_modified'];}else{
																			echo $statuslog['lh_updated_date'];	}

																			?></a>
											  </td>


												<td class="narrowWidthType" data-field-type="salutation" nowrap="nowrap">
													<a href="#"><?echo $statuslog['modified_user_name'];?></a>
											 </td>
											 <td class="narrowWidthType" data-field-type="salutation" nowrap="nowrap">
													<a href="#"><?echo $statuslog['assignto_user_name'];?></a>
											 </td>
											 <td class="narrowWidthType" data-field-type="salutation" nowrap="nowrap">
												<!--<a href="#"><?php  if($statuslog['action_type']=='Insert'){ echo $statuslog['daysc'];}else{echo $statuslog['days']; }?> days</a>-->
												<a href="#"><?php  if($statuslog['action_type']=='Insert')
													{ 
														echo $statuslog['idle_days'];
													}
														else
													{	
														echo $statuslog['days'];
													}
													?> days</a>


											 </td>
									</tr>
										<?php				
										}
								  	?>
									
								</tbody>
							</table>
							<input name="timeFormatOptions" data-value="" type="hidden">
							<!-- <table class="table table-bordered equalSplit detailview-table">
								<thead>
									<tr>
										<th class="blockHeader" colspan="4"><img class="cursorPointer alignMiddle blockToggle  hide  " src="<?= base_url()?>public/vdfiles/arrowRight.png" data-mode="hide" data-id="16"><img class="cursorPointer alignMiddle blockToggle " src="<?= base_url()?>public/vdfiles/arrowDown.png" data-mode="show" data-id="16">&nbsp;&nbsp;Description Follow Up
										</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="fieldLabel narrowWidthType" id="Leads_detailView_fieldLabel_description">
											<label class="muted pull-left marginRight10px">Comments</label>
										</td>
										<td class="fieldValue narrowWidthType" id="Leads_detailView_fieldValue_description" colspan="3">
												<label class="muted pull-left marginRight10px">Description</label>
									</tr>
									
											<span class="value" data-field-type="text"></span>
										<h1>Comments Follow Up</h1>	
										<?php		
										foreach($ldstatuslog as $statuslog)
										 {
										//print_r($statuslog);

										?>
										<tr>
										<td colspan="3">
										<div id="w">
											
											<div id="container">
												<ul id="comments">
													<li class="cmmnt">
														<div class="cmmnt-content">
														<header>
													 <a href="javascript:void(0);" class="userlink">
													 	<?php if($statuslog['modified_user_name']!='')
													 	{
													 	   echo $statuslog['modified_user_name'];
													 	   
													 	}
													 	else {
													 		echo $statuslog['created_user_name'];
													 	}?>
													 </a> - <span class="pubdate">posted <?php if($statuslog['action_type']=='Insert'){ echo $statuslog['weekc'];}else{ echo $statuslog['week'];}?> week ago</span>
														</header>
															<p><?php echo $statuslog['lh_comments'];?></p>
														</div>

													</li>
												 </ul>
											</div>
										</div>
									</tr>
								</td>
										<?php } ?>
												<input class="fieldname" value="description" data-prev-value="" type="hidden">
										</td>
									</tr>
								</tbody>
							</table> -->
						</div>
					</form>
				</div>
				<!--<div class="related span2 marginLeftZero">
					<div class="">
						<ul class="nav nav-stacked nav-pills">
							<li class="active" data-url="#" data-label-key="Lead Summary" data-link-key="LBL_RECORD_SUMMARY"><a href="javascript:void(0);"><strong>Lead Summary</strong></a>
							</li>
							<li class="" data-url="#" data-label-key="Lead Details" data-link-key="#"><a href="javascript:void(0);"><strong>Lead Details</strong></a>
							</li>
							<li class="" data-url="#" data-label-key="ModComments" data-link-key="#"><a href="javascript:void(0);"><strong>Comments</strong></a>
							</li>
							<li class="" data-url="#" data-label-key="LBL_UPDATES" data-link-key="#"><a href="javascript:void(0);"><strong>Updates</strong></a>
							</li>
						</ul>
					</div>-->
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

	<script type="text/javascript" src="<?= base_url()?>public/js/jquery_003.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/chosen.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/select2.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/jquery-ui-1.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/jquery_006.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/jquery_008.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/jstorage.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/jquery_005.js"></script>

	<script type="text/javascript" src="<?= base_url()?>public/js/slimScroll.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/jquery_012.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/jquery_002.js"></script>

	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-alert.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-tooltip.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-tab.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-collapse.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-modal.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-popover.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootbox.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/jquery_009.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/helper.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/Connector.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/ProgressIndicator.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/jquery_011.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/jquery.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/guiders-1.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/datepicker.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/date.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/jquery_010.js"></script>
	

	<!-- Added in the end since it should be after less file loaded -->
	<script type="text/javascript" src="<?= base_url()?>public/vdfiles/less.js"></script></body></html>
