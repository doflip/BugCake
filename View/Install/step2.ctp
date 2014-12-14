

<?php echo $this->Form->create('User', array('url' => array('controller' => 'install', 'action' => 'step2'))); ?>
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
<div class="ui form">
  <div class="field">
    <h4>Email</h4>
    <?php echo $this->Form->input('email', array('label' => false)); ?>
  </div>
</div>
<div class="ui field">
    <input type="submit" value="Register" class="ui green submit button" />
</div>
<?php echo $this->Form->end(); ?>

<div class="ui steps">
    <div class="ui step">
        Table Creation
    </div>
    <div class="ui active step">
        Admin account
    </div>
    <div class="ui disabled step">
        Complete
    </div>
</div>