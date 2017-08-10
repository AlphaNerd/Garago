<div class="groupeUsers view">
<h2><?php  echo __('Groupe User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($groupeUser['GroupeUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Users'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupeUser['Users']['id'], array('controller' => 'users', 'action' => 'view', $groupeUser['Users']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo $this->Html->link($groupeUser['Group']['name'], array('controller' => 'groups', 'action' => 'view', $groupeUser['Group']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Groupe User'), array('action' => 'edit', $groupeUser['GroupeUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Groupe User'), array('action' => 'delete', $groupeUser['GroupeUser']['id']), null, __('Are you sure you want to delete # %s?', $groupeUser['GroupeUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Groupe Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Groupe User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Users'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add')); ?> </li>
	</ul>
</div>
