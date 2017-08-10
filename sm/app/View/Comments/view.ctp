<div class="comments view">
<h2><?php  echo __('Comment'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($comment['Comment']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Plan Id'); ?></dt>
		<dd>
			<?php echo h($comment['Comment']['plan_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ref Cellule'); ?></dt>
		<dd>
			<?php echo h($comment['Comment']['ref_cellule']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Send'); ?></dt>
		<dd>
			<?php echo h($comment['Comment']['email_send']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nom'); ?></dt>
		<dd>
			<?php echo h($comment['Comment']['nom']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date Send'); ?></dt>
		<dd>
			<?php echo h($comment['Comment']['date_send']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Organisation'); ?></dt>
		<dd>
			<?php echo h($comment['Comment']['organisation']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($comment['Comment']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email Recive'); ?></dt>
		<dd>
			<?php echo h($comment['Comment']['email_recive']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Comment'), array('action' => 'edit', $comment['Comment']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Comment'), array('action' => 'delete', $comment['Comment']['id']), null, __('Are you sure you want to delete # %s?', $comment['Comment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Comments'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comment'), array('action' => 'add')); ?> </li>
	</ul>
</div>
