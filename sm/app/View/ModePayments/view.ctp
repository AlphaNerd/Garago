<div class="modePayments view">
<h2><?php  echo __('Mode Payment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($modePayment['ModePayment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($modePayment['ModePayment']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Mode Payment'), array('action' => 'edit', $modePayment['ModePayment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Mode Payment'), array('action' => 'delete', $modePayment['ModePayment']['id']), null, __('Are you sure you want to delete # %s?', $modePayment['ModePayment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Mode Payments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mode Payment'), array('action' => 'add')); ?> </li>
	</ul>
</div>
