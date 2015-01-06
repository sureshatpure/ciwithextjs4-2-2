<!DOCTYPE html>
<html>
<head>
	<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
	<meta content="utf-8" http-equiv="encoding">
    <meta name="keywords" content="Select Products" />
    <meta name="description" content="In this demo the ComboBox is bound to JSON data" />
    <title id='Description'>In this demo the DropDownList is bound to JSON data.</title>
   	<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.base.css" type="text/css" />
	<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.darkblue.css" type="text/css" />

    <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/scripts/jquery-1.11.0.js"></script>
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
</head>
<body>
    <div id='content'>
       <script type="text/javascript">
        $(document).ready(function () {
		var base_url = '<?php echo site_url(); ?>';
		var leadata = <?php echo $data; ?>;
		var customerhdnid =<?php echo $customerhdid; ?>;
		var theme = getDemoTheme();
		var data = leadata;
		var validateTempitemname =$('#validateTempitemname');
		validateTempitemname.html("<font color=red>Please select  the Product</font>");

         var source =
            {
                datatype: "json",
		   sortcolumn: 'id',
                datafields: [
                    { name: 'id'},
                    { name: 'description' }

                ],
                localdata: data,
		   pagenum: 1,
                pagesize: 20,
								pager: function (pagenum, pagesize, oldpagenum) {
                    // callback called when a page or page size is changed.
                },
								addrow: function(rowid, rowdata, position, commit) {
										// synchronize with the server - send insert command
									var data = "insert=true&" + $.param(rowdata);


										$.ajax({
														dataType: 'json',
														type:'post',
														url: 'add_gridProduct',
														data: data,
											cache: false,
														success: function (data, status, xhr) {
												// insert command is executed.
												commit(true);
											},
											error: function(jqXHR, textStatus, errorThrown)
											{
												commit(false);
											}
										});							
								}
            };
						 $("#jqxgrid").on('cellselect', function (event) 
						 {
							var rowindex = $("#jqxgrid").jqxGrid('getselectedrowindex', event.args.rowindex);
							var column = $("#jqxgrid").jqxGrid('getcolumn', event.args.datafield);
							var prodid = $("#jqxgrid").jqxGrid('getcellvalue', event.args.rowindex,'id');
							var prodName = $("#jqxgrid").jqxGrid('getcellvalue', event.args.rowindex,'description');
							var hiddid = $("#hdnselid").val();

/*code to check product duplicates start */
							   $.ajax({
							                        type: "POST",
							                        url:  base_url+'dailycall/checkleadproducts/'+prodid+'/'+customerhdnid,
							                        data: 'prodid='+prodid+'&customerid='+customerhdnid,
							                        dataType: 'json',
							                        success: function (response) 
							                        {
							                          
								                           if (response.ok==false)
								                           {
								                           //  datevalidation=false;
	 											 validateTempitemname.html(response.msg);
	 											 //alert("yes, this product has already added by this customer.")
								                           }
								                           else
								                           {
								                           // datevalidation=true;
								                            validateTempitemname.html(response.msg);
								                            var hdnProdid = hiddid.replace('customFieldName','hdncustomFieldName');
													$(window.opener.document).find('#'+hiddid).val(prodName);
													$(window.opener.document).find('#'+hdnProdid).val(prodid);
													//alert("Yes, this product has not already added by this customer.")
													window.close();
								                           }

							                             
							                          }
							                     })     

/*code to check product dupliates end*/
										
						});

								
            var dataAdapter = new $.jqx.dataAdapter(source);
            $("#jqxgrid").jqxGrid(
            {
                width: '100%',
                source: dataAdapter,
                theme: theme,
		    selectionmode:'singlecell',
                pageable: true,
                columnsresize: true,
		     sortable: true,
  		     showfilterrow: true,
                filterable: true,

                 columns: [
                  { text: 'Product Id', dataField: 'id', width: 100,hidden: true },
                  { text: 'Product Name', dataField: 'description', width: 500,height:600 },
               
                ]
            });
  				


        });
    </script>
      
        <div id='jqxWidget'>
		        <div id="jqxgrid"></div>
							<input type="hidden" id="hdnselid" value="<?=$this->uri->segment(3);?>">
							  <span id="validateTempitemname"></span>
    	 </div>
</body>
</html>
