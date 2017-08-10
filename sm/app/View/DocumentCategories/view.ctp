<div class="documentCategories view">
<h2><?php  echo __('Document Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($documentCategory['DocumentCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Document Id'); ?></dt>
		<dd>
			<?php echo h($documentCategory['DocumentCategory']['document_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Categorie Id'); ?></dt>
		<dd>
			<?php echo h($documentCategory['DocumentCategory']['categorie_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Document Category'), array('action' => 'edit', $documentCategory['DocumentCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Document Category'), array('action' => 'delete', $documentCategory['DocumentCategory']['id']), null, __('Are you sure you want to delete # %s?', $documentCategory['DocumentCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Document Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Document Category'), array('action' => 'add')); ?> </li>
	</ul>
</div>
