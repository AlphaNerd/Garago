<div class="notifications form">
<?php echo $this->Form->create('Notification'); ?>
	<fieldset>
		<legend><?php echo __('Edit Notification'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('description');
		echo $this->Form->input('date_notification');
		echo $this->Form->input('vu');
		echo $this->Form->input('id_profile_send');
		echo $this->Form->input('id_profile_recu');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Notification.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Notification.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Notifications'), array('action' => 'index')); ?></li>
	</ul>
</div>
