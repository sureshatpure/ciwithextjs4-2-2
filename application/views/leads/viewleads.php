<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" " http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd ">
<html xmlns=" http://www.w3.org/1999/xhtml ">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>

	<meta charset="utf-8">
	<title>Leads - View Leads</title>
	<link href="<?= base_url()?>public/css/styles.css" rel="stylesheet" type="text/css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  	<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>

	<script src="<?= base_url()?>public/js/additional-methods.js"></script>
	<script src="<?= base_url()?>public/js/validation_rules.js"></script>
<script languag="text/javascript">
		function deletechecked()
    {
        if(confirm("Delete selected messages ?"))
        {
            return true;
        }
        else
        {
            return false;  
        } 
   }
</script>
       
</head>
<body>

<div id="container">
<?php //echo "<pre>";echo print_r($this->session);echo "</pre>"; 
	//echo "<pre>";echo print_r($this->session->userdata);echo "</pre>"; 
		$this->session->userdata['loginname'];
	echo $this->session->userdata['username']."-".$this->session->userdata['user_id']."-".$this->session->userdata['reportingto'];  
?>
 <p> <?php if (isset($message)){echo $message;} ?>
<table border="0" cellspacing="1" cellpadding="3" width="100%" class="lvt small">
<!-- Table Headers -->
	<tbody>
		<tr>
				<!--<td class="lvtCol">
			 <input type="checkbox" name="selectall" id="selectCurrentPageRec"> 
			</td>-->
			<td class="lvtCol">
				<a href="#">Lead No</a>
			</td>
			<td class="lvtCol">
				<a href="#">Lead Status</a>
			</td>
			<td class="lvtCol">
				<a href="#">Customer Name</a>
			</td>
			<td class="lvtCol">
				<a href="#">Company</a>
			</td>
			<td class="lvtCol">
				<a href="#">Assigned To</a>
			</td>
			<td class="lvtCol">
				<a href="#">Created Date</a>
			</td>
			<td class="lvtCol">
				<a href="#">Email</a>
			</td>
			<td class="lvtCol">
				<a href="#">Mobile</a>
			</td>
			<td class="lvtCol">
				<a href="#">Action</a>
			</td>
	</tr>
<tr>
				<td id="linkForSelectAll" class="linkForSelectAll" style="display:none;" colspan="15">
					<span id="selectAllRec" class="selectall" style="display:inline;" onclick="toggleSelectAll_Records('Leads',true,'selected_id')">Select All <span id="count"> </span> records in Leads</span>
					<span id="deSelectAllRec" class="selectall" style="display:none;" onclick="toggleSelectAll_Records('Leads',false,'selected_id')">Deselect all Leads</span>
				</td>
			</tr>
			<!-- Table Contents Start-->
			<?php 
				foreach($leaddetails as $leaddetail)
				 {
				?>
							
			<tr bgcolor="white" id="row_90">
				<!--<td width="2%">
					<input type="checkbox" name="selected_id" id="<?echo $leaddetail['leadid'];?>" value="90" onclick="check_object(this)">
				</td>-->
				<td><?echo $leaddetail['lead_no'];?> </td>
				<td>
					<?echo $leaddetail['leadstatus'];?>
				</td>
				<td>
					<?echo $leaddetail['lastname'];?>
				</td>
				<td>
					<?echo $leaddetail['tempcustname'];?>
				</td>
				<td>
					<?echo $leaddetail['empname'];?>
				</td>
				<td>
					<?echo $leaddetail['createddate'];?>
				</td>
				<td>
				<?echo $leaddetail['email_id'];?>
				</td>
				<td>
					<?echo $leaddetail['mobile_no'];?>
				</td>
				<td>
					<a href="leads/edit/<?echo $leaddetail['leadid'];?>" title="Leads">Edit</a> | <a href="delete/<?echo $leaddetail['leadid'];?>" title="Leads">Delete</a>
				</td>
		
			<!-- Table Contents End-->
		<?php				
				 } 
			echo"</tr>";
	   		?>
		<tr>
			<td>
			
	  	</td>
		</tr>
 </tbody>
</table>

</div>

</body>
</htm>

