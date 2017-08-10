<div class="documentSectors form">
<?php echo $this->Form->create('DocumentSector'); ?>
	<fieldset>
		<legend><?php echo __('Add Document Sector'); ?></legend>
	<?php
		echo $this->Form->input('document_id');
		echo $this->Form->input('sector_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Document Sectors'), array('action' => 'index')); ?></li>
	</ul>
</div>
