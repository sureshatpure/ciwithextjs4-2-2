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
 <script type="text/javascript" src="<?= base_url()?>public/jqwidgets/jqxtooltip.js"></script>
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
function openpopup(id)
    {

      $('#jqxsoc').jqxWindow('open');
      $("#jqxsoc").jqxWindow({ width: 600, height: 220,isModal: true});
    
    }
    function openpopupwindow(obj)
    {
        var id = obj.id;
        //hdncustomerid
        var customerhnd_id = $("#hdncustomerid").val();
        
        window.open(base_url+'dailycall/selectleadproductfordc/'+id+'/'+customerhnd_id,'_blank', 'width=600,height=500,scrollbars=yes,status=yes,resizable=yes,screenx=300,screeny=100,addressbar=no');

    }

 

$(document).ready(function () 
{
    var designation;
    var base_url = '<?php echo site_url(); ?>';
    var leadpath ='<?php echo $leadpath; ?>';

    var status_id ='<?php echo $leadstatusid; ?>';
    var substatus_id ='<?php echo $ldsubstatus; ?>';

    var status_order_id = '<?php echo $leadstus_order_id; ?>';
    var substatus_order_id = '<?php echo $lst_order_by_id; ?>';
    var lst_parentid_id = '<?php echo $lst_parentid_id; ?>';

    var cellbeginedit=1;
    var theme = "black";
      $("#jqxMenu").jqxMenu({ width: '670', height: '30px', theme: 'black' });
      $("#jqxMenu").css('visibility', 'visible');
      
        
          /*  $("#jqxButtondailycall").bind('click', function () {
                    //alert('Submit Button Clicked');
                     $("#dailycall").jqxWindow('show');
                });*/

 /*     $("#jqxButtondailycall").bind('click', function () {
                    alert('Submit Button Clicked');
                        //$('#jqxButtondailycall').attr('href',baseurl+'dailycall/adddailycall/'+customerid+'/'+leadid);
                        $('#jqxButtondailycall').attr('href',baseurl+'dailycall/adddailycall/15361/1255');

                });*/
       

      var theme = 'energyblue';
      var baseurl = window.location.href.split(window.location.pathname)[0]+'/salescrm/';
      var leaddata = <?php echo $data; ?>;
      var customerhdnid =<?php echo $customerid; ?>;
      var customerproducinfo = <?php echo $cust_prod_data; ?>;
   //   alert("product info length "+customerproducinfo.cust_prod_data.length);
      var lead_contact_data = <?php echo $lead_contact_data; ?>;
      var product_data_length = customerproducinfo.cust_prod_data.length;
       $('#win_selectItemMaster').hide();
       $('#win_selectItemMasteredit').hide();

// Source for item master grid start
                  var url =base_url+"dailycall/get_dataitemmaster";
                  var rows ={};
                  jQuery.ajax({
                      dataType: "html",
                      url: url,
                      type: "POST",
                      async: false,
                        error: function (xhr, status) {
                        },
                        success: function (result) {
                          var obj = jQuery.parseJSON(result);
                          rows = obj.rows;
                        }
                  });

                  var item_source =
                  {
                      datatype: "json",
                      datafields:[],
                      id: 'itemgroup',
                      localdata: rows
                  };

                var dataAdapterItemMaster = new $.jqx.dataAdapter(item_source);
              


// source for item master grid end

//  return value from item master start
           
//  return value from item master end
      if(product_data_length==0)
      {
        $('#jqxButtonedit').hide();   
      }
     
      
      var source =
            {
              
                datatype: "json",
                sortcolumn: 'leadid',
                sortdirection: 'desc',
                datafields: 
                [
                        
                        { name: 'n_value',type:'text'},
                        { name: 'prod_type_id',type:'int' },
                        { name: 'totpot',type:'float'},
                        { name: 'totqnt',type:'float'}
                        /*,{ name: 'annualpotential',type:'float'}*/
      
                
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
            width: '50%',
            source: dataAdapter,
            theme: theme,
            selectionmode: 'singlerow',
            sortable: true,
            pageable: true,
            columnsresize: true,
            sortable: true,
            showfilterrow: true,
            filterable: true,

            columns: 
            [
                  
                  { text: 'Product Type', dataField: 'n_value', width: 150 },
                  { text: 'Pordtype_id', dataField: 'prod_type_id', width: 100,cellsalign: 'left' ,hidden:true},
                  { text: 'Potential(MT/Annum)', dataField: 'totpot', width: 200 },
                  { text: 'Requirement(MT/Annum)', dataField: 'totqnt', width: 200, cellsalign: 'left' },
                  /*{ text: 'Actual Achieved(MT/Annum)', dataField: 'annualpotential', width: 200, cellsalign: 'left' },*/
                  
                
            ], 
            showtoolbar: true,
            autoheight: true
            

      });
/* Start Product Grid*/
  
      var custProductSource =
            {
              
                datatype: "json",
                sortcolumn: 'dct_detail_id',
                sortdirection: 'desc',
             
                datafields: 
                [
                        { name: 'leadid',type: 'int'},
                        { name: 'dct_header_id',type: 'int'},
                        { name: 'dct_detail_id',type: 'int'},
                        { name: 'dct_prodid',type: 'int'},
                        { name: 'prod_type_id',type: 'int'},
                        { name: 'dct_prodname',type:'text'},
                        { name: 'dct_potential',type:'float' },
                        { name: 'dct_quantity',type:'float'},
                        { name: 'dct_salestypename',type:'text'},
                             { name: 'bulk', type: 'number' },
                              { name: 'intact', type: 'number' },
                              { name: 'repack', type: 'string' },
                              { name: 'part_tanker', type: 'int' },
                              { name: 'single_tanker',type:'int'},
                              { name: 'small_packing', type: 'string' },
                              { name: 'total_potential', type: 'string' },
                        { name: 'dct_salestype_id',type:'int'},
                        { name: 'dct_prodstatusid',type:'int'},
                        { name: 'dct_prodsub_stsid',type:'int'},
                        { name: 'dct_prodstatusname',type:'text'},
                        { name: 'dct_prodsub_stsname',type:'text'},
                        { name: 'discussion_points',type:'text'},
                        { name: 'due_date',type:'text'},
                        { name: 'actionpoints',type:'text'},
                        { name: 'market_information',type:'text'},
                        { name: 'dct_actionplanned',type:'text'},
                        { name: 'dct_sales',type:'text'},
                       { name: 'dct_marketinformation',type:'text'}
                        

                        /*,{ name: 'annualpotential',type:'float'}*/
      
                
                ],
                localdata: customerproducinfo,
                pagenum: 0,
                pagesize: 50,
                pager: function (pagenum, pagesize, oldpagenum) {
                // callback called when a page or page size is changed.
                }
            };

/* Start  of dropdown values for the grid */
     

/* End of dropdown values for the grid */            

/* Start  of dropdown values leadstatus */
        

/* End of dropdown values for leadstatus */   
/* Start  of dropdown values lead substatus */
  

/* End of dropdown values for lead substatus */   

  
      var ProddataAdapter = new $.jqx.dataAdapter(custProductSource);
      
      $("#custprodgrid1").jqxTooltip();
    

// toolbar functions start
// toolbar functions End
    
  $("#update_add_row").bind('click', function () {
              var commit = $("#custprodgrid").jqxGrid('addrow', null, {});
            
            });

          var dataadd = {};
          var generaterow = function (i) {
          var row = {};
                  row["from_lead"] = '0';
                  row["dct_header_id"] = '';
                  row["dct_detail_id"] = '';
                  row["dct_prodid"] = '';
                  row["dct_prodname"] = '';
                  row["dct_prodid"] = '';
                  row["dct_potential"] = '';
                  row["dct_quantity"] = '';
                   row["dct_salestypename"] ='';
                  row["dct_salestype_id"] ='';
                  row["dct_description"] ='';
                   row["dct_actionplanned"] = '';
                  row["dct_sales"] = '';
                  row["description"] ='';
                  row["dct_marketinformation"] ='';
          return row;

          }

        for (var i = 0; i < 2; i++) 
        {
          var row = generaterow(i);
          dataadd[i] = row;
        }  

        var addgridsource =
        {
          datatype: "local",
          cache: false,
          datafields: [
                              { name: 'leadid',type:'int' },
                              { name: 'dct_header_id',type:'int' },
                              { name: 'dct_detail_id',type:'int' },
                              { name: 'dct_prodid', type: 'int' },
                              { name: 'dct_prodname', type: 'string' },
                              { name: 'dct_potential', type: 'number' },
                              { name: 'dct_quantity', type: 'number' },
                              { name: 'dct_salestypename', type: 'string' },
                              { name: 'dct_salestype_id', type: 'int' },
                              { name: 'dct_salesid',type:'int'},
                              { name: 'dct_prodstatusname', type: 'string' },
                                 { name: 'dct_prodsub_stsname',type:'text'},
                              { name: 'dct_description', type: 'string' },
                              { name: 'dct_sales', type: 'string' },
                              { name: 'dct_actionplanned', type: 'number' },
                              { name: 'description', type: 'string' },
                              { name: 'dct_statuory', type: 'string' },
                              { name: 'dct_marketinformation', type: 'string' }
                            ],
                       id: 'id',
        //  url: 'crud/showdata',
                       localdata:dataadd,
          addrow: function (rowid, rowdata, position, commit) {
              commit(true);
          },
          deleterow: function (rowid, commit) {
              commit(true);
          },
        };



  
/* start duplicate version for custprodgrid 1*/
  $("#custprodgrid1").jqxGrid(
      {
            width: '100%',
            source: ProddataAdapter,
            theme: theme,
            selectionmode: 'singlecell',
            sortable: true,
            pageable: true,
            columnsresize: true,
            sortable: true,
            showfilterrow: true,
            filterable: true,

             cellhover: function (element, pageX, pageY)
                      {
                    // update tooltip.
                    $("#custprodgrid1").jqxTooltip({ content: element.innerHTML });
                    // open tooltip.
                    $("#custprodgrid1").jqxTooltip('open', pageX + 15, pageY + 15);
                      }, 
            columns: 
            [
                  { text: 'LeadId', dataField: 'leadid', width: 84, hidden:false,editable: false },
                  { text: 'Hdr Id', dataField: 'dct_header_id', width: 50, hidden:true,editable: false},
                  { text: 'P_line_id', dataField: 'dct_detail_id', width: 50, hidden:true },
                  { text: 'Product Name', dataField: 'dct_prodname', width: 100,cellsalign: 'center',editable: false },
                { text: 'ProducId', dataField: 'dct_prodid', width: 100,cellsalign: 'center' ,hidden:false,editable: false},
                  { text: 'prod_type_id', dataField: 'prod_type_id', width: 100,cellsalign: 'center' ,hidden:false,editable: false},
                 { text: 'Lead status', datafield: 'dct_prodstatusid',displayfield: 'dct_prodstatusname',  width: 150, cellsalign: 'center'},
                 { text: 'Lead Substatus', datafield: 'dct_prodsub_stsid', displayfield: 'dct_prodsub_stsname',  width: 150, cellsalign: 'center'},
                  { text: 'Requirement(MT/Annum)', dataField: 'dct_quantity', width: 130, cellsalign: 'center' },
                   { text: 'Bulk', dataField: 'bulk', width: 80,cellsalign: 'center'  },
                  { text: 'Intact', dataField: 'intact', width: 80, cellsalign: 'center' },
                  { text: 'Repack', dataField: 'repack', width: 80, cellsalign: 'center' },
                  { text: 'Part Tanker', dataField: 'part_tanker', width: 80, cellsalign: 'center' },
                  { text: 'Single Tanker', dataField: 'single_tanker', width: 80, cellsalign: 'center' },
                  { text: 'Small Packing', dataField: 'small_packing', width: 80, cellsalign: 'center' },
                  { text: 'Total Potential', dataField: 'total_potential', width: 80, cellsalign: 'center',editable: false},
                  { text: 'Action Points', width: 150,datafield: 'actionpoints',displayfield: 'actionpoints', cellsalign: 'left'},
                  {text: 'Due Date', datafield: 'due_date', columntype: 'datetimeinput', width: 110, align: 'left', cellsformat: 'd',formatString: 'yyyy-MM-dd HH:mm:ss', validation: function (cell, value) {
                                                                              if (value =="") {
                                                                              return { result: false, message: "Date is required!" };
                                                                              }
                                                                              return true;
                                                                              }
                  },
                  { text: 'Discussion Points', dataField: 'discussion_points', width: 130, cellsalign: 'center',editable: true },
                  { text: 'Market Information', dataField: 'market_information', width: 150, cellsalign: 'center',editable: true },
                
            ], 
            showtoolbar: true,
            autoheight: true
            

      });
/* end*/
/* END Product Grid*/
/* Select Product from POPUP start */
        
/* Select Product from POPUP end*/

/*saverecord start*/
 

 var base_url = '<?php echo site_url(); ?>';
         

      var exe_name = '<?=$exe_name; ?>'; 
      var customername = '<?=$customername; ?>'; 
      var customerid  = '<?=$customerid; ?>'; 
      var leadid  = '<?=$leadid; ?>'; 

    
     var visittype_name;
     var visittype_id;
/* source settings for Visit Type Combo Box - START*/
      
/* source settings for Visit Type Combo Box - END*/

/* source settings for contact mode Combo Box - START*/
      
/* source settings for contact mode Combo Box - END*/


      
      var theme = "black";
      var visit_date;
      $("#jqxMenu").jqxMenu({ width: '670', height: '30px', theme: 'black' });
      $("#jqxMenu").css('visibility', 'visible');
      var theme = 'energyblue';
      var baseurl = window.location.href.split(window.location.pathname)[0]+'/salescrm/';
      var date = new Date();
     // validate form.
     var datevalidation=true;
    
      function convert(visit_date)
      {
           var date = new Date(visit_date),mnth = ("0" + (date.getMonth()+1)).slice(-2),day  = ("0" + date.getDate()).slice(-2);
           return [ date.getFullYear(), mnth, day ].join("-");
           //alert([ date.getFullYear(), mnth, day ].join("-"));
      }
       function convertYdm(currentdate)
          {
               var date = new Date(currentdate),mnth = ("0" + (date.getMonth()+1)).slice(-2),day  = ("0" + date.getDate()).slice(-2);
               return [ date.getFullYear(), day, mnth ].join("-");
               //alert([ date.getFullYear(), mnth, day ].join("-"));
          }

  


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
                    url: base_url+"dailycall/dcgetleadsubstatus/"+option+"/"+leadid, 
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

/* code of getting soc popup window start*/

    var leadata = <?php echo $data; ?>;

    var source =
            { 
                localdata: leadata,
                datatype: "array",
                datafields:
                [
                    { name: 'crm_soc_no' },
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
    
     


  ;
/* Code of getting soc popup window end*/


/* person met grid  start */
 var sourcepersonmet =
            {
              
                datatype: "json",
                sortcolumn: 'contact_person',
                sortdirection: 'asc',
                datafields: 
                [
                
                        {name:'cust_id', type:'int'}, 
                        {name:'leadid', type:'int'}, 
                        {name:'customer_name', type:'text'},
                        { name: 'contact_person',type:'text'},
                        { name: 'designation',type:'text' },
                        { name: 'deptname',type:'text' },
                        { name: 'contact_no',type:'int'},
                        { name: 'mobile_no',type:'int'},
                        { name: 'contact_mailid',type:'text'},
                        { name: 'general_mail',type:'bool'},
                        { name: 'soc_mail',type:'bool'},
                        { name: 'payment_mail',type:'bool'},
                        { name: 'quotation_mail',type:'bool'},
                        { name: 'dispatch_mail',type:'bool'},
                        { name: 'personmet',type:'bool'},
      
                
                ],
                localdata: lead_contact_data,
                pagenum: 0,
                pagesize: 50,
                pager: function (pagenum, pagesize, oldpagenum) {
                // callback called when a page or page size is changed.
                }
            };

/* Start  of dropdown values for the Mail Alerts */
        

/* End of dropdown values for the Mail alerts */

/* Start  of dropdown values for the contactperson */
            var contactPerson =
            {
              datatype: "json",
              datafields:
               [
                { name: 'leadid' },
                { name: 'firstname' }
              ],
            id: 'leadid',
            root: "contactPerson",
            url: base_url+'dailycall/getcustomercontacts/'+customerhdnid
            };

            var contactAdapter = new $.jqx.dataAdapter(contactPerson,{
            autoBind: true,
                  beforeLoadComplete: function (records) {
                      var data = new Array();
                      for (var i = 0; i < records.length; i++) 
                      {
                          var contactPerson = records[i];
                          contactPerson.firstname = contactPerson.firstname;
                          contactPerson.leadid =contactPerson.leadid;
                     
                          data.push(contactPerson);
                     }
                      return data;
                  }
            });

/* End of dropdown values for the contactperson */



      var dataAdapter = new $.jqx.dataAdapter(sourcepersonmet);
      $("#jqxpersonmet").jqxGrid(
      {
            width: '80%',
            source: dataAdapter,
            theme: theme,
            selectionmode: 'singlerow',
            sortable: true,
            pageable: true,
            columnsresize: true,
            sortable: true,
            showfilterrow: false,
            filterable: true,
            editable:false,
            columns: 
            [



                  { text: 'leadid', dataField: 'leadid', width: 50,editable:false,hidden:false },
                  { text: 'custid', dataField: 'cust_id', width: 50,editable:false,hidden:false },
                   { text: 'Person Met',datafield: 'personmet', threestatecheckbox: false, columntype: 'checkbox', width:90},
                  { text: 'Contact Name', dataField: 'contact_person', width: 150,editable:cellbeginedit},
                  { text: 'Designation', dataField: 'designation', width: 100,cellsalign: 'left' ,hidden:false,editable:cellbeginedit},
                   { text: 'Dept', width: 150,datafield: 'deptname',displayfield: 'deptname', cellsalign: 'left', columntype:'dropdownlist',
                            createeditor: function (row, cellvalue, editor) 
                            {
                               editor.jqxDropDownList({ source: ["Accounts","Sales","Dispatch"] });
                            }
                   },
                  { text: 'Email-Id', dataField: 'contact_mailid',width: 220,editable:cellbeginedit},
                  { text: 'Phone No', dataField: 'contact_no',width: 150, cellsalign: 'left',editable:cellbeginedit},
                  { text: 'Mobile No', dataField: 'mobile_no',width: 150, cellsalign: 'left',editable:cellbeginedit},
                  { text: 'General', datafield: 'general_mail', threestatecheckbox: false, columntype: 'checkbox', width: 50 },
                  { text: 'SOC', datafield: 'soc_mail', threestatecheckbox: false, columntype: 'checkbox', width: 50 },
                  { text: 'Payment', datafield: 'payment_mail', threestatecheckbox: false, columntype: 'checkbox', width: 50 },
                  { text: 'Quotation', datafield: 'quotation_mail', threestatecheckbox: false, columntype: 'checkbox', width: 50 },
                  { text: 'Dispatch', datafield: 'dispatch_mail', threestatecheckbox: false, columntype: 'checkbox', width: 50 },

                
            ], 
            showtoolbar: true,
            autoheight: true,
            rendertoolbar: toolbarPerMetfunc
      });

/* personmet grid end*/

/* Toolbar functions for personmet grid START */

            var toolbarPerMetfunc = function (toolbar)
            {
              var me = this;
              var theme = 'darkblue';
           //     alert("theme "+theme);

              var containerpm = $("<div style='width:200px; margin-top: 6px;  ' id='jqxWidgetpm'>Contact Details</div>");
              var spanpm = $("<span style='float: left; margin-top: 5px; margin-right: 4px;'></span>");
              var startdivpm =$("<div style='width:800px;'> Contact Details");
       //       var addlogpm = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='add_person_row'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 100px; height: 22px;' value='Add Row' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
         //     var deleterowpm = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='deletepersonrow'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 100px; height: 22px;' value='Delete Row' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
           //   var saverecord = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='jqxbtnSaverecord'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 100px; height: 22px;' value='Save Record' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");

              var enddiv =$("</div>");
              toolbar.append(containerpm);

              
           //   containerpm.append(addlogpm);
         //     containerpm.append(deleterowpm);
          //    containerpm.append(saverecord);
          } // toolbar functions End
$("#jqxpersonmet").jqxGrid({ rendertoolbar: toolbarPerMetfunc }); 
/*Toolbar functions for Personmet END*/



/* personmet1 grid  start */
 var sourcepersonmet =
            {
              
                datatype: "json",
                sortcolumn: 'contact_person',
                sortdirection: 'asc',
                datafields: 
                [
                       /* {name:'leadid', type:'int'}, */
                        {name:'cust_id', type:'int'},
                        {name:'customer_name', type:'text'},
                        { name: 'contact_person',type:'text'},
                        { name: 'designation',type:'text' },
                        { name: 'contact_no',type:'int'},
                        { name: 'mobile_no',type:'int'},
                        { name: 'contact_mailid',type:'text'},
                        { name: 'general_mail',type:'bool'},
                        { name: 'soc_mail',type:'bool'},
                        { name: 'payment_mail',type:'bool'},
                        { name: 'quotation_mail',type:'bool'},
                        { name: 'personmet',type:'bool'},
      
                
                ],
                localdata: lead_contact_data,
                pagenum: 0,
                pagesize: 50,
                pager: function (pagenum, pagesize, oldpagenum) {
                // callback called when a page or page size is changed.
                }
            };


      


      var dataAdapter = new $.jqx.dataAdapter(sourcepersonmet);
      

/* personmet1 grid end*/

/* Toolbar functions for personmet1 grid START */

            // toolbar functions End

/*Toolbar functions for Personmet END*/


/* add row  toolbar functions for personmet START*/


/* saverecord end*/







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


  <form class="viewdailycall" id="viewdailycall"  method="post" action="<?= base_url()?>dailycall/savedailycall">
            <div>
                <div style="border-color:red;">
                    <span style="width: 100%;">
                <h2>Customer Name : <?php echo $customername;?>
                  <?php 
                        foreach ($grpperm as $key => $value) 
                        {
                        
                          if($value['groupname']=='Edit' && $closedlead==0)
                          {
                          ?>
                              <a style='margin-left: 25px;'  href='../../editld/<?php  echo $customerid;?>/<?php echo $leadid; ?>' id='jqxButtonedit'>
                              <input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 65px; height: 22px;' value='Edit' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'>
                            </a>
                          <?php
                          }

                        }
                  ?> 
                
                 
                    <a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' href='../../dcupdatelead/<?php  echo $customerid;?>/<?php echo $leadid; ?>' id='jqxButtondailycall'>
                      <input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 200px; height: 22px;' value='Update Daily Call' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>
                    </a>
                  </span>&nbsp;
                </h2> 
                <h1>Executive Name : <?php echo $exe_name;?>&nbsp;&nbsp;&nbsp;View Customer Details</h1>
              </div>
               
            </div>
         
            <div class="contents">
              <input type="hidden" data-value="" name="timeFormatOptions">
              <table class="table table-bordered equalSplit detailview-table">
                <thead>
                  <tr>
                    <th colspan="4" class="blockHeader">
                      <img data-id="13" data-mode="hide" src="<?= base_url()?>public/vdfiles/arrowRight.png" class="cursorPointer alignMiddle blockToggle  hide  "><img data-id="13" data-mode="show" src="<?= base_url()?>public/vdfiles/arrowDown.png" class="cursorPointer alignMiddle blockToggle ">&nbsp;&nbsp;Customer Details
                    </th>

                  </tr>
                </thead>
                <tbody>
            
                  <tr>
                    <td id="Leads_detailView_fieldLabel_lead_no" class="fieldLabel narrowWidthType">
                      <label class="muted pull-right marginRight10px">Assigned To</label>
                    </td>
                    <td id="Leads_detailView_fieldValue_lead_no" class="fieldValue narrowWidthType">
                      <span data-field-type="string" class="value">
                        <?php echo $customerinfo['0']['assign_to_name'];?></span>
                    </td>
                    <td id="Leads_detailView_fieldLabel_lastname" class="fieldLabel narrowWidthType">
                      <label class="muted pull-right marginRight10px">Website</label>
                    </td>
                    <td id="Leads_detailView_fieldValue_lastname" class="fieldValue narrowWidthType">
                    <span data-field-type="string" class="value"><?php echo $customerinfo['0']['website'];?></span>
                    </td>
                  </tr>

                   <tr>
                    <td id="Leads_detailView_fieldLabel_lastname" class="fieldLabel narrowWidthType">
                      <label class="muted pull-right marginRight10px">Description</label>
                    </td>
                    <td id="Leads_detailView_fieldValue_lastname" class="fieldValue narrowWidthType" colspan="3">
                      <span data-field-type="string" class="value"><?php echo $customerinfo['0']['description'];?></span>
                    </td>
                  </tr>
              </tbody>
            </table>
           
            </div>
            
                  <div id="jqxcustomergrid"></div>
                   <div id="jqxpersonmet"  style="width:100%;"></div>

                <div id="custprodgrid1"></div>  
                  
            <div id="view report" style="width:100%">

             <table class="table table-bordered    detailview-table" border=1>
                <thead>
                  <tr>
                    <th colspan="12" class="blockHeader">
                      <img data-id="14" data-mode="hide" src="<?= base_url()?>public/vdfiles/arrowRight.png" 
                      class="cursorPointer alignMiddle blockToggle  hide  ">
                      <img data-id="13" data-mode="show" src="<?= base_url()?>public/vdfiles/arrowDown.png" 
                      class="cursorPointer alignMiddle blockToggle ">&nbsp;&nbsp;Visit Details
                    </th>
                  </tr>
                </thead>

                <tbody>
                <tr class="listViewHeaders">
                   <td id="" class="narrowWidthType">
                        <label class="muted pull-left marginRight50px">Header ID</label>
                      </td>
                      <td id="" class="narrowWidthType">
                        <label class="muted pull-left marginRight50px">Status Changed</label>
                      </td>
                      <td id="" class="narrowWidthType">
                        <label class="muted pull-left marginRight50px">Substatus</label>
                      </td>
                      <td id="" class="narrowWidthType">
                        <label class="muted pull-left marginRight50px">Comments</label>
                      </td>
               <!--        <td id="" class="narrowWidthType">
                        <label class="muted pull-left marginRight50px">Created On</label>
                      </td>
                        <td id="" class="narrowWidthType">
                        <label class="muted pull-left marginRight50px">Created By</label>
                      </td> -->
                        <td id="" class="narrowWidthType">
                        <label class="muted pull-left marginRight50px">Updated On</label>
                      </td> 
                      <td id="" class="narrowWidthType">
                        <label class="muted pull-left marginRight50px">Updated By</label>
                      </td>
                      <td id="" class="narrowWidthType">
                        <label class="muted pull-left marginRight50px">Visit Type</label>
                      </td>
                      <td id="" class="narrowWidthType">
                        <label class="muted pull-left marginRight50px">VisitDate</label>
                      </td>
                         <td id="" class="narrowWidthType">
                        <label class="muted pull-left marginRight50px">Mode of Contact</label>
                      </td>
                         <td id="" class="narrowWidthType">
                        <label class="muted pull-left marginRight50px">Quotation Email-Id</label>
                      </td>
                    </tr>
               
<!-- Start -->
                <?php if (count($custprodhdr)>0)
                 {
               //  echo"<pre>";print_r($custprodhdr);echo"</pre>";
                  for($i=0; $i<count($custprodhdr); $i++)
                  {?>
                    <tr>
                    
                   <td id="" class="fieldValue narrowWidthType">
                     <input type="hidden" id="hdn_hdrid" name="hdn_hdrid" value="<?php echo $custprodhdr[$i]['dch_header_id'];?>">
                    </td>
                    <td id="" class="fieldValue narrowWidthType">
                      <span data-field-type="string" class="value">
                       <?php echo $custprodhdr[$i]['dch_statusname'];?></span> 
                    </td>
                   <td id="" class="fieldValue narrowWidthType">
                      <span data-field-type="string" class="value">
                       <?php echo $custprodhdr[$i]['dch_substatusname'];?></span>
                    </td>
                  <td id="" class="fieldValue narrowWidthType">
                      <span data-field-type="string" class="value">
                      <?php echo $custprodhdr[$i]['dch_comments'];?></span>
                    </td>
               <!--      <td id="" class="fieldValue narrowWidthType">
                      <span data-field-type="string" class="value">
                       <?php echo $custprodhdr[$i]['dch_created_date'];?></span>
                    </td>
                    <td id="" class="fieldValue narrowWidthType">
                      <span data-field-type="string" class="value">
                       <?php echo $custprodhdr[$i]['dch_created_username'];?></span>
                    </td> -->
                    <td id="" class="fieldValue narrowWidthType">
                      <span data-field-type="string" class="value">
                      <?php echo $custprodhdr[$i]['dch_updated_date'];?></span>
                    </td>
                    <td id="" class="fieldValue narrowWidthType">
                      <a href='javascript:void(0);' onclick='window.open("<?= base_url()?>dailycall/getcustomervisitdetails/<?php echo $custprodhdr[$i]['dch_header_id'];?>", "_blank", "width=900,height=300,scrollbars=yes,status=yes,resizable=yes,screenx=0,screeny=0");'>
                      <span data-field-type="string" class="value">
                       <?php echo $custprodhdr[$i]['dch_updated_username'];?></a></span>
                    </td>
                    <td id="" class="fieldValue narrowWidthType">
                      <span data-field-type="string" class="value">
                       <?php echo $custprodhdr[$i]['dch_visittypename'];?></span>
                    </td>
                    <td id="" class="fieldValue narrowWidthType">
                      <span data-field-type="string" class="value">
                       <?php echo $custprodhdr[$i]['dch_visitdate'];?></span>
                    </td>
                    <td id="" class="fieldValue narrowWidthType">
                      <span data-field-type="string" class="value">
                       <?php echo $custprodhdr[$i]['dch_modofcontname'];?></span>
                    </td>
                    <td id="" class="fieldValue narrowWidthType">
                      <span data-field-type="string" class="value">
                       <?php echo $custprodhdr[$i]['dch_quotation_email'];?></span>
                       
                    </td>
                  </tr>
                  <?php 
                  }
                  ?>

                
                 <?php } else {?>
                 <tr>  <td colspan="12" class="fieldValue narrowWidthType" style="text-align: center;"><font color="blue"> No data to display </font></td> </tr>
                 <?php } ?>
                  
           
                  
              </tbody>
            </table>
            </div>
            
        </form>
<!-- End of Grid content -->		
<!-- start for add Dc -->
     
<!-- End of add DC --> 

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
