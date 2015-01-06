<?php $this->load->view('header');?>
<!-- jqwidgets scripts -->
<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.base.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.energyblue.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.darkblue.css" type="text/css" />


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

      var theme = 'energyblue';
      var theme_darkblue='darkblue';
      var baseurl = window.location.href.split(window.location.pathname)[0]+'/salescrm/';
      var leaddata = <?php echo $data; ?>;
      var customerhdnid =<?php echo $customerid; ?>;
      var customerproducinfo = <?php echo $cust_prod_data; ?>;
      var cust_contact_data = <?php echo $cust_contact_data; ?>;
      var customergroup = $("#hdncustomergroup").val();
      var new_prod=0;
      var addProdflag=0;
      var validatecheckdate =$('#validatecheckdate');
      
   //   alert("product info length "+customerproducinfo.cust_prod_data.length);
      var product_data_length = customerproducinfo.cust_prod_data.length;
       $('#win_selectItemMaster').hide();
       $('#win_selectcustomer').hide();
       

// Source for item master grid start
                

// source for item master grid end

//  return value from item master start
   
 /*code to check product duplicates start */
                

/*code to check product dupliates end*/
             
              
//  return value from item master end

// Source for customer input start
                  //var url =base_url+"dailycall/get_datacustomer/TURBO ENERGY LIMITED";
              

// source for customer input end


              
              $("#select_customer").click(function () {
                alert("test");
               $('#win_selectcustomer').show();
              });
              //  return value from customer start
           
              /*code to check customer duplicates start */
                /* $.ajax({
                                      type: "POST",
                                      url:  base_url+'dailycall/checkcustomerbyname/'+custName+'/'+custid+'/'+customergroup,
                                      data: 'custname='+custName+'&customerid='+custid+'&customergroup='+customergroup,
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
                                           $("#custprodgrid").jqxGrid('setcellvalue', jqxgrid_add_row_index, "itemgroup", prodName);
                                       //     $("#custprodgrid").jqxGrid('setcellvalue', jqxgrid_add_row_index, "dct_prodid", prodid);
                                            gl_productname = $("#custprodgrid").jqxGrid('getcellvalue', jqxgrid_add_row_index,'itemgroup');
                                            //alert("gl_productname add "+gl_productname);
                                     //       alert("prod id  add "+prodid);
                                            $('#win_selectItemMaster').jqxWindow('close');        

                                           }
                                          
                                        }
                                   })     */
                /*code to check customer duplicates End */
             
              
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
                        { name: 'contact_persion',type:'text'},
                        { name: 'designation',type:'text' },
                        { name: 'contact_no',type:'text'},
                        { name: 'mobile_no',type:'text'},
                        { name: 'contact_mailid',type:'text'},
                        { name: 'mail_alerts',type:'text'},
                      { name: 'general',type:'bool'},
                        { name: 'soc',type:'bool'},
                        { name: 'payment',type:'bool'},
                        { name: 'quotation',type:'bool'},
                        { name: 'dispatch',type:'bool'},
                        { name: 'personmet',type:'bool'},
      
                
                ],
                localdata: cust_contact_data,
                pagenum: 0,
                pagesize: 50,
                pager: function (pagenum, pagesize, oldpagenum) {
                // callback called when a page or page size is changed.
                }
            };





      var dataAdapter = new $.jqx.dataAdapter(sourcepersonmet);
    

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

/*Toolbar functions for Personmet END*/

