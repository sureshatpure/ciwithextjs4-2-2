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
      <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxwindow.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/scripts/gettheme.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.edit.js"></script>
    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxinput.js"></script>


    	 <!-- sorting and filtering - start -->
	<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.sort.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.filter.js"></script>
	<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.selection.js"></script> 
	<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxpanel.js"></script>
	
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
<!-- End of jqwidgets -->
  	<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>
	<script src="<?=base_url()?>public/js/additional-methods.js"></script>
	<script src="<?=base_url()?>public/js/validation_rules.js"></script> 
	<!-- end of Menu includes -->
	<script type="text/javascript">
	function openpopup(id)
		{
			// alert("company id passed is "+id);
			$('#jqxsoc').jqxWindow('open');
			$("#jqxsoc").jqxWindow({ width: 600, height: 220,isModal: true,title:"Select the SOC"});
		
		}
	  var base_url = '<?php echo site_url();?>index.php';
	$(document).ready(function(){

		/* Close lead start*/
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
          		
          		
          		
 			var source_closelead = ["Credit Not Worthy","Is a Trader",	"Product Not dealt by us"];
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
                     $('#closelead_win').jqxWindow('close');
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
		var theme = "";
            // Create a jqxMenu
            $("#jqxMenu").jqxMenu({ width: '670', height: '30px', theme: 'black' });
            $("#jqxMenu").css('visibility', 'visible');


		var leadata = <?php echo $data; ?>;

		 		var source =
		            {	
		                localdata: leadata,
		                datatype: "array",
		                datafields:
		                [
						{ name: 'crm_soc_no' },
						{ name: 'customer_id'},
						{ name: 'itemdesc'},
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
           
             width: 700,
              height:500,
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
              { text: 'Customer Name', datafield: 'customer_name',  cellsalign: 'left',width:200 },
              { text: 'Product Name', datafield: 'itemdesc',  cellsalign: 'left',width:200 },
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


	$('#leadstatus').change(function(){ //any select change on the dropdown with id options trigger this code

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
																url: base_url+"/leads/getleadsubstatus/"+option, //here we are calling our dropdown controller and getsuboptions method passing the option
								 
																success: function(suboptions) //we're calling the response json array 'suboptions'
																{
																    $.each(suboptions,function(id,value) //here we're doing a foeach loop round each sub option with id as the key and value as the value
																    {
																        var opt = $('<option />'); // here we're creating a new select option for each suboption
																        opt.val(id);
																        opt.text(value);
																        $('#leadsubstatus').append(opt); //here we will append these new select options to a dropdown with the id 'suboptions'
																    });
																}
								 
														});
								 
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
						<div class="row-fluid">
<div class="sideBarContents">
<div class="quickLinksDiv">
<p class="selectedQuickLink" id="Leads_sideBar_link_LBL_DASHBOARD" onclick="#">
<a href="#" class="quickLinks"><strong>Status Update</strong></a>
</p>
<p class="unSelectedQuickLink" id="Leads_sideBar_link_LBL_RECORDS_LIST" onclick="<?=base_url()?>leads">
<a href="<?=base_url()?>leads"><strong>Leads List</strong></a>
</p>

</div>
<div class="clearfix">
</div>
<div class="quickWidgetContainer accordion"><div class="quickWidget"><div data-widget-url="module=Leads&amp;view=IndexAjax&amp;mode=showActiveRecords" data-label="LBL_RECENTLY_MODIFIED" data-parent="#quickWidgets" data-toggle="collapse" data-target="#Leads_sideBar_LBL_RECENTLY_MODIFIED" class="accordion-heading accordion-toggle quickWidgetHeader"><span class="pull-left"><img src="<?= base_url()?>public/skins/images/rightArrowWhite.png" data-downimage="<?= base_url()?>public/skins/images/downArrowWhite.png" data-rightimage="<?= base_url()?>public/skins/images/rightArrowWhite.png" class="imageElement"></span><h5 title="Recently Modified" class="title widgetTextOverflowEllipsis pull-right">Recently Modified</h5><div class="loadingImg hide pull-right"><div class="loadingWidgetMsg"><strong>Loading Widget</strong></div></div><div class="clearfix"></div></div><div data-url="module=Leads&amp;view=IndexAjax&amp;mode=showActiveRecords" id="Leads_sideBar_LBL_RECENTLY_MODIFIED" class="widgetContainer accordion-body collapse"></div></div></div></div></div>
					</div>
					<div class="contentsDiv span10 marginLeftZero">

			<div class="editViewContainer">
				<form action="<?= base_url()?>leads/updateleadstatus/<?php echo $leaddetails['0']['leadid'];?>" method="post" name="leadform" id="leadform" class="form-horizontal recordEditView">
					
					<div class="contentHeader row-fluid">
						<input type="button" value="Close Lead" id="close_lead" name="close_lead" />	
						<span class="span8 font-x-x-large textOverflowEllipsis">Update Lead Status </span>
						<?php if($closedlead==1) { ?>
						<div style="content">
						     <p  style="font-family:arial;color:red;font-size:15px; text-align:center;">This lead <strong>Closed</strong>,hence you can't update</p>
						</div>
						<?php } ?>
						<span class="pull-right">
						<input class="submit" id="updateleadstatus" name="updateleadstatus" type="submit" value="updateleadstatus" />
							<a onclick="javascript:window.history.back();" type="reset" class="cancelLink">Cancel</a>
						</span>
					</div>
					<table class="table table-bordered blockContainer showInlineTable">
						<tbody>
							<tr>
								<th colspan="6" class="blockHeader">Lead Status Update</th>
							</tr>
							<tr>
								<td class="fieldLabel narrowWidthType">
									<label class="muted pull-right marginRight10px">Lead Status</label>
								</td>
								<td class="fieldValue narrowWidthType" >
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
        <div id='jqxsoc'>
            <div>
          		<div id="jqxcustomergrid"></div>
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
									<label class="muted pull-right marginRight10px">Comments for  Lead Status</label>
								</td>
								<td  class="fieldValue narrowWidthType" colspan="3">
									<div class="row-fluid">
										<span class="span10">
											<textarea name="comments" id="comments" style="width: 649px; height: 88px;"></textarea>
										</span>
									</div>
								<input type="hidden" id="hdn_cmnts" name="hdn_cmnts" value="<?php echo $leaddetails['0']['comments']; ?>">
								<input type="hidden" id="hdn_status_id" name="hdn_status_id" value="<?php echo $leaddetails['0']['leadstatusid']; ?>">
								<input type="hidden" id="hdn_sub_status_id" name="hdn_sub_status_id" value="<?php echo $leaddetails['0']['ldsubstatus']; ?>">
								<input type="hidden" id="hdn_assignto_id" name="hdn_assignto_id" value="<?php echo $leaddetails[0]['assignleadchk'] ?>">
								
								</td>
							</tr>
						  </tbody>
								</table>
								<!-- <table class="table table-bordered blockContainer showInlineTable">
									<tbody>
										<tr>
											<th colspan="4" class="blockHeader">Description Update</th>
										</tr>
										<tr>
											<td class="fieldLabel narrowWidthType">
												<label class="muted pull-right marginRight10px">Description</label>
											</td>
											<td colspan="3" class="fieldValue narrowWidthType">
												<div class="row-fluid">
													<span class="span10">
														<textarea name="description" id="description"><?php //echo trim($leaddetails['0']['description']);?></textarea>
													</span>
												</div>
											<input type="hidden" id="hdn_desc" name="hdn_desc" value="<?php //echo $leaddetails['0']['description']; ?>">
											</td>
										</tr>
									</tbody>
								</table> -->
								
							
								</div>
								
								
								<div class="pull-right">
									<input class="submit" id="updateleadstatus" name="updateleadstatus" type="submit" value="updateleadstatus" />
									<a onclick="javascript:window.history.back();" type="reset" class="cancelLink">Cancel</a>
								</div>
								<div class="clearfix">
								</div>
							</div>
						</form>
						<!-- close lead start  -->					

							<div id="closelead_win" style="display: none">
					                <div id="windowHeader">
					                    <span>
					                       <form action="<?= base_url()?>leads/colselead/<?php echo $leaddetails['0']['leadid'];?>" method="post" name="closeleadform" id="closeleadform" >
					                       <div name="closeleadoptions"  id="closeleadoptions"></div>
					        			Your Comments :<p><!-- <input type="text" name="closingcomments" class="row-fluid " id="closingcomments"/> -->
					        			 <textarea name="closingcomments" class="row-fluid " id="closingcomments"></textarea>
					        			 <p><input style='margin-top: 20px;' type="submit" value="Submit" id='jqxSubmitButton' />
					        			  <input type="hidden" id="hdn_closename" name="hdn_closename">
					        			  </form>
					                    </span>
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
