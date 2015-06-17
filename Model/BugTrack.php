<?php
App::uses('AppModel', 'Model');
/**
 * BugTracker Model
 *
 * @property Bug $Bug
 * @property Situation $Situation
 * @property Organization $Organization
 */
class BugTrack extends AppModel {
	
	public $actsAs = array('AccessKit.Log');

	public $validate = array(
		'bug_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'situation_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'details' => array(
		),
		'organization_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'created_by' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'updated_by' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
	);

	public $belongsTo = array(
		'Bug' => array(
			'className' => 'Bug',
			'foreignKey' => 'bug_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
        'Technician' => array(
            'className' => 'User',
            'foreignKey' => 'technician_array[1]',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
		'Situation' => array(
			'className' => 'Situation',
			'foreignKey' => 'situation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Organization' => array(
			'className' => 'Organization',
			'foreignKey' => 'organization_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
        'Creator' => array(
            'className' => 'User',
            'foreignKey' => 'created_by',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
	);
}
