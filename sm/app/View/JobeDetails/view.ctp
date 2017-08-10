<div class="jobeDetails view">
<h2><?php  echo __('Jobe Detail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($jobeDetail['JobeDetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Item'); ?></dt>
		<dd>
			<?php echo h($jobeDetail['JobeDetail']['item']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nbr Temporaire'); ?></dt>
		<dd>
			<?php echo h($jobeDetail['JobeDetail']['nbr_temporaire']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nbr Permanent'); ?></dt>
		<dd>
			<?php echo h($jobeDetail['JobeDetail']['nbr_permanent']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Jobe Detail'), array('action' => 'edit', $jobeDetail['JobeDetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Jobe Detail'), array('action' => 'delete', $jobeDetail['JobeDetail']['id']), null, __('Are you sure you want to delete # %s?', $jobeDetail['JobeDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Jobe Details'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Jobe Detail'), array('action' => 'add')); ?> </li>
	</ul>
</div>
