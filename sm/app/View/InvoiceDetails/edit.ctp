<div class="invoiceDetails form">
<?php echo $this->Form->create('InvoiceDetail'); ?>
	<fieldset>
		<legend><?php echo __('Edit Invoice Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('invoice_ligne');
		echo $this->Form->input('price');
		echo $this->Form->input('quantity');
		echo $this->Form->input('invoice_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('InvoiceDetail.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('InvoiceDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Invoice Details'), array('action' => 'index')); ?></li>
	</ul>
</div>
