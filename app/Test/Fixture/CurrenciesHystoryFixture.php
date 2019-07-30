<?php
/**
 * CurrenciesHystory Fixture
 */
class CurrenciesHystoryFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'currencies_hystory';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => true, 'key' => 'primary'),
		'currency_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => true),
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
			'price_usd' => 10.20,
			'updated' => '2018-06-23 09:54:08',
			'created' => '2018-06-23 09:54:08'
		),
	);

}
