<!-- #98de98 green #f39898 red-->
<div class="row">
				<?php 
					foreach( $listSimple as $s ){

						$price = $this->Number->currency($s['Currency']['price_usd'],$currency='USD');
						$percentChange = '';
						if( !empty( $s['Currency']['percent_change_24h'] ) ){
							$percentChange = $s['Currency']['percent_change_24h'];
						}
						$percentChange1h = '';
						if( !empty( $s['Currency']['percent_change_24h'] ) ){
							$percentChange = $s['Currency']['percent_change_24h'];
						}
						$percentChange = '';
						if( !empty( $s['Currency']['percent_change_24h'] ) ){
							$percentChange = $s['Currency']['percent_change_24h'];
						}
						$name = '';
						if( !empty( $s['Currency']['name'] ) ){
							$name = $s['Currency']['name'];
						}

						$color = 'red';
						if( $percentChange >=0 ){
							$color = 'green';
						}
						?>
							<div class="col-md-4 col-xs-4 col-sm-4 center" style="border: solid 1px; background-color:  <?php echo $color;?>; font-size:15px !important; ">
									<strong>#<?php echo $s['Currency']['rank'].$name;?></strong>
									<?php echo $price;?>
									<?php echo "%".$percentChange;?>
							</div>
									
						<?php			
					}

				?>
		<?php echo $this->element('onlyPaginate'); ?>
</div>