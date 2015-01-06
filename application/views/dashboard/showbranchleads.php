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
	$(document).ready(function(){
	     var id;
    	     var baseurl = $('#baseurl').val();
			//	alert("baseurl " +baseurl);
		 $("#deleteComment").on("click",function(e){
		 	alert("tessts");

		    })

		  $('.deleteConfirm').dialog({
		        autoOpen : false,
		        modal : true,
		        buttons : {
		            'Yes' : function(){
		               $.ajax({
		                   url : baseurl + 'leads/delete/' + id,
		                   success : function(){
		                       // i must remove the div
		                       $('.deleteConfirm').dialog('close');
		                       $('#silde' + id).slideUp('slow');
		                   }
		               })
		            },
		            'No' : function(){
		                $(this).dialog('close');
		            }
		        }
		    })


	});

</script>
<script type="text/javascript">
        $(document).ready(function () {
//				var leadata = $("#leadata").val();
				 var leadata = <?php echo $data; ?>;
				var baseurl = window.location.href.split(window.location.pathname)[0]+'/salescrm/';
			//	alert("baseurl " +baseurl);
			 var permission = <?php echo $grpperm; ?>;
						//alert(" permission lent"+permission.length);
				var group_len = 	permission.length;


 						//var theme = getDemoTheme();
            var theme = 'energyblue';
						var data = leadata;
            // prepare the data
            var source =
            {
                datatype: "json",
							  sortcolumn: 'leadid',
							  sortdirection: 'asc',
                datafields: [
                    { name: 'leadid'},
                    { name: 'date' },
                    { name: 'customer'},
                    { name: 'industry'},
                    { name: 'assigned'}
                ],
                localdata: data,
								pagenum: 0,
                pagesize: 50,
								pager: function (pagenum, pagesize, oldpagenum) {
                    // callback called when a page or page size is changed.
                }
            };


            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                width: '100%',
                source: dataAdapter,
                theme: theme,
				selectionmode: 'singlerow',
                sortable: true,
                pageable: true,
                columnsresize: true,
							  sortable: true,
  							showfilterrow: true,
                filterable: true,

                 columns: [
                  { text: 'LeadId', dataField: 'leadid', width: 70},
                  { text: 'Created Date', dataField: 'date', width: 110 },
                  { text: 'Customer Name', dataField: 'customer', width: 262 },
                  { text: 'Industial Segment', dataField: 'industry', width: 230, cellsalign: 'left' },
                  { text: 'Assigned To', dataField: 'assigned', width: 250, cellsalign: 'left', cellsformat: 'c2' }
									
                  
                 
                ], 
								showtoolbar: true,
                autoheight: true,
                rendertoolbar: toolbarfunc
            });


								var toolbarfunc = function (toolbar) {
                var me = this;
								var theme = 'energyblue';
               // alert("theme "+theme);
 						
				var container = $("<div style='width:200px; margin-top: 6px;' id='jqxWidget'></div>");
				var span = $("<span style='float: left; margin-top: 5px; margin-right: 4px;'></span>");
				var startdiv =$("<div>");
				var addlead = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='_blank' href='#' id='jqxButtonadd'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 65px; height: 22px;' value='Add' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
				var viewlead = $("<a role='button' class='jqx-link ' style='margin-left: 25px;' target='_blank' href='#' id='jqxButton'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 79px; height: 22px;' value='View' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");

				var edit = $("<a style='margin-left: 25px;' target='_blank' href='#' id='jqxButtonedit'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 65px; height: 22px;' value='Edit' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
				var statusupdate = $("<a style='margin-left: 25px;' target='_blank' href='#' id='jqxButtonUpdate'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 88px; height: 22px;' value='Update' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
				var enddiv =$("</div>");
                toolbar.append(container);
                container.append(span);
                container.append(startdiv);
                container.append(viewlead);
                
			for(i=0;i<permission.length; i++)
				{
		 //   alert(permission[i].groupname);
		     if ( permission[i].groupname =='Edit')
						{
							container.append(edit);		
						}
				}
                
                container.append(statusupdate);
		  container.append(enddiv);
                if (theme != "") {
                   // viewlead.addClass('jqx-link jqx-link-arctic' + theme);
                  //  viewlead.addClass('jqx-wrapper jqx-reset jqx-reset-arctic jqx-rc-all jqx-rc-all-arctic jqx-button jqx-button-arctic jqx-widget jqx-widget-arctic jqx-fill-state-pressed jqx-fill-state-pressed-arctic' + theme);
                }
                var oldVal = "";
                viewlead.on('click', function (event) 
								{
								var rowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
 								var leadid = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'leadid');
            //    alert("Link button pressed");
						//		alert("lead id "+leadid);
										if (leadid==null)
										{
											alert("Please Select a row");		
										//	$('#jqxButton').attr('href','http://google.com');
                      return false;
				
										}
										else
										{
											$('#jqxButton').attr('href',baseurl+'leads/viewleaddetails/'+leadid);		
										}
                  
                });

 							edit.on('click', function (event) 
								{
								var rowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
 								var leadid = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'leadid');
              //  alert("Edit button pressed");
						//		alert("lead id "+leadid);
										if (leadid==null)
										{
											alert("Please Select a row");		
										//	$('#jqxButton').attr('href','http://google.com');
                      return false;
				
										}
										else
										{
											$('#jqxButtonedit').attr('href',baseurl+'leads/edit/'+leadid);		
										}
                  
                });
							statusupdate.on('click', function (event) 
								{
								var rowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
 								var leadid = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'leadid');
             //   alert("Update button pressed");
							//	alert("lead id "+leadid);
										if (leadid==null)
										{
											alert("Please Select a row");		
										//	$('#jqxButton').attr('href','http://google.com');
                      return false;
				
										}
										else
										{
											$('#jqxButtonUpdate').attr('href',baseurl+'leads/editstatus/'+leadid);		
										}
                  
                });

							addlead.on('click', function (event) 
								{
							//	var rowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
 							//	var leadid = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'leadid');
              //  alert("Add button pressed");
							//	alert("lead id "+leadid);
										
							//				alert("Please Select the row");		
											$('#jqxButtonadd').attr('href',baseurl+'leads/add');
                  
                });

            };
					 $("#jqxgrid").jqxGrid({ rendertoolbar: toolbarfunc });
					  

        });
    </script>

