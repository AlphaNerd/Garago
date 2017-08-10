<div class="comments form">
<?php echo $this->Form->create('Comment'); ?>
	<fieldset>
		<legend><?php echo __('Add Comment'); ?></legend>
	<?php
		echo $this->Form->input('plan_id');
		echo $this->Form->input('ref_cellule');
		echo $this->Form->input('email_send');
		echo $this->Form->input('nom');
		echo $this->Form->input('date_send');
		echo $this->Form->input('organisation');
		echo $this->Form->input('message');
		echo $this->Form->input('email_recive');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Comments'), array('action' => 'index')); ?></li>
	</ul>
</div>
