<div class="row">
	<div class="col-md-10 col-xs-12">
		<h2 class="center">Cryptocurrency Market Capitalizations</h2>
	</div>
	<div class="col-md-2 col-xs-12 center visible-md visible-lg">
		<div class="fb-like" data-href="https://www.facebook.com/buythemoon.org/" data-layout="box_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
	</div>
</div>
<div class="row">
	<div class="col-md-4 col-xs-4 center" style="padding: 2px !important;">
		<div class="alert alert-info"><strong>Coins: <?php echo $countCoins;?></strong></div>
	</div>
	<div class="col-md-4 col-xs-4 center" style="padding: 2px !important;">
		<div class="alert alert-success"><strong><?php echo $countCoinsGreen;?> Green</strong></div>
	</div>
	<div class="col-md-4 col-xs-4 center" style="padding: 2px !important;">
		<div class="alert alert-danger"><strong><?php echo $countCoinsRed;?> Red</strong></div>
	</div>
</div>
<br/>
<div class="row">
	<div class="col-md-12 col-xs-12">
	<table class="table table-bordered" style="background-color: white; color:black; text-align: center;">
			<thead>
			<tr>
					<th class="center"><?php echo $this->Paginator->sort('rank','Position'); ?></th>
					<th class="center"><?php echo $this->Paginator->sort('name'); ?></th>
					<th class="center"><?php echo $this->Paginator->sort('percent_change_24h','24Hs(Change)'); ?></th>
					<th class="center"><?php echo $this->Paginator->sort('price_usd','Price'); ?></th>
					<th class="center"><?php echo $this->Paginator->sort('market_cap_usd','Market Cap'); ?></th>
					<th class="center"><?php echo $this->Paginator->sort('24h_volume_usd','24Hs Volume'); ?></th>
					<th class="center"><?php echo $this->Paginator->sort('available_supply','Circulating supply'); ?></th>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($currencies as $currency){  
				$percentChange = $currency['Currency']['percent_change_24h'];
				$classSuccess = 'percentHeight';
				if( $percentChange < 0 ){
					$classSuccess = 'percentLess';
				}

				?>
					<tr class=" <?php echo $classSuccess;?> bordeadoTabla">
						<td><?php echo h($currency['Currency']['rank']); ?>&nbsp;</td>
						<td><strong><?php echo h($currency['Currency']['name']); ?></strong></td>
						<td><strong><?php echo  $percentChange ; ?>%</strong></td>
						<?php 
							$priceUsd = $currency['Currency']['price_usd'];
							if( $priceUsd < 0.1  ){
								?>
								<td><strong>$<?php echo $priceUsd; ?> c</strong></td>
								<?php
							}else{
						?>
								<td><strong><?php echo  $this->Number->Currency ( $priceUsd ); ?>&nbsp;</strong></td>
						<?php
							}
						?>
						<td><?php echo $this->Number->Currency ( $currency['Currency']['market_cap_usd']); ?>&nbsp;</td>
						<td><?php echo  $this->Number->Currency ( $currency['Currency']['24h_volume_usd'] ); ?>&nbsp;</td>
						<td><?php echo  $currency['Currency']['available_supply']." <small style='color:#ab1111 !important;'>".$currency['Currency']['symbol']."</small>"; ?>&nbsp;</td>
					</tr>
		<?php }; ?>
			</tbody>
	</table>
	</div>
</div>
<div class="row center">
	<div class="alert alert-info" style="font-size: 13px;">
		<strong>
  			Important: Never invest money you can't afford to lose. Always do your own research and due diligence before placing a trade. <!--Read our Terms & Conditions here. -->
  		</strong>
</div>
<h5 class="center">Statistical data by: <a href="https://coinmarketcap.com" target="_blank">CoinMarketCap</a></h5>

