  
  <div class="six wide column">
    <div class="ui form segment">
        <?php echo $this->Form->create('Setting'); ?>
        <div class="ui slider checkbox"">
          <input name="admin" type="checkbox">
          <label>Admin only access</label>
        </div>
        <br><br><br>
        <div class="ui field">
            <input type="submit" value="Update Settings" class="ui green submit button" />
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
  </div>
  
  <script>$('.ui.checkbox').checkbox();</script>
  <?php if ($adminonly == 'true') { echo "<script>$('.ui.checkbox').checkbox('enable');</script>"; }?>