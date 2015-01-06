<?php $this->load->view('header');?>
<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.base.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.energyblue.css" type="text/css" />
	<style>
	.error{
		color: red;
	}
	</style>

    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/scripts/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.selection.js"></script> 
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.columnsresize.js"></script> 
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxdata.js"></script> 
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxwindow.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/scripts/gettheme.js"></script>
  <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.edit.js"></script>
  <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxinput.js"></script>

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

  	<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>
	<script src="<?=base_url()?>public/js/additional-methods.js"></script>
	<script src="<?=base_url()?>public/js/validation_rules.js"></script> 
	<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.black.css" type="text/css" />

<!-- End of jqwidgets -->
<!-- end of Menu includes -->
	 <script type="text/javascript">
	function openpopup(id)
		{
			// alert("company id passed is "+id);
			$('#jqxsoc').jqxWindow('open');
			$("#jqxsoc").jqxWindow({ width: 600, height: 220,isModal: true});
		
		}
	

	   var controller = 'leads';
	   var base_url = '<?php echo site_url();?>index.php';
	   
		$(document).ready(function()
		{

/* Close lead start*/

		$("#closeleadform").validate({

            errorElement: "span", 
            //set the rules for the fild names
            rules: {
                closingcomments: {
                    required: true
                    }
                },

            messages: {
     
                closingcomments:{ 
                    required: "Please Enter you Closing comemnts",
                }
            },
              //our custom error placement
            errorElement: "span",
            errorPlacement: function(error, element) {
                    error.appendTo(element.parent());
                }

        });



          		$("#closeleadoptions").jqxButton({ theme: 'energyblue'});
          		$("#jqxSubmitButton").jqxButton({ theme: 'energyblue',width: '150'});
          		$("#close_lead").jqxButton({ theme: 'energyblue',width: '100'});
          		
          		$("#closingcomments").jqxInput({
			    placeHolder: "Enter Your comments for closing the Lead",
			    height: 100,
			    width: 350,
			    minLength: 1,
			    theme:'energyblue'
			});
          		
          		
          		
 			var source_closelead = ["Credit Not Worthy","Is a Trader","Product Not dealt by us","Pricing issue","Company closed","Doing job work","Using waste/ recovery solvent","Directly importing"];
			 $('#close_lead').click(function () 
			 {
                    $('#closelead_win').jqxWindow({theme: 'energyblue'});
                     $('#closelead_win').jqxWindow('resizable', true);
                      $('#closelead_win').jqxWindow('draggable', true);
                    $('#closelead_win').jqxWindow('open');

                    //$('#window').jqxWindow({isModal: true});
                });

			$('#closelead_win').jqxWindow(
			{
                    showCollapseButton: true, theme: 'energyblue', title:'Select the option for closing the lead', height: 250, width: 450,
                    initContent: function () 
                    {
                        
                        $('#closelead_win').jqxWindow('focus');
                    }
                });	 
			$("#closeleadoptions").jqxDropDownList({ source: source_closelead, selectedIndex: 1, width: '200', height: '25',theme: 'energyblue'});

			 $("#jqxSubmitButton").on('click', function () 
			 {
                     $("#closeleadform").submit();
                //     $('#closelead_win').jqxWindow('close');
                });

			 $('#closeleadoptions').on('select', function (event) 
			    {
			  
			        var args = event.args;
			        if (args) 
			        {
			          var index = args.index;
			          var item = args.item;
			          var close_name = item.label;
			          var close_id = item.value;
			          $('#hdn_closename').val(close_name);
			       }
			 });

			

/* Close lead END*/
			var option = $('#presentsource').val();  // here we are taking option id of the selected one.

			if(option=="Domestic and Import" || option=="Domestic" ) 
			{
				$('#contentSuplier').show();
				$('#txtDomesticSource').show();

			}
			else	
			{
				$('#txtDomesticSource').hide();
				$('#contentSuplier').hide();
			}


 		var leadata = <?php echo $data; ?>;

 		var source =
            {	
                localdata: leadata,
                datatype: "array",
                datafields:
                [
                    { name: 'crm_soc_no' },
                    {name:'itemdesc'},
                    { name: 'customer_id'},
                    { name: 'customer_name', type: 'string' },
                    { name: 'lead_cusomer_ref_id'},
                    { name: 'customer_number'},
                    
                    
    			        
              ],
              pagenum: 0, pagesize: 35, pager: function (pagenum, pagesize, oldpagenum) {
                    // callback called when a page or page size is changed.
                }
          };

 		var dataAdapter = new $.jqx.dataAdapter(source);
 		$("#jqxcustomergrid").jqxGrid(
        	{
              width:560,
              height:250,
              source: dataAdapter,
              selectionmode: 'singlerow',
              theme: 'energyblue',
              sortable: true,
              pageable: true,
              columnsresize: true,
              editable: false,
              showfilterrow: true,
              filterable: true,
              autoheight: true,
              showtoolbar: true,
              pageable: true,
              
              columns: [
              { text: 'SocID', datafield: 'crm_soc_no', width: 100 },
              { text: 'Customer Id', datafield: 'customer_id', cellsalign: 'left',width:100 },
              { text: 'Product', datafield: 'itemdesc', cellsalign: 'left',width:100 },
              { text: 'Customer Name', datafield: 'customer_name',  cellsalign: 'left',width:200 },
              { text: 'Customer Number', datafield: 'customer_number', cellsalign: 'left',width:100 }
               ]
	});
 			 $("#jqxcustomergrid").on('celldoubleclick', function (event) 
 			 {
					  var column = event.args.column;
			             var rowindex = event.args.rowindex;
			             var  jqxcustomergrid_row_index=rowindex;
			                
			                var columnindex = event.args.columnindex;
			                var columnname = column.datafield;
					//	var hiddid = $("#hdnselid").val();
						  
						  //var custgroup_val = $('#jqxcustomergrid').jqxGrid('getcellvalue', rowindex, "cust_account_id");
						  var custgroup_val = $('#jqxcustomergrid').jqxGrid('getcellvalue', rowindex, "crm_soc_no");
                
                   
                   $('#txtLeadsoc').val(custgroup_val);
						//var hdnProdid = hiddid.replace('customFieldName','hdncustomFieldName');
						  	/*
								alert(" after replace "+hiddid);
								alert("productid "+prodid);
								alert("prodName  "+prodName);
								alert("hdnProdid  "+hdnProdid);
							*/
							//$(window.opener.document).find('#txtLeadsoc').val(prodName);
								//$(window.opener.document).find('#'+hiddid).val(prodName);
								//$(window.opener.document).find('#'+hdnProdid).val(prodid);
					$('#jqxsoc').jqxWindow('hide');
							//	window.close();


								
			});


	$("#jqxcustomergrid").on("cellselect", function (event)
          {
                var column = event.args.column;
                var rowindex = event.args.rowindex;
                var jqxcustomergrid_row_index=rowindex;
              
                var columnindex = event.args.columnindex;
                var columnname = column.datafield;
            //    if (columnname=='itemgroup')
           //     {
                
                    //var custgroup_val = $('#jqxcustomergrid').jqxGrid('getcellvalue', rowindex, "cust_account_id");
                    var custgroup_val = $('#jqxcustomergrid').jqxGrid('getcellvalue', rowindex, "crm_soc_no");
                
                   
                 
               // }
                  
         
          });

		var theme = "";
            // Create a jqxMenu
            $("#jqxMenu").jqxMenu({ width: '670', height: '30px', theme: 'black' });
            $("#jqxMenu").css('visibility', 'visible');

		$("#addCF").on("click",function()
		    {
			   var $tableBody = $('#customFields').find("tbody"),
			   $trLast = $tableBody.find("tr:last"),
			   $trNew = $trLast.clone();
			   $trLast.after($trNew);
			   $trNew.find(':text').val('');
			  
			});
		  $('#remCF').on("click", function(){
			 $('#customFields tr:last').remove();
		  });


					$('#leadstatus').change(function(){ 

							$("#leadsubstatus > option").remove(); //first of all clear select items
								var option = $('#leadstatus').val();  // here we are taking option id of the selected one.
								
								 if(option=="6" || option=="7") 
									{
										$('#content').show();
										$('#txtLeadsoc').show();
										//popup code
										openpopup(this.id);
									}
									 else	
								   	 {
								  		$('#txtLeadsoc').hide();
								  		$('#content').hide();
								      }								

									if(option == '#'){
											return false; // return false after clearing sub options if 'please select was chosen'
										}
										$.ajax({
										type: "POST",
										url: base_url+"/leads/getleadsubstatus/"+option, 
										success: function(suboptions) 
													{
													  $.each(suboptions,function(id,value) 
															{
														    var opt = $('<option />'); 
														    opt.val(id);
														    opt.text(value);
														    $('#leadsubstatus').append(opt); 
														});
												}
								 
										});
							});

						$('#branch').change(function()
									{ 
										$("#assignedto > option").remove(); 
										var option = $('#branch').val();  
										 if(option == '#')
											{
												return false; 
											}

										$.ajax({
											type: "POST",
											url: base_url+"/leads/getassignedtobranch/"+option, 
												success: function(suboptions) 
												{
													$.each(suboptions,function(header_user_id,displayname) 
													{
												//	alert("id "+header_user_id);alert("name "+displayname);
													var opt = $('<option />');
													opt.val(header_user_id);
													opt.text(displayname);
													$('#assignedto').append(opt); 
													});
												}
											});
									});

/**/
					$('#presentsource').change(function(){ 
					
								
								var option = $('#presentsource').val();  // here we are taking option id of the selected one.
								
								 if(option=="Domestic" || option=="Domestic and Import") 
									{
										$('#contentSuplier').show();
										$('#txtDomesticSource').show();
										//popup code
									
									}
									 else	
								   	 {
								  		$('#txtDomesticSource').hide();
								  		$('#contentSuplier').hide();
								      }
		});	
/**/


	        $('#country').change(function(){ //any select change on the dropdown with id options trigger this code
	            $("#state > option").remove(); //first of all clear select items
	            var option = $('#country').val();  // here we are taking option id of the selected one.

	            if(option == '#'){
	                return false; // return false after clearing sub options if 'please select was chosen'
	            }

	            $.ajax({
	                type: "POST",
	                url: base_url+"/leads/getstates/"+option, //here we are calling our dropdown controller and getsuboptions method passing the option
	 
	                success: function(suboptions) //we're calling the response json array 'suboptions'
	                {
	                    $.each(suboptions,function(id,value) //here were doing a foeach loop round each sub option with id as the key and value as the value
	                    {
	                        var opt = $('<option/>'); // here we're creating a new select option for each suboption
	                        opt.val(id);
	                        opt.text(value);
	                        $('#state').append(opt); //here we will append these new select options to a dropdown with the id 'suboptions'
	                    });
	                }
	 
	            });
	 
	        });

		$('#state').change(function(){ //any select change on the dropdown with id options trigger this code
				$("#city > option").remove(); //first of all clear select items
				var option = $('#state').val();  // here we are taking option id of the selected one.

				if(option == '#'){
						return false; // return false after clearing sub options if 'please select was chosen'
				}

				$.ajax({
						type: "POST",
						url: base_url+"/leads/getcities/"+option, //here we are calling our dropdown controller and getsuboptions method passing the option

						success: function(suboptions) //we're calling the response json array 'suboptions'
						{
							  $.each(suboptions,function(id,value) //here were doing a foeach loop round each sub option with id as the key and value as the value
							  {
							      var opt = $('<option/>'); // here we're creating a new select option for each suboption
							      opt.val(id);
							      opt.text(value);
							      $('#city').append(opt); //here we will append these new select options to a dropdown with the id 'suboptions'
							  });
						}

				});

		});

	 	 $(".slidingDiv").hide();
		$(".show_hide").show();
		
		$('.show_hide').click(function(){
		$(".slidingDiv").slideToggle();
		});



        $(".deleteProd").click(function(e){
            $this  = $(this);
            e.preventDefault();
            var url = $(this).attr("href");
						var result = window.confirm('Are you sure to delete the product ?');
				        if (result == false) {
				            e.preventDefault();
				        }
								else
								{
								 $.get(url, function(r){
														  if(r){
																		//	$this.closest("tr").remove();
																		alert("Product will be deleted");			
																			$this.closest("tr").remove();
																	 }
																	else
																	{
								 											//alert("returned false");
																	}
													})
								}
        });
	});
	</script>

			<input type="hidden" name="module" id="module" value="Leads"><input type="hidden" name="parent" id="parent" value=""><input type="hidden" name="view" id="view" value="Edit">

			<div class="navbar commonActionsContainer noprint">
				<div class="actionsContainer row-fluid" style="position: relative; top: 5px; left: 5.5px;">
					<div class="span2">
						<span class="companyLogo"><img alt="logo.png" title="logo.png" src="<?=base_url()?>public/images/logo.png">&nbsp;</span>
					</div>
					<div class="span10 marginLeftZero">
						<div class="row-fluid">
							&nbsp;
