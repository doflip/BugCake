<?php

class BugCakeAppController extends AppController {
	public $uses = array('DefaultModel', 'Issue');
	public $components = array('Cookie');
	public function beforeFilter() {
		parent::beforeFilter();

		$this->Cookie->name = 'baker_id';
        $this->Cookie->time = 600;  // or '1 hour'
        $this->Cookie->path = '/';
        $this->Cookie->domain = 'bugcake.com';
        $this->Cookie->secure = false;  // i.e. only sent if using secure HTTPS
        $this->Cookie->key = 'qSI232qs*&sfytf65r6fc9-+!@#HKis~#^';
        $this->Cookie->httpOnly = false;

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
}

?>