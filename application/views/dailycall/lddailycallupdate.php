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
      
      

      var theme = 'energyblue';
      var baseurl = window.location.href.split(window.location.pathname)[0]+'/salescrm/';
      var leaddata = <?php echo $data; ?>;
      var customerhdnid =<?php echo $customerid; ?>;
       var listdataAdapter;
      
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
                $("#jqxgrid_selectItemMaster").jqxGrid(
                {
                    width: '100%',
                    source: dataAdapterItemMaster,
                    theme: theme,
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
                        { text: 'Product Name', dataField: 'description', width: 500,height:600 },
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
                                              validateProductName.html(response.msg);
                                          //   alert("Sorry, this product has already added by this customer.")
                                           }
                                           else
                                           {
                                           // datevalidation=true;
                                            validateProductName.html(response.msg);
                                           $("#custprodgrid").jqxGrid('setcellvalue', jqxgrid_add_row_index, "dct_prodname", prodName);
                                            $("#custprodgrid").jqxGrid('setcellvalue', jqxgrid_add_row_index, "dct_prodid", prodid);
                                            gl_productname = $("#custprodgrid").jqxGrid('getcellvalue', jqxgrid_add_row_index,'dct_prodname');
                                            
                                            alert("gl_productname add "+gl_productname);
                                            alert("prod id  add "+prodid);
                                            $('#win_selectItemMaster').jqxWindow('close');        

                                           }
                                          
                                        }
                                   })     

/*code to check product dupliates end*/
             
              });
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
            var salesType =
            {
              datatype: "json",
              datafields:
               [
                { name: 'n_value_id' },
                { name: 'n_value' }
              ],
            id: 'n_value_id',
            root: "salestype",
            url: base_url+'dailycall/getldtypeofsales'
            };

            var salesdataAdapter = new $.jqx.dataAdapter(salesType,{
            autoBind: true,
                  beforeLoadComplete: function (records) {
                      var data = new Array();
                      for (var i = 0; i < records.length; i++) 
                      {
                          var salesType = records[i];
                          salesType.dct_salestypename = salesType.n_value;
                          salesType.dct_salestype_id = salesType.n_value_id;
                          data.push(salesType);
                     }
                      return data;
                  }
            });

/* End of dropdown values for the grid */            

/* Start  of dropdown values leadstatus */
            var leadstatuslist =
            {
              datatype: "json",
              datafields:
               [
                { name: 'leadstatusid' },
                { name: 'leadstatusname' }
              ],
            id: 'leadstatusid',
            root: "leadstatus",
            url: base_url+'dailycall/get_leadstatus/'+status_id+'/'+status_order_id
            };

            var leadstatusdataAdapter = new $.jqx.dataAdapter(leadstatuslist,{
            autoBind: true,
                  beforeLoadComplete: function (records) {
                   // alert("len satatus "+records.length);
                      var data = new Array();
                      for (var i = 0; i < records.length; i++) 
                      {
                          var leadstatuslist = records[i];
                          leadstatuslist.leadstatusname = leadstatuslist.leadstatusname;
                          leadstatuslist.leadstatusid = leadstatuslist.leadstatusid;
                          data.push(leadstatuslist);
                     }
                      return data;
                  }
            });

