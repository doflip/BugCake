<?php
class IssuesController extends BugCakeAppController {
    public $helpers = array('Html', 'Form');
    public $uses = array('DefaultModel', 'Issue');
    public $components = array('Paginator', 'Session', 'Cookie');
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Cookie->name = 'baker_id';
        $this->Cookie->time = 600;  // or '1 hour'
        $this->Cookie->path = '/';
        $this->Cookie->domain = 'bugcake.com';
        $this->Cookie->secure = false;  // i.e. only sent if using secure HTTPS
        $this->Cookie->key = 'qSI232qs*&sfytf65r6fc9-+!@#HKis~#^';
        $this->Cookie->httpOnly = false;

        if ($this->Session->read('Auth.User.username') != null || $this->Cookie->read('User.username') != null) {
            $user = $this->Session->read('Auth.User.username');
            if ($user == null) {$user = $this->Cookie->read('User.username');}
            $this->set('user', $user);
        } else {
            $this->redirect(array('action' => 'login'));
        }
    }
    
    public function tags($id=null, $action=null, $data=null) {
        if ($this->request->is('get')) {
           $this->redirect(array('action' => 'view', $id));
        }
        if ($this->Session->read('Auth.User.role') == 'admin' || $this->Cookie->read('User.role') == 'admin') {
            
            $post = $this->Issue->findById($id);
            if ($action == 'add') {
                $post['Issue']['tags'] = $post['Issue']['tags'].','.$this->request['data']['Issue']['tag'];
            }
            if ($action == 'delete') {
                if (strpos($post['Issue']['tags'], ','.$data)) {
                    $data = ','.$data;
                }
                $post['Issue']['tags'] = str_replace($data, '', $post['Issue']['tags']);
            }
            $this->Issue->create();
            $this->Issue->save($post);
            //$this->Session->setFlash(__(var_dump($post)));
        }
        $this->redirect(array('action' => 'view', $id));
    }
    
    
    public function search() {
        $this->layout = 'tracker';
        if ($this->request->is('post')) {
            $keywords = $this->request['data']['Issue']['search'];
            $options = array(
            'conditions' => array(
                'OR' => array(
                    'Issue.body LIKE' => '%'. $keywords . '%',
                    'Issue.title LIKE' => '%'. $keywords . '%'
                    )
                )
            );
            $this->set('posts', $this->Issue->find('all', $options));
        }
    }
    
    
    public function index($tags=null) {
        $this->layout = 'tracker';
        //$this->Session->setFlash(__('Welcome back'), 'info');
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
        
        $this->layout = 'tracker';

        $post = $this->Issue->findById($id);
        if (!$post) { $this->redirect(array('action' => 'index'));}
        
        $this->Paginator->settings = array('conditions' => array('Issue.comment_id =' => $id),
                                               'limit' => 6, 'order' => array('Issue.id' => 'desc'));
        $comments = $this->Paginator->paginate('Issue');
        
        
        $this->set('post', $post);
        $this->set('comments', $comments);
        
    }
    
    
    public function add() {
        $this->layout = 'tracker';
        if ($this->request->is('post')) {
            $this->Issue->create();
            $author = $this->Session->read('Auth.User.username');
            if ($author == null) {$author = $this->Cookie->read('User.username');}
            $this->Issue->set("author", $author);
            $this->Issue->set("tags", 'open');
            //var_dump($this->Issue);
            if ($this->Issue->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been saved.'), 'info');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Unable to add your post.'), 'info');
            }
        }
        
    }
    public function edit($id = null) {
        $this->layout = 'tracker';
        $post = $this->Issue->findById($id);
        if ($post['Issue']['author'] == $this->Session->read('Auth.User.username') ||
            $post['Issue']['author'] == $this->Cookie->read('User.username')) {

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
                $this->Session->setFlash(__('Unable to update your post.'), 'info');
            }
            if (!$this->request->data) {
                $this->request->data = $post;
            }
            
        } else {
            $this->redirect(array('action' => 'view', $id));
        }
    }
    
    public function delete($id) {
        $this->layout = 'tracker';
        
        if ($this->request->is('get')) {
            $this->redirect(array('action' => 'index'));
        }
        $post = $this->Issue->findById($id);
        if ($post['Issue']['author'] == $this->Session->read('Auth.User.username') ||
            $post['Issue']['author'] == $this->Cookie->read('User.username')) {
            if ($this->Issue->delete($id)) {
                $this->Session->setFlash(__('The post with id: %s has been deleted.', h($id)), 'info');
                $this->redirect(array('action' => 'index'));
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
            $author = $this->Session->read('Auth.User.username');
            if ($author == null) { $author = $this->Cookie->read('User.username');}
            $this->Issue->set("author", $author);
            $this->Issue->set("title", "comment");
            if ($this->Issue->save($this->request->data)) {
                $this->Session->setFlash('Your comment has been added.', 'info');
                //$this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Unable to add your comment.', 'info');
            }
            $this->redirect(array('action' => 'view', $post_id));
        }
    }
}
?>