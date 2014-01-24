<?php
App::uses('ConnectionManager', 'Model');
class InstallController extends BugCakeAppController {
    var $useTable = false;
    public $components = array('Session');
    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = "install";
        $this->sqlcode = APP.'Plugin'.DS.'BugCake'.DS.'SQLTABLES.sql';
        if (!file_exists($this->sqlcode)) {
            $this->redirect(array('controller' => 'issues', 'action' => 'index'));
        }
    }
    
    public function index() {
        $this->_step1();
        
    }
    
    public function _step1() {
        $db = ConnectionManager::getDataSource('default');
        $db->query(file_get_contents($this->sqlcode));
        //$this->Session->setFlash('<pre>'.file_get_contents($this->sqlcode).'</pre>', 'info');
        echo '<div class="ui segment"><div class="ui top attached label">SQL</div><pre>';
        echo file_get_contents($this->sqlcode);
        echo '</pre></div>';
    }
    
    public function step2() {
        $this->loadModel('User');
        $this->User->create();
        $this->request->data['Install']['role'] = "user";
        if ($this->User->save($this->request->data)) {
            $this->Session->setFlash(__('The user has been saved'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
        
    }
    
    public function complete() {
        if (unlink($this->sqlcode)) {
        }
    }
}
?>