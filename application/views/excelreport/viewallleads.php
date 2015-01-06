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
	<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxdatetimeinput.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxcalendar.js"></script>


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
<!-- for filter start -->

<!-- Filters end -->
	 <!-- paging - start -->
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.pager.js"></script>
	 <!-- paging - end -->

 <!-- charts - start -->
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxdata.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxchart.js"></script>
 <!-- charts - end -->

<!-- End of jqwidgets -->
	
<script type="text/javascript">
var base_url = '<?php echo site_url(); ?>';
			
        $(document).ready(function () 
        {
        	var theme = "black";
            // Create a jqxMenu
            $("#jqxMenu").jqxMenu({ width: '670', height: '30px', theme: 'black' });
            $("#jqxMenu").css('visibility', 'visible');
            
		var theme = 'energyblue';
		var permission = <?php echo $grpperm; ?>;
		var br = $('#hdn_branch').val();
		var sel_user_id = $('#hdn_userid').val();
		var hdnfrom_date = $('#hdn_from_date').val();
		var hdnto_date = $('#hdn_to_date').val();
		
		 var sourceg ;
		 var source ;
		var sourcen ;
		var sampleData;
		var dataFieldbranch;
		var from_date;
		var to_date;
		var sel_datefilter;
		var url;
		var baseurl = base_url;
		setInitialgridsource(permission);
		


        	function setInitialgridsource(permission)
        	{
		//alert("in function");
	//	var leadata = grid_data;
		var baseurl = base_url;
		
		var permission = permission;
		var group_len = 	permission.length;
		var theme = 'energyblue';

 		 var url = baseurl + "dashboard/getbranches";	
		  
                // prepare the data
                source =
                {
                    datatype: "json",
                    datafields: [
                        { name: 'branch' },
                        { name: 'branch' }
                    ],
                    url: url,
                    async: false
                };

                var dataAdapter = new $.jqx.dataAdapter(source);
                // Create a jqxDropDownList
                $("#columnchooser").jqxDropDownList({
                    selectedIndex: -1, 
			source: dataAdapter, 
			displayMember: "branch", 
			valueMember: "branch", 
			width: 200, 
			height: 25, 
			theme: theme,  
			placeHolder: '– Please Select Branch –'
                });

               
 		$("#columnchooser").jqxDropDownList('val', br);

 			//alert("selected branch "+br);
 		 if (br=='SelectBranch')
 		 {
 			 var url = baseurl + "dashboard/getusersforloginuser";	
 		 }
 		 else
 		 {
  		 	var url = baseurl + "dashboard/getassignedtobranch/"+br;
 		 }

              
                // prepare the data
                branchsource =
                {
                    datatype: "json",
                    datafields: [
			            { name: 'displayname' },
			            { name: 'header_user_id' }
                    ],
                    url: url,
                    async: false
                };

                var branchsourcedataAdapter = new $.jqx.dataAdapter(branchsource);
                // Create a jqxDropDownList
                $("#selectuser").jqxDropDownList({
                    selectedIndex: -1, 
			source: branchsourcedataAdapter, 
			displayMember: "displayname", 
			valueMember: "header_user_id", 
			width: 200, 
			height: 25, 
			theme: theme,  
			placeHolder: '– Please Select User –'
                });
		$("#selectuser").jqxDropDownList('val', sel_user_id);
        	} // end of funtion setInitialgridsource

		
                // subscribe to the select event.
// for data adapter for users 

							 
// users end


// start for filters

          
// updates the listbox with unique records depending on the selected column.
            var updateFilterBox = function (datafield) {
            //	 alert('testing'+datafield);

	       var url = baseurl + "dashboard/getassignedtobranch/"+datafield;

			    // prepare the data
			     source =
			    {
			        datatype: "json",
			        datafields: [
			            { name: 'displayname' },
			            { name: 'header_user_id' }
			        ],
			        url: url,
			        async: false
			    };

			    var dataAdapter = new $.jqx.dataAdapter(source);
			    // Create a jqxDropDownList
			    $("#selectuser").jqxDropDownList({
					       selectedIndex: -1 ,
						source: dataAdapter, 
						displayMember: "displayname", 
						valueMember: "header_user_id", 
						width: 200, 
						height: 25, 
						theme: theme,  
						placeHolder: '– Please Select –'
			    });



            }

          //  updateFilterBox('firstname');

            // handle select all item.
            var handleCheckChange = true;
            $("#filterbox").on('checkChange', function (event) {
                if (!handleCheckChange)
                    return;

                if (event.args.label != '(Select All)') {
                    handleCheckChange = false;
                    $("#filterbox").jqxListBox('checkIndex', 0);
                    var checkedItems = $("#filterbox").jqxListBox('getCheckedItems');
                    var items = $("#filterbox").jqxListBox('getItems');

                    if (checkedItems.length == 1) {
                        $("#filterbox").jqxListBox('uncheckIndex', 0);
                    }
                    else if (items.length != checkedItems.length) {
                        $("#filterbox").jqxListBox('indeterminateIndex', 0);
                    }
                    handleCheckChange = true;
                }
                else {
                    handleCheckChange = false;
                    if (event.args.checked) {
                        $("#filterbox").jqxListBox('checkAll');
                    }
                    else {
                        $("#filterbox").jqxListBox('uncheckAll');
                    }

                    handleCheckChange = true;
                }
            });

            // handle columns selection.
            $("#columnchooser").on('select', function (event) {
                updateFilterBox(event.args.item.value);
            });


          sel_datefilter = $('#date_filter').val();
        //   alert("select date filter value ouside setfilter fn "+sel_datefilter);
		$('#fromdate').on('valuechanged', function (event) {
			                  from_date=$("#fromdate").jqxDateTimeInput('getDate');
			                     //   alert("from date in "+from_date);
			                       from_date=convert(from_date);

		});
		$('#todate').on('valuechanged', function (event) {
			                  to_date=$("#todate").jqxDateTimeInput('getDate');
			                     //   alert("todate in "+to_date);
			                     to_date=  convert(to_date);

		});
            // applies the filter.
         

           
// End for filters 

//Start function for exportexcel filter
	$("#exportexcel").jqxButton({ theme: theme });
 	$("#exportexcel").click(function () 
 		{
			dataFieldbranch = $("#columnchooser").jqxDropDownList('val');
			var dataFielduser = $("#selectuser").jqxDropDownList('val');
			sel_datefilter = $('#date_filter').val();
		//	alert("select date filter value inside applyfilter fn "+sel_datefilter);
			if(dataFieldbranch.length==0)
			{
				//alert("Please Select the Branch");
				//return false;
				setfiltersexportAll();
			}
			else
			{
				// exportexcel(dataField);
				setfiltersexport(dataFieldbranch,dataFielduser,from_date,to_date);
			}

		});

		var setfiltersexport = function (datafield,dataFielduser,from_date,to_date) {
             	//alert("set setfilters - from  "+from_date);
             //	alert("setfilters - to  "+to_date);
            // 	alert("select date filter value inside setfilter fn "+sel_datefilter);
            // 	alert("the dataFielduser "+dataFielduser);



         	sel_datefilter = $('#date_filter').val();
             	  if((dataFielduser!="") && (sel_datefilter==true))
             	{                 		 
             		  $.ajax({
	                  	  url : baseurl + 'excelreportbranch/exgetdatabranch_user_dt_filter/'+ datafield+'/'+dataFielduser+'/'+from_date+'/'+to_date,
	                   success : function(){
	                       // i must remove the div
	                     //  alert("success");
	                    //   window.location.href=baseurl + 'dashboard/getdatawithfilter/'+ datafield+'/'+dataFielduser+'/'+from_date+'/'+to_date;
	                    window.location.href=baseurl + 'excelreportbranch/exgetdatabranch_user_dt_filter/'+ datafield+'/'+dataFielduser+'/'+from_date+'/'+to_date;
	                    
	                   }
	               });
             	}
	            
	             else if(sel_datefilter==true)
	             {    
				
				  $.ajax({
	                  	url : baseurl + 'excelreportbranch/exgetdatabranch_dt_filter/'+ datafield+'/'+from_date+'/'+to_date,
	                    
	                   success : function(){
	                       // i must remove the div
	                     //  alert("success");
	                       window.location.href=baseurl + 'excelreportbranch/exgetdatabranch_dt_filter/'+ datafield+'/'+from_date+'/'+to_date;
	                    //window.location.href=baseurl + 'dashboard/getdatawithdate_filter/'+ datafield+'/'+dataFielduser+'/'+from_date+'/'+to_date;
	                    
	                   }
	               });
	             }
	             else 
	             {
	        	     $.ajax({
	                  	url : baseurl + 'excelreportbranch/exgetdatawithfilter/'+ datafield+'/'+dataFielduser,
	                  	//url : baseurl + 'excelreportbranch/hyderbadleadprod',

	                   success : function(){
	                       // i must remove the div
	                     //  alert("success");
	                       window.location.href=baseurl + 'excelreportbranch/exgetdatawithfilter/'+ datafield+'/'+dataFielduser;
					//window.location.href=baseurl + 'excelreportbranch/hyderbadleadprod';
	                    //window.location.href=baseurl + 'dashboard/getdatawithdate_filter/'+ datafield+'/'+dataFielduser+'/'+from_date+'/'+to_date;
	                    
	                   }
	               });

	             }
	          //   alert("the url set is "+url);

             }

// setfiltersexportAll function to export all lead data - Start

			var setfiltersexportAll = function () {
                  	{
                  		  $.ajax({
	                  	  url : baseurl + 'excelreportbranch/exgetallleaddata',
	                   success : function(){
	                       // i must remove the div
	                     //  alert("success");
	                    //   window.location.href=baseurl + 'dashboard/getdatawithfilter/'+ datafield+'/'+dataFielduser+'/'+from_date+'/'+to_date;
	                    window.location.href=baseurl + 'excelreportbranch/exgetallleaddata';
	                    
	                   }
	               });
             	}
             }

// - End setfiltersexportAll


//End function for exportexcel filter

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
	
					$('#jqxButtonadd').attr('href',baseurl+'leads/add');
				  
				});

            };
			
 			 $('#date_filter').jqxCheckBox({ checked: false, height: 25, theme: theme });
			$("#fromdate").jqxDateTimeInput({ width: '150px', height: '25px', theme: theme, formatString: 'MMM-dd', disabled:true });
			$("#todate").jqxDateTimeInput({ width: '150px', height: '25px', theme: theme, formatString: 'MMM-dd',disabled:true });

 			 from_date=$("#fromdate").jqxDateTimeInput('getDate');
			                       from_date=convert(from_date);
			                        //  alert("from date in "+from_date);

           		to_date=$("#todate").jqxDateTimeInput('getDate');
			                     to_date=  convert(to_date);
			                       //  alert("todate in "+to_date);
			//alert("hdnfrom_date is "+hdnfrom_date);
			
			$("#fromdate").jqxDateTimeInput('setDate', hdnfrom_date);
			$("#todate").jqxDateTimeInput('setDate', hdnto_date);
			$("#fromdate").jqxDateTimeInput({ disabled: true });
			$("#todate").jqxDateTimeInput({ disabled: true });
			sel_datefilter = $('#date_filter').val();
			//alert("date filter option is "+sel_datefilter);
			function convert(from_date)
			{
			     var date = new Date(from_date),mnth = ("0" + (date.getMonth()+1)).slice(-2),day  = ("0" + date.getDate()).slice(-2);
			     return [ date.getFullYear(), mnth, day ].join("-");
			     //alert([ date.getFullYear(), mnth, day ].join("-"));
			}

			 $('#date_filter').on('change', function (event) {
			               // alert(event.args.checked);  
			                if(event.args.checked==true)
			                {
			                	/*$("#fromdate").jqxDateTimeInput({ disabled: true });
			              	$("#to_date").jqxDateTimeInput({ disabled: true });	*/
			              	//alert("in true");
			              	$("#fromdate").jqxDateTimeInput({ disabled: false });
			              	$("#todate").jqxDateTimeInput({ disabled: false });
						
			                }
			                else
			                {
			                //	alert(" in false");
			                	$("#fromdate").jqxDateTimeInput({ disabled: true });
			              	$("#todate").jqxDateTimeInput({ disabled: true });
			                }
			                

			              
			            });
 // Chart data preparation - start
		

 // chart data preparation - end


					  

        });
    </script>


	<!-- end of Menu includes -->
	
	<input value="Leads" id="module" name="module" type="hidden">
	<input value="" id="parent" name="parent" type="hidden">
	<input value="<?php echo $branch; ?>" id="hdn_branch" name="hdn_branch" type="hidden">
	<input value="<?php echo @$sel_user_id; ?>" id="hdn_userid" name="hdn_userid" type="hidden">
	<input value="<?php echo @$from_date; ?>" id="hdn_from_date" name="hdn_from_date" type="hidden">
	<input value="<?php echo @$to_date; ?>" id="hdn_to_date" name="hdn_to_date" type="hidden">

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
								<a class="quickLinks" href="<?= base_url()?>dashboard/generadtedleads"><h5 class="title widgetTextOverflowEllipsis pull-right" title="User /Branch Wise Generated Leads">User /Branch Wise Generated Leads</h5></a>
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
						<div class="contentHeader row-fluid" style="width:500px;">
							<span title="Executive Pipeline" class="recordLabel font-x-x-large span12 pushDown">
								<strong>Lead Data with Product Information for Report</strong>
							</span>
							
						</div>
						
							<span class="btn-group"><!-- <pre><?php echo"lead_ub_count ".$this->session->userdata['lead_ub_count'];
							 echo"user_leads_count ".$this->session->userdata['user_leads_count'] ?></pre> -->
								<!-- <button id="Leads_listView_basicAction_LBL_ADD_RECORD" class="btn addButton" onclick='window.location.href="leads/add"'><i class="icon-plus icon-white"></i>&nbsp;<strong>Add Lead</strong></button> -->
								<div>Total No Of Leads:<?= @$maxvalue;?> 
									<table width="540px">
										<tr>
											<td width="25%"><div>Choose Column:</div></td>
											<td><div style="float: left" id="columnchooser"></div></td>
											<td><div style="float: inherit" id="selectuser"></div></td>
										</tr>
										<tr>
											<td  width="30%"><div  id='date_filter'>Use Date Filter</div></td>
											<td><label>Select From Date </label><div style="float: inherit;" id="fromdate" name="fromdate"></div></td>
											<td><label>Select To Date </label><div style="float: inherit;" id="todate" name="todate"></div></td>
										</tr>
										<tr>
											<!-- <td><input type="button" id="applyfilter" value="Apply Filter" /></td> -->
											<td></td>
											<td><input type="button" id="exportexcel" value="ExportAsExcel" /></td>
										</tr>
									</table>
								</div>
								<?php if($this->session->flashdata('message')!="") {?>
								<div class="alert alert-message.success"><p style="width:709px; text-align:center;font-size:18px;"><?php 
								 echo $this->session->flashdata('message'); ?></p>
								</div>
								<?php }?>
							</span>
						</span>
						</div>
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
