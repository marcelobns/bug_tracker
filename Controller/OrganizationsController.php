<?php
App::uses('AppController', 'Controller');
class OrganizationsController extends AppController {

	public $components = array('Paginator');

	public function index() {
        $conditions = array(
            'Organization.id not in'=>array(1, $this->Session->read('Auth.User.organization_id')),
            $this->Session->read('Auth.User.organization_id').' = ANY(Organization.parent_array)'
        );
        if(@$_GET['q']){
            $_GET['q'] = is_numeric($_GET['q']) ? $_GET['q'] : '%'.$_GET['q'].'%';
            $conditions = array(
                'Organization.id not in'=>array(1, $this->Session->read('Auth.User.organization_id')),
                $this->Session->read('Auth.User.organization_id').' = ANY(Organization.parent_array)',
                'OR'=>array(
                    'Organization.id::text ilike \''.$_GET['q'].'\'',
                    'Organization.name::text ilike \''.$_GET['q'].'\'',
                )
            );
        }
        $this->paginate = array(
            'recursive'=>0,
            'conditions'=>$conditions,
            'order' => array('Organization.parent_id'=>'ASC', 'Organization.name'=>'ASC')
        );
		$this->set('organizations', $this->Paginator->paginate());
	}

	public function view($id = null) {
		if (!$this->Organization->exists($id)) {
			throw new NotFoundException(__('Invalid organization'));
		}
		$options = array('conditions' => array('Organization.' . $this->Organization->primaryKey => $id));
		$this->set('organization', $this->Organization->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Organization->create();
			if ($this->Organization->save($this->request->data)) {
				$this->Session->setFlash(__('The organization has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The organization could not be saved. Please, try again.'));
			}
		}
		$parents = $this->Organization->getChildOrganization($this->Session->read('Auth.User.organization_id'));
		$this->set(compact('parents'));
	}

	public function edit($id = null) {
		if (!$this->Organization->exists($id)) {
			throw new NotFoundException(__('Invalid organization'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Organization->save($this->request->data)) {
				$this->Session->setFlash(__('The organization has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The organization could not be saved. Please, try again.'));
			}
		} else {
			$options = array(
                'recursive' => -1,
                'conditions' => array('Organization.' . $this->Organization->primaryKey => $id)
            );
			$this->request->data = $this->Organization->find('first', $options);
		}
        $parents = $this->Organization->getChildOrganization($this->Session->read('Auth.User.organization_id'));
		$this->set(compact('parents'));
	}

	public function delete($id = null) {
		$this->Organization->id = $id;
		if (!$this->Organization->exists()) {
			throw new NotFoundException(__('Invalid organization'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Organization->delete()) {
			$this->Session->setFlash(__('The organization has been deleted.'));
		} else {
			$this->Session->setFlash(__('The organization could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
