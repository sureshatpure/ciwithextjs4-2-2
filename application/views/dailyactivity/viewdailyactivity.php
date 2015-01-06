<!DOCTYPE html>
<html>
<head>
<title>Leads</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="<?= base_url()?>public/css/chosen.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?= base_url()?>public/css/jquery-ui-1.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?= base_url()?>public/css/select2.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?= base_url()?>public/css/bootstrap.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?= base_url()?>public/css/styles.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?= base_url()?>public/css/validationEngine.css">
<link rel="stylesheet" href="<?= base_url()?>public/css/select2.css">
<link rel="stylesheet" href="<?= base_url()?>public/css/guiders-1.css">
<link rel="stylesheet" href="<?= base_url()?>public/css/jquery_002.css">
<link rel="stylesheet" href="<?= base_url()?>public/css/jquery_003.css">
<link rel="stylesheet" media="screen" type="text/css" href="<?= base_url()?>public/css/datepicker.css">
<link rel="stylesheet" href="<?= base_url()?>public/css/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?= base_url()?>public/css/jquery.css" type="text/css" media="screen">
<script type="text/javascript" src="<?= base_url()?>public/js/jquery_007.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/jquery/jqueryui.js"></script>
</head>
<body>

<div id="page"><!-- container which holds data temporarly for pjax calls -->
<div id="pjaxContainer" class="hide noprint"></div>
<div class="navbar navbar-fixed-top  navbar-inverse noprint" style="min-width:1050px">
 <!-- start includes --> 
<?php $this->load->view('menu');?>
<!-- start includes --> 


<!-- jqwidgets scripts -->
<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.base.css" type="text/css" />
<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.energyblue.css" type="text/css" />
<style type="text/css">
    .editedRow {
      color: #b90f0f;
      font-style: italic;
    }
