<div class="regulations form">
<?php echo $this->Form->create('Regulation'); ?>
	<fieldset>
		<legend><?php echo __('Edit Regulation'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('date');
		echo $this->Form->input('total_price');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Regulation.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Regulation.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Regulations'), array('action' => 'index')); ?></li>
	</ul>
</div>
