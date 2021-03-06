<div class="ui raised segment">
<div class="ui ribbon label">
  <i class="code icon"></i> <?php echo h($post['Issue']['author']); ?>
</div>


Tags: 
<?php
if (strlen($post['Issue']['tags']) > 0) {
		foreach(explode(', ', $post['Issue']['tags']) as $tag) {
      if (strlen($tag) > 0) {

  		  echo '<div class="ui label">';
        echo $this->Html->link($tag, array('controller' => 'issues', 'action' => 'index', $tag));
  		  echo $this->Form->postlink('<i class="delete icon"></i>',
  		                             array('action' => 'tags_delete', $post['Issue']['id'], $tag),
  		                             array('escape'=>false));

  		  echo'</div>';
		}
  }
}
?>

<div class="ui icon input 4">
<?php echo $this->Form->create('Issue', array('url' => array('action' => 'tags_add', $post['Issue']['id'])));
echo $this->Form->input('tag', array('label' => false,
                                        'placeholder' => 'Add tag',
                                        'div'=>false));
echo $this->Form->end(); ?>
</div>

<?php
if ($post['Issue']['author'] == $this->Session->read('Auth.User.username')) {
  echo $this->Html->link("EDIT", array('action' => 'edit', $post['Issue']['id']), array('class'=>'ui teal label'));
  echo $this->Form->postLink("DELETE", array('action' => 'delete', $post['Issue']['id']),
                         array('confirm' => 'Are you sure?','class'=>'ui red label'));
}
?>
<h4 class="ui header"><?php echo h($post['Issue']['title']); ?></h4>
<p><?php echo h($post['Issue']['body']); ?></p>

</div>
<div class="ui divider"></div>

<?php foreach ($comments as $comment): ?>
<div class="ui raised segment">
<div class="ui ribbon label">
  <i class="code icon"></i> <?php echo h($comment['author']); ?>
</div>
<?php if ($comment['author'] == $this->Session->read('Auth.User.username')) {

echo $this->Html->link("EDIT", array('action' => 'edit', $post['Issue']['id'], $comment['id']), array('class'=>'ui teal label'));
echo $this->Form->postLink("DELETE", array('action' => 'delete', $post['Issue']['id'], $comment['id']),
                       array('confirm' => 'Are you sure?','class'=>'ui red label'));
} ?>
<p><?php echo h($comment['body']); ?></p>
</div>

<?php endforeach; ?>
<div class="ui three column divided grid">
  <div class="row">
    <div class="column">
        <div class="ui divider"></div>
    </div>
    <div class="column">
      <div class="ui 3 basic fluid buttons">
  <?php echo $this->Paginator->prev('<i class="double angle left icon"></i>',array('tag' => 'div', 'escape' => false, 'class' => 'ui active button'));?>
  <?php echo '<div class="ui active button">'.$this->Paginator->counter().'</div>'; ?>
  <?php echo $this->Paginator->next('<i class="double angle right icon"></i>',array('tag' => 'div', 'escape' => false, 'class' => 'ui active button'));?>
      </div>
    </div>
    <div class="column">
        <div class="ui divider"></div>
      </div>
    </div>
</div>

<h4>Post a Comment</h4>
<?php echo $this->Form->create('Comment', array('url' => array('controller' => 'issues', 'action'=> 'comment', $post['Issue']['id']), 'novalidate' => true)); ?>

<div class="ui form">
  <div class="field">
    <?php echo $this->Form->input('body', array('label' => false)); ?>
  </div>
</div>

<div class="ui field">
    <input type="submit" value="Add Comment" class="ui green submit button" />
</div>
<?php echo $this->Form->end(); ?>
<script>$('.ui.selection.dropdown').dropdown();</script>