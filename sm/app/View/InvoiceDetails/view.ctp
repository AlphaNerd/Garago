<div class="invoiceDetails view">
<h2><?php  echo __('Invoice Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($invoiceDetail['InvoiceDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Invoice Ligne'); ?></dt>
		<dd>
			<?php echo h($invoiceDetail['InvoiceDetail']['invoice_ligne']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($invoiceDetail['InvoiceDetail']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Quantity'); ?></dt>
		<dd>
			<?php echo h($invoiceDetail['InvoiceDetail']['quantity']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Invoice Id'); ?></dt>
		<dd>
			<?php echo h($invoiceDetail['InvoiceDetail']['invoice_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Invoice Detail'), array('action' => 'edit', $invoiceDetail['InvoiceDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Invoice Detail'), array('action' => 'delete', $invoiceDetail['InvoiceDetail']['id']), null, __('Are you sure you want to delete # %s?', $invoiceDetail['InvoiceDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Invoice Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Invoice Detail'), array('action' => 'add')); ?> </li>
	</ul>
</div>
