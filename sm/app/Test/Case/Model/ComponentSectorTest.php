<?php
App::uses('ComponentSector', 'Model');

/**
 * ComponentSector Test Case
 *
 */
class ComponentSectorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.component_sector'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ComponentSector = ClassRegistry::init('ComponentSector');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ComponentSector);

		parent::tearDown();
	}

}
