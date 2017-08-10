<div class="documentCategories form">
<?php echo $this->Form->create('DocumentCategory'); ?>
	<fieldset>
		<legend><?php echo __('Edit Document Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('document_id');
		echo $this->Form->input('categorie_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('DocumentCategory.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('DocumentCategory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Document Categories'), array('action' => 'index')); ?></li>
	</ul>
</div>
