<?php
App::uses('Ip', 'Model');

/**
 * Ip Test Case
 */
class IpTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ip'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Ip = ClassRegistry::init('Ip');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ip);

		parent::tearDown();
	}

}
