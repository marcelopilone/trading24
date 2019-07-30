<h2><?php echo __('Add Currency'); ?></h2>
	<div class="row">
		<div class="col-md-8 col-xs-8">
			<?php echo $this->Form->create('Currency'); ?>
				<?php
					echo $this->Form->input('currency',array(
						'class' => 'form-control'
					));
					echo $this->Form->input('image',array(
						'class' => 'form-control'
					));
					echo $this->Form->input('votes',array(
						'class' => 'form-control'
					));
				?>
				<br/>
			<?php 
			    $options = array('label' => 'Save', 'class' => 'btn btn-success btn-lg', 'div' => false);
				echo $this->Form->end($options);
			?>
		</div>
		<div class="col-md-4 col-xs-4">
				<h3><?php echo __('Actions'); ?></h3>

					<?php echo $this->Html->link('List Currencies', array(
							'action' => 'index'
						), array('class' => 'btn btn-info')
					); ?>
		</div>
	</div>
