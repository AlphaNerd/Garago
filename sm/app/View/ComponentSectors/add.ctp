<div class="componentSectors form">
<?php echo $this->Form->create('ComponentSector'); ?>
	<fieldset>
		<legend><?php echo __('Add Component Sector'); ?></legend>
	<?php
		echo $this->Form->input('component_id');
		echo $this->Form->input('sector_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Component Sectors'), array('action' => 'index')); ?></li>
	</ul>
</div>
