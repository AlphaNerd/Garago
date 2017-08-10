<?php
/**
 * PermissionAccessFixture
 *
 */
class PermissionAccessFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'permission_access';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'personal_offers_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'task_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'permission' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 222, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'groupe_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'date_debut' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 222, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'date_fin' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 222, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'personal_offers_id' => 1,
			'task_id' => 1,
			'permission' => 'Lorem ipsum dolor sit amet',
			'groupe_id' => 1,
			'date_debut' => 'Lorem ipsum dolor sit amet',
			'date_fin' => 'Lorem ipsum dolor sit amet'
		),
	);

}
