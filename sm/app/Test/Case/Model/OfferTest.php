<?php
App::uses('Offer', 'Model');

/**
 * Offer Test Case
 */
class OfferTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.offer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Offer = ClassRegistry::init('Offer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Offer);

		parent::tearDown();
	}

}
