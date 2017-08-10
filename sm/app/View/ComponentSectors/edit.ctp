<div class="componentSectors form">
<?php echo $this->Form->create('ComponentSector'); ?>
	<fieldset>
		<legend><?php echo __('Edit Component Sector'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('component_id');
		echo $this->Form->input('sector_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ComponentSector.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ComponentSector.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Component Sectors'), array('action' => 'index')); ?></li>
	</ul>
</div>
