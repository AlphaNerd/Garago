<?php
/**
 * Attachment Fixture
 */
class AttachmentFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'attachment';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'extension' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 21, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'file' => array('type' => 'binary', 'null' => false, 'default' => null),
		'document_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'size' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 125, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'extension' => 'Lorem ipsum dolor s',
			'file' => 'Lorem ipsum dolor sit amet',
			'document_id' => 1,
			'size' => 'Lorem ipsum dolor sit amet'
		),
	);

}
