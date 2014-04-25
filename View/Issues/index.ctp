<div class="main container">
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
            <th>Title</th>
            <th>Description</th>
            <th>Date</th>
        </tr>
      </thead>
      <tbody>
            <?php foreach ($posts as $post): ?>
            <tr>
            <td><a href="<?php echo $this->Html->url(array('action'=> 'view', $post['Issue']['id']));  ?>"><div class="small circular ui button">View</div></a></td>
            <td><?php echo h($post['Issue']['title']); ?></td>
            <td><?php echo h(mb_substr($post['Issue']['body'], 0, 40, 'UTF-8'))."..."; ?></td>
            <td><?php echo $post['Issue']['created']; ?></td>

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