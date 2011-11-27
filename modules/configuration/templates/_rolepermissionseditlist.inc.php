<?php if (count($permissions_list) > 0): ?>
	<?php foreach ($permissions_list as $permission_key => $permission): ?>
		<?php $is_checked = $role->hasPermission($permission_key); ?>
		<li style="clear: both; overflow: visible;"<?php if (isset($disabled) && $disabled): ?> class="faded_out"<?php endif; ?>>
			<?php if (!array_key_exists('container', $permission) || !$permission['container']): ?>
				<div style="padding: 2px; float: left;"><?php echo (array_key_exists('description', $permission)) ? $permission['description'] : $permission_key; ?></div>
				<div style="float: right; padding-top: 1px;">
					<?php if (array_key_exists('details', $permission) && is_array($permission['details']) && !empty($permission['details'])): ?>
						<?php echo javascript_link_tag(image_tag('icon_project_permissions.png'), array('style' => 'display: inline;', 'onclick' => "$('role_{$role->getID()}_permission_{$permission_key}_sublist').toggle();")); ?>
					<?php endif; ?>
					<input <?php if (isset($disabled) && $disabled) echo 'disabled'; ?> type="checkbox" name="permissions[<?php echo $permission_key; ?>]" id="role_<?php echo $role->getID(); ?>_permission_<?php echo $permission_key; ?>_checkbox" value="1"<?php if ($is_checked) echo ' checked'; ?><?php if (array_key_exists('details', $permission) && is_array($permission['details']) && !empty($permission['details'])): ?> onchange="var chk = $(this).checked; $('role_<?php echo $role->getID(); ?>_permission_<?php echo $permission_key; ?>_sublist').select('input[type=checkbox]').each( function (elm) { if (chk) { $(elm).disable(); $(elm).up('li').addClassName('faded_out'); } else { $(elm).enable();  $(elm).up('li').removeClassName('faded_out'); } });"<?php endif; ?>>&nbsp;<label for="role_<?php echo $role->getID(); ?>_permission_<?php echo $permission_key; ?>_checkbox" style="float: right; padding-right: 5px;"><?php echo __('Yes'); ?></label>
				</div>
				<br style="clear: both;">
			<?php endif; ?>
			<?php if (array_key_exists('details', $permission) && is_array($permission['details']) && !empty($permission['details'])): ?>
				<ul id="role_<?php echo $role->getID(); ?>_permission_<?php echo $permission_key; ?>_sublist" style="display: none; width: auto;">
					<?php include_template('configuration/rolepermissionseditlist', array('permissions_list' => $permission['details'], 'role' => $role, 'disabled' => $is_checked)); ?>
				</ul>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
<?php endif; ?>