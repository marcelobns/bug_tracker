<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'length' => 300),
		'email' => array('type' => 'string', 'null' => false, 'length' => 300),
		'username' => array('type' => 'string', 'null' => false, 'length' => 128),
		'password' => array('type' => 'string', 'null' => false, 'length' => 128),
		'phone' => array('type' => 'string', 'null' => false, 'length' => 100),
		'role_id' => array('type' => 'integer', 'null' => false),
		'organization_id' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => false),
		'created_by' => array('type' => 'integer', 'null' => false),
		'updated' => array('type' => 'datetime', 'null' => false),
		'updated_by' => array('type' => 'integer', 'null' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'username_un' => array('unique' => true, 'column' => 'username')
		),
		'tableParameters' => array()
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'username' => 'Lorem ipsum dolor sit amet',
			'password' => 'Lorem ipsum dolor sit amet',
			'phone' => 'Lorem ipsum dolor sit amet',
			'role_id' => 1,
			'organization_id' => 1,
			'created' => '2014-02-13 23:58:16',
			'created_by' => 1,
			'updated' => '2014-02-13 23:58:16',
			'updated_by' => 1
		),
	);

}
