
<script  type="text/javascript">
	function showAdvancedSearch(){
		$( ".searchEngine" ).removeClass( "searchEngineNone" );
		$( ".showSearch" ).addClass( "hide" );
		$( ".hideSearch" ).removeClass( "hide" );
	}
	function hideAdvancedSearch(){
		$( ".hideSearch" ).addClass( "hide" );
		$( ".searchEngine" ).addClass( "searchEngineNone" );
		$( ".showSearch" ).removeClass( "hide" );
	}
</script>
<div class="row">
	<div class="col-md-10 col-xs-12">
		<h2 class="center">Cryptocurrency Market Capitalizations With Voice</h2>
	</div>
	<div class="col-md-2 col-xs-12 center visible-md visible-lg">
		<div class="fb-like" data-href="https://www.facebook.com/buythemoon.org/" data-layout="box_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
	</div>
</div>

<br/>
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
<div class="row">
	<!-- 
		The 
Las monedas que subieron mas de un 20 porciento dentro de las primeras 100 en el ranking son ethereum, bitcoin, neo y ripple, para información mas detallada tiene nuestro buscador, recuerda comprar la luna no mirar la pantalla
The currencies that rose more than 20 percent, within the first 100 in the ranking are:  neo, bitcoin,patientory and ripple, for more detailed information has our search engine.
Thanks human.


	-->
	<div class="col-md-3 col-xs-12">
		<?php 
			$speakDefault = 'i am going to list the first 100 cryptocurrencies ';
			$titleDefault = 'Listen Long Summary';
			if( !empty( $typeOfListen ) ){
				$titleDefault = 'Listen to your search';
				$speakDefault = 'i am going to list your search ';
			}

		?>
		<input onclick='responsiveVoice.speak("Hello trader, the currencies that rose more than 20 percent in the last 24 hours, within the first 100 in the ranking are: <?php foreach( $currenciesVoice as $cVoice ){ echo $cVoice.','; }?> for more detailed information has our search engine.Thanks trader, have a nice day.");' type='button' value='Listen Short Summary' class="btn btn-block btn-success" />
	</div>
	<div class="col-md-3 col-xs-12">
		<input onclick='responsiveVoice.speak("Hello trader, <?php echo $speakDefault;?>.<?php foreach( $currencies as $cLong ){ echo "In the position number ".$cLong['Currency']['rank'].": ".$cLong['Currency']['name'].", its price is: ".$this->Number->currency($cLong['Currency']['price_usd'],$currency='USD')."."; }?> Thanks trader, have a nice day.");' type='button' value=' <?php echo $titleDefault;?>' class="btn btn-block btn-success" />
	</div>
	<div class="col-md-3 col-xs-12">
		<input onclick="responsiveVoice.cancel();" id="stopbutton" type="button" value="Stop" class="btn btn-block btn-danger">
	</div>
	<div class="col-md-3 col-xs-12">
		<button onclick="showAdvancedSearch();" id="stopbutton" type="button" class="btn btn-block btn-primary showSearch">Show Search</button>
		<button onclick="hideAdvancedSearch();" id="stopbutton" type="button" class="btn btn-block btn-info hideSearch hide">Hide Search</button>
	</div>
</div><br/>
<div class="row">
</div>
<!--<div class="row visible-xs">
	<div class="col-md-12 col-xs-12">
		<a href="whatsapp://send?text=http://buythemoon.org/" data-action="share/whatsapp/share" class="btn btn-primary btn-block">Share in Whatsapp</a>
	</div>
</div>-->

