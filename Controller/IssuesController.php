<?php
class IssuesController extends BugCakeAppController {
    public $helpers = array('Html', 'Form', 'Text');
    public $components = array('Paginator', 'Session', 'Cookie', 'RequestHandler');
    public $uses = array('Comment');
    public function beforeFilter() {
        parent::beforeFilter();

        /*
        	If you want only the admins to be able to access the issues then uncomment the following lines and
            add inside the loop the logic to handle on-admins trying to browse issues.

        	if ($this->Session->read('Auth.User.role') == 'admin' || $this->Cookie->read('User.role') == 'admin') {
        		{logic when non-admins try to browse an isse}
        	}
		*/
        
    }
    
    public function tags_add($id=null, $data=null){
        if ($this->request->is('get')) {
           $this->redirect(array('action' => 'view', $id));
        }
        if ($this->role == 'admin') {
            $post = $this->Issue->findById($id);
            $post['Issue']['tags'] = $post['Issue']['tags'].$this->request->data['Issue']['tag'].', ';
            $this->Issue->create();
            $this->Issue->save($post);

        }
        $this->redirect(array('controller' => 'issues', 'action' => 'view', $id));


    }
    public function tags_delete($id=null, $data=null){
        if ($this->request->is('get')) {
           $this->redirect(array('action' => 'view', $id));
        }
        if ($this->Session->read('Auth.User.role') == 'admin' || $this->Cookie->read('User.role') == 'admin') {
            $post = $this->Issue->findById($id);
            $post['Issue']['tags'] = preg_replace('/'.$data.', /', '', $post['Issue']['tags'], 1);
            $this->Issue->create();
            $this->Issue->save($post);
        }
        $this->redirect(array('controller' => 'issues', 'action' => 'view', $id));

    }


