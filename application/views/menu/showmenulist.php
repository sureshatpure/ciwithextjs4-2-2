<!DOCTYPE html>
<html>
<head>
	<title>Leads</title>
	<link rel="SHORTCUT ICON" href="http://localhost/purechemicals/layouts/vlayout/skins/images/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="<?= base_url()?>public/css/chosen.css" type="text/css" media="screen">
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
	<script type="text/javascript" src="<?= base_url()?>public/js/jquery_007.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/jquery/jqueryui.js"></script>
<!-- jqwidgets scripts -->
 		<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.base.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.energyblue.css" type="text/css" />

    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/scripts/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.selection.js"></script> 
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.columnsresize.js"></script> 
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxdata.js"></script> 
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/scripts/gettheme.js"></script>
		<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.edit.js"></script>

	 <!-- sorting and filtering - start -->
			<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.sort.js"></script>
		  <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.filter.js"></script>
		  <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.selection.js"></script> 
		  <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxpanel.js"></script>
		  <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxcheckbox.js"></script>
		  <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxlistbox.js"></script>
		  <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxdropdownlist.js"></script>

	 <!-- sorting and filtering - end -->
	 <!-- paging - start -->
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.pager.js"></script>
	 <!-- paging - end -->

<!-- End of jqwidgets -->
	<script language="javascript" type="text/html">
	
    </script>

</head>
<body data-skinpath="layouts/vlayout/skins/softed">
	
<div id="page"><!-- container which holds data temporarly for pjax calls -->
	<div id="pjaxContainer" class="hide noprint"></div>
<div class="navbar navbar-fixed-top  navbar-inverse noprint" style="min-width:1050px">

<?php $this->load->view('menu/topmenus');?>
	
	<input value="Leads" id="module" name="module" type="hidden">
	<input value="" id="parent" name="parent" type="hidden">
	<input value="List" id="view" name="view" type="hidden">

<div class="navbar commonActionsContainer noprint">
	<div style="position: relative; top: 5px; left: 5.14999px;" class="actionsContainer row-fluid">
		<div class="span2">
			<span class="companyLogo"><img src="<?= base_url()?>public/images/logo.png" title="logo.png" alt="logo.png">&nbsp;
			</span>
		</div>
		<div class="span10 marginLeftZero">
		
			</div>
		</div>
	</div>
