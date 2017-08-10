<div class="componentLanguages view">
<h2><?php  echo __('Component Language'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($componentLanguage['ComponentLanguage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Component Id'); ?></dt>
		<dd>
			<?php echo h($componentLanguage['ComponentLanguage']['component_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Language Id'); ?></dt>
		<dd>
			<?php echo h($componentLanguage['ComponentLanguage']['language_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Component Language'), array('action' => 'edit', $componentLanguage['ComponentLanguage']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Component Language'), array('action' => 'delete', $componentLanguage['ComponentLanguage']['id']), null, __('Are you sure you want to delete # %s?', $componentLanguage['ComponentLanguage']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Component Languages'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Component Language'), array('action' => 'add')); ?> </li>
	</ul>
</div>
