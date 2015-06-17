<?php
App::uses('AppController', 'Controller');

class BugsController extends AppController {

	public $components = array('Paginator');

	public function index() {
		$role_clause = $this->Session->read('Auth.User.Role.sort') <= 2 ? '' : 'BugTrack.technician_array is null';
		$conditions = array(
			'Situation.archived'=>false,
			'OR'=>array(
				$this->Session->read('Auth.User.id').' = ANY(BugTrack.technician_array)',
				array(
					$this->Session->read('Auth.User.organization_id').' = ANY(Organization.parent_array)',
					$role_clause
					)
				)
			);

		if(@$_GET['q']){
			$q = is_numeric($_GET['q']) ? $_GET['q'] : '%'.$_GET['q'].'%';
			$conditions = array(
				"(	Bug.id::text ilike '$q' OR
					Origin.name::text ilike '$q' OR
					Origin.acronym::text ilike '$q' OR
					Technician.name::text ilike '$q' OR
					Product.name::text ilike '$q' )",
			'OR'=>array(
				$this->Session->read('Auth.User.id').' = ANY(BugTrack.technician_array)',
				$this->Session->read('Auth.User.organization_id').' = ANY(Organization.parent_array)'
				)
			);
		}
		$this->paginate = array(
			'recursive'=>0,
			'fields'=>array(
				'Bug.id', 'Bug.deadline', 'Bug.updated',
				'Product.name','Origin.name', 'Origin.acronym','Technician.username',
				'Situation.name', 'Situation.color', 'Situation.progress_order'
				),
			'conditions' => $conditions,
			'order' => array('Situation.sort'=>'ASC', 'Bug.deadline'=>'ASC', 'Bug.created'=>'ASC')
			);
		$this->set('bugs', $this->Paginator->paginate());
	}

	public function view($id = null) {
		if (!$this->Bug->exists($id)) {
			throw new NotFoundException(__('Invalid bug'));
		}
		$options = array(
			'recursive' => 0,
			'fields' => array(
				'Bug.*',
				'Product.name',
				'Situation.name','Situation.color',
				'Origin.name',
				'Organization.name',
				'Creator.name',
				),
			'conditions' => array('Bug.' . $this->Bug->primaryKey => $id)
			);
		$bug = $this->Bug->find('first', $options);
		$bugTracks = $this->Bug->BugTrack->find('all', array(
			'fields' => array(
				'BugTrack.*',
				'Creator.username',
				'array(SELECT t.username FROM users t where t.id = any(BugTrack.technician_array)) as "Technician__array"',
				'Situation.name'
				),
			'conditions' => array('BugTrack.bug_id'=>$id, 'Situation.progress_order != 1'),
			'order' => array('BugTrack.created' => 'DESC')
			));
		$this->set('bug', $bug);
		$this->set('bugTracks', $bugTracks);
		$this->set('modal_title', __('Bug') . ' <b>'.$id.'</b>');
		$this->layout = 'modal';
	}

	public function view_print($id = null) {
		if (!$this->Bug->exists($id)) {
			throw new NotFoundException(__('Invalid bug'));
		}
		$options = array(
			'recursive' => 0,
			'fields' => array(
				'Bug.*',
				'Product.id', 'Product.name',
				'Situation.id', 'Situation.name',
				'Origin.id', 'Origin.name',
				'Creator.id', 'Creator.name',
				'BugTrack.*',
				'array(SELECT t.username FROM users t where t.id = any(BugTrack.technician_array)) as "Technician__array"',
				),
			'conditions' => array('Bug.' . $this->Bug->primaryKey => $id)
			);
		$bug = $this->Bug->find('first', $options);
		$this->set('bug', $bug);
		$this->layout = 'printable';
	}

	public function add(){
		if ($this->request->is('post')) {
			$this->request->data['BugTrack']['Bug'] = $this->request->data['Bug'];
			$this->request->data['BugTrack']['details'] = $this->request->data['Bug']['details'];
			$this->request->data['BugTrack']['technician_array'] = AppController::arrayToDB($this->request->data['Bug']['technician_id']);
			$product = $this->Bug->Product->find('first', array(
				'fields'=>array('Product.organization_id'),
				'conditions'=>array('Product.id'=>$this->request->data['Bug']['product_id'])
				));
			$this->request->data['BugTrack']['organization_id'] = $product['Product']['organization_id'];
			$this->Bug->create();
			if ($this->Bug->BugTrack->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The bug has been saved.').': '.$this->Bug->id);
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bug could not be saved. Please, try again.'));
			}
		}
		$origins = $this->Bug->Origin->getChildOrganization();
		$products = $this->Bug->Product->Organization->getProducts($this->Session->read('Auth.User.organization_id'));
		$technicians = $this->Bug->Technician->getList($this->Session->read('Auth.User.organization_id'));
		$situation_open = $this->Bug->Situation->find('first', array(
			'recursive'=>-1,
			'order'=>array('progress_order'=>'ASC'),
			'limit'=>1
			));
		$situation_open = $situation_open['Situation']['id'];
		$this->set(compact('products', 'situation_open', 'origins', 'technicians'));
	}

	public function edit($id = null) {
		if (!$this->Bug->exists($id)) {
			throw new NotFoundException(__('Invalid bug'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$this->request->data['BugTrack']['Bug'] = $this->request->data['Bug'];
			$this->request->data['BugTrack']['details'] = $this->request->data['Bug']['details'];
			$this->request->data['BugTrack']['technician_array'] = AppController::arrayToDB($this->request->data['Bug']['technician_id']);
			$product = $this->Bug->Product->find('first', array(
				'fields'=>array('Product.organization_id'),
				'conditions'=>array('Product.id'=>$this->request->data['Bug']['product_id'])
				));
			$this->request->data['BugTrack']['organization_id'] = $product['Product']['organization_id'];

			if ($this->Bug->BugTrack->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The bug has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bug could not be saved. Please, try again.'));
			}
		} else {
			$this->Bug->unBindModel(array(
				'belongsTo'=>array('Product', 'Technician', 'Situation', 'Origin', 'Organization', 'Creator')
				));
			$options = array(
				'recursive' => 0,
				'conditions' => array('Bug.' . $this->Bug->primaryKey => $id)
				);
			$this->request->data = $this->Bug->find('first', $options);
			$this->request->data['Bug']['technician_id'] = AppController::arrayFromDB($this->request->data['BugTrack']['technician_array']);
			// var_dump($this->request->data['Bug']);
		}
		$origins = $this->Bug->Origin->getChildOrganization();
		$products = $this->Bug->Product->Organization->getProducts($this->Session->read('Auth.User.organization_id'));
		$technicians = $this->Bug->Technician->getList($this->Session->read('Auth.User.organization_id'));
		$situations = $this->Bug->Situation->find('list', array(
			'order'=>array('progress_order'=>'ASC')
			));
		$this->set(compact('products', 'situations', 'priorities', 'origins', 'technicians'));
	}

	public function delete($id = null) {
		$this->Bug->id = $id;
		if (!$this->Bug->exists()) {
			throw new NotFoundException(__('Invalid bug'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Bug->delete()) {
			$this->Session->setFlash(__('The bug has been deleted.'));
		} else {
			$this->Session->setFlash(__('The bug could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function producao_tecnico() {
		$producao = array();
		if(@$_GET['from']){
			$producao = $this->Bug->query("SELECT
												u.name as tecnico,
												count(b.id) as qtd
											FROM bugs b
											INNER JOIN bug_tracks bt on bt.id = b.bug_track_id
											INNER JOIN organizations o on o.id = bt.organization_id
											INNER JOIN users u on u.id  = ANY(bt.technician_array)
											WHERE bt.situation_id in (3,4)
												and b.created BETWEEN '".$_GET['from']."' and '".$_GET['to']."'
												and ".$this->Session->read('Auth.User.organization_id')." = ANY(o.parent_array)
											GROUP BY tecnico
											ORDER BY qtd DESC");
		}
		$this->set('producao', $producao);
	}

	public function resumo_demanda() {

	}

	public function resumo_organizacao(){

	}
}
