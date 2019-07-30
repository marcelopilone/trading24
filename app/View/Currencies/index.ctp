<h2><?php echo __('Currencies'); ?></h2>
<div class="row">
	<div class="col-md-12 col-xs-12">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
			<li><?php echo $this->Html->link(__('New Currency'), array('action' => 'add')); ?></li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-xs-12">
	<table class="table">
			<thead>
			<tr>
					<th><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo $this->Paginator->sort('currency'); ?></th>
					<th><?php echo $this->Paginator->sort('image'); ?></th>
					<th><?php echo $this->Paginator->sort('votes'); ?></th>
					<th><?php echo __('Actions'); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($currencies as $currency): ?>
			<tr>
				<td><?php echo h($currency['Currency']['id']); ?>&nbsp;</td>
				<td><?php echo h($currency['Currency']['currency']); ?>&nbsp;</td>
				<td><?php echo h($currency['Currency']['image']); ?>&nbsp;</td>
				<td><?php echo h($currency['Currency']['votes']); ?>&nbsp;</td>
				<td class="actions">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $currency['Currency']['id'])); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $currency['Currency']['id'])); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $currency['Currency']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $currency['Currency']['id']))); ?>
				</td>
			</tr>
		<?php endforeach; ?>
			</tbody>
	</table>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-xs-12">
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
</div>