<div class="searchEngine searchEngineNone">
<?php 
	echo $this->Form->create('Currency', 
		array(
			'url' => array(
					'controller' => 'currencies', 
					'action' => 'ranking'
			),
			'type' => 'get'
		)
	  );
  ?>
  	<div class="row">
		<div class="col-md-6 col-xs-12">
			<label>Name</label>
			<?php
				echo $this->Form->text('name',array(
						'placeholder' => 'Search the coin for his name. . .',
						'class' => 'form-control bs-autocomplete',
						'value' => $currencyName
			  	));
	  		?>
		</div>
		<div class="col-md-3 col-xs-6">
			<label>Market Cap</label>
			<?php 
			$ckeckedLessMarketCap = '';
			if( !empty( $marketCapLess ) ){
				$ckeckedLessMarketCap = 'selected';
			}
			$ckeckedHigherMarketCap = '';
			if( !empty( $marketCapHigher ) ){
				$ckeckedHigherMarketCap = 'selected';
			}
			?>
			<select class="form-control" name="menorMayorMarketCap">
				  <option value="">Lower or Higher (Market Cap)</option>
				  <option value="less" name="less" <?php echo $ckeckedLessMarketCap;?>  > <= </option>
				  <option value="higher" name="higher" <?php echo $ckeckedHigherMarketCap;?> > >= </option>
			</select>
		</div>
		<div class="col-md-3 col-xs-6">
			<label>Volume in USD</label>
			<?php
				echo $this->Form->integer('market_cap_usd',array(
						'placeholder' => 'Market Cap in USD',
						'class' => 'form-control',
						'value' => $marketCapVolume
			  	));
	  		?>
		</div>

	</div><br/>
	<div class="row">
		<div class="col-md-6 col-xs-6">
			<label>Percent 24Hs</label>
			<?php 
			$ckeckedLessPercent = '';
			if( !empty( $percentLess ) ){
				$ckeckedLessPercent = 'selected';
			}
			$ckeckedHigherPercent = '';
			if( !empty( $percentHigher ) ){
				$ckeckedHigherPercent = 'selected';
			}
			?>
			<select class="form-control" name="menorMayorPrecioPercent">
				  <option value="">Lower or Higher (Percent 24Hs)</option>
				  <option value="less" name="less" <?php echo $ckeckedLessPercent;?>  > <= </option>
				  <option value="higher" name="higher" <?php echo $ckeckedHigherPercent;?> > >= </option>
			</select>
		</div>
		<div class="col-md-6 col-xs-6">
			<label>Percent (for less than 0 put -, for example -1)</label>
			<?php
				echo $this->Form->integer('percent_change_24h',array(
						'placeholder' => 'Percent in %',
						'class' => 'form-control',
						'value' => $percent24
			  	));
	  		?>
		</div>
	</div><br/>
	<div class="row">
		<div class="col-md-3 col-xs-6">
			<label>Price</label>
			<?php 
			$ckeckedLess = '';
			if( !empty( $currencyLess ) ){
				$ckeckedLess = 'selected';
			}
			$ckeckedHigher = '';
			if( !empty( $currencyHigher ) ){
				$ckeckedHigher = 'selected';
			}
			?>
			<select class="form-control" name="menorMayorPrecio">
				  <option value="">Lower or Higher (Price)</option>
				  <option value="less" name="less" <?php echo $ckeckedLess;?>  > <= </option>
				  <option value="higher" name="higher" <?php echo $ckeckedHigher;?> > >= </option>
			</select>
		</div>
		<div class="col-md-3 col-xs-6">
			<label>Value in USD</label>
			<?php
				echo $this->Form->integer('price_usd',array(
						'placeholder' => 'Price in USD',
						'class' => 'form-control',
						'value' => $currencyPrice
			  	));
	  		?>
		</div>
		<div class="col-md-3 col-xs-6">
			<label>Supply</label>
			<?php 
			$ckeckedLess = '';
			if( !empty( $supplyLess ) ){
				$supplyLess = 'selected';
			}
			$ckeckedHigher = '';
			if( !empty( $supplyHigher ) ){
				$supplyHigher = 'selected';
			}
			?>
			<select class="form-control" name="menorMayorSupply">
				  <option value="">Lower or Higher (Supply)</option>
				  <option value="less" name="less" <?php echo $supplyLess;?>  > <= </option>
				  <option value="higher" name="higher" <?php echo $supplyHigher;?> > >= </option>
			</select>
		</div>
		<div class="col-md-3 col-xs-6">
			<label>Quantity</label>
			<?php
				echo $this->Form->integer('available_supply',array(
						'placeholder' => 'Quantity of supply',
						'class' => 'form-control',
						'value' => $availableSupply
			  	));
	  		?>
		</div>

	</div><br/>
		<div class="row">
				<div class="col-md-6 col-xs-6">
					<a href="http://buythemoon.org" class="btn btn-default btn-block">Reset</a>
				</div>
				<div class="col-md-6 col-xs-6">
					<?php 
						$options = array('label' => 'Search', 'class' => 'btn btn-primary btn-block color-blanco', 'div' => false);
						echo $this->Form->end($options);
					?>
				</div>
			</div>
	<br/>
