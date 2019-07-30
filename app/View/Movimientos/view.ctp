<div class="movimientos view">
<h2><?php echo __('Movimiento'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($movimiento['Movimiento']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Precio Compra'); ?></dt>
		<dd>
			<?php echo h($movimiento['Movimiento']['precio_compra']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Precio Venta'); ?></dt>
		<dd>
			<?php echo h($movimiento['Movimiento']['precio_venta']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Moneda'); ?></dt>
		<dd>
			<?php echo h($movimiento['Movimiento']['cant_monedas']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Moneda De Intercambio'); ?></dt>
		<dd>
			<?php echo h($movimiento['Movimiento']['moneda_de_intercambio']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Porcentaje'); ?></dt>
		<dd>
			<?php echo h($movimiento['Movimiento']['porcentaje']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cantidad Inicial'); ?></dt>
		<dd>
			<?php echo h($movimiento['Movimiento']['cantidad_inicial']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cantidad Final'); ?></dt>
		<dd>
			<?php echo h($movimiento['Movimiento']['cantidad_final']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Movimiento'), array('action' => 'edit', $movimiento['Movimiento']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Movimiento'), array('action' => 'delete', $movimiento['Movimiento']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $movimiento['Movimiento']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Movimientos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Movimiento'), array('action' => 'add')); ?> </li>
	</ul>
</div>
