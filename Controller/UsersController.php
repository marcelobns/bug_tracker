<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

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
		$this->User->recursive = 0;
        $this->paginate = array(
            'fields' => array(
                'User.id',
                'User.name',
                'User.username',
                'User.last_signin',
                'Organization.*',
                'Role.*'
            ),
            'conditions' => array(
                $this->Session->read('Auth.User.organization_id').' = ANY(Organization.parent_array)'
            ),
            'order' => array('name'=>'ASC')
        );
		$this->set('users', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
            $this->request->data['User']['password'] = Security::hash($this->data['User']['password'], 'md5', false);
            $this->User->create();

			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$roles = $this->User->Role->find('list',
            array(
                'conditions' => 'sort >= ' . $this->Session->read('Auth.User.Role.sort'),
                'order' => array('sort'=>'DESC')
            )
        );
		$organizations = $this->User->Organization->getChildOrganization($this->Session->read('Auth.User.organization_id'));
		$this->set(compact('roles', 'organizations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
        $isUser = $this->Session->read('Auth.User.id') == $id ? true : false;

		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is(array('post', 'put'))) {
            if($isUser) {
                $options = array(
                    'conditions' => array(
                        'User.' . $this->User->primaryKey => $id,
                        'User.password' => Security::hash($this->data['User']['confirm_password'], 'md5', false)
                    )
                );
                $checkUser = $this->User->find('first', $options);
                if($checkUser){
                    if(isset($this->request->data['User']['password'])){
                        $this->request->data['User']['password'] = Security::hash($this->data['User']['password'], 'md5', false);
                    };
                    if ($this->User->save($this->request->data)) {
                        $this->Session->setFlash(__('The user has been saved.'));
                        return $this->redirect(array('action' => 'logout'));
                    } else {
                        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                    }
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                }
            } else {
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                }
            }
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
            $role_sort = $this->request->data['Role']['sort'];
		}
        $roles = $this->User->Role->find('list',
            array(
                'conditions' => 'sort >= ' . $this->Session->read('Auth.User.Role.sort'),
                'order' => array('sort'=>'DESC')
            )
        );
        $organizations = $this->User->Organization->getChildOrganization($this->Session->read('Auth.User.organization_id'));
		$this->set(compact('roles', 'organizations', 'isUser', 'role_sort'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('The user has been deleted.'));
		} else {
			$this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

    public function signin(){
        if ($this->request->is('post')) {
            $user = $this->User->find('first', array(
                    'fields' => array(
                        'User.*',
                        'Role.*',
                        'Organization.*'
                    ),
                    'conditions' => array(
                        'User.username' => $this->data['User']['username'],
                        'User.password' => Security::hash($this->data['User']['password'], 'md5', false)
                    )
                )
            );
            if($user != false){
                unset($user['User']['password']);
                $signin = array(
                    'id' => $user['User']['id'],
                    'last_signin' => date('Y-m-d H:i:s'),
                    'updated_by' => $user['User']['id']
                );
                if($this->User->save($signin)){
                    $user['User']['Role'] = $user['Role'];
                    $user['User']['Organization'] = $user['Organization'];
                    $this->Auth->login($user['User']);
                    $this->redirect($this->Auth->redirectUrl());
                }
            }else{
                $this->Session->setFlash(__('Invalid! username or password.'), 'default', array('class'=>'alert-danger'));
            }
        }
        $this->layout = 'signin';
    }

    public function logout(){
        $this->Session->destroy();
        $this->redirect($this->Auth->logout());
    }
}
