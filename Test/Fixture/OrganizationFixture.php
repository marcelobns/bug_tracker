<?php
/**
 * OrganizationFixture
 *
 */
class OrganizationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'length' => 200),
		'responsible' => array('type' => 'string', 'null' => false, 'length' => 100),
		'parent_id' => array('type' => 'integer', 'null' => true),
		'parent_array' => array('type' => 'text', 'null' => false),
		'acronym' => array('type' => 'string', 'null' => true, 'length' => 12),
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
			'name' => 'Lorem ipsum dolor sit amet',
			'responsible' => 'Lorem ipsum dolor sit amet',
			'parent_id' => 1,
			'parent_array' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'acronym' => 'Lorem ipsu'
		),
	);

}
