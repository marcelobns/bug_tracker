<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {

	public $components = array('Paginator');

	public function index() {
        $conditions = array(
            $this->Session->read('Auth.User.organization_id').' = ANY(Organization.parent_array)'
        );
        if(@$_GET['q']){
            $q = is_numeric($_GET['q']) ? $_GET['q'] : '%'.$_GET['q'].'%';
            $conditions = array(
                $this->Session->read('Auth.User.organization_id').' = ANY(Organization.parent_array)',
                'OR'=>array(
                    'User.id::text ilike \''.$q.'\'',
                    'User.name::text ilike \''.$q.'\'',
                    'User.username::text ilike \''.$q.'\'',
                )
            );
        }
        $this->paginate = array(
            'fields' => array(
                'User.id',
                'User.name',
                'User.last_signin',
                'Organization.name',
                'Role.name'
            ),
            'conditions' => $conditions,
            'order' => array('name'=>'ASC')
        );
		$this->set('users', $this->Paginator->paginate());
	}

	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

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

    public function login(){
        if ($this->request->is('post')) {
            $user = $this->User->find('first', array(
					'recursive'=> 1,
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

                $user['User']['Role'] = $user['Role'];
                $user['User']['Organization'] = $user['Organization'];
                $this->Auth->login($user['User']);

                if($this->User->save($signin)){
                    $this->redirect($this->Auth->redirectUrl());
                }
            }else{
                $this->Session->setFlash(__('Invalid! username or password.'), 'default', array('class'=>'alert-danger'));
            }
        }
        $this->layout = 'login';
    }

    public function logout(){
        $this->Session->destroy();
        $this->redirect($this->Auth->logout());
    }

	public function reset_pass($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		$user = array('User'=>array(
			'id'=>$id,
			'password'=>Security::hash('123', 'md5', false)
			));

		if ($this->User->save($user)) {
			$this->Session->setFlash(__('The password has been reseted.'));
		} else {
			$this->Session->setFlash(__('The password could not be reseted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
