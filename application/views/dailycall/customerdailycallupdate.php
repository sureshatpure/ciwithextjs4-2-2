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

    function openpopupwindow(obj)
    {
        var id = obj.id;
        //hdncustomerid
        var customerhnd_id = $("#hdncustomerid").val();
        
        window.open(base_url+'dailycall/selectproductfordc/'+id+'/'+customerhnd_id,'_blank', 'width=600,height=500,scrollbars=yes,status=yes,resizable=yes,screenx=300,screeny=100,addressbar=no');

    }

    

$(document).ready(function () 
{
    var base_url = '<?php echo site_url(); ?>';
     var leadpath ='<?php echo $leadpath; ?>';
  // alert("leadpath "+leadpath);
    var theme = "black";
      $("#jqxMenu").jqxMenu({ width: '670', height: '30px', theme: 'black' });
      $("#jqxMenu").css('visibility', 'visible');
      $('#content').hide();
      var cellbeginedit=1;
      var theme = 'energyblue';
      var theme_darkblue='darkblue';
      var baseurl = window.location.href.split(window.location.pathname)[0]+'/salescrm/';
      var leaddata = <?php echo $data; ?>;
      var customerproducinfo = <?php echo $cust_prod_data; ?>;
      var cust_contact_data = <?php echo $cust_contact_data; ?>;
      var customergroup = $("#hdncustomergroup").val();
     // alert("customergroup "+customergroup);
      var new_prod=0;
      var addProdflag=0;
      var validatecheckdate =$('#validatecheckdate');
      var customer_id=0;
      var prodid_g=0;
      
   //   alert("product info length "+customerproducinfo.cust_prod_data.length);
      var product_data_length = customerproducinfo.cust_prod_data.length;
       $('#win_selectItemMaster').hide();
       $('#win_selectcustomer').hide();
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
                $("#jqxgrid_selectItemMaster").jqxGrid(
                {
                    width: '100%',
                    source: dataAdapterItemMaster,
                    theme: theme_darkblue,
                    selectionmode:'singlecell',
                    sortable: true,
                    pageable: true,
                    columnsresize: true,
                    sortable: true,
                    showfilterrow: true,
                    filterable: true,
                    columns: 
                    [
                        { text: 'Id', dataField: 'id', width: 100 },
                        { text: 'Product Group', dataField: 'description', width: 500,height:600 },
                    ]
                });


// source for item master grid end

//  return value from item master start
              $("#jqxgrid_selectItemMaster").on('cellselect', function (event) 
              {
              var rowindex = $("#jqxgrid_selectItemMaster").jqxGrid('getselectedrowindex', event.args.rowindex);
              var prodName = $("#jqxgrid_selectItemMaster").jqxGrid('getcellvalue', event.args.rowindex,'description');
              var prodid = $("#jqxgrid_selectItemMaster").jqxGrid('getcellvalue', event.args.rowindex,'id');
              /*code to check product duplicates start */
             alert("prodName "+prodName);
             alert("prodid "+prodid);
             prodid_g = prodid;
                 $.ajax({
                                      type: "POST",
                                      url:  base_url+'dailycall/checkproductbyname/'+prodName+'/'+customer_id+'/'+encodeURIComponent(customergroup),
                                      data: 'prodname='+prodName+'&customerid='+customer_id+'&customergroup='+encodeURIComponent(customergroup),
                                      dataType: 'json',
                                      success: function (response) 
                                      {
                                        
                                           if (response.ok==false)
                                           {
                                           //  datevalidation=false;
                                             validateProductName.html(response.msg);
                                        //     alert("Oh..!, this Product Group has already added for this customer.")
                                           }
                                           else
                                           {
                                           // datevalidation=true;
                                            validateProductName.html(response.msg);
                                           $("#custprodgrid").jqxGrid('setcellvalue', jqxgrid_add_row_index, "itemgroup", prodName);
                                           $("#custprodgrid").jqxGrid('setcellvalue', jqxgrid_add_row_index, "dct_prodid", prodid);
                                            gl_productname = $("#custprodgrid").jqxGrid('getcellvalue', jqxgrid_add_row_index,'itemgroup');
                                            //alert("gl_productname add "+gl_productname);
                                     //       alert("prod id  add "+prodid);
                                            $('#win_selectItemMaster').jqxWindow('close');        

                                           }
                                          
                                        }
                                   })     

/*code to check product dupliates end*/
             
              });
//  return value from item master end

// Source for customer input start
                  //var url =base_url+"dailycall/get_datacustomer/TURBO ENERGY LIMITED";
                  var url =base_url+"dailycall/get_datacustomer/"+customergroup;
                  
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

                  var customer_source =
                  {
                      datatype: "json",
                      datafields:[],
                      id: 'id',
                      localdata: rows
                  };

                var dataAdapterCustomer = new $.jqx.dataAdapter(customer_source);
                $("#jqxgrid_selectcustomer").jqxGrid(
                {
                    width: '100%',
                    source: dataAdapterCustomer,
                    theme: theme_darkblue,
                    selectionmode:'singlecell',
                    sortable: true,
                    pageable: true,
                    columnsresize: true,
                    sortable: true,
                    showfilterrow: true,
                    filterable: true,
                    columns: 
                    [
                        { text: 'Id', dataField: 'id', width: 100 },
                        { text: 'Customer Name', dataField: 'customer_name', width: 500,height:600 },
                    ]
                });


// source for customer input end


              
              $("#select_customer").click(function () {
                
              $("#win_selectcustomer").jqxWindow({title:'Select customer name', width: 400, resizable: true, isModal: false, autoOpen: false, cancelButton: $("#Cancel")});
              $('#win_selectcustomer').jqxWindow({ position: { x: 500, y: 200 }}); 
               $('#win_selectcustomer').show();
              });
              //  return value from customer start
               $("#jqxgrid_selectcustomer").on('cellselect', function (event) 
              {
              var rowindex = $("#jqxgrid_selectcustomer").jqxGrid('getselectedrowindex', event.args.rowindex);
              var custName = $("#jqxgrid_selectcustomer").jqxGrid('getcellvalue', event.args.rowindex,'customer_name');
              var custid = $("#jqxgrid_selectcustomer").jqxGrid('getcellvalue', event.args.rowindex,'id');
         //     alert("custName "+custName);
           //   alert("custid "+custid);
                
              $("#select_customer").val(custName);
              $("#hdnselect_customer_id").val(custid);
              customer_id=custid;
              
                  $('#win_selectcustomer').hide();
              
              /*code to check customer duplicates start */
                /* $.ajax({
                                      type: "POST",
                                      url:  base_url+'dailycall/checkcustomerbyname/'+escape(custName)+'/'+custid+'/'+escape(customergroup),
                                      data: 'custname='+escape(custName)+'&customerid='+custid+'&customergroup='+escape(customergroup),
                                      dataType: 'json',
                                      success: function (response) 
                                      {
                                        
                                           if (response.ok==false)
                                           {
                                           //  datevalidation=false;
                                             validatecustomername.html(response.msg);
                                        //     alert("Oh..!, this Product Group has already added for this customer.")
                                           }
                                           else
                                           {
                                           // datevalidation=true;
                                            validatecustomername.html(response.msg);
                                         $("#select_customer").val(custName);
                                       //     $("#custprodgrid").jqxGrid('setcellvalue', jqxgrid_add_row_index, "dct_prodid", prodid);
                                          
                                            //alert("gl_productname add "+gl_productname);
                                     //       alert("prod id  add "+prodid);
                                            $('#win_selectItemMaster').jqxWindow('close');        

                                           }
                                          
                                        }
                                   })     */
                /*code to check customer duplicates End */
             
              });
//  return value from customer end


      if(product_data_length==0)
      {
        $('#jqxButtonedit').hide();   
      }
     
      
      var source =
            {
              
                datatype: "json",
                sortcolumn: 'businesscategory',
                sortdirection: 'desc',
                datafields: 
                [
                        
                        { name: 'businesscategory',type:'text'},
                   /*     { name: 'prod_type_id',type:'int' },*/
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
            theme: 'energyblue',
            selectionmode: 'singlerow',
            sortable: true,
            pageable: true,
            columnsresize: true,
            sortable: true,
            showfilterrow: true,
            filterable: true,

            columns: 
            [
                  
                  { text: 'Sales Type', dataField: 'businesscategory', width: 150 },
                  { text: 'Pordtype_id', dataField: 'prod_type_id', width: 100,cellsalign: 'left' ,hidden:true},
                  { text: 'Potential(MT/Annum)', dataField: 'totpot', width: 200 },
                  { text: 'Requirement(MT/Annum)', dataField: 'totqnt', width: 200, cellsalign: 'left' },
                  /*{ text: 'Actual Achieved(MT/Annum)', dataField: 'annualpotential', width: 200, cellsalign: 'left' },*/
                  
                
            ], 
            showtoolbar: true,
            autoheight: true
            

      });
/* person met grid  start */
 var sourcepersonmet =
            {
              
                datatype: "json",
                sortcolumn: 'contact_person',
                sortdirection: 'desc',
                datafields: 
                [
                         {name:'cust_id', type:'int'},
                         {name:'customer_name', type:'text'},
                        { name: 'contact_person',type:'text'},
                        { name: 'designation',type:'text' },
                        { name: 'deptname',type:'text' },
                        { name: 'contact_no',type:'text'},
                        { name: 'mobile_no',type:'text'},
                        { name: 'contact_mailid',type:'text'},
                      { name: 'general_mail',type:'bool'},
                        { name: 'soc_mail',type:'bool'},
                        { name: 'payment_mail',type:'bool'},
                        { name: 'quotation_mail',type:'bool'},
                        { name: 'dispatch_mail',type:'bool'},
                        { name: 'personmet',type:'bool'},
                
                ],
                localdata: cust_contact_data,
                pagenum: 0,
                pagesize: 50,
                pager: function (pagenum, pagesize, oldpagenum) {
                // callback called when a page or page size is changed.
                }
            };

 var cellbeginedit = function (row, datafield, columntype, value) {
                var value = $('#jqxpersonmet1').jqxGrid('getcellvalue', row, "personmet");
                alert("value"+value);
                if(value=='true')
                 { return true; }
                 else
                  {return false;}
                };



      var dataAdapter = new $.jqx.dataAdapter(sourcepersonmet);
      $("#jqxpersonmet").jqxGrid(
      {
            width: '100%',
            source: dataAdapter,
            theme: theme_darkblue,
            selectionmode: 'singlerow',
            sortable: true,
            pageable: true,
            columnsresize: true,
            sortable: true,
            showfilterrow: false,
            filterable: true,
            editable:true,
            columns: 
            [
                /*  { text: 'Cust ID', dataField: 'cust_id', width: 50,editable:false, },*/
                  { text: 'Person Met', datafield: 'personmet', threestatecheckbox: false, columntype: 'checkbox', width:90},
                  { text: 'Contact Name', dataField: 'contact_person', width: 200,editable:true,hidden:false },
                  { text: 'Designation', dataField: 'designation', width: 100,cellsalign: 'left' ,hidden:false},
                  { text: 'Dept', width: 150,datafield: 'deptname',displayfield: 'deptname', cellsalign: 'left', columntype:'dropdownlist',
                            createeditor: function (row, cellvalue, editor) 
                            {
                               editor.jqxDropDownList({ source: ["ACCOUNTS","DESPATCH","PURCHASE"] });
                            }
                   },
                  { text: 'Email-Id', dataField: 'contact_mailid', width: 250 },
                  { text: 'Phone No', dataField: 'contact_no', width: 100, cellsalign: 'left' },
                   { text: 'Mobile No', dataField: 'mobile_no',width: 150, cellsalign: 'left',editable:cellbeginedit},
                  { text: 'General', datafield: 'general_mail', threestatecheckbox: false, columntype: 'checkbox', width: 84 },
                  { text: 'SOC', datafield: 'soc_mail', threestatecheckbox: false, columntype: 'checkbox', width: 55 },
                  { text: 'Payment', datafield: 'payment_mail', threestatecheckbox: false, columntype: 'checkbox', width: 82 },
                  { text: 'Quotation', datafield: 'quotation_mail', threestatecheckbox: false, columntype: 'checkbox', width: 79 },
                  { text: 'Dispatch', datafield: 'dispatch_mail', threestatecheckbox: false, columntype: 'checkbox', width: 119 }



                  /*{ text: 'Actual Achieved(MT/Annum)', dataField: 'annualpotential', width: 200, cellsalign: 'left' },*/
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

              var containerpm = $("<div style='width:200px; margin-top: 6px;' id='jqxWidgetpm'></div>");
              var spanpm = $("<span style='float: left; margin-top: 5px; margin-right: 4px;'></span>");
              var startdivpm =$("<div style='width:800px;'>");
              var addlogpm = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='add_person_row'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 100px; height: 22px;' value='Add Row' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
              var deleterowpm = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='deletepersonrow'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 100px; height: 22px;' value='Delete Row' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
              var saverecord = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='jqxbtnSaverecord'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 100px; height: 22px;' value='Save Record' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");

              var enddiv =$("</div>");
              toolbar.append(containerpm);
              containerpm.append(addlogpm);
              containerpm.append(deleterowpm);
              containerpm.append(saverecord);
          } // toolbar functions End
$("#jqxpersonmet").jqxGrid({ rendertoolbar: toolbarPerMetfunc }); 
/*Toolbar functions for Personmet END*/

/* add row  toolbar functions for personmet START*/
$("#add_person_row").bind('click', function () {
              var commit = $("#jqxpersonmet").jqxGrid('addrow', null, {});
            });

          var dataadd_pm = {};
          var generaterow = function (i) {
          var row = {};
                  row["id"] = '0';
                  row["contact_persion"] = '0';
                  row["designation"] = 'Asst';
                  row["contact_mailid"] = 'test@gmail.com';
                  row["contact_no"] = '12346';
                  row["mail_alerts"] = '2';
                  row["mailalert_id"] = '1';
          return row;

          }

        for (var i = 0; i < 2; i++) 
        {
          var rowdata = generaterow(i);
          dataadd_pm[i] = rowdata;
        }  

        var addgridsource =
        {
          datatype: "local",
          cache: false,
          datafields: [
                               { name: 'cust_id',type:'int' },
                              { name: 'contact_person',type:'string' },
                              { name: 'designation',type:'string' },
                              { name: 'contact_mailid',type:'string' },
                              { name: 'contact_no', type: 'string' },
                              { name: 'mobile_no', type: 'string' },
                              { name: 'mailalert_id', type: 'int' },
                             { name: 'general_mail',type:'bool'},
                                { name: 'soc_mail',type:'bool'},
                                { name: 'payment_mail',type:'bool'},
                                { name: 'quotation_mail',type:'bool'},
                                { name: 'dispatch_mail',type:'bool'},
                                { name: 'personmet',type:'bool'},
                              
                          
                            ],
                       id: 'id',
        //  url: 'crud/showdata',
                       localdata:dataadd_pm,
          addrow: function (rowid, rowdata, position, commit) {
              commit(true);
          },
          deleterow: function (rowid, commit) {
              commit(true);
          },
        };


         $("#deletepersonrow").bind('click', function () {
                var selectedrowindex = $("#jqxpersonmet").jqxGrid('getselectedrowindex');
                var rowscount = $("#jqxpersonmet").jqxGrid('getdatainformation').rowscount;
                 if (selectedrowindex <0 )
                {
                  alert("Please Select a Row to Delete");
                  return false;
                }

                if (selectedrowindex >= 0 && selectedrowindex < rowscount) 
                {
                  var id = $("#jqxpersonmet").jqxGrid('getrowid', selectedrowindex);
                   var dct_cust_id = $("#jqxpersonmet").jqxGrid('getcellvalue', selectedrowindex,'cust_id');
             //     alert("del id "+id);
                //  alert("dct_detail_id "+dct_detail_id);
                   if(dct_cust_id!='undefined')
                   {
                      $("#add_dailycall").append('<input type="hidden" name="delepm_val[]" value="'+dct_cust_id+'">');
                   }
                     
                  $("#jqxpersonmet").jqxGrid('deleterow', id);
                }
                
            });
          $("#jqxbtnSaverecord").bind('click', function () {
             saveallrecord();
          });
/* add row  toolbar functions for personmet END*/



/* Start Product Grid*/
  
      var custProductSource =
            {
              
                datatype: "json",
                sortcolumn: 'itemgroup',
                sortdirection: 'asc',
                datafields: 
                [
                        { name: 'from_lead',type: 'int'},
                        { name: 'dct_header_id',type: 'int'},
                        { name: 'dct_new_prod',type: 'int'},
                        { name: 'dct_prodid',type: 'int'},
                        { name: 'itemgroup',type:'text'},
                        { name: 'bulk',type:'float' },
                        { name: 'intact',type:'float'},
                        { name: 'repack',type:'float'},
                        { name: 'part_tanker',type:'float'},
                        { name: 'single_tanker',type:'float'},
                        { name: 'small_packing',type:'float'},
                        { name: 'total_potential',type:'float'},
                        { name: 'dct_prodstatusname',type:'text'},
                        { name: 'dct_prodsub_stsname',type:'text'},
                        { name: 'due_date',type:'text'},
                        { name: 'discussion_points',type:'text'},
                        { name: 'actionpoints',type:'text'},
                        { name: 'dct_marketinformation',type:'text'},
                
                ],
                localdata: customerproducinfo,
                pagenum: 0,
                pagesize: 50,
                pager: function (pagenum, pagesize, oldpagenum) {
                // callback called when a page or page size is changed.
                }
            };

/* Start  of dropdown values for the grid */
            var salesType =
            {
              datatype: "json",
              datafields:
               [
                { name: 'sale_id' },
                { name: 'sale_type_name' }
              ],
            id: 'sale_id',
            root: "salestype",
            url: base_url+'dailycall/getdispatch'
            };

            var salesdataAdapter = new $.jqx.dataAdapter(salesType,{
            autoBind: true,
                  beforeLoadComplete: function (records) {
                      var data = new Array();
                      for (var i = 0; i < records.length; i++) 
                      {
                          var salesType = records[i];
                          salesType.dct_salestypename = salesType.sale_type_name;
                          salesType.dct_salestype_id =salesType. sale_id;
               //           alert("in salesdataAdapter "+salesType.dct_salestypeid);
                          data.push(salesType);
                     }
                      return data;
                  }
            });

/* End of dropdown values for the grid */
/* Start  of dropdown values for the Mail Alerts */
            var mailType =
            {
              datatype: "json",
              datafields:
               [
                { name: 'mailalert_id' },
                { name: 'mailalert_type' }
              ],
            id: 'mailalert_id',
            root: "mailType",
            url: base_url+'dailycall/getmailalerts'
            };

            var mailtypeAdapter = new $.jqx.dataAdapter(mailType,{
            autoBind: true,
                  beforeLoadComplete: function (records) {
                      var data = new Array();
                      for (var i = 0; i < records.length; i++) 
                      {
                          var mailType = records[i];
                          mailType.mailalert_type = mailType.mailalert_type;
                          mailType.mailalert_id =mailType.mailalert_id;
                     //     alert("in mailtypeAdapter "+mailType.mailalert_id);
                          data.push(mailType);
                     }
                      return data;
                  }
            });

/* End of dropdown values for the Mail alerts */

/* Select Product from POPUP start */
              $("#custprodgrid").on("celldoubleclick", function (event)
              {
                  var column = event.args.column;
                  var rowindex = event.args.rowindex;
                  jqxgrid_add_row_index=rowindex;
                  jqxgrid_n_row_index=rowindex;

                  column_edit_index=event.args;
                  var columnindex = event.args.columnindex;
                  var columnname = column.datafield;
                  var columntext=column.text;
                  var displayValue = event.args.value;
                  if((columnindex>=6) & (columnindex<=11))
                    {
                      $("#editfield").val(displayValue);
                      $('#namefild').text(columntext);
                      $('#win_selectItemMasteredit').jqxWindow({theme: 'darkblue', autoOpen: false, width: 600, height: 400, resizable: true,title:'Edit '+columntext });
                      $('#win_selectItemMasteredit').jqxWindow({ position: { x: 500, y: 200 }}); 
                      $('#win_selectItemMasteredit').jqxWindow('show');
                    }
                    if(columnname=='itemgroup')
                    {
                      
                     /* $('#win_selectItemMaster').jqxWindow({ theme: 'energyblue', autoOpen: false, width: 400, height: 500, resizable: true,title:'select product' });
                      $('#win_selectItemMaster').jqxWindow({ position: { x: 500, y: 300 }}); 
                      $('#win_selectItemMaster').jqxWindow('open');*/
                      $('#win_selectItemMaster').jqxWindow({ theme: 'darkblue', autoOpen: false, isModal: true, width: 400, height: 500, resizable: true,modalOpacity: 0.01,title:'select product' });
                      $('#win_selectItemMaster').jqxWindow({ position: { x: 500, y: 600 }}); 
                      $('#win_selectItemMaster').jqxWindow('open');

                    }
              });
                $("#win_selectItemMasteredit").jqxWindow({ width: 250, resizable: false, isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01 });

                $("#Cancel").jqxButton({ theme: theme_darkblue });
                $("#Save").jqxButton({ theme: theme_darkblue });

                // update the edited row when the user clicks the 'Save' button.
              $("#Save").click(function () {
                  var celleditvalue=$('#editfield').val();
                  var rowindex = column_edit_index.rowindex;
                  var datafield = column_edit_index.datafield;
                  $("#custprodgrid").jqxGrid('setcellvalue', rowindex, datafield, celleditvalue);
                  $("#win_selectItemMasteredit").jqxWindow('hide');
                  $('#editfield').val()='';
              });

/* Select Product from POPUP end*/
      var ProddataAdapter = new $.jqx.dataAdapter(custProductSource);
      $("#custprodgrid").jqxTooltip();
      
      $("#custprodgrid").jqxGrid(
      {
            width: '100%',
            source: ProddataAdapter,
            theme: theme_darkblue,
            selectionmode: 'rowselect',
            sortable: true,
            pageable: true,
            columnsresize: true,
            editable:true,
            sortable: true,
            showfilterrow: false,
            filterable: false,
            altrows:true,
            pagesize: 5,
             cellhover: function (element, pageX, pageY)
                      {
                    // update tooltip.
                    $("#custprodgrid").jqxTooltip({ content: element.innerHTML });
                    // open tooltip.
                    $("#custprodgrid").jqxTooltip('open', pageX + 15, pageY + 15);
                      }, 
            columns: 
            [

                  { text: 'From Lead', dataField: 'from_lead', width: 84, hidden:false,editable: false },
                  { text: 'Hdr Id', dataField: 'dct_header_id', width: 50, hidden:false,editable: false},
                  { text: 'new', dataField: 'dct_new_prod', width: 50, hidden:false,editable: false},
                  { text: 'Product Group', dataField: 'itemgroup', width: 200,cellsalign: 'left',editable: false },
                  { text: 'Product id', dataField: 'dct_prodid', width: 200,cellsalign: 'left',editable: false },
                  { text: 'Bulk', dataField: 'bulk', width: 80,cellsalign: 'center',hidden:false},
                  { text: 'Intact', dataField: 'intact', width: 80,cellsalign: 'center',hidden:false},
                  { text: 'Repack', dataField: 'repack', width: 80,cellsalign: 'center',hidden:false},
                  { text: 'Part Tanker', dataField: 'part_tanker', width: 80,cellsalign: 'center',hidden:false},
                  { text: 'Single Tanker', dataField: 'single_tanker', width: 80,cellsalign: 'center',hidden:false},
                  { text: 'Small Packing', dataField: 'small_packing', width: 80,cellsalign: 'center',hidden:false},
                  { text: 'Total Potential(MT/Annum)', dataField: 'total_potential', width: 100,cellsalign: 'center',editable:false},
                 { text: 'Status Name', dataField: 'dct_prodstatusname', width: 100, cellsalign: 'center',editable:false },
                  { text: 'Substatus', dataField: 'dct_prodsub_stsname', width: 100, cellsalign: 'center',editable:false },
                   { text: 'Action Points', width: 150,datafield: 'actionpoints',displayfield: 'actionpoints', cellsalign: 'left', columntype:'dropdownlist',
                            createeditor: function (row, cellvalue, editor) {
                                                      editor.jqxDropDownList({ source: ["Next requirement","Sample submission with COA","To send Quote","Order follow up","Others"] });
                                                  }


                   },
                  {text: 'Due Date', datafield: 'due_date', columntype: 'datetimeinput', width: 110, align: 'left', cellsformat: 'd',formatString: 'dd-MM-yyyy', validation: function (cell, value) {
                                                                              if (value =="") {
                                                                              return { result: false, message: "Date is required!" };
                                                                              }
                                                                              return true;
                                                                              }
                  },
                  { text: 'Discussion Points', dataField: 'discussion_points', width: 130, cellsalign: 'center',editable: true },
                  /*{ text: 'Actionplanned', dataField: 'dct_actionplanned', width: 130, cellsalign: 'center',editable: false },
                  { text: 'Sales', dataField: 'dct_sales', width: 130, cellsalign: 'center',editable: false },*/
                  { text: 'Market Information', dataField: 'dct_marketinformation', width: 150, cellsalign: 'center',editable: true },

                  

                  /*{ text: 'Actual Achieved(MT/Annum)', dataField: 'annualpotential', width: 200, cellsalign: 'center' },*/
                  
                
            ], 
            showtoolbar: true,
            autoheight: true,
            rendertoolbar: toolbarfunc,

      });

// toolbar functions start
            var toolbarfunc = function (toolbar)
            {
              var me = this;
              var theme = 'darkblue';
            //    alert("theme toolbarfunc "+theme);

              var container = $("<div style='width:200px; margin-top: 6px;' id='jqxWidget'></div>");
              var span = $("<span style='float: left; margin-top: 5px; margin-right: 4px;'></span>");
              var startdiv =$("<div style='width:800px;'>");
              var addproduct = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='jqxButtonadd'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 120px; height: 22px;' value='Add Product' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
              var addlog = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='update_add_row'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 120px; height: 22px;' value='Add New Row' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
              var deleterow = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='deleterowbutton'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 100px; height: 22px;' value='Delete Row' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
              /*var update = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='jqxButtonupdate'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 65px; height: 22px;' value='Update' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");*/

              var enddiv =$("</div>");
              toolbar.append(container);
             container.append(addlog);
              container.append(addproduct);
              container.append(deleterow);
              addproduct.on('click', function (event) 
                {
                  addProdflag=1;
                  $("#add_dailycall").append('<input type="hidden" name="hdnaddProdflag" value="'+addProdflag+'">');
                  alert("Fill in all required field information and you will be redirected to the leads page for adding products");
                  saveallrecord();
                // $('#jqxButtonadd').attr('href',baseurl+'leads/adddcproduct/'+customerhdnid);
                  
                });
          } // toolbar functions End
  $("#custprodgrid").jqxGrid({ rendertoolbar: toolbarfunc });       
  

    
  $("#update_add_row").bind('click', function () 
  {
    var select_customername= $("#select_customer").val();
              
              if(select_customername=="")
              {
                  alert("Please select the customer name");
                   $("#select_customer").focus();
                  //$("#select_customer").jqxGrid('showvalidationpopup', i, "itemgroup", "Please Select the Product Group");
                  return false;
              }
    var commit = $("#custprodgrid").jqxGrid('addrow', null, {},"first");
    var value = $('#custprodgrid').jqxGrid('getrows').length;
    $('#custprodgrid').jqxGrid('ensurerowvisible', value);


        //    alert("click fn "+new_prod);
            });

          var dataadd = {};
          var generaterow = function (i) {
          var row = {};

                  row["from_lead"] = '0';
                  row["dct_new_prod"] = '1';
                  row["dct_header_id"] = '';
                  row["dct_detail_id"] = '';
                  row["itemgroup"] = '';
                  row["bulk"] = '';
                  row["intact"] = '';
                  row["repack"] = '';
                   row["part_tanker"] ='';
                  row["single_tanker"] ='';
                  row["small_packing"] ='';
                   row["total_potential"] = '';
                  row["dct_actionplanned"] = '';
                  row["dct_sales"] ='';
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
                              { name: 'from_lead',type:'int' },
                              { name: 'dct_header_id',type:'int' },
                              { name: 'dct_detail_id',type:'int' },
                              { name: 'dct_prodid',type:'int' },
                                 { name: 'itemgroup', type: 'string' },
                              { name: 'bulk', type: 'number' },
                              { name: 'intact', type: 'number' },
                              { name: 'repack', type: 'string' },
                              { name: 'part_tanker', type: 'int' },
                              { name: 'single_tanker',type:'int'},
                              { name: 'small_packing', type: 'string' },
                              { name: 'total_potential', type: 'string' },
                        { name: 'dct_prodstatusid',type:'int'},
                        { name: 'dct_prodsub_stsid',type:'int'},
                        { name: 'dct_prodstatusname',type:'text'},
                        { name: 'dct_prodsub_stsname',type:'text'},
                        { name: 'discussion_points',type:'text'},
                        { name: 'due_date',type:'text'},
                        { name: 'actionpoints',type:'text'},
                              { name: 'dct_actionplanned', type: 'number' },
                              { name: 'dct_sales', type: 'string' },
                              { name: 'dct_marketinformation', type: 'string' }
                            ],
                       id: 'id',
        //  url: 'crud/showdata',
                       localdata:dataadd,
          addrow: function (rowid, rowdata, position, commit) 
          {
              commit(true);
              new_prod=1;
          },
          deleterow: function (rowid, commit) {
              commit(true);
          },
        };

      

         $("#deleterowbutton").bind('click', function () {
                var selectedrowindex = $("#custprodgrid").jqxGrid('getselectedrowindex');
                var rowscount = $("#custprodgrid").jqxGrid('getdatainformation').rowscount;
                 if (selectedrowindex <0 )
                {
                  alert("Please Select a Row to Delete");
                  return false;
                }

                if (selectedrowindex >= 0 && selectedrowindex < rowscount) 
                {
                  var id = $("#custprodgrid").jqxGrid('getrowid', selectedrowindex);
                   var dct_detail_id = $("#custprodgrid").jqxGrid('getcellvalue', selectedrowindex,'dct_detail_id');
             //     alert("del id "+id);
                //  alert("dct_detail_id "+dct_detail_id);
                   if(dct_detail_id!='undefined')
                   {
                      $("#add_dailycall").append('<input type="hidden" name="deledct_val[]" value="'+dct_detail_id+'">');
                   }
                     
                  $("#custprodgrid").jqxGrid('deleterow', id);
                }
                
            });

  
/* start duplicate version for custprodgrid 1*/
  
/* end*/
/* END Product Grid*/

/*saverecord start*/
 

 var base_url = '<?php echo site_url(); ?>';
    //$("#visitdate").jqxDateTimeInput();
     $("#visitdate").jqxDateTimeInput({ formatString: "dd-MM-yyyy"});
      //$("#visitdate").jqxDateTimeInput('setDate', null);
        var validateProductName =$('#validateProductName');
                  validateProductName.html("<font color=red>Please select  the Product</font>");

      var exe_name = '<?=$exe_name; ?>'; 
      var customername = '<?=$customername; ?>'; 
      var customerid  = '<?=$customerid; ?>'; 
      var customername1 =escape(customername);

            
     var visittype_name;
     var visittype_id;
/* source settings for Visit Type Combo Box - START*/
      var visitType =
      {
      datatype: "json",
          datafields: [
              { name: 'visit_id' },
              { name: 'visit_name' }
          ],
      id: 'visit_id',
      url: base_url+'dailycall/gettypeofvisit'
      };
      // create a new instance of the jqx.dataAdapter.
      var visitdataAdapter = new $.jqx.dataAdapter(visitType);
/* source settings for Visit Type Combo Box - END*/

/* source settings for contact mode Combo Box - START*/
      var contactMode =
      {
      datatype: "json",
          datafields: [
              { name: 'moc_id' },
              { name: 'moc_name' }
          ],
      id: 'moc_id',
      url: base_url+'dailycall/getcontactmode'
      };
      // create a new instance of the jqx.dataAdapter.
      var mocdataAdapter = new $.jqx.dataAdapter(contactMode);
/* source settings for contact mode Combo Box - END*/


      
      var theme = "black";
      var visit_date;
      $("#jqxMenu").jqxMenu({ width: '670', height: '30px', theme: 'black' });
      $("#jqxMenu").css('visibility', 'visible');
      var theme = 'energyblue';
      var baseurl = window.location.href.split(window.location.pathname)[0]+'/salescrm/';
      
      var date = new Date();


      var contactMode = [{value:"E-mail", label:"E-mail"}, {value:"Phone", label: "Phone"}, {value:"FieldVisit", label:"Field Visit"} ];
      var time_in_hrs=["00 Hr","01 Hrs","02 Hrs","03 Hrs","04 Hrs","05 Hrs","06 Hrs","07 Hrs","08 Hrs","09 Hrs","10 Hrs"];
      var time_in_mins=["0 mins","5 mins","10 mins"," 15 mins","20 mins","25 mins","30 mins"," 35 mins","40 mins","45 mins"," 50 mins","55 mins"];
      var to_time_in_hrs=["00 Hr","01 Hrs","02 Hrs","03 Hrs","04 Hrs","05 Hrs","06 Hrs","07 Hrs","08 Hrs","09 Hrs","10 Hrs"];
      var to_time_in_mins=["0 mins","5 mins","10 mins"," 15 mins","20 mins","25 mins","30 mins"," 35 mins","40 mins","45 mins"," 50 mins","55 mins"];

      $("#visitdate").jqxDateTimeInput({ width: '150px', height: '25px', theme: theme, formatString: 'dd-MM-yyyy', showFooter: true,disabled:false });
      $("#timeinhrs").jqxDropDownList({ source: time_in_hrs, selectedIndex: 0, width: '100', height: '25'});
      $("#timeinmins").jqxDropDownList({ source: time_in_mins, selectedIndex: 0, width: '100', height: '25'});
      $("#to_timeinhrs").jqxDropDownList({ source: to_time_in_hrs, selectedIndex: 0, width: '100', height: '25'});
      $("#to_timeinmins").jqxDropDownList({ source: to_time_in_mins, selectedIndex: 0, width: '100', height: '25'});
     /* $("#typeofvisit").jqxComboBox({theme: theme, autoDropDownHeight: true, promptText: "Select the Visit Type:", source: visitdataAdapter, width: 180, height: 22}); */

     $("#typeofvisit").jqxComboBox({ source: visitdataAdapter, checkboxes: true, displayMember: "visit_name", valueMember: "visit_id",promptText: "Select the Visit Type:", width: 180, height: 22});

          $("#typeofvisit").jqxComboBox({ source: visitdataAdapter,checkboxes: true, displayMember: "visit_name", valueMember: "visit_id",promptText: "Select the Visit Type:", width: 180, height: 22});

     // var handleCheckChange = true;
              /*   $("#typeofvisit").bind('checkChange', function (event) 
               {
                    if (!handleCheckChange)
                        return;
                    if (event.args.label != 'Select All') {
                        handleCheckChange = false;
                        $("#typeofvisit").jqxComboBox('checkIndex', 0);
                        var checkedItems = $("#typeofvisit").jqxComboBox('getCheckedItems');
                        var items = $("#typeofvisit").jqxComboBox('getItems');
                        if (checkedItems.length == 1) {
                            $("#typeofvisit").jqxComboBox('uncheckIndex', 0);
                        }
                        else if (items.length != checkedItems.length) {
                            $("#typeofvisit").jqxComboBox('indeterminateIndex', 0);
                        }
                        handleCheckChange = true;
                    }
                    else {
                        handleCheckChange = false;
                        if (event.args.checked) {
                            $("#typeofvisit").jqxComboBox('checkAll');
                        }
                        else {
                            $("#typeofvisit").jqxComboBox('uncheckAll');
                        }
                        handleCheckChange = true;
                    }
                });*/

    $("#modeofcontact").jqxComboBox({ source: mocdataAdapter, displayMember: "moc_name", valueMember: "moc_id",promptText: "Select the Mode of Contact:", width: 180, height: 22});
    
      $('#add_dailycall').jqxValidator({

      rules: [
                { 
                  input: '#visitdate', message: 'Please select date of visit', action: 'select', 
                   rule: function(input)
                   {
                    var dt =$("#visitdate").jqxDateTimeInput('getDate');
                      dt=convertYdm(visit_date);
                       if($("#visitdate").jqxDateTimeInput('getDate')=='null') 
                        {
                          return false;
                        } 
                        else 
                          {
                            return true;
                          }
                    } 

                },
                {
                   input: '#typeofvisit', message: 'Please select the type of visit', action: 'select', 
                   rule: function(input)
                   {
                      if($("#typeofvisit").jqxComboBox('val') == "") 
                        {
                          
                          return false;
                        } 
                        else 
                          {
                            
                            return true;
                          }
                    } 
             },
             {
                   input: '#modeofcontact', message: 'Please select the mode of contact', 
                   rule: function(input)
                   {
                      if($("#modeofcontact").jqxComboBox('val') == "") 
                        {
                          return false;
                        } 
                        else 
                          {
                            return true;
                          }
                    } 
             }
            
          ]
      });
     

      visit_date=$("#visitdate").jqxDateTimeInput('getDate');
      visit_date=convertYdm(visit_date);
     // visit_date=$("#visitdate").jqxDateTimeInput('setDate', null);



    $('#typeofvisit').on('select', function (event) 
    {
        var args = event.args;
        if (args) 
        {
          var index = args.index;
          var item = args.item;
          visittype_name = item.label;
          visittype_id = item.value;
          $('#hdn_visitname').val(visittype_name);
      }
    }); 
     $('#modeofcontact').on('select', function (event) 
    {
        var args = event.args;
        if (args) 
        {
          var index = args.index;
          var item = args.item;
          var moc_name = item.label;
          var moc_id = item.value;
          $('#hdn_mocname').val(moc_name);
      }
    }); 


   $('#customDispatch').change(testMessage);

    function testMessage(){
       

  var salesetypename=$('#customDispatch option:selected').text();
  //alert(" adtesgg"+salesetypename);
  $('#hdn_dispname').val(salesetypename);

    }
   /* $('#customDispatch').change(function()
    {
        var args = event.args;
        if (args) 
        {
          var index = args.index;
          var item = args.item;
          var disp_name = item.label;
          var disp_id = item.value;
          alert("disp_name "+disp_name);
          alert("disp_id "+disp_id);
       //   $('#hdn_saltype').val(disp_name);
      }
    }); 
*/
     // validate form.
     var datevalidation=true;
       
       
        $("#visitdate").jqxDateTimeInput({ formatString: "dd-MM-yyyy"});
      
          $('#visitdate').on('change', function (event) 
          {  
              var jsDate = event.args.date; 
                jsDate=convertYdm(jsDate);
              
                  $.ajax({
                        type: "POST",
                        url:  baseurl+'dailycall/checkdate/'+jsDate+'/'+customergroup+'/'+exe_name,
                        data: 'visit_date='+jsDate+'&exe_name='+exe_name+'&customergroup='+customergroup,
                        dataType: 'json',
                        success: function (response) {
                          
                           if (response.ok==false)
                           {
                             datevalidation=false;
                           }
                           else
                           {
                            datevalidation=true;
                           }
                              validatecheckdate.html(response.msg);
                          }
                     })     

          }); 

     


    $("#saverecord").click(function () 
    {
      saveallrecord();
      

  });
      function saveallrecord()
      {
          var select_customername= $("#select_customer").val();
              
              if(select_customername=="")
              {
                  alert("Please select the customer name");
                   $("#select_customer").focus();
                  //$("#select_customer").jqxGrid('showvalidationpopup', i, "itemgroup", "Please Select the Product Group");
                  return false;
              }
            $(".jqx-grid-validation, .jqx-grid-validation-arrow-up, .jqx-grid-validation-arrow-down").remove();
                var rowscount = $("#jqxpersonmet").jqxGrid('getdatainformation').rowscount;
                var col_count = $("#jqxpersonmet").jqxGrid('columns').records.length;
                var valid_mailalert=0;
  
               
           

            var rowscount_pm = $("#jqxpersonmet").jqxGrid('getdatainformation').rowscount;
            var col_count_pm = $("#jqxpersonmet").jqxGrid('columns').records.length;

            var rowscount = $("#custprodgrid").jqxGrid('getdatainformation').rowscount;
            var col_count = $("#custprodgrid").jqxGrid('columns').records.length;
            var valid_dtflag=0;
            var valid_pgflag=0;
            var valid_itemgrp=0;
            var formated_due_date;
            var griddata_pm;
            var data_pm = {};
            var rows_pm = $('#jqxpersonmet').jqxGrid('getrows');

            var griddata;
            var data = {};
            var rows = $('#custprodgrid').jqxGrid('getrows');
          //  alert("No of rows"+rowscount);
            
            for (var i = 0; i < rowscount; i++)
            {
              var rowval;
              var rowstr;
              var fromlead;
               griddata = $('#custprodgrid').jqxGrid('getrowdata', i);
              var bulk = griddata.bulk;
              var intact = griddata.intact;
              var repack = griddata.repack;
              var part_tanker = griddata.part_tanker;
              var single_tanker = griddata.single_tanker;
              var small_packing = griddata.small_packing;
                due_date = $("#custprodgrid").jqxGrid('getcellvalue',i,'due_date');
               //    alert(" due_date "+i+" is "+due_date);
                   formated_due_date=convert(due_date);

              var cg_prodgrp = $('#custprodgrid').jqxGrid('getcellvalue', i, "itemgroup");
                  if (cg_prodgrp ==null || cg_prodgrp == 'undefined' ) 
                  {
                        $("#custprodgrid").jqxGrid('showvalidationpopup', i, "itemgroup", "Please Select the Product Group");
                         valid_itemgrp =0;
                        break;
                  }
                  else
                  {
                      valid_itemgrp =1;  
                  }
              if (valid_itemgrp==0)
               {
                  return false;
               }

              if ((griddata.from_lead=0) || (griddata.from_lead=='undefined'))
                {
                  fromlead=0;
                }
                else
                {
                  fromlead=griddata.from_lead;
                }

                if (griddata.dct_new_prod==0)
                {
                  new_prod=0;
                }
                else
                {
                 // bulk =0; intact = 0;  repack = 0;  part_tanker = 0; single_tanker = 0; small_packing = 0;
                  new_prod=1;
                }

          
              var start_str ="{";

              var json_str="\"productgroup\":\""+griddata.itemgroup+"\",\"from_lead\":\""+fromlead+"\",\"dct_new_prod\":\""+new_prod+"\",\"dct_prodid\":\""+griddata.dct_prodid+"\",\"dct_header_id\":\""+griddata.dct_header_id+"\",\"dct_detail_id\":\""+griddata.dct_detail_id+"\",\"bulk\":\""+bulk+"\",\"intact\":\""+intact+"\",\"repack\":\""+repack+"\",\"part_tanker\":\""+part_tanker+"\",\"single_tanker\":\""+single_tanker+"\",\"small_packing\":\""+small_packing+"\",\"total_potential\":\""+griddata.total_potential+"\",\"dct_prodstatusname\":\""+griddata.dct_prodstatusname+"\",\"dct_prodsub_stsname\":\""+griddata.dct_prodsub_stsname+"\",\"due_date\":\""+formated_due_date+"\",\"actionpoints\":\""+griddata.actionpoints+"\",\"market_information\":\""+griddata.dct_marketinformation+"\",\"discussion_points\":\""+griddata.discussion_points+"\",\"dct_sales\":\""+griddata.dct_sales+"\",\"dct_marketinformation\":\""+griddata.dct_marketinformation+"\"";

              var end_str ="}";
              rowstr =start_str+json_str+end_str;
              rowval = rowval+rowstr+",";
            }
            if(rowscount>0)
            {
             rowval =rowval.replace("undefined","");
             rowval = rowval.substring(0, rowval.length - 1); 
            }
             
             grid_row_data ="["+rowval+"]";
//START

        for (var i = 0; i < rowscount_pm; i++)
            {
              var rowval_pm;
              var rowstr_pm;
                 var fromlead;
               griddata_pm = $('#jqxpersonmet').jqxGrid('getrowdata', i);
        
             var start_str_pm ="{";

     /*         var json_str_pm="\"contactperson\":\""+griddata_pm.contact_persion+"\",\"designation\":\""+griddata_pm.designation+"\",\"contact_mailid\":\""+griddata_pm.contact_mailid+"\",\"cust_id\":\""+customerid+"\",\"contact_no\":\""+griddata_pm.contact_no+"\",\"mail_alerts\":\""+griddata_pm.mailalert_id+"\"";*/
                              
         var json_str_pm="\"contactperson\":\""+griddata_pm.contact_person+"\",\"designation\":\""+griddata_pm.designation+"\",\"deptname\":\""+griddata_pm.deptname+"\",\"contact_mailid\":\""+griddata_pm.contact_mailid+"\",\"contact_no\":\""+griddata_pm.contact_no+"\",\"mobile_no\":\""+griddata_pm.mobile_no+"\",\"personmet\":\""+griddata_pm.personmet+"\",\"dispatch_mail\":\""+griddata_pm.dispatch_mail+"\",\"quotation_mail\":\""+griddata_pm.quotation_mail+"\",\"general_mail\":\""+griddata_pm.general_mail+"\",\"payment_mail\":\""+griddata_pm.payment_mail+"\",\"soc_mail\":\""+griddata_pm.soc_mail+"\"";
              var end_str_pm ="}";

              rowstr_pm =start_str_pm+json_str_pm+end_str_pm;
              rowval_pm = rowval_pm+rowstr_pm+",";
            }
              rowval_pm =rowval_pm.replace("undefined","");
             rowval_pm = rowval_pm.substring(0, rowval_pm.length - 1);
             hdn_grid_row_data_pm ="["+rowval_pm+"]";
//END

            $('#hdn_grid_row_data').val(grid_row_data);
            $('#hdn_grid_row_data_pm').val(hdn_grid_row_data_pm);
            $('#add_dailycall').jqxValidator('validate', validationResult);

          var validationResult = function (isValid) 
          {
           if (isValid) {
             // alert(" datevalidation "+datevalidation);
                if(datevalidation)
                {
                  $("#add_dailycall").submit();
                }
              
            }
          }
        $('#add_dailycall').jqxValidator('validate', validationResult);

         } // End of saveallrecords
              
    }); //END document).ready
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

  
/* saverecord end*/

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
         
      <div>
<!-- start for add Dc -->
      
         <div id='dailycall'>
            <div>Customer Name: <?php echo $customername;?> Customer Group: <?php echo $customergroup;?></div>
            <div>
                  <form class="form" id="add_dailycall" name="add_dailycall"  method="post" action="<?= base_url()?>dailycall/savedailycall">
                       <table border="0">
                  <tr>
                      <td colspan="8" height="5px"></td>
                  </tr>
                   <tr>
                      <td colspan="3" height="5px">Please Select the Customer</td>
                        <td><input type="text" id="select_customer" name="select_customer" readonly/></td>
                  </tr>
                    <tr>
                        <td>Type of Call:</td>
                        <td>
                          <div name="typeofvisit"  id="typeofvisit">
                        </td>
                         <td>Date of Visit</td>
                        <td>
                               <div id="visitdate" name="visitdate"></div>  
                       </td>

                      
                         <td>Mode of Contact:</td>
                        <td>
                          <div name="modeofcontact"  id="modeofcontact"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Time Spent From :</td>
                        <td>
                            <div id="timeinhrs" name="timeinhrs"></div>
                            <div id="timeinmins" name="timeinmins"></div>
                       </td>
                         <td>Time Spent To :</td>
                        <td>
                            <div id="to_timeinhrs" name="to_timeinhrs"></div>
                            <div id="to_timeinmins" name="to_timeinmins"></div>
                       </td>
                      <tr>
                     <tr>
                      <td colspan="2"></td>
                      <td colspan="5">  
                        <table width="100%">
                          <tr>
                            <td colspan="5">
                              <span id="validatecheckdate"></span>
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td></td>
                    </tr>
                   

                      <!--  -->
                 
                

                                  </tbody>

                                  </table>
                                  <span  style="float: right; right: 50px; top: 166px; position: absolute;"></span>
                                  <table width="90%" border=0 id="dataTable">
                                    <tbody>
                                       
                                          <tr>
                                      <td  width="100%">
                                        <div id="jqxcustomergrid"></div>
                                    </td>
                                 </tr>
                                    <tr>
                                      <td  width="100%">
                                      <div id="jqxpersonmet"  style="width:100%;"></div>
                                    </td>
                                 </tr>
                                    
                                  </tbody>
                                </table>
                                </td>
                                
                     </tr>
                
                   
                      <!--  -->
                       <tr>
                      <td colspan="8" height="5px">
                  </tr>
                           

                 
                </table>
<?php

                          $atts = array(
                                      'width'      => '750',
                                      'height'     => '300',
                                      'scrollbars' => 'yes',
                                      'status'     => 'yes',
                                      'resizable'  => 'yes',
                                      'screenx'    => '0',
                                      'screeny'    => '0'
                                    );
?>                
                <table class="table table-bordered blockContainer showInlineTable" border=0> 
                <tbody>
                  <tr>
                    <th colspan="9" class="blockHeader">Product Details </th>
                  </tr>
              
                  <tr>
                    <td class="fieldLabel narrowWidthType" colspan="9"></td></tr></table>
                      
                      <div id="custprodgrid"></div> 

<!-- Select itemmaster popup start -->
                  <div id="win_selectItemMaster" style="width: 50%" >
                     <span id="validateProductName"></span>
                      <div style="margin: 10px">
                            <div id="jqxgrid_selectItemMaster" style="width: 400px;">testing</div>
                      </div>
                  </div>
<!-- Select Itemmaster popup end -->
<!-- Select customer popup start -->
                               <div id="win_selectcustomer" style="width:50%" >
                                       <span id="validatecustomername"></span>
                                        <div style="margin: 10px">
                                              <div id="jqxgrid_selectcustomer" style="width:400px;">testing</div>
                                        </div>
                                    </div>
<!-- Select customer popup end --> 


<!-- Select window for gird to enter text area value in the  popup start -->

  <div id="win_selectItemMasteredit" style="width: 50%" >
    <span id="validateTempitemnameedit"></span>
      <div style="margin: 10px">
      <table>
          <tr><td> <h3 id='namefild'> </h3></td></tr>
          <tr><td>
                <textarea id="editfield"> </textarea>
        </td></tr>
        <tr><td>
            <input style="margin-right: 5px;" type="button" id="Save" value="Save" />
            <input id="Cancel" type="button" value="Cancel" />
        </td></tr>
      </table>
      </div>
</div>
<!-- Select window for gird to enter text area value in the  popup END -->  
  

                    </td>
                    
                  </tr>

                     </tbody>
                </table>

<!-- End -->
<?php
$data=serialize($customerinfo); 
 $encoded=htmlentities($data);
?>
<!-- hidden table start -->
                    <table border="0" name="customhndFields" id="customhndFields" style="width=100%; height: 100%; display:block;">
                      <tbody>
                      <tr valign="top" >
                      <td width="30%">
                          <input type="hidden" id="hdncustomername" name="hdncustomername" value="<?php echo $customername;?>">
                          <input type="hidden" id="hdncustomergroup" name="hdncustomergroup" value="<?php echo $customergroup;?>">
                          <input type="hidden" id="hdncustomerid" name="hdncustomerid" value="<?php echo $customerid;?>">
                          <input type="hidden" id="hdncustomerinfo" name="hdncustomerinfo" value="<?php echo $data;?>">
                          <input type="hidden" id="hdnselect_customer_id" name="hdnselect_customer_id" >
                         
                          
                          <input type="hidden" id="hdncustomerinfo" name="hdnencustomerinfo" value="<?php echo $encoded;?>">
                          
                            <input type="hidden" id="hdn_status_name" name="hdn_status_name">
                            <input type="hidden" id="hdn_substatus_name" name="hdn_substatus_name">
                            <input type="hidden" id="hdn_visitname" name="hdn_visitname">
                            <input type="hidden" id="hdn_mocname" name="hdn_mocname">
                            <input type="hidden" id="hdn_dispname" name="hdn_dispname">
                            
                          <input type="hidden" id="hdn_grid_row_data" name="hdn_grid_row_data">
                          <input type="hidden" id="hdn_grid_row_data_pm" name="hdn_grid_row_data_pm">
                         </td>
                          
                      <td width=""></td>
                      </tr>
                      </tbody>
                    </table>
                 <table>
                      <tbody>
                     <tr>
                        <td><div style="text-align: center;"><input type="button" value="Save Record" id="saverecord" name="saverecord" /></div></td>
                    </tr>
                
                  </tbody>
                 </table>   
                   
<!-- hidden table end -->
                  </form>
            </div>

      </div>
         

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
