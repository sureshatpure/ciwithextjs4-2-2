<HTML> <HEAD> 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
</script> 
<script> 
function makeAjaxCall()
{ 
	$.ajax(
	{ 
		type: "post", 
		url: "http://localhost/newsalescrm/index.php/user/verifyuser", 
		cache: false,	
		data: $('#userForm').serialize(), 
		success: function(json)
		{	
			try
			{
				var obj = jQuery.parseJSON(json); 
				alert( obj['STATUS']); 
			}catch(e) 
			{	
				alert('Exception while request..'); 
			}	
		}, 
		error: function()
		{	
			alert('Error while request..'); 
		} 
	}); 
} </script> 
</HEAD> 
<BODY> 
<form name="userForm" id="userForm" action=""> 
<table border="1"> 
<tr> 
<td valign="top" align="left">	Username:- <input type="text" name="userName" id="userName" value=""> </td> 
</tr> 
<tr> 
<td valign="top" align="left">	Password :- <input type="password" name="userPassword" id="userPassword" value=""> 
</td> 
</tr> 
<tr> 
<td> 
<input type="button" onclick="javascript:makeAjaxCall();" value="Submit"/> 
</td>
 </tr>
 </table> 
</form> 
</BODY> 
</HTML> -