</div></div></div></div></div></div></div>
			<div class="bodyContents" style="min-height: 448px;">
				<div class="mainContainer row-fluid">
					<div class="span2 row-fluid">
						<div class="row-fluid"><div class="sideBarContents"><div class="quickLinksDiv"><p class="unSelectedQuickLink" id="Leads_sideBar_link_LBL_RECORDS_LIST" onclick="<?=base_url()?>leads"><a href="<?=base_url()?>leads"><strong>Leads List</strong></a></p><p class="unSelectedQuickLink" id="Leads_sideBar_link_LBL_DASHBOARD" onclick="#"><a href="#" class="quickLinks"><strong>Dashboard</strong></a></p></div><div class="clearfix"></div><div class="quickWidgetContainer accordion"><div class="quickWidget"><div data-widget-url="module=Leads&amp;view=IndexAjax&amp;mode=showActiveRecords" data-label="LBL_RECENTLY_MODIFIED" data-parent="#quickWidgets" data-toggle="collapse" data-target="#Leads_sideBar_LBL_RECENTLY_MODIFIED" class="accordion-heading accordion-toggle quickWidgetHeader"><span class="pull-left"><img src="<?= base_url()?>public/skins/images/rightArrowWhite.png" data-downimage="<?= base_url()?>public/skins/images/downArrowWhite.png" data-rightimage="<?= base_url()?>public/skins/images/rightArrowWhite.png" class="imageElement"></span><h5 title="Recently Modified" class="title widgetTextOverflowEllipsis pull-right">Recently Modified</h5><div class="loadingImg hide pull-right"><div class="loadingWidgetMsg"><strong>Loading Widget</strong></div></div><div class="clearfix"></div></div><div data-url="module=Leads&amp;view=IndexAjax&amp;mode=showActiveRecords" id="Leads_sideBar_LBL_RECENTLY_MODIFIED" class="widgetContainer accordion-body collapse"></div></div></div></div></div>
					</div>
					<div class="contentsDiv span10 marginLeftZero">

			<div class="editViewContainer">
				<form action="<?= base_url()?>leads/updatelead/<?php echo $leaddetails['0']['leadid'];?>" method="post" name="leadform" id="leadform" class="form-horizontal recordEditView">
					
					<div class="contentHeader row-fluid">
						<span class="span8 font-x-x-large textOverflowEllipsis">Editing Lead </span>
						<span class="pull-right">
					 	 <input type="button" value="Close Lead" id="close_lead" name="close_lead" />			
						<input class="submit" id="updatelead" name="updatelead" type="submit" value="Update" />
							<a onclick="javascript:window.history.back();" type="reset" class="cancelLink">Cancel</a>
						</span>
					</div>
					<table class="table table-bordered blockContainer showInlineTable">
						<tbody>
							<tr>
								<th colspan="4" class="blockHeader">Lead Details</th>
							</tr>
							<tr>

									<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Customer</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
										<?php   
											 echo form_dropdown('company', $optionscmp, set_value('company', (isset($leaddetails['0']['company'])) ? $leaddetails['0']['company'] : ''), 'id="company"','name="company"');      
								    			echo form_error('company');   ?>           
										</span>
									</div>
								</td>
							<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Industry Type</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid"> 
										<span class="span10">
										<?php  
										echo form_dropdown('industry', $optionsinds, set_value('industry', (isset($leaddetails['0']['industry_id'])) ? $leaddetails['0']['industry_id'] : ''),'id="industry"','name="industry"');   
							    			echo form_error('industry');  ?>         
									</span>
									</div>
								</td>

							</tr>
