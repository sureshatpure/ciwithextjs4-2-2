<?php $this->load->view('header');?>
<!-- jqwidgets scripts -->
	<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.base.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.energyblue.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.black.css" type="text/css" />

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
	<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.columnsreorder.js"></script>


	 <!-- sorting and filtering - start -->
			<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.sort.js"></script>
		  <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.filter.js"></script>
		  <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.selection.js"></script> 
			<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.aggregates.js"></script> 
		  <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxpanel.js"></script>
		  <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxcheckbox.js"></script>
		  <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxlistbox.js"></script>
		  <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxdropdownlist.js"></script>

	 <!-- sorting and filtering - end -->
	 <!-- paging - start -->
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.pager.js"></script>
	 <!-- paging - end -->

 <!-- charts - start -->
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxchart.js"></script>
 <!-- charts - end -->

<!-- End of jqwidgets -->
<!-- end of Menu includes -->
<script type="text/javascript">
var base_url = '<?php echo site_url(); ?>';
			function openpopupwindow(leadstatusid,days)
			{
			//	alert("lead status id"+leadstatusid);
			//	alert("days"+days);
			window.open(base_url+'dashboard/showleads/'+leadstatusid+'/'+days,'_blank', 'width=800,height=500,scrollbars=yes,status=yes,resizable=yes,screenx=300,screeny=100,addressbar=no');

			}
        $(document).ready(function () {
		var theme = "black";
            // Create a jqxMenu
            $("#jqxMenu").jqxMenu({ width: '670', height: '30px', theme: 'black' });
            $("#jqxMenu").css('visibility', 'visible');


//				var leadata = $("#leadata").val();
				 var leadata = <?php echo $data; ?>;
				 var leadatact = <?php echo $datact; ?>;

				var baseurl = window.location.href.split(window.location.pathname)[0]+'/salescrm/';

			  var permission = <?php echo $grpperm; ?>;
				var group_len = 	permission.length;
				var theme = 'energyblue';
 				



            var data = leadata;
            var datact = leadatact;

            // prepare the data
            var source =
            {
                datatype: "json",
			  sortcolumn: 'leadstatusid',
			  sortdirection: 'asc',
                datafields: [
                    { name: 'leadstatusid'},
                    { name: 'leadstatus' },
                    { name: 'zdays'},
                    { name: 'tdays'},
                    { name: 'sdays'},
                    { name: 'ndays'},
                    { name: 'twdays'},
                    { name: 'eidays'},
                    { name: 'total'}

                ],
                localdata: data,
			pagenum: 0,
                pagesize: 50,
								pager: function (pagenum, pagesize, oldpagenum) {
                    // callback called when a page or page size is changed.
                }
            };

								
							 // alert("summary data"+summaryData.toSource());
							
            var dataAdapter = new $.jqx.dataAdapter(source);
					
  						
            $("#jqxgrid").jqxGrid(
            {
                width: '91%',
                source: dataAdapter,
                theme: theme,
			selectionmode: 'singlecell',
                sortable: true,
                pageable: true,
                columnsresize: true,
			sortable: true,
			showfilterrow: true,
                filterable: true,
			showstatusbar: true,
                statusbarheight: 50,

                 columns: [
                  { text: 'Lead Status Id', dataField: 'leadstatusid', width: 70, hidden:true, filterable:false },
                  { text: 'Lead Status', dataField: 'leadstatus', width: 250 },
                  { text: '<30 days', dataField: 'zdays', width: 85,cellsalign: 'center',cellsformat: 'n2', aggregates: ['sum'],
									aggregatesrenderer: function (aggregates, column, element) {
									var renderstring = "<div class='jqx-widget-content jqx-widget-content-energyblue' style='float: left; width: 100%; height: 100%; '>";
											$.each(aggregates, function (key, value) {
																					    //  var name = key == 'min' ? 'Min' : 'Max';
																					    //  var color = key == 'max' ? 'green' : 'red';
																					      var name = key == 'sum' ? 'Σ' : 'sum';
																					      var color = key == 'sum' ? 'green' : 'red';
																					      renderstring += '<div style="color: ' + color + '; position: relative; margin: 6px; text-align: right; overflow: hidden;">'+ name + ': ' + value + '</div>';
																					  });
																					  renderstring += "</div>";
																					  return renderstring;
																				}
									},
                  { text: '>30 days', dataField: 'tdays', width: 85,cellsalign: 'center',cellsformat: 'n2', aggregates: ['sum'],
									aggregatesrenderer: function (aggregates, column, element) {
									var renderstring = "<div class='jqx-widget-content jqx-widget-content-energyblue' style='float: left; width: 100%; height: 100%; '>";
											$.each(aggregates, function (key, value) {
																					    //  var name = key == 'min' ? 'Min' : 'Max';
																					    //  var color = key == 'max' ? 'green' : 'red';
																					      var name = key == 'sum' ? 'Σ' : 'sum';
																					      var color = key == 'sum' ? 'green' : 'red';
																					      renderstring += '<div style="color: ' + color + '; position: relative; margin: 6px; text-align: right; overflow: hidden;">' + name + ': ' + value + '</div>';
																					  });
																					  renderstring += "</div>";
																					  return renderstring;
																				}
								   },
                  { text: '>60 days', dataField: 'sdays', width: 85, cellsalign: 'center',cellsformat: 'n2', aggregates: ['sum'],
									aggregatesrenderer: function (aggregates, column, element) {
									var renderstring = "<div class='jqx-widget-content jqx-widget-content-energyblue' style='float: left; width: 100%; height: 100%; '>";
											$.each(aggregates, function (key, value) {
																					    //  var name = key == 'min' ? 'Min' : 'Max';
																					    //  var color = key == 'max' ? 'green' : 'red';
																					      var name = key == 'sum' ? 'Σ' : 'sum';
																					      var color = key == 'sum' ? 'green' : 'red';
																					      renderstring += '<div style="color: ' + color + '; position: relative; margin: 6px; text-align: right; overflow: hidden;">' + name + ': ' + value + '</div>';
																					  });
																					  renderstring += "</div>";
																					  return renderstring;
																				}
									},
                  { text: '>90 days', dataField: 'ndays', width: 85,cellsalign: 'center',cellsformat: 'n2', aggregates: ['sum'],
									aggregatesrenderer: function (aggregates, column, element) {
									var renderstring = "<div class='jqx-widget-content jqx-widget-content-energyblue' style='float: left; width: 100%; height: 100%; '>";
											$.each(aggregates, function (key, value) {
																					    //  var name = key == 'min' ? 'Min' : 'Max';
																					    //  var color = key == 'max' ? 'green' : 'red';
																					      var name = key == 'sum' ? 'Σ' : 'sum';
																					      var color = key == 'sum' ? 'green' : 'red';
																					      renderstring += '<div style="color: ' + color + '; position: relative; margin: 6px; text-align: right; overflow: hidden;">' + name + ': ' + value + '</div>';
																					  });
																					  renderstring += "</div>";
																					  return renderstring;
																				} 



									},
									{ text: '>120 days', dataField: 'twdays', width: 85, cellsalign: 'center',cellsformat: 'n2', aggregates: ['sum'],
									aggregatesrenderer: function (aggregates, column, element) {
									var renderstring = "<div class='jqx-widget-content jqx-widget-content-energyblue' style='float: left; width: 100%; height: 100%; '>";
											$.each(aggregates, function (key, value) {
																					    //  var name = key == 'min' ? 'Min' : 'Max';
																					    //  var color = key == 'max' ? 'green' : 'red';
																					      var name = key == 'sum' ? 'Σ' : 'sum';
																					      var color = key == 'sum' ? 'green' : 'red';
																					      renderstring += '<div style="color: ' + color + '; position: relative; margin: 6px; text-align: right; overflow: hidden;">' + name + ': ' + value + '</div>';
																					  });
																					  renderstring += "</div>";
																					  return renderstring;
																				}
									},
                  { text: '>180 days', dataField: 'eidays',width: 85, cellsalign: 'center',cellsformat: 'n2', aggregates: ['sum'],
									aggregatesrenderer: function (aggregates, column, element) {
									var renderstring = "<div class='jqx-widget-content jqx-widget-content-energyblue' style='float: left; width: 100%; height: 100%; '>";
											$.each(aggregates, function (key, value) {
																					    //  var name = key == 'min' ? 'Min' : 'Max';
																					    //  var color = key == 'max' ? 'green' : 'red';
																					      var name = key == 'sum' ? 'Σ' : 'sum';
																					      var color = key == 'sum' ? 'green' : 'red';
																					      renderstring += '<div style="color: ' + color + '; position: relative; margin: 6px; text-align: right; overflow: hidden;">' + name + ': ' + value + '</div>';
																					  });
																					  renderstring += "</div>";
																					  return renderstring;
																				}
									},
				   { text: 'Total', dataField: 'total', width: 85}

                ], 
								showtoolbar: false,
                autoheight: true,
                rendertoolbar: toolbarfunc
            });


								var toolbarfunc = function (toolbar) {
                var me = this;
								var theme = getDemoTheme();
               
 						
                var container = $("<div style='width:200px; margin-top: 6px;' id='jqxWidget'></div>");
                var span = $("<span style='float: left; margin-top: 5px; margin-right: 4px;'></span>");
								var startdiv =$("<div>");
 								var addlead = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='jqxButtonadd'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 65px; height: 22px;' value='Add' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
                var viewlead = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='jqxButton'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 79px; height: 22px;' value='View' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
                var edit = $("<a style='margin-left: 25px;' target='' href='#' id='jqxButtonedit'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 65px; height: 22px;' value='Edit' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
 							var statusupdate = $("<a style='margin-left: 25px;' target='' href='#' id='jqxButtonUpdate'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 88px; height: 22px;' value='Update' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");



								$("#jqxgrid").on('celldoubleclick', function (event)
								 {

								//	alert("clicked");

									var columnheader = $("#jqxgrid").jqxGrid('getcolumn', event.args.datafield).datafield;
								//	alert("columnheader "+columnheader);
									$("#selectedcell").text("Row: " + event.args.rowindex);
								//	alert("columnheader "+columnheader+" rowindex "+ event.args.rowindex);
 									var columnindex = $('#jqxgrid').jqxGrid('getcolumnindex', columnheader);
								//		alert("columnindex "+columnindex);
 									var rowid = $('#jqxgrid').jqxGrid('getrowdata', event.args.rowindex);
								//		alert("rowid "+rowid.leadstatusid);

                	var col_value;
                	var col_days;

                 if (columnheader=='zdays')
                     {
                        col_value=rowid.zdays; 
												col_days=0;
                     }
								else if (columnheader=='tdays')
                     {
                        col_value=rowid.tdays; 
												col_days=30;
                     }
                		else if(columnheader=='sdays')
                     {
                        col_value=rowid.sdays; 
												col_days=60;
                     }
									else if(columnheader=='ndays')
                     {
                        col_value=rowid.ndays; 
												col_days=90;
                     }
									else if(columnheader=='twdays')
                     {
                        col_value=rowid.twdays; 
												col_days=120;
                     }
									else if(columnheader=='eidays')
                     {
                        col_value=rowid.eidays; 
												col_days=180;
                     }

              if ('leadstatus'!= columnheader)
                 {
                  if (col_value >0 )
                   {
                   openpopupwindow(rowid.leadstatusid,col_days)
                   }
                 }
                 
							});




								var enddiv =$("</div>");
                toolbar.append(container);
                container.append(span);
                container.append(startdiv);
								container.append(addlead);
                container.append(viewlead);
								container.append(statusupdate);
								for(i=0;i<permission.length; i++)
								{
                 //alert(permission[i].groupname);
                 if ( permission[i].groupname =='Edit')
										{
											container.append(edit);		
										}
								}
							  container.append(enddiv);
               
                var oldVal = "";
                viewlead.on('click', function (event) 
								{
								var rowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
								var cellindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
 								var leadid = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'leadid');
                alert("Link button pressed");
								alert("lead id "+leadid);
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
                alert("Edit button pressed");
								alert("lead id "+leadid);
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
                alert("Update button pressed");
								alert("lead id "+leadid);
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
					 $('#jqxgrid').jqxGrid('renderaggregates');




 // Chart data preparation - start

// prepare jqxChart settings
//             alert("source "+leadata.toSource());

							var sampleData = datact;
						/*		var sampleData = [
														{leadstatusid:"1", leadstatus:"Prospect",zdays:"40", tdays:"21", sdays:"55", ndays:"10", twdays:"12", eidays:"23"}, 
														{leadstatusid:"2", leadstatus:"Met the customer",zdays:"13", tdays:"50", sdays:"90", ndays:"20", twdays:"26", eidays:"32"}, 
														{leadstatusid:"7", leadstatus:"Expanding And Build Relationship",zdays:"61", tdays:"20", sdays:"26", ndays:"53", twdays:"23", eidays:"45"}
													];
*/
									 var dataAdapter = new $.jqx.dataAdapter(source,
									{
										autoBind: true,
										async: false,
										downloadComplete: function () { },
										loadComplete: function () { },
										loadError: function () { }
									});
								
												 
								 var settings = {
                title: "No of days in Each Status",
                description: "Time spent in days",
                padding: { left: 5, top: 5, right: 5, bottom: 5 },
                titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
               source: sampleData,
                categoryAxis:
                    {
                        dataField: 'leadstatus',
                        showGridLines: false,
												flip: false,
												verticalTextAlignment: true,
												textRotationAngle:30,
												textOffset:{x:0,y:-50},
												horizontalTextAlignment:'center',
												verticalTextAlignment:'bottom',
												horizontalDescriptionAlignment:'center',
												verticalDescriptionAlignment:'bottom'
                    },
                colorScheme: 'scheme01',
                showToolTips: false,
                enableAnimations: true,
								columnSeriesOverlap: false,

                seriesGroups:
                    [
                        {
                            type: 'column',
                            valueAxis:
                            {
                                minValue: 0,
                                maxValue: <?php echo $leadcount; ?>,
                                unitInterval: 100,
                                description: 'No of Leads',
																showGridLines: false
                            },
                            mouseover: myEventHandler,
                            mouseout: myEventHandler,
                            click: myEventHandler,
                            series: [
																			{ dataField: 'zdays', displayText: '<30 days'},
																			{ dataField: 'tdays', displayText: '>30 days'},
																			{ dataField: 'sdays', displayText: '>60 days'},
																			{ dataField: 'ndays', displayText: '>90 days'},
																			{ dataField: 'twdays', displayText: '>120 days'},
																			{ dataField: 'eidays', displayText: '>180 days'}
                                ]
                        }
                    ]
            };
            function myEventHandler(e) {
                var eventData = '<div><b>There are '+e.elementValue +' Leads which are ' + e.serie.displayText + ' in this Status<b>  </b></div>';
                $('#eventText').html(eventData);
            };
            // select the chartContainer DIV element and render the chart.
            $('#chartContainer').jqxChart(settings);
 						$('#chartContainer').jqxChart('addColorScheme', 'myScheme', ['#215BCF', '#CC3300', '#7AA300','#5C00E6','#0099CC','#FF0066']);

    // apply the new scheme by setting the chart's colorScheme property
   					$('#chartContainer').jqxChart('colorScheme', 'myScheme');
						$('#chartContainer').jqxChart({showLegend: true});
					 $('#chartContainer').jqxChart({rtl : false}); 

						
		

 // chart data preparation - end


					  

        });
    </script>
	
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
								<a class="quickLinks" href="<?= base_url()?>dashboard/executivepipeline"><h5 class="title widgetTextOverflowEllipsis pull-right" title="Branch/User Wise Lead Ageing">Pipelined Leads</h5></a>
							<div class="clearfix"></div>
						</div>
<!-- second menu -->
						<!--<div class="quickWidget">-->
							<div class="accordion-heading accordion-toggle quickWidgetHeader" data-target="#Leads_sideBar_LBL_RECENTLY_MODIFIED" data-toggle="collapse" data-parent="#quickWidgets" data-label="LBL_RECENTLY_MODIFIED" data-widget-url="#">
								<span class="pull-left">
									<img class="imageElement" data-rightimage="<?= base_url()?>public/images/images/rightArrowWhite.png" data-downimage="<?= base_url()?>public/images/images/downArrowWhite.png" src="<?= base_url()?>public/images/rightArrowWhite.png">
								</span>
								<a class="quickLinks" href="<?= base_url()?>dashboard/additional"><h5 class="title widgetTextOverflowEllipsis pull-right" title="Branch/Status Wise Lead Count">Additional Lead Data</h5></a>
							<div class="clearfix"></div>
						</div>
<!-- second menu end-->
<!-- Third menu -->
						<div class="quickWidget">
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
								<a class="quickLinks" href="<?= base_url()?>dashboard/generadtedleads"><h5 class="title widgetTextOverflowEllipsis pull-right" title="User /Branch Wise Generated Leads">Generated leads</h5></a>
							<div class="clearfix"></div>						
						</div>
<!-- Fourth menu end-->
						<div class="widgetContainer accordion-body collapse" id="Leads_sideBar_LBL_RECENTLY_MODIFIED" data-url="test/test">
						</div>
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
							<span title="Petro Chemicals" class="recordLabel font-x-x-large span12 pushDown">
								<strong>Dashboard</strong>
							</span>
							
						</div>
							<span class="btn-group">
								<!-- <button id="Leads_listView_basicAction_LBL_ADD_RECORD" class="btn addButton" onclick='window.location.href="leads/add"'><i class="icon-plus icon-white"></i>&nbsp;<strong>Add Lead</strong></button> -->
							<div>Total No Of Leads:<?= $leadcount;?></div>
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
				      <div id="jqxgrid"></div>
						
				         

		      </div>

					<div>
						<table>
							<tr>
								<td>
										<div id='chartContainer' style="width:900px; height: 400px"/>
								</td>
							</tr>
							<tr>
								<td>
									<div id='eventText' style="width:600px; height: 30px"/> 
								</td>
							</tr>
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
