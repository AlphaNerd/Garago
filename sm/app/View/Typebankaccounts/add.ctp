<div class="typebankaccounts form">
<?php echo $this->Form->create('Typebankaccount'); ?>
	<fieldset>
		<legend><?php echo __('Add Typebankaccount'); ?></legend>
	<?php
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Typebankaccounts'), array('action' => 'index')); ?></li>
	</ul>
</div>
