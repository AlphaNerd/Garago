<?php
App::uses('Metric', 'Model');

/**
 * Metric Test Case
 */
class MetricTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.metric'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Metric = ClassRegistry::init('Metric');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Metric);

		parent::tearDown();
	}

}
