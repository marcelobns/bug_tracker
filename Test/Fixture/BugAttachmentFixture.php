<?php
/**
 * BugAttachmentFixture
 *
 */
class BugAttachmentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'length' => 11, 'key' => 'primary'),
		'bug_id' => array('type' => 'integer', 'null' => false),
		'bug_tracker_id' => array('type' => 'integer', 'null' => false),
		'name' => array('type' => 'string', 'null' => false, 'length' => 100),
		'file_path' => array('type' => 'string', 'null' => false, 'length' => 256),
		'indexes' => array(
			'PRIMARY' => array('unique' => true, 'column' => 'id')
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
			'bug_id' => 1,
			'bug_tracker_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'file_path' => 'Lorem ipsum dolor sit amet'
		),
	);

}
