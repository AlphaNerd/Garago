<div class="budgets form">
<?php echo $this->Form->create('Budget'); ?>
	<fieldset>
		<legend><?php echo __('Edit Budget'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('plan_id');
		echo $this->Form->input('reference');
		echo $this->Form->input('total');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Budget.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Budget.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Budgets'), array('action' => 'index')); ?></li>
	</ul>
</div>
