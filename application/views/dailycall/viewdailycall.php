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
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.sort.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.filter.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxpanel.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxcheckbox.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxlistbox.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxdropdownlist.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxcombobox.js"></script>
    

<!-- sorting and filtering - end -->
<!-- paging - start -->
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.pager.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxdata.export.js"></script> 
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxgrid.export.js"></script>
<!-- paging - end -->
<!-- End of jqwidgets -->
<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.black.css" type="text/css" />
<script type="text/javascript">
var base_url = '<?php echo site_url(); ?>';

function _createElements()
{
 // alert("action mode in _createElements  "+actionmode);
// code start for view formdetail window
 
};
$(document).ready(function () 
{
      var theme = "black";
      $("#jqxMenu").jqxMenu({ width: '670', height: '30px', theme: 'black' });
      $("#jqxMenu").css('visibility', 'visible');
      var theme = 'energyblue';
      var baseurl = window.location.href.split(window.location.pathname)[0]+'/salescrm/';
      var leaddata = <?php echo $data; ?>;
      var permission = <?php echo $grpperm; ?>;
      $("#excelExport").jqxButton({  theme: 'energyblue'});
      $("#excelExport").click(function() {
    $("#jqxcustomergrid").jqxGrid('exportdata', 'xls', 'viewdialycall');
   // $("#jqxgrid").jqxGrid('exportdata', 'xls', 'viewleaddata', true, null, true, 'http://10.1.2.40/salescrm/dashboard/savefile');
    });
      var source =
            {
                datatype: "json",
                sortcolumn: 'created_date',
                sortdirection: 'desc',
                datafields: 
                [
                        { name: 'leadid', type:'int'},
                        { name: 'cust_type', type:'string'},
                        {name:'assignleadchk', type:'int'},
                        { name: 'company', type:'int'},
                        { name: 'total_potential', type:'int'},
                        { name: 'product_group', type:'string'},
                        { name: 'user_branch' },
                        { name: 'leadstatus'},
                        { name: 'leadsource'},
                        { name: 'assign_to_name'},
                        { name: 'leadsubstsname'},
                        { name: 'tempcustname',type:'string'},
                        { name: 'customergroup',type:'string'},
                        { name: 'created_date', type: 'datetime' },
                        { name: 'last_modified', type: 'datetime' }
                ],
                localdata: leaddata,
                pagenum: 0,
                pagesize: 50,
                pager: function (pagenum, pagesize, oldpagenum) {
                // callback called when a page or page size is changed.
                }
            };


      var dataAdapter = new $.jqx.dataAdapter(source);
      $("#jqxcustomergrid").jqxGrid(
      {
            width: '100%',
            source: dataAdapter,
            theme: theme,
            selectionmode: 'singlerow',
            pageable: true,
            columnsresize: true,
            sortable: true,
            showfilterrow: true,
            filterable: true,
            rendertoolbar: toolbarfunc,
            columns: 
            [
                  { text: 'LeadId', dataField: 'leadid', width: 60, hidden:true },
                  { text: 'Type', dataField: 'cust_type', width: 75, hidden:false },
                  { text: 'Branch', dataField: 'user_branch', width: 100,cellsalign: 'left' },
                  { text: 'CustomerId', dataField: 'company', width: 100,hidden:true },
                  { text: 'Customer Group', dataField: 'customergroup', width: 150, cellsalign: 'left'},
                  { text: 'Customer Name', dataField: 'tempcustname', cellsalign: 'left', minwidth: 150,hidden:true },
                  { text: 'Lead Source', dataField: 'leadsource', width: 85, cellsalign: 'left' },
                  { text: 'Assigned To', dataField: 'assign_to_name', width: 125, cellsalign: 'left' },
                  { text: 'Product', dataField: 'product_group', width: 75, cellsalign: 'left' },
                  { text: 'Potential (MT/Annum)', dataField: 'total_potential', width: 150, cellsalign: 'center' },
                  { text: 'Userid', dataField: 'assignleadchk', width: 60, hidden:true },
                  { text: 'Lead Status', dataField: 'leadstatus', width: 100 },
                  { text: 'Lead Substatus', dataField: 'leadsubstsname', width: 120, cellsalign: 'left' },
                  { text: 'Created Date', dataField: 'created_date', cellsalign: 'left', width: 95, cellsformat: 'd',formatString:'d'},
                  { text: 'Modified Date', dataField: 'last_modified', cellsalign: 'left', width: 95, cellsformat: 'd',formatString:'d'}
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
                var addlead = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='jqxButtonadd'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 200px; height: 22px;' value='Add New Customer' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
              var adddailycall= $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='jqxButtondailycall'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 200px; height: 22px;' value='Add Daily Call' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
                var viewlead = $("<a role='button' class='jqx-link ' style='margin-left: 25px;' target='_blank' href='#' id='jqxButtonView'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 79px; height: 22px;' value='View' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");

                var edit = $("<a style='margin-left: 25px;' href='#' id='jqxButtonedit'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 65px; height: 22px;' value='Edit' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
              var statusupdate = $("<a style='margin-left: 25px;' target='' href='#' id='jqxButtonUpdate'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 88px; height: 22px;' value='Update' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
                var enddiv =$("</div>");
                toolbar.append(container);
                container.append(span);
                container.append(startdiv);
                container.append(addlead);
              //  container.append(adddailycall);
          //      container.append(viewlead);
               // container.append(statusupdate);

                var customerid;
                var customergroup;
                var leadid;
                var assign_to_id;
                $('#jqxcustomergrid').bind('rowselect', function (event) 
                { 
                customerid = event.args.row.company;
                leadid = event.args.row.leadid;
                assign_to_id = event.args.row.assignleadchk;
                customergroup =event.args.row.customergroup;
              
                });

                for(i=0;i<permission.length; i++)
                {
                // alert(permission[i].groupname);
                 if ( permission[i].groupname =='Edit')
                    {
                    //  container.append(edit);   
                    }
                }
                container.append(enddiv);
                if (theme != "") {
                             
                }

                 viewlead.on('click', function (event) 
                {
                 //$('#jqxButtonView').attr('href',baseurl+'dailycall/viewdiallycalldetails/'+assign_to_id);
                  $('#jqxButtonView').attr('href',baseurl+'dailycall/viewdccustomerdetails/'+customerid);
                });

                  addlead.on('click', function (event) 
                {
                 $('#jqxButtonadd').attr('href',baseurl+'leads/add');
                  
                });

            adddailycall.on('click', function (event) 
                {
                  if (leadid==null)
                    {
                      alert("Please Select a row");   
                    //  $('#jqxButton').attr('href','http://google.com');
                                    return false;
        
                    }
                    else  if (leadid==0)
                    {
                      $('#jqxButtondailycall').attr('href',baseurl+'dailycall/adddailycall/'+customerid+'/'+leadid);
        
                    }

                    else
                    {
                          $('#jqxButtondailycall').attr('href',baseurl+'dailycall/adddailycall_ld/'+customerid+'/'+leadid);
                    }
             
                  
                });

          
                $('#jqxcustomergrid').bind('rowdoubleclick', function (event) {
                  //window.location = 'leads/viewleaddetails/'+leadid;
                  //window.open( 'dailycall/adddailycall/'+customerid);
                //  alert(" customerid "+customerid);
               //   alert(" leadid "+leadid);
                  if (leadid==0)
                  {
                      window.open( 'dailycall/customerdetails/'+escape(customergroup)+'/'+leadid);
                  }
                  else
                  {
                      window.open( 'dailycall/ldcustomerdetails/'+customerid+'/'+leadid);
                  }
                
                  //window.open( 'dailycall/viewdiallycalldetails/'+assign_to_id);
                });



              } // End of toolbarfunc function


             
              
       $("#jqxcustomergrid").jqxGrid({ rendertoolbar: toolbarfunc });     

});
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
          Customer Base
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
<div class="contentsDiv span11 marginLeftZero" style="width:100%;">
  <div class="listViewPageDiv">
    <div class="listViewTopMenuDiv noprint">
      <div class="listViewActionsDiv row-fluid">Customer Base Details
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
<div id='jqxWidget' style="float: left; width:100%;">
  <input style='margin-top: 10px;' title="Currently you cannot export all the data,instead filter the data and try to use Export to Excel option"   alt="Currently you cannot export all the data,instead filter the data and try to use Export to Excel option" type="button" value="Export to Excel" id='excelExport' />
<div id="jqxcustomergrid"></div>
<div style="margin-top: 30px;">
<div id="cellbegineditevent"></div>
<div style="margin-top: 10px;" id="cellendeditevent"></div>
</div>


</div>



</div>
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
