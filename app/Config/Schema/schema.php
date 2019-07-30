<?php
class AppSchema extends CakeSchema {
	
	public $connection = 'default';

	public function before($event = array()) {
	    $db = ConnectionManager::getDataSource($this->connection);
	    $db->cacheSources = false;
	    return true;
	}
	/**
	*
	*	Devuelve el Model de la tabla pasada como parametro y la connection seleccionada
	*
	**/
	private function __getModel ( $modelNameEvent, $connection ) {
		App::uses('ClassRegistry', 'Utility');
        $modelName = Inflector::classify( $modelNameEvent );
        
        $clasToLoad = array(
        	'class'=> $modelName,
        	'table' => $modelNameEvent, 
        	'ds' => $connection, 
        	//'alias' => $modelName
        	);
        return ClassRegistry::init( $clasToLoad );
	}

	public function after($event = array()) {
	    if (isset($event['create'])) {
	    	$db = ConnectionManager::getDataSource($this->connection);
	    	$db->cacheSources = false;
	        $modelNameEvent = $event['create'];
	        $insertValues = $this->__getDefaultValues( $modelNameEvent);
            
	        if ( $insertValues ) {
	        	$model = $this->__getModel( $modelNameEvent, $this->connection);
	            
	            if ( $model ) {
	            	$model->saveAll( $insertValues );
	            }    
	        }
            
	    }
	}


	public $currencies = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => true, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'symbol' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
        'image' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1024, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'votes' => array('type' => 'integer', 'null' => false, 'default' => 0, 'unsigned' => true),
		'24h_volume_usd' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2','unsigned' => false),
		'market_cap_usd' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2','unsigned' => false),
		'available_supply' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2','unsigned' => false),
		'total_supply' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2','unsigned' => false),
		'max_supply' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2','unsigned' => false),
		'percent_change_1h' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2','unsigned' => false),
		'percent_change_24h' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2','unsigned' => false),
		'percent_change_7d' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2','unsigned' => false),
		'rank' => array('type' => 'integer', 'null' => false, 'default' => 0, 'unsigned' => true),
		'price_btc' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,15','unsigned' => false),
		'price_usd' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,12','unsigned' => false),
        'updated' 	 	=> array('type' => 'datetime', 'null' => true, 'default' => null),
        'created' 	 	=> array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

