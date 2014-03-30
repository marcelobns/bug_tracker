<?php
App::uses('AppController', 'Controller');
/**
 * BugAttachments Controller
 *
 * @property BugAttachment $BugAttachment
 * @property PaginatorComponent $Paginator
 */
class BugAttachmentsController extends AppController {

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
		$this->BugAttachment->recursive = 0;
		$this->set('bugAttachments', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BugAttachment->exists($id)) {
			throw new NotFoundException(__('Invalid bug attachment'));
		}
		$options = array('conditions' => array('BugAttachment.' . $this->BugAttachment->primaryKey => $id));
		$this->set('bugAttachment', $this->BugAttachment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BugAttachment->create();
			if ($this->BugAttachment->save($this->request->data)) {
				$this->Session->setFlash(__('The bug attachment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bug attachment could not be saved. Please, try again.'));
			}
		}
		$bugs = $this->BugAttachment->Bug->find('list');
		$bugTrackers = $this->BugAttachment->BugTracker->find('list');
		$this->set(compact('bugs', 'bugTrackers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->BugAttachment->exists($id)) {
			throw new NotFoundException(__('Invalid bug attachment'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->BugAttachment->save($this->request->data)) {
				$this->Session->setFlash(__('The bug attachment has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bug attachment could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('BugAttachment.' . $this->BugAttachment->primaryKey => $id));
			$this->request->data = $this->BugAttachment->find('first', $options);
		}
		$bugs = $this->BugAttachment->Bug->find('list');
		$bugTrackers = $this->BugAttachment->BugTracker->find('list');
		$this->set(compact('bugs', 'bugTrackers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->BugAttachment->id = $id;
		if (!$this->BugAttachment->exists()) {
			throw new NotFoundException(__('Invalid bug attachment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->BugAttachment->delete()) {
			$this->Session->setFlash(__('The bug attachment has been deleted.'));
		} else {
			$this->Session->setFlash(__('The bug attachment could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
