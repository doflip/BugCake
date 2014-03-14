<?php
class IssuesController extends BugCakeAppController {
    public $helpers = array('Html', 'Form', 'Text');
    public $components = array('Paginator', 'Session', 'Cookie', 'RequestHandler');
    
    public function beforeFilter() {
        parent::beforeFilter();

        // if you want only the admins to be able to access the issues then uncomment the following line , 
        // and comment out the next if
        // if ($this->Session->read('Auth.User.role') == 'admin' || $this->Cookie->read('User.role') == 'admin') {

        
    }
    
    public function tags_add($id=null, $data=null){
        if ($this->request->is('get')) {
           $this->redirect(array('action' => 'view', $id));
        }
        if ($this->role == 'admin') {
            $post = $this->Issue->findById($id);
            $post['Issue']['tags'] = $post['Issue']['tags'].$this->request['data']['Issue']['tag'].', ';
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
            $post['Issue']['tags'] = str_replace($data.', ', '', $post['Issue']['tags']);
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
                    'Issue.tags LIKE' => '%'. $keywords . '%'
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
                array('limit' => 20, 'order' => 'Issue.created DESC', 'conditions' => array('Issue.comment_id =' => '0'))
            );

            return $this->set(compact('posts'));
        }
        if ($tags == null) {
            $this->Paginator->settings = array('conditions' => array('Issue.comment_id =' => '0'),
                                               'limit' => 6, 'order' => array('Issue.id' => 'desc'));
        } else {
            $this->Paginator->settings = array('conditions' => array('Issue.comment_id =' => '0',
                                                                     'Issue.tags LIKE' => '%'. $tags . '%'),
                                               'limit' => 6, 'order' => array('Issue.id' => 'desc'));
        }

        $data = $this->Paginator->paginate('Issue');
        $this->set('posts', $data);
    }

    public function view($id=null) {
        $post = $this->Issue->findById($id);
        if (!$post) { $this->redirect(array('action' => 'index'));}
        
        $this->Paginator->settings = array('conditions' => array('Issue.comment_id =' => $id),
                                               'limit' => 6, 'order' => array('Issue.id' => 'desc'));
        $comments = $this->Paginator->paginate('Issue');
        $this->set(compact('post', 'comments'));
        
    }
    
    
    public function add() {
        
        if ($this->request->is('post')) {
            $this->Issue->create();
            $this->Issue->set("author", $this->username);
            $this->Issue->set("tags", 'open, ');
            //var_dump($this->Issue);
            if ($this->Issue->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been saved.'), 'info');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to add your post.'), 'warning');
            }
        }
        
    }
    public function edit($id = null) {
        
        $post = $this->Issue->findById($id);
        if ($post['Issue']['author'] == $this->username) {

            $this->set('post', $post);
            if (!$post) {
                $this->redirect(array('action' => 'index'));
            }
            if ($this->request->is('post') || $this->request->is('put')) {
                $this->Issue->id = $id;
                if ($this->Issue->save($this->request->data)) {
                    $this->Session->setFlash(__('Your post has been updated.'), 'info');
                    $this->redirect(array('action' => 'index'));
                }
                $this->Session->setFlash(__('Unable to update your post.'), 'warning');
            }
            if (!$this->request->data) {
                $this->request->data = $post;
            }
            
        } else {
            $this->redirect(array('action' => 'view', $id));
        }
    }
    
    public function delete($id) {
        
        
        if ($this->request->is('get')) {
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Issue->findById($id);
        if ($post['Issue']['author'] == $this->username) {
            if ($this->Issue->delete($id)) {
                $this->Session->setFlash(__('The post with id: %s has been deleted.', h($id)), 'info');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to delete the post with id: %s.', h($id)), 'warning');
            }
            
        }
        
    }
    
    public function comment($post_id = null) {
        if ($this->request->is('post')) {
            $form = $this->Issue->read(null, $post_id);
            $form['Issue']['answers'] = $form['Issue']['answers'] + 1;
            $this->Issue->create();
            $this->Issue->save($form);   
            $this->Issue->create();
            $this->Issue->set(array('comment_id'=>$post_id));
            $this->Issue->set("author", $this->username);
            $this->Issue->set("title", "comment");
            if ($this->Issue->save($this->request->data)) {
                $this->Session->setFlash('Your comment has been added.', 'info');
                //$this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your comment.', 'warning');
            }
            $this->redirect(array('action' => 'view', $post_id));
        }
    }
}
?>