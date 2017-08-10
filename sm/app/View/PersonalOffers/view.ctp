<div class="personalOffers view">
<h2><?php  echo __('Personal Offer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($personalOffer['PersonalOffer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($personalOffer['PersonalOffer']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price Ligne'); ?></dt>
		<dd>
			<?php echo h($personalOffer['PersonalOffer']['price_ligne']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Historical Id'); ?></dt>
		<dd>
			<?php echo h($personalOffer['PersonalOffer']['historical_id']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Personal Offer'), array('action' => 'edit', $personalOffer['PersonalOffer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Personal Offer'), array('action' => 'delete', $personalOffer['PersonalOffer']['id']), null, __('Are you sure you want to delete # %s?', $personalOffer['PersonalOffer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Personal Offers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Personal Offer'), array('action' => 'add')); ?> </li>
	</ul>
</div>