<!--  -->
							<tr>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Customer Finished Goods / End Products </label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
											<textarea name="producttype" id="producttype"><?php echo trim($leaddetails['0']['producttype']);?></textarea>
										</span>
									</div>
								</td>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Customer End Product Sale Type </label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
											<?php   
											echo form_dropdown('exportdomestic', $optionsexp,set_value('exportdomestic', (isset($leaddetails['0']['exporttype'])) ? $leaddetails['0']['exporttype'] : ''),'id="exportdomestic"','name="exportdomestic"');
											echo form_error('exportdomestic'); ?>  
			
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Purchase Decision Maker </label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
											<input type="text" name="purchasedecision" id="purchasedecision" value="<?php echo $leaddetails['0']['decisionmaker']; ?>" maxlength="40"  /> 
										</span>
									</div>
								</td>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Present Procurement / Purchase source</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
											<?php   
											echo form_dropdown('presentsource', $optionsprestsrc,set_value('presentsource', (isset($leaddetails['0']['presentsource'])) ? $leaddetails['0']['presentsource'] : ''),'id="presentsource"','name="presentsource"');   
											echo form_error('presentsource'); ?>  
			
										</span>
									</div>

<!-- Start -->
 <div id='contentSuplier' style="display: none">
        <div>
        		<font color="blue">Enter the Name of the Supplier</font><input type="text" name="txtDomesticSource" id="txtDomesticSource" style="display: none" value="<?php echo $leaddetails['0']['domestic_supplier_name']; ?>" placeholder="Name of the Supplier">
        </div>
        
    </div>
    <!-- End -->
								</td>
							</tr>
							<!--  -->
							<tr>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Lead Status</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
										<?php   
							 			echo form_dropdown('leadstatus', $optionslst, set_value('leadstatus', (isset($leaddetails['0']['leadstatusid'])) ? $leaddetails['0']['leadstatusid'] : ''),'id="leadstatus"');   
							    			echo form_error('leadstatus');   ?>         
									</span>
									</div>
