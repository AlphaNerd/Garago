<?php
App::uses('OptionPlan', 'Model');

/**
 * OptionPlan Test Case
 *
 */
class OptionPlanTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.option_plan'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OptionPlan = ClassRegistry::init('OptionPlan');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OptionPlan);

		parent::tearDown();
	}

}