/* add row  toolbar functions for personmet START*/

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
                        { name: 'po_bulk', type: 'number' },
                              { name: 'po_intact', type: 'number' },
                              { name: 'po_repack', type: 'string' },
                              { name: 'po_part_tanker', type: 'int' },
                              { name: 'po_single_tanker',type:'int'},
                              { name: 'po_small_packing', type: 'string' },
                              { name: 'total_potential', type: 'string' },

                              { name: 'tr_bulk', type: 'number' },
                              { name: 'tr_intact', type: 'number' },
                              { name: 'tr_repack', type: 'string' },
                              { name: 'tr_part_tanker', type: 'int' },
                              { name: 'tr_single_tanker',type:'int'},
                              { name: 'tr_small_packing', type: 'string' },
                              { name: 'total_tr', type: 'string' },

                                { name: 'ac_bulk', type: 'number' },
                              { name: 'ac_intact', type: 'number' },
                              { name: 'ac_repack', type: 'string' },
                              { name: 'ac_part_tanker', type: 'int' },
                              { name: 'ac_single_tanker',type:'int'},
                              { name: 'ac_small_packing', type: 'string' },
                              { name: 'total_ac', type: 'string' },
                              {name:'dct_prodstatusname', type:'string'},
                              {name:'dct_prodsub_stsname', type:'string'},
                              { name: 'actionpoints', type: 'string' },
                              { name: 'discussion_points', type: 'string' },
                              { name: 'due_date', type: 'date' },
                              { name: 'dct_marketinformation', type: 'string' }
                
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
/* Start  of dropdown values for the Mail Alerts */
      

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
                     
                    }
                    if(columnname=='itemgroup')
                    {
                      
                     /* $('#win_selectItemMaster').jqxWindow({ theme: 'energyblue', autoOpen: false, width: 400, height: 500, resizable: true,title:'select product' });
                      $('#win_selectItemMaster').jqxWindow({ position: { x: 500, y: 300 }}); 
                      $('#win_selectItemMaster').jqxWindow('open');*/
                      $('#win_selectItemMaster').jqxWindow({ theme: 'darkblue', autoOpen: false, isModal: true, width: 400, height: 500, resizable: true,modalOpacity: 0.01,title:'select product' });
                      $('#win_selectItemMaster').jqxWindow({ position: { x: 500, y: 150 }}); 
                      $('#win_selectItemMaster').jqxWindow('open');

                    }
              });
            

                // update the edited row when the user clicks the 'Save' button.
              $("#Save").click(function () {
                  var celleditvalue=$('#editfield').val();
                  var rowindex = column_edit_index.rowindex;
                  var datafield = column_edit_index.datafield;
                  
                  
                  $('#editfield').val()='';
              });

