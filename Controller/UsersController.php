<?php
class UsersController extends BugCakeAppController {
    // var $domain = "example.com" 


    var $components = array('Session', 'Auth', 'Cookie');
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'login', 'index', 'logout');

    }
    
    public function index() {
        
    }


    public function add() {
        if ($this->request->is('post')) {
            $username = $this->request->data['User']['username'];
            $email = $this->request->data['User']['email'];
            $duplicateUsername = $this->User->find('count', array(
             'conditions' => array('username' => $username)
             ));
            /* 
             Uncomment these lines if you work in an enteprise-level environment
             so that you limit the users' registration to corporate-only (recommended)
 
             (strpos($email, $domain) ? $emailCheck = 1 : $emailCheck = 0);
 
             Remember to update the if check that follows with the $emailCheck var to make use of it.
             */

            if ($duplicateUsername == 0) {

                $this->User->create();
                $this->request->data['User']['role'] = "user";
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('The user has been saved'), 'info');
                    return $this->redirect(array('controller'=> 'issues', 'action' => 'index'));
                }
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'warning');
            } else {
                if($emailCheck == 0) {
                    $this->Session->setFlash(__('You are not allowed to access this webplace'), 'warning');
                } else {
                    $this->Session->setFlash(__('This username already exists!'), 'warning');
                }
                
            }
        }
    }


    public function login() {
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->Cookie->write('User.username', $this->Session->read('Auth.User.username'));
                $this->Cookie->write('User.role', $this->Session->read('Auth.User.role'));
                $this->Session->setFlash(__('Welcome '.$this->Session->read('Auth.User.username')), 'info');
                $this->redirect(array('controller'=> 'issues', 'action' => 'index'));
            }
            $this->Session->setFlash(__('Invalid username or password, try again'), 'warning');
        }
    }
    

    public function logout() {
        $this->Cookie->destroy();
        $this->Auth->logout();
        $this->Session->setFlash(__('Logged out successfully'), 'info');
        $this->redirect(array('action' => 'login'));
        
    }
}
?>