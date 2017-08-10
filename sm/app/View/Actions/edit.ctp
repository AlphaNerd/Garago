<div class="actions form">
<?php echo $this->Form->create('Action'); ?>
	<fieldset>
		<legend><?php echo __('Edit Action'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('document_id');
		echo $this->Form->input('profile_id');
		echo $this->Form->input('type');
		echo $this->Form->input('date_action');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Action.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Action.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Actions'), array('action' => 'index')); ?></li>
	</ul>
</div>
