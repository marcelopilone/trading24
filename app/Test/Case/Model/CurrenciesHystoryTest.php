<?php
App::uses('CurrenciesHystory', 'Model');

/**
 * CurrenciesHystory Test Case
 */
class CurrenciesHystoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.currencies_hystory',
		'app.currency'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CurrenciesHystory = ClassRegistry::init('CurrenciesHystory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CurrenciesHystory);

		parent::tearDown();
	}

}
