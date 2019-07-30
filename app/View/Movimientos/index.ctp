<div class="movimientos index">
	<h2><?php echo __('Movimientos'); ?></h2>
	<table class="table table-stripped">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('precio_compra'); ?></th>
			<th><?php echo $this->Paginator->sort('precio_venta'); ?></th>
			<th><?php echo $this->Paginator->sort('cant_monedas'); ?></th>
			<th><?php echo $this->Paginator->sort('moneda_de_intercambio'); ?></th>
			<th><?php echo $this->Paginator->sort('porcentaje'); ?></th>
			<th><?php echo $this->Paginator->sort('cantidad_inicial'); ?></th>
			<th><?php echo $this->Paginator->sort('cantidad_final'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($movimientos as $movimiento): ?>
	<tr>
		<td><?php echo h($movimiento['Movimiento']['id']); ?>&nbsp;</td>
		<td><?php echo h($movimiento['Movimiento']['precio_compra']); ?>&nbsp;</td>
		<td><?php echo h($movimiento['Movimiento']['precio_venta']); ?>&nbsp;</td>
		<td><?php echo h($movimiento['Movimiento']['cant_monedas']); ?>&nbsp;</td>
		<td><?php echo h($movimiento['Movimiento']['moneda_de_intercambio']); ?>&nbsp;</td>
		<td><?php echo h($movimiento['Movimiento']['porcentaje']); ?>&nbsp;</td>
		<td><?php echo h($movimiento['Movimiento']['cantidad_inicial']); ?>&nbsp;</td>
		<td><?php echo h($movimiento['Movimiento']['cantidad_final']); ?>&nbsp;</td>
		<td><?php echo h($movimiento['Movimiento']['created']); ?>&nbsp;</td>
		<td><?php echo h($movimiento['Movimiento']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $movimiento['Movimiento']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $movimiento['Movimiento']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $movimiento['Movimiento']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $movimiento['Movimiento']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Movimiento'), array('action' => 'add')); ?></li>
	</ul>
</div>