/* End of dropdown values for leadstatus */   
/* Start  of dropdown values lead substatus */
       /*     var leadSubstatus =
            {
              datatype: "json",
              datafields:
               [
                { name: 'lst_sub_id' },
                { name: 'lst_name' }
              ],
            id: 'lst_sub_id',
            root: "leadsubstatus",
            url: base_url+'dailycall/get_leadsubstatus/'+substatus_id+'/'+lst_parentid_id+'/'+substatus_order_id
            };

            var substatusdataAdapter = new $.jqx.dataAdapter(leadSubstatus,{
            autoBind: true,
                  beforeLoadComplete: function (recordss) {
                 //   alert("lent "+recordss.length);
                      var data = new Array();
                      for (var i = 0; i < recordss.length; i++) 
                      {
                          var leadSubstatus = recordss[i];
                       //   alert("sub name"+leadSubstatus.lst_name);
                      //    alert("sub id"+leadSubstatus.lst_sub_id);
                          leadSubstatus.lst_name = leadSubstatus.lst_name;
                          leadSubstatus.lst_sub_id = leadSubstatus.lst_sub_id;
                          data.push(leadSubstatus);
                     }
                      return data;
                  }
            });
*/
/* End of dropdown values for lead substatus */   

  
      var ProddataAdapter = new $.jqx.dataAdapter(custProductSource,{
                                          downloadComplete: function (data, status, xhr) { },
                                          loadComplete: function (data) {},
                                          loadError: function (xhr, status, error) { alert('Data load error !!!');}
                                  });


      $("#custprodgrid").jqxTooltip();
      
      $("#custprodgrid").jqxGrid(
      {
            width: '100%',
            source: ProddataAdapter,
            theme: theme,
            selectionmode: 'singlerow',
            sortable: true,
            pageable: true,
            columnsresize: true,
            editable:true,
            sortable: true,
            showfilterrow: true,
            filterable: true,
             cellhover: function (element, pageX, pageY)
                      {
                    // update tooltip.
                    $("#custprodgrid").jqxTooltip({ content: element.innerHTML });
                    // open tooltip.
                    $("#custprodgrid").jqxTooltip('open', pageX + 15, pageY + 15);
                      }, 
            columns: 
            [
                  { text: 'LeadId', dataField: 'leadid', width: 84, hidden:false,editable: false },
                  { text: 'Hdr Id', dataField: 'dct_header_id', width: 50, hidden:true,editable: false},
                  { text: 'P_line_id', dataField: 'dct_detail_id', width: 50, hidden:true },
                  { text: 'Product Name', dataField: 'dct_prodname', width: 100,cellsalign: 'center',editable: false },
                  { text: 'Lead status', datafield: 'dct_prodstatusid',displayfield: 'dct_prodstatusname',  width: 150, cellsalign: 'center', columntype:'dropdownlist',
                           createeditor: function (row, cellvalue, editor) 
                              {
                                  editor.jqxDropDownList({source: leadstatusdataAdapter.records, displayMember: "leadstatusname", valueMember: "leadstatusid"});
                              }, 
                             cellvaluechanging: function (row, column, columntype, oldvalue, newvalue) 
                             {
                                // return the old value, if the new value is empty. 
                                //alert(newvalue);
                                // alert(oldvalue);
                                 if (newvalue == "") return oldvalue;
                            }, 
                            initeditor: function (row, column, editor) 
                            {
                            // assign a new data source to the combobox.
                              var Leadstatus = $('#custprodgrid').jqxGrid('getcellvalue', row, "dct_prodstatusid");
                              /*  if(Leadstatus=="6" || Leadstatus=="7")
                                    {
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


                                  }

                                  else
                                  {      */                                             
                                    var list ={
                                                      datatype: "json",
                                                      datafields:
                                                                      [
                                                                        { name: 'lst_sub_id' },
                                                                        { name: 'lst_name' }
                                                                      ],
                                                      id: 'lst_sub_id',
                                                      root: "list",
                                                      url: base_url+"dailycall/dcgetleadsubstatusgrid/"+Leadstatus+"/"+leadid
                                                      };

                                                     listdataAdapter = new $.jqx.dataAdapter(list,{
                                                                              autoBind: true,
                                                                                    buildSelect: function (suboptions) 
                                                                                    {
                                                                                          //alert("lent "+recordss.length);
                                                                                         // console.log(suboptions);
                                                                                        var data = new Array();
                                                                                     $.each(suboptions,function(id,value) 
                                                                                            {
                                                                                              var list = records[i];
                                                                                              alert("sub name"+list.lst_name);
                                                                                             alert("sub id"+list.lst_sub_id);
                                                                                              list.lst_sub_id = list.lst_sub_id;
                                                                                              list.lst_name = list.lst_name;
                                                                                              data.push(list);
                                                                                           });
                                                                                      return data;
                                                                                    }
                                                                              }); 
                                                /* }*/
                                                
                         }
                        
                    },
                    { text: 'Lead Substatus', datafield: 'dct_prodsub_stsid', displayfield: 'dct_prodsub_stsname',  width: 150, cellsalign: 'center', columntype:'dropdownlist',
                        initeditor: function (row, column, editor) 
                        {
                              var Leadstatus = $('#custprodgrid').jqxGrid('getcellvalue', row, "dct_prodstatusid");
                              /*  if(Leadstatus=="6" || Leadstatus=="7")
                                    {
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


                                  }

                                  else
                                  {      */                                             
                                    var list ={
                                                      datatype: "json",
                                                      datafields:
                                                                      [
                                                                        { name: 'lst_sub_id' },
                                                                        { name: 'lst_name' }
                                                                      ],
                                                      id: 'lst_sub_id',
                                                      root: "list",
                                                      url: base_url+"dailycall/dcgetleadsubstatusgrid/"+Leadstatus+"/"+leadid
                                                      };

                                                     listdataAdapter = new $.jqx.dataAdapter(list,{
                                                                              autoBind: true,
                                                                                    buildSelect: function (suboptions) 
                                                                                    {
                                                                                          //alert("lent "+recordss.length);
                                                                                         // console.log(suboptions);
                                                                                        var data = new Array();
                                                                                     $.each(suboptions,function(id,value) 
                                                                                            {
                                                                                              var list = records[i];
                                                                                              alert("sub name"+list.lst_name);
                                                                                             alert("sub id"+list.lst_sub_id);
                                                                                              list.lst_sub_id = list.lst_sub_id;
                                                                                              list.lst_name = list.lst_name;
                                                                                              data.push(list);
                                                                                           });
                                                                                      return data;
                                                                                    }
                                                                              }); 
                                                /* }*/
                                                alert("select substatus");
                            editor.jqxDropDownList({ source: listdataAdapter.records, displayMember: "lst_name", valueMember: "lst_sub_id" });
                         },                        
                    }, 
                  { text: 'ProducId', dataField: 'dct_prodid', width: 100,cellsalign: 'center' ,hidden:false,editable: false},
                  { text: 'prod_type_id', dataField: 'prod_type_id', width: 100,cellsalign: 'center' ,hidden:false,editable: false},
                /*  { text: 'Potential(MT/Annum)', dataField: 'dct_potential', width: 150,cellsalign: 'center'  },*/
                  { text: 'Requirement(MT/Annum)', dataField: 'dct_quantity', width: 130, cellsalign: 'center' },
                   { text: 'Bulk', dataField: 'bulk', width: 80,cellsalign: 'center'  },
                  { text: 'Intact', dataField: 'intact', width: 80, cellsalign: 'center' },
                  { text: 'Repack', dataField: 'repack', width: 80, cellsalign: 'center' },
                  { text: 'Part Tanker', dataField: 'part_tanker', width: 80, cellsalign: 'center' },
                  { text: 'Single Tanker', dataField: 'single_tanker', width: 80, cellsalign: 'center' },
                  { text: 'Small Packing', dataField: 'small_packing', width: 80, cellsalign: 'center' },
                  { text: 'Total Potential', dataField: 'total_potential', width: 80, cellsalign: 'center',editable: false},
                  /* { text: 'Sales Type', datafield: 'dct_salestype_id',displayfield: 'dct_salestypename',  width: 100, cellsalign: 'center', columntype:'dropdownlist',
                                createeditor: function (row, cellvalue, editor) 
                                {
                                    editor.jqxDropDownList({source: salesdataAdapter.records, displayMember: "dct_salestypename", valueMember: "dct_salestype_id" });
                                }
                    },*/
                /*  { text: 'Status Name', dataField: 'dct_prodstatusname', width: 100, cellsalign: 'center' },
                  { text: 'Substatus', dataField: 'dct_prodsub_stsname', width: 100, cellsalign: 'center' },*/

                    { text: 'Action Points', width: 150,datafield: 'actionpoints',displayfield: 'actionpoints', cellsalign: 'left', columntype:'dropdownlist',
                                                                           /* validation: function (cell, value) 
                                                                            {
                                                                              
                                                                                  if (value ==null || value =='undefined') {
                                                                                      return { result: false, message: "Quantity should be in the 0-150 interval" };
                                                                                  }
                                                                                  return true;
                                                                              },*/
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
                  /*{ text: 'Actionplanned', dataField: 'dct_actionplanned', width: 130, cellsalign: 'center',editable: false },
                  { text: 'Sales', dataField: 'dct_sales', width: 130, cellsalign: 'center',editable: false },*/
                  { text: 'Market Information', dataField: 'market_information', width: 150, cellsalign: 'center',editable: true },

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
              var theme = 'energyblue';
              //  alert("theme "+theme);

              var container = $("<div style='width:200px; margin-top: 6px;' id='jqxWidget'></div>");
              var span = $("<span style='float: left; margin-top: 5px; margin-right: 4px;'></span>");
              var startdiv =$("<div style='width:800px;'>");
              var addlog = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='update_add_row'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 100px; height: 22px;' value='Add New Row' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
              var deleterow = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='deleterowbutton'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 100px; height: 22px;' value='Delete Product' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
               var addnewproduct = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='jqxButtonadd'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 120px; height: 22px;' value='Add New Product' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
              /*var update = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='jqxButtonupdate'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 65px; height: 22px;' value='Update' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");*/

              var enddiv =$("</div>");
              toolbar.append(container);
              container.append(addlog);
              container.append(deleterow);
              container.append(addnewproduct);
              

              addnewproduct.on('click', function (event) 
                {
                  addProdflag=1;
                  $("#add_dailycall").append('<input type="hidden" name="hdnaddProdflag" value="'+addProdflag+'">');
                  alert("Fill in all required field information and you will be redirected to the leads page for adding products");
                  saveallrecord();
                 
               //  $('#jqxButtonadd').attr('href',baseurl+'product/addnewitem/'+customerhdnid);
                 
                  
                });

          } // toolbar functions End
$("#custprodgrid").jqxGrid({ rendertoolbar: toolbarfunc });        
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
                              { name: 'bulk', type: 'number' },
                              { name: 'intact', type: 'number' },
                              { name: 'repack', type: 'string' },
                              { name: 'part_tanker', type: 'int' },
                              { name: 'single_tanker',type:'int'},
                              { name: 'small_packing', type: 'string' },
                              { name: 'total_potential', type: 'string' },
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
                      $("#add_leaddailycall").append('<input type="hidden" name="deledct_val[]" value="'+dct_detail_id+'">');
                   }
                    {
                    alert("This product will be deleted from leads");
                   }
                     
                  $("#custprodgrid").jqxGrid('deleterow', id);
                }
                
            });

  
