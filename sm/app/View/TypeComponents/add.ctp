<div class="typeComponents form">
<?php echo $this->Form->create('TypeComponent'); ?>
	<fieldset>
		<legend><?php echo __('Add Type Component'); ?></legend>
	<?php
		echo $this->Form->input('description');
		echo $this->Form->input('prix');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Type Components'), array('action' => 'index')); ?></li>
	</ul>
</div>
