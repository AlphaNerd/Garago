<?php
/**
 * PersonalOffer Fixture
 */
class PersonalOfferFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'number' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 22, 'unsigned' => false),
		'price' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 222, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'historical_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'number' => 1,
			'price' => 'Lorem ipsum dolor sit amet',
			'historical_id' => 1,
			'item_id' => 1
		),
	);

}
