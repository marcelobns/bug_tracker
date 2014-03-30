<?php
App::uses('BugAttachment', 'Model');

/**
 * BugAttachment Test Case
 *
 */
class BugAttachmentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bug_attachment',
		'app.bug',
		'app.product',
		'app.organization',
		'app.bug_tracker',
		'app.situation',
		'app.role',
		'app.user',
		'app.priority',
		'app.location_group'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BugAttachment = ClassRegistry::init('BugAttachment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BugAttachment);

		parent::tearDown();
	}

}