/* Select Product from POPUP end*/
      var ProddataAdapter = new $.jqx.dataAdapter(custProductSource);
      
      $("#custprodgrid1").jqxTooltip();
     

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
         //     container.append(addlog);
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
  
  

    
  $("#update_add_row").bind('click', function () 
  {
    
    
    


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
                              { name: 'itemgroup', type: 'string' },
                              {name:'dct_prodstatusname', type:'string'},
                              {name:'dct_prodsub_stsname', type:'string'},
                              { name: 'po_bulk', type: 'number' },
                              { name: 'po_intact', type: 'number' },
                              { name: 'po_repack', type: 'string' },
                              { name: 'po_part_tanker', type: 'int' },
                              { name: 'po_single_tanker',type:'int'},
                              { name: 'po_small_packing', type: 'string' },
                              { name: 'total_potential', type: 'string' },

                              { name: 'tr_bulk', type: 'number' },
                              { name: 'tr_intact', type: 'number' },
                              { name: 'tr_repack', type: 'string' },
                              { name: 'tr_part_tanker', type: 'int' },
                              { name: 'tr_single_tanker',type:'int'},
                              { name: 'tr_small_packing', type: 'string' },
                              { name: 'total_tr', type: 'string' },

                                { name: 'ac_bulk', type: 'number' },
                              { name: 'ac_intact', type: 'number' },
                              { name: 'ac_repack', type: 'string' },
                              { name: 'ac_part_tanker', type: 'int' },
                              { name: 'ac_single_tanker',type:'int'},
                              { name: 'ac_small_packing', type: 'string' },
                              { name: 'total_ac', type: 'string' },
                              { name: 'actionpoints', type: 'string' },
                              { name: 'discussion_points', type: 'string' },
                              { name: 'due_date', type: 'date' },
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

      
/* person met grid  start */
 var sourcepersonmet =
            {
              
                datatype: "json",
                sortcolumn: 'contact_person',
                sortdirection: 'desc',
                datafields: 
                [
                         {name:'cust_id', type:'int'},
                         {name:'personmet', type:'bool'},
                         {name:'customer_name', type:'text'},
                        { name: 'contact_person',type:'text'},
                        { name: 'designation',type:'text' },
                        { name: 'deptname',type:'text' },
                        { name: 'contact_mailid',type:'text'},
                        { name: 'contact_no',type:'text'},
                        { name: 'mobile_no',type:'text'},
                        { name: 'soc_mail',type:'bool'},
                        { name: 'general_mail',type:'bool'},
                        { name: 'payment_mail',type:'bool'},
                        { name: 'quotation_mail',type:'bool'},
                        { name: 'dispatch_mail',type:'bool'},
      
                
                ],
                localdata: cust_contact_data,
                pagenum: 0,
                pagesize: 50,
                pager: function (pagenum, pagesize, oldpagenum) {
                // callback called when a page or page size is changed.
                }
            };

      var dataAdapter = new $.jqx.dataAdapter(sourcepersonmet);
      $("#jqxpersonmet").jqxGrid(
      {
            width: '100%',
            source: dataAdapter,
            theme: 'energyblue',
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
                  { text: 'Cust ID', dataField: 'cust_id', width: 50,editable:false, },
                  { text: 'Person Met', datafield: 'personmet', threestatecheckbox: false, columntype: 'checkbox', width:90},
                  { text: 'Contact Name', dataField: 'contact_person', width: 200,editable:true,hidden:false },
                  { text: 'Designation', dataField: 'designation', width: 100,cellsalign: 'left' ,hidden:false},
                  { text: 'Dept Name', dataField: 'deptname', width: 100,cellsalign: 'left' ,hidden:false},
                  { text: 'Email-Id', dataField: 'contact_mailid', width: 250 },
                  { text: 'Phone No', dataField: 'contact_no', width: 100, cellsalign: 'left' },
                   { text: 'Mobile No', dataField: 'mobile_no',width: 150, cellsalign: 'left'},
                  { text: 'General', datafield: 'general_mail', threestatecheckbox: false, columntype: 'checkbox', width: 84 },
                  { text: 'SOC', datafield: 'soc_mail', threestatecheckbox: false, columntype: 'checkbox', width: 55},
                  { text: 'Payment', datafield: 'payment_mail', threestatecheckbox: false, columntype: 'checkbox', width: 82 },
                  { text: 'Quotation', datafield: 'quotation_mail', threestatecheckbox: false, columntype: 'checkbox', width: 79 },
                  { text: 'Dispatch', datafield: 'dispatch_mail', threestatecheckbox: false, columntype: 'checkbox', width: 119 }


                  /*{ text: 'Actual Achieved(MT/Annum)', dataField: 'annualpotential', width: 200, cellsalign: 'left' },*/
            ], 
            showtoolbar: true,
            autoheight: true
      });

/* personmet grid end*/
  
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
                  { text: 'From Lead', dataField: 'from_lead', width: 84, hidden:false,editable: false },
                  { text: 'Hdr Id', dataField: 'dct_header_id', width: 50, hidden:false,editable: false},
                  { text: 'ID', dataField: 'dct_detail_id', width: 50, hidden:false,editable: false},
                  { text: 'Product Group', dataField: 'itemgroup', width: 200,cellsalign: 'left'  },
                  { text: 'Bulk', dataField: 'po_bulk', width: 80,cellsalign: 'center'  },
                  { text: 'Intact', dataField: 'po_intact', width: 80, cellsalign: 'center' },
                  { text: 'Repack', dataField: 'po_repack', width: 80, cellsalign: 'center' },
                  { text: 'Part Tanker', dataField: 'po_part_tanker', width: 80, cellsalign: 'center' },
                  { text: 'Single Tanker', dataField: 'po_single_tanker', width: 80, cellsalign: 'center' },
                  { text: 'Small Packing', dataField: 'po_small_packing', width: 80, cellsalign: 'center' },
                  { text: 'Total Potential', dataField: 'total_potential', width: 80, cellsalign: 'center',editable: false},

                 { text: 'Target Bulk', dataField: 'tr_bulk', width: 80,cellsalign: 'center'  },
                  { text: 'Target Intact', dataField: 'tr_intact', width: 80, cellsalign: 'center' },
                  { text: 'Target Repack', dataField: 'tr_repack', width: 80, cellsalign: 'center' },
                  { text: 'Target Part Tanker', dataField: 'tr_part_tanker', width: 80, cellsalign: 'center' },
                  { text: 'Target Single Tanker', dataField: 'tr_single_tanker', width: 80, cellsalign: 'center' },
                  { text: 'Target Small Packing', dataField: 'tr_small_packing', width: 80, cellsalign: 'center' },
                  { text: 'Total Target', dataField: 'total_tr', width: 80, cellsalign: 'center',editable: false},

                 { text: 'Actual Bulk', dataField: 'ac_bulk', width: 80,cellsalign: 'center'  },
                  { text: 'Actual Intact', dataField: 'ac_intact', width: 80, cellsalign: 'center' },
                  { text: 'Actual Repack', dataField: 'ac_repack', width: 80, cellsalign: 'center' },
                  { text: 'Actual Part Tanker', dataField: 'ac_part_tanker', width: 80, cellsalign: 'center' },
                  { text: 'Actual Single Tanker', dataField: 'ac_single_tanker', width: 80, cellsalign: 'center' },
                  { text: 'Actual Small Packing', dataField: 'ac_small_packing', width: 80, cellsalign: 'center' },
                  { text: 'Total Actual', dataField: 'total_ac', width: 80, cellsalign: 'center',editable: false},

                  { text: 'Status Name', dataField: 'dct_prodstatusname', width: 100, cellsalign: 'center',editable:false },
                  { text: 'Substatus', dataField: 'dct_prodsub_stsname', width: 100, cellsalign: 'center',editable:false },
                   { text: 'Action Points', width: 150,datafield: 'actionpoints',displayfield: 'actionpoints', cellsalign: 'left', columntype:'dropdownlist',
                                                                          createeditor: function (row, cellvalue, editor) {
                                                                                                    editor.jqxDropDownList({ source: ["Next requirement","Sample submission with COA","To send Quote","Order follow up","Others"] });
                                                                                                }

                   },
                  {text: 'Due Date', datafield: 'due_date', columntype: 'datetimeinput', width: 110, align: 'left', cellsformat: 'd',formatString: 'yyyy-MM-dd HH:mm:ss', validation: function (cell, value) {
                                                                              if (value =="") {
                                                                              return { result: false, message: "Date is required!" };
                                                                              }
                                                                              return true;
                                                                              }
                  },
                  { text: 'Discussion Points', dataField: 'discussion_points', width: 130, cellsalign: 'center',editable: true },
                  { text: 'Market Information', dataField: 'dct_marketinformation', width: 150, cellsalign: 'center',editable: true },
                /*{ text: 'Actual Achieved(MT/Annum)', dataField: 'annualpotential', width: 200, cellsalign: 'center' },*/
                  
                
            ], 
            showtoolbar: true,
            autoheight: true
            

      });