	public $currencies_hystory = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => true, 'key' => 'primary'),
		'currency_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => true),
		'price_usd' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,12','unsigned' => false),
		'updated' 	 	=> array('type' => 'datetime', 'null' => true, 'default' => null),
        'created' 	 	=> array('type' => 'datetime', 'null' => true, 'default' => null),
        'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

	public $news = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => true, 'key' => 'primary'),
		'currency_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => true,),
		'24h_volume_usd' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2','unsigned' => false),
		'market_cap_usd' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2','unsigned' => false),
		'available_supply' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2','unsigned' => false),
		'total_supply' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2','unsigned' => false),
		'max_supply' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2','unsigned' => false),
		'percent_change_1h' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2','unsigned' => false),
		'percent_change_24h' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2','unsigned' => false),
		'percent_change_7d' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2','unsigned' => false),
		'rank' => array('type' => 'integer', 'null' => false, 'default' => 0, 'unsigned' => true),
		'price_btc' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,15','unsigned' => false),
		'price_usd' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,12','unsigned' => false),
		'date_importation' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'updated' 	 	=> array('type' => 'datetime', 'null' => true, 'default' => null),
        'created' 	 	=> array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

	public $ips = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => true, 'key' => 'primary'),
		'number' => array('type' => 'string', 'null' => false, 'default' => 0, 'length' => 50,'unsigned' => true),
        'updated' 	 	=> array('type' => 'datetime', 'null' => true, 'default' => null),
        'created' 	 	=> array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

	public $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => true, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => false, 'unsigned' => true),
		'password' => array('type' => 'string', 'null' => false, 'unsigned' => true),
		'role' => array('type' => 'string', 'null' => true, 'default' => 0, 'unsigned' => true),
        'updated' 	 	=> array('type' => 'datetime', 'null' => true, 'default' => null),
        'created' 	 	=> array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

	public $procesos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => true, 'key' => 'primary'),
		'url-api' => array('type' => 'string', 'null' => false, 'unsigned' => true),
		'key-api' => array('type' => 'string', 'null' => false, 'unsigned' => true),
		'cantidad' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,12','unsigned' => false),
        'updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
        'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

	public $movimientos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => true, 'key' => 'primary'),
		'cantidad_inicial' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,12','unsigned' => false),
		'cant_monedas' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,12','unsigned' => false),
		'precio_compra' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,12','unsigned' => false),
		'precio_venta' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,12','unsigned' => false),
		'moneda_de_intercambio' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'porcentaje' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,12','unsigned' => false),
		'cantidad_final' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,12','unsigned' => false),
		'compra_o_venta' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),

		'rsi' =>  array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,12','unsigned' => false),
		'updated' 	 	=> array('type' => 'datetime', 'null' => true, 'default' => null),
        'created' 	 	=> array('type' => 'datetime', 'null' => true, 'default' => null),
        'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
        		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')

	);

	
	/***
	*
	*	Devuelve los valores al ejecutar "SCHEMA CREATE"
	*
	*	@param string $tablename Nombre de la tabla
	*	@return array listado de valores a insertar en la tabla para hacer el saveAll
	**/
	private function __getDefaultValues ( $tableName ) {
		
		$values = array(		
			'currencies' => array(
				array('currency' => 'Bitcoin','image'=>'bitcoin.png','votes'=>0),
				array('currency' => 'Ethereum','image'=> 'ethereum.png','votes' => 0),
				array('currency' => 'Bitcoin Cash','image'=> 'bitcoin-cash.png','votes' => 0),
				array('currency' => 'Ripple','image'=> 'ripple.png','votes' => 0),
				array('currency' => 'Litecoin','image'=> 'litecoin.png','votes' => 0),
				array('currency' => 'Dash','image'=> 'dash.png','votes' => 0),
				array('currency' => 'NEO','image'=> 'neo.png','votes' => 0),
				array('currency' => 'NEM','image'=> 'nem.png','votes' => 0),
				array('currency' => 'Monero','image'=> 'monero.png','votes' => 0),
				array('currency' => 'Ethereum Classic','image'=> 'ethereum-classic.png','votes' => 0),
				array('currency' => 'IOTA','image'=> 'iota.png','votes' => 0),
				array('currency' => 'Qtum' ,'image' => 'qtum.png','votes' => 0),
				array('currency' => 'OmiseGO' ,'image' => 'omisego.png','votes' => 0),
				array('currency' => 'BitConnect' ,'image' => 'bitconnect.png','votes' => 0),
				array('currency' => 'Zcash' ,'image' => 'zcash.png','votes' => 0),
				array('currency' => 'Cardano' ,'image' => 'cardano.png','votes' => 0),
				array('currency' => 'EOS' ,'image' => 'eos.png','votes' => 0),
				array('currency' => 'Lisk' ,'image' => 'lisk.png','votes' => 0),
				array('currency' => 'Tether' ,'image' => 'tether.png','votes' => 0),
				array('currency' => 'Stellar Lumens' , 'image' => 'stellar.png' ,'votes' => 0 ),
				array('currency' => 'Waves' , 'image' => 'waves.png' ,'votes' => 0 ),
				array('currency' => 'Hshare' , 'image' => 'hshare.png' ,'votes' => 0 ),
				array('currency' => 'Stratis' , 'image' => 'stratis.png' ,'votes' => 0 ),
				array('currency' => 'Komodo' , 'image' => 'komodo.png' ,'votes' => 0 ),
				array('currency' => 'Ark' , 'image' => 'ark.png' ,'votes' => 0 ),
				array('currency' => 'Bytecoin' , 'image' => 'bytecoin-bcn.png' ,'votes' => 0 ),
				array('currency' => 'Steem' , 'image' => 'steem.png' ,'votes' => 0 ),
				array('currency' => 'Ardor' , 'image' => 'ardor.png' ,'votes' => 0 ),
				array('currency' => 'Augur' , 'image' => 'augur.png' ,'votes' => 0 ),
				array('currency' => 'TenX' , 'image' => 'tenx.png' ,'votes' => 0 ),
				array('currency' => 'Decred' , 'image' => 'decred.png' ,'votes' => 0 ),
				array('currency' => 'Vertcoin' , 'image' => 'vertcoin.png' ,'votes' => 0 ),
				array('currency' => 'Golem' , 'image' => 'golem-network-tokens.png' ,'votes' => 0 ),
				array('currency' => 'Binance Coin' , 'image' => 'binance-coin.png' ,'votes' => 0 ),
				array('currency' => 'TRON' , 'image' => 'tron.png' ,'votes' => 0 ),
				array('currency' => 'MaidSafeCoin' , 'image' => 'maidsafecoin.png' ,'votes' => 0 ),
				array('currency' => 'PIVX' , 'image' => 'pivx.png' ,'votes' => 0 ),
				array('currency' => 'BitShares' , 'image' => 'bitshares.png' ,'votes' => 0 ),
				array('currency' => 'Populous' , 'image' => 'populous.png' ,'votes' => 0 ),
				array('currency' => 'Gas' , 'image' => 'gas.png' ,'votes' => 0 ),
				array('currency' => 'MonaCoin' , 'image' => 'monacoin.png' ,'votes' => 0 ),
				array('currency' => 'BitcoinDark' , 'image' => 'bitcoindark.png' ,'votes' => 0 ),
				array('currency' => 'Basic Attenti...' , 'image' => 'basic-attention-token.png' ,'votes' => 0 ),
				array('currency' => 'Kyber Network' , 'image' => 'kyber-network.png' ,'votes' => 0 ),
				array('currency' => 'DigixDAO' , 'image' => 'digixdao.png' ,'votes' => 0 ),
				array('currency' => 'Dogecoin' , 'image' => 'dogecoin.png' ,'votes' => 0 ),
				array('currency' => 'Walton' , 'image' => 'walton.png' ,'votes' => 0 ),
				array('currency' => 'Factom' , 'image' => 'factom.png' ,'votes' => 0 ),
				array('currency' => 'Bytom' , 'image' => 'bytom.png' ,'votes' => 0 ),
				array('currency' => 'Iconomi' , 'image' => 'iconomi.png' ,'votes' => 0 ),
				array('currency' => 'SALT' , 'image' => 'salt.png' ,'votes' => 0 ),
				array('currency' => 'Byteball Bytes' , 'image' => 'byteball.png' ,'votes' => 0 ),
				array('currency' => 'Veritaseum' , 'image' => 'veritaseum.png' ,'votes' => 0 ),
				array('currency' => 'Siacoin' , 'image' => 'siacoin.png' ,'votes' => 0 ),
				array('currency' => 'GameCredits' , 'image' => 'gamecredits.png' ,'votes' => 0 ),
				array('currency' => 'Status' , 'image' => 'status.png' ,'votes' => 0 ),
				array('currency' => 'Verge' , 'image' => 'verge.png' ,'votes' => 0 ),
				array('currency' => 'Syscoin' , 'image' => 'syscoin.png' ,'votes' => 0 ),
				array('currency' => 'Metal' , 'image' => 'metal.png' ,'votes' => 0 ),
				array('currency' => 'Civic' , 'image' => 'civic.png' ,'votes' => 0 ),
				array('currency' => 'Lykke' , 'image' => 'lykke.png' ,'votes' => 0 ),
				array('currency' => '0x' , 'image' => '0x.png' ,'votes' => 0 ),
				array('currency' => 'Blocknet' , 'image' => 'blocknet.png' ,'votes' => 0 ),
				array('currency' => 'SingularDTV' , 'image' => 'singulardtv.png' ,'votes' => 0 ),
				array('currency' => 'GXShares' , 'image' => 'GXShares.png' ,'votes' => 0 ),
				array('currency' => 'DigiByte' , 'image' => 'digibyte.png' ,'votes' => 0 ),
				array('currency' => 'Bancor' , 'image' => 'bancor.png' ,'votes' => 0 ),
				array('currency' => 'Aeternity' , 'image' => 'aeternity.png' ,'votes' => 0 ),
				array('currency' => 'Metaverse ETP' , 'image' => 'metaverse.png' ,'votes' => 0 ),
				array('currency' => 'Pura' , 'image' => 'pura.png' ,'votes' => 0 ),
				array('currency' => 'KuCoin Shares' , 'image' => 'kucoin.png' ,'votes' => 0 ),
				array('currency' => 'Gnosis' , 'image' => 'gnosis-gno.png' ,'votes' => 0 ),
				array('currency' => 'FunFair' , 'image' => 'funfair.png' ,'votes' => 0 ),
				array('currency' => 'Bitcore' , 'image' => 'bitcore.png' ,'votes' => 0 ),
				array('currency' => 'VeChain' , 'image' => 'vechain.png' ,'votes' => 0 ),
				array('currency' => 'ChainLink' , 'image' => 'chainlink.png' ,'votes' => 0 ),
				array('currency' => 'Neblio' , 'image' => 'neblio.png' ,'votes' => 0 ),
				array('currency' => 'Particl' , 'image' => 'particl.png' ,'votes' => 0 ),
				array('currency' => 'MCAP' , 'image' => 'mcap.png' ,'votes' => 0 ),
				array('currency' => 'Monaco' , 'image' => 'monaco.png' ,'votes' => 0 ),
				array('currency' => 'Bitquence' , 'image' => 'bitquence.png' ,'votes' => 0 ),
				array('currency' => 'Nxt' , 'image' => 'nxt.png' ,'votes' => 0 ),
				array('currency' => 'Groestlcoin' , 'image' => 'groestlcoin.png' ,'votes' => 0 ),
				array('currency' => 'FairCoin' , 'image' => 'fairCoin.png' ,'votes' => 0 ),
				array('currency' => 'Nexus' , 'image' => 'nexus.png' ,'votes' => 0 ),
				array('currency' => 'Storj' , 'image' => 'storj.png' ,'votes' => 0 ),
				array('currency' => 'Bitdeal' , 'image' => 'bitdeal.png' ,'votes' => 0 ),
				array('currency' => 'ZenCash' , 'image' => 'zen.png' ,'votes' => 0 ),
				array('currency' => 'NAV Coin' , 'image' => 'nav-coin.png' ,'votes' => 0 ),
				array('currency' => 'SmartCash' , 'image' => 'smartcash.png' ,'votes' => 0 ),
				array('currency' => 'bitqy' , 'image' => 'bitqy.png' ,'votes' => 0 ),
				array('currency' => 'ZCoin' , 'image' => 'zcoin.png' ,'votes' => 0 ),
				array('currency' => 'iExec RLC' , 'image' => 'rlc.png' ,'votes' => 0 ),
				array('currency' => 'Loopring' , 'image' => 'loopring.png' ,'votes' => 0 ),
				array('currency' => 'AdEx' , 'image' => 'adx-net.png' ,'votes' => 0 ),
				array('currency' => 'ATMChain' , 'image' => 'attention-token-of-media.png' ,'votes' => 0 ),
				array('currency' => 'Edgeless' , 'image' => 'edgeless.png' ,'votes' => 0 ),
				array('currency' => 'Dentacoin' , 'image' => 'dentacoin.png' ,'votes' => 0 ),
				array('currency' => 'Ubiq' , 'image' => 'ubiq.png' ,'votes' => 0 ),
				array('currency' => 'TaaS' , 'image' => 'taas.png' ,'votes' => 0 ),
			),
		);
		
		if ( array_key_exists( $tableName, $values )) {
			return $values[$tableName];
		} else {
			return false;
		}
	} 


}