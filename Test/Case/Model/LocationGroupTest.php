<?php
App::uses('LocationGroup', 'Model');

/**
 * LocationGroup Test Case
 *
 */
class LocationGroupTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.location_group',
		'app.bug',
		'app.product',
		'app.situation',
		'app.priority',
		'app.bug_tracker',
		'app.organization'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->LocationGroup = ClassRegistry::init('LocationGroup');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->LocationGroup);

		parent::tearDown();
	}

}