</head>
<body data-skinpath="layouts/vlayout/skins/softed">
	
<div id="page"><!-- container which holds data temporarly for pjax calls -->
	<div id="pjaxContainer" class="hide noprint"></div>
<div class="navbar navbar-fixed-top  navbar-inverse noprint" style="min-width:1050px">
	<div class="navbar" id="topMenus">
		<div class="navbar-inner" id="nav-inner">
			<div class="menuBar row-fluid">
				<div class="span9" style="height: 30px;">
					<ul class="nav modulesList">
						<li class="tabs">
						<a class="alignMiddle " href="<?= base_url()?>leads">
								<img src="<?= base_url()?>public/images/home.png" alt="Home" title="Home">
							</a>
						</li>
						<!-- <li class="tabs">
							<a id="menubar_item_Calendar" href="http://localhost/purechemicals/index.php?module=Calendar&amp;view=Calendar">Calendar
							</a>
						</li> -->
						<li class="tabs">
							<a id="menubar_item_Leads" href="<?= base_url()?>leads" class="selected">Leads
							</a>
						</li>
						
					</ul>
				</div>
				<div class="span3 row-fluid" id="headerLinks">
					<span class="pull-right headerLinksContainer">
						
						
						<span class="dropdown span">
							<span class="dropdown-toggle row-fluid" data-toggle="dropdown" href="#">
								<a id="menubar_item_right_Administrator" class="userName textOverflowEllipsis span" title="User"><?php  echo $this->session->userdata['username']."-".$this->session->userdata['user_id']."-".$this->session->userdata['reportingto'];?> <i class="caret"></i> 
								</a> 
							</span>
							<ul class="dropdown-menu pull-right">
								
								
								<li>
									<a target="" id="menubar_item_right_LBL_SIGN_OUT" href="<?=base_url()?>admin/logout">Sign Out</a>
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
	
	<div class="contentsDiv span10 marginLeftZero">
		<div class="listViewPageDiv">
			<div class="listViewTopMenuDiv noprint">
				<div class="listViewActionsDiv row-fluid">
					<span class="btn-toolbar span4">
						<div class="contentHeader row-fluid"  style="width:500px;">
							<span title="Additional Lead Data" class="recordLabel font-x-x-large span12 pushDown">
								<?php
								
								$sub_status_id = $this->uri->segment(3); 
			        				$no_of_days = $this->uri->segment(4);
			        				$branch = str_replace('days','',$this->uri->segment(5));
			        				switch($sub_status_id)
									    {
									    case ($sub_status_id ==1):
									    $substatus = "Prospect";
									    break;

									     case ($sub_status_id ==2):
									    $substatus = "Met The Customer";
									    break;

									    case ($sub_status_id ==3):
									    $substatus = "Credit Assessment ";
									    break;

									     case ($sub_status_id ==4):
									    $substatus = "Sample,Trails & Formalities";
									    break;
									    case ($sub_status_id ==5):
									    $substatus = "Enquiry/Offer/Negotiation";
									    break;
									    case ($sub_status_id =6):
									    $substatus = "Managing And Implementation";
									    break;
									    case ($sub_status_id =7):
									    $substatus = "Expanding And Build Relationship";
									    break;
									    }

								if($no_of_days==0)
									    {
									   
									    $ageing = "<30 days";
									  
									 }
									 elseif ($no_of_days==30)
									    {
									   
									    $ageing = ">30 days";
									
									 }
									  elseif ($no_of_days==60)
									    {
									   
									    $ageing = ">60 days";
									    
									 }
									  elseif ($no_of_days==90)
									    {
									   
									    $ageing = ">90 days";
									    
									 }
									  elseif ($no_of_days==120)
									    {
									   
									    $ageing = ">120 days";
									    
									 }
									  elseif ($no_of_days==180)
									    {
									   
									    $ageing = ">180 days";
									    
									 }



								?>
		<!--<strong>Executive Pipepline Details for <?=$ageing;?>  under <?=$substatus;?> Status <?php if ($branch!=""){?>for <?=$branch; }?></strong>-->
							</span>
						</div>
						
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
