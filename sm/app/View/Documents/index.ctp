<div class="documents index">
	<h2><?php echo __('Documents'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('country'); ?></th>
			<th><?php echo $this->Paginator->sort('them'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('keyword'); ?></th>
			<th><?php echo $this->Paginator->sort('price'); ?></th>
			<th><?php echo $this->Paginator->sort('creation_date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($documents as $document): ?>
	<tr>
		<td><?php echo h($document['Document']['id']); ?>&nbsp;</td>
		<td><?php echo h($document['Document']['name']); ?>&nbsp;</td>
		<td><?php echo h($document['Document']['country']); ?>&nbsp;</td>
		<td><?php echo h($document['Document']['them']); ?>&nbsp;</td>
		<td><?php echo h($document['Document']['description']); ?>&nbsp;</td>
		<td><?php echo h($document['Document']['keyword']); ?>&nbsp;</td>
		<td><?php echo h($document['Document']['price']); ?>&nbsp;</td>
		<td><?php echo h($document['Document']['creation_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $document['Document']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $document['Document']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $document['Document']['id']), null, __('Are you sure you want to delete # %s?', $document['Document']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Document'), array('action' => 'add')); ?></li>
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
