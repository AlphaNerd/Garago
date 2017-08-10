<div class="historicals view">
<h2><?php  echo __('Historical'); ?></h2>
	<dl>
		<dt><?php echo __('Period'); ?></dt>
		<dd>
			<?php echo h($historical['Historical']['period']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rabais'); ?></dt>
		<dd>
			<?php echo h($historical['Historical']['rabais']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Offer Id'); ?></dt>
		<dd>
			<?php echo h($historical['Historical']['offer_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Profile Id'); ?></dt>
		<dd>
			<?php echo h($historical['Historical']['profile_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($historical['Historical']['id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Historical'), array('action' => 'edit', $historical['Historical']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Historical'), array('action' => 'delete', $historical['Historical']['id']), null, __('Are you sure you want to delete # %s?', $historical['Historical']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Historicals'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Historical'), array('action' => 'add')); ?> </li>
	</ul>
</div>
