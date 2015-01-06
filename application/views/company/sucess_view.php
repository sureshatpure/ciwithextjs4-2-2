<!DOCTYPE html>
<html>
   <head>
	<link href="<?=base_url()?>public/css/styles.css" rel="stylesheet" type="text/css">
      <title>Success View</title>
   </head>
 <script language="javascript">
window.opener.location.href=window.opener.location.href;
var msg = "Customer Added Sucessfully";
alert(msg);
var timer = setInterval(function() {   
    if(msg.closed) {  
        clearInterval(timer);  
        alert('closed');  
    }  
}, 1000); 
self.close();

</script>
   <body>
      <h1> Add New Customers</h1>
       
      <div class="container">
          <p class="unSelectedQuickLink" id="Leads_sideBar_link_LBL_DASHBOARD" ><a onclick="refreshParent();" href="#" class="quickLinks"><strong>Close</strong></a></p>
         <?php echo $body; ?>
          
      </div>
       
   </body>
    
</html>
