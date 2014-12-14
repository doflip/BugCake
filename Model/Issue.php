<?php
App::uses('AppModel', 'Model');
/**
 * Issue Model
 *
 * @property Comment $Comment
 */
class Issue extends BugCakeAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'Issue';


/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'BugCake.Comment' => array(
			'className' => 'BugCake.Comment',
			'foreignKey' => 'issue_id',
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
