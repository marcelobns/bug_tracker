<?php
App::uses('AppController', 'Controller');
/**
 * LocationGroups Controller
 *
 * @property LocationGroup $LocationGroup
 * @property PaginatorComponent $Paginator
 */
class LocationGroupsController extends AppController {

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
		$this->LocationGroup->recursive = 0;
		$this->set('locationGroups', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->LocationGroup->exists($id)) {
			throw new NotFoundException(__('Invalid location group'));
		}
		$options = array('conditions' => array('LocationGroup.' . $this->LocationGroup->primaryKey => $id));
		$this->set('locationGroup', $this->LocationGroup->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->LocationGroup->create();
			if ($this->LocationGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The location group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The location group could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->LocationGroup->exists($id)) {
			throw new NotFoundException(__('Invalid location group'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->LocationGroup->save($this->request->data)) {
				$this->Session->setFlash(__('The location group has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The location group could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('LocationGroup.' . $this->LocationGroup->primaryKey => $id));
			$this->request->data = $this->LocationGroup->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->LocationGroup->id = $id;
		if (!$this->LocationGroup->exists()) {
			throw new NotFoundException(__('Invalid location group'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->LocationGroup->delete()) {
			$this->Session->setFlash(__('The location group has been deleted.'));
		} else {
			$this->Session->setFlash(__('The location group could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
