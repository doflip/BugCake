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
			$this->Cookie->key = $this->_loadsetting('key');
			$this->Cookie->secure = filter_var($this->_loadsetting('secure'), FILTER_VALIDATE_BOOLEAN);
			$this->Cookie->httpOnly = filter_var($this->_loadsetting('httpOnly'), FILTER_VALIDATE_BOOLEAN);
	
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
				if ($this->role == null) {$this->role = $this->Cookie->read('User.role');}
				$this->set('user', $this->username);
				$this->set('ROLE', $this->role);
				if ($this->_loadsetting('admin') == 'true' && $this->role != 'admin') {
					if (!($this->params['controller'] == 'users')){
						$this->redirect(array('controller' => 'users', 'action' => 'index'));
				        }
				}
			} else {
				$this->set('user', 'User Actions');
				$this->set('ROLE', null);
				if (!($this->params['controller'] == 'users')){
					$this->redirect(array('controller' => 'users', 'action' => 'login'));
				}
				
			}
		} else {
			
			$this->layout = "install";
			$this->sqlcode = APP.'Plugin'.DS.'BugCake'.DS.'SQLTABLES.sql';
		}
	}

	public function _loadsetting($name) {
		$data = $this->Setting->find('first', array('conditions' => array('Setting.name' => $name)));
		$data = $data['Setting']['value'];
		return $data;
		/*
		if ($data == "false") {
			return false;
		} elseif ($data == "true") {
			return true;
		} else {
			return $data;
		}
		*/

	}
}

?>
