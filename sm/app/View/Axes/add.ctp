<div class="axes form">
<?php echo $this->Form->create('Axis'); ?>
	<fieldset>
		<legend><?php echo __('Add Axis'); ?></legend>
	<?php
		echo $this->Form->input('titre');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

