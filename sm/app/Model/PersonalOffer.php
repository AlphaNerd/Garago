<?php
App::uses('AppModel', 'Model');
/**
 * PersonalOffer Model
 *
 * @property Historical $Historical
 * @property Item $Item
 */
class PersonalOffer extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Historical' => array(
			'className' => 'Historical',
			'foreignKey' => 'historical_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Item' => array(
			'className' => 'Item',
			'foreignKey' => 'item_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
