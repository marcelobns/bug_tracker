<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Role $Role
 * @property Organization $Organization
 */
class User extends AppModel {

	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
			),
		),
		'username' => array(
            'isUnique'  => array(
                'rule'=>'isUnique',
                'message' => 'This username has already been taken.'
            ),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'password' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
        'confirm_password' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        ),
		'phone' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'role_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
			),
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
		'Role' => array(
			'className' => 'Role',
			'foreignKey' => 'role_id',
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
		)
	);

    function getList($organization_id = null) {
        $alias = $this->tableToModel['users'];
        $users = $this->find('all', array(
            'recursive'=>0,
            'fields'=>array(
                $alias.'.id',
                $alias.'.name',
                '(select count(b.id)
                from bugs b
                inner join bug_tracker bt on bt.id = b.bug_tracker_id
                inner join situations s on s.id = bt.situation_id
                where "'.ucfirst($alias).'".id = any(bt.technician_array) and s.archived = false) as "'.$alias.'__count"'
            ),
            'conditions' => array(
                $organization_id.' = any(Organization.parent_array)'
            ),
            'order' => array($alias.'.name' => 'ASC')
        ));
        return Set::combine($users, '{n}.'.$alias.'.id', array('{0} ({1})', '{n}.'.$alias.'.name', '{n}.'.$alias.'.count'));
    }
}
