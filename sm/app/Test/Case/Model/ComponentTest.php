<?php
App::uses('Component', 'Model');

/**
 * Component Test Case
 *
 */
class ComponentTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Component = ClassRegistry::init('Component');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Component);

		parent::tearDown();
	}

/**
 * testInitialize method
 *
 * @return void
 */
	public function testInitialize() {
	}

/**
 * testStartup method
 *
 * @return void
 */
	public function testStartup() {
	}

/**
 * testBeforeRender method
 *
 * @return void
 */
	public function testBeforeRender() {
	}

/**
 * testShutdown method
 *
 * @return void
 */
	public function testShutdown() {
	}

/**
 * testBeforeRedirect method
 *
 * @return void
 */
	public function testBeforeRedirect() {
	}

}