</style>

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
<!-- paging - end -->
<!-- End of jqwidgets -->
<link rel="stylesheet" href="<?= base_url()?>public/jqwidgets/styles/jqx.black.css" type="text/css" />
<script type="text/javascript">
var actionmode;
var base_url = '<?php echo site_url(); ?>';
function _createElements()
{
 // alert("action mode in _createElements  "+actionmode);
// code start for view formdetail window
 $('#customWindow').jqxWindow({ theme: 'energyblue',showCollapseButton: true, autoOpen: false, width:1013,  height: 400, resizable: true,title:'View Daily Call Activity&nbsp;&nbsp;<input id="update_add_row"  class="jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-normal jqx-fill-state-normal-energyblue" type="button" class="jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-normal jqx-fill-state-normal-energyblue" value="Add New Row" />&nbsp;&nbsp;<input id="update_delete_row" type="button" class="jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-normal jqx-fill-state-normal-energyblue" value="Delete Selected Row" />&nbsp;&nbsp;<input id="update_data"  class="jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-normal jqx-fill-state-normal-energyblue"  type="button" value="Update" />',
		initContent: function () {
						              $('#jqxgrid_n').jqxGrid({ disabled: false});
								}
 })

// code start for view formdetail window
 $('#customWindowview').jqxWindow({ theme: 'energyblue',showCollapseButton: true, autoOpen: false, width:1013,  height: 400, resizable: true,title:'View Daily Call Activity',
    initContent: function () {
                          $('#jqxgrid_view').jqxGrid({ disabled: false});
                }
 })
// code end for view formdetail window
// code start for add window
$('#addWindow').jqxWindow({ theme: 'energyblue', autoOpen: false,showCollapseButton: true,  height: 400,width:1024, resizable: true, title:'Add Daily Call Activity&nbsp;&nbsp; <input id="addrowbutton"  class="jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-normal jqx-fill-state-normal-energyblue" type="button" value="Add New Row" />&nbsp;&nbsp;<input id="deleterowbutton"  class="jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-normal jqx-fill-state-normal-energyblue" type="button" value="Delete Selected Row" />&nbsp;&nbsp;<input id="save"  class="jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-normal jqx-fill-state-normal-energyblue" type="button" value="Save Data" />',
		  
		initContent: function () {
						              $('#jqxgrid_add').jqxGrid({ disabled: false,width:1024,theme: 'energyblue'});
								}
 });
// code end for add window
};
$(document).ready(function () 
{
  var theme = "";
            // Create a jqxMenu
            $("#jqxMenu").jqxMenu({ width: '670', height: '30px', theme: 'black' });
            $("#jqxMenu").css('visibility', 'visible');
          
var dhdr_headerid;
var header_date;
var hide_update_button;
var potential_quantity;
var gl_customername;
var gl_productname;
  

        var permission = <?php echo $grpperm; ?>;
        var group_len =   permission.length;
    //    alert("group len "+permission.length);
        if(permission.length==0)
        {
          hide_update_button=1;
        }
         for(i=0;i<permission.length; i++)
                            {
                            // alert(permission[i].groupname);
                             if ( permission[i].groupname =='Edit')
                                {
                                  hide_update_button=0;
                                  break;
                                }
                                else
                                {
                                  hide_update_button=1;
                                }
                            }
                          //  alert("accesright "+hide_update_button);

  var currentdate;
  //$('#jqxgrid_selectItemMaster').hide();
  $('#win_selectItemMaster').hide();
  $('#win_selectCustMaster').hide();
  $("#update_add_row").jqxButton({theme: 'black', width: '150', height: '25'});
    $("#jqxgrid_add").jqxGrid({theme: 'energyblue'});
    _createElements(); // to open custom popup window when edit is clicked
        var theme = "energyblue";
        // prepare the data
        var commonCols = new Array();
        var editedRows = new Array();
        var data = <?php echo $data; ?>;
        
        if (data.length>0)
        {
          var username =data[0].exename;
          var branch =data[0].branch;
        }
        var username ="";
        var branch ="";
       var source =
            {	
                localdata: data,
                datatype: "array",
                datafields:
                [
                    { name: 'id' },
                    { name: 'currentdate', type: 'date' },
                    { name: 'execode', type: 'string' },
                    { name: 'exename', type: 'string' },
                    { name: 'branch', type: 'string' },
                    { name: 'creationdate', type: 'datetime' },
    			        
              ],
              pagenum: 0, pagesize: 35, pager: function (pagenum, pagesize, oldpagenum) {
                    // callback called when a page or page size is changed.
                }
          };
        // initialize the input fields.
        $("#itemgroup").addClass('jqx-input');
        $("#customgroup").addClass('jqx-input');
      
        $("#itemgroup").width(150);
        $("#customgroup").height(23);
     
        if (theme.length > 0) {
            $("#itemgroup").addClass('jqx-input-' + theme);
            $("#customgroup").addClass('jqx-input-' + theme);
      
        }


        var dataAdapter = new $.jqx.dataAdapter(source);
        // initialize jqxGrid
       // alert ("current for udpate "+currentdate);
   //     alert ("hidden update "+hide_update_button);
   $("#username").jqxInput({placeHolder: "User Name", height: 25, width: 200, minLength: 1, theme: theme,disabled: true});
   
  $("#branch").jqxInput({placeHolder: "Branch Name", height: 25, width: 150, minLength: 1, theme: theme,disabled: true});
     
        $("#jqxgrid").jqxGrid(
        {
           
             width: 760,
              height:500,
              source: dataAdapter,
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
              rendertoolbar: toolbarfunc,
              columns: [
              { text: 'ID', datafield: 'id', width: 60 },
              {
                  text: 'Date', datafield: 'currentdate',  columntype: 'datetimeinput', width: 110, align: 'left', cellsalign: 'left', cellsformat: 'd',formatString: 'd'
              /* , validation: function (cell, value) {
                      if (value == "")
                         return true;

                      var year = value.getFullYear();
                      if (year >= 2014) {
                          return { result: false, message: "Ship Date should be before 1/1/2014" };
                      }
                      return true;
                  }*/
              },
              { text: 'User Code', columntype: 'dropdownlist',filterable:'enable',  datafield: 'execode', width: 75 },
              { text: 'User Name', datafield: 'exename', width: 150, cellsalign: 'left' },
              { text: 'Branch', datafield: 'branch', width: 150, cellsalign: 'left' },
              { text: 'Created Date', datafield: 'creationdate',  columntype: 'datetimeinput', width: 110, align: 'left', cellsalign: 'left', cellsformat: 'd',formatString: 'd'},
              { text: 'Update', cellsalign: 'center',datafield: 'Update',filterable:false, width: 100, hidden:hide_update_button, columntype: 'button', cellsrenderer: function () {
                 return "Update";
              }, buttonclick: function (row) 
                              			{ // popup function start
                                                  actionmode ="update";
                              				var rowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                              				var headerid = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'id');
                                                  header_date = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'currentdate');
                                                  username = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'exename');
                                                   branch = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'branch');

                                                  dhdr_headerid =headerid;

                                                  $('#username').jqxInput('val', username);
                                                  $('#branch').jqxInput('val', branch);
                                                
                                                  var t= $('#hdn_hdr_id').val();
                                                
                                                  $('#hdn_hdr_id').val(dhdr_headerid);
                                                  var g= $('#hdn_hdr_id').val();
                                                
                              				var rows =new Array();
                              				var columns =new Array();
                              				jQuery.ajax({
                              				dataType: "html",
                              				url: 'dailyactivity/get_edit_data/'+headerid,
                              				type: "POST",
                              				async: false,
                              					error: function (xhr, status) {
                              							alert("check "+status+" test");
                              					},
                              					success: function (result) {
                              						var obj = jQuery.parseJSON(result);
                              						columns = obj[0].columns;
                              						rows = obj[1].rows;
                                                              
                              						commonCols=obj[0].columns;
                              					}
                              				});

                              				var source =
                              				{
                              					datatype: "json",
                              					datafields:[],
                              					id: 'id',
                              					localdata: rows
                              				};
                                    
                              				var dataAdapter = new $.jqx.dataAdapter(source);
                                                  
                                             
                                      /*  $("#update_header_date").jqxDateTimeInput({ width: '250px', height: '25px', theme: 'summer',formatString:'d',readonly: true});
                                        $("#update_header_date").jqxDateTimeInput('setDate',new Date(header_date));
                                         $("#update_header_date").jqxDateTimeInput('destroy'); */
                                          //$("#input").jqxInput({  height: 25, width: 200, minLength: 1, source: countries });
                                          header_date=convert(header_date);

                                          $('#update_header_date').jqxInput({ width: '100px', height: '25px',disabled: true});
                                          
                                          $('#update_header_date').val(header_date);
                                        
                              				$("#jqxgrid_n").jqxGrid(
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
                              					 columns: [
                                                                          { text: 'UID', datafield: 'id', width: 150, cellsalign: 'left', hidden:true },
                                                                          { text: 'Customer Group', datafield: 'custgroup', width: 150, editable: false },
                                                                          { text: 'Product Group', datafield: 'itemgroup', width: 150, cellsalign: 'left',editable: false },
                                                                          { text: 'Potential', datafield: 'potentialqty', width: 75, cellsalign: 'left',editable: false},
                                                                          { text: 'Required Quantity', datafield: 'quantity', width: 75, cellsalign: 'left' },
                                                                           { text: 'Type', datafield: 'division', width: 150, cellsalign: 'left', columntype:'dropdownlist',
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
                                                                           { text: 'Mode of Contact', datafield: 'modeofcontact', width: 100, cellsalign: 'left', columntype:'dropdownlist',
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
                                                                          { text: 'Notes / Remarks', datafield: 'remarks', width: 150, cellsalign: 'left' },
                                                                          { text: 'Description', datafield: 'description', width: 150, cellsalign: 'left' },
                                                                          { text: 'Action Planned', datafield: 'actionplanned', width: 150, cellsalign: 'left' },
                                                                          { text: 'Detailed Description', datafield: 'detailed_description', width: 150, cellsalign: 'left' },
                                                                  
                                                                        ]
                              				});

                                     	$('#customWindow').jqxWindow('open');
                                      $('#customWindow').jqxWindow({width:"100%"});
                                    

                                   } // end of popup edit button click event
             },
							
            ]

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
							var addlog = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='jqxButtonadd'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 65px; height: 22px;' value='Add' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
              var view = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='jqxButtonview'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 65px; height: 22px;' value='View' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");
               /*var update = $("<a role='button' class='jqx-link jqx-link-energyblue' style='margin-left: 25px;' target='' href='#' id='jqxButtonupdate'><input type='button' class='jqx-wrapper jqx-reset jqx-reset-energyblue jqx-rc-all jqx-rc-all-energyblue jqx-button jqx-button-energyblue jqx-widget jqx-widget-energyblue jqx-fill-state-pressed jqx-fill-state-pressed-energyblue' style='width: 65px; height: 22px;' value='Update' id='jqxWidget09c6ffa4' role='button' aria-disabled='false'></a>");*/

					var enddiv =$("</div>");
					toolbar.append(container);
					container.append(addlog);
                            container.append(view);


                          
              //  container.append(enddiv);

					addlog.on('click', function (event) 
						{
						//$('#jqxgrid_add').jqxGrid('clear');	
                                  actionmode="add";
           	                       $('#addWindow').jqxWindow('open');
                                  $('#addWindow').jqxWindow({width:"100%"});
                                 });
                       view.on('click', function (event) 
                            {
                            actionmode="view";
                            var rowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                            var cellindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                            var headerid = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'id');
                          //  alert("Link button pressed");
                   //         alert("action mode "+actionmode);
                           // alert("headerid "+headerid);
                                if (headerid==null)
                                {
                                  alert("Please Select a row");   
                                //  $('#jqxButton').attr('href','http://google.com');
                                  return false;
                    
                                }
                                else
                                {
                                 // $('#jqxButton').attr('href',baseurl+'leads/viewleaddetails/'+leadid); 
                                 
                                  jQuery.ajax({
                                      dataType: "html",
                                      url: 'dailyactivity/get_edit_data/'+headerid,
                                      type: "POST",
                                      async: false,
                                        error: function (xhr, status) {
                                            alert("check "+status+" test");
                                        },
                                        success: function (result) {
                                          var obj = jQuery.parseJSON(result);
                                          columns = obj[0].columns;
                                          rows = obj[1].rows;
                                                              
                                          commonCols=obj[0].columns;
                                        }

                                      });
                                     
                                      var source =
                                      {
                                        datatype: "json",
                                        datafields:[],
                                        id: 'id',
                                        localdata: rows
                                      };
                                      header_date = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'currentdate');
                                      username = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'exename');
                                      branch = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'branch');
                                      

                                      $('#username_vw').val(username);
                                      $('#branch_vw').val(branch);
                                                
                                      $("#username_vw").jqxInput({placeHolder: "User Name", height: 25, width: 200, minLength: 1, theme: theme,disabled: true});
                                     $("#branch_vw").jqxInput({placeHolder: "Branch Name", height: 25, width: 150, minLength: 1, theme: theme,disabled: true});
                                      header_date=convert(header_date);
                                          $('#view_header_date').jqxInput({ width: '100px', height: '25px',disabled: true});
                                          $('#view_header_date').val(header_date);
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
                                                          { text: 'Customer Group', datafield: 'custgroup', width: 200, editable: false },
                                                          { text: 'Product Group', datafield: 'itemgroup', width: 150, cellsalign: 'left',editable: false },
                                                          { text: 'Potential', datafield: 'potentialqty', width: 75, cellsalign: 'left' },
                                                          { text: 'Required Quantity', datafield: 'quantity', width: 75, cellsalign: 'left' },
                                                          { text: 'Sales Type', datafield: 'division', width: 100, cellsalign: 'left', columntype:'dropdownlist',
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
                                                          
                                                         
                                                       
                                                          { text: 'Notes / Remarks', datafield: 'remarks', width: 150, cellsalign: 'left' },
                                                          { text: 'Description', datafield: 'description', width: 150, cellsalign: 'left' },
                                                          { text: 'Action Planned', datafield: 'actionplanned', width: 150, cellsalign: 'left' },
                                                          { text: 'Detailed Description', datafield: 'detailed_description', width: 150, cellsalign: 'left' },
                                                  
                                                        ]
                                      });
                                    
                                      
                                       $('#customWindowview').jqxWindow('open');
                                      $('#customWindowview').jqxWindow({width:"100%"});  
                                }
                              
                            });
