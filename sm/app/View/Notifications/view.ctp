<div class="notifications view">
<h2><?php  echo __('Notification'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Notification'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['date_notification']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Vu'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['vu']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id Profile Send'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['id_profile_send']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id Profile Recu'); ?></dt>
		<dd>
			<?php echo h($notification['Notification']['id_profile_recu']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Notification'), array('action' => 'edit', $notification['Notification']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Notification'), array('action' => 'delete', $notification['Notification']['id']), null, __('Are you sure you want to delete # %s?', $notification['Notification']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Notifications'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Notification'), array('action' => 'add')); ?> </li>
	</ul>
</div>
