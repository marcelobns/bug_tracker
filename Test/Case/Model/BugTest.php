<?php
App::uses('Bug', 'Model');

/**
 * Bug Test Case
 *
 */
class BugTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bug',
		'app.product',
		'app.situation',
		'app.priority',
		'app.location_group',
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
		$this->Bug = ClassRegistry::init('Bug');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Bug);

		parent::tearDown();
	}

}
