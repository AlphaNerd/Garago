<?php
App::uses('IndHisHi', 'Model');

/**
 * IndHisHi Test Case
 */
class IndHisHiTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ind_his_hi'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->IndHisHi = ClassRegistry::init('IndHisHi');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->IndHisHi);

		parent::tearDown();
	}

}
