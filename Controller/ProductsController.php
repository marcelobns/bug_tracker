<?php
App::uses('AppController', 'Controller');

class ProductsController extends AppController {

	public $components = array('Paginator');

	public function index() {
        $this->paginate = array(
            'recursive' => 0,
            'conditions' => array($this->Session->read('Auth.User.organization_id').' = ANY(Organization.parent_array)'),
            'order' => array('Organization.name'=>'ASC', 'Product.name'=>'ASC')
        );
		$this->set('products', $this->Paginator->paginate());
	}

	public function view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		}
		$organizations = $this->Product->Organization->getChildOrganization($this->Session->read('Auth.User.organization_id'));
		$this->set(compact('organizations'));
	}

	public function edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
        $organizations = $this->Product->Organization->getChildOrganization($this->Session->read('Auth.User.organization_id'));
		$this->set(compact('organizations'));
	}

	public function delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('The product has been deleted.'));
		} else {
			$this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function deadline($product_id = null, $technician_array = null){
    //FIXME: REFATORAR!!!
        $hasTechnician = false;
        $conditions = array(
            'product_id'=>$product_id,
        );
        $technician_array = explode(',', $technician_array);
        if(is_array($technician_array) && is_numeric($technician_array[0])){
            $conditions = array(
                'product_id'=>$product_id,
                'technician_array'=>AppController::arrayToDB($technician_array)
            );
            $sql = 'and bt.technician_array && :technician_array';
            $hasTechnician = true;
        }
        $result = $this->Product->query('
                                        SELECT
                                            min(p.deadline) as deadline,
                                            (sum(p.deadline) * count(b.id))::integer as technician_deadline
                                        FROM products p
                                        LEFT JOIN bugs b on p.id = b.product_id
                                        LEFT JOIN bug_tracks bt on b.bug_track_id = bt.id
                                        LEFT JOIN situations s on s.id = bt.situation_id
                                        WHERE s.archived = false and p.id = :product_id '.@$sql ,$conditions);
        if($result[0][0]['deadline'] == null){
            $result = $this->Product->query('
                                        SELECT
                                            min(p.deadline) as deadline,
                                            2 as technician_deadline
                                        FROM products p
                                        WHERE p.id = :product_id ', array('product_id'=>$product_id));
            $hasTechnician = false;
        }
        $deadline = $result[0][0]['deadline'];
        $technician_deadline = round($result[0][0]['technician_deadline']/sizeof($technician_array), 0) <= $result[0][0]['deadline'] ? $result[0][0]['deadline'] : $result[0][0]['technician_deadline']/sizeof($technician_array);
        $result = $hasTechnician ? $technician_deadline : $deadline;
        $weekday = date('D', strtotime('+'.$result.' days'));
        $result = ($weekday == 'Sat' || $weekday == 'Sun') ? date('Y-m-d',strtotime('next monday')) : date('Y-m-d', strtotime('+'.$result.' days'));
        return new CakeResponse(array('body' => json_encode($result)));
    }
}
