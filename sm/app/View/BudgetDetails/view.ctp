<div class="budgetDetails view">
<h2><?php  echo __('Budget Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($budgetDetail['BudgetDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo h($budgetDetail['BudgetDetail']['item']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Amount'); ?></dt>
		<dd>
			<?php echo h($budgetDetail['BudgetDetail']['amount']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('In-kind'); ?></dt>
		<dd>
			<?php echo h($budgetDetail['BudgetDetail']['In-kind']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Source'); ?></dt>
		<dd>
			<?php echo h($budgetDetail['BudgetDetail']['source']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($budgetDetail['BudgetDetail']['status']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Budget Id'); ?></dt>
		<dd>
			<?php echo h($budgetDetail['BudgetDetail']['budget_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Budget Detail'), array('action' => 'edit', $budgetDetail['BudgetDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Budget Detail'), array('action' => 'delete', $budgetDetail['BudgetDetail']['id']), null, __('Are you sure you want to delete # %s?', $budgetDetail['BudgetDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Budget Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Budget Detail'), array('action' => 'add')); ?> </li>
	</ul>
</div>
