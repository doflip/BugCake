<?php
App::uses('ConnectionManager', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class InstallController extends BugCakeAppController {
    var $useTable = false;
    public $components = array('Session', 'Auth');
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('step2', 'complete', 'index');
        if (!file_exists($this->sqlcode)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
    }
    
    public function index() {
        $this->set('sqlcode', $this->sqlcode);
        
        if ($this->request->is('post')) {
            $db = ConnectionManager::getDataSource('default');
            $db->query(file_get_contents($this->sqlcode));
            $this->redirect(array('controller' => 'install', 'action' => 'step2'));
        }
    }
    
    public function step2() {
        if ($this->request->is('post')) {
            $this->loadModel('User');
            $this->User->create();
            $this->request->data['User']['role'] = "admin";
            $this->request->data['User']['password'] = AuthComponent::password($this->request->data['User']['password']);
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'), 'info');
                $this->redirect(array('controller' => 'install', 'action' => 'complete'));
            }
            $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'warning');
        }
        
    }
    
    public function complete() {
        if ($this->request->is('post')) {
            if (unlink($this->sqlcode)) {
                $this->Session->setFlash(__('Installation Completed !!! Thank you for choosing us.'), 'info');
            } else {
                $this->Session->setFlash(__('Please delete manually the file located at: '.$this->sqlcode), 'warning');
            }
        }
        
    }
}
?>