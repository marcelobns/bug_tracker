<?php
App::uses('AppController', 'Controller');
/**
 * BugTrackers Controller
 *
 * @property BugTracker $BugTracker
 * @property PaginatorComponent $Paginator
 */
class BugTrackersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->BugTracker->recursive = 0;
		$this->set('bugTrackers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BugTracker->exists($id)) {
			throw new NotFoundException(__('Invalid bug tracker'));
		}
		$options = array('conditions' => array('BugTracker.' . $this->BugTracker->primaryKey => $id));
		$this->set('bugTracker', $this->BugTracker->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($bug_id = null) {
		if ($this->request->is('post')) {
			$this->BugTracker->create();
            $this->BugTracker->bug_id = $bug_id;

            $this->request->data['BugTracker']['technician_array'] = AppController::arrayToDB($this->request->data['BugTracker']['technician_id']);
            $this->request->data['BugTracker']['technician_id'] = $this->request->data['BugTracker']['technician_id'][0];

			if ($this->BugTracker->save($this->request->data)) {
				$this->Session->setFlash(__('The bug tracker has been saved.').' '.$bug_id);
				return $this->redirect(array('controller'=>'bugs', 'action'=>'index'));
			} else {
				$this->Session->setFlash(__('The bug tracker could not be saved. Please, try again.').' '.$bug_id);
			}
		}
		$bug = $this->BugTracker->Bug->find('first', array('conditions' => array('Bug.id' => $bug_id)));
		$situations = $this->BugTracker->Situation->find('list', array(
            'conditions' => array('progress_order != 1'),
            'order'=> array('Situation.sort'=>'ASC')
        ));
        $next_track = $this->BugTracker->Situation->find('first', array(
            'recursive' => -1,
            'conditions' => array('progress_order > '. $bug['Situation']['progress_order']),
            'order' => array('Situation.sort' => 'ASC')
        ));

        $organizations = $this->BugTracker->Organization->getChildOrganization($this->Session->read('Auth.User.organization_id'));

        $technicians = $this->BugTracker->User->find('list', array(
            'joins' => array(
                array(
                    'table' => 'public.organizations',
                    'alias' => 'Organization',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Organization.id = '.$bug['Product']['organization_id']
                    )
                ),
            ),
            'conditions' => array(
                'User.organization_id = any(Organization.parent_array)'
            ),
            'order' => array('User.name' => 'ASC')
        ));
        $this->set('next_track', isset($next_track['Situation']['id']) ? $next_track['Situation']['id'] : 1);
		$this->set(compact('bug', 'situations', 'organizations', 'technicians'));
	}

    public function report($bug_id = null) {
        $this->add($bug_id);
        $this->set('next_track', 10);
        $this->render('add');
    }

    /**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->BugTracker->exists($id)) {
			throw new NotFoundException(__('Invalid bug tracker'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->BugTracker->save($this->request->data)) {
				$this->Session->setFlash(__('The bug tracker has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bug tracker could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BugTracker.' . $this->BugTracker->primaryKey => $id));
			$this->request->data = $this->BugTracker->find('first', $options);
		}
		$bugs = $this->BugTracker->Bug->find('list');
		$situations = $this->BugTracker->Situation->find('list');
		$organizations = $this->BugTracker->Organization->find('list');
		$this->set(compact('bugs', 'situations', 'organizations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->BugTracker->id = $id;
		if (!$this->BugTracker->exists()) {
			throw new NotFoundException(__('Invalid bug tracker'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->BugTracker->delete()) {
			$this->Session->setFlash(__('The bug tracker has been deleted.'));
		} else {
			$this->Session->setFlash(__('The bug tracker could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
