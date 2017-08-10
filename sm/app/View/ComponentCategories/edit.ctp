<div class="componentCategories form">
<?php echo $this->Form->create('ComponentCategory'); ?>
	<fieldset>
		<legend><?php echo __('Edit Component Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('component_id');
		echo $this->Form->input('category_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ComponentCategory.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ComponentCategory.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Component Categories'), array('action' => 'index')); ?></li>
	</ul>
</div>
