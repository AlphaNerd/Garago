<?php
App::uses('ComponentCustomer', 'Model');

/**
 * ComponentCustomer Test Case
 *
 */
class ComponentCustomerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.component_customer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ComponentCustomer = ClassRegistry::init('ComponentCustomer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ComponentCustomer);

		parent::tearDown();
	}

}
