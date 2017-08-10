<div class="documentSectors view">
<h2><?php  echo __('Document Sector'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($documentSector['DocumentSector']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Document Id'); ?></dt>
		<dd>
			<?php echo h($documentSector['DocumentSector']['document_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sector Id'); ?></dt>
		<dd>
			<?php echo h($documentSector['DocumentSector']['sector_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Document Sector'), array('action' => 'edit', $documentSector['DocumentSector']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Document Sector'), array('action' => 'delete', $documentSector['DocumentSector']['id']), null, __('Are you sure you want to delete # %s?', $documentSector['DocumentSector']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Document Sectors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document Sector'), array('action' => 'add')); ?> </li>
	</ul>
</div>
