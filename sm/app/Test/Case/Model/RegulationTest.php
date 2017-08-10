<?php
App::uses('Regulation', 'Model');

/**
 * Regulation Test Case
 *
 */
class RegulationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.regulation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Regulation = ClassRegistry::init('Regulation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Regulation);

		parent::tearDown();
	}

}