    public function search() {

        if ($this->request->is('post')) {
            $keywords = $this->request['data']['Issue']['search'];
            $options = array(
            'conditions' => array(
            	'Issue.comment_id =' => '0',
                'OR' => array(
                    'Issue.body LIKE' => '%'. $keywords . '%',
                    'Issue.title LIKE' => '%'. $keywords . '%',
                    'Issue.tags LIKE' => '%'. $keywords . '%',
                    )
                )
            );
            $this->set('posts', $this->Issue->find('all', $options));
        }
    }
    
    
    public function index($tags=null) {
        if ($this->RequestHandler->isRss() ) {
            $posts = $this->Issue->find(
                'all',
                array('limit' => 20, 'order' => 'Issue.created DESC')
            );

            return $this->set(compact('posts'));
        }
        if ($tags == null) {
            $this->Paginator->settings = array('conditions' => array('limit' => 10, 'order' => array('Issue.id' => 'desc'));
        } else {
            $this->Paginator->settings = array('conditions' => array('Issue.tags LIKE' => '%'. $tags . '%'),
                                               'limit' => 10, 'order' => array('Issue.id' => 'desc'));
        }

        $data = $this->Paginator->paginate('Issue');
        $this->set('posts', $data);
    }

    public function view($id=null) {
        
    	$this->Issue->recursive = 1;
		$post = $this->Issue->findById($id);
		
        $this->Paginator->settings = array(
        	'conditions' => array('Issue.id =' => $id),
            'limit' => 6,
             );
        $comments = $this->Paginator->paginate('Issue');
        $comments = $comments[0]['Comment'];
        $this->set(compact('post', 'comments'));
        
    }
    
    
    public function add() {
        
        if ($this->request->is('post')) {
            $this->Issue->create();
            $this->Issue->set("author", $this->username);
            $this->Issue->set("tags", 'open, ');

            if ($this->Issue->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been saved.'), 'info');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to add your post.'), 'warning');
            }
        }
        
    }
    public function edit($id = null, $comment_id = null) {
         
        $post = $this->Issue->findById($id);
        if (!$post) {
            $this->redirect(array('action' => 'index'));
        }

        if ($comment_id == null){
    		if ($post['Issue']['author'] == $this->username) {

	            $this->set(compact('post'));
	            $this->set('comment', false);
	            if ($this->request->is('post') || $this->request->is('put')) {
	            	$this->Issue->id = $id;
	                if ($this->Issue->save($this->request->data)) {
	                    $this->Session->setFlash(__('Your post has been updated.'), 'info');
	                    $this->redirect(array('action' => 'view', $id));
	                }
	                $this->Session->setFlash(__('Unable to update your post.'), 'warning');
	                
	            }

	            if (!$this->request->data) {
	                $this->request->data = $post;
	            }
	            
	        } else {
	            $this->redirect(array('action' => 'view', $id));
	        }
        } else {
        	foreach($post['Comment'] as $comment) {
	    		if ($comment['id'] == $comment_id && $comment['author'] == $this->username) {
	    			$this->set(compact('post', 'comment'));
		    		if ($this->request->is('post') || $this->request->is('put')) {
		            	$this->Comment->id = $comment_id;
		                if ($this->Comment->save($this->request->data)) {
		                    $this->Session->setFlash(__('Your post has been updated.'), 'info');
		                    $this->redirect(array('action' => 'view', $id));
		                }
		                $this->Session->setFlash(__('Unable to update your post.'), 'warning');
		                
		            }
		        }
		    }
        }
   
    }
    
    public function delete($id, $comment_id = null) {
        
        
        if ($this->request->is('get')) {
            $this->redirect(array('action' => 'index'));
        }
	    $post = $this->Issue->findById($id);
	    debug($post);
	    if ($comment_id == null){
		    if ($post['Issue']['author'] == $this->username) {
		        if ($this->Issue->delete($id)) {
		            $this->Session->setFlash(__('The post with id: %s has been deleted.', h($id)), 'info');
		            $this->redirect(array('action' => 'index'));
		        } else {
		            $this->Session->setFlash(__('Unable to delete the post with id: %s.', h($id)), 'warning');
		        }
		        
		    }
	    } else {
	    	foreach($post['Comment'] as $comment) {
	    		if ($comment['id'] == $comment_id && $comment['author'] == $this->username) {
	    			if ($this->Comment->delete($comment_id)) {
		    			$this->Session->setFlash(__('The comment with id: %s has been deleted.', h($id)), 'info');
			            $this->redirect(array('action' => 'view', $id));
			        } else {
			            $this->Session->setFlash(__('Unable to delete the post with id: %s.', h($id)), 'warning');
			        }
	    		}
	    	}
	    }
        
    }
    
    public function comment($post_id = null) {
        if ($this->request->is('post')) {
            $form = $this->Issue->read(null, $post_id);
            $form['Issue']['answers'] = $form['Issue']['answers'] + 1;
            $this->Issue->create();
            $this->Issue->save($form);   

            $this->Comment->create();
            $this->Comment->set('issue_id', $post_id);
            $this->Comment->set("author", $this->username);
            
            if ($this->Comment->save($this->request->data)) {
                $this->Session->setFlash('Your comment has been added.', 'info');
            } else {
                $this->Session->setFlash('Unable to add your comment.', 'warning');
            }
            $this->redirect(array('action' => 'view', $post_id));
        }
    }

    /*
     * Description: auto-magic function. Just automatically close an opened issue,without having to replace manually the "open"/"close" tag.
        public function close($id = null) {
        	if ($this->request->is('post')) {
        		$this->Issue->id = $id;
        		$tags = $this->Issue->tags;
        		$tags = str_replace("open", "close", $tags);
        		if ($this->Issue->saveField('tags', $tags)) {
        			$this->Session->setFlash('Issue successfully closed.', 'info');
        			$this->redirect(array('action' => 'view', $id));
        		} else {
        			$this->Session->setFlash('Something went wrong, try again later.', 'warning');
        			$this->redirect(array('action' => 'view', $id));
        		}

        	}
        }
    */

}
?>