<div class="typebankaccounts form">
<?php echo $this->Form->create('Typebankaccount'); ?>
	<fieldset>
		<legend><?php echo __('Edit Typebankaccount'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('description');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Typebankaccount.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Typebankaccount.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Typebankaccounts'), array('action' => 'index')); ?></li>
	</ul>
</div>
