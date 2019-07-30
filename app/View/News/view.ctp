<div class="news view">
<h2><?php echo __('News'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($news['News']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Currency'); ?></dt>
		<dd>
			<?php echo $this->Html->link($news['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $news['Currency']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('24h Volume Usd'); ?></dt>
		<dd>
			<?php echo h($news['News']['24h_volume_usd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Market Cap Usd'); ?></dt>
		<dd>
			<?php echo h($news['News']['market_cap_usd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Available Supply'); ?></dt>
		<dd>
			<?php echo h($news['News']['available_supply']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Total Supply'); ?></dt>
		<dd>
			<?php echo h($news['News']['total_supply']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Max Supply'); ?></dt>
		<dd>
			<?php echo h($news['News']['max_supply']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Percent Change 1h'); ?></dt>
		<dd>
			<?php echo h($news['News']['percent_change_1h']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Percent Change 24h'); ?></dt>
		<dd>
			<?php echo h($news['News']['percent_change_24h']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Percent Change 7d'); ?></dt>
		<dd>
			<?php echo h($news['News']['percent_change_7d']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rank'); ?></dt>
		<dd>
			<?php echo h($news['News']['rank']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price Btc'); ?></dt>
		<dd>
			<?php echo h($news['News']['price_btc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price Usd'); ?></dt>
		<dd>
			<?php echo h($news['News']['price_usd']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($news['News']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($news['News']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit News'), array('action' => 'edit', $news['News']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete News'), array('action' => 'delete', $news['News']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $news['News']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List News'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New News'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Currencies'), array('controller' => 'currencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency'), array('controller' => 'currencies', 'action' => 'add')); ?> </li>
	</ul>
</div>
