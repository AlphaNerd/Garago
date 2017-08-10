<?php
App::uses('PersonalOffer', 'Model');

/**
 * PersonalOffer Test Case
 */
class PersonalOfferTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.personal_offer',
		'app.historical',
		'app.item',
		'app.offer',
		'app.task',
		'app.permission_access'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PersonalOffer = ClassRegistry::init('PersonalOffer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PersonalOffer);

		parent::tearDown();
	}

}
