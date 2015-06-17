<?php
App::uses('AppController', 'Controller');

class BugTracksController extends AppController {

	public $components = array('Paginator');

	public function index() {
		$this->BugTrack->recursive = 0;
		$this->set('BugTracks', $this->Paginator->paginate());
	}

	public function view($id = null) {
		if (!$this->BugTrack->exists($id)) {
			throw new NotFoundException(__('Invalid bug tracker'));
		}
		$options = array('conditions' => array('BugTrack.' . $this->BugTrack->primaryKey => $id));
		$this->set('BugTrack', $this->BugTrack->find('first', $options));
	}

	public function add($bug_id = null) {
		if ($this->request->is(array('post', 'put'))) {
			$this->BugTrack->create();
			$this->BugTrack->bug_id = $bug_id;
			$this->request->data['Bug']['id'] = $bug_id;
			$this->request->data['BugTrack']['technician_array'] = AppController::arrayToDB($this->request->data['BugTrack']['technician_id']);
			if ($this->BugTrack->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The bug tracker has been saved.').' '.$bug_id);
				return $this->redirect(array('controller'=>'bugs', 'action'=>'index'));
			} else {
				$this->Session->setFlash(__('The bug tracker could not be saved. Please, try again.').' '.$bug_id);
			}
		}
		$this->BugTrack->Bug->unBindModel(array(
			'belongsTo'=>array('Technician', 'Organization', 'Creator'),
			'hasMany'=>array('BugTracks')
		));
		$this->request->data = $this->BugTrack->Bug->find('first', array('conditions' => array('Bug.id' => $bug_id)));
		$this->request->data['BugTrack']['technician_id'] = AppController::arrayFromDB($this->request->data['BugTrack']['technician_array']);
		$this->request->data['BugTrack']['details'] = '';
		$situations = $this->BugTrack->Situation->find('list', array(
			'conditions' => array('progress_order != 1'),
			'order'=> array('Situation.sort'=>'ASC')
		));
		$next_situation_id = $this->request->data['Situation']['next_situation_id'];
		$organizations = $this->BugTrack->Organization->getChildOrganization($this->Session->read('Auth.User.organization_id'));
		$technicians = $this->BugTrack->Technician->getList($this->Session->read('Auth.User.organization_id'));
		$this->set(compact('bug', 'situations', 'organizations', 'technicians', 'next_situation_id'));
	}

	public function report($bug_id = null) {
		$this->add($bug_id);
		$this->set('next_situation_id', 10);
		$this->render('add');
	}

	public function edit($id = null) {
		//		if (!$this->BugTrack->exists($id)) {
		//			throw new NotFoundException(__('Invalid bug tracker'));
		//		}
		//		if ($this->request->is(array('post', 'put'))) {
		//			if ($this->BugTrack->save($this->request->data)) {
		//				$this->Session->setFlash(__('The bug tracker has been saved.'));
		//				return $this->redirect(array('action' => 'index'));
		//			} else {
		//				$this->Session->setFlash(__('The bug tracker could not be saved. Please, try again.'));
		//			}
		//		} else {
		//			$options = array('conditions' => array('BugTrack.' . $this->BugTrack->primaryKey => $id));
		//			$this->request->data = $this->BugTrack->find('first', $options);
		//		}
		//		$bugs = $this->BugTrack->Bug->find('list');
		//		$situations = $this->BugTrack->Situation->find('list');
		//		$organizations = $this->BugTrack->Organization->find('list');
		//		$this->set(compact('bugs', 'situations', 'organizations'));
	}

	public function delete($id = null) {
		$this->BugTrack->id = $id;
		if (!$this->BugTrack->exists()) {
			throw new NotFoundException(__('Invalid bug tracker'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->BugTrack->delete()) {
			$this->Session->setFlash(__('The bug tracker has been deleted.'));
		} else {
			$this->Session->setFlash(__('The bug tracker could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
