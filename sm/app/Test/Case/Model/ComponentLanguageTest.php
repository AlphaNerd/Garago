<?php
App::uses('ComponentLanguage', 'Model');

/**
 * ComponentLanguage Test Case
 *
 */
class ComponentLanguageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.component_language'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ComponentLanguage = ClassRegistry::init('ComponentLanguage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ComponentLanguage);

		parent::tearDown();
	}

}
