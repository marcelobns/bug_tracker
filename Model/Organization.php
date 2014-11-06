<?php
App::uses('AppModel', 'Model');
class Organization extends AppModel {

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

	public $belongsTo = array(
		'ParentOrganization' => array(
			'className' => 'Organization',
			'foreignKey' => 'parent_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

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
        $alias = $this->tableToModel['organizations'];
        $this->unBindModel(array(
            'hasMany' => array('Stock', 'Trade', 'User'),
            'belongsTo' => array('ParentOrganization', 'OrganizationType')
        ));
        $parent_condition = $alias.'.parent_id != 0';
        if($parent_id != null){
            $parent_condition = $parent_id.' = ANY('.$alias.'.parent_array)';
        }
        $organizations = $this->find('all', array(
                'conditions' => array(
                    $parent_condition,
                    $alias.'.enabled'=>true
                ),
                'order' => array($alias.'.id'=>'ASC', $alias.'.name'=>'ASC')
            )
        );
        $return = array();
        foreach ($organizations as $i=>$organization) {
            $acronym = ' ';
            if($i == 0)
                $return[$organization[$alias]['name']][$organization[$alias]['id']] = $organization[$alias]['name'].$acronym;
            foreach ($organization['ChildOrganization'] as $child) {
                if(trim($child['acronym']) != ''){
                    $acronym = ' - '.$child['acronym'];
                }
                $return[$organization[$alias]['name']][$child['id']] = $child['name'].$acronym;
                $acronym = ' ';
            }
        }
        if(sizeof($return) != 0){
            return $return;
        } else {
            $this->unBindModel(array(
                'hasMany' => array('Stock', 'Trade', 'User', 'ChildOrganization'),
                'belongsTo' => array('ParentOrganization','OrganizationType')
            ));
            return $this->find('list', array(
                    'recursive' => -1,
                    'conditions' => array(
                        $alias.'.enabled'=>true
                    ),
                    'order' => array($alias.'.name'=>'ASC')
                )
            );
        }
    }
}