<!-- Start -->
 <div id='content' style="display: none">
        <div><input type="text" name="txtLeadsoc" id="txtLeadsoc" style="display: none" readonly="true" placeholder="Get SOC Number"></div>
        <div id='jqxsoc' style='width:550 px; height:215px;'>
        	<div> Select the SOC Number</div>
            <div>
           		<div id="jqxcustomergrid" style='width:550px; height:215px;'></div>
	 	 </div>
            <input type="hidden" id="hdnselid" value="<?=$this->uri->segment(3);?>">
        </div>
    </div>
    <!-- End -->
								</td>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Sub Status</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
										<?php   
										 echo form_dropdown('leadsubstatus', $optionslsubst, set_value('leadsubstatus', (isset($leaddetails['0']['ldsubstatus'])) ? $leaddetails['0']['ldsubstatus'] : ''), 'id="leadsubstatus"','name="leadsubstatus"');      
							    			echo form_error('leadsubstatus');   ?> 
											
										</span>
									</div>
								</td>
							</tr>
							<tr>
							<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Lead Source</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
										<?php   
										 echo form_dropdown('leadsource', $optionslsr, set_value('leadsource', (isset($leaddetails['0']['leadsourceid'])) ? $leaddetails['0']['leadsourceid'] : ''), 'id="leadsource"','name="leadsource"');      
							    			echo form_error('leadsource');   ?> 
											
										</span>
									</div>
								<input type="hidden" id="hdn_cmnts" name="hdn_cmnts" value="<?php echo $leaddetails['0']['comments']; ?>">
								<input type="hidden" id="hdn_status_id" name="hdn_status_id" value="<?php echo $leaddetails['0']['leadstatusid']; ?>">
								<input type="hidden" id="hdn_assign_to" name="hdn_assign_to" value="<?php echo $leaddetails['0']['assignleadchk']; ?>">
								<input type="hidden" id="hdn_sub_status_id" name="hdn_sub_status_id" value="<?php echo $leaddetails['0']['ldsubstatus']; ?>">


								</td>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Designation </label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
											<input type="text" name="designation" id="designation" value="<?php echo $leaddetails['0']['designation']; ?>" maxlength="80"  /> 
											
										</span>
									</div>
								</td>
							</tr>
