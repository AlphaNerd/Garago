<div class="documents view">
<h2><?php  echo __('Document'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($document['Document']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($document['Document']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($document['Document']['country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Them'); ?></dt>
		<dd>
			<?php echo h($document['Document']['them']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($document['Document']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Keyword'); ?></dt>
		<dd>
			<?php echo h($document['Document']['keyword']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo h($document['Document']['price']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Creation Date'); ?></dt>
		<dd>
			<?php echo h($document['Document']['creation_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Document'), array('action' => 'edit', $document['Document']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Document'), array('action' => 'delete', $document['Document']['id']), null, __('Are you sure you want to delete # %s?', $document['Document']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Documents'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document'), array('action' => 'add')); ?> </li>
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
<div class="related">
	<h3><?php echo __('Related Attachments'); ?></h3>
	<?php if (!empty($document['Attachment'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Keyword'); ?></th>
		<th><?php echo __('Url'); ?></th>
		<th><?php echo __('Extension'); ?></th>
		<th><?php echo __('Document Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($document['Attachment'] as $attachment): ?>
		<tr>
			<td><?php echo $attachment['id']; ?></td>
			<td><?php echo $attachment['name']; ?></td>
			<td><?php echo $attachment['keyword']; ?></td>
			<td><?php echo $attachment['url']; ?></td>
			<td><?php echo $attachment['extension']; ?></td>
			<td><?php echo $attachment['document_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'attachments', 'action' => 'view', $attachment['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'attachments', 'action' => 'edit', $attachment['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'attachments', 'action' => 'delete', $attachment['id']), null, __('Are you sure you want to delete # %s?', $attachment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Attachment'), array('controller' => 'attachments', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Document Categories'); ?></h3>
	<?php if (!empty($document['DocumentCategory'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Document Id'); ?></th>
		<th><?php echo __('Categorie Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($document['DocumentCategory'] as $documentCategory): ?>
		<tr>
			<td><?php echo $documentCategory['id']; ?></td>
			<td><?php echo $documentCategory['document_id']; ?></td>
			<td><?php echo $documentCategory['categorie_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'document_categories', 'action' => 'view', $documentCategory['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'document_categories', 'action' => 'edit', $documentCategory['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'document_categories', 'action' => 'delete', $documentCategory['id']), null, __('Are you sure you want to delete # %s?', $documentCategory['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Document Category'), array('controller' => 'document_categories', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Document Customers'); ?></h3>
	<?php if (!empty($document['DocumentCustomer'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Document Id'); ?></th>
		<th><?php echo __('Customer Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($document['DocumentCustomer'] as $documentCustomer): ?>
		<tr>
			<td><?php echo $documentCustomer['id']; ?></td>
			<td><?php echo $documentCustomer['document_id']; ?></td>
			<td><?php echo $documentCustomer['customer_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'document_customers', 'action' => 'view', $documentCustomer['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'document_customers', 'action' => 'edit', $documentCustomer['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'document_customers', 'action' => 'delete', $documentCustomer['id']), null, __('Are you sure you want to delete # %s?', $documentCustomer['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Document Customer'), array('controller' => 'document_customers', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Document Languges'); ?></h3>
	<?php if (!empty($document['DocumentLanguge'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Document Id'); ?></th>
		<th><?php echo __('Language Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($document['DocumentLanguge'] as $documentLanguge): ?>
		<tr>
			<td><?php echo $documentLanguge['id']; ?></td>
			<td><?php echo $documentLanguge['document_id']; ?></td>
			<td><?php echo $documentLanguge['languge_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'document_languges', 'action' => 'view', $documentLanguge['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'document_languges', 'action' => 'edit', $documentLanguge['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'document_languges', 'action' => 'delete', $documentLanguge['id']), null, __('Are you sure you want to delete # %s?', $documentLanguge['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Document Language'), array('controller' => 'document_languges', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Document Sectors'); ?></h3>
	<?php if (!empty($document['DocumentSector'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Document Id'); ?></th>
		<th><?php echo __('Sector Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($document['DocumentSector'] as $documentSector): ?>
		<tr>
			<td><?php echo $documentSector['id']; ?></td>
			<td><?php echo $documentSector['document_id']; ?></td>
			<td><?php echo $documentSector['sector_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'document_sectors', 'action' => 'view', $documentSector['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'document_sectors', 'action' => 'edit', $documentSector['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'document_sectors', 'action' => 'delete', $documentSector['id']), null, __('Are you sure you want to delete # %s?', $documentSector['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Document Sector'), array('controller' => 'document_sectors', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