/* start duplicate version for custprodgrid 1*/
  
/* end*/
/* END Product Grid*/
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
                      $('#win_selectItemMasteredit').jqxWindow({theme: 'energyblue', autoOpen: false, width: 600, height: 400, resizable: true,title:'Edit '+columntext });
                      $('#win_selectItemMasteredit').jqxWindow({ position: { x: 500, y: 200 }}); 
                      $('#win_selectItemMasteredit').jqxWindow('show');
                    }
                    if(columnname=='dct_prodname')
                    {
                      $('#win_selectItemMaster').jqxWindow({ theme: 'energyblue', autoOpen: false, isModal: true, width: 400, height: 500, resizable: true,modalOpacity: 0.01,title:'select product' });
                      $('#win_selectItemMaster').jqxWindow({ position: { x: 500, y: 150 }}); 
                      $('#win_selectItemMaster').jqxWindow('open');
                    }
              });

              $("#win_selectItemMasteredit").jqxWindow({ width: 250, resizable: false, isModal: true, autoOpen: false, cancelButton: $("#Cancel"), modalOpacity: 0.01 });
                $("#Cancel").jqxButton({ theme: theme });
                $("#Save").jqxButton({ theme: theme });

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

/*saverecord start*/
 

 var base_url = '<?php echo site_url(); ?>';
    //$("#visitdate").jqxDateTimeInput();
     $("#visitdate").jqxDateTimeInput({ formatString: "dd-MM-yyyy"});
      //$("#visitdate").jqxDateTimeInput('setDate', null);
        var validateProductName =$('#validateProductName');
                  validateProductName.html("<font color=red>Please select  the Product</font>");

      var exe_name = '<?=$exe_name; ?>'; 
      var customername = '<?=$customername; ?>'; 
      var customergroup = '<?=$customergroup; ?>'; 
      var customerid  = '<?=$customerid; ?>'; 
      var leadid  = '<?=$leadid; ?>'; 

    
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

     $("#typeofvisit").jqxComboBox({ source: visitdataAdapter,checkboxes: true, displayMember: "visit_name", valueMember: "visit_id",promptText: "Select the Visit Type:", width: 180, height: 22});

    $("#modeofcontact").jqxComboBox({ source: mocdataAdapter, displayMember: "moc_name", valueMember: "moc_id",promptText: "Select the Mode of Contact:", width: 180, height: 22});
    
      $('#add_leaddailycall').jqxValidator({

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
             /*,{
                   input: '#txtLeadsoc', message: 'Please Enter the SOC Number', action: 'select', 
                   rule: function(input)
                   {
                        if ($("#txtLeadsoc").is('visible'))
                        {
                          alert("visble ");
                          return false;
                        }
                        else
                        {
                          alert("Not visible");
                            return false;
                        }
                      if($("#txtLeadsoc").val() == "") 
                        {
                         alert("in soc false"); 
                          return false;
                        } 
                        else 
                          {
                          alert("in soc true"); 
                            return true;
                          }
                    }
               },
             {
                   input: '#customFieldName0', message: 'Please select atleast one product', action: 'select', 
                   rule: function(input)
                   {

                      if($("#customFieldName0").val() == "") 
                        {
                    //      alert("false"); 
                          return false;
                        } 
                        else 
                          {
                     //      alert("true"); 
                            return true;
                          }
                    } 
             },
             {
                   input: '#customDispatch', message: 'Please select sale type', action: 'select', 
                   rule: function(input)
                   {

                      if($("#customDispatch").val() == "") 
                        {
                        //  alert("false"); 
                          return false;
                        } 
                        else 
                          {
                          //alert("true"); 
                            return true;
                          }
                    } 
             }*/
          ]
      });
     

      visit_date=$("#visitdate").jqxDateTimeInput('getDate');
      visit_date=convertYdm(visit_date);
     // visit_date=$("#visitdate").jqxDateTimeInput('setDate', null);

           $("#typeofvisit").on('checkChange', function (event)
             {
            //  alert("in function");
                    if (event.args) {
                        var item = event.args.item;
                        if (item) {
/*                            var valueelement = $("<div></div>");
                            valueelement.html("Value: " + item.value);
                            var labelelement = $("<div></div>");
                            labelelement.html("Label: " + item.label);
                            var checkedelement = $("<div></div>");
                            checkedelement.html("Checked: " + item.checked);
                            $("#selectionlog").children().remove();
                            $("#selectionlog").append(labelelement);
                            $("#selectionlog").append(valueelement);
                            $("#selectionlog").append(checkedelement);*/
                            var items = $("#typeofvisit").jqxComboBox('getCheckedItems');
                            var checkedItems = "";
                            $.each(items, function (index) {
                                checkedItems += this.label + ", ";
                             //   alert(" checkedItems "+checkedItems);
                            });
                            $("#checkedItemsLog").text(checkedItems);
                        }
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
          $('#hdn_moc_id').val(moc_id);
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
      
          /*$('#visitdate').on('change', function (event) 
          {  
              var jsDate = event.args.date; 
                jsDate=convertYdm(jsDate);
              
                  $.ajax({
                        type: "POST",
                        url:  baseurl+'dailycall/checkdate/'+jsDate+'/'+customername+'/'+exe_name,
                        data: 'visit_date='+jsDate+'&exe_name='+exe_name+'&customername='+customername,
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

                              validateTempitemname.html(response.msg);
                          }
                     })     

          }); */

     $("#saverecord").click(function () 
    {
      saveallrecord();
      

  });


      function saveallrecord()
      {
            $(".jqx-grid-validation, .jqx-grid-validation-arrow-up, .jqx-grid-validation-arrow-down").remove();

            var rowscount = $("#custprodgrid").jqxGrid('getdatainformation').rowscount;
            var col_count = $("#custprodgrid").jqxGrid('columns').records.length;
         //   alert(" rowscount "+rowscount);
            var rowscount_pm = $("#jqxpersonmet1").jqxGrid('getdatainformation').rowscount;
            var col_count_pm = $("#jqxpersonmet1").jqxGrid('columns').records.length;
          var valid_actionpts =0;
          var valid_duedate =0;
         
          
            var griddata;
            var data = {};
            var dataAdapter_break_relativity;
            var rows = $('#custprodgrid').jqxGrid('getrows');
            var formated_due_date;
          //  alert(" no of  rows "+rowscount);
            for (var i = 0; i < rowscount; i++)
            {
              var rowval;
              var rowstr;
                 var fromlead;
               griddata = $('#custprodgrid').jqxGrid('getrowdata', i);
           //   alert(" dct_salestype_id is "+griddata.dct_salestype_id);
                   due_date = $("#custprodgrid").jqxGrid('getcellvalue',i,'due_date');
               //    alert(" due_date "+i+" is "+due_date);
                   formated_due_date=convert(due_date);
            //       alert(" due_date after convert "+i+" is "+formated_due_date);
               //   alert(" leadid "+i+"th row is "+griddata.leadid);
                //  alert(" status "+i+"th row is "+griddata.dct_prodstatusid);
                 // alert(" substatus "+i+"th row is "+griddata.dct_prodsub_stsid);
                  
              if ((griddata.from_lead=0) || (griddata.from_lead=='undefined'))
                {
                  fromlead=0;
                }
                else
                {
                  fromlead=griddata.from_lead;
                }

                   var acpts_value = $('#custprodgrid').jqxGrid('getcellvalue', i, "actionpoints");
                 //  alert("acpts_value "+acpts_value);
                  if (acpts_value ==null || acpts_value == 'undefined' ) 
                  {
                        $("#custprodgrid").jqxGrid('showvalidationpopup', i, "actionpoints", "Please Select the action Points");
                         valid_actionpts =0;
                        break;
                  }
                  else
                  {
                      valid_actionpts =1;  
                  }
                  
                   var due_date_valid = $('#custprodgrid').jqxGrid('getcellvalue', i, "due_date");
               //    alert("acpts_value "+due_date_valid);
                  if (due_date_valid ==null || due_date_valid == 'undefined' ) 
                  {
                        $("#custprodgrid").jqxGrid('showvalidationpopup', i, "due_date", "Please Select the Due Date");
                         valid_duedate =0;
                        break;
                  }
                  else
                  {
                      valid_duedate =1;  
                  }  


              var start_str ="{";


              var json_str="\"productname\":\""+griddata.dct_prodname+"\",\"leadid\":\""+griddata.leadid+"\",\"dct_detail_id\":\""+griddata.dct_detail_id+"\",\"status_id\":\""+griddata.dct_prodstatusid+"\",\"substatus_id\":\""+griddata.dct_prodsub_stsid+"\",\"dct_prodid\":\""+griddata.dct_prodid+"\",\"dct_quantity\":\""+griddata.dct_quantity+"\",\"prod_type_id\":\""+griddata.prod_type_id+"\",\"dct_salestypename\":\""+griddata.dct_salestypename+"\",\"bulk\":\""+griddata.bulk+"\",\"small_packing\":\""+griddata.small_packing+"\",\"part_tanker\":\""+griddata.part_tanker+"\",\"single_tanker\":\""+griddata.single_tanker+"\",\"intact\":\""+griddata.intact+"\",\"repack\":\""+griddata.repack+"\",\"total_potential\":\""+griddata.total_potential+"\",\"dct_description\":\""+griddata.dct_description+"\",\"dct_sales\":\""+griddata.dct_sales+"\",\"dct_actionplanned\":\""+griddata.dct_actionplanned+"\",\"dct_collection\":\""+griddata.dct_collection+"\",\"dct_actionplanned\":\""+griddata.dct_actionplanned+"\",\"dct_statuory\":\""+griddata.dct_statuory+"\",\"actionpoints\":\""+griddata.actionpoints+"\",\"due_date\":\""+formated_due_date+"\",\"discussion_points\":\""+griddata.discussion_points+"\",\"market_information\":\""+griddata.market_information+"\"";

              var end_str ="}";
              rowstr =start_str+json_str+end_str;
              rowval = rowval+rowstr+",";
            }
            
             rowval =rowval.replace("undefined","");
             rowval = rowval.substring(0, rowval.length - 1);
             grid_row_data ="["+rowval+"]";
//START for storing personmet1 griddata

        for (var i = 0; i < rowscount_pm; i++)
            {
              var rowval_pm;
              var rowstr_pm;
                 var fromlead;
               griddata_pm = $('#jqxpersonmet1').jqxGrid('getrowdata', i);
        
             var start_str_pm ="{";

     /*         var json_str_pm="\"contactperson\":\""+griddata_pm.contact_persion+"\",\"designation\":\""+griddata_pm.designation+"\",\"contact_mailid\":\""+griddata_pm.contact_mailid+"\",\"cust_id\":\""+customerid+"\",\"contact_no\":\""+griddata_pm.contact_no+"\",\"mail_alerts\":\""+griddata_pm.mailalert_id+"\"";*/

         var json_str_pm="\"leadid\":\""+griddata_pm.leadid+"\",\"contactperson\":\""+griddata_pm.contact_person+"\",\"cust_id\":\""+griddata_pm.cust_id+"\",\"designation\":\""+griddata_pm.designation+"\",\"deptname\":\""+griddata_pm.deptname+"\",\"contact_mailid\":\""+griddata_pm.contact_mailid+"\",\"contact_no\":\""+griddata_pm.contact_no+"\",\"mobile_no\":\""+griddata_pm.mobile_no+"\",\"soc_mail\":\""+griddata_pm.soc_mail+"\",\"payment_mail\":\""+griddata_pm.payment_mail+"\",\"general_mail\":\""+griddata_pm.general_mail+"\",\"quotation_mail\":\""+griddata_pm.quotation_mail+"\",\"dispatch_mail\":\""+griddata_pm.dispatch_mail+"\",\"personmet\":\""+griddata_pm.personmet+"\"";

              var end_str_pm ="}";

              rowstr_pm =start_str_pm+json_str_pm+end_str_pm;
              rowval_pm = rowval_pm+rowstr_pm+",";
            }
              rowval_pm =rowval_pm.replace("undefined","");
             rowval_pm = rowval_pm.substring(0, rowval_pm.length - 1);
             hdn_grid_row_data_pm ="["+rowval_pm+"]";
//START for storing personmet1 griddata

            $('#hdn_grid_row_data').val(grid_row_data);
            $('#hdn_grid_row_data_pm').val(hdn_grid_row_data_pm);
            $('#add_leaddailycall').jqxValidator('validate', validationResult);

      var validationResult = function (isValid) 
      {
       if (isValid) 
       {
        
            if (valid_actionpts==0)
             {
                return false;
             }
             if (valid_duedate==0)
             {
                return false;
             }
           //   alert(" datevalidation "+datevalidation);
            if(datevalidation)
            {
              $("#add_leaddailycall").submit();
            }
          
        }
      }
      $('#add_leaddailycall').jqxValidator('validate', validationResult);
    }
    
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

  
function getleadsubstatus(statusvalue)
{
/*
   

   return */ source_break_format =
                        {
                            datatype: "json",
                            datafields: [
                                {name: 'id', type: 'string'},
                                {name: 'value', type: 'string'}
                            ],
                            id: 'id',
                            url: base_url+"dailycall/dcgetleadsubstatusgrid/"+statusvalue+"/"+leadid
                        };
                        return source_break_format;


                        var dataAdapter_break_relativity = new $.jqx.dataAdapter(source_break_format);

}
/*
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
                    url: base_url+"dailycall/dcgetleadsubstatusgrid/"+option+"/"+leadid, 
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
              });*/

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
    $("#jqxcustomergridsoc").jqxGrid(
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
              { text: 'Customer Name', datafield: 'customer_name',  cellsalign: 'left',width:200 },
              { text: 'Customer Number', datafield: 'customer_number', cellsalign: 'left',width:100 }
               ]
  });
       $("#jqxcustomergridsoc").on('celldoubleclick', function (event) 
       {
            var column = event.args.column;
            var rowindex = event.args.rowindex;
            var  jqxcustomergrid_row_index=rowindex;

            var columnindex = event.args.columnindex;
            var columnname = column.datafield;
            //  var hiddid = $("#hdnselid").val();

            //var custgroup_val = $('#jqxcustomergrid').jqxGrid('getcellvalue', rowindex, "cust_account_id");
            var custgroup_val = $('#jqxcustomergridsoc').jqxGrid('getcellvalue', rowindex, "crm_soc_no");


            $('#txtLeadsoc').val(custgroup_val);
            $('#jqxsoc').jqxWindow('hide');
            //  window.close();
               
      });


  $("#jqxcustomergridsoc").on("cellselect", function (event)
          {
                var column = event.args.column;
                var rowindex = event.args.rowindex;
                var jqxcustomergrid_row_index=rowindex;
              
                var columnindex = event.args.columnindex;
                var columnname = column.datafield;

                var custgroup_val = $('#jqxcustomergridsoc').jqxGrid('getcellvalue', rowindex, "crm_soc_no");

          });
/* Code of getting soc popup window end*/


/* person met grid  start */
 
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
                     //     alert("in mailtypeAdapter "+mailType.mailalert_id);
                          data.push(contactPerson);
                     }
                      return data;
                  }
            });

