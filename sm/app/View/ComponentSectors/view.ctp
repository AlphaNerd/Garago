<div class="componentSectors view">
<h2><?php  echo __('Component Sector'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($componentSector['ComponentSector']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Component Id'); ?></dt>
		<dd>
			<?php echo h($componentSector['ComponentSector']['component_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sector Id'); ?></dt>
		<dd>
			<?php echo h($componentSector['ComponentSector']['sector_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Component Sector'), array('action' => 'edit', $componentSector['ComponentSector']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Component Sector'), array('action' => 'delete', $componentSector['ComponentSector']['id']), null, __('Are you sure you want to delete # %s?', $componentSector['ComponentSector']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Component Sectors'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Component Sector'), array('action' => 'add')); ?> </li>
	</ul>
</div>
