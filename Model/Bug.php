<?php
App::uses('AppModel', 'Model');

class Bug extends AppModel {

	public $validate = array(
		'requestor' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'details' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'product_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
		),
		'origin_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
                'notEmpty' => array(
                    'rule' => array('notEmpty')
                )
            )
        ),
	);

	public $belongsTo = array(
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'product_id',
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
        ),
        'Technician' => array(
            'className' => 'User',
            'foreignKey' => '',
            'conditions' => array('BugTracker.technician_array[1] = Technician.id'),
            'fields' => '',
            'order' => ''
        ),
		'Situation' => array(
			'className' => 'Situation',
			'foreignKey' => '',
            'conditions' => array('BugTracker.situation_id = Situation.id'),
			'fields' => '',
			'order' => ''
		),
		'Origin' => array(
			'className' => 'Organization',
			'foreignKey' => 'origin_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
        'Organization' => array(
            'className' => 'Organization',
            'foreignKey' => '',
            'conditions' => array('BugTracker.organization_id = Organization.id'),
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

	public $hasMany = array(
		'BugTrackers' => array(
			'className' => 'BugTracker',
			'foreignKey' => 'bug_id',
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
