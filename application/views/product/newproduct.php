<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd ">
<html xmlns=" http://www.w3.org/1999/xhtml ">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta content="utf-8" http-equiv="encoding">
	<title>Leads Add Lead</title>

	<link href="<?=base_url()?>public/css/style.css" rel="stylesheet" type="text/css">
	<link href="<?=base_url()?>public/css/styles.css" rel="stylesheet" type="text/css">
	<link media="screen" type="text/css" href="<?= base_url()?>public/jquery/select2/select2.css" rel="stylesheet">
	<link media="screen" type="text/css" href="<?= base_url()?>public/bootstrap/css/bootstrap.css" rel="stylesheet">
	<script src="<?=base_url()?>public/js/jquery.min.js"></script>
  	<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>

	<script src="<?=base_url()?>public/js/additional-methods.js"></script>
	<script src="<?=base_url()?>public/js/validation_rules.js"></script>
  <script type="text/javascript">
  	  var controller = 'product';
      var base_url = '<?php echo site_url(); //you have to load the "url_helper" to use this function ?>';
	$(document).ready(function()
	{
   var count = 1;
   //alert("base url"+base_url+"products/getproductsnew");
	$.getJSON(base_url+"product/getproductsnew", 
		{
		  tags: "leads",
		  tagmode: "any",
		  format: "json"
		}) 
  		 .done(function(data)
		{
		  $.each(data, function(index, text) 
		  {
		   // alert("index is "+text.key);
		   // alert("text is "+text.val);
		    $('#customFieldName').append(
			   $('<option></option>').val(text.id).html(text.description)
		    );
		  });
		});

		$("#addCF").on("click",function()
	    {
		   var $tableBody = $('#customFields').find("tbody"),
		   $trLast = $tableBody.find("tr:last"),
		   $trNew = $trLast.clone();
		   $trLast.after($trNew);
		   $trNew.find(':text').val('');
		   count++
		});

		$('#remCFF').on("click", function(){
		// $('#customFields tr:last').remove();
		if(count>1)
			{
			 $('#customFields tr:last').remove();
			} 
			else
			{
			 alert("You cannot not allowed to remove.!");
			}
		 count--
	  });
   


	
});
</script>
</head>
<body>

<div id="container">
		<?php $attributes = array('id' => 'leadform','name' => 'leadform');
//echo "leadid ".$leadid;	
			echo form_open('product/saveleadproduct',$attributes); 
			?>
	<div class="row-fluid">
		<span class="span10"><span class="addremove"><a href="javascript:void(0);" id="addCF">Add</a>&nbsp; <a href="javascript:void(0);" id="remCFF">Remove</a></span>
		<table class="form-table" id="customFields">
			<tbody>
			<tr valign="top">
			<td scope="row"><label for="customFieldNames">Select Product</label></th>
			<td>
			   <select id="customFieldName" name="customFieldName[]"></select>&nbsp;&nbsp;&nbsp;<b>Quantity</b>&nbsp;<input type="text" class="code1" id="customFieldValue" name="customFieldValue[]" value="" size="8" placeholder="Enter Qnty" /> &nbsp;in MT/Month &nbsp;&nbsp;<b>Potential</b>&nbsp;<input type="text" class="code1" id="customFieldPoten" name="customFieldPoten[]" value="" size="8" placeholder="Enter Poten" /> &nbsp;in MT/Month		   
			</td>
			</tr>
			</tbody>
		</table>
		<?php echo form_error('customFieldNames');   ?>     

		<input type="hidden" id="hdn_leadid" name="hdn_leadid" value="<?php echo $leadid; ?>"/>
   </span>
	</div>

		<div><input class="submit" id="saveproducts" name="saveproducts" type="submit" value="Submit" /></div>

</form>
		
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</htm>

