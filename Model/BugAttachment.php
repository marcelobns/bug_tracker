<?php
App::uses('AppModel', 'Model');
/**
 * BugAttachment Model
 *
 * @property Bug $Bug
 * @property BugTracker $BugTracker
 */
class BugAttachment extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Bug' => array(
			'className' => 'Bug',
			'foreignKey' => 'bug_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'BugTracker' => array(
			'className' => 'BugTracker',
			'foreignKey' => 'bug_tracker_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