</div>
</div>
<div class="bodyContents" style="min-width: 1200px; min-height: 636px;">
	<div class="mainContainer row-fluid">
		<div class="span2 row-fluid noprint">
			<div class="row-fluid">
				<div class="sideBarContents">
					<div class="quickLinksDiv">
						<p onclick="#" id="Leads_sideBar_link_LBL_RECORDS_LIST" class="selectedQuickLink ">
							<a class="quickLinks" href="<?= base_url()?>leads"><strong>Leads List</strong>
							</a>
						</p>
						<p onclick="#" id="Leads_sideBar_link_LBL_DASHBOARD" class="unSelectedQuickLink"><a class="quickLinks" href="<?= base_url()?>dashboard"><strong>Dashboard</strong></a></p>
					</div>
					<div class="clearfix"></div>
					<div class="quickWidgetContainer accordion">
						<div class="quickWidget">
							<div class="accordion-heading accordion-toggle quickWidgetHeader" data-target="#Leads_sideBar_LBL_RECENTLY_MODIFIED" data-toggle="collapse" data-parent="#quickWidgets" data-label="LBL_RECENTLY_MODIFIED" data-widget-url="#">
								<span class="pull-left">
									<img class="imageElement" data-rightimage="<?= base_url()?>public/images/images/rightArrowWhite.png" data-downimage="<?= base_url()?>public/images/images/downArrowWhite.png" src="<?= base_url()?>public/images/rightArrowWhite.png">
								</span>
								<h5 class="title widgetTextOverflowEllipsis pull-right" title="Recently Modified">Recently Modified</h5>
								<div class="loadingImg hide pull-right"><div class="loadingWidgetMsg"><strong>Loading Widget</strong>
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
		<div class="listViewPageDiv">
			<div class="listViewTopMenuDiv noprint">
				<div class="listViewActionsDiv row-fluid">
					<span class="btn-toolbar span4">
						
							<span class="btn-group">
								<!-- <button id="Leads_listView_basicAction_LBL_ADD_RECORD" class="btn addButton" onclick='window.location.href="leads/add"'><i class="icon-plus icon-white"></i>&nbsp;<strong>Add Lead</strong></button> -->
					<?php if($this->session->flashdata('message')!="") {?>
					<div class="alert alert-message.success"><p style="width:709px; text-align:center;font-size:18px;"><?php 
					 echo $this->session->flashdata('message'); ?></p></div>
					<?php }?>


							</span>
						</span>
						<span class="btn-toolbar span4">
							<span class="customFilterMainSpan btn-group">
						
								<select id="customFilter" style="width: 350px; display: none;">
									<optgroup label="  &nbsp; ">
										<option data-editurl="module=CustomView&amp;view=EditAjax&amp;source_module=Leads&amp;record=1" data-deleteurl="index.php?module=CustomView&amp;action=Delete&amp;sourceModule=Leads&amp;record=1" data-approveurl="index.php?module=CustomView&amp;action=Approve&amp;sourceModule=Leads&amp;record=1" data-denyurl="index.php?module=CustomView&amp;action=Deny&amp;sourceModule=Leads&amp;record=1" data-editable="" data-deletable="" data-pending="" data-public="" id="filterOptionId_1" value="1" data-id="1" selected="selected" class="filterOptionId_1">All Leads
										</option>
										<option data-editurl="module=CustomView&amp;view=EditAjax&amp;source_module=Leads&amp;record=2" data-deleteurl="index.php?module=CustomView&amp;action=Delete&amp;sourceModule=Leads&amp;record=2" data-approveurl="index.php?module=CustomView&amp;action=Approve&amp;sourceModule=Leads&amp;record=2" data-denyurl="index.php?module=CustomView&amp;action=Deny&amp;sourceModule=Leads&amp;record=2" data-editable="1" data-deletable="1" data-pending="" data-public="" id="filterOptionId_2" value="2" data-id="2" class="filterOptionId_2">Hot Leads
										</option>
										<option data-editurl="module=CustomView&amp;view=EditAjax&amp;source_module=Leads&amp;record=3" data-deleteurl="index.php?module=CustomView&amp;action=Delete&amp;sourceModule=Leads&amp;record=3" data-approveurl="index.php?module=CustomView&amp;action=Approve&amp;sourceModule=Leads&amp;record=3" data-denyurl="index.php?module=CustomView&amp;action=Deny&amp;sourceModule=Leads&amp;record=3" data-editable="1" data-deletable="1" data-pending="" data-public="" id="filterOptionId_3" value="3" data-id="3" class="filterOptionId_3">This Month Leads</option>
									</optgroup>
								</select><img class="filterImage" src="<?= base_url()?>public/images/filter.png" style="display:none;height:13px;margin-right:2px;vertical-align: middle;">
							</span>
						</span>
						<span class="hide filterActionImages pull-right"><i title="Deny" data-value="deny" class="icon-ban-circle alignMiddle denyFilter filterActionImage pull-right"></i><i title="Approve" data-value="approve" class="icon-ok alignMiddle approveFilter filterActionImage pull-right"></i><i title="Delete" data-value="delete" class="icon-trash alignMiddle deleteFilter filterActionImage pull-right"></i><i title="Edit" data-value="edit" class="icon-pencil alignMiddle editFilter filterActionImage pull-right"></i>
						</span>
						<span class="span4 btn-toolbar">
						
								<div class="clearfix"></div>
								<!-- <textarea id="permission" name="permission"><?=$grpperm;?></textarea> -->
								<input id="selectedIds" name="selectedIds" type="hidden">
								<input id="excludedIds" name="excludedIds" type="hidden">
							</span>
						</div>
					</div>
					<div class="listViewContentDiv" id="listViewContents">
						<div id='jqxWidget'>
						    <div id="jqxgrid"></div>
				    </div>
    			</div>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<input id="activityReminder" class="hide noprint" value="60" type="hidden">
<div id="userfeedback" class="feedback noprint">

</div>
<footer class="noprint">
	<p style="margin-top:5px;margin-bottom:0;" align="center">Powered by Pure CRM 6.0.0Beta©2013 - 2018&nbsp;
		<a href="www.pure-chemical.com" target="_blank">pure-chemical.com
		</a>&nbsp;|&nbsp;
		</p>
</footer>


	<script type="text/javascript" src="<?= base_url()?>public/js/html5.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-alert.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-tooltip.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-tab.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-collapse.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-modal.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-popover.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootbox.js"></script>
	


	
	<!-- Added in the end since it should be after less file loaded -->

</body>
</html>
