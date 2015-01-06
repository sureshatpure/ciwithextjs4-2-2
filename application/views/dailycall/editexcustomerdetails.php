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
<!-- <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/scripts/jquery-1.10.2.min.js"></script> -->

<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/scripts/jquery-1.11.1.min.js"></script>
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
<script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxtooltip.js"></script>
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
function openpopup(id)
    {
      // alert("company id passed is "+id);
      $('#jqxsoc').jqxWindow('open');
      $("#jqxsoc").jqxWindow({ width: 600, height: 220,isModal: true});
    
    }
var base_url = '<?php echo site_url(); ?>';

$(document).ready(function () 
{
            var theme = "black";
            $("#jqxMenu").jqxMenu({ width: '670', height: '30px', theme: 'black' });
            $("#jqxMenu").css('visibility', 'visible');
            var theme = 'energyblue';
            var customerhdnid =<?php echo $customerid; ?>;
            var validateTempitemname =$('#validateTempitemname');
                  validateTempitemname.html("<font color=red>Please select  the Product</font>");


            var validationResult ;
            var grid_row_data;
            var jqxgrid_add_row_index;
            var jqxgrid_n_row_index;
            var baseurl = window.location.href.split(window.location.pathname)[0]+'/salescrm/';
            
// Customer edit pop up window variable delaraction
            var column_edit_name;
           
  

/* poppup for getting crm soc number  - Start */

// Source for item master grid start
             

// source for item master grid end

//  return value from item master start
           

/*code to check product dupliates end*/    
              
         
     

     
   


//  return value from item master end


           
/* popup for getting crm soc number  - End*/
     
/*start validation rules*/

            $('#fromeditdailycall').jqxValidator({
                  rules: [
                            { 
                              input: '#website', message: 'Please Enter the Website url',
                               rule: function(input)
                               {
                                  if($("#website").val() == "") 
                                    {
                                    //  alert("false"); 
                                      return false;
                                    } 
                                    else 
                                      {
                                     //   alert("true"); 
                                        return true;
                                      }
                                } 
                            },
                          {
                             input: '#description', message: 'Please Enter the description', 
                             rule: function(input)
                             {
                                if($("#description").val() == "") 
                                  {
                                  //  alert("false"); 
                                    return false;
                                  } 
                                  else 
                                    {
                                   //   alert("true"); 
                                      return true;
                                    }
                              } 
                       }
                    
                 ]
                });
/*end validation rules*/


/* END Product Grid*/

/* Select Product from POPUP start */
              
/* Select Product from POPUP end*/
//pop up window open for edit



// Start of Save Click function
        $("#updaterecord").on('click',function()
        {
            $(".jqx-grid-validation, .jqx-grid-validation-arrow-up, .jqx-grid-validation-arrow-down").remove();
          
            $('#fromeditdailycall').jqxValidator('validate', validationResult);
            validationResult = function (isValid) 
            {
                if (isValid)
                 {
                    $("#fromeditdailycall").submit();
                }
            }
       });  



// end of Save Click function
        



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


  <form class="fromeditdailycall" id="fromeditdailycall"  method="post" action="<?= base_url()?>dailycall/updatedailycall">
            <div>
                <div style="border-color:red;">
                <h2>Customer Name : <?php echo $customername;?>
                  <span style="width: 100%;">
                  <input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 125x; height: 22px;' value='Update Record' id='updaterecord'>

                </span>&nbsp;</h2> 
                <h1>Executive Name : <?php echo $exe_name;?>&nbsp;&nbsp;&nbsp;View Customer Details</h1>
              </div>
               
            </div>
         
            <div class="contents">
              <input type="hidden" data-value="" name="hdn_leadid" id="hdn_leadid" value="<?php echo $leadid;?>">
              <input type="hidden" data-value="" name="hdn_customerid" id="hdn_customerid" value="<?php echo $customerid;?>">
              <input type="hidden" data-value="" name="hdncustomername" id="hdncustomername" value="<?php echo $customername;?>">

              
                <input type="hidden" id="hdn_cmnts" name="hdn_cmnts" value="<?php echo $customerinfo['0']['description']; ?>">
                <input type="hidden" id="hdn_status_id" name="hdn_status_id" value="<?php echo $customerinfo['0']['leadstatusid']; ?>">
                <input type="hidden" id="hdn_assign_to" name="hdn_assign_to" value="<?php echo $customerinfo['0']['assignleadchk']; ?>">
                <input type="hidden" id="hdn_sub_status_id" name="hdn_sub_status_id" value="<?php echo $customerinfo['0']['leadsubstatusid']; ?>">
              <table class="table table-bordered detailview-table">
                <thead>
                  <tr>
                    <th colspan="4" class="blockHeader">
                      <img data-id="13" data-mode="hide" src="<?= base_url()?>public/vdfiles/arrowRight.png" class="cursorPointer alignMiddle blockToggle  hide  "><img data-id="13" data-mode="show" src="<?= base_url()?>public/vdfiles/arrowDown.png" class="cursorPointer alignMiddle blockToggle ">&nbsp;&nbsp;Customer Details
                    </th>

                  </tr>
                </thead>
                <tbody>
            
              
                 

                  <tr>

                  <td id="Leads_detailView_fieldLabel_company" class="fieldLabel narrowWidthType">
                    <label class="muted pull-right marginRight10px">Website:</label>
                    </td>
                    <td id="Leads_detailView_fieldValue_company" class="fieldValue narrowWidthType">
                      <span data-field-type="string" class="value">
                          <input type="text" style="width:400px;" name="website" id="website" value="<?php echo set_value('website',$customerinfo['0']['website']); ?>" size="35" /> <?php echo form_error('website');   ?>  
                      </span>
                    </td>
                  </tr>
                   <tr>
                    <td id="Leads_detailView_fieldLabel_lastname" class="fieldLabel narrowWidthType">
                      <label class="muted pull-right marginRight10px">Description</label>
                    </td>
                    <td id="Leads_detailView_fieldValue_lastname" class="fieldValue narrowWidthType" colspan="3">
                      <span data-field-type="string" class="value"><textarea style="width:400px;" name="description" id="description"><?php echo trim($customerinfo['0']['description']);?></textarea></span>
                    </td>
                  </tr>
              </tbody>
            </table>
           
            </div>
            
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
