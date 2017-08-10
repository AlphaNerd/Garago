<div class="actions view">
<h2><?php  echo __('Action'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($action['Action']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Document Id'); ?></dt>
		<dd>
			<?php echo h($action['Action']['document_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Profile Id'); ?></dt>
		<dd>
			<?php echo h($action['Action']['profile_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($action['Action']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Action'); ?></dt>
		<dd>
			<?php echo h($action['Action']['date_action']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Action'), array('action' => 'edit', $action['Action']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Action'), array('action' => 'delete', $action['Action']['id']), null, __('Are you sure you want to delete # %s?', $action['Action']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Actions'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Action'), array('action' => 'add')); ?> </li>
	</ul>
</div>
