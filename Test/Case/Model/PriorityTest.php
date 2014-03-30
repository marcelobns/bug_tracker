<?php
App::uses('Priority', 'Model');

/**
 * Priority Test Case
 *
 */
class PriorityTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.priority',
		'app.bug',
		'app.product',
		'app.situation',
		'app.location_group',
		'app.bug_tracker',
		'app.organization',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Priority = ClassRegistry::init('Priority');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Priority);

		parent::tearDown();
	}

}
