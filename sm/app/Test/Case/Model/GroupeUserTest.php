<?php
App::uses('GroupeUser', 'Model');

/**
 * GroupeUser Test Case
 *
 */
class GroupeUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.groupe_user',
		'app.users',
		'app.group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->GroupeUser = ClassRegistry::init('GroupeUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GroupeUser);

		parent::tearDown();
	}

}