/* End of dropdown values for the contactperson */



      var dataAdapter = new $.jqx.dataAdapter(sourcepersonmet);
      

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

/*Toolbar functions for Personmet END*/



/* personmet1 grid  start */
 var sourcepersonmet =
            {
              
                datatype: "json",
                sortcolumn: 'contact_person',
                sortdirection: 'asc',
                datafields: 
                [

           
                        {name:'leadid', type:'int'}, 
                        {name:'cust_id', type:'int'},
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


        var cellbeginedit = function (row, datafield, columntype, value) {
                var value = $('#jqxpersonmet1').jqxGrid('getcellvalue', row, "personmet");
              //  alert("value"+value);
                if(value=='true')
                 { return true; }
                 else
                  {return false;}
                };


      var dataAdapter = new $.jqx.dataAdapter(sourcepersonmet);
      $("#jqxpersonmet1").jqxGrid(
      {
            width: '100%',
            source: dataAdapter,
            theme: theme,
            selectionmode: 'singlerow',
            sortable: true,
            pageable: true,
            columnsresize: true,
            showfilterrow: false,
            filterable: true,
            editable:true,
            columns: 
            [

           
                   /*
                  { text: 'Cust ID', dataField: 'cust_id', width: 50,editable:false,hidden:true },
                  { text: 'Customer Name', dataField: 'customer_name', width: 200,editable:false,hidden:true },*/
                  { text: 'leadid', dataField: 'leadid', width: 50,editable:false,hidden:false },
                  { text: 'Cust ID', dataField: 'cust_id', width: 50,editable:false,hidden:false },
                   { text: 'Person Met',datafield: 'personmet', threestatecheckbox: false, columntype: 'checkbox', width:90},
                  { text: 'Contact Name', dataField: 'contact_person', width: 150,editable:cellbeginedit},
                  { text: 'Designation', dataField: 'designation', width: 100,cellsalign: 'left' ,hidden:false,editable:cellbeginedit},
                   { text: 'Dept', width: 150,datafield: 'deptname',displayfield: 'deptname', cellsalign: 'left', columntype:'dropdownlist',
                            createeditor: function (row, cellvalue, editor) 
                            {
                               editor.jqxDropDownList({ source: ["ACCOUNTS","DESPATCH","PURCHASE"] });
                            }
                   },
                  { text: 'Email-Id', dataField: 'contact_mailid',width: 220,editable:cellbeginedit},
                  { text: 'Phone No', dataField: 'contact_no',width: 150, cellsalign: 'left',editable:cellbeginedit},
                  { text: 'Mobile No', dataField: 'mobile_no',width: 150, cellsalign: 'left',editable:cellbeginedit},
                  { text: 'General', datafield: 'general_mail', threestatecheckbox: false, columntype: 'checkbox', width: 50 },
                  { text: 'SOC', datafield: 'soc_mail', threestatecheckbox: false, columntype: 'checkbox', width: 50 },
                  { text: 'Payment', datafield: 'payment_mail', threestatecheckbox: false, columntype: 'checkbox', width: 50 },
                  { text: 'Dispatch', datafield: 'dispatch_mail', threestatecheckbox: false, columntype: 'checkbox', width: 50 },
                  { text: 'Quotation', datafield: 'quotation_mail', threestatecheckbox: false, columntype: 'checkbox', width: 50 },
                  { text: 'Dispatch', datafield: 'dispatch', threestatecheckbox: false, columntype: 'checkbox', width: 50 },


                  /*{ text: 'Actual Achieved(MT/Annum)', dataField: 'annualpotential', width: 200, cellsalign: 'left' },*/
            ], 
            showtoolbar: true,
            autoheight: true,
            rendertoolbar: toolbarPerMetfunc1
      });
        $("#jqxpersonmet1").on("celldoubleclick", function (event)
          {
                var column = event.args.column;
                var rowindex = event.args.rowindex;
                jqxgrid_add_row_index=rowindex;
                jqxgrid_n_row_index=rowindex;
                var columnindex = event.args.columnindex;
                var columnname = column.datafield;
                if (columnname=='contact_person')
                {
                
                    var contact_leadid = $('#jqxpersonmet1').jqxGrid('getcellvalue', rowindex, "leadid");
                
                    if(contact_leadid==null || contact_leadid==undefined)
                    {
                      alert("Please select the Contact first");
                    } 

                  var url =  base_url+'dailycall/getleadcontacts/'+escape(contact_leadid);
                  $.ajax({
                     dataType: "html",
                      url: url, 
                      type: "POST",
                      async: false,
                        error: function (xhr, status) {
                            alert("check "+status+" test");
                        },
                        success: function (result) {
                          var obj = jQuery.parseJSON(result);
                          rows = obj.rows;
                        // alert("rows "+rows.toSource());
                      designation = rows[0].designation;
                      //designation = rows.designation;
                      alert("designation "+designation);
                        }
                  //potential_quantity = rows[0].potential;
                  });
                 
              $("#jqxpersonmet1").jqxGrid('setcellvalue', jqxgrid_add_row_index, "designation", designation);
                }
 

              });

/* personmet1 grid end*/

/* Toolbar functions for personmet1 grid START */

            var toolbarPerMetfunc1 = function (toolbar)
            {
              var me = this;
              var theme = 'darkblue';
           //     alert("theme "+theme);

              var containerpm = $("<div style='width:200px; margin-top: 6px;  ' id='jqxWidgetpm'>Edit Contact Details</div>");
              var spanpm = $("<span style='float: left; margin-top: 5px; margin-right: 4px;'></span>");
              var startdivpm =$("<div style='width:800px;'> Contact Details");
              var addlogpm = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='add_person_row'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 100px; height: 22px;' value='Add Row' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
              var deleterowpm = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='deletepersonrow'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 100px; height: 22px;' value='Delete Row' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
              var saverecord = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='jqxbtnSaverecord'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 100px; height: 22px;' value='Save Record' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");

              var enddiv =$("</div>");
              toolbar.append(containerpm);

              
              containerpm.append(addlogpm);
              containerpm.append(deleterowpm);
              containerpm.append(saverecord);
          } // toolbar functions End
$("#jqxpersonmet1").jqxGrid({ rendertoolbar: toolbarPerMetfunc1}); 
/*Toolbar functions for Personmet END*/


/* add row  toolbar functions for personmet START*/
$("#add_person_row").bind('click', function () {
              var commit = $("#jqxpersonmet1").jqxGrid('addrow', null, {});
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
                               { name: 'leadid',type:'int' },
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
                var selectedrowindex = $("#jqxpersonmet1").jqxGrid('getselectedrowindex');
                var rowscount = $("#jqxpersonmet1").jqxGrid('getdatainformation').rowscount;
                 if (selectedrowindex <0 )
                {
                  alert("Please Select a Row to Delete");
                  return false;
                }

                if (selectedrowindex >= 0 && selectedrowindex < rowscount) 
                {
                  var id = $("#jqxpersonmet1").jqxGrid('getrowid', selectedrowindex);
                   var dct_cust_id = $("#jqxpersonmet1").jqxGrid('getcellvalue', selectedrowindex,'cust_id');
             //     alert("del id "+id);
                //  alert("dct_detail_id "+dct_detail_id);
                   if(dct_cust_id!='undefined')
                   {
                      $("#add_leaddailycall").append('<input type="hidden" name="delepm_val[]" value="'+dct_cust_id+'">');
                   }
                     
                  $("#jqxpersonmet1").jqxGrid('deleterow', id);
                }
                
            });
 $("#jqxbtnSaverecord").bind('click', function () {
             saveallrecord();
          });

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
         
      <div>
             <!-- start for add Dc -->
      <div id='dailycall' style="width=100%; height: 100%;">
            <div>Customer Group: <?php echo $customergroup;?> </div>
            <div>
                  <form class="form" id="add_leaddailycall" name="add_leaddailycall"  method="post" action="<?= base_url()?>dailycall/update_lead_dailycall">
                       <table border="0">
                  <tr>
                      <td colspan="8" height="5px"></td>
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
<!--  -->                      
                    </tr>
                 <!--   <tr>
                        <td colspan=2> Select the status </td>
                          <td colspan=2>
                          
                    <?php   
                    echo form_dropdown('leadstatus', $optionslst, set_value('leadstatus', (isset($leadstatusid)) ? $leadstatusid : ''),'id="leadstatus"');   
                        echo form_error('leadstatus');   ?>  

 

                        </td>
                   
                        <td colspan=2> Select the substatus
                        </td >
                          <td colspan=2>
                          
                 <?php   
                     echo form_dropdown('leadsubstatus', $optionslsubst, set_value('leadsubstatus', (isset($ldsubstatus)) ? $ldsubstatus : ''), 'id="leadsubstatus"','name="leadsubstatus"');      
                        echo form_error('leadsubstatus');   ?> 
                      
                        </td>
                      </tr> -->
                      

                      <!--  -->
                      <div id='content' style="display: none">
        <div>
          <input type="text" name="txtLeadsoc" id="txtLeadsoc" style="display: none" readonly="true" placeholder="Get SOC Number">
        </div>
        <div id='jqxsoc' style='width:550 px; height:215px;'>
          <div> Select the SOC Number</div>
            <div>
              <div id="jqxcustomergridsoc" style='width:550px; height:215px;'></div>
            </div>
            <input type="hidden" id="hdnselid" value="<?=$this->uri->segment(3);?>">
        </div>
    </div>
                

                                  </tbody>

                                  </table>
                                  <span  style="float: right; right: 50px; top: 166px; position: absolute;"></span>
                                  <table width="90%" border=0 id="dataTable">
                                    <tbody>
                                    <tr>
                                      <td  width="100%">
                                      <div id="jqxpersonmet1"  style="width:100%;"></div>
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
                    <th colspan="9" class="blockHeader">Sales Details</th>
                  </tr>
                 <tr>
                    <td class="fieldLabel narrowWidthType" colspan="9">
                      
                      <div id="custprodgrid"></div> 
<!-- Select itemmaster popup start -->
                  <div id="win_selectItemMaster" style="width: 50%" >
                     <span id="validateProductName"></span>
                      <div style="margin: 10px">
                            <div id="jqxgrid_selectItemMaster" style="width: 400px;"></div>
                            <div style='max-width: 300px; margin-top: 20px;' id="checkedItemsLog"></div>
                      </div>
                  </div>
<!-- Select Itemmaster popup end -->


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
  <!-- Select customer popup start -->
                               <div id="win_selectcustomer" style="width:50%" >
                                       <span id="validatecustomername"></span>
                                        <div style="margin: 10px">
                                              <div id="jqxgrid_selectcustomer" style="width:400px;">
                                                       
                                              </div>
                                        </div>
                                    </div>
                                     <table>
                                                            <tbody>
                                                           <tr>
                                                              <td>
                                                               
                                                                <input type="button" value="Save Record" id="saverecord" name="saverecord" />
                                                              </td>
                                                          </tr>
                                                        </tbody>
                                                        </table>   
<!-- Select customer popup end --> 

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
                        <input type="hidden" id="hdncustomerid" name="hdncustomerid" value="<?php echo $customerid;?>">
                        <input type="hidden" id="hdnleadid" name="hdnleadid" value="<?php echo $leadid;?>"> 
                        <input type="hidden" id="hdn_status_id" name="hdn_status_id" value="<?php echo $leadstatusid; ?>">
                        <input type="hidden" id="hdn_sub_status_id" name="hdn_sub_status_id" value="<?php echo $ldsubstatus; ?>">

                        <input type="hidden" data-value="" name="hdn_leadid" id="hdn_leadid" value="<?php echo $leadid;?>">
                        <input type="hidden" data-value="" name="hdn_customerid" id="hdn_customerid" value="<?php echo $customerid;?>">
                        <input type="hidden" data-value="" name="hdncustomergroup" id="hdncustomergroup" value="<?php echo $customergroup;?>">
                        <input type="hidden" id="hdn_cmnts" name="hdn_cmnts" value="<?php echo $customerinfo['0']['description']; ?>">
                        <input type="hidden" id="hdn_status_id" name="hdn_status_id" value="<?php echo $customerinfo['0']['leadstatusid']; ?>">
                        <input type="hidden" id="hdn_assign_to" name="hdn_assign_to" value="<?php echo $customerinfo['0']['assignleadchk']; ?>">
                        <input type="hidden" id="hdn_sub_status_id" name="hdn_sub_status_id" value="<?php echo $customerinfo['0']['leadsubstatusid']; ?>">
                          <input type="hidden" id="hdn_mocname" name="hdn_mocname">
                          <input type="hidden" id="hdn_moc_id" name="hdn_moc_id">
                          <input type="hidden" id="hdn_grid_row_data" name="hdn_grid_row_data">
                          <input type="hidden" id="hdn_grid_row_data_pm" name="hdn_grid_row_data_pm">
                         </td>
                          
                      <td width=""></td>
                      </tr>
                      </tbody>
                    </table>
                
                   
<!-- hidden table end -->
                  </form>
            </div>

      </div>
              
           
            </div>
            
                  

                
                  
            
            
        </form>
<!-- End of Grid content -->		

         

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
