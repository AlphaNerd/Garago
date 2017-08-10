<div class="budgetDetails form">
<?php echo $this->Form->create('BudgetDetail'); ?>
	<fieldset>
		<legend><?php echo __('Add Budget Detail'); ?></legend>
	<?php
		echo $this->Form->input('item');
		echo $this->Form->input('amount');
		echo $this->Form->input('In-kind');
		echo $this->Form->input('source');
		echo $this->Form->input('status');
		echo $this->Form->input('budget_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Budget Details'), array('action' => 'index')); ?></li>
	</ul>
</div>
