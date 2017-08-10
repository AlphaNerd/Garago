<?php
/**
 * IndHisHi Fixture
 */
class IndHisHiFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'historical_indicator_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indicator_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'historical_indicator_id' => 1,
			'indicator_id' => 1
		),
	);

}
