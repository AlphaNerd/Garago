<div class="regulations view">
<h2><?php  echo __('Regulation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($regulation['Regulation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($regulation['Regulation']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($regulation['Regulation']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Price'); ?></dt>
		<dd>
			<?php echo h($regulation['Regulation']['total_price']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Regulation'), array('action' => 'edit', $regulation['Regulation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Regulation'), array('action' => 'delete', $regulation['Regulation']['id']), null, __('Are you sure you want to delete # %s?', $regulation['Regulation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Regulations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Regulation'), array('action' => 'add')); ?> </li>
	</ul>
</div>
