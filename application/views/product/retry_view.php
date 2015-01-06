<!DOCTYPE html>
<html>
   <head>
	<link href="<?=base_url()?>public/css/styles.css" rel="stylesheet" type="text/css">
      <title>Try Again View</title>
   </head>
 <script language="javascript">
function refreshParent() {
  window.close();
}
</script>
   <body>
      <h1>Add Lead Products</h1>
       
      <div class="container">
          <p class="unSelectedQuickLink" id="Leads_sideBar_link_LBL_DASHBOARD" ><a onclick="refreshParent();" href="#" class="quickLinks"><strong>Close</strong></a></p>
         <?php echo $body; ?>
          
      </div>
       
   </body>
    
</html>
