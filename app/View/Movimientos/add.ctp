<script type="text/javascript">
	
	function testPost(){	
		jQuery.ajax({
			type:'POST',
			async: true,
			cache: false,
			url: 'http://localhost/movimientos/add',
			success: function(response) {					
				//success
				console.log(response);                
			},
			error: function(response) {					
				console.log(response);
			},
			data:jQuery('form').serialize()
		});
	}

</script>

<div class="movimientos form">
<?php echo $this->Form->create('Movimiento'); ?>
	<fieldset>
		<legend><?php echo __('Add Movimiento'); ?></legend>
	<?php
		echo $this->Form->input('precio_compra');
		echo $this->Form->input('precio_venta');
		echo $this->Form->input('cant_monedas');
		echo $this->Form->input('moneda_de_intercambio');
		echo $this->Form->input('porcentaje');
		echo $this->Form->input('cantidad_inicial');
		echo $this->Form->input('cantidad_final');
	?>
	</fieldset>
<?php 
echo $this->Form->button('guardar',array(
	'onclick'=>'testPost()',
	'escape' => false,
)
);
?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Movimientos'), array('action' => 'index')); ?></li>
	</ul>
</div>
