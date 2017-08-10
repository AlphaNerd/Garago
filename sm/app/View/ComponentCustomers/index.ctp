<div class="componentCustomers index">
	<h2><?php echo __('Component Customers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('component_id'); ?></th>
			<th><?php echo $this->Paginator->sort('customer_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($componentCustomers as $componentCustomer): ?>
	<tr>
		<td><?php echo h($componentCustomer['ComponentCustomer']['id']); ?>&nbsp;</td>
		<td><?php echo h($componentCustomer['ComponentCustomer']['component_id']); ?>&nbsp;</td>
		<td><?php echo h($componentCustomer['ComponentCustomer']['customer_id']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $componentCustomer['ComponentCustomer']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $componentCustomer['ComponentCustomer']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $componentCustomer['ComponentCustomer']['id']), null, __('Are you sure you want to delete # %s?', $componentCustomer['ComponentCustomer']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Component Customer'), array('action' => 'add')); ?></li>
	</ul>
</div>
