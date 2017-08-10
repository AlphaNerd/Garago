<?php
App::uses('HistoricalIndicator', 'Model');

/**
 * HistoricalIndicator Test Case
 */
class HistoricalIndicatorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.historical_indicator'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HistoricalIndicator = ClassRegistry::init('HistoricalIndicator');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HistoricalIndicator);

		parent::tearDown();
	}

}
