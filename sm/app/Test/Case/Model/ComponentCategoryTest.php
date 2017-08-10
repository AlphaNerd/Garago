<?php
App::uses('ComponentCategory', 'Model');

/**
 * ComponentCategory Test Case
 *
 */
class ComponentCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.component_category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ComponentCategory = ClassRegistry::init('ComponentCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ComponentCategory);

		parent::tearDown();
	}

}
