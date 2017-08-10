<?php
App::uses('Historical', 'Model');

/**
 * Historical Test Case
 */
class HistoricalTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.historical'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Historical = ClassRegistry::init('Historical');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Historical);

		parent::tearDown();
	}

}
