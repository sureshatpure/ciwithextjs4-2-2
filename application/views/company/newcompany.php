<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd ">
<html xmlns=" http://www.w3.org/1999/xhtml ">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>

	<meta charset="utf-8">
	<title>Leads - Add New Company</title>
	<link href="<?= base_url()?>public/css/styles.css" rel="stylesheet" type="text/css">
	<script src="<?=base_url()?>public/js/jquery.min.js"></script>
 	<script src="<?=base_url()?>public/js/jquery.validate.min.js"></script>

	<script src="<?= base_url()?>public/js/additional-methods.js"></script>
	<script src="<?= base_url()?>public/js/validation_rules.js"></script>
<script type="text/javascript">
	var response_msg;
	
	$(document).ready(function() 
	{
		$('#savecustomer').hide();	
		$("#newcompany").validate({

		          errorElement: "span", 
		          //set the rules for the fild names
		          rules: {
		              companyname: {
		                  required: true
		          		}
		   				},
		          //set error messages
		          messages: {
		              companyname:{ 
		                  required: "Please Enter the Company Name"
		              }
								},	
		   
		          //our custom error placement
		          errorElement: "span",
		          errorPlacement: function(error, element) {
		                  error.appendTo(element.parent());
		              }
						 
		  

		 });

  var validateCompanyname = $('#validateCompanyname');
  $('#companyname').keyup(function () {
    var companyname = this; 
    if (this.value != this.lastValue) {
      if (this.timer) clearTimeout(this.timer);
      validateCompanyname.removeClass('error').html('<img src="../public/images/ajax-loader.gif" height="16" width="16" /> checking availability...');
      
      this.timer = setTimeout(function () {
        $.ajax({
          url: '../company/check_customername',
          data: 'action=check_companyname&company_name='+companyname.value,
          dataType: 'json',
          type: 'post',
          success: function (response) 
          {
          	
          	response_msg =response.ok;
           validateCompanyname.html(response.msg);
           if(response_msg) 
          	 {
			$('#savecustomer').show();	
          	 }
       else if (!response_msg)
       	 {
			$('#savecustomer').hide();	
         	 }
	else if (response_msg=='undefined')
       	 {
         		$('#savecustomer').hide();	
          	 }	
          }
        });
      }, 200);
      
      this.lastValue = this.value;
    }
  });	


	});
 </script>
  
</head>
<body>

<div id="container">
		<?php $attributes = array('id' => 'newcompany','name' => 'newcompany');
			echo form_open('company/savenewcompany',$attributes); 
		?>

		<div class="field">  
				<label for="companyname">Customer Name</label>
				<input type="text" name="companyname" id="companyname" value="" size="25" /><span id="validateCompanyname">
				</span>
		<?php echo form_error('companyname');   ?>           
		</div>
		<div><input class="submit" id="savecustomer" name="savecustomer" type="submit" value="Submit" /></div>
		<input type="hidden" id="hdn_userid" name="hdn_userid" value="<?php echo $this->session->userdata['user_id'];?>"/>


</form>
		
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</htm>

