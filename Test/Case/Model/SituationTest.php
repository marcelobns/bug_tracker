<?php
App::uses('Situation', 'Model');

/**
 * Situation Test Case
 *
 */
class SituationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.situation',
		'app.role',
		'app.user',
		'app.bug_tracker',
		'app.bug',
		'app.product',
		'app.organization',
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
		$this->Situation = ClassRegistry::init('Situation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Situation);

		parent::tearDown();
	}

}
