<?php
App::uses('ActivityManager', 'Model');

/**
 * ActivityManager Test Case
 */
class ActivityManagerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.activity_manager'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ActivityManager = ClassRegistry::init('ActivityManager');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ActivityManager);

		parent::tearDown();
	}

}
