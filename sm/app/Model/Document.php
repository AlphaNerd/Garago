<?php
App::uses('AppModel', 'Model');
/**
 * Document Model
 *
 * @property Attachment $Attachment
 * @property DocumentCategory $DocumentCategory
 * @property DocumentCustomer $DocumentCustomer
 * @property DocumentLanguge $DocumentLanguge
 * @property DocumentSector $DocumentSector
 */
class Document extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		
		'DocumentCategory' => array(
			'className' => 'DocumentCategory',
			'foreignKey' => 'document_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'DocumentCustomer' => array(
			'className' => 'DocumentCustomer',
			'foreignKey' => 'document_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'DocumentLanguage' => array(
			'className' => 'DocumentLanguage',
			'foreignKey' => 'document_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'DocumentSector' => array(
			'className' => 'DocumentSector',
			'foreignKey' => 'document_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
