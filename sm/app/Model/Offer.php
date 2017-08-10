<?php
App::uses('AppModel', 'Model');
/**
 * Offer Model
 *
 * @property Regulation $Regulation
 * @property Item $Item
 */
class Offer extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Regulation' => array(
			'className' => 'Regulation',
			'foreignKey' => 'regulation_id',
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
