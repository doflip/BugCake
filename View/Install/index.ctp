

<div class="ui segment"><div class="ui top attached label">SQL</div><pre>
<?php echo file_get_contents($sqlcode); ?>
</pre></div>

<?php echo $this->Form->create('User', array('url' => array('controller' => 'install', 'action' => 'index'))); ?>
<div class="ui field">
    <input type="submit" value="Run SQL code" class="ui green fluid submit button" />
</div>
<?php echo $this->Form->end(); ?>

<div class="ui steps">
    <div class="ui active step">Table Creation</div>
    <div class="ui disabled step">Admin account</div>
    <div class="ui disabled step">Complete</div>
</div>