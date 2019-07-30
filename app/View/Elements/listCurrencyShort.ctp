<?php 
		
		$rank = '';
      	if( !empty( $currency['Currency']['rank'] ) ){
      		$rank = $currency['Currency']['rank'];
      	}
		$name = '';
      	if( !empty( $currency['Currency']['name'] ) ){
      		$name = $currency['Currency']['name'];
      	}
      	$symbol = '';
      	if( !empty( $currency['Currency']['symbol'] ) ){
      		$symbol = $currency['Currency']['symbol'];
      	}
      	$priceUsd = '';
      	if( !empty( $currency['Currency']['price_usd'] ) ){
      		$priceUsd = $currency['Currency']['price_usd'];
      	}
      	
      	$percent_change_1h = '';
      	if( !empty( $currency['Currency']['percent_change_1h'] ) ){
      		$percent_change_1h = $currency['Currency']['percent_change_1h'];
      	}
      	$percent_change_7d = '';
      	if( !empty( $currency['Currency']['percent_change_7d'] ) ){
      		$percent_change_7d = $currency['Currency']['percent_change_7d'];
      	}
      	$percent_change_24h = '';
      	if( !empty( $currency['Currency']['percent_change_24h'] ) ){
      		$percent_change_24h = $currency['Currency']['percent_change_24h'];
      	}
      	$market_cap_usd = '';
      	if( !empty( $currency['Currency']['market_cap_usd'] ) ){
      		$market_cap_usd = $currency['Currency']['market_cap_usd'];
      	}
      	$available_supply = '';
      	if( !empty( $currency['Currency']['available_supply'] ) ){
      		$available_supply = $currency['Currency']['available_supply'];
      	}
      	$total_supply = '';
      	if( !empty( $currency['Currency']['total_supply'] ) ){
      		$total_supply = $currency['Currency']['total_supply'];
      	}
      	$max_supply = '';
      	if( !empty( $currency['Currency']['max_supply'] ) ){
      		$max_supply = $currency['Currency']['max_supply'];
      	}
      	$price_btc = '';
      	if( !empty( $currency['Currency']['price_btc'] ) ){
      		$price_btc = $currency['Currency']['price_btc'];
      	}

      ?>
      <div class="row">
      	<div class="col-xs-6 col-md-6">
      	<?php 
					        	if( !empty( $currency['Currency']['image'] ) ){
					        		$nameOfImage = 'img/'.$currency['Currency']['image'];
					        		if( file_exists( $nameOfImage ) ){
							        	echo $this->Html->image($currency['Currency']['image'], array(
							        		'alt'   => $currency['Currency']['name'],
							        		'class' => 'img-responsive' 
						        		)); 
					        		}else{
					        			echo $this->Html->image("imgEmpty.png", array(
							        		'alt'   => $currency['Currency']['name'],
							        		'class' => 'img-responsive' 
						        		)); 
					        		}
					        	}
				        	?>
				        </div>
      	<div class="col-xs-6 col-md-6">

	      <h4 class="color-blanco" style='font-size: 11px;'><strong class="text-primary">#<?php echo $rank; ?></strong></h4>
      	</div>
      </div>
      <div class="row">
      	<div class="col-xs-6 col-md-6">
	      <h4 class="color-blanco" style='font-size: 11px;'><strong><?php echo $name; ?></strong></h4>
      	</div>
      	<div class="col-xs-6 col-md-6">
	      <h4 class="color-blanco" style='font-size: 11px;'><strong><?php echo $symbol; ?></strong></h4>
      	</div>
      </div>
      <div class="row">
      	<div class="col-xs-6 col-md-6">
		      <h4 class="color-blanco" style='font-size: 11px;'>Price USD: 
		            <strong class="text-primary">
		                  <?php 
		                        $endPrice = $this->Number->currency($priceUsd,$currency='USD');
		                        if( $priceUsd < 0.1 ){
		                              $endPrice = "$".$priceUsd;
		                        }
		                  ?>
		                  <?php echo $endPrice; ?>
		            </strong>
		      </h4>
  		</div>
  		<div class="col-xs-6 col-md-6">
      		<h4 class="color-blanco" style='font-size: 11px;'>24hs: <strong><?php echo redGreen( $percent_change_24h); ?></strong></h4>
  		</div>
  	</div>
