<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
	<link rel="SHORTCUT ICON" href="http://localhost/purechemicals/layouts/vlayout/skins/images/favicon.ico">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="stylesheet" href="<?= base_url()?>public/login_files/chosen.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/login_files/jquery-ui-1.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/login_files/select2.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/login_files/bootstrap_002.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/login_files/styles.css" type="text/css" media="screen">
	<link rel="stylesheet" href="<?= base_url()?>public/login_files/validationEngine.css">
	<link rel="stylesheet" href="<?= base_url()?>public/login_files/select2.css">
	<link rel="stylesheet" href="<?= base_url()?>public/login_files/guiders-1.css">
	<link rel="stylesheet" href="<?= base_url()?>public/login_files/jquery.css">
	<link rel="stylesheet" href="<?= base_url()?>public/login_files/jquery_002.css">
	<link rel="stylesheet" media="screen" type="text/css" href="<?= base_url()?>public/login_files/datepicker.css">
	<style type="text/css">@media print {.noprint { display:none; }}</style>
	<script type="text/javascript" src="<?= base_url()?>public/login_files/jquery_003.js"></script>
  
</head>
<body data-skinpath="">
	<div id="js_strings" class="hide noprint">null</div>
	<div id="page"><!-- container which holds data temporarly for pjax calls -->
		<div id="pjaxContainer" class="hide noprint"></div>
<title>Pure-Chemicals login page</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"><!-- for Login page we are added -->
<link href="<?= base_url()?>public/login_files/bootstrap.css" rel="stylesheet">
<link href="<?= base_url()?>public/login_files/bootstrap-responsive.css" rel="stylesheet">
<link href="<?= base_url()?>public/login_files/jquery_003.css" rel="stylesheet">
<script src="<?= base_url()?>public/login_files/jquery_003.js"></script>
<script src="<?= base_url()?>public/login_files/jquery.js"></script><script src="<?= base_url()?>public/login_files/jquery_002.js"></script>
<script src="<?= base_url()?>public/login_files/respond.js"></script>
<script>jQuery(document).ready(function(){scrollx = jQuery(window).outerWidth();window.scrollTo(scrollx,0);slider = jQuery('.bxslider').bxSlider({auto: true,pause: 4000,randomStart : true,autoHover: true});
	jQuery('.bx-prev, .bx-next, .bx-pager-item').live('click',function(){ slider.startAuto(); });});</script>
<div class="container-fluid login-container">
	<div class="row-fluid">
		<div class="span3">
			<div class="logo"><img src="<?= base_url()?>public/login_files/logo.png"><br><a target="_blank" href="http:///"></a>
				</div>
				</div>
				<div class="span9">
					<div class="helpLinks"><a href="http://www.pure-chemical.com/">Pure-Chemicals Website</a> |<a href="#">Pure-Chemicals Wiki</a> |<a href="#">Pure-Chemicals videos </a> |<a href="#">Pure-Chemicals Forums</a>
					</div>

				</div>
				<div class="span6">
					<div class="login-area">
												<!-- -->
					<div class="login-box " id="defaultpasswordDiv">
						<form class="form-horizontal login-form" name="defaultpassword" id="defaultpassword" style="margin:0;" action="default_password" method="POST">
							<div class=""><h3 class="login-header">User using default Password</h3>
							</div>
							<div class="control-group">
									<label class="control-label" for="user_name"><b>Old Password</b></label>
									<div class="controls">
										<input id="old_password" name="old_password" placeholder="Old Password" type="password" value="<?php echo $oldpassword; ?>">
									</div>
								</div>
								<div class="control-group">
										<label class="control-label" for="password"><b>New Password</b></label>
									<div class="controls">
										<input id="password" name="password" placeholder="New Password" type="password">
									</div>
								</div>
								<div class="control-group">
										<label class="control-label" for="confirmpassword"><b>Confirm Password</b></label>
									<div class="controls">
										<input id="confirmpassword" name="confirmpassword" placeholder="Re-Type Password" type="password">
									</div>
								</div>
								<div class="control-group"><label class="control-label" for="email"><b>Email</b></label>
									<div class="controls">
										<input id="emailId" name="emailId" placeholder="Email" type="text">
									</div>
								</div>
							<div class="control-group signin-button">
								<div class="controls" id="backButtonDp">
									<input class="btn btn-primary sbutton" value="Submit" name="updatepassword" type="submit">&nbsp;&nbsp;&nbsp;<a>Back</a>
								</div>
							</div>
						</form>
					</div><div class="login-box hide" id="loginDiv">
						   <div class=""><h3 class="login-header">Login to Pure CRM</h3>
						   </div>
							<form class="form-horizontal login-form" style="margin:0;" action="login" method="POST">
				
							<div class="control-group">
								<label class="control-label" for="username"><b>User name</b></label>
								<div class="controls">
									<input value="" id="identity" name="identity" placeholder="Loginname" type="text">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="password"><b>Password</b></label>
							<div class="controls">
								<input id="password" name="password" placeholder="Password" type="password">
							</div>
						</div>
						<div class="control-group signin-button">
							<div class="controls" id="forgotPassword">
								<button type="submit" class="btn btn-primary sbutton" name="submit" value="Login">Sign in</button>
							</div>
							<div class="controls" id="defaultpassword">
								<!--<a>Default Password ?</a>-->
							</div>
						</div>
