<div class="componentCategories view">
<h2><?php  echo __('Component Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($componentCategory['ComponentCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Component Id'); ?></dt>
		<dd>
			<?php echo h($componentCategory['ComponentCategory']['component_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category Id'); ?></dt>
		<dd>
			<?php echo h($componentCategory['ComponentCategory']['category_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Component Category'), array('action' => 'edit', $componentCategory['ComponentCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Component Category'), array('action' => 'delete', $componentCategory['ComponentCategory']['id']), null, __('Are you sure you want to delete # %s?', $componentCategory['ComponentCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Component Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Component Category'), array('action' => 'add')); ?> </li>
	</ul>
</div>
