<div class="permissionAccesses form">
<?php echo $this->Form->create('PermissionAccess'); ?>
	<fieldset>
		<legend><?php echo __('Add Permission Access'); ?></legend>
	<?php
		echo $this->Form->input('personal_offers_id');
		echo $this->Form->input('task_id');
		echo $this->Form->input('permission');
		echo $this->Form->input('groupe_id');
		echo $this->Form->input('date_debut');
		echo $this->Form->input('date_fin');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Permission Accesses'), array('action' => 'index')); ?></li>
	</ul>
</div>
