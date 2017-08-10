<div class="historicals form">
<?php echo $this->Form->create('Historical'); ?>
	<fieldset>
		<legend><?php echo __('Add Historical'); ?></legend>
	<?php
		echo $this->Form->input('period');
		echo $this->Form->input('rabais');
		echo $this->Form->input('offer_id');
		echo $this->Form->input('profile_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Historicals'), array('action' => 'index')); ?></li>
	</ul>
</div>
