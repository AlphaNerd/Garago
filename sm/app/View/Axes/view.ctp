<div class="axes view">
<h2><?php  echo __('Axis'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($axis['Axis']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Titre'); ?></dt>
		<dd>
			<?php echo h($axis['Axis']['titre']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Axis'), array('action' => 'edit', $axis['Axis']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Axis'), array('action' => 'delete', $axis['Axis']['id']), null, __('Are you sure you want to delete # %s?', $axis['Axis']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Axes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Axis'), array('action' => 'add')); ?> </li>
	</ul>
</div>
