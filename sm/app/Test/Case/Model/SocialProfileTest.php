<?php
App::uses('SocialProfile', 'Model');

/**
 * SocialProfile Test Case
 *
 */
class SocialProfileTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.social_profile',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SocialProfile = ClassRegistry::init('SocialProfile');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SocialProfile);

		parent::tearDown();
	}

}
