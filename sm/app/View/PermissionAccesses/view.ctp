<div class="permissionAccesses view">
<h2><?php  echo __('Permission Access'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($permissionAccess['PermissionAccess']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Personal Offers Id'); ?></dt>
		<dd>
			<?php echo h($permissionAccess['PermissionAccess']['personal_offers_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Task Id'); ?></dt>
		<dd>
			<?php echo h($permissionAccess['PermissionAccess']['task_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Permission'); ?></dt>
		<dd>
			<?php echo h($permissionAccess['PermissionAccess']['permission']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Groupe Id'); ?></dt>
		<dd>
			<?php echo h($permissionAccess['PermissionAccess']['groupe_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Debut'); ?></dt>
		<dd>
			<?php echo h($permissionAccess['PermissionAccess']['date_debut']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Fin'); ?></dt>
		<dd>
			<?php echo h($permissionAccess['PermissionAccess']['date_fin']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Permission Access'), array('action' => 'edit', $permissionAccess['PermissionAccess']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Permission Access'), array('action' => 'delete', $permissionAccess['PermissionAccess']['id']), null, __('Are you sure you want to delete # %s?', $permissionAccess['PermissionAccess']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Permission Accesses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Permission Access'), array('action' => 'add')); ?> </li>
	</ul>
</div>
