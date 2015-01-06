<h1><?php echo lang('edit_user_heading');?></h1>
<p><?php echo lang('edit_user_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open(uri_string());?>

      <p>
           <label for="aliasloginname"> Login Name:</label> <br />
            <?php echo form_input($aliasloginname);?>
      </p>

      <p>
            <label for="empname"> Employee Name:</label> <br />
            <?php echo form_input($empname);?>
      </p>

      <p>
             <label for="user_mail_d"> Email Id :</label> <br />
            <?php echo form_input($user_mail_d);?>
      </p>

      <p>
              <label for="reports_to_id"> Reporting To :</label> <br />
            <?php echo form_input($reports_to_id);?>
      </p>

      <p>
           <label for="pwd"> Password :</label> <br />
            <?php echo form_input($pwd);?>
      </p>

      <p>
            <label for="password_confirm"> Confirm Password :</label> <br />
            <?php echo form_input($password_confirm);?>
      </p>

	 <h3><?php echo lang('edit_user_groups_heading');?></h3>
	<?php foreach ($groups as $group):?>
	<label class="checkbox">
	<?php
		$gID=$group['id'];
		$checked = null;
		$item = null;
		foreach($currentGroups as $grp) {
			if ($gID == $grp->id) {
				$checked= ' checked="checked"';
			break;
			}
		}
	?>
	<input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
	<?php echo $group['name'];?>
	</label>
	<?php endforeach?>

      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>

      <p><?php echo form_submit('submit', lang('edit_user_submit_btn'));?></p>

<?php echo form_close();?>
