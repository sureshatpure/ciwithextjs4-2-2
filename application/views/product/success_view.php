<!DOCTYPE html>
<html>
   <head>
	<link href="<?=base_url()?>public/css/styles.css" rel="stylesheet" type="text/css">
  <script src="<?=base_url()?>public/js/jquery.min.js"></script>
      <title>Success View</title>
   </head>
 <script language="javascript">
window.opener.location.href=window.opener.location.href;
var msg = "Product Added Sucessfully.!";
alert(msg);
var timer = setInterval(function() {   
    if(msg.closed) {  
        clearInterval(timer);  
        alert('closed');  
    }  
}, 1000); 
self.close();
/*
function refreshParent() {
var win = window.opener.location.href;   
alert("win "+win);
var timer = setInterval(function() {   
    if(win.closed) {  
        clearInterval(timer);  
        alert('closed');  
    }  
}, 1000); 
 

 /*
  window.opener.location.href = window.opener.location.href;
  if (window.opener.progressWindow)
	{
    window.opener.progressWindow.close()
  }
  window.close();

window.opener.location.href=window.opener.location.href;
self.close();
}
*/
</script>
   <body>
      <h1>Add Lead Products</h1>
       
      <div class="container">
          <p class="unSelectedQuickLink" id="Leads_sideBar_link_LBL_DASHBOARD" ><a onclick="refreshParent();" href="#" class="quickLinks"><strong>Close</strong></a></p>
         <?php echo $body; ?>
          
      </div>
       
   </body>
    
</html>
