<?php
class AdminController extends BugCakeAppController {
	public $helpers = array('Html', 'Form', 'Text');
	public $components = array('Session', 'Cookie', 'Paginator');
	public $uses = array('Setting', 'User');
	public function beforeFilter() {
		parent::beforeFilter();
		$this->layout = "admin";
		
	}
	
	public function index() {
		
		
	}
    
	public function cookies(){
		
		$this->set('cookie_set', $this->Cookie);
		if ($this->request->is('post')) {
			//debug($this->request->data);
			foreach (array_keys($this->request->data['Setting']) as $setting) {
				$this->Setting->clear();
				$this->Setting->updateAll(
							  array(
								'value' => "'".$this->request->data['Setting'][$setting]."'"
								),
							  array('Setting.name =' => $setting)
							  );
			
			}
			
			// Save secure and httpOnly 
			
			$this->redirect(array('action' => 'cookies'));
			
			
		}
	}
	
	public function access() {
		
	}
	
	public function users() {
		$this->Paginator->settings = array('limit' => 6, 'order' => array('User.id' => 'desc'));
		$users = $this->Paginator->paginate('User');
		$this->set('users', $users);
		
	}
	
	public function terms() {
		
	}

}
?>