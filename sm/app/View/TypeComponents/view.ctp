<div class="typeComponents view">
<h2><?php  echo __('Type Component'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($typeComponent['TypeComponent']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($typeComponent['TypeComponent']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Prix'); ?></dt>
		<dd>
			<?php echo h($typeComponent['TypeComponent']['prix']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Type Component'), array('action' => 'edit', $typeComponent['TypeComponent']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Type Component'), array('action' => 'delete', $typeComponent['TypeComponent']['id']), null, __('Are you sure you want to delete # %s?', $typeComponent['TypeComponent']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Type Components'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Type Component'), array('action' => 'add')); ?> </li>
	</ul>
</div>
