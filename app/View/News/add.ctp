<div class="news form">
<?php echo $this->Form->create('News'); ?>
	<fieldset>
		<legend><?php echo __('Add News'); ?></legend>
	<?php
		echo $this->Form->input('currency_id');
		echo $this->Form->input('24h_volume_usd');
		echo $this->Form->input('market_cap_usd');
		echo $this->Form->input('available_supply');
		echo $this->Form->input('total_supply');
		echo $this->Form->input('max_supply');
		echo $this->Form->input('percent_change_1h');
		echo $this->Form->input('percent_change_24h');
		echo $this->Form->input('percent_change_7d');
		echo $this->Form->input('rank');
		echo $this->Form->input('price_btc');
		echo $this->Form->input('price_usd');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List News'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Currencies'), array('controller' => 'currencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency'), array('controller' => 'currencies', 'action' => 'add')); ?> </li>
	</ul>
</div>
