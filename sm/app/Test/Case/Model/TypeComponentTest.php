<?php
App::uses('TypeComponent', 'Model');

/**
 * TypeComponent Test Case
 *
 */
class TypeComponentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.type_component'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TypeComponent = ClassRegistry::init('TypeComponent');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TypeComponent);

		parent::tearDown();
	}

}