<!--  -->
							<tr>
						<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Comments</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
											<textarea name="comments" id="comments"><?php echo trim($leaddetails['0']['comments']);?></textarea>
										</span>
									</div>
								<input type="hidden" id="hdn_cmnts" name="hdn_cmnts" value="<?php echo $leaddetails['0']['comments']; ?>">
								</td>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Website</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
											<input type="text" name="website" id="website" value="<?php echo set_value('website',$leaddetails['0']['website']); ?>" size="25" /> 
												<?php echo form_error('website');   ?>       
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<td class="fieldValue narrowWidthType">
									<label class="muted pull-right marginRight10px">Credit Assesment</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
										<?php   
										 echo form_dropdown('credit_assesment', $optionscrd, set_value('credit_assesment', (isset($leaddetails['0']['crd_id'])) ? $leaddetails['0']['crd_id'] : ''), 'id="credit_assesment"','name="credit_assesment"');      
							    			echo form_error('credit_assesment');   ?> 
											
										</span>
									</div>
								</td>

								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Branch</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
												<?php  echo form_dropdown('branch', $optionslocuser, set_value('branch',(isset($leaddetails['0']['user_branch'])) ? $leaddetails['0']['user_branch'] : ''),'id="branch"','name="branch"');  	echo form_error('branch'); ?>
										</span>
									</div>
								</td>
							</tr>

							<tr>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Email Address</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
									  <span class="span10">
										<input  type="text" name="email_id" id="email_id" value="<?php echo set_value('email_id',$leaddetails['0']['email_id']); ?>" size="25" />
