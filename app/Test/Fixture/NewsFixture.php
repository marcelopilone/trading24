<?php
/**
 * News Fixture
 */
class NewsFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => true, 'key' => 'primary'),
		'currency_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => true),
		'24h_volume_usd' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2', 'unsigned' => false),
		'market_cap_usd' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2', 'unsigned' => false),
		'available_supply' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2', 'unsigned' => false),
		'total_supply' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2', 'unsigned' => false),
		'max_supply' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2', 'unsigned' => false),
		'percent_change_1h' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2', 'unsigned' => false),
		'percent_change_24h' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2', 'unsigned' => false),
		'percent_change_7d' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,2', 'unsigned' => false),
		'rank' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => true),
		'price_btc' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,15', 'unsigned' => false),
		'price_usd' => array('type' => 'decimal', 'null' => true, 'default' => null, 'length' => '65,12', 'unsigned' => false),
		'updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'currency_id' => 1,
			'24h_volume_usd' => '',
			'market_cap_usd' => '',
			'available_supply' => '',
			'total_supply' => '',
			'max_supply' => '',
			'percent_change_1h' => '',
			'percent_change_24h' => '',
			'percent_change_7d' => '',
			'rank' => 1,
			'price_btc' => '',
			'price_usd' => '',
			'updated' => '2018-04-07 12:41:35',
			'created' => '2018-04-07 12:41:35'
		),
	);

}
