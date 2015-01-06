<?php $this->load->view('header');?>
<!-- jqwidgets scripts -->
	<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.base.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.energyblue.css" type="text/css" />

    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/scripts/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxcore.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxbuttons.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxscrollbar.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxmenu.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxdata.js"></script> 
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxwindow.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/scripts/gettheme.js"></script>
		
  
  <script type="text/javascript" src="<?=base_url()?>public/jqwidgets/jqxdatetimeinput.js"></script>
  <script type="text/javascript" src="<?=base_url()?>public/jqwidgets/jqxcalendar.js"></script>
  <script type="text/javascript" src="<?=base_url()?>public/jqwidgets/globalization/globalize.js"></script>


  	<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>
	<script src="<?=base_url()?>public/js/additional-methods.js"></script>
	<script src="<?=base_url()?>public/js/validation_rules.js"></script> 
	 <!-- sorting and filtering - start -->
			
	 <!-- sorting and filtering and export excel - end -->
	<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.black.css" type="text/css" />
<!-- End of jqwidgets -->
<!-- end of Menu includes -->
<script type="text/javascript">
var controller = 'leads';
var base_url = '<?php echo site_url(); ?>';
 function openpopupwindow(obj)
{
 		var id = obj.id;
    window.open(base_url+'product/selectproductfordc/'+id,'_blank', 'width=600,height=500,scrollbars=yes,status=yes,resizable=yes,screenx=300,screeny=100,addressbar=no');

}
$(document).ready(function()
{
//	alert(" base_url "+base_url);
	var theme = "";
	// Create a jqxMenu
	$("#jqxMenu").jqxMenu({ width: '670', height: '30px', theme: 'black' });
	$("#jqxMenu").css('visibility', 'visible');

	var j=0;
	var count = 0;
	
	$.getJSON(base_url+"leads/getdispatch", 
	{
		tags: "dispatch",
		tagmode: "any",
		format: "json"
	}) 
	.done(function(data)
	{
		$.each(data, function(index, text) 
		{
			$('#customDispatch').append(
				$('<option></option>').val(text.n_value_id).html(text.n_value)
			);
		});
	});

	$.getJSON( base_url+"leads/getinitial_lead_sub", 
	{
		tags: "lead sub",
		tagmode: "any",
		format: "json"
	}) 
	.done(function(data)
	{
		$.each(data, function(index, text) 
		{
			$('#leadsubstatus').append(
				$('<option></option>').val(text.lst_sub_id).html(text.lst_name)
			);
		});
	});
	var i = 1;

	$("#addCF").on("click",function()
	{
		
		var $tableBody = $('#customFields').find("tbody");
		var $tablehdnBody = $('#customhndFields').find("tbody"),
		$trLast = $tableBody.find("tr:last"),
		$trhdnLast = $tablehdnBody.find("tr:last"),

		
		$trNew = $trLast.clone(true).appendTo("#customFields").find(".myClass").each(function() 
		{
			$(this).attr({
				      'id': function(_, id) { return 'customFieldName' + i }
			    	    });
	
		}).end();
		$trproid = $trhdnLast.clone(true).appendTo("#customhndFields").find(".myhdnClass").each(function() 
		{
			$(this).attr({
				      'id': function(_, id) { return 'hdncustomFieldName' + i }
			    	    });
	
		}).end();


  		
	 $trLast.after($trNew);
	 $trhdnLast.after($trproid);
   	$trNew.find(':text').val('');
	i++;
	count++;

	$('#counter').html(count);

	});



	$('#remCFF').on("click", function()
	{
		$('#counter').html(count);
		if(count>0)
		{
			$('#customFields tr:last').remove();
		} 
		else
		{
			alert("You are not allowed to remove.!");
		}
		count--
	});


	$('#leadstatus').change(function()
	{ 
		$("#leadsubstatus > option").remove(); 
		var option = $('#leadstatus').val();  
		 if(option == '#')
			{
				return false; 
			}

		$.ajax({
			type: "POST",
			url: base_url+"leads/getleadsubstatusadd/"+option, 
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

/**/
					$('#presentsource').change(function(){ 
					
								
								var option = $('#presentsource').val();  // here we are taking option id of the selected one.
								
								 if(option=="Domestic and Import" || option=="Domestic") 
									{
										$('#contentsuplier').show();
										$('#txtDomesticSource').show();
										//popup code
									
									}
									 else	
								   	 {
								  		$('#txtDomesticSource').hide();
								  		$('#contentsuplier').hide();contentsuplier
								      }
		});	
/**/
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
					url: base_url+"leads/getassignedtobranch/"+option, 
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



	$('#country').change(function()
	{ 
		$("#state > option").remove(); 
		var option = $('#country').val();  
		if(option == '#')
		{
			return false; 
		}
		$.ajax({
			type: "POST",
			url: base_url+"leads/getstates/"+option, 
				success: function(suboptions)
				{
					$.each(suboptions,function(id,value) 
					{
						var opt = $('<option />'); 
						opt.val(id);
						opt.text(value);
					$('#state').append(opt); 
					});
				}
			});

	});

	$('#state').change(function()
	{ 
		$("#city > option").remove(); 
		var option = $('#state').val();  
		if(option == '#'){
			return false; 
		}

		$.ajax({
			type: "POST",
			url: base_url+"leads/getcities/"+option, 				 
				success: function(suboptions) 
				{
					$.each(suboptions,function(id,value) 
					{
						var opt = $('<option/>'); 
						opt.val(id);
						opt.text(value);
						$('#city').append(opt); 
					});
				}

			});

	});

	    

});
 $(document).ready(function () {
                var theme = "";
                // Create a jqxDateTimeInput
                $("#uploaded_date").jqxDateTimeInput({width: '170px', height: '25px' });
            });
</script>
			<input type="hidden" name="module" id="module" value="Leads"><input type="hidden" name="parent" id="parent" value=""><input type="hidden" name="view" id="view" value="Edit">

			<div class="navbar commonActionsContainer noprint">
				<div class="actionsContainer row-fluid" style="position: relative; top: 5px; left: 5.5px;">
					<div class="span2">
						<span class="companyLogo"><img alt="logo.png" title="logo.png" src="<?=base_url()?>public/images/logo.png">&nbsp;</span>
					</div>
					
</div></div></div></div></div></div></div>
			<div class="bodyContents" style="min-height: 448px;">
				<div class="mainContainer row-fluid">
					<div class="span2 row-fluid">
						<div class="row-fluid"><div class="sideBarContents"><div class="quickLinksDiv"><p class="unSelectedQuickLink" id="Leads_sideBar_link_LBL_RECORDS_LIST" onclick="#"><a href="<?= base_url()?>leads" class="quickLinks"><strong>Leads List</strong></a></p><p class="unSelectedQuickLink" id="Leads_sideBar_link_LBL_DASHBOARD" onclick="#"><a href="#" class="quickLinks"><strong>Dashboard</strong></a></p></div><div class="clearfix"></div><div class="quickWidgetContainer accordion"><div class="quickWidget"><div data-widget-url="module=Leads&amp;view=IndexAjax&amp;mode=showActiveRecords" data-label="LBL_RECENTLY_MODIFIED" data-parent="#quickWidgets" data-toggle="collapse" data-target="#Leads_sideBar_LBL_RECENTLY_MODIFIED" class="accordion-heading accordion-toggle quickWidgetHeader"><span class="pull-left"><img src="<?= base_url()?>public/skins/images/rightArrowWhite.png" data-downimage="<?= base_url()?>public/skins/images/downArrowWhite.png" data-rightimage="<?= base_url()?>public/skins/images/rightArrowWhite.png" class="imageElement"></span><h5 title="Recently Modified" class="title widgetTextOverflowEllipsis pull-right">Recently Modified</h5><div class="loadingImg hide pull-right"><div class="loadingWidgetMsg"><strong>Loading Widget</strong></div></div><div class="clearfix"></div></div><div data-url="module=Leads&amp;view=IndexAjax&amp;mode=showActiveRecords" id="Leads_sideBar_LBL_RECENTLY_MODIFIED" class="widgetContainer accordion-body collapse"></div></div></div></div></div>
					</div>
					<div class="contentsDiv span10 marginLeftZero">

			<div class="editViewContainer">
				<form action="<?= base_url()?>leads/saveleaddailycall" method="post" name="leadform" id="leadform" class="form-horizontal recordEditView">
					<input type="hidden" value="[]" name="picklistDependency">
					<input type="hidden" value="Leads" name="module">
					<input type="hidden" value="Save" name="action">
					<input type="hidden" value="" name="record">
					<input type="hidden" value="5" name="defaultCallDuration">
					<input type="hidden" value="5" name="defaultOtherEventDuration">
					<div class="contentHeader row-fluid">
						<span class="span8 font-x-x-large textOverflowEllipsis">Add Products For Daily Call</span>
						<span class="pull-right">
							<input class="submit" id="saveleads" name="saveleads" type="submit" value="Submit" />
							<a onclick="javascript:window.history.back();" type="reset" class="cancelLink">Cancel</a>
						</span>
					</div>
					<!-- Start -->
<?php

													$selattrs = array(
												              'width'      => '750',
												              'height'     => '300',
												              'scrollbars' => 'yes',
												              'status'     => 'yes',
												              'resizable'  => 'yes',
												              'screenx'    => '0',
												              'screeny'    => '0',
																			'id'				=>'selid0',
																			'class'		  =>'mySelClass'
);

 ?>

								<table class="table table-bordered blockContainer showInlineTable">	
								<tbody>
									<tr>
										<th colspan="5" class="blockHeader">Product Details 
								<span class="addremove"><a href="javascript:void(0);" id="addCF">AddRow</a>&nbsp; 
									<a href="javascript:void(0);" id="remCFF">Remove</a>
								</span>
								<span>&nbsp;&nbsp;<?php 	echo form_error('product'); echo anchor_popup('product/addnewitem/'.$this->session->userdata['user_id'], 'Add New Products', $selattrs);  ?>
							              </span> </th>
									</tr>
									<tr>
										<td class="fieldLabel narrowWidthType" colspan="5">
											<table border="0" name="customFields" id="customFields" style="width=100%; height: 100%;">
											<tbody>
											<tr valign="top" id="customFieldsrow" name="customFieldsrow[]">
											<td width=""><label for="product">Select Product<font color="red"> *</font></label></td>
											<td width="30%">
											   <input class="myClass" readonly="true" type="text" id="customFieldName0" alt="Double click to select products" name="customFieldName[]" title="Double click to select products"  ondblclick="openpopupwindow(this);" value=""><b>Present Requirement</b>&nbsp;<input type="text" class="code1" id="customFieldValue" name="customFieldValue[]" value="0" alt="Enter Quantity" size="5" placeholder="Enter Qnty" title="Enter Quantity" /> in MT/ Mon&nbsp;<br><b>Monthly Potential</b>&nbsp;<input type="text" class="code1" id="customFieldPoten" name="customFieldPoten[]" value="0" size="5" placeholder="Enter Poten" alt="Enter Potential" title="Enter Potential" /> in MT/ Mon &nbsp;</td><td width="20%"><label for="producttype"><b>Type</b></label></td>
											<td width=""><select id="customDispatch" name="customDispatch[]"></select></td>
											</tr>
											</tbody>
										</table>Number of rows: <span id="counter"></span>
										</td>
										
									</tr>
								     </tbody>
								</table>
<!-- End -->
<!-- hidden table start -->
										<table border="0" name="customhndFields" id="customhndFields" style="width=100%; height: 100%; display:block;">
											<tbody>
											<tr valign="top" id="customFieldsrow" name="customFieldsrow[]">
											<td width="30%">
											   <input class="myhdnClass" type="hidden"  id="hdncustomFieldName0" name="hdncustomFieldName[]"></td>
											<td width=""></td>
											</tr>
											</tbody>
										</table>
										</td>
										
									</tr>
								     </tbody>
								</table>
<!-- hidden table end -->

								
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
											 echo form_dropdown('company', $optionscmp, set_value('company', (isset($customerinfo['0']['company'])) ? $customerinfo['0']['company'] : ''), 'id="company"','name="company"');      
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
										echo form_dropdown('industry', $optionsinds, set_value('industry', (isset($customerinfo['0']['industry_id'])) ? $customerinfo['0']['industry_id'] : ''),'id="industry"','name="industry"');   
							    			echo form_error('industry');  ?>         
									</span>
									</div>
								</td>
							</tr>
							<!--  -->
							<tr>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Customer Finished Goods / End Products</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
									
											<textarea name="producttype" class="row-fluid " id="producttype"></textarea>
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
												echo form_dropdown('exportdomestic', $optionsexp,'', 'id="exportdomestic"','name="exportdomestic"');      
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
											<input type="text" name="purchasedecision" id="purchasedecision" value="" maxlength="40"  /> 
										</span>
									</div>
								</td>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Present Procurement / Purchase source </label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
											<?php   
											echo form_dropdown('presentsource', $optionsprestsrc,'', 'id="presentsource"','name="presentsource"');
											echo form_error('presentsource'); ?>  
			
										</span>
									</div>
<!-- Start -->
 <div id='contentsuplier' style="display: none">
        <div>
        		<font color="blue">Enter the Name of the Supplier</font><input type="text" name="txtDomesticSource" id="txtDomesticSource" style="display: none"  placeholder="Name of the Supplier">
        </div>
        
    </div>
    <!-- End -->
								</td>
							</tr>
							<!--  -->
							<tr>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Lead Status<font color="red"> *</font></label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
										<?php  echo form_dropdown('leadstatus', $optionslst,'', 'id="leadstatus"','name="leadstatus"');  	echo form_error('leadstatus'); ?>
										</span>
									</div>
								</td>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Sub Status <font color="red"> *</font></label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
											<select name="leadsubstatus" id="leadsubstatus"><option value="">-Select Substatus--</option></select>
    										<?php	echo form_error('leadsubstatus');   ?>      
											
										</span>
									</div>
								</td>
							</tr>
							<tr>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Lead Source <font color="red"> *</font></label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
											<?php   
						 					echo form_dropdown('leadsource', $optionslsr, 'id="leadsource"','name="leadsource"');      
			    							echo form_error('leadsource'); ?>  
											
										</span>
									</div>
								</td>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Uploaded Date <font color="red"> *</font><br></label>
								</td>
								<td class="fieldValue narrowWidthType"><font size="1" color="red">This field is mandatory!</font>
									<div id="uploaded_date" class="row-fluid">
										<span class="span10">
												<input type="text" name="uploaded_date" id="uploaded_date"  value="">
																
											
										</span>
									</div>

								</td>
							</tr>	
							<tr>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Lead Comments </label>
								</td>
								<td class="fieldValue narrowWidthType">
								 <div class="row-fluid">
										<span class="span10">
												<textarea name="comments" class="row-fluid " id="comments"></textarea>
										</span>
									</div>
								</td>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Website</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
											<input type="text" name="website" id="website" value="" placeholder="http://www.pure-chemical.com" /> 
										</span>
									</div>
								</td>
							</tr>

							<tr>
								<td class="fieldLabel narrowWidthType">
									
								<td class="fieldValue narrowWidthType">
								 <div class="row-fluid">
										<span class="span10">
												
										</span>
									</div>
								</td>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Branch</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
												<?php  echo form_dropdown('branch', $optionslocuser, set_value('branch',(isset($customerinfo['0']['user_branch'])) ? $customerinfo['0']['user_branch'] : ''),'id="branch"','name="branch"');  	echo form_error('branch'); ?>
										</span>
									</div>
								</td>
							</tr>
						
							<tr>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Email Address </label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
									  <span class="span10">
										<input  type="text" name="email_id" id="email_id" value="" size="25" />
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
											 echo form_dropdown('assignedto', $optionsasto, set_value('assignedto', (isset($customerinfo['0']['assignleadchk'])) ? $customerinfo['0']['assignleadchk'] : ''),'id="assignedto"','name="assignedto"'); echo form_error('assignedto');   ?>  
											
										</span>
									</div>
								</td>
								</tr>
								<tr>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">First Name(Lead Contact)</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
											<input type="text" name="firstname" id="firstname" value="" maxlength="40"  /> 
										</span>
									</div>
								</td>
							<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Last Name(Lead Contact)</label>
								</td>
								<td class="fieldValue narrowWidthType">
									<div class="row-fluid">
										<span class="span10">
											<input type="text" name="lastname" id="lastname" value="" maxlength="80" /> 
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
											 echo form_dropdown('country', $optionscnt, set_value('country', (isset($customerinfo['0']['country'])) ? $customerinfo['0']['country'] : ''), 'id="country"','name="country"'); echo form_error('country');   ?> 
												</span>
											</div>
										</td>

										<td class="fieldLabel narrowWidthType">
											<label class="muted pull-right marginRight10px">State</label>
										</td>
										<td class="fieldValue narrowWidthType">
											<div class="row-fluid">
												<span class="span10">
													<?php   
			 											echo form_dropdown('state', $optionsst, set_value('state', (isset($customerinfo['0']['state'])) ? $customerinfo['0']['state'] : ''), 'id="state"','name="state"'); echo form_error('state');   ?>       
												</span>
											</div>
										</td>

									
									</tr>
									<tr>

										<td class="fieldLabel narrowWidthType">
											<label class="muted pull-right marginRight10px">City </label>
										</td>
										<td class="fieldValue narrowWidthType">
											<div class="row-fluid">
												<span class="span10">
													<?php   
			 echo form_dropdown('city', $optionsct, set_value('city', (isset($customerinfo['0']['city'])) ? $customerinfo['0']['city'] : ''), 'id="city"','name="city"');    
				echo form_error('city');   ?>   
												</span>
											</div>
										</td>

										<td class="fieldLabel narrowWidthType">
											<label class="muted pull-right marginRight10px">PO Box</label>
										</td>
										<td class="fieldValue narrowWidthType">
											<div class="row-fluid">
												<span class="span10">
													<input type="text" name="postalcode" id="postalcode" value="" size="25" /> 
													<?php echo form_error('postalcode');   ?>           
												</span>
											</div>
										</td>
											
									
									</tr>
									
									<tr>
										<td class="fieldLabel narrowWidthType">
											<label class="muted pull-right marginRight10px">Street Address </label>
										</td>
										<td class="fieldValue narrowWidthType">
											<div class="row-fluid">
												<span class="span10">
													<textarea rows="3" cols="40" name="street" id="street"/></textarea>
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
												<input  type="text" name="fax" id="fax" maxlength="14" value="" placeholder="+9144-26161813" />
													<?php echo form_error('fax');   ?>           
												</span>
											</div>
										</td>
									</tr>
									<tr>
									
										<td class="fieldLabel narrowWidthType">
											<label class="muted pull-right marginRight10px">Mobile </font></label>
										</td>
										<td class="fieldValue narrowWidthType">
											<div class="row-fluid">
												<span class="span10">
													<input  type="text" name="mobile" id="mobile" value=""  placeholder="+919840012345"  />
													<?php echo form_error('mobile');   ?>           
												</span>
											</div>
										</td>
										<td class="fieldLabel narrowWidthType">
											<label class="muted pull-right marginRight10px">Phone</label>
										</td>
										<td class="fieldValue narrowWidthType">
											<div class="row-fluid">
												<span class="span10">
													<input type="text" name="phone" id="phone" value="" size="25"  placeholder="044-12345678" /> 
													<?php echo form_error('phone');  ?>           
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
														<textarea name="description" class="row-fluid " id="description"></textarea>
													</span>
												</div>
											</td>
										</tr>
									</tbody>
								</table>




							
							
							
							
								<div class="pull-right">
									<input class="submit" id="saveleads" name="saveleads" type="submit" value="Submit" />
									<a onclick="javascript:window.history.back();" type="reset" class="cancelLink">Cancel</a>
									<input type="hidden" id="hdn_refferer"  name="hdn_refferer" value="<?php echo $reffer_page;?>">
									<input type="hidden" id="hdncustomer_id"  name="hdncustomer_id" value="<?php echo $customerinfo['0']['company'];?>">
									<input type="hidden" id="from_leadpage"  name="from_leadpage" value="1">
								</div>
								<div class="clearfix">
								</div>
							</div>
						</form>
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
	<script src="<?= base_url()?>public/jquery/select2/select2.min.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/jquery/jquery.class.min.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/jquery/defunkt-jquery-pjax/jquery.pjax.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/jquery/jstorage.min.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/jquery/autosize/jquery.autosize-min.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/jquery/rochal-jQuery-slimScroll/slimScroll.min.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/jquery/pnotify/jquery.pnotify.min.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/jquery/jquery.hoverIntent.minified.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/bootstrap/js/bootstrap-alert.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/bootstrap/js/bootstrap-tooltip.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/bootstrap/js/bootstrap-tab.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/bootstrap/js/bootstrap-collapse.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/bootstrap/js/bootstrap-modal.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/bootstrap/js/bootstrap-dropdown.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/bootstrap/js/bootstrap-popover.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/bootstrap/js/bootbox.min.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/jquery/jquery.additions.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/jquery/helper.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/jquery/Connector.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/jquery/posabsolute-jQuery-Validation-Engine/js/jquery.validationEngine.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/jquery/posabsolute-jQuery-Validation-Engine/js/jquery.validationEngine-en.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/guidersjs/guiders-1.2.6.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/jquery/datepicker/js/datepicker.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/jquery/dangrossman-bootstrap-daterangepicker/date.js" type="text/javascript"></script>
	<script src="<?= base_url()?>public/jquery/jquery.ba-outside-events.min.js" type="text/javascript"></script>

			<script src="<?= base_url()?>public/bootstrap/js/eternicode-bootstrap-datepicker/js/bootstrap-datepicker.js?&amp;v=6.0.0Beta" type="text/javascript"></script>
			<script src="<?= base_url()?>public/jquery/timepicker/jquery.timepicker.min.js?&amp;v=6.0.0Beta" type="text/javascript"></script>
			<script src="<?= base_url()?>public/resources/Edit.js?&amp;v=6.0.0Beta" type="text/javascript"></script>
			<script src="<?= base_url()?>public/validator/Field.js?&amp;v=6.0.0Beta" type="text/javascript"></script>
			<script src="<?= base_url()?>public/validator/BaseValidator.js?&amp;v=6.0.0Beta" type="text/javascript"></script>
			<script src="<?= base_url()?>public/validator/FieldValidator.js?&amp;v=6.0.0Beta" type="text/javascript"></script>
			<script src="<?= base_url()?>public/jquery/jquery_windowmsg.js?&amp;v=6.0.0Beta" type="text/javascript"></script>
			<script src="<?= base_url()?>public/resources/BasicSearch.js?&amp;v=6.0.0Beta" type="text/javascript"></script>
			<script src="<?= base_url()?>public/resources/AdvanceFilter.js?&amp;v=6.0.0Beta" type="text/javascript"></script>
			<script src="<?= base_url()?>public/resources/SearchAdvanceFilter.js?&amp;v=6.0.0Beta" type="text/javascript"></script>
			<script src="<?= base_url()?>public/resources/AdvanceSearch.js?&amp;v=6.0.0Beta" type="text/javascript"></script>
	
	<!-- Added in the end since it should be after less file loaded -->
	<script src="<?= base_url()?>public/bootstrap/js/less.min.js" type="text/javascript"></script>
	

			
	
	<!-- Added in the end since it should be after less file loaded -->

</div></body></html>
