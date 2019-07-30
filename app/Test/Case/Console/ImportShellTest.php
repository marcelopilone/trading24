<?php
App::uses('ImportShell', 'Console/Command');
App::uses('ConsoleOutput', 'Console');
App::uses('ConsoleInput', 'Console');
App::uses('Shell', 'Console');

/**
 * Currency Test Case
 */
class ImportShellTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.currency',
		'app.CurrenciesHystory',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
        $out = $this->getMock('ConsoleOutput', array(), array(), '', false);
        $in = $this->getMock('ConsoleInput', array(), array(), '', false);
		$this->ImportShell         = new ImportShell;
		$this->CurrenciesHystory   = ClassRegistry::init('CurrenciesHystory');
	}

/**
 * tearDown method
 *
 * @return void
 */


	public function test__createHistoryPrice(){

		// caso de que crea un nuevo historial
		$cantidadHistorialDePreciosAntes = $this->CurrenciesHystory->find('count');

		$currency = array(
			'Currency' => array(
				'id' => 29
			)
		);

		$this->ImportShell->__createHistoryPrice( $currency,$priceUsd = 14.4 );

		$cantidadHistorialDePreciosDespues = $this->CurrenciesHystory->find('count');

		$this->assertEquals( $cantidadHistorialDePreciosAntes+1,$cantidadHistorialDePreciosDespues );

	}

	

}

