<div class="documentCategories form">
<?php echo $this->Form->create('DocumentCategory'); ?>
	<fieldset>
		<legend><?php echo __('Add Document Category'); ?></legend>
	<?php
		echo $this->Form->input('document_id');
		echo $this->Form->input('categorie_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Document Categories'), array('action' => 'index')); ?></li>
	</ul>
</div>
