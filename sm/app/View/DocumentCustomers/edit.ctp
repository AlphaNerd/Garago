<div class="documentCustomers form">
<?php echo $this->Form->create('DocumentCustomer'); ?>
	<fieldset>
		<legend><?php echo __('Edit Document Customer'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('document_id');
		echo $this->Form->input('customer_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('DocumentCustomer.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('DocumentCustomer.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Document Customers'), array('action' => 'index')); ?></li>
	</ul>
</div>
