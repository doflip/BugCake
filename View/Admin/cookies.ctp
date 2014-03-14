
  <div class="six wide column">
    <div class="ui form segment">
    <?php echo $this->Form->create('Setting'); ?>
    <div class="ui form">
      <div class="field">
        <h4>Name:</h4>
        <?php echo $this->Form->input('name', array('label' => false, 'value'=>$cookie_set->name)); ?>
      </div>
    </div>
    
    
    <div class="ui form">
      <div class="field">
        <h4>Time:</h4>
        <?php echo $this->Form->input('time', array('label' => false, 'value'=>$cookie_set->time)); ?>
      </div>
    </div>
    
    <div class="ui form">
      <div class="field">
        <h4>Path:</h4>
        <?php echo $this->Form->input('path', array('label' => false, 'value'=>$cookie_set->path)); ?>
      </div>
    </div>
    
    <div class="ui form">
      <div class="field">
        <h4>Domain:</h4>
        <?php echo $this->Form->input('domain', array('label' => false, 'value'=>$cookie_set->domain)); ?>
      </div>
    </div>
    
    <div class="ui form">
      <div class="field">
        <h4>Key:</h4>
        <?php echo $this->Form->input('key', array('label' => false, 'value'=>$cookie_set->key)); ?>
      </div>
    </div>
    
    
      <div class="ui two column page grid">
        <div class="column">
        <h4>Secure</h4>
          <div class="ui dropdown selection">
            <input name="secure" type="hidden">
            <div class="default text"><?php echo $cookie_set->secure; ?></div>
            <i class="dropdown icon"></i>
            <div class="menu">
              <div class="item" data-value="true">True</div>
              <div class="item" data-value="false">False</div>
            </div>
          </div>
        </div>
        <div class="column">
        <h4>HttpOnly</h4>
          <div class="ui dropdown selection">
            <input name="httpOnly" type="hidden">
            <div class="default text"><?php echo $cookie_set->httpOnly; ?></div>
            <i class="dropdown icon"></i>
            <div class="menu">
              <div class="item" data-value="true">True</div>
              <div class="item" data-value="false">False</div>
            </div>
          </div>
        </div>
      </div>
    <br>
    <div class="ui field">
        <input type="submit" value="Save Issue" class="ui green submit button" />
    </div>
    <?php echo $this->Form->end(); ?>
    </div>
  </div>
  