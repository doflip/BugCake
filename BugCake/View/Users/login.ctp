<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
<div class="ui form">
  <div class="field">
    <h4>Username</h4>
    <?php echo $this->Form->input('username', array('label' => false)); ?>
  </div>
</div>

<div class="ui form">
  <div class="field">
    <h4>Password</h4>
    <?php echo $this->Form->input('password', array('label' => false, 'type'=>'password')); ?>
  </div>
</div>
<div class="ui field">
    <input type="submit" value="Login" class="ui green submit button" />
</div>
<?php echo $this->Form->end(); ?>