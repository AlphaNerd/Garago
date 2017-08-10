<div class="plans form">
<?php echo $this->Form->create('Plan'); ?>
	<fieldset>
		<legend><?php echo __('Add Plan'); ?></legend>
	<?php
		echo $this->Form->input('titre');
		echo $this->Form->input('date_creartion');
		echo $this->Form->input('adress');
		echo $this->Form->input('logo');
		echo $this->Form->input('prix');
		echo $this->Form->input('profile_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Plans'), array('action' => 'index')); ?></li>
	</ul>
</div>
