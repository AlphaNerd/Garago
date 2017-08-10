<div class="detailPlans view">
<h2><?php  echo __('Detail Plan'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($detailPlan['DetailPlan']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id Plan'); ?></dt>
		<dd>
			<?php echo h($detailPlan['DetailPlan']['id_plan']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Id Profile'); ?></dt>
		<dd>
			<?php echo h($detailPlan['DetailPlan']['id_profile']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Modification'); ?></dt>
		<dd>
			<?php echo h($detailPlan['DetailPlan']['date_modification']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo h($detailPlan['DetailPlan']['content']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Detail Plan'), array('action' => 'edit', $detailPlan['DetailPlan']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Detail Plan'), array('action' => 'delete', $detailPlan['DetailPlan']['id']), null, __('Are you sure you want to delete # %s?', $detailPlan['DetailPlan']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Detail Plans'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detail Plan'), array('action' => 'add')); ?> </li>
	</ul>
</div>
