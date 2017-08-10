<?php
/**
 * Task Fixture
 */
class TaskFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'description' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 222, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'references' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 222, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'description' => 'Lorem ipsum dolor sit amet',
			'references' => 'Lorem ipsum dolor sit amet',
			'item_id' => 1
		),
	);

}
