<?php
App::uses('AppModel', 'Model');
/**
 * Comment Model
 *
 * @property Issue $Issue
 * @property Issue $Issue
 */
class Comment extends BugCakeAppModel {


/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'BugCake.Issue' => array(
			'className' => 'BugCake.Issue',
			'foreignKey' => 'comment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'BugCake.Issue' => array(
			'className' => 'BugCake.Issue',
			'foreignKey' => 'issue_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
