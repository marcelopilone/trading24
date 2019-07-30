<?php
App::uses('Movimiento', 'Model');

/**
 * Movimiento Test Case
 */
class MovimientoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.movimiento'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Movimiento = ClassRegistry::init('Movimiento');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Movimiento);

		parent::tearDown();
	}

}
