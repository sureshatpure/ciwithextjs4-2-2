<h1><?php echo lang('index_heading');?></h1>
<div style="margin-left: 88%;"><a href="<?= base_url()?>admin/logout">Logout</a></div>
<p><?php echo lang('index_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<table cellpadding=0 cellspacing=10>
	<tr>
		<th>Login Name</th>
		<th>Employee Name</th>
		<th>Email Id </th>
		<th>Groups</th>
		<th>Status</th>
		<th>Action</th>
	</tr>
	
	<?php foreach ($users as $user):?>
		<tr>
			<td><?php echo $user->aliasloginname;?></td>
			<td><?php echo $user->empname;?></td>
			<td><?php echo $user->user_mail_id;?></td>
			<td>
				<?php foreach ($user->groups as $group):?>
					<?php echo anchor("admin/edit_group/".$group->id, $group->name) ;?><br />
                <?php endforeach?>
			</td>
			<td><?php echo ($user->active) ? anchor("admin/deactivate/".$user->id, lang('index_active_link')) : anchor("admin/activate/". $user->id, lang('index_inactive_link'));?></td>
			<td><?php echo anchor("admin/edit_user/".$user->header_user_id, 'Edit') ;?></td>
		</tr>
	<?php endforeach;?>
</table>

<p><?php echo anchor('admin/create_user', lang('index_create_user_link'))?> | <?php echo anchor('admin/create_group', lang('index_create_group_link'))?></p>
