<?php
App::uses('PermissionAccess', 'Model');

/**
 * PermissionAccess Test Case
 *
 */
class PermissionAccessTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.permission_access'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PermissionAccess = ClassRegistry::init('PermissionAccess');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PermissionAccess);

		parent::tearDown();
	}

}
