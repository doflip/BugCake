<?php
class AdminController extends BugCakeAppController {
	public $components = array('Session', 'Cookie');
	public $uses = array('Setting', 'User');
	
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
			$this->redirect('cookies');
			
		}
	}
	
	public function access() {
		
	}
	
	public function categories() {
		
	}

}
?>