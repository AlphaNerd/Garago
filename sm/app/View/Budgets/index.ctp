<div class="budgets index">
	<h2><?php echo __('Budgets'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('plan_id'); ?></th>
			<th><?php echo $this->Paginator->sort('reference'); ?></th>
			<th><?php echo $this->Paginator->sort('total'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($budgets as $budget): ?>
	<tr>
		<td><?php echo h($budget['Budget']['id']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['plan_id']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['reference']); ?>&nbsp;</td>
		<td><?php echo h($budget['Budget']['total']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $budget['Budget']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $budget['Budget']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $budget['Budget']['id']), null, __('Are you sure you want to delete # %s?', $budget['Budget']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Budget'), array('action' => 'add')); ?></li>
	</ul>
</div>
