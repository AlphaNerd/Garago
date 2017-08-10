<?php
/**
 * Offer Fixture
 */
class OfferFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 222, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'price' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 222, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'regulation_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'nombre' => 'Lorem ipsum dolor sit amet',
			'price' => 'Lorem ipsum dolor sit amet',
			'regulation_id' => 1,
			'item_id' => 1
		),
	);

}
