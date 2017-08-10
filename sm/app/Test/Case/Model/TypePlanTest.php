<?php
App::uses('TypePlan', 'Model');

/**
 * TypePlan Test Case
 *
 */
class TypePlanTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.type_plan'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TypePlan = ClassRegistry::init('TypePlan');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TypePlan);

		parent::tearDown();
	}

}
