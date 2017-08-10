<div class="axes form">
<?php echo $this->Form->create('Axis'); ?>
	<fieldset>
		<legend><?php echo __('Edit Axis'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('titre');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Axis.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Axis.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Axes'), array('action' => 'index')); ?></li>
	</ul>
</div>
