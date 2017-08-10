<?php
App::uses('MaterialSource', 'Model');

/**
 * MaterialSource Test Case
 *
 */
class MaterialSourceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.material_source'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->MaterialSource = ClassRegistry::init('MaterialSource');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->MaterialSource);

		parent::tearDown();
	}

}
