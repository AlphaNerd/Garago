<div class="personalOffers form">
<?php echo $this->Form->create('PersonalOffer'); ?>
	<fieldset>
		<legend><?php echo __('Edit Personal Offer'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('price_ligne');
		echo $this->Form->input('historical_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PersonalOffer.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('PersonalOffer.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Personal Offers'), array('action' => 'index')); ?></li>
	</ul>
</div>
