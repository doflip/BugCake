<?php

class BugCakeAppController extends AppController {

	public $components = array('Cookie', 'Session');
	public function beforeFilter() {
		parent::beforeFilter();
		
		if (!file_exists(APP.'Plugin'.DS.'BugCake'.DS.'SQLTABLES.sql')) {
			$this->loadModel('Setting');
			$this->loadModel('Issue');
			$this->Cookie->name = $this->_loadsetting('name');
			$this->Cookie->time = intval($this->_loadsetting('time'));
			$this->Cookie->path = $this->_loadsetting('path');
			$this->Cookie->domain = $this->_loadsetting('domain');
			$this->Cookie->secure = $this->_loadsetting('secure');
			$this->Cookie->key = $this->_loadsetting('key');
			$this->Cookie->httpOnly = $this->_loadsetting('httpOnly');
	
			$options = array(
			'conditions' => array(
			    'Issue.comment_id =' => '0',
			    'OR' => array(
				'Issue.tags LIKE' => '%open%'
				)
			    )
			);
			$this->set('OPEN_ISSUES', $this->Issue->find('count',$options));
			if ($this->Session->read('Auth.User.username') != null || $this->Cookie->read('User.username') != null) {
				$this->username = $this->Session->read('Auth.User.username');
				$this->role = $this->Session->read('Auth.User.role');
				if ($this->username == null) {$this->username = $this->Cookie->read('User.username');}
				if ($this->role == null) {$this->username = $this->Cookie->read('User.role');}
				$this->set('user', $this->username);
				$this->set('ROLE', $this->role);
			} else {
				if (!($this->params['controller'] == 'users')){
					$this->redirect(array('controller' => 'users', 'action' => 'login'));
				}
				$this->set('ROLE', null);
				
			}
		} else {
			
			$this->layout = "install";
			$this->sqlcode = APP.'Plugin'.DS.'BugCake'.DS.'SQLTABLES.sql';
			
		}
	}

	public function _loadsetting($name) {
		$data = $this->Setting->find('first', array('conditions' => array('Setting.name' => $name)));
		$data = $data['Setting']['value'];
		if ($data == "false") {  
			return false;
		} elseif ($data == "true") {
			return true;
		} else {
			return $data;
		}

	}
}

?>
