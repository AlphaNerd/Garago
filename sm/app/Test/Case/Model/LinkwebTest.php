<?php
App::uses('Linkweb', 'Model');

/**
 * Linkweb Test Case
 *
 */
class LinkwebTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.linkweb'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Linkweb = ClassRegistry::init('Linkweb');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Linkweb);

		parent::tearDown();
	}

}
