<?php
/**
 * BugFixture
 *
 */
class BugFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'reporter' => array('type' => 'string', 'null' => false, 'length' => 200),
		'reporter_social' => array('type' => 'string', 'null' => false, 'length' => 256),
		'details' => array('type' => 'text', 'null' => false, 'length' => 1073741824),
		'product_id' => array('type' => 'integer', 'null' => false),
		'situation_id' => array('type' => 'integer', 'null' => false),
		'priority_id' => array('type' => 'integer', 'null' => false),
		'location_geo' => array('type' => 'string', 'null' => false, 'length' => 60),
		'location_group_id' => array('type' => 'integer', 'null' => false),
		'location' => array('type' => 'text', 'null' => false, 'length' => 1073741824),
		'points' => array('type' => 'integer', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => false),
		'created_by' => array('type' => 'integer', 'null' => false),
		'updated' => array('type' => 'datetime', 'null' => false),
		'updated_by' => array('type' => 'integer', 'null' => false),
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
			'reporter' => 'Lorem ipsum dolor sit amet',
			'reporter_social' => 'Lorem ipsum dolor sit amet',
			'details' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'product_id' => 1,
			'situation_id' => 1,
			'priority_id' => 1,
			'location_geo' => 'Lorem ipsum dolor sit amet',
			'location_group_id' => 1,
			'location' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'points' => 1,
			'created' => '2014-02-11 02:12:41',
			'created_by' => 1,
			'updated' => '2014-02-11 02:12:41',
			'updated_by' => 1
		),
	);

}