</div>
	
<?php echo $this->element('onlyPaginate'); ?><br/>
	
	<div class="row">
		<?php foreach ($currencies as $currency){
				$percentThumb = '';
				if( !empty( $currency['Currency']['percent_change_24h'] ) ){
					$percentThumb = $currency['Currency']['percent_change_24h'];
				}
				$colorThumb  = 'thumbailDanger';
				$colorNumber = 'colodBad';
				if( $percentThumb >= 0 ){
					$colorThumb = 'thumbailSuccess';
					$colorNumber = 'colorOk';
				}

			 ?>
				<div class="col-md-4 col-xs-12 col-lg-4">
					<div class="thumbnail <?php echo $colorThumb;?>" style="width: 100%;">

					        <div class="caption center">

					          <?php  echo $this->element('listCurrency',array(
					          		'currency' => $currency,
					          		'colorNumber' => $colorNumber,
					          	)); ?>
					          	
					        </div>
		    		</div>	
				</div>
		<?php } ?>
	</div>
	<?php echo $this->element('onlyPaginate'); ?>
<br/>
<div class="row center">
	<div class="alert alert-info" style="font-size: 13px;">
		<strong>
  			Important: Never invest money you can't afford to lose. Always do your own research and due diligence before placing a trade. <!--Read our Terms & Conditions here. -->
  		</strong>
</div>
<h5 class="center">Statistical data by: <a href="https://coinmarketcap.com" target="_blank">CoinMarketCap</a></h5>

<!-- Modal -->
  <!--<div class="modal fade" id="myModal" role="dialog" style="color:#0a7394 !important;">
    <div class="modal-dialog">
    
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">How does it work? (Buy the moon - beta)</h4>
        </div>
        <div class="modal-body" >
          <p class="lead tamanioLetraHowItWorks">
          	Hello, let's be honest, there is little accurate information on the internet about whether or not to upload a cryptocurrency in the next few 	hours, with this I am not criticizing any guru.</p>
          <p class="lead tamanioLetraHowItWorks">
          	But social networks are full of trolls saying anything.
          </p>
          <p class="lead tamanioLetraHowItWorks">
          	Buythemoon.org is the solution ?, I think so, at the moment it is in a beta version.
          </p>
          <p class="lead tamanioLetraHowItWorks">
          	The operation is very simple, you vote for what you think will go up in the next twelve hours, by doing so you can see the votes of others.
          </p>
          <p class="lead tamanioLetraHowItWorks">
          	It is true that a user can vote for anyone without doing an analysis and simply vote to see what others think, if the idea of ​​the web like how to solve that problem, is now in beta to see if it has acceptance.
          </p>
          <p class="lead tamanioLetraHowItWorks">
          	<strong>Voting is restarted at 00:00 UTC and 12:00 UTC.</strong>
          </p>
          <p class="lead tamanioLetraHowItWorks">
          	Regards,
          </p>
          <p class="lead tamanioLetraHowItWorks">
          	<strong>buythemoon.org</strong>
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>-->
  
</div>
