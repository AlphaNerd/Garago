<div class="socialProfiles form">
<?php echo $this->Form->create('SocialProfile'); ?>
	<fieldset>
		<legend><?php echo __('Edit Social Profile'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('social_network_name');
		echo $this->Form->input('social_network_id');
		echo $this->Form->input('email');
		echo $this->Form->input('display_name');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('link');
		echo $this->Form->input('picture');
		echo $this->Form->input('status');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('SocialProfile.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('SocialProfile.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Social Profiles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
