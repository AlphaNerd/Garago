<?php
App::uses('Axis', 'Model');

/**
 * Axis Test Case
 *
 */
class AxisTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.axis'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Axis = ClassRegistry::init('Axis');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Axis);

		parent::tearDown();
	}

}
