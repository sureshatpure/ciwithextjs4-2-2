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
	
	$(document).ready(function() 
	{
		$("#newtempitemmaster").validate({

		          errorElement: "span", 
		          //set the rules for the fild names
		          rules: {
		              temp_itemname: {
		                  required: true
		          		}
		   				},
		          //set error messages
		          messages: {
		              temp_itemname:{ 
		                  required: "Please Enter the Product Name"
		              }
								},	
		   
		          //our custom error placement
		          errorElement: "span",
		          errorPlacement: function(error, element) {
		                  error.appendTo(element.parent());
		              }
						 
		  

		 });

  var validateTempitemname = $('#validateTempitemname');
  $('#temp_itemname').keyup(function () {
    var temp_itemname = this; 
    if (this.value != this.lastValue) {
      if (this.timer) clearTimeout(this.timer);
      validateTempitemname.removeClass('error').html('<img src="../../public/images/ajax-loader.gif" height="16" width="16" /> checking availability...');
      
      this.timer = setTimeout(function () {
        $.ajax({
          url: '../../product/check_itemname',
          data: 'action=check_itemname&item_name='+temp_itemname.value,
          dataType: 'json',
          type: 'post',
          success: function (response) {
            validateTempitemname.html(response.msg);
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
		<?php $attributes = array('id' => 'newtempitemmaster','name' => 'newtempitemmaster');
			echo form_open('product/savenewitem',$attributes); 
		?>

		<div class="field">  
				<label for="temp_itemname">Product Name</label>
				<input type="text" name="temp_itemname" id="temp_itemname" value="" size="25" /><span id="validateTempitemname">
				</span>
		<?php echo form_error('newtempitemmaster');   ?>           
		</div>
		<div><input class="submit" id="savenewitem" name="savenewitem" type="submit" value="Submit" /></div>
		<input type="hidden" id="hdn_userid" name="hdn_userid" value="<?php echo $this->session->userdata['user_id'];?>"/>


</form>
		
		<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</htm>