// End of View Click button
/* Update button click start*/
               /*   update.on('click', function (event) 
                                  {
                                  var rowindex = $("#jqxgrid").jqxGrid('getselectedrowindex');
                                  var leadid = $("#jqxgrid").jqxGrid('getcellvalue',rowindex,'id');
                                  alert("Update button pressed");
                                  alert("header id "+leadid);
                                      if (leadid==null)
                                      {
                                        alert("Please Select a row");   
                                      //  $('#jqxButton').attr('href','http://google.com');
                                        return false;
                          
                                      }
                                      else
                                      {
                                       // $('#jqxButtonUpdate').attr('href',baseurl+'leads/editstatus/'+leadid);    
                                      }
                                    
                                  });*/
/* Update button click end*/
              };

            $("#jqxgrid").jqxGrid({ rendertoolbar: toolbarfunc });
          // toolbar functions end
          // Source for add grid start
            var dataadd = {};
            var theme = 'classic';
            jQuery.ajax({
              dataType: "html",
              url: 'dailyactivity/get_data_addgrid',
              type: "POST",
              async: false,
                error: function (xhr, status) {
                    alert("check "+status+" test");
                },
                success: function (result) {
                  var obj = jQuery.parseJSON(result);
                  columns = obj[0].columns;
               //   rows = obj[1].rows;
                //  commonCols=obj[0].columns;
                }
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
          var jqxgrid_add_row_index;
          var jqxgrid_n_row_index;
          var dataAdapterAdd = new $.jqx.dataAdapter(addgridsource);
          $("#jqxgrid_add").jqxGrid(
          {
              width: 1093,
              height: 200,
              selectionmode:'rowselect',
              source: dataAdapterAdd,
              theme: theme,
              editable:true,
              columnsresize: true,
              columns: [
              { text: 'UID', datafield: 'uid', width: 150, cellsalign: 'left', hidden:true },
              { text: 'Customer Group', datafield: 'custgroup', width: 100, editable: false },
              { text: 'Product Group', datafield: 'itemgroup', width: 150, cellsalign: 'left',editable: false },
              { text: 'Potential', datafield: 'Potential_Quantity', width: 75, cellsalign: 'left',editable: false},
               { text: 'Required Quantity', datafield: 'Quantity_Requirement', width: 75, cellsalign: 'left' },
              { text: 'Sales Type', datafield: 'division', width: 150, cellsalign: 'left', columntype:'dropdownlist',
              createeditor: function (row, cellvalue, editor) {
                                        editor.jqxDropDownList({ source: ["Tanker","Repacked","Container","Textile","Leather","Paper","Exxon Speciality","Lubricant","Polymer","Pure Speciality","Others"] });
                                    }

              },
              { text: 'Type of Customer/Visit', datafield: 'Sub_Activity',columntype: 'dropdownlist', width: 150, cellsalign: 'left',
               createeditor: function (row, cellvalue, editor) {
                                        editor.jqxDropDownList({ source: ["NEW CUSTOEMR","EXSISTING CUSTOMER","ORDER FOLLOWUP","ORDER AND PAYMENT","TENDER","PAYMENT FOLLOW UP","BALENCE SHEET","TANKER  DIVERTION","INVOICE","PROFORM INVOICE","PAYMENT COLLECTION"] });
                                    }
               },
             
              {text: 'Visited Date', datafield: 'Date', columntype: 'datetimeinput', width: 110, align: 'left', cellsformat: 'd',formatString: 'd',
                  validation: function (cell, value) {
                  if (value =="") {
                  return { result: false, message: "Date is required!" };
                  }
                  return true;
                  }
              },
               { text: 'Mode of Contact', datafield: 'Mode_Of_Contact', width: 100, cellsalign: 'left', columntype:'dropdownlist',
              createeditor: function (row, cellvalue, editor) {
                                        editor.jqxDropDownList({ source: ["E-mail","Phone","Visit"] });
                                    }
              },

              { text: 'Time Spent (Hrs)', datafield: 'hour', width: 75, cellsalign: 'left', columntype:'dropdownlist',
              createeditor: function (row, cellvalue, editor) {
                                        editor.jqxDropDownList({ source: ["00 Hr","01 Hrs","02 Hrs","03 Hrs","04 Hrs","05 Hrs","06 Hrs","07 Hrs","08 Hrs","09 Hrs","10 Hrs"] });
                                    }
               },
              { text: 'Time Spent (Mins)', datafield: 'minute', width: 75, cellsalign: 'left', columntype:'dropdownlist',
              createeditor: function (row, cellvalue, editor) {
                                        editor.jqxDropDownList({ source: ["0 mins","5 mins","10 mins"," 15 mins","20 mins","25 mins","30 mins"," 35 mins","40 mins","45 mins"," 50 mins","55 mins"] });
                                    }
              },
              { text: 'Notes / Remarks', datafield: 'Notes_Remarks', width: 150, cellsalign: 'left' },
              { text: 'Description', datafield: 'description', width: 150, cellsalign: 'left' },
              { text: 'Action Planned', datafield: 'actionplanned', width: 150, cellsalign: 'left' },
              { text: 'Detailed Description', datafield: 'detailed_description', width: 150, cellsalign: 'left' },
      
            ]

          });
          $("#jqxgrid_add").on("celldoubleclick", function (event)
          {
                var column = event.args.column;
                var rowindex = event.args.rowindex;
                jqxgrid_add_row_index=rowindex;
                jqxgrid_n_row_index=rowindex;
                var columnindex = event.args.columnindex;
                var columnname = column.datafield;
                if (columnname=='itemgroup')
                {
                
                    var custgroup_val = $('#jqxgrid_add').jqxGrid('getcellvalue', rowindex, "custgroup");
                
                    if(custgroup_val==null || custgroup_val==undefined)
                    {
                      alert("Please select the Customer Group first");
                    }
                    else
                    {
                        $('#addWindow').hide();
                        $('#win_selectItemMaster').jqxWindow({ theme: 'energyblue', autoOpen: false, width: 400, height: 500, resizable: true,title:'select product' });
                        $('#win_selectItemMaster').jqxWindow('open');
                    }
                 
                }
                  
                if (columnname=='custgroup')
                {
                  $('#addWindow').hide();
                  $('#win_selectCustMaster').jqxWindow({ theme: 'energyblue', autoOpen: false, width: 400, height: 500, resizable: true,title:'Select Customer' });
                  $('#win_selectCustMaster').jqxWindow('open');
                }
          });
           $("#addcurrentdate").jqxDateTimeInput({ width: '250px', height: '25px', theme: 'summer',formatString: 'd' });
           
            $("#addrowbutton").bind('click', function () {
              var commit = $("#jqxgrid_add").jqxGrid('addrow', null, {});
            });

            $("#deleterowbutton").bind('click', function () {
                var selectedrowindex = $("#jqxgrid_add").jqxGrid('getselectedrowindex');
                var rowscount = $("#jqxgrid_add").jqxGrid('getdatainformation').rowscount;
             
                if (selectedrowindex <0 )
                {
                  alert("Please Select a Row to Delete");
                  return false;
                }

                if (selectedrowindex >= 0 && selectedrowindex < rowscount) 
                {
                  var id = $("#jqxgrid_add").jqxGrid('getrowid', selectedrowindex);
                  $("#jqxgrid_add").jqxGrid('deleterow', id);
                }
                
            });

              $("#update_delete_row").bind('click', function () {
                var selectedrowindex = $("#jqxgrid_n").jqxGrid('getselectedrowindex');
                var rowscount = $("#jqxgrid_n").jqxGrid('getdatainformation').rowscount;
                 if (selectedrowindex <0 )
                {
                  alert("Please Select a Row to Delete");
                  return false;
                }
                if (selectedrowindex >= 0 && selectedrowindex < rowscount) 
                {
                  var id = $("#jqxgrid_n").jqxGrid('getrowid', selectedrowindex);
                  $("#jqxgrid_n").jqxGrid('deleterow', id);
                }
            });
            /*$("#addrowbutton").on('click', function () {
                alert("second function");
            });*/
// Start of Save Click function
          $("#save").click(function (event)
          {
              $(".jqx-grid-validation, .jqx-grid-validation-arrow-up, .jqx-grid-validation-arrow-down").remove();
                var rowscount = $("#jqxgrid_add").jqxGrid('getdatainformation').rowscount;
                var col_count = $("#jqxgrid_add").jqxGrid('columns').records.length;
                var valid_dtflag=0;
                var valid_pgflag=0;
                var valid_custgrp=0;
                var valid_itemgrp=0;
                var valid_hrs=0;
                var valid_mins=0;
                var valid_moc=0;
                var valid_subact=0;
                var valid_subgrp=0;

                for (var k = 0; k < rowscount; k++)
                {
                   var cg_value = $('#jqxgrid_add').jqxGrid('getcellvalue', k, "custgroup");
                  if (cg_value ==null || cg_value == 'undefined' ) 
                  {
                        $("#jqxgrid_add").jqxGrid('showvalidationpopup', k, "custgroup", "Please Select the Customer Group");
                         valid_custgrp =0;
                        break;
                  }
                  else
                  {
                      valid_custgrp =1;  
                  }
                  /*var itmgrp_value = $('#jqxgrid_add').jqxGrid('getcellvalue', k, "itemgroup");
                  if (itmgrp_value ==null || itmgrp_value == 'undefined' ) 
                  {
                        $("#jqxgrid_add").jqxGrid('showvalidationpopup', k, "itemgroup", "Please Select the Item Group");
                         valid_itemgrp =0;
                        break;
                  }
                  else
                  {
                      valid_itemgrp =1;  
                  }*/

                  /*var pq_value = $('#jqxgrid_add').jqxGrid('getcellvalue', k, "Potential_Quantity");
                  if (pq_value ==null || pq_value == 'undefined' ) 
                  {
                        $("#jqxgrid_add").jqxGrid('showvalidationpopup', k, "Potential_Quantity", "Please Enter the Potential Quantity");
                         valid_pgflag =0;
                        break;
                  }
                  else
                  {
                      valid_pgflag =1;  
                  }*/


                   var subact_value = $('#jqxgrid_add').jqxGrid('getcellvalue', k, "Sub_Activity");
                  if (subact_value ==null || subact_value == 'undefined' ) 
                  {
                        $("#jqxgrid_add").jqxGrid('showvalidationpopup', k, "Sub_Activity", "Please Select the Sub Activity");
                         valid_subact =0;
                        break;
                  }
                  else
                  {
                      valid_subact =1;  
                  }

                   var sub_grp = $('#jqxgrid_add').jqxGrid('getcellvalue', k, "division");
                  if (sub_grp ==null || sub_grp == 'undefined' ) 
                  {
                        $("#jqxgrid_add").jqxGrid('showvalidationpopup', k, "division", "Please select the Sub Group");
                         valid_subgrp =0;
                        break;
                  }
                  else
                  {
                      valid_subgrp =1;  
                  }



                   var dt_value = $('#jqxgrid_add').jqxGrid('getcellvalue', k, "Date");
                  if (dt_value ==null || dt_value == 'undefined' ) {
                        $("#jqxgrid_add").jqxGrid('showvalidationpopup', k, "Date", "Please Select a Date");
                        valid_dtflag =0;
                        break;
                    }
                    else
                    {
                      valid_dtflag =1;  
                    }
                    var hr_value = $('#jqxgrid_add').jqxGrid('getcellvalue', k, "hour");
                    if (hr_value ==null || hr_value == 'undefined' ) {
                        $("#jqxgrid_add").jqxGrid('showvalidationpopup', k, "hour", "Please Select the Hours");
                        valid_hrs =0;
                        break;
                    }
                    else
                    {
                      valid_hrs =1;  
                    }
                  var mins_value = $('#jqxgrid_add').jqxGrid('getcellvalue', k, "minute");
                    if (mins_value ==null || mins_value == 'undefined' ) {
                        $("#jqxgrid_add").jqxGrid('showvalidationpopup', k, "minute", "Please Select the Minutes");
                        valid_mins =0;

            
                        break;
                    }
                    else
                    {
                      valid_mins =1;  
                    }
                
                  var moc_value = $('#jqxgrid_add').jqxGrid('getcellvalue', k, "Mode_Of_Contact");
                  if (moc_value ==null || moc_value == 'undefined' ) {
                        $("#jqxgrid_add").jqxGrid('showvalidationpopup', k, "Mode_Of_Contact", "Please Select the Minutes");
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
             /* if (valid_itemgrp==0)
             {
                return false;
             }*/
           /*   if (valid_pgflag==0)
             {
                return false;
             }*/
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


            

      
            var currentdate = $('#addcurrentdate').val();
                  currentdate=  convert(currentdate);
            var griddata;
            var data = {};
            var rows = $('#jqxgrid_add').jqxGrid('getrows');
            for (var i = 0; i < rowscount; i++)
             {
              var rowval = {};
              griddata = $('#jqxgrid_add').jqxGrid('getrowdata', i);
              rowval["currentdate"]=currentdate;
              rowval["custgroup"]=griddata.custgroup;
              rowval["itemgroup"]=griddata.itemgroup;
              rowval["potentialqty"]=griddata.Potential_Quantity;
              rowval["subactivity"]=griddata.Sub_Activity;
              //alert("currentdate  "+currentdate);
              rowval["hour_s"]=griddata.hour;
              rowval["minit"]=griddata.minute;
              rowval["modeofcontact"]=griddata.Mode_Of_Contact;
               rowval["quantity"]=griddata.Quantity_Requirement;
              rowval["division"]=griddata.division;
              var dt_req = griddata.Date;
              dt_req =convert(dt_req);
              //alert("dt_req   "+dt_req);
              rowval["Date"]=dt_req;
              rowval["Remarks"]=griddata.Notes_Remarks;
              rowval["description"]=griddata.description;
              rowval["actionplanned"]=griddata.actionplanned;
              rowval["detailed_description"]=griddata.detailed_description;
              data[i] = rowval;
             }
       
            var data = "save=true&" + $.param(data);
            $.ajax({
                  dataType: 'json',
                  type: "POST",
                  url: 'dailyactivity/additemmaster',
                  cache: true,
                  data: data,
                  success: function (response) {
                            alert("Record Added sucessfully ");
                            $('#addWindow').hide();
                            window.location.href=base_url+"dailyactivity"; 
                          },
                 error: function (result) {
                  alert(result.responseText);   
                        }
            });
        });  
// end of Save Click function
  $("#update_add_row").bind('click', function () {
              var commit = $("#jqxgrid_n").jqxGrid('addrow', null, {});
            });
// Start of Update Click function
          $("#update_data").click(function (event)
          {
              $(".jqx-grid-validation, .jqx-grid-validation-arrow-up, .jqx-grid-validation-arrow-down").remove();
                var rowscount = $("#jqxgrid_n").jqxGrid('getdatainformation').rowscount;
                var col_count = $("#jqxgrid_n").jqxGrid('columns').records.length;
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

                  var cg_value = $('#jqxgrid_n').jqxGrid('getcellvalue', k, "custgroup");
                    
                  if (cg_value ==null || cg_value == 'undefined' ) 
                  {
                        $("#jqxgrid_n").jqxGrid('showvalidationpopup', k, "custgroup", "Please Select the Customer Group");
                         valid_custgrp =0;
                        break;
                  }
                  else
                  {
                      valid_custgrp =1;  
                  }

                      var subact_value = $('#jqxgrid_n').jqxGrid('getcellvalue', k, "subactivity");
                      
                  if (subact_value ==null || subact_value == 'undefined' ) 
                  {
                        $("#jqxgrid_n").jqxGrid('showvalidationpopup', k, "subactivity", "Please Select the Sub Activity");
                         valid_subact =0;
                        break;
                  }
                  else
                  {
                      valid_subact =1;  
                  }

                   var sub_grp = $('#jqxgrid_n').jqxGrid('getcellvalue', k, "division");
                  if (sub_grp ==null || sub_grp == 'undefined' ) 
                  {
                        $("#jqxgrid_n").jqxGrid('showvalidationpopup', k, "division", "Please select the division");
                         valid_subgrp =0;
                        break;
                  }
                  else
                  {
                      valid_subgrp =1;  
                  }

                  var dt_value = $('#jqxgrid_n').jqxGrid('getcellvalue', k, "date");
                  if (dt_value ==null || dt_value == 'undefined' ) {
                        $("#jqxgrid_n").jqxGrid('showvalidationpopup', k, "date", "Please Select a Date");
                        valid_dtflag =0;
                        break;
                    }
                    else
                    {
                      valid_dtflag =1;  
                    }

                    var hr_value = $('#jqxgrid_n').jqxGrid('getcellvalue', k, "hour_s");
                    if (hr_value ==null || hr_value == 'undefined' ) {
                        $("#jqxgrid_n").jqxGrid('showvalidationpopup', k, "hour_s", "Please Select the Hours");
                        valid_hrs =0;
                        break;
                    }
                    else
                    {
                      valid_hrs =1;  
                    }
                  var mins_value = $('#jqxgrid_n').jqxGrid('getcellvalue', k, "minit");
                    if (mins_value ==null || mins_value == 'undefined' ) {
                        $("#jqxgrid_n").jqxGrid('showvalidationpopup', k, "minit", "Please Select the Minutes");
                        valid_mins =0;

            
                        break;
                    }
                    else
                    {
                      valid_mins =1;  
                    }
                
                  var moc_value = $('#jqxgrid_n').jqxGrid('getcellvalue', k, "modeofcontact");
                  if (moc_value ==null || moc_value == 'undefined' ) {
                        $("#jqxgrid_n").jqxGrid('showvalidationpopup', k, "modeofcontact", "Please Select the Mode of contact");
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
                  currentdate=  convert(currentdate);
            var griddata;
            var data = {};
            var rows = $('#jqxgrid_n').jqxGrid('getrows');
            for (var i = 0; i < rowscount; i++)
             {

              var rowval = {};
             

              griddata = $('#jqxgrid_n').jqxGrid('getrowdata', i);
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
                  url: 'dailyactivity/updateitemmaster',
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
// end of Update Click function

// view grid double click function start
$("#jqxgrid_n").on("celldoubleclick", function (event)
          {
                var column = event.args.column;
                var rowindex = event.args.rowindex;
                jqxgrid_n_row_index=rowindex;
                jqxgrid_add_row_index=rowindex;
                var columnindex = event.args.columnindex;
                var columnname = column.datafield;
                if (columnname=='itemgroup')
                {
                  $('#customWindow').hide();
                  $('#win_selectItemMaster').jqxWindow({ theme: 'energyblue', autoOpen: false, width: 400, height: 500, resizable: true,title:'select product' });
                  $('#win_selectItemMaster').jqxWindow('open');
                }
                  
                if (columnname=='custgroup')
                {
                  $('#customWindow').hide();
                  $('#win_selectCustMaster').jqxWindow({ theme: 'energyblue', autoOpen: false, width: 400, height: 500, resizable: true,title:'Select Customer' });
                  $('#win_selectCustMaster').jqxWindow('open');
                }
          });
// view grid double click function end

//
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

         
// Source for add grid end

// Source for item master grid start
        var url = "dailyactivity/get_data_itemmaster";
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
                              { text: 'Product Group', dataField: 'itemgroup', width: 500,height:600 },
                         
                          ]
                      });


// source for item master grid end

//  return value from item master start
          $("#jqxgrid_selectItemMaster").on('cellselect', function (event) {
        


 //alert("potential quantity "+potential_quantity);
       //     alert("Action Mode "+actionmode);
         
            var rowindex = $("#jqxgrid_selectItemMaster").jqxGrid('getselectedrowindex', event.args.rowindex);
            var prodName = $("#jqxgrid_selectItemMaster").jqxGrid('getcellvalue', event.args.rowindex,'itemgroup');
          
           
      
     if (actionmode=='add')
     {
        $('#addWindow').jqxWindow('show');
        $("#jqxgrid_add").jqxGrid('setcellvalue', jqxgrid_add_row_index, "itemgroup", prodName);
        gl_customername = $("#jqxgrid_add").jqxGrid('getcellvalue', jqxgrid_add_row_index,'custgroup');
        gl_productname = $("#jqxgrid_add").jqxGrid('getcellvalue', jqxgrid_add_row_index,'itemgroup');
     // alert("gl_customername add "+gl_customername);
     // alert("gl_productname add "+gl_productname);
            
        
        $("#jqxgrid_add").jqxGrid('setcellvalue', jqxgrid_add_row_index, "Potential_Quantity", potential_quantity);
         
     }


    if (actionmode=='update')
    {
        $('#customWindow').jqxWindow('show');  
          $("#jqxgrid_n").jqxGrid('setcellvalue', jqxgrid_n_row_index, "itemgroup", prodName);
           gl_customername = $("#jqxgrid_n").jqxGrid('getcellvalue', jqxgrid_n_row_index,'custgroup');
        gl_productname = $("#jqxgrid_n").jqxGrid('getcellvalue', jqxgrid_n_row_index,'itemgroup');
    //  alert("gl_customername upd "+gl_customername);
     // alert("gl_productname upd "+gl_productname);
      
    }
     
        var url = "dailyactivity/get_potentialquantity/"+escape(gl_customername)+"/"+escape(gl_productname);
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
              
                      potential_quantity = rows[0].potential;
                        }
                  //potential_quantity = rows[0].potential;
              });
         
     if (actionmode=='add')
     {
          $("#jqxgrid_add").jqxGrid('setcellvalue', jqxgrid_add_row_index, "Potential_Quantity", potential_quantity);
         
     }
     if (actionmode=='update')
     {
          $("#jqxgrid_n").jqxGrid('setcellvalue', jqxgrid_n_row_index, "potentialqty", potential_quantity);
         
     }
   $('#win_selectItemMaster').jqxWindow('close');        
     // 
      
   //   
                    
        });
//  return value from item master end

// Source for Customer Master grid start
        var url = "dailyactivity/get_data_customermaster";
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
                  //  console.log(result);
                  var obj = jQuery.parseJSON(result);
                  rows = obj.rows;
               //   rows = obj[1].rows;
                //  commonCols=obj[0].columns;
                }
              });
             var customer_source =
              {
                  datatype: "json",
                  datafields:[{ name: 'customergroup',type: 'string'}],
                  localdata: rows
              };
    
              //  alert("columns "+columns.toSource());    
                var dataAdapterCustomerMaster = new $.jqx.dataAdapter(customer_source);
                      $("#jqxgrid_selectCustomMaster").jqxGrid(
                      {
                        width: '100%',
                        source: dataAdapterCustomerMaster,
                        theme: theme,
                        selectionmode:'singlecell',
                        sortable: true,
                        pageable: true,
                        columnsresize: true,
                        sortable: true,
                        showfilterrow: true,
                        filterable: true,
                         columns: [
                              { text: 'Customer Group', dataField: 'customergroup', width: 500,height:600 },
                         
                          ]
                      });

