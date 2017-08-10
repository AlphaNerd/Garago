<div class="budgets view">
<h2><?php  echo __('Budget'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Plan Id'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['plan_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reference'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['reference']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total'); ?></dt>
		<dd>
			<?php echo h($budget['Budget']['total']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Budget'), array('action' => 'edit', $budget['Budget']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Budget'), array('action' => 'delete', $budget['Budget']['id']), null, __('Are you sure you want to delete # %s?', $budget['Budget']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Budgets'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Budget'), array('action' => 'add')); ?> </li>
	</ul>
</div>
