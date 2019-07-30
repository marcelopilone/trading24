<div class="news index">
	<h2><?php echo __('News'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('currency_id'); ?></th>
			<th><?php echo $this->Paginator->sort('24h_volume_usd'); ?></th>
			<th><?php echo $this->Paginator->sort('market_cap_usd'); ?></th>
			<th><?php echo $this->Paginator->sort('available_supply'); ?></th>
			<th><?php echo $this->Paginator->sort('total_supply'); ?></th>
			<th><?php echo $this->Paginator->sort('max_supply'); ?></th>
			<th><?php echo $this->Paginator->sort('percent_change_1h'); ?></th>
			<th><?php echo $this->Paginator->sort('percent_change_24h'); ?></th>
			<th><?php echo $this->Paginator->sort('percent_change_7d'); ?></th>
			<th><?php echo $this->Paginator->sort('rank'); ?></th>
			<th><?php echo $this->Paginator->sort('price_btc'); ?></th>
			<th><?php echo $this->Paginator->sort('price_usd'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($news as $news): ?>
	<tr>
		<td><?php echo h($news['News']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($news['Currency']['name'], array('controller' => 'currencies', 'action' => 'view', $news['Currency']['id'])); ?>
		</td>
		<td><?php echo h($news['News']['24h_volume_usd']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['market_cap_usd']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['available_supply']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['total_supply']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['max_supply']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['percent_change_1h']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['percent_change_24h']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['percent_change_7d']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['rank']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['price_btc']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['price_usd']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['updated']); ?>&nbsp;</td>
		<td><?php echo h($news['News']['created']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $news['News']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $news['News']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $news['News']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $news['News']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New News'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Currencies'), array('controller' => 'currencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency'), array('controller' => 'currencies', 'action' => 'add')); ?> </li>
	</ul>
</div>
