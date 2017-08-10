<?php
App::uses('DetailPlan', 'Model');

/**
 * DetailPlan Test Case
 *
 */
class DetailPlanTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.detail_plan'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DetailPlan = ClassRegistry::init('DetailPlan');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DetailPlan);

		parent::tearDown();
	}

}
