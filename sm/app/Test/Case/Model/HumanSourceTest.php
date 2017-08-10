<?php
App::uses('HumanSource', 'Model');

/**
 * HumanSource Test Case
 *
 */
class HumanSourceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.human_source'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HumanSource = ClassRegistry::init('HumanSource');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HumanSource);

		parent::tearDown();
	}

}
