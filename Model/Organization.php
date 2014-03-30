<?php
App::uses('AppModel', 'Model');
/**
 * Organization Model
 *
 * @property Organization $ParentOrganization
 * @property BugTracker $BugTracker
 * @property Organization $ChildOrganization
 * @property Product $Product
 * @property User $User
 */
class Organization extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
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
		'responsible' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
        'parent_id' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ParentOrganization' => array(
			'className' => 'Organization',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ChildOrganization' => array(
			'className' => 'Organization',
			'foreignKey' => 'parent_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => 'ChildOrganization.name',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Product' => array(
			'className' => 'Product',
			'foreignKey' => 'organization_id',
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
	);

    function getProducts($organization_id = null) {
        $organizations = $this->find('all', array(
                'contain' => array('Product'),
                'order' => array('Organization.name'=>'ASC')
            )
        );
        if($organization_id != null) {
            $organizations = $this->find('all', array(
                    'contain' => array('Product'),
                    'conditions' => array(
                        $organization_id.' = ANY(Organization.parent_array)',
                    ),
                    'order' => array('Organization.name'=>'ASC')
                )
            );
        }

        $return = array();
        foreach ($organizations as $organization) {
            foreach ($organization['Product'] as $product) {
                $return[$organization['Organization']['name']][$product['id']] = $product['name'];
            }
        }

        return $return;
    }

    function getChildOrganization($parent_id = null) {
        $organizations = $this->find('all', array(
                'conditions' => array(
                    $parent_id.' = ANY(Organization.parent_array)',
                ),
                'order' => array('Organization.id'=>'ASC', 'Organization.name'=>'ASC')
            )
        );
        $return = array();
        $i = 0;
        foreach ($organizations as $organization) {
            if($i == 0)
            $return[$organization['Organization']['name']][$organization['Organization']['id']] = $organization['Organization']['name'].' ';
            $i++;
            foreach ($organization['ChildOrganization'] as $child) {
                $acronym = ' ';
                if(trim($child['acronym']) != ''){
                    $acronym = ' - '.$child['acronym'];
                }
                $return[$organization['Organization']['name']][$child['id']] = $child['name'].$acronym;
            }
        }
        return $return;
    }
}