<!-- -->
						 
			
			
					

				</div>
			</div>
		
		</div>
	</div>
	<div class="navbar navbar-fixed-bottom">
		<div class="navbar-inner">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span6 pull-left">
						<div class="footer-content">
							<small>© 20012-2013&nbsp;<a href="#"> www.pure-chemicals.com</a>
							</small>
						</div>
					</div>
					<div class="span6 pull-right">
						<div class="pull-right footer-icons"><small>Connect with US&nbsp;</small><a href="https://www.facebook.com/pure-chemicals"><img src="<?= base_url()?>public/login_files/facebook.png"></a>&nbsp;<a href="https://twitter.com/purechemicals"><img src="<?= base_url()?>public/login_files/twitter.html"></a>&nbsp;<a href="#"><img src="<?= base_url()?>public/login_files/linkedin.png"></a>&nbsp;<a href="http://www.youtube.com/user/purechemicals"><img src="<?= base_url()?>public/login_files/youtube.png"></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
jQuery(document).ready(function(){

		jQuery("#forgotPassword a").click(function() {
			jQuery("#loginDiv").hide();
			jQuery("#defaultpasswordDiv").hide();
	
		});

		jQuery("#defaultpassword a").click(function() 
		{
			jQuery("#loginDiv").hide();
			jQuery("#forgotPasswordDiv").hide();
			jQuery("#defaultpasswordDiv").show();
		});


		jQuery("#backButton a").click(function() {
			jQuery("#loginDiv").show();
			jQuery("#forgotPasswordDiv").hide();
		});

		jQuery("#backButtonDp a").click(function() {
			jQuery("#defaultpasswordDiv").hide();
			jQuery("#forgotPasswordDiv").hide();
			jQuery("#loginDiv").show();
		});

		jQuery("input[name='updatepassword']").click(function (){
			var password = jQuery('#password').val();
			var confirmpassword = jQuery('#confirmpassword').val();
			var email = jQuery('#emailId').val();
					 email = email.toLowerCase();
			var email1 = email.replace(/^\s+/,'').replace(/\s+$/,'');
			var emailFilter = /^[^@]+@[^@.]+\.[^@]*\w\w$/ ;
			var illegalChars= /[\(\)\<\>\,\;\:\\\"\[\]]/ ;
	 		var str = email.split('@').slice(1);
				
        
			if(password == '')
			{
				alert('Please enter new password');
				return false;
			} 
			else if(confirmpassword=='')
			{
				alert('Please enter confirm password');
				return false;
			}
			else if(confirmpassword!=password)
			{
				alert('Confirm password does not match');
				return false;
			}  
			else if(!emailFilter.test(email1) || email == '')
			{
				alert('Please enter valid email address');
				return false;
			} 
			else if(email.match(illegalChars))
			{
				alert( "The email address contains illegal characters.");
				return false;
			} 
			else if(str=='pure-chemical.com')
			{
				alert( "This pure-chemical domain is not allow in the email address.");
				return false;
			} 
			else 
			{
				return true;
			}
		});

		
});
	</script>
</div>
</body>
</html>