// source for Customer Master grid end

//  return value from Customer Master start
          $("#jqxgrid_selectCustomMaster").on('cellselect', function (event) {
           // alert("Action Mode "+actionmode);
            var rowindex = $("#jqxgrid_selectCustomMaster").jqxGrid('getselectedrowindex', event.args.rowindex);
        
            var custid = $("#jqxgrid_selectCustomMaster").jqxGrid('getcellvalue', event.args.rowindex,'customergroup');
            var custName = $("#jqxgrid_selectCustomMaster").jqxGrid('getcellvalue', event.args.rowindex,'customergroup');


 if (actionmode=='add')
     {
        $('#addWindow').jqxWindow('show');
      $("#jqxgrid_add").jqxGrid('setcellvalue', jqxgrid_add_row_index, "custgroup", custName);
         
     }
    if (actionmode=='update')
    {
        $('#customWindow').jqxWindow('show');  
        $("#jqxgrid_n").jqxGrid('setcellvalue', jqxgrid_n_row_index, "custgroup", custName);
    }
       
    //  
        $('#win_selectCustMaster').jqxWindow('close');                
        });
//  return value from Customer Master end

// initialize the popup window and buttons.
     
     
        
        

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
		<div class="sideBarContents">
			<div class="quickLinksDiv">
				<p onclick="#" id="Leads_sideBar_link_LBL_RECORDS_LIST" class="selectedQuickLink ">
					<a class="quickLinks" href="<?= base_url()?>leads"><strong>Leads List</strong>
					</a>
				</p>
				<p onclick="#" id="Leads_sideBar_link_LBL_DASHBOARD" class="unSelectedQuickLink"><a class="quickLinks" href="<?= base_url()?>dashboard"><strong>Dashboard</strong></a></p>
			</div>
			<div class="clearfix"></div>
			<div class="quickWidgetContainer accordion">
				<div class="quickWidget">
					<div class="accordion-heading accordion-toggle quickWidgetHeader" data-target="#Leads_sideBar_LBL_RECENTLY_MODIFIED" data-toggle="collapse" data-parent="#quickWidgets" data-label="LBL_RECENTLY_MODIFIED" data-widget-url="#">
						<span class="pull-left">
							<img class="imageElement" data-rightimage="<?= base_url()?>public/images/images/rightArrowWhite.png" data-downimage="<?= base_url()?>public/images/images/downArrowWhite.png" src="<?= base_url()?>public/images/rightArrowWhite.png">
						</span>
						<h5 class="title widgetTextOverflowEllipsis pull-right" title="Recently Modified">Recently Modified</h5>
						<div class="loadingImg hide pull-right"><div class="loadingWidgetMsg"><strong>Loading Widget</strong>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<div class="widgetContainer accordion-body collapse" id="Leads_sideBar_LBL_RECENTLY_MODIFIED" data-url="module=Leads&amp;view=IndexAjax&amp;mode=showActiveRecords">
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="contentsDiv span10 marginLeftZero">
<div class="listViewPageDiv">
	<div class="listViewTopMenuDiv noprint">
		<div class="listViewActionsDiv row-fluid">
			<span class="btn-toolbar span4">
				
					<span class="btn-group">
						<!-- <button id="Leads_listView_basicAction_LBL_ADD_RECORD" class="btn addButton" onclick='window.location.href="leads/add"'><i class="icon-plus icon-white"></i>&nbsp;<strong>Add Lead</strong></button> -->
			<?php if($this->session->flashdata('message')!="") {?>
			<div class="alert alert-message.success"><p style="width:709px; text-align:center;font-size:18px;"><?php 
			 echo $this->session->flashdata('message'); ?></p></div>
			<?php }?>


					</span>
				</span>
			
				<span class="hide filterActionImages pull-right"><i title="Deny" data-value="deny" class="icon-ban-circle alignMiddle denyFilter filterActionImage pull-right"></i><i title="Approve" data-value="approve" class="icon-ok alignMiddle approveFilter filterActionImage pull-right"></i><i title="Delete" data-value="delete" class="icon-trash alignMiddle deleteFilter filterActionImage pull-right"></i><i title="Edit" data-value="edit" class="icon-pencil alignMiddle editFilter filterActionImage pull-right"></i>
				</span>
				
				</div>
			</div>
			<div class="listViewContentDiv" id="listViewContents" style="float: left; width:100%;">
