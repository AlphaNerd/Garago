<div class="socialProfiles view">
<h2><?php  echo __('Social Profile'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($socialProfile['SocialProfile']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($socialProfile['User']['id'], array('controller' => 'users', 'action' => 'view', $socialProfile['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Social Network Name'); ?></dt>
		<dd>
			<?php echo h($socialProfile['SocialProfile']['social_network_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Social Network Id'); ?></dt>
		<dd>
			<?php echo h($socialProfile['SocialProfile']['social_network_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($socialProfile['SocialProfile']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Display Name'); ?></dt>
		<dd>
			<?php echo h($socialProfile['SocialProfile']['display_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($socialProfile['SocialProfile']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($socialProfile['SocialProfile']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Link'); ?></dt>
		<dd>
			<?php echo h($socialProfile['SocialProfile']['link']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Picture'); ?></dt>
		<dd>
			<?php echo h($socialProfile['SocialProfile']['picture']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($socialProfile['SocialProfile']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($socialProfile['SocialProfile']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Status'); ?></dt>
		<dd>
			<?php echo h($socialProfile['SocialProfile']['status']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Social Profile'), array('action' => 'edit', $socialProfile['SocialProfile']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Social Profile'), array('action' => 'delete', $socialProfile['SocialProfile']['id']), null, __('Are you sure you want to delete # %s?', $socialProfile['SocialProfile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Social Profiles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Social Profile'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
