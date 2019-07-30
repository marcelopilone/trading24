<?php

class ImportShell extends AppShell {

	public $uses = array(
		'Currency',
	);

    public function main() {

        $api  = API_COIN_MARKET_CAP_PERSONAL_FULL;
		$json = file_get_contents($api);
		$cur  = json_decode($json);

		foreach( $cur as $c ){
			// paso el objeto a un array
			$currency = $this->__armarArrayDeLaMoneda( $c );
			// guardo la moneda
			$this->__guardarMoneda( $currency );

			if( !empty( $currency['Currency']['id'] ) ){
				$this->__createHistoryPrice( $currency );
			}

		}

    }

    /**
     * @param  array
     * @return true|false
     */
    public function __guardarMoneda( $currency ){
    	$estado = 'Se guardo bien: ';
		if( !empty( $currency['Currency']['id'] ) ){
			$estado = 'Se actualizo bien: ';
		}

		$this->Currency->clear();
		$save = $this->Currency->save( $currency );

		if(  $save == false ){
			throw new Exception("Error al guardar");
		}

		echo $estado.$currency['Currency']['name']."\n";

		return $save;

    }

    /**
     * Armo el array para despues guardar la moneda
     * @param  array
     * @return array
     */
    public function __armarArrayDeLaMoneda( $c ){

		$c = get_object_vars($c);
		$name            = $c['name'];
		$symbol          = $c['symbol'];
		$rank            = $c['rank'];
		$priceUsd        = $c['price_usd'];
		$priceBtc        = $c['price_btc'];
		$volume24hsUsd   = $c['24h_volume_usd'];
		$volumeMarketCap = $c['market_cap_usd'];
		$availableSupply = $c['available_supply'];
		$totalSupply     = $c['total_supply'];
		$maxSupply       = $c['max_supply'];
		$percent1Hour    = $c['percent_change_1h'];
		$percent24Hour   = $c['percent_change_24h'];
		$percent7d       = $c['percent_change_7d'];

		$parts = explode(" ", $name);
		$image = '';
		foreach( $parts as $part ){
			$image.= $part."-";
		}

		$currency = array( 
			'Currency' => array(
				'name'               => $name,
 				'symbol'             => $symbol,
		        //'image'              => strtolower( rtrim($image,'-').".png" ),
				'24h_volume_usd'     => $volume24hsUsd,
				'market_cap_usd'     => $volumeMarketCap,
				'available_supply'   => $availableSupply,
				'total_supply'       => $totalSupply,
				'max_supply'         => $maxSupply,
				'percent_change_1h'  => $percent1Hour,
				'percent_change_24h' => $percent24Hour,
				'percent_change_7d'  => $percent7d,
				'rank'               => $rank,
				'price_btc'          => $priceBtc,
   				'price_usd'          => $priceUsd,
			),
		);

		$currencyExist = $this->Currency->find('first',array(
			'conditions' => array(
				'Currency.name' => $currency['Currency']['name'],
			)
		));

		$currency['Currency']['id'] = null;
		if( !empty( $currencyExist ) ){
			$currency['Currency']['id'] = $currencyExist['Currency']['id'];
		}

		// para saber si actualiza o no el campo imagen 
		if( empty( $currencyExist['Currency']['id'] ) ){
			$currency['Currency']['image'] = strtolower( rtrim($image,'-').".png" );
		}

		return $currency;
    }

    /**
     * Crea el historial de precios de las monedas
     * @param  array
     * @param  int
     * @return array|false
     */
    public function __createHistoryPrice( $currency ){

    		$currencyPriceHistory = array(
				'CurrenciesHystory' => array(
					'currency_id' => $currency['Currency']['id'],
					'price_usd'   => $currency['Currency']['price_usd'],
				),
			);
			$this->Currency->CurrenciesHystory->create();
			$saveCurrencyHistory = $this->Currency->CurrenciesHystory->save( $currencyPriceHistory );
			if(  $saveCurrencyHistory == false ){
				throw new Exception("Error al guardar", 1);
			}

			return $saveCurrencyHistory;

    }

    

}