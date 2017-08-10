<div class="detailPlans form">
<?php echo $this->Form->create('DetailPlan'); ?>
	<fieldset>
		<legend><?php echo __('Add Detail Plan'); ?></legend>
	<?php
		echo $this->Form->input('id_plan');
		echo $this->Form->input('id_profile');
		echo $this->Form->input('date_modification');
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Detail Plans'), array('action' => 'index')); ?></li>
	</ul>
</div>
