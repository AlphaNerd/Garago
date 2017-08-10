<div class="componentLanguages form">
<?php echo $this->Form->create('ComponentLanguage'); ?>
	<fieldset>
		<legend><?php echo __('Edit Component Language'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('component_id');
		echo $this->Form->input('language_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ComponentLanguage.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ComponentLanguage.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Component Languages'), array('action' => 'index')); ?></li>
	</ul>
</div>
