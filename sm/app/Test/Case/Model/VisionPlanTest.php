<?php
App::uses('VisionPlan', 'Model');

/**
 * VisionPlan Test Case
 *
 */
class VisionPlanTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.vision_plan'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->VisionPlan = ClassRegistry::init('VisionPlan');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->VisionPlan);

		parent::tearDown();
	}

}