<?php echo form_error('email');   ?>           
									</span>
									</div>
								</td>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Assigned To</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
											<?php   
			 echo form_dropdown('assignedto', $optionsasto, set_value('assignedto', (isset($leaddetails['0']['assignleadchk'])) ? $leaddetails['0']['assignleadchk'] : ''),'id="assignedto"','name="assignedto"');      
    			echo form_error('assignedto');   ?>  
											
										</span>
									</div>
								</td>
								</tr>
							 <tr>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">First Name((Lead Contact))</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
											<input type="text" name="firstname" id="firstname" value="<?php echo set_value('firstname',$leaddetails['0']['firstname']); ?>" size="25" /> 
												<?php echo form_error('lastname');   ?>       
										</span>
									</div>
								</td>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Last Name (Lead Contact)</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
											<input type="text" name="lastname" id="lastname" value="<?php echo set_value('lastname',$leaddetails['0']['lastname']); ?>" size="25" /> 
												<?php echo form_error('lastname');   ?>       
										</span>
									</div>
								</td>
							</tr>
								</tbody>
							</table>
							<table class="table table-bordered blockContainer showInlineTable">
								<tbody>
									<tr>
										<th colspan="4" class="blockHeader">Address Details</th>
									</tr>
									<tr>
										<td class="fieldLabel narrowWidthType">
											<label class="muted pull-right marginRight10px">Country</label>
										</td>
										<td class="fieldValue narrowWidthType">
											<div class="row-fluid">
												<span class="span10">
											<?php   
			 echo form_dropdown('country', $optionscnt, set_value('country', (isset($leaddetails['0']['country'])) ? $leaddetails['0']['country'] : ''), 'id="country"','name="country"');      
    			echo form_error('country');   ?> 
												</span>
											</div>
										</td>
										<td class="fieldLabel narrowWidthType">
											<label class="muted pull-right marginRight10px">PO Box</label>
										</td>
										<td class="fieldValue narrowWidthType">
											<div class="row-fluid">
												<span class="span10">
														<input type="text" name="postalcode" id="postalcode" value="<?php echo set_value('pobox',$leaddetails['0']['pobox']); ?>" size="25" /> 
