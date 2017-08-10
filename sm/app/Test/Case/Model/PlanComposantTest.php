<?php
App::uses('PlanComposant', 'Model');

/**
 * PlanComposant Test Case
 *
 */
class PlanComposantTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.plan_composant'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PlanComposant = ClassRegistry::init('PlanComposant');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PlanComposant);

		parent::tearDown();
	}

}
