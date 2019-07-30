<?php 
		
		$id = '';
            if( !empty( $currency['Currency']['id'] ) ){
                  $id = $currency['Currency']['id'];
            }
            $votes = 0;
            if( !empty( $currency['Currency']['votes'] ) ){
                  $votes = $currency['Currency']['votes'];
            }
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
            <div class="col-md-2 col-xs-2">
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
            <div class="col-md-10 col-xs-10">
                    <h4 class="" style='font-size: 28px;'> 
                        <strong class="text-primary <?php echo $colorNumber;?>">
                              <?php 
                                    $endPrice = $this->Number->currency($priceUsd,$currency='USD',array(
                                          'places' => 2,
                                    ));
                                    if( $priceUsd < 0.1 ){
                                          $endPrice = "$".$priceUsd;
                                    }
                              ?>
                              <?php echo $endPrice; ?>
                        </strong>
                  </h4>
            </div>
      </div>
      <div class="row">
            <div class="col-md-12 col-xs-12">
                  <h4 class="color-blanco" style='font-size: 16px;'><strong>#<?php echo $rank; ?> <?php echo $name; ?></strong></h4>
            </div>
      </div>
      <div class="row">
            <div class="col-md-12 col-xs-12">
                  <h4 class="color-blanco" style='font-size: 16px;'><strong><?php echo $symbol; ?></strong></h4>
            </div>
      </div>
      <h4 class="color-blanco" style='font-size: 15px;'></strong></h4>
      <?php 
            $status = 'decrease';
            if( $percent_change_24h > 0 ){
                  $status = 'increase';
            }
      ?>
      <?php 
            $percentForVoice = '';
            if( !empty( $percent_change_24h ) ){
                  $percentForVoice = str_replace( '-' , '' , $percent_change_24h );
            }

      ?>

      <input onclick='responsiveVoice.speak("<?php echo $name;?> <?php echo $status;?> <?php echo $percentForVoice; ?> percent and his price is <?php echo $this->Number->currency($priceUsd,$currency='USD');?>");' type='button' value='Listen Price' class="btn btn-success btn-bg" />

      <input onclick="responsiveVoice.cancel();" id="stopbutton" type="button" value="Stop" class="btn btn-danger btn-bg">
      
      <h4 class="color-blanco" style='font-size: 18px;'>Market cap: <strong class="text-primary"><?php echo $this->Number->currency($market_cap_usd,$currency='USD'); ?></strong></h4>
      <div class="row">
            <div class="col-md-4 col-xs-4">
                  <h4 class="color-blanco" style='font-size: 13px;'>24h: <strong><?php echo redGreen( $percent_change_24h); ?></strong></h4>
            </div>
            <div class="col-md-4 col-xs-4">
                  <h4 class="color-blanco" style='font-size: 13px;'>1h: <strong><?php echo redGreen( $percent_change_1h); ?></strong></h4>
            </div>
            <div class="col-md-4 col-xs-4">
                  <h4 class="color-blanco" style='font-size: 13px;'>7d: <strong><?php echo redGreen( $percent_change_7d); ?></strong></h4>
            </div>
      </div>
      <h4 class="color-blanco" style='font-size: 13px;'>Avalable supply: <strong class="text-primary"><?php echo $available_supply; ?></strong></h4>
      <h4 class="color-blanco" style='font-size: 13px;'>Total supply: <strong class="text-primary"><?php echo $total_supply; ?></strong></h4>
      <h4 class="color-blanco" style='font-size: 13px;'>Max supply: <strong class="text-primary"><?php echo $max_supply; ?></strong></h4>
      <h4 class="color-blanco" style='font-size: 13px;'>Price BTC: <strong class="text-primary"><?php echo $price_btc; ?></strong></h4>