<?php echo form_error('postalcode');   ?>                
												</span>
											</div>
										</td>
									</tr>
									<tr>
										<td class="fieldLabel narrowWidthType">
											<label class="muted pull-right marginRight10px">State</label>
										</td>
										<td class="fieldValue narrowWidthType">
											<div class="row-fluid">
												<span class="span10">
													<?php   
			 echo form_dropdown('state', $optionsst, set_value('state', (isset($leaddetails['0']['state'])) ? $leaddetails['0']['state'] : ''), 'id="state"','name="state"');    
				echo form_error('state');   ?>       
												</span>
											</div>
										</td>
										<td class="fieldLabel narrowWidthType">
											<label class="muted pull-right marginRight10px">Phone</label>
										</td>
										<td class="fieldValue narrowWidthType">
											<div class="row-fluid">
												<span class="span10">
													<input  type="text" name="phone" id="phone" value="<?php echo set_value('phone',$leaddetails['0']['phone']); ?>" size="25" />
<?php echo form_error('phone');   ?>               
												</span>
											</div>
										</td>
									</tr>
									<tr>
										<td class="fieldLabel narrowWidthType">
											<label class="muted pull-right marginRight10px">City</label>
										</td>
										<td class="fieldValue narrowWidthType">
											<div class="row-fluid">
												<span class="span10">
													<?php   
			 echo form_dropdown('city', $optionsct, set_value('city', (isset($leaddetails['0']['city'])) ? $leaddetails['0']['city'] : ''), 'id="city"','name="city"');    
				echo form_error('city');   ?>   
												</span>
											</div>
										</td>
										<td class="fieldLabel narrowWidthType">
											<label class="muted pull-right marginRight10px">Mobile</label>
										</td>
										<td class="fieldValue narrowWidthType">
											<div class="row-fluid">
												<span class="span10">
														<input  type="text" name="mobile_no" id="mobile_no" value="<?php echo set_value('mobile_no',$leaddetails['0']['mobile_no']); ?>" size="25" />
<?php echo form_error('mobile');   ?>               
												</span>
											</div>
										</td>
									</tr>
									<tr>
										<td class="fieldLabel narrowWidthType">
											<label class="muted pull-right marginRight10px">Street Address</label>
										</td>
										<td class="fieldValue narrowWidthType">
											<div class="row-fluid">
												<span class="span10">
													<input type="text" name="street" id="street" value="<?php echo set_value('street',$leaddetails['0']['street']); ?>" size="25" />
<?php echo form_error('street');   ?>           
												</span>
											</div>
										</td>
										<td class="fieldLabel narrowWidthType">
											<label class="muted pull-right marginRight10px">Fax</label>
										</td>
										<td class="fieldValue narrowWidthType">
											<div class="row-fluid">
												<span class="span10">
												<input  type="text" name="fax" id="fax" value="<?php echo set_value('fax',$leaddetails['0']['fax']); ?>" size="25" />
