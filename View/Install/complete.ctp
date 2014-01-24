
<?php echo $this->Form->create('User', array('url' => array('controller' => 'install', 'action' => 'complete'))); ?>
<div class="ui field">
    <input type="submit" value="Complete the installation" class="ui green fluid submit button" />
</div>
<?php echo $this->Form->end(); ?>

<div class="ui steps">
    <div class="ui step">
        Table Creation
    </div>
    <div class="ui step">
        Admin account
    </div>
    <div class="ui active step">
        Complete
    </div>
</div>