<!-- Start your grid content from here --> 	
      				<div id='jqxWidget' style="float: left; width:100%;">
                                      <div id="jqxgrid"></div>
                                      <div style="margin-top: 30px;">
                                          <div id="cellbegineditevent"></div>
                                          <div style="margin-top: 10px;" id="cellendeditevent"></div>
                                     </div>
                                  
<!--  This part of div contain windows Start      -->
                                  
                        		        <div id="customWindow" style="float: left; width:100%;">
                                                <div id="customWindowContent" style="float: left; width:1013px;">
                                                  <div style="float: left; width:95%; padding-left: 7px;" >
                                                    <label style="float: left;">Entry Date: </label><label style="float: left; padding-left: 40px;">Executive Name </label>&nbsp;<label style="float: left;  padding-left: 107px;">Branch </label>
                                                  </div>  

                                                  <div style=" float: left; width:60%; padding-left: 7px;">
                                                    <input id='update_header_date'/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="username"/>&nbsp;&nbsp;&nbsp;<input type="text" id="branch"/>
                                                  </div>
                                                    <div id="jqxgrid_n" style="posistion:relative; float: left; width:100%;" ></div>
                                                        <input id="update_add_row" type="hidden" value="Add New Row" />
                                                        <input id="update_delete_row" type="hidden" value="Delete Selected Row" />
                                                        <input id="update_data" type="hidden" value="Update" />
                                                </div>           
                                            </div>