<?php echo form_error('phone');   ?>          
												</span>
											</div>
										</td>
									</tr>
								     </tbody>
								</table>
								<table class="table table-bordered blockContainer showInlineTable">
									<tbody>
										<tr>
											<th colspan="4" class="blockHeader">Description Details</th>
										</tr>
										<tr>
											<td class="fieldLabel narrowWidthType">
												<label class="muted pull-right marginRight10px">Description</label>
											</td>
											<td colspan="3" class="fieldValue narrowWidthType">
												<div class="row-fluid">
													<span class="span10">
														<textarea name="description" id="description"><?php echo trim($leaddetails['0']['description']);?></textarea>
													</span>
												</div>
											<input type="hidden" id="hdn_desc" name="hdn_desc" value="<?php echo $leaddetails['0']['description']; ?>">
											</td>
										</tr>
									</tbody>
								</table>
								
								<table style="width=100%; height: 100%;">
									
									<tr valign="top">
											<td><label for="customFieldName">Product Name</label></td>
											<td style="width=27%">
											  <?php echo form_dropdown('customFieldName[]', $optionsproedit, set_value('customFieldName[]', (isset($leadproducts[0]['description'])) ?  $leadproducts[0]['productid'] : ''),'id="customFieldName"','name="customFieldName[]"','style="width:100px;"');      
								    			echo form_error('customFieldName');?> &nbsp;
											  &nbsp;
											   &nbsp;&nbsp;<b>Quantity</b>&nbsp; <input type="text"  id="customFieldValue" name="customFieldValue[]" class="code1" value="<?php echo $leadproducts[0]['quantity'];?>" size="8" /> &nbsp;in MT &nbsp;&nbsp;
											
											   
											</td>
										</tr>
								<?php 
								 foreach($leadproducts as $products)
									 {
								?> 
										
										<tr>	
											<td style="width=20%"> <b>Type</b></td>
											<td style="width=27%"> 
											 <?php echo form_dropdown('customDispatch[]', $optionsprotypeedit, set_value('customDispatch[]', (isset($products['prod_type_id'])) ? $products['prod_type_id'] : ''),'id="customDispatch"','name="customDispatch[]"','style="width:100px;"');      
								    			echo form_error('customDispatch');?> 

											 &nbsp;</td>
										<td style="width=20%"> <b>Potential</b></td>
											<td style="width=27%"> 	 
												   <input type="hidden" id="leadprodid" name="leadprodid[]" value="<?php echo $products['lpid'];?>"/>
											   <input type="text" class="code1" id="customFieldPoten" name="customFieldPoten[]" value="<?php echo $products['potential'];?>" size="8" /> &nbsp;in MT &nbsp;
									</tr>

								<?php

									 }
								?>
							

								</table>
								</div>
								<div><?php $atts = array(
											              'width'      => '760',
											              'height'     => '350',
											              'scrollbars' => 'yes',
											              'status'     => 'yes',
											              'resizable'  => 'yes',
											              'screenx'    => '0',
											              'screeny'    => '0'
											            ); ?> 
								</div>
								<?php // echo anchor_popup('product/addnewproduct/'.$leaddetails['0']['leadid'], 'Add More Products', $atts); ?>
								<div class="pull-right">
									<input class="submit" id="updatelead" name="updatelead" type="submit" value="Update" />
									<a onclick="javascript:window.history.back();" type="reset" class="cancelLink">Cancel</a>
								</div>
								<div class="clearfix">
								</div>
							</div>
							</form>
						
<!-- close lead start  -->					

							<div id="closelead_win" style="display: none">
					                <div id="windowHeader">
					                       <form action="<?= base_url()?>leads/colselead/<?php echo $leaddetails['0']['leadid'];?>" method="post" name="closeleadform" id="closeleadform" >
					                       <div name="closeleadoptions"  id="closeleadoptions"></div>
					        			Your Comments :<p>
					        			 <textarea name="closingcomments" class="row-fluid " id="closingcomments"></textarea>
					        			 <input style='margin-top: 20px;' type="submit" value="Submit" id='jqxSubmitButton' />
					        			  <input type="hidden" id="hdn_closename" name="hdn_closename">
									<?php echo form_error('closingcomments'); ?> 
					        			  </form>
				                </div>
					               
					           </div>  
<!-- close lead end  -->						
						
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" value="60" class="hide noprint" id="activityReminder">
		<div class="feedback noprint" id="userfeedback">
			<a class="handle" onclick="javascript:window.open('<?= base_url()?>product/feedback','feedbackwin','height=400,width=550,top=200,left=300')" href="javascript:;">Feedback</a>
		</div>
		<footer class="noprint">
			<p align="center" style="margin-top:5px;margin-bottom:0;">Powered by Pure-Chemicals<a target="_blank" href="#">pure-chemicals.com</a></p></footer>

	<script src="<?= base_url()?>public/html5shim/html5.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-alert.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-tooltip.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-tab.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-collapse.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-modal.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-dropdown.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-popover.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/js/bootbox.js"></script>
			
	
	<!-- Added in the end since it should be after less file loaded -->
	<script src="<?= base_url()?>public/bootstrap/js/less.min.js" type="text/javascript"></script>
	

			
	
	<!-- Added in the end since it should be after less file loaded -->

</div></body></html>
