<div class="jobeDetails form">
<?php echo $this->Form->create('JobeDetail'); ?>
	<fieldset>
		<legend><?php echo __('Edit Jobe Detail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('item');
		echo $this->Form->input('nbr_temporaire');
		echo $this->Form->input('nbr_permanent');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('JobeDetail.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('JobeDetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Jobe Details'), array('action' => 'index')); ?></li>
	</ul>
</div>
