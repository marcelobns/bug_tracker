<?php
App::uses('AppController', 'Controller');
/**
 * Bugs Controller
 *
 * @property Bug $Bug
 * @property PaginatorComponent $Paginator
 */
class BugsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

	public function index() {
        $conditions = array(
            'NOT' => array('Situation.archived'),
            $this->Session->read('Auth.User.organization_id').' = ANY(Organization.parent_array)'
        );
        $order = array('Situation.sort'=>'ASC', 'Priority.sort'=>'ASC', 'Bug.created'=>'ASC');

        if(isset($_GET['q'])){
            if(is_numeric($_GET['q'])){
                $conditions = array(
                    "Bug.id = " . $_GET['q'],
                    $this->Session->read('Auth.User.organization_id').' = ANY(Organization.parent_array)'
                );
            } else {
                $conditions = array(
                    "Bug.details ilike '%" . $_GET['q']. "%' or
                     Bug.reporter ilike '" . $_GET['q']. "' or
                     LocationGroup.name ilike '" . $_GET['q']. "%'",
                    $this->Session->read('Auth.User.organization_id').' = ANY(Organization.parent_array)'
                );
            }
        }
        if(!$this->Session->read('Auth.User.Role.worker')){
            $order = array('Situation.sort'=>'DESC', 'Priority.sort'=>'ASC', 'Bug.created'=>'ASC');
        }

        $this->paginate = array(
            'recursive' => -1,
            'fields' => array(
                'Bug.*',
                'Product.id', 'Product.name',
                'Situation.id', 'Situation.name','Situation.progress_order', 'Situation.color',
                'LocationGroup.id', 'LocationGroup.name',
                'User.id', 'User.username',
                'Product.organization_id',
                'Technician.username', 'Technician.id'
            ),
            'joins' => array(
                array(
                    'table' => 'public.users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.id = Bug.created_by'
                    )
                ),
                array(
                    'table' => 'public.products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Product.id = Bug.product_id'
                    )
                ),
                array(
                    'table' => 'public.situations',
                    'alias' => 'Situation',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Situation.id = Bug.situation_id'
                    )
                ),
                array(
                    'table' => 'public.location_groups',
                    'alias' => 'LocationGroup',
                    'type' => 'INNER',
                    'conditions' => array(
                        'LocationGroup.id = Bug.location_group_id'
                    )
                ),
                array(
                    'table' => 'public.priorities',
                    'alias' => 'Priority',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Priority.id = Bug.priority_id'
                    )
                ),
                array(
                    'table' => 'public.bug_tracker',
                    'alias' => 'BugTracker',
                    'type' => 'INNER',
                    'conditions' => array(
                        'BugTracker.id = Bug.bug_tracker_id'
                    )
                ),
                array(
                    'table' => 'public.users',
                    'alias' => 'Technician',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Technician.id = BugTracker.technician_id'
                    )
                ),
                array(
                    'table' => 'public.organizations',
                    'alias' => 'Organization',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Organization.id = BugTracker.organization_id'
                    )
                ),
            ),
            'conditions' => $conditions,
            'order' => $order
        );
		$this->set('bugs', $this->Paginator->paginate());
        $this->set_filters();
	}

    public function filter(){
        $this->set_filters();
        $conditions = array(
            $this->Session->read('Auth.User.organization_id').' = ANY(Organization.parent_array)'
        );
        $order = array('Situation.sort'=>'ASC', 'Priority.sort'=>'ASC', 'Bug.created'=>'ASC');

        if(isset($_GET['product']) && $_GET['product'] != ''){
            array_push($conditions, array('Product.id'=>$_GET['product']));
            $this->request->data['Bug']['product'] = $_GET['product'];
        }
        if(isset($_GET['situation']) && $_GET['situation'] != ''){
            array_push($conditions, array('Situation.id'=>$_GET['situation']));
            $this->request->data['Bug']['situation'] = $_GET['situation'];
        } else {
            array_push($conditions, array('NOT' => array('Situation.archived'),));
        }
        if(isset($_GET['locationGroup']) && $_GET['locationGroup'] != ''){
            array_push($conditions, array('LocationGroup.id'=>$_GET['locationGroup']));
            $this->request->data['Bug']['locationGroup'] = $_GET['locationGroup'];
        }
        if(isset($_GET['creator']) && $_GET['creator'] != ''){
            array_push($conditions, array('Bug.created_by'=>$_GET['creator']));
            $this->request->data['Bug']['creator'] = $_GET['creator'];
        }
        if(isset($_GET['technician']) && $_GET['technician'] != ''){
            array_push($conditions, array('BugTracker.technician_array && \''.AppController::arrayToDB($_GET['technician']).'\' '));
            $this->request->data['Bug']['technician'] = $_GET['technician'];
        }
        if(isset($_GET['created_begin']) && $_GET['created_begin'] != ''){
            array_push($conditions, array('Bug.created >= \''.$_GET['created_begin'].' 00:00:00'.'\' '));
            $this->request->data['Bug']['created_begin'] = $_GET['created_begin'];
        }
        if(isset($_GET['created_end']) && $_GET['created_end'] != ''){
            array_push($conditions, array('Bug.created <= \''.$_GET['created_end'].' 23:59:59'.'\' '));
            $this->request->data['Bug']['created_end'] = $_GET['created_end'];
        }
        if(isset($_GET['updated_begin']) && $_GET['updated_begin'] != ''){
            array_push($conditions, array('Bug.updated >= \''.$_GET['updated_begin'].' 00:00:00'.'\' '));
            $this->request->data['Bug']['updated_begin'] = $_GET['updated_begin'];
        }
        if(isset($_GET['updated_end']) && $_GET['updated_end'] != ''){
            array_push($conditions, array('Bug.updated <= \''.$_GET['updated_end'].' 23:59:59'.'\' '));
            $this->request->data['Bug']['updated_end'] = $_GET['updated_end'];
        }
        $this->paginate = array(
            'recursive' => -1,
            'fields' => array(
                'Bug.*',
                'Product.id', 'Product.name',
                'Situation.id', 'Situation.name','Situation.progress_order', 'Situation.color',
                'LocationGroup.id', 'LocationGroup.name',
                'User.id', 'User.username',
                'Product.organization_id',
                'BugTracker.technician_array',
                'Technician.username', 'Technician.id'
            ),
            'joins' => array(
                array(
                    'table' => 'public.users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.id = Bug.created_by'
                    )
                ),
                array(
                    'table' => 'public.products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Product.id = Bug.product_id'
                    )
                ),
                array(
                    'table' => 'public.situations',
                    'alias' => 'Situation',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Situation.id = Bug.situation_id'
                    )
                ),
                array(
                    'table' => 'public.location_groups',
                    'alias' => 'LocationGroup',
                    'type' => 'INNER',
                    'conditions' => array(
                        'LocationGroup.id = Bug.location_group_id'
                    )
                ),
                array(
                    'table' => 'public.priorities',
                    'alias' => 'Priority',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Priority.id = Bug.priority_id'
                    )
                ),
                array(
                    'table' => 'public.bug_tracker',
                    'alias' => 'BugTracker',
                    'type' => 'INNER',
                    'conditions' => array(
                        'BugTracker.id = Bug.bug_tracker_id'
                    )
                ),
                array(
                    'table' => 'public.users',
                    'alias' => 'Technician',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Technician.id = BugTracker.technician_id'
                    )
                ),
                array(
                    'table' => 'public.organizations',
                    'alias' => 'Organization',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Organization.id = BugTracker.organization_id'
                    )
                ),
            ),
            'conditions' => $conditions,
            'order' => $order
        );
        $this->set('bugs', $this->Paginator->paginate());
        $this->render('index');
    }

    public function set_filters(){
        $products = $products = $this->Bug->Product->Organization->getProducts($this->Session->read('Auth.User.organization_id'));
        $situations = $this->Bug->Situation->find('list', array(
            'order'=>array('progress_order'=>'ASC')
        ));
        $locationGroups = $this->Bug->LocationGroup->find('list', array(
            'order'=>array('name'=>'ASC')
        ));
        $creators = $this->Bug->User->find('list', array(
            'order'=>array('username'=>'ASC')
        ));
        $technicians = $creators;

        $this->set(compact('products', 'situations', 'locationGroups', 'creators', 'technicians'));
    }

	public function view($id = null) {
		if (!$this->Bug->exists($id)) {
			throw new NotFoundException(__('Invalid bug'));
		}
		$options = array(
            'recursive' => 0,
            'fields' => array(
                'Bug.*',
                'Product.id', 'Product.name',
                'Situation.id', 'Situation.name',
                'Priority.id', 'Priority.name',
                'LocationGroup.id', 'LocationGroup.name',
                'User.id', 'User.name'
            ),
            'conditions' => array('Bug.' . $this->Bug->primaryKey => $id)
        );
        $bug = $this->Bug->find('first', $options);
        $bugTrackers = $this->Bug->BugTracker->find('all', array(
            'fields' => array(
                'BugTracker.*',
                'CreatedBy.username',
                'Situation.name'
            ),
            'joins' => array(
                array(
                    'table' => 'public.users',
                    'alias' => 'CreatedBy',
                    'type' => 'INNER',
                    'conditions' => array(
                        'CreatedBy.id = BugTracker.created_by',
                    )
                ),
            ),
            'conditions' => array('BugTracker.bug_id'=>$id, 'Situation.progress_order != 1'),
            'order' => array('BugTracker.created' => 'DESC')
        ));
		$this->set('bug', $bug);
		$this->set('bugTrackers', $bugTrackers);
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
                'Priority.id', 'Priority.name',
                'LocationGroup.id', 'LocationGroup.name',
                'User.id', 'User.name'
            ),
            'conditions' => array('Bug.' . $this->Bug->primaryKey => $id)
        );
        $bug = $this->Bug->find('first', $options);
        $this->set('bug', $bug);
        $this->layout = 'printable';
    }

	public function add() {
		if ($this->request->is('post')) {
            $this->request->data['BugTracker']['Bug'] = $this->request->data['Bug'];
            $this->request->data['BugTracker']['situation_id'] = $this->request->data['Bug']['situation_id'];
            $this->request->data['BugTracker']['details'] = $this->request->data['Bug']['details'];
            $product = $this->Bug->Product->find('first', array(
                'conditions'=>array('Product.id'=>$this->request->data['Bug']['product_id'])
            ));
            $this->request->data['BugTracker']['organization_id'] = $product['Product']['organization_id'];

			$this->Bug->create();
			if ($this->Bug->BugTracker->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The bug has been saved.').': '.$this->Bug->id);
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bug could not be saved. Please, try again.'));
			}
		}
        $products = $this->Bug->Product->Organization->getProducts();
		$situations = $this->Bug->Situation->find('list', array(
            'order'=>array('progress_order'=>'ASC')
        ));
		$priorities = $this->Bug->Priority->find('list', array(
            'order'=>array('sort'=>'DESC')
        ));
		$locationGroups = $this->Bug->LocationGroup->find('list', array(
            'order'=>array('name'=>'ASC')
        ));
		$this->set(compact('products', 'situations', 'priorities', 'locationGroups'));
	}

	public function edit($id = null) {
		if (!$this->Bug->exists($id)) {
			throw new NotFoundException(__('Invalid bug'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Bug->save($this->request->data)) {
				$this->Session->setFlash(__('The bug has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bug could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Bug.' . $this->Bug->primaryKey => $id));
			$this->request->data = $this->Bug->find('first', $options);
		}
        $products = $this->Bug->Product->Organization->getProducts();
		$bugTrackers = $this->Bug->BugTracker->find('list');
		$situations = $this->Bug->Situation->find('list');
		$priorities = $this->Bug->Priority->find('list');
		$locationGroups = $this->Bug->LocationGroup->find('list');
		$this->set(compact('products', 'bugTrackers', 'situations', 'priorities', 'locationGroups'));
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
}