<!-- add popup start -->
<!--  This part of div contain windows for view mode Start      -->
                                  
                                    <div id="customWindowview" style="float: left; width:100%;">
                                                <div id="customWindowview" style="float: left; width:1012px;">
                                                  <div style="float: left; width:95%; padding-left: 7px;" >
                                                    <label style="float: left;">Entry Date </label>&nbsp;<label style="float: left; padding-left: 40px;">Executive Name </label>&nbsp;<label style="float: left;  padding-left: 107px;">Branch </label>
                                                  </div>  
                                                   <div style=" float: left; width:60%; padding-left: 7px;">
                                                    <input id='view_header_date'/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="username_vw"/>&nbsp;&nbsp;&nbsp;<input type="text" id="branch_vw"/>
                                                  </div>
                                                    <div id="jqxgrid_view" style="posistion:relative; float: left; width:100%;" ></div>
                                                 </div>           
                                              </div>
<!-- add popup start -->
		<?php $this->load->view('dailyactivity/jqxgrid_add');?>

<!-- add popup end -->
<!-- Select itemmaster popup start -->
                      <div id="win_selectItemMaster" style="width: 50%" >
			<div style="margin: 10px">
				<div id="jqxgrid_selectItemMaster" style="width: 400px;">testing</div>
			</div>
            </div>
<!-- Select Itemmaster popup end -->

<!-- Select customer master popup start -->
      <div id="win_selectCustMaster" style="width: 50%" >
        <div style="margin: 10px">
          <div id="jqxgrid_selectCustomMaster" style="width: 400px;">testing</div>
        </div>
    </div>
<!-- Select customer master popup end -->

			</div>


<!--  This part of div contain windows End      -->
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
<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-alert.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-tooltip.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-tab.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-collapse.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/js/bootstrap-popover.js"></script>
<script type="text/javascript" src="<?= base_url()?>public/js/bootbox.js"></script>




<!-- Added in the end since it should be after less file loaded -->

</body>
</html>
