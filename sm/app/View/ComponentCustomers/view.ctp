<div class="componentCustomers view">
<h2><?php  echo __('Component Customer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($componentCustomer['ComponentCustomer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Component Id'); ?></dt>
		<dd>
			<?php echo h($componentCustomer['ComponentCustomer']['component_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Customer Id'); ?></dt>
		<dd>
			<?php echo h($componentCustomer['ComponentCustomer']['customer_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Component Customer'), array('action' => 'edit', $componentCustomer['ComponentCustomer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Component Customer'), array('action' => 'delete', $componentCustomer['ComponentCustomer']['id']), null, __('Are you sure you want to delete # %s?', $componentCustomer['ComponentCustomer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Component Customers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Component Customer'), array('action' => 'add')); ?> </li>
	</ul>
</div>
