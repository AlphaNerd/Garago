<?php
App::uses('ProjectDetailPlanning', 'Model');

/**
 * ProjectDetailPlanning Test Case
 *
 */
class ProjectDetailPlanningTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.project_detail_planning'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProjectDetailPlanning = ClassRegistry::init('ProjectDetailPlanning');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProjectDetailPlanning);

		parent::tearDown();
	}

}
