<?php
App::uses('BugTracker', 'Model');

/**
 * BugTracker Test Case
 *
 */
class BugTrackerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bug_tracker',
		'app.bug',
		'app.situation',
		'app.organization'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BugTracker = ClassRegistry::init('BugTracker');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BugTracker);

		parent::tearDown();
	}

}
