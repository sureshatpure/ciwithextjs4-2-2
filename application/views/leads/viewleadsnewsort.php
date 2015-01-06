<?php $this->load->view('header');

echo $blog_title;
die();
 ?>

<link rel="stylesheet" href="<?= base_url() ?>public/jqwidgets/styles/jqx.metrodark.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url() ?>public/jqwidgets/styles/jqx.base.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url() ?>public/jqwidgets/styles/jqx.energyblue.css" type="text/css" />
<script type="text/javascript">
        $(document).ready(function () 
        {

        	var theme = "";
            // Create a jqxMenu
            $("#jqxMenu").jqxMenu({ width: '670', height: '30px', theme: 'metrodark' });
            $("#jqxMenu").css('visibility', 'visible');
          
//				var leadata = $("#leadata").val();
				 var leadata = <?php echo $data; ?>;
				var baseurl = window.location.href.split(window.location.pathname)[0]+'/newsalescrm/';
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
		$("#jqxgrid").jqxGrid('exportdata', 'xls', 'viewleaddata');
		//$("#jqxgrid").jqxGrid('exportdata', 'xls', 'viewleaddata', true, null, true, 'http://10.1.2.40/salescrm/dashboard/savefile');
		});
        var source =
            {
                datatype: "json",
                sortcolumn: 'created_date',
                sortdirection: 'desc',
                datafields: [
                    { name: 'leadid'},
                    { name: 'lead_no' },
                    { name: 'lead_close_status'},
                    { name: 'branch' },
                    { name: 'leadstatus'},
                    { name: 'substatusname'},
                    { name: 'leadsource'},
                    { name: 'productname',type:'string'},
                    /*{ name: 'salestype',type:'string'},*/
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
                  { text: 'LeadNo', dataField: 'lead_no', width: 128 },
                  { text: 'Closed', dataField: 'lead_close_status', width: 75 },
                  { text: 'Branch', dataField: 'branch', width: 100,cellsalign: 'left' },
                  { text: 'Lead Status', dataField: 'leadstatus', width: 85 },
                  { text: 'Lead SubStatus', dataField: 'substatusname', width: 120 },
                  { text: 'Lead Source', dataField: 'leadsource', width: 85, cellsalign: 'left' },
                  { text: 'Product Name', dataField: 'productname', width: 100, cellsalign: 'left'},
                  /*{ text: 'Sales Type', dataField: 'salestype', width: 100, cellsalign: 'left'},*/
                  { text: 'Assigned From', dataField: 'assign_from_name', width: 120, cellsalign: 'left' },
			 { text: 'Assigned To', dataField: 'empname', width: 125, cellsalign: 'left' },
                  { text: 'Customer Name', dataField: 'tempcustname', cellsalign: 'left', minwidth: 150 },
                  { text: 'Created Date', dataField: 'created_date', cellsalign: 'left', width: 95, cellsformat: 'd',formatString:'d'},
                  { text: 'Last Activity', dataField: 'modified_date', cellsalign: 'left', width: 95, cellsformat: 'd',formatString:'d'}
                 
                ], 
			showtoolbar: true,
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
                 //alert(permission[i].groupname);
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
                  window.open( 'leads/viewleaddetails/'+leadid);
                });


                var oldVal = "";
                viewlead.on('click', function (event) 
								{
								var rowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
 								var leadid = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'leadid');


 								$('#jqxButton').attr('href',baseurl+'leads/viewleaddetails/'+leadid);	
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
 								var closed = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'lead_close_status');
              						if (leadid==null || closed=="Closed")
								{
									if (leadid==null)
									{
										alert("Please Select a row ");		
										return false;
									}
									else
									{
										alert("You are not allowed to edit a closed lead ");		
										return false;

									}
									
		
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
 								var closed = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'lead_close_status');
								if (leadid==null || closed=="Closed")
								{
									if (leadid==null)
									{
										alert("Please Select a row ");		
										return false;
									}
									else
									{
										alert("You are not allowed to update a closed lead ");		
										return false;

									}
									
		
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



<?php  $this->load->view('pageheader.php') ?>


	<div class="mainContainer floatRight">
            	
	<input value="Leads" id="module" name="module" type="hidden">
	<input value="" id="parent" name="parent" type="hidden">
	<input value="List" id="view" name="view" type="hidden">
	<span class="span8 font-x-x-large textOverflowEllipsis">View Leads</span>
											<span class="btn-group">
								<!-- <button id="Leads_listView_basicAction_LBL_ADD_RECORD" class="btn addButton" onclick='window.location.href="leads/add"'><i class="icon-plus icon-white"></i>&nbsp;<strong>Add Lead</strong></button> -->
					<?php if($this->session->flashdata('message')!="") {?>
					<div class="alert alert-message.success"><p style="width:709px; text-align:center;font-size:18px;"><?php 
					 echo $this->session->flashdata('message'); ?></p></div>
					<?php }?>


						</span>
						
															
				<div id='jqxWidget'>
				<input style='margin-top: 10px;' title="Currently you cannot export all the data,instead filter the data and try to use Export to Excel option"   alt="Currently you cannot export all the data,instead filter the data and try to use Export to Excel option" type="button" value="Export to Excel" id='excelExport' />
		        	<div id="jqxgrid"></div>
		       

        </div>
  		</div>
    
    
   <?php $this->load->view('pagefooter'); ?>
        </div>	
        <div class="clear"></div>
        </div>	
		
<!-- Added in the end since it should be after less file loaded -->

</body>
</html>
