<?php $this->load->view('header');?>
<!-- jqwidgets scripts -->
<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.base.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.energyblue.css" type="text/css" />
<style type="text/css">
    .editedRow {
      color: #b90f0f;
      font-style: italic;
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
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/scripts/gettheme.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.edit.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxnumberinput.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxwindow.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxcalendar.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxinput.js"></script> 
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxdatetimeinput.js"></script>
<!-- sorting and filtering - start -->

<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxdropdownlist.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxcombobox.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxvalidator.js"></script> 
    
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.sort.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.filter.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxpanel.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxcheckbox.js"></script>

<!-- sorting and filtering - end -->

<!-- paging - start -->
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.pager.js"></script>
<!-- paging - end -->

    
  
  
<!-- End of jqwidgets -->
<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.black.css" type="text/css" />
<script type="text/javascript">
var base_url = '<?php echo site_url(); ?>';

$(document).ready(function () 
{
    var theme = "black";
      $("#jqxMenu").jqxMenu({ width: '670', height: '30px', theme: 'black' });
      $("#jqxMenu").css('visibility', 'visible');
      var theme = 'energyblue';
      var baseurl = window.location.href.split(window.location.pathname)[0]+'/salescrm/';
      var dailycalldata = <?php echo $data; ?>;
      var username = '<?=$executive; ?>'; 
      var userbranch = '<?=$branch; ?>'; 
      $('#username_vw').val(username);
      $('#branch_vw').val(userbranch);
       $("#username_vw").jqxInput({placeHolder: "User Name", height: 25, width: 200, minLength: 1, theme: theme,disabled: true});
      $("#branch_vw").jqxInput({placeHolder: "Branch Name", height: 25, width: 150, minLength: 1, theme: theme,disabled: true});
      var source =
            {
              
                datatype: "json",
                sortcolumn: 'leadid',
                sortdirection: 'desc',
                datafields: 
                [
//id,custgroup,exename,branch,itemgroup,potentialqty,subactivity,modeofcontact,hour_s,minit,quantity,division,date,remarks,l1status,complaints,user_id,description,actionplanned,detailed_description
                        { name: 'id',type: 'int'},
                        { name: 'custgroup',type:'text'},
                        { name: 'exename',type:'text' },
                        { name: 'exename',type:'text' },
                        { name: 'branch',type:'text'},
                        { name: 'itemgroup',type:'text'},
                        { name: 'potentialqty',type:'int'},
                        { name: 'subactivity',type:'text' },
                        { name: 'modeofcontact',type:'text'},
                        { name: 'hour_s',type:'text'},
                        { name: 'minit',type:'text'},
                        { name: 'quantity',type:'int' },
                        { name: 'division',type:'text'},
                        { name: 'remarks',type:'text'},
                        { name: 'date'},
                        { name: 'l1status'},
                        { name: 'complaints'},
                        { name: 'user_id'},
                        { name: 'description'},
                        { name: 'actionplanned'},
                        { name: 'detailed_description'},
                        { name: 'sales'},
                        { name: 'collection'},
                        { name: 'statuory'},
                        { name: 'marketinformation'},
                        { name: 'comments'}
                        
                        
                        
      
                
                ],
                localdata: dailycalldata,
                pagenum: 0,
                pagesize: 50,
                pager: function (pagenum, pagesize, oldpagenum) {
                // callback called when a page or page size is changed.
                }
            };

                    
                         
    var dataAdapter = new $.jqx.dataAdapter(source);
      $("#jqxgrid_view").jqxGrid(
      {
          width: '100%',
          height:300,
          source: dataAdapter,
          theme: 'energyblue',
          columnsresize: true,
          selectionmode: 'rowselect',
          editable:false,
          sortable: true,
          pageable: true,
          columnsresize: true,
          sortable: true,
          showfilterrow: true,
          filterable: true,
           columns: [
                            { text: 'UID', datafield: 'id', width: 150, cellsalign: 'left', hidden:true },
                            { text: 'Customer Name', datafield: 'custgroup', width: 200, editable: false },
                            { text: 'Branch', datafield: 'branch', width: 200, editable: false },
                            { text: 'Product', datafield: 'itemgroup', width: 150, cellsalign: 'left',editable: false },
                            { text: 'Potential', datafield: 'potentialqty', width: 75, cellsalign: 'left' },
                            { text: 'Required Quantity', datafield: 'quantity', width: 75, cellsalign: 'left' },
                            { text: 'Type', datafield: 'division', width: 100, cellsalign: 'left', columntype:'dropdownlist',
                            createeditor: function (row, cellvalue, editor) {
                                                      editor.jqxDropDownList({ source: ["Tanker","Repacked","Container","Textile","Leather","Paper","Exxon Speciality","Lubricant","Polymer","Pure Speciality","Others"] });
                                                  }

                            },
                            { text: 'Type of Customer/Visit', datafield: 'subactivity',columntype: 'dropdownlist', width: 150, cellsalign: 'left',
                             createeditor: function (row, cellvalue, editor) {
                                                      editor.jqxDropDownList({ source: ["NEW CUSTOEMR","EXSISTING CUSTOMER","ORDER FOLLOWUP","ORDER AND PAYMENT","TENDER","PAYMENT FOLLOW UP","BALANCE SHEET","TANKER  DIVERTION","INVOICE","PROFORM INVOICE","PAYMENT COLLECTION"] });
                                                  }
                             },
                            
                            {text: 'Visited Date', datafield: 'date', columntype: 'datetimeinput', width: 110, align: 'left', cellsformat: 'd',formatString: 'yyyy-MM-dd HH:mm:ss',
                                validation: function (cell, value) {
                                if (value =="") {
                                return { result: false, message: "Date is required!" };
                                }
                                return true;
                                }
                            },
                             { text: 'Mode of Contact', datafield: 'modeofcontact', width: 80, cellsalign: 'left', columntype:'dropdownlist',
                            createeditor: function (row, cellvalue, editor) {
                                                      editor.jqxDropDownList({ source: ["E-mail","Phone","Visit"] });
                                                  }
                            },

                            { text: 'Time Spent (Hrs)', datafield: 'hour_s', width: 75, cellsalign: 'left', columntype:'dropdownlist',
                            createeditor: function (row, cellvalue, editor) {
                                                      editor.jqxDropDownList({ source: ["00 Hr","01 Hrs","02 Hrs","03 Hrs","04 Hrs","05 Hrs","06 Hrs","07 Hrs","08 Hrs","09 Hrs","10 Hrs"] });
                                                  }
                             },
                            { text: 'Time Spent (Mins)', datafield: 'minit', width: 75, cellsalign: 'left', columntype:'dropdownlist',
                            createeditor: function (row, cellvalue, editor) {
                                                      editor.jqxDropDownList({ source: ["0 mins","5 mins","10 mins"," 15 mins","20 mins","25 mins","30 mins"," 35 mins","40 mins","45 mins"," 50 mins","55 mins"] });
                                                  }
                            },
                            { text: 'Sales', datafield: 'sales', width: 150, cellsalign: 'left' },
                            { text: 'Collection', datafield: 'collection', width: 150, cellsalign: 'left' },
                            { text: 'Statutory', datafield: 'statuory', width: 150, cellsalign: 'left' },
                            { text: 'Market Information', datafield: 'marketinformation', width: 150, cellsalign: 'left' },
                            { text: 'Comments', datafield: 'comments', width: 150, cellsalign: 'left' },
                    
                          ]

               });




}); //
</script>


<input value="Leads" id="module" name="module" type="hidden">
<input value="" id="parent" name="parent" type="hidden">
<input value="List" id="view" name="view" type="hidden">
 <input type="hidden" id="hdn_hdr_id" name="hdn_hdr_id" value="<?php echo $this->uri->segment(3);?>" />

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
      </div>
    </div>
<div class="contentsDiv span11 marginLeftZero">
  <div class="listViewPageDiv" style="float: left; width:100%;">
    <div class="listViewTopMenuDiv noprint">
      <div class="listViewActionsDiv row-fluid">
        <span class="btn-toolbar span4">
          <span class="btn-group">
            <?php if($this->session->flashdata('message')!="") {?>
              <div class="alert alert-message.success"><p style="width:709px; text-align:center;font-size:18px;"><?php 
                echo $this->session->flashdata('message'); ?></p>
              </div>
            <?php }?>
          </span>
        </span>
      <span class="hide filterActionImages pull-right">
          <i title="Deny" data-value="deny" class="icon-ban-circle alignMiddle denyFilter filterActionImage pull-right"></i><i title="Approve" data-value="approve" class="icon-ok alignMiddle approveFilter filterActionImage pull-right"></i><i title="Delete" data-value="delete" class="icon-trash alignMiddle deleteFilter filterActionImage pull-right"></i><i title="Edit" data-value="edit" class="icon-pencil alignMiddle editFilter filterActionImage pull-right">
        </i>
      </span>

</div>
</div>
<div class="listViewContentDiv" id="listViewContents" style="float: left; width:100%;">
<!-- Start your grid content from here --> 	

    
 



  <form class="form" id="form"  method="post" action="<?= base_url()?>dailycall/savedailycall">
          
            <div style="float: left; width:95%; padding-left: 7px;" >
                   <!-- <label style="float: left;">Entry Date </label>&nbsp; --><label style="float: left; padding-left: 10px;">Executive Name </label>&nbsp;<label style="float: left;  padding-left: 107px;">Branch </label>
            </div>  
            <div style=" float: left; width:60%; padding-left: 7px;">
                <!-- <input id='view_header_date'/>&nbsp;&nbsp;&nbsp;&nbsp; --><input type="text" id="username_vw"/>&nbsp;&nbsp;&nbsp;<input type="text" id="branch_vw"/>
          
        </div>
          <div id="jqxgrid_view" style="posistion:relative; float: left; width:100%;" ></div>


         

      
            
        </form>
<!-- End of Grid content -->						
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
<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-tab.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-dropdown.js"></script>





<!-- Added in the end since it should be after less file loaded -->

</body>
</html>
