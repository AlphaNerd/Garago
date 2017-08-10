<div class="typebankaccounts view">
<h2><?php  echo __('Typebankaccount'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($typebankaccount['Typebankaccount']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($typebankaccount['Typebankaccount']['description']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Typebankaccount'), array('action' => 'edit', $typebankaccount['Typebankaccount']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Typebankaccount'), array('action' => 'delete', $typebankaccount['Typebankaccount']['id']), null, __('Are you sure you want to delete # %s?', $typebankaccount['Typebankaccount']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Typebankaccounts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Typebankaccount'), array('action' => 'add')); ?> </li>
	</ul>
</div>
