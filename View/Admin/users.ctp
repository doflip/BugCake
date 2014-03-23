  <div class="twelve wide column">
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
    <table class="ui table segment">
      <thead>
        <tr>
            <th>Actions</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>

        </tr>
      </thead>
      <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
            <td><a href="<?php echo $this->Html->url(array('action'=> 'users', $user['User']['id']));  ?>"><div class="small circular ui button">View</div></a>&nbsp
                        <?php
                          if($role != "admin") {
                              $url = $this->Html->url(array('action'=> 'admin_add', $user['User']['id']));
                              echo "<a href='". $url ."'><div class='small circular ui button'>Make admin</div></a>";
                            } else if($role == "admin") {
                              $url = $this->Html->url(array('action'=> 'admin_remove', $user['User']['id']));
                              echo "<a href='". $url ."'><div class='small circular ui button'>Remove admin</div></a>";
                            }
                        ?>
            </td>


            <td><?php echo h($user['User']['username']); ?></td>
            <td><?php echo h($user['User']['email']); ?></td>
            <td><?php echo h($user['User']['role']); ?></td>

            </tr>
            <?php endforeach; ?>
      </tbody>
    </table>
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
  </div>
</div>