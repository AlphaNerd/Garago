<?php

class UsersController extends AppController {

	var $uses = array('User','SocialProfile');
	
	public $paginate = array(
        'limit' => 25,
        'conditions' => array('status' => '1'),
    	'order' => array('User.username' => 'asc' ) 
    );
	public $components = array('Hybridauth');
	
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login','add','social_login','social_endpoint'); 
		
    }

	public function login() {

		//if already logged-in, redirect
		if($this->Session->check('Auth.User')){
			$this->redirect(array('action' => 'index'));	

		}
		
		// if we get the post information, try to authenticate
		if ($this->request->is('post')) {
		
			if ($this->Auth->login()) {
			
				$status = $this->Auth->user('status');
				
				if($status != 0){
					$this->Session->write("username",$this->Auth->user('username'));
					$this->Session->write("id",$this->Auth->user('id'));
					$this->Session->write("role",$this->Auth->user('role'));
					$this->Session->setFlash(__('Welcome, '. $this->Auth->user('username')));
					//$this->redirect("http://127.0.0.1/sou_project?id=".md5(3));

				}else{
					// this is a deleted user
					$this->Auth->logout();
					$this->Session->setFlash(__('Invalid username or password - This user appears to be deleted...'));
				}
			} else {
				$this->Session->setFlash(__('Invalid username or password'));
			}
		} 
	}

	public function logout() {
		SessionComponent::delete('username');
		
		$this->Hybridauth->logout();
		$this->redirect($this->Auth->logout());

	}
	
	/* social login functionality */
	public function social_login($provider) {
		if( $this->Hybridauth->connect($provider) ){
			$this->_successfulHybridauth($provider,$this->Hybridauth->user_profile);
        }else{
            // error
			$this->Session->setFlash($this->Hybridauth->error);
			$this->redirect($this->Auth->loginAction);
        }
	}

	public function social_endpoint($provider = null) {
		$this->Hybridauth->processEndpoint();
	}
	
	private function _successfulHybridauth($provider, $incomingProfile){

		// #1 - check if user already authenticated using this provider before
		$this->SocialProfile->recursive = -1;
		$existingProfile = $this->SocialProfile->find('first', array(
			'conditions' => array('social_network_id' => $incomingProfile['SocialProfile']['social_network_id'], 'social_network_name' => $provider)
		));
		
		if ($existingProfile) {
			// #2 - if an existing profile is available, then we set the user as connected and log them in
			$user = $this->User->find('first', array(
				'conditions' => array('id' => $existingProfile['SocialProfile']['user_id'])
			));
			
			$this->_doSocialLogin($user,true);
		} else {
			
			// New profile.
			if ($this->Auth->loggedIn()) {
				// user is already logged-in , attach profile to logged in user.
				// create social profile linked to current user
				$incomingProfile['SocialProfile']['user_id'] = $this->Auth->user('id');
				$this->SocialProfile->save($incomingProfile);
				
				$this->Session->setFlash('Your ' . $incomingProfile['SocialProfile']['social_network_name'] . ' account is now linked to your account.');
				$this->redirect($this->Auth->redirectUrl());

			} else {
				// no-one logged and no profile, must be a registration.
				$user = $this->User->createFromSocialProfile($incomingProfile);
				$incomingProfile['SocialProfile']['user_id'] = $user['User']['id'];
				$this->SocialProfile->save($incomingProfile);

				// log in with the newly created user
				$this->_doSocialLogin($user);
			}
		}	
	}
	
	private function _doSocialLogin($user, $returning = false) {

		if ($this->Auth->login($user['User'])) {
			if($returning){
				$this->Session->setFlash(__('Welcome back, '. $this->Auth->user('username')));
			} else {
				$this->Session->setFlash(__('Welcome to our community, '. $this->Auth->user('username')));
			}
			$this->redirect($this->Auth->loginRedirect);
			
		} else {
			$this->Session->setFlash(__('Unknown Error could not verify the user: '. $this->Auth->user('username')));
		}
	}

    public function index() {
		$this->paginate = array(
			'limit' => 10,
			'order' => array('User.username' => 'asc' ),
			'conditions' => array('User.status' => 1),
		);
		$users = $this->paginate('User');
		$this->set(compact('users'));
    }


    public function add() {
        if ($this->request->is('post')) {






//function API($this->request_>data)
        	//print_r($this->request->data);
        	//die();
				
/*$users=array(
	'username'=>$this->request->data['last_name']."_".$this->request->data['first_name'],
	'password'=>md5($this->request->data['password']),
	'email'=>$this->request->data['email']);*/
			$this->User->create();
			$this->request->data['User']['username']=$this->request->data['User']['username']."_".$this->request->data['User']['first_name'];
	
			if ($this->User->save($this->request->data)) {
			
				$this->Session->setFlash(__('The user has been created'));
				$this->redirect(array('controller'=>'users','action' => 'login'));
			} else {
				$this->Session->setFlash(__('The user could not be created. Please, try again.'));
			}	
        }
    }

    public function edit($id = null) {

		    if (!$id) {
				$this->Session->setFlash('Please provide a user id');
				$this->redirect(array('action'=>'index'));
			}

			$user = $this->User->findById($id);
			if (!$user) {
				$this->Session->setFlash('Invalid User ID Provided');
				$this->redirect(array('action'=>'index'));
			}

			if ($this->request->is('post') || $this->request->is('put')) {
				$this->User->id = $id;
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been updated'));
					$this->redirect(array('action' => 'edit', $id));
				}else{
					$this->Session->setFlash(__('Unable to update your user.'));
				}
			}

			if (!$this->request->data) {
				$this->request->data = $user;
			}
    }

    public function delete($id = null) {
		
		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}
		
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
			$this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 0)) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
	
	public function activate($id = null) {
		
		if (!$id) {
			$this->Session->setFlash('Please provide a user id');
			$this->redirect(array('action'=>'index'));
		}
		
        $this->User->id = $id;
        if (!$this->User->exists()) {
            $this->Session->setFlash('Invalid user id provided');
			$this->redirect(array('action'=>'index'));
        }
        if ($this->User->saveField('status', 1)) {
            $this->Session->setFlash(__('User re-activated'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not re-activated'));
        $this->redirect(array('action' => 'index'));
    }

}

?>