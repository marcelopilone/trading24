<?php
/**
 * Movimiento Fixture
 */
class MovimientoFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
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

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'cantidad_inicial' => 10000,
			'cant_monedas' =>  1,
			'precio_compra' =>  10,
			'precio_venta' =>  0,
			'moneda_de_intercambio' => 'BTCUSDT',
			'porcentaje' => 2,
			'cantidad_final' =>  2,
			'compra_o_venta' => 'compra',
			'rsi' =>  '25',
			'updated' => '2019-03-03',
	        'created' => '2019-03-03',
		),
	);

}
