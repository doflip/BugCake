<div class="ui raised segment">
<div class="ui ribbon label">
  <i class="code icon"></i> <?php echo h($post['Issue']['author']); ?>
</div>


Tags: 
<?php
if (strlen($post['Issue']['tags']) > 0) {
	if (strpos($post['Issue']['tags'], ',')) {
		foreach(explode(',', $post['Issue']['tags']) as $tag) {

		  echo '<div class="ui label">'.$tag;
		  echo $this->Form->postlink('<i class="delete icon"></i>',
		                             array('action' => 'tags', $post['Issue']['id'], 'delete', $tag),
		                             array('escape'=>false));
		  echo'</div>';
		}
	} else {

	  echo '<div class="ui label">'.$post['Issue']['tags'];
	  echo $this->Form->postlink('<i class="delete icon"></i>',
	                             array('action' => 'tags', $post['Issue']['id'], 'delete', $post['Issue']['tags']),
	                             array('escape'=>false));
	  echo'</div>';
	}
}
?>

<div class="ui icon input 4">
<?php echo $this->Form->create('Issue', array('url' => array('action' => 'tags', $post['Issue']['id'], 'add')));
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
  <i class="code icon"></i> <?php echo h($comment['Issue']['author']); ?>
</div>
<?php if ($comment['Issue']['author'] == $this->Session->read('Auth.User.username')) {

echo $this->Html->link("EDIT", array('action' => 'edit', $comment['Issue']['id']), array('class'=>'ui teal label'));
echo $this->Form->postLink("DELETE", array('action' => 'delete', $comment['Issue']['id']),
                       array('confirm' => 'Are you sure?','class'=>'ui red label'));
} ?>
<p><?php echo h($comment['Issue']['body']); ?></p>
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
<?php echo $this->Form->create('Issue', array('url' => array('action'=> 'comment', $post['Issue']['id']), 'novalidate' => true)); ?>

<div class="ui form">
  <div class="field">
    <?php echo $this->Form->input('body', array('label' => false)); ?>
  </div>
</div>

<div class="ui field">
    <input type="submit" value="Save Issue" class="ui green submit button" />
</div>
<?php echo $this->Form->end(); ?>
<script>$('.ui.selection.dropdown').dropdown();</script>