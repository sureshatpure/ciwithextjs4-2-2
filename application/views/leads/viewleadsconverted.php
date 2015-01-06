<?php $this->load->view('header');?>
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

	 <!-- sorting and filtering and export excel - end -->
	 <!-- paging - start -->
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.pager.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxdata.export.js"></script> 
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.export.js"></script>
	 <!-- paging - end -->
	<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.black.css" type="text/css" />
<!-- End of jqwidgets -->
   

<script type="text/javascript">
        $(document).ready(function () 
        {

        	var theme = "";
            // Create a jqxMenu
            $("#jqxMenu").jqxMenu({ width: '670', height: '30px', theme: 'black' });
            $("#jqxMenu").css('visibility', 'visible');
          
//				var leadata = $("#leadata").val();
				 var leadata = <?php echo $data; ?>;
				var baseurl = window.location.href.split(window.location.pathname)[0]+'/salescrm/';
			//	alert("baseurl " +baseurl);
				 var permission = <?php echo $grpperm; ?>;
				//		alert(" permission lent"+permission.length);
				var group_len = 	permission.length;
      //   alert(permission[0].groupid);
      //   alert(permission[0].groupname);


 						//var theme = getDemoTheme();
            var theme = 'energyblue';
		var data = leadata;
            // prepare the data
		$("#excelExport").jqxButton({
		theme: 'energyblue'
		});

		$("#excelExport").click(function() {
		$("#jqxgrid").jqxGrid('exportdata', 'xls', 'convertlead');
		//$("#jqxgrid").jqxGrid('exportdata', 'xls', 'viewleaddata', true, null, true, 'http://10.1.2.40/salescrm/dashboard/savefile');
		});
        var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'leadid'},
                    { name: 'lead_no' },
                    { name: 'soc_number',type:'number'},
                    { name: 'branch' },
                    { name: 'leadstatus'},
                    { name: 'leadsource'},
                    { name: 'productname',type:'string'},
                    { name: 'salestype',type:'string'},
                    { name: 'assign_from_name'},
                    { name: 'empname'},
                    { name: 'tempcustname'},
                    { name: 'created_date', type: 'datetime' },
			   { name: 'modified_date', type: 'datetime' }

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
                  { text: 'LeadId', dataField: 'leadid', width: 50, hidden:true },
                  { text: 'LeadNo', dataField: 'lead_no', width: 100 },
                  { text: 'SOC No', dataField: 'soc_number', width: 65 },
                  { text: 'Branch', dataField: 'branch', width: 95,cellsalign: 'left' },
                  { text: 'Lead Status', dataField: 'leadstatus', width: 85 },
                  { text: 'Lead Source', dataField: 'leadsource', width: 85, cellsalign: 'left' },
                  { text: 'Product Name', dataField: 'productname', width: 100, cellsalign: 'left'},
                  /*{ text: 'Sales Type', dataField: 'salestype', width: 100, cellsalign: 'left'},*/
                  { text: 'Assigned From', dataField: 'assign_from_name', width: 120, cellsalign: 'left' },
			 { text: 'Assigned To', dataField: 'empname', width: 125, cellsalign: 'left' },
                  { text: 'Customer Name', dataField: 'tempcustname', cellsalign: 'left', minwidth: 150 },
                  { text: 'Created Date', dataField: 'created_date', cellsalign: 'left', width: 95, cellsformat: 'd',formatString:'d'},
                  { text: 'Last Activity', dataField: 'modified_date', cellsalign: 'left', width: 95, cellsformat: 'd',formatString:'d'}
                 
                ], 
		    showtoolbar: false,
                autoheight: true,
                rendertoolbar: toolbarfunc
            });


								var toolbarfunc = function (toolbar) {
                var me = this;
								var theme = 'energyblue';
              //  alert("theme "+theme);
 						
                var container = $("<div style='width:200px; margin-top: 6px;' id='jqxWidget'></div>");
                var span = $("<span style='float: left; margin-top: 5px; margin-right: 4px;'></span>");
								var startdiv =$("<div>");
 								var addlead = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='jqxButtonadd'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 65px; height: 22px;' value='Add' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
                var viewlead = $("<a role='button' class='jqx-link ' style='margin-left: 25px;' target='_blank' href='#' id='jqxButton'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 79px; height: 22px;' value='View' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");

                var edit = $("<a style='margin-left: 25px;' href='#' id='jqxButtonedit'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 65px; height: 22px;' value='Edit' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
 							var statusupdate = $("<a style='margin-left: 25px;' target='' href='#' id='jqxButtonUpdate'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 88px; height: 22px;' value='Update' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
								var enddiv =$("</div>");
                toolbar.append(container);
                container.append(span);
                container.append(startdiv);
								container.append(addlead);
                container.append(viewlead);
								container.append(statusupdate);
								for(i=0;i<permission.length; i++)
								{
               //  alert(permission[i].groupname);
                 if ( permission[i].groupname =='Edit')
										{
											container.append(edit);		
										}
								}
							  container.append(enddiv);
                if (theme != "") {
                   // viewlead.addClass('jqx-link jqx-link-arctic' + theme);
                  //  viewlead.addClass('jqx-wrapper jqx-reset jqx-reset-arctic jqx-rc-all jqx-rc-all-arctic jqx-button jqx-button-arctic jqx-widget jqx-widget-arctic jqx-fill-state-pressed jqx-fill-state-pressed-arctic' + theme);
                }
              
			var leadid;
                $('#jqxgrid').bind('rowselect', function (event) 
                { 
                    leadid = event.args.row.leadid;
                });
                $('#jqxgrid').bind('rowdoubleclick', function (event) {
                  //window.location = 'leads/viewleaddetails/'+leadid;
                  window.open( 'viewleaddetailsconverted/'+leadid);
                });


                var oldVal = "";
                viewlead.on('click', function (event) 
								{
								var rowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
 								var leadid = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'leadid');
 								$('#jqxButton').attr('href',baseurl+'leads/viewleaddetailsconverted/'+leadid);	
										if (leadid==null)
										{
											alert("Please Select a row");		
										//	$('#jqxButton').attr('href','http://google.com');
                      							return false;
				
										}
										else
										{
											$('#jqxButton').attr('href',baseurl+'leads/viewleaddetailsconverted/'+leadid);		
										}
                  
                });

 							edit.on('click', function (event) 
								{
								var rowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
 								var leadid = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'leadid');
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


<?php //$this->load->view('topmenus');?>
	
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
<div class="bodyContents" style="margin-left: 0;min-height: 635px;min-width: 1231px;">
	<div class="mainContainer row-fluid">
		<div class="span2 row-fluid noprint">
			<div class="row-fluid">
				<div class="sideBarContents">
					<div class="quickLinksDiv">
						<p onclick="#" id="Leads_sideBar_link_LBL_RECORDS_LIST" class="selectedQuickLink ">
							<a class="quickLinks" href="<?= base_url()?>leads"><strong>Leads List</strong>
							</a>
						</p>
<!--converted leads  -->						
						<p onclick="#" id="Leads_sideBar_link_LBL_RECORDS_LIST" class="selectedQuickLink ">
							<a class="quickLinks" href="<?= base_url()?>leads/convertedleads"><strong>Converted Leads</strong>
							</a>
						</p>
<!-- converted leads  -->												
						<p onclick="#" id="Leads_sideBar_link_LBL_DASHBOARD" class="unSelectedQuickLink"><a class="quickLinks" href="<?= base_url()?>dashboard"><strong>Dashboard</strong></a></p>
					</div>
					<div class="clearfix"></div>
					<div class="quickWidgetContainer accordion">
						<div class="quickWidget">
							<div class="accordion-heading accordion-toggle quickWidgetHeader" data-target="#Leads_sideBar_LBL_RECENTLY_MODIFIED" data-toggle="collapse" data-parent="#quickWidgets" data-label="LBL_RECENTLY_MODIFIED" data-widget-url="#">
								<span class="pull-left">
									<img class="imageElement" data-rightimage="<?= base_url()?>public/images/images/rightArrowWhite.png" data-downimage="<?= base_url()?>public/images/images/downArrowWhite.png" src="<?= base_url()?>public/images/rightArrowWhite.png">
								</span>
								<a class="quickLinks" href="<?= base_url()?>dashboard/executivepipeline"><h5 class="title widgetTextOverflowEllipsis pull-right" title="Branch/User Wise Lead Ageing">Branch/User Wise Lead Ageing</h5></a>
								
							<div class="clearfix"></div>
						</div>
<!-- second menu -->
						<!--<div class="quickWidget">-->
							<div class="accordion-heading accordion-toggle quickWidgetHeader" data-target="#Leads_sideBar_LBL_RECENTLY_MODIFIED" data-toggle="collapse" data-parent="#quickWidgets" data-label="LBL_RECENTLY_MODIFIED" data-widget-url="#">
								<span class="pull-left">
									<img class="imageElement" data-rightimage="<?= base_url()?>public/images/images/rightArrowWhite.png" data-downimage="<?= base_url()?>public/images/images/downArrowWhite.png" src="<?= base_url()?>public/images/rightArrowWhite.png">
								</span>
								<a class="quickLinks" href="<?= base_url()?>dashboard/additional"><h5 class="title widgetTextOverflowEllipsis pull-right" title="Branch/Status Wise Lead Count">Branch/Status Wise Lead Count</h5></a>
							<div class="clearfix"></div>
						</div>
<!-- second menu end-->
<!-- Third menu -->
						
							<div class="accordion-heading accordion-toggle quickWidgetHeader" data-target="#Leads_sideBar_LBL_RECENTLY_MODIFIED" data-toggle="collapse" data-parent="#quickWidgets" data-label="LBL_RECENTLY_MODIFIED" data-widget-url="#">
								<span class="pull-left">
									<img class="imageElement" data-rightimage="<?= base_url()?>public/images/images/rightArrowWhite.png" data-downimage="<?= base_url()?>public/images/images/downArrowWhite.png" src="<?= base_url()?>public/images/rightArrowWhite.png">
								</span>
								<a class="quickLinks" href="<?= base_url()?>dashboard/daynoprogress"><h5 class="title widgetTextOverflowEllipsis pull-right" title="Additional">Day No Progress</h5></a>
							<div class="clearfix"></div>
						</div>
<!-- third menu end-->
<!-- Fourth menu -->
						
							<div class="accordion-heading accordion-toggle quickWidgetHeader" data-target="#Leads_sideBar_LBL_RECENTLY_MODIFIED" data-toggle="collapse" data-parent="#quickWidgets" data-label="LBL_RECENTLY_MODIFIED" data-widget-url="#">
								<span class="pull-left">
									<img class="imageElement" data-rightimage="<?= base_url()?>public/images/images/rightArrowWhite.png" data-downimage="<?= base_url()?>public/images/images/downArrowWhite.png" src="<?= base_url()?>public/images/rightArrowWhite.png">
								</span>
								<a class="quickLinks" href="<?= base_url()?>dashboard/generadtedleads"><h5 class="title widgetTextOverflowEllipsis pull-right" title="User /Branch Wise Generated Leads">User /Branch Wise Generated Leads</h5></a>
							<div class="clearfix"></div>						
						</div>
<!-- Fourth menu end-->
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
						<div class="contentHeader row-fluid">
							<span class="span8 font-x-x-large textOverflowEllipsis">Converted Leads List</span>
						</div>
							<span class="btn-group">
								<!-- <button id="Leads_listView_basicAction_LBL_ADD_RECORD" class="btn addButton" onclick='window.location.href="leads/add"'><i class="icon-plus icon-white"></i>&nbsp;<strong>Add Lead</strong></button> -->
					<?php if($this->session->flashdata('message')!="") {?>
					<div class="alert alert-message.success"><p style="width:709px; text-align:center;font-size:18px;"><?php 
					 echo $this->session->flashdata('message'); ?></p></div>
					<?php }?>


							</span>
						</span>
				
					
						</div>
					</div>
					<div class="listViewContentDiv" id="listViewContents">
				<div id='jqxWidget'>
				<input style='margin-top: 10px;' title="Currently you cannot export all the data,instead filter the data and try to use Export to Excel option"   alt="Currently you cannot export all the data,instead filter the data and try to use Export to Excel option" type="button" value="Export to Excel" id='excelExport' />
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
