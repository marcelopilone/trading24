<div class="movimientos form">
<?php echo $this->Form->create('Movimiento'); ?>
	<fieldset>
		<legend><?php echo __('Edit Movimiento'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('precio_compra');
		echo $this->Form->input('precio_venta');
		echo $this->Form->input('cant_monedas');
		echo $this->Form->input('moneda_de_intercambio');
		echo $this->Form->input('porcentaje');
		echo $this->Form->input('cantidad_inicial');
		echo $this->Form->input('cantidad_final');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Movimiento.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Movimiento.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Movimientos'), array('action' => 'index')); ?></li>
	</ul>
</div>
