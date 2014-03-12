<?php

class BugCakeAppController extends AppController {
	public $uses = array('Setting', 'Issue');
	public $components = array('Cookie');

	public function beforeFilter() {
		parent::beforeFilter();
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
	}

	public function _loadsetting($name) {
		$data = $this->Setting->find('first', array('conditions' => array('Setting.name' => $name)))['Setting']['value'];
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