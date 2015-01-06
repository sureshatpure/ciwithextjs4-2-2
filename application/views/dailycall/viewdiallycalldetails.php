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
          editable:true,
          sortable: true,
          pageable: true,
          columnsresize: true,
          sortable: true,
          showfilterrow: true,
          filterable: true,
          showtoolbar: true,
          rendertoolbar: toolbarfunc,
           columns: [
                            { text: 'HdrId', datafield: 'id', width: 50, cellsalign: 'left', hidden:false },
                            { text: 'Customer Name', datafield: 'custgroup', width: 200, editable: false },
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

           

/* Start of toolbarfunc*/

var toolbarfunc = function (toolbar) {
                var me = this;
                var theme = 'energyblue';
              //  alert("theme "+theme);
              var dataadd = {};
              var jqxgrid_add_row_index;
          var jqxgrid_n_row_index;
            
                var container = $("<div style='width:200px; margin-top: 6px;' id='jqxWidget'></div>");
                var span = $("<span style='float: left; margin-top: 5px; margin-right: 4px;'></span>");
                var startdiv =$("<div>");
                var addnewrow = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='update_add_row'><input id='update_add_rowbtn'  class='jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-normal jqx-fill-state-normal-energyblue' type='button' class='jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-normal jqx-fill-state-normal-energyblue' value='Add New Row' /></a>");
                var deleterow= $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='jqxbtndeleterow'><input id='update_delete_row' type='button' class='jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-normal jqx-fill-state-normal-energyblue' value='Delete Selected Row' /></a>");
                var viewlead = $("<a role='button' class='jqx-link ' style='margin-left: 25px;' target='_blank' href='#' id='jqxButtonView'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 79px; height: 22px;' value='View' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");

                var update = $("<a style='margin-left: 25px;' href='#' id='jqxButtonupdate'><input id='update_data'  class='jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-normal jqx-fill-state-normal-energyblue'  type='button' value='Update' /></a>");
                var statusupdate = $("<a style='margin-left: 25px;' target='' href='#' id='jqxButtonUpdate'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 88px; height: 22px;' value='Update' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
                var enddiv =$("</div>");
                toolbar.append(container);
                container.append(span);
                container.append(startdiv);
                container.append(addnewrow);
                container.append(deleterow);
                container.append(update);
               // container.append(statusupdate);

                addnewrow.on('click', function (event) 
                {
                //alert("in addnewrow");
                 var commit = $("#jqxgrid_view").jqxGrid('addrow', null, {});

                });


                var generaterow = function (i) {
                    var row = {};
                          row["id"] = '';
                          row["itemgroup"] = '';
                          row["customgroup"] = '';
                          row["subactivity"] = '';
                          row["balqnty"] = '';
                          row["created_date"] ='';
                          row["division"] ='';
                          row["potentialqty"] = '0';
                          row["customgroup"] = '';
                          row["balqnty"] = '';
                          row["created_date"] ='';
                          row["description"] ='';
                          row["actionplanned"] ='';
                          row["detailed_description"] ='';
                 return row;

                }

               
                for (var i = 0; i < 1; i++) {
                var row = generaterow(i);
                dataadd[i] = row;

                }  

                var addgridsource =
                {
                    datatype: "local",
                    cache: false,
                    datafields: [
                                    { name: 'id' },
                                    { name: 'CustGroup', type: 'string' },
                                    { name: 'ItemGroup', type: 'string' },
                                    { name: 'Potential Quantity', type: 'number' },
                                    { name: 'Sub Activity', type: 'number' },
                                    { name: 'Hour', type: 'date' },
                                    { name: 'minute', type: 'string' },
                                    { name: 'Mode Of Contact', type: 'string' },
                                    { name: 'Division', type: 'string' },
                                    { name: 'Quantity Requirement', type: 'number' },
                                    { name: 'Date of Requirement', type: 'number' },
                                    { name: 'Notes/ Remarks', type: 'string' },
                                    { name: 'Follow up Updation', type: 'string' },
                                    { name: 'Complaints', type: 'string' },
                                     { name: 'Description', type: 'string' },
                                      { name: 'Action Planned', type: 'string' },
                                       { name: 'Detailed Description', type: 'string' },
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

              $("#update_delete_row").bind('click', function () {
                  var selectedrowindex = $("#jqxgrid_view").jqxGrid('getselectedrowindex');
                  var rowscount = $("#jqxgrid_view").jqxGrid('getdatainformation').rowscount;
                    if (selectedrowindex <0 )
                    {
                      alert("Please Select a Row to Delete");
                      return false;
                    }
                    if (selectedrowindex >= 0 && selectedrowindex < rowscount) 
                    {
                      var id = $("#jqxgrid_view").jqxGrid('getrowid', selectedrowindex);
                      $("#jqxgrid_view").jqxGrid('deleterow', id);
                    }
              });

// Start of Update Click function
          $("#update_data").click(function (event)
          {
              $(".jqx-grid-validation, .jqx-grid-validation-arrow-up, .jqx-grid-validation-arrow-down").remove();
                var rowscount = $("#jqxgrid_view").jqxGrid('getdatainformation').rowscount;
                var col_count = $("#jqxgrid_view").jqxGrid('columns').records.length;
                var valid_dtflag=0;
                var valid_pgflag=0;

                var valid_custgrp=0;
                var valid_itemgrp=0;
                var valid_hrs=0;
                var valid_mins=0;
                var valid_moc=0;
                var valid_subact=0;
                var valid_subgrp=0;

                var hdr_id = $('#hdn_hdr_id').val();
                
                for (var k = 0; k < rowscount; k++)
                {

                  var cg_value = $('#jqxgrid_view').jqxGrid('getcellvalue', k, "custgroup");
                    
                  if (cg_value ==null || cg_value == 'undefined' ) 
                  {
                        $("#jqxgrid_view").jqxGrid('showvalidationpopup', k, "custgroup", "Please Select the Customer Group");
                         valid_custgrp =0;
                        break;
                  }
                  else
                  {
                      valid_custgrp =1;  
                  }

                      var subact_value = $('#jqxgrid_view').jqxGrid('getcellvalue', k, "subactivity");
                      
                  if (subact_value ==null || subact_value == 'undefined' ) 
                  {
                        $("#jqxgrid_view").jqxGrid('showvalidationpopup', k, "subactivity", "Please Select the Sub Activity");
                         valid_subact =0;
                        break;
                  }
                  else
                  {
                      valid_subact =1;  
                  }

                   var sub_grp = $('#jqxgrid_view').jqxGrid('getcellvalue', k, "division");
                  if (sub_grp ==null || sub_grp == 'undefined' ) 
                  {
                        $("#jqxgrid_view").jqxGrid('showvalidationpopup', k, "division", "Please select the division");
                         valid_subgrp =0;
                        break;
                  }
                  else
                  {
                      valid_subgrp =1;  
                  }

                  var dt_value = $('#jqxgrid_view').jqxGrid('getcellvalue', k, "date");
                  if (dt_value ==null || dt_value == 'undefined' ) {
                        $("#jqxgrid_view").jqxGrid('showvalidationpopup', k, "date", "Please Select a Date");
                        valid_dtflag =0;
                        break;
                    }
                    else
                    {
                      valid_dtflag =1;  
                    }

                    var hr_value = $('#jqxgrid_view').jqxGrid('getcellvalue', k, "hour_s");
                    if (hr_value ==null || hr_value == 'undefined' ) {
                        $("#jqxgrid_view").jqxGrid('showvalidationpopup', k, "hour_s", "Please Select the Hours");
                        valid_hrs =0;
                        break;
                    }
                    else
                    {
                      valid_hrs =1;  
                    }
                  var mins_value = $('#jqxgrid_view').jqxGrid('getcellvalue', k, "minit");
                    if (mins_value ==null || mins_value == 'undefined' ) {
                        $("#jqxgrid_view").jqxGrid('showvalidationpopup', k, "minit", "Please Select the Minutes");
                        valid_mins =0;

            
                        break;
                    }
                    else
                    {
                      valid_mins =1;  
                    }
                
                  var moc_value = $('#jqxgrid_view').jqxGrid('getcellvalue', k, "modeofcontact");
                  if (moc_value ==null || moc_value == 'undefined' ) {
                        $("#jqxgrid_view").jqxGrid('showvalidationpopup', k, "modeofcontact", "Please Select the Mode of contact");
                        valid_moc =0;
                        break;
                    }
                    else
                    {
                      valid_moc =1;  
                    }
                  
              }
            //  alert (" date flag after k loop "+valid_dtflag);
            //  alert (" Pg flag is after k loop"+valid_pgflag);
            if (valid_custgrp==0)
             {
                return false;
             }                       
             if (valid_dtflag==0)
             {
                return false;
             }

               if (valid_hrs==0)
             {
                return false;
             }
               if (valid_mins==0)
             {
                return false;
             }
               if (valid_moc==0)
             {
                return false;
             }
                if (valid_subact==0)
             {
                return false;
             }
                if (valid_subgrp==0)
             {
                return false;
             }
      
            var currentdate = $('#update_header_date').val();
                  currentdate=  convertYdm(currentdate);
                 // convertYdm(visit_date)
            var griddata;
            var data = {};
            var rows = $('#jqxgrid_view').jqxGrid('getrows');
            for (var i = 0; i < rowscount; i++)
             {

              var rowval = {};
             

              griddata = $('#jqxgrid_view').jqxGrid('getrowdata', i);
              rowval["hdn_hdr_id"]=hdr_id;
              rowval["currentdate"]=currentdate;
              rowval["custgroup"]=griddata.custgroup;
              rowval["itemgroup"]=griddata.itemgroup;
              rowval["potentialqty"]=griddata.potentialqty;
              rowval["subactivity"]=griddata.subactivity;
             // alert("currentdate  "+currentdate);
              rowval["hour_s"]=griddata.hour_s;
              rowval["minit"]=griddata.minit;
              rowval["modeofcontact"]=griddata.modeofcontact;
               rowval["quantity"]=griddata.quantity;
              rowval["division"]=griddata.division;
              var dt_req = griddata.date;
          //     alert("dt_req   "+dt_req);
               if (isNaN(dt_req)) {
            //    alert("invalid userDate");
                 }
                 else
                 {
                    dt_req =convert(dt_req);
                 }
          //    dt_req =convert(dt_req);
         //  alert("dt_req after   "+dt_req);
              rowval["Date"]=dt_req;
              rowval["Remarks"]=griddata.remarks;
              rowval["description"]=griddata.description;
              rowval["actionplanned"]=griddata.actionplanned;
              rowval["detailed_description"]=griddata.detailed_description;
              data[i] = rowval;
             }
       
            var data = "update=true&" + $.param(data);
            $.ajax({
                  dataType: 'json',
                  type: "POST",
                  url: base_url+'dailycall/updateitemmaster',
                  cache: true,
                  data: data,
                  success: function (response) {
                            alert("Record Updated sucessfully ");
                            $('#addWindow').hide();
                            window.location.href=base_url+"dailyactivity"; 
                          },
                 error: function (result) {
                  alert(result.responseText);   
                        }
            });
        });  

        function convert(currentdate)
          {
               var date = new Date(currentdate),mnth = ("0" + (date.getMonth()+1)).slice(-2),day  = ("0" + date.getDate()).slice(-2);
               return [ date.getFullYear(), mnth, day ].join("-");
               //alert([ date.getFullYear(), mnth, day ].join("-"));
          }
          function convertYdm(currentdate)
          {
               var date = new Date(currentdate),mnth = ("0" + (date.getMonth()+1)).slice(-2),day  = ("0" + date.getDate()).slice(-2);
               return [ date.getFullYear(), day, mnth ].join("-");
               //alert([ date.getFullYear(), mnth, day ].join("-"));
          }
// end of Update Click function


              } // End of toolbarfunc function
         $("#jqxgrid_view").jqxGrid({ rendertoolbar: toolbarfunc });    
/* End of toolbarfunc*/

        $('#win_selectItemMaster').hide();
// view grid double click function start
        $("#jqxgrid_view").on("celldoubleclick", function (event)
          {
                var column = event.args.column;
                var rowindex = event.args.rowindex;
                jqxgrid_n_row_index=rowindex;
                jqxgrid_add_row_index=rowindex;
                var columnindex = event.args.columnindex;
                var columnname = column.datafield;
                if (columnname=='itemgroup')
                {
                  $('#win_selectItemMaster').jqxWindow({ theme: 'energyblue', autoOpen: false, width: 400, height: 500, resizable: true,title:'select product' });
                  $('#win_selectItemMaster').jqxWindow('open');
                }
                  
             
          });
// view grid double click function end


// Source for item master grid start
        var url = base_url+"dailyactivity/get_data_itemmaster";
        var rows ={};
         jQuery.ajax({
              dataType: "html",
              url: url,
              type: "POST",
              async: false,
                error: function (xhr, status) {
                  //  alert("check "+status+" test");
                },
                success: function (result) {
                  var obj = jQuery.parseJSON(result);
                  rows = obj.rows;
               //   rows = obj[1].rows;
                //  commonCols=obj[0].columns;
                }
              });
             var item_source =
              {
                  datatype: "json",
                  datafields:[],
                  id: 'itemgroup',
                  localdata: rows
              };
    
              //  alert("columns "+columns.toSource());    
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
                         columns: [
                              { text: 'Product Name', dataField: 'itemgroup', width: 500,height:600 },
                         
                          ]
                      });


// source for item master grid end

//  return value from item master start
        var gl_productname;
        $("#jqxgrid_selectItemMaster").on('cellselect', function (event) {
        //alert("potential quantity "+potential_quantity);
        //     alert("Action Mode "+actionmode);

        var rowindex = $("#jqxgrid_selectItemMaster").jqxGrid('getselectedrowindex', event.args.rowindex);
        var prodName = $("#jqxgrid_selectItemMaster").jqxGrid('getcellvalue', event.args.rowindex,'itemgroup');



     
        //$('#customWindow').jqxWindow('show');  
        $("#jqxgrid_view").jqxGrid('setcellvalue', jqxgrid_n_row_index, "itemgroup", prodName);
      
        gl_productname = $("#jqxgrid_view").jqxGrid('getcellvalue', jqxgrid_n_row_index,'itemgroup');
        
         alert("gl_productname upd "+gl_productname);

        $('#win_selectItemMaster').jqxWindow('close');        

      

        });
//  return value from item master end





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
        <!-- Select itemmaster popup start -->
        <div id="win_selectItemMaster" style="width: 50%" >
            <div style="margin: 10px">
                 <div id="jqxgrid_selectItemMaster" style="width: 400px;">testing</div>
            </div>
        </div>
        <!-- Select Itemmaster popup end -->

         

      
            
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
