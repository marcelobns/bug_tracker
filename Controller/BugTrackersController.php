<?php
App::uses('AppController', 'Controller');

class BugTrackersController extends AppController {

	public $components = array('Paginator');

	public function index() {
		$this->BugTracker->recursive = 0;
		$this->set('bugTrackers', $this->Paginator->paginate());
	}

	public function view($id = null) {
		if (!$this->BugTracker->exists($id)) {
			throw new NotFoundException(__('Invalid bug tracker'));
		}
		$options = array('conditions' => array('BugTracker.' . $this->BugTracker->primaryKey => $id));
		$this->set('bugTracker', $this->BugTracker->find('first', $options));
	}

	public function add($bug_id = null) {
        if ($this->request->is(array('post', 'put'))) {
			$this->BugTracker->create();
            $this->BugTracker->bug_id = $bug_id;
            $this->request->data['Bug']['id'] = $bug_id;
            $this->request->data['BugTracker']['technician_array'] = AppController::arrayToDB($this->request->data['BugTracker']['technician_id']);
			if ($this->BugTracker->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The bug tracker has been saved.').' '.$bug_id);
				return $this->redirect(array('controller'=>'bugs', 'action'=>'index'));
			} else {
				$this->Session->setFlash(__('The bug tracker could not be saved. Please, try again.').' '.$bug_id);
			}
		}
        $this->BugTracker->Bug->unBindModel(array(
            'belongsTo'=>array('Technician', 'Organization', 'Creator'),
            'hasMany'=>array('BugTrackers')
        ));
        $this->request->data = $this->BugTracker->Bug->find('first', array('conditions' => array('Bug.id' => $bug_id)));
        $this->request->data['BugTracker']['technician_id'] = AppController::arrayFromDB($this->request->data['BugTracker']['technician_array']);
        $this->request->data['BugTracker']['details'] = '';
        $situations = $this->BugTracker->Situation->find('list', array(
            'conditions' => array('progress_order != 1'),
            'order'=> array('Situation.sort'=>'ASC')
        ));
        $next_situation_id = $this->request->data['Situation']['next_situation_id'];
        $organizations = $this->BugTracker->Organization->getChildOrganization($this->Session->read('Auth.User.organization_id'));
        $technicians = $this->BugTracker->Technician->getList($this->Session->read('Auth.User.organization_id'));
        $this->set(compact('bug', 'situations', 'organizations', 'technicians', 'next_situation_id'));
	}

    public function report($bug_id = null) {
        $this->add($bug_id);
        $this->set('next_situation_id', 10);
        $this->render('add');
    }

	public function edit($id = null) {
//		if (!$this->BugTracker->exists($id)) {
//			throw new NotFoundException(__('Invalid bug tracker'));
//		}
//		if ($this->request->is(array('post', 'put'))) {
//			if ($this->BugTracker->save($this->request->data)) {
//				$this->Session->setFlash(__('The bug tracker has been saved.'));
//				return $this->redirect(array('action' => 'index'));
//			} else {
//				$this->Session->setFlash(__('The bug tracker could not be saved. Please, try again.'));
//			}
//		} else {
//			$options = array('conditions' => array('BugTracker.' . $this->BugTracker->primaryKey => $id));
//			$this->request->data = $this->BugTracker->find('first', $options);
//		}
//		$bugs = $this->BugTracker->Bug->find('list');
//		$situations = $this->BugTracker->Situation->find('list');
//		$organizations = $this->BugTracker->Organization->find('list');
//		$this->set(compact('bugs', 'situations', 'organizations'));
	}

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
