<div class="documentCustomers view">
<h2><?php  echo __('Document Customer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($documentCustomer['DocumentCustomer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Document Id'); ?></dt>
		<dd>
			<?php echo h($documentCustomer['DocumentCustomer']['document_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer Id'); ?></dt>
		<dd>
			<?php echo h($documentCustomer['DocumentCustomer']['customer_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Document Customer'), array('action' => 'edit', $documentCustomer['DocumentCustomer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Document Customer'), array('action' => 'delete', $documentCustomer['DocumentCustomer']['id']), null, __('Are you sure you want to delete # %s?', $documentCustomer['DocumentCustomer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Document Customers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document Customer'), array('action' => 'add')); ?> </li>
	</ul>
</div>
