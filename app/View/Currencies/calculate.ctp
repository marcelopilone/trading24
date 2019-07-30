<h2 class="center">How many times do I have to win?</h2>
<h3></h3>
<?php 
	
	echo $this->Form->create('Currency', 
		array(
			'url' => array(
					'controller' => 'currencies', 
					'action' => 'calculate'
			),
		)
	);
?>	
<div class="row">
	<div class="col-md-4 col-xs-4">
		<label>Mount</label>
<?php
	echo $this->Form->text('mount',array(
			'placeholder' => 'Mount(USD)',
			'class' => 'form-control',
			'required' => true,
			'maxlength' => 10
			//'oninvalid' => "this.setCustomValidity('Please enter a mount, for example: 100')"
  	));
?>
	</div>
	<div class="col-md-4 col-xs-4">
		<label>Times</label>
<?php
  	echo $this->Form->text('times',array(
			'placeholder' => 'Times',
			'class' => 'form-control ',
			'required' => true,
			'maxlength' => 10
			//'oninvalid' => "this.setCustomValidity('Please enter a number of times, for example:3')"
  	));
?>
	</div>
	<div class="col-md-4 col-xs-4">
		<label>Percent</label>
<?php
  	echo $this->Form->text('percent',array(
			'placeholder' => 'Percent(%)',
			'class' => 'form-control',
			'required' => true,
			'maxlength' => 10
			//'oninvalid' => "this.setCustomValidity('Please enter a percent, for example:10')"
  	));
?>
	</div>
</div><br/>
<div class="row">
	<div class="col-md-4 col-xs-4">
					<a href="http://buythemoon.org/currencies/calculate" class="btn btn-primary btn-block">Reset</a>
				</div>
	<div class="col-md-8 col-xs-8">
		<?php 
						$options = array('label' => 'Calculate', 'class' => 'btn btn-success btn-block color-blanco', 'div' => false);
						echo $this->Form->end($options);
		?>
	</div>
</div>
<?php if( !empty( $result ) ){ 
	$lastResult = end($result);
	?><br/>
	<h4 class="center">
		If your initial mount is <strong><?php echo $this->Number->currency($result[0]['inicial'],$currency='USD');?></strong>
		and you increase it <strong><?php echo $percent;?>%</strong> percent <strong><?php echo $lastResult['vez'];?></strong> times,
		you would have <strong><?php echo $this->Number->currency($lastResult['termino'],$currency='USD');?></strong>.<br/>Details:
	</h4>
	<table class="table center table-striped" style="background-color: white; color:black;">
		<thead>
			<tr>
				<td><strong>Initial amount</strong></td>
				<td><strong>x <?php echo $percent;?>%</strong> </td>
				<td><strong>Result</strong></td>
			</tr>
		</thead>
		<tbody>
	<?php
	foreach( $result as $r ){
?>	
			<tr>
				<td><?php echo $this->Number->currency($r['inicial'],$currency='USD');?></td>
				<td> <?php echo $r['vez'];?> <i class="glyphicon glyphicon-circle-arrow-right"></i> </td>
				<td><?php echo $this->Number->currency($r['termino'],$currency='USD');?></td>
			</tr>
		
<?php
	}
	?>
	</tbody>
	</table>
	<?php
}else{
	?>
	<h3 class="center">
		For example if you get 50 percent of 2000 dollars 20 times you would have $115,330.08. 
		Test it.<br/>This can serve you for day trading or long-term.
	</h3>
	<?php 
}
