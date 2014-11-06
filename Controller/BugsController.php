<?php
App::uses('AppController', 'Controller');
/**
 * Bugs Controller
 *
 * @property Bug $Bug
 * @property PaginatorComponent $Paginator
 */
class BugsController extends AppController {

	public $components = array('Paginator');

	public function index() {
        $role_clause = $this->Session->read('Auth.User.Role.sort') <= 2 ? '' : 'BugTracker.technician_array is null';
        $conditions = array(
            'Situation.archived'=>false,
            'OR'=>array(
                $this->Session->read('Auth.User.id').' = ANY(BugTracker.technician_array)',
                array(
                    $this->Session->read('Auth.User.organization_id').' = ANY(Organization.parent_array)',
                    $role_clause
                )));
        if(@$_GET['q']){
            $q = is_numeric($_GET['q']) ? $_GET['q'] : '%'.$_GET['q'].'%';
            $conditions = array(
                'Bug.id::text ilike \''.$q.'\'',
                'OR'=>array(
                    $this->Session->read('Auth.User.id').' = ANY(BugTracker.technician_array)',
                    array(
                        $this->Session->read('Auth.User.organization_id').' = ANY(Organization.parent_array)'
                    )));
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
        $this->set_filters();
	}

    public function filter(){
        $this->set_filters();
        $role_clause = $this->Session->read('Auth.User.Role.sort') <= 2 ? '' : 'BugTracker.technician_array is null';
        $conditions = array(
            $this->Session->read('Auth.User.organization_id').' = ANY(Organization.parent_array)',
            $role_clause
        );
        if(isset($_GET['product']) && $_GET['product'] != ''){
            array_push($conditions, array('Product.id'=>$_GET['product']));
            $this->request->data['Bug']['product'] = $_GET['product'];
        }
        if(isset($_GET['situation']) && $_GET['situation'] != ''){
            array_push($conditions, array('Situation.id'=>$_GET['situation']));
            $this->request->data['Bug']['situation'] = $_GET['situation'];
        }
        if(isset($_GET['origin']) && $_GET['origin'] != ''){
            array_push($conditions, array('Origin.id'=>$_GET['origin']));
            $this->request->data['Bug']['origin'] = $_GET['origin'];
        }
        if(isset($_GET['creator']) && $_GET['creator'] != ''){
            array_push($conditions, array('Bug.created_by'=>$_GET['creator']));
            $this->request->data['Bug']['creator'] = $_GET['creator'];
        }
        if(isset($_GET['technician']) && $_GET['technician'] != ''){
            array_push($conditions, array('BugTracker.technician_array && \''.AppController::arrayToDB($_GET['technician']).'\' '));
            $this->request->data['Bug']['technician'] = $_GET['technician'];
        }
        if(isset($_GET['deadline_begin']) && $_GET['deadline_begin'] != ''){
            array_push($conditions, array('Bug.created >= \''.$_GET['deadline_begin'].' 00:00:00'.'\' '));
            $this->request->data['Bug']['deadline_begin'] = $_GET['deadline_begin'];
        }
        if(isset($_GET['deadline_end']) && $_GET['deadline_end'] != ''){
            array_push($conditions, array('Bug.created <= \''.$_GET['deadline_end'].' 23:59:59'.'\' '));
            $this->request->data['Bug']['deadline_end'] = $_GET['deadline_end'];
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
        $this->render('index');
    }

    public function set_filters(){
        $products = $products = $this->Bug->Product->Organization->getProducts($this->Session->read('Auth.User.organization_id'));
        $situations = $this->Bug->Situation->find('list', array(
            'order'=>array('progress_order'=>'ASC')
        ));
        $origins = $this->Bug->Origin->getChildOrganization($this->Session->read('Auth.User.organization_id'));
        $technicians = $this->Bug->Creator->find('list', array(
            'joins'=>array(
                array(
                    'alias'=>'Organization',
                    'table'=>'organizations',
                    'conditions'=>array(
                        'Organization.id = Creator.organization_id',
                    )
                ),
            ),
            'conditions'=>array(
                $this->Session->read('Auth.User.organization_id').' = ANY(Organization.parent_array)',
            ),
            'order'=>array('username'=>'ASC')
        ));
        $this->set(compact('products', 'situations', 'origins', 'technicians'));
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
        $bugTrackers = $this->Bug->BugTracker->find('all', array(
            'fields' => array(
                'BugTracker.*',
                'Creator.username',
                'array(SELECT t.username FROM users t where t.id = any(BugTracker.technician_array)) as "Technician__array"',
                'Situation.name'
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
                'Origin.id', 'Origin.name',
                'Creator.id', 'Creator.name'
            ),
            'conditions' => array('Bug.' . $this->Bug->primaryKey => $id)
        );
        $bug = $this->Bug->find('first', $options);
        $this->set('bug', $bug);
        $this->layout = 'printable';
    }

	public function add(){
		if ($this->request->is('post')) {
            $this->request->data['BugTracker']['Bug'] = $this->request->data['Bug'];
            $this->request->data['BugTracker']['details'] = $this->request->data['Bug']['details'];
            $this->request->data['BugTracker']['technician_array'] = AppController::arrayToDB($this->request->data['Bug']['technician_id']);
            $product = $this->Bug->Product->find('first', array(
                'fields'=>array('Product.organization_id'),
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
            $this->request->data['BugTracker']['Bug'] = $this->request->data['Bug'];
            $this->request->data['BugTracker']['details'] = $this->request->data['Bug']['details'];
            $this->request->data['BugTracker']['technician_array'] = AppController::arrayToDB($this->request->data['Bug']['technician_id']);
            $product = $this->Bug->Product->find('first', array(
                'fields'=>array('Product.organization_id'),
                'conditions'=>array('Product.id'=>$this->request->data['Bug']['product_id'])
            ));
            $this->request->data['BugTracker']['organization_id'] = $product['Product']['organization_id'];
			if ($this->Bug->BugTracker->saveAll($this->request->data)) {
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
            $this->request->data['Bug']['technician_id'] = AppController::arrayFromDB($this->request->data['BugTracker']['technician_array']);
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
}
