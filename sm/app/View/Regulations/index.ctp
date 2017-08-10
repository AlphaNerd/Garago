<div class="regulations index">
	<h2><?php echo __('Regulations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('total_price'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($regulations as $regulation): ?>
	<tr>
		<td><?php echo h($regulation['Regulation']['id']); ?>&nbsp;</td>
		<td><?php echo h($regulation['Regulation']['name']); ?>&nbsp;</td>
		<td><?php echo h($regulation['Regulation']['date']); ?>&nbsp;</td>
		<td><?php echo h($regulation['Regulation']['total_price']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $regulation['Regulation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $regulation['Regulation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $regulation['Regulation']['id']), null, __('Are you sure you want to delete # %s?', $regulation['Regulation']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Regulation'), array('action' => 'add')); ?></li>
	</ul>
</div>
