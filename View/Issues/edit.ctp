<?php 
if ($comment == false) {
  echo $this->Form->create('Issue', array('url' => array('controller'=>'issues', 'action' => 'edit', $post['Issue']['id']))); 
?>
<div class="ui form">
  <div class="field">
    <?php echo $this->Form->input('title', array('label' => false, 'value'=>$post['Issue']['title'])); ?>
  </div>
</div>
<div class="ui form">
  <div class="field">
    <?php echo $this->Form->input('body', array('label' => false, 'value'=>$post['Issue']['body'])); ?>
  </div>
</div>

<?php 
} else { 
  echo $this->Form->create('Comment', array('url' => array('controller'=>'issues', 'action' => 'edit', $post['Issue']['id'], $comment['id'])));
?>

<div class="ui form">
  <div class="field">
    <?php echo $this->Form->input('body', array('label' => false, 'value' => $comment['body'])); ?>
  </div>
</div>

<?php } ?>


<?php if ($comment == false) { ?>

<div class="ui form">
  <div class="field">
    <?php echo $this->Form->input('tags', array('label' => false, 'value'=>$post['Issue']['tags'])); ?>
  </div>
</div>

<?php } ?>


<div class="ui field">
    <input type="submit" value="Save Issue" class="ui green submit button" />
</div>
<?php echo $this->Form->end(); ?>