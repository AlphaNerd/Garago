<div class="socialProfiles index">
	<h2><?php echo __('Social Profiles'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('social_network_name'); ?></th>
			<th><?php echo $this->Paginator->sort('social_network_id'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('display_name'); ?></th>
			<th><?php echo $this->Paginator->sort('first_name'); ?></th>
			<th><?php echo $this->Paginator->sort('last_name'); ?></th>
			<th><?php echo $this->Paginator->sort('link'); ?></th>
			<th><?php echo $this->Paginator->sort('picture'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('status'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($socialProfiles as $socialProfile): ?>
	<tr>
		<td><?php echo h($socialProfile['SocialProfile']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($socialProfile['User']['id'], array('controller' => 'users', 'action' => 'view', $socialProfile['User']['id'])); ?>
		</td>
		<td><?php echo h($socialProfile['SocialProfile']['social_network_name']); ?>&nbsp;</td>
		<td><?php echo h($socialProfile['SocialProfile']['social_network_id']); ?>&nbsp;</td>
		<td><?php echo h($socialProfile['SocialProfile']['email']); ?>&nbsp;</td>
		<td><?php echo h($socialProfile['SocialProfile']['display_name']); ?>&nbsp;</td>
		<td><?php echo h($socialProfile['SocialProfile']['first_name']); ?>&nbsp;</td>
		<td><?php echo h($socialProfile['SocialProfile']['last_name']); ?>&nbsp;</td>
		<td><?php echo h($socialProfile['SocialProfile']['link']); ?>&nbsp;</td>
		<td><?php echo h($socialProfile['SocialProfile']['picture']); ?>&nbsp;</td>
		<td><?php echo h($socialProfile['SocialProfile']['created']); ?>&nbsp;</td>
		<td><?php echo h($socialProfile['SocialProfile']['modified']); ?>&nbsp;</td>
		<td><?php echo h($socialProfile['SocialProfile']['status']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $socialProfile['SocialProfile']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $socialProfile['SocialProfile']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $socialProfile['SocialProfile']['id']), null, __('Are you sure you want to delete # %s?', $socialProfile['SocialProfile']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Social Profile'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
