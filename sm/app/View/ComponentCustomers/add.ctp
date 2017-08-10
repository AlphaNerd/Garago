<div class="componentCustomers form">
<?php echo $this->Form->create('ComponentCustomer'); ?>
	<fieldset>
		<legend><?php echo __('Add Component Customer'); ?></legend>
	<?php
		echo $this->Form->input('component_id');
		echo $this->Form->input('customer_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Component Customers'), array('action' => 'index')); ?></li>
	</ul>
</div>
