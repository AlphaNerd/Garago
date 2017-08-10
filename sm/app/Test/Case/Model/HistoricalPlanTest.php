<?php
App::uses('HistoricalPlan', 'Model');

/**
 * HistoricalPlan Test Case
 *
 */
class HistoricalPlanTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.historical_plan'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HistoricalPlan = ClassRegistry::init('HistoricalPlan');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HistoricalPlan);

		parent::tearDown();
	}

}
