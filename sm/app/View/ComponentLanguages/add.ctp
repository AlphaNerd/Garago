<div class="componentLanguages form">
<?php echo $this->Form->create('ComponentLanguage'); ?>
	<fieldset>
		<legend><?php echo __('Add Component Language'); ?></legend>
	<?php
		echo $this->Form->input('component_id');
		echo $this->Form->input('language_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Component Languages'), array('action' => 'index')); ?></li>
	</ul>
</div>
