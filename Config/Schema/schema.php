<?php 
class AppSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

	public $bug_attachments = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'bug_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'bug_tracker_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100),
		'file_path' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 256),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $bug_tracker = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'bug_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'situation_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'details' => array('type' => 'text', 'null' => false, 'default' => null, 'length' => 1073741824),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_by' => array('type' => 'integer', 'null' => false, 'default' => null),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated_by' => array('type' => 'integer', 'null' => false, 'default' => null),
		'technician_array' => array('type' => 'text', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $bugs = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'requestor' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200),
		'details' => array('type' => 'text', 'null' => false, 'default' => null, 'length' => 1073741824),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'origin_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_by' => array('type' => 'integer', 'null' => false, 'default' => null),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated_by' => array('type' => 'integer', 'null' => false, 'default' => null),
		'reporter_id' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100),
		'phone' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 16),
		'bug_tracker_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'deadline_alert' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'deadline' => array('type' => 'date', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $location_groups = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100),
		'geo' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 60),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $logs = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'date_time' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'alias' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100),
		'action' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 30),
		'oid' => array('type' => 'integer', 'null' => false, 'default' => null),
		'content' => array('type' => 'text', 'null' => false, 'default' => null, 'length' => 1073741824),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'username' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100),
		'client_ip' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $organizations = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200),
		'responsible' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'parent_array' => array('type' => 'text', 'null' => true, 'default' => null),
		'acronym' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 12),
		'phone' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20),
		'enabled' => array('type' => 'boolean', 'null' => true, 'default' => true),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $products = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100),
		'description' => array('type' => 'text', 'null' => false, 'default' => null, 'length' => 1073741824),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'deadline' => array('type' => 'integer', 'null' => true, 'default' => '1'),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $roles = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100),
		'sort' => array('type' => 'integer', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $situations = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100),
		'role_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'sort' => array('type' => 'integer', 'null' => false, 'default' => null),
		'archived' => array('type' => 'boolean', 'null' => true, 'default' => false),
		'progress_order' => array('type' => 'integer', 'null' => true, 'default' => '1'),
		'color' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20),
		'next_situation_id' => array('type' => 'integer', 'null' => true, 'default' => null),
		'deadline_edit' => array('type' => 'boolean', 'null' => true, 'default' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
		),
		'tableParameters' => array()
	);

	public $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 300),
		'username' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 128),
		'password' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 128),
		'phone' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100),
		'role_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'organization_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created_by' => array('type' => 'integer', 'null' => false, 'default' => null),
		'updated' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'updated_by' => array('type' => 'integer', 'null' => false, 'default' => null),
		'last_signin' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'requestor' => array('type' => 'boolean', 'null' => true, 'default' => false),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id'),
			'username_un' => array('unique' => true, 'column' => 'username')
		),
		'tableParameters' => array()
	);

}
