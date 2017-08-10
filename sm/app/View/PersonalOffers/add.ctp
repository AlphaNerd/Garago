<div class="personalOffers form">
<?php echo $this->Form->create('PersonalOffer'); ?>
	<fieldset>
		<legend><?php echo __('Add Personal Offer'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Personal Offers'), array('action' => 'index')); ?></li>
	</ul>
</div>
