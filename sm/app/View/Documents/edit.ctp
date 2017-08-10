<div class="documents form">
<?php echo $this->Form->create('Document'); ?>
	<fieldset>
		<legend><?php echo __('Edit Document'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('country');
		echo $this->Form->input('them');
		echo $this->Form->input('description');
		echo $this->Form->input('keyword');
		echo $this->Form->input('price');
		echo $this->Form->input('creation_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Document.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Document.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Documents'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Attachments'), array('controller' => 'attachments', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Document Categories'), array('controller' => 'document_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document Category'), array('controller' => 'document_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Document Customers'), array('controller' => 'document_customers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document Customer'), array('controller' => 'document_customers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Document Languges'), array('controller' => 'document_languges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document Language'), array('controller' => 'document_languges', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Document Sectors'), array('controller' => 'document_sectors', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document Sector'), array('controller' => 'document_sectors', 'action' => 'add')); ?> </li>
	</ul>
</div>