/* end*/
/* END Product Grid*/

/*saverecord start*/
 

 var base_url = '<?php echo site_url(); ?>';
    
     
    
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

      

     /* $("#typeofvisit").jqxComboBox({theme: theme, autoDropDownHeight: true, promptText: "Select the Visit Type:", source: visitdataAdapter, width: 180, height: 22}); */


      var handleCheckChange = true;
               

    
    
     

      
      
    



    


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
       
       
        
      
     


    $("#saverecord").click(function () 
    {
      saveallrecord();
      

  });
      
              
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


  <form class="viewdailycall" id="viewdailycall"  method="post" action="<?= base_url()?>dailycall/savedailycall">
            <div>
                <div style="border-color:red;">
               <!--  <h2>Customer Name : <?php //echo $customername;?> --><h2>Customer Group : <?php echo $customergroup;?> <span style="width: 100%;">
               <a style='margin-left: 25px;'  href='../../edit/<?php  echo $customerid;?>/<?php echo $leadid; ?>' id='jqxButtonedit'>
                <input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 65px; height: 22px;' value='Edit' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>
                <a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 798px;'  href='../../dcupdateexcustomer/<?php  echo $customergroup;?>/<?php echo $leadid; ?>'  id='jqxButtondailycall'>

               <input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 200px; height: 22px;' value='Update Daily Call' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a></span>&nbsp;</h2> 
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
            
                 
<!-- Start -->
              
<!--  -->                  
                  <tr>
                    <td id="Leads_detailView_fieldLabel_lead_no" class="fieldLabel narrowWidthType">
                      <label class="muted pull-right marginRight10px">Executive Name </label>
                    </td>
                    <td id="Leads_detailView_fieldValue_lead_no" class="fieldValue narrowWidthType">
                      <span data-field-type="string" class="value"><?php echo $customerinfo['0']['executivename'];?></span>
                    </td>
                    <td id="Leads_detailView_fieldLabel_lastname" class="fieldLabel narrowWidthType">
                      <label class="muted pull-right marginRight10px">Current Status </label>
                    </td>
                    <td id="Leads_detailView_fieldValue_lastname" class="fieldValue narrowWidthType">
                     <span data-field-type="string" class="value">Expanding And Build Relationship</span>

                    </td>
                  </tr>
<!-- End  -->

                  <tr>
                   <td id="Leads_detailView_fieldLabel_company" class="fieldLabel narrowWidthType">
                        <label class="muted pull-right marginRight10px">Credit Limit </label>
                    </td>
                    <td id="Leads_detailView_fieldValue_company" class="fieldValue narrowWidthType">
                      <span data-field-type="string" class="value">Rs <?php echo $customerinfo['0']['credit_limit'];?></span>
                    
                    </td>
                  <td id="Leads_detailView_fieldLabel_company" class="fieldLabel narrowWidthType">
                    <label class="muted pull-right marginRight10px">Website:</label>
                    </td>
                    <td id="Leads_detailView_fieldValue_company" class="fieldValue narrowWidthType">
                      <span data-field-type="string" class="value"><?php echo @$customerinfo['0']['website'];?> </span>
                    </td>
                  </tr>
                  
                   <tr>
                    <td id="Leads_detailView_fieldLabel_lastname" class="fieldLabel narrowWidthType">
                      <label class="muted pull-right marginRight10px">About the Customer</label>
                    </td>
                    <td id="Leads_detailView_fieldValue_lastname" class="fieldValue narrowWidthType" colspan="3">
                      <span data-field-type="string" class="value"><?php echo $customerinfo['0']['about_the_customer'];?></span>
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
<!-- Start for customer div -->

<!-- End of customer div  -->
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
