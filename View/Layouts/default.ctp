<!DOCTYPE html>
<head>
  <!-- Standard Meta -->
  <?php echo $this->Html->charset(); ?>
  <title>
        Bug - Cake
  </title>
  <style>
      .bgj {
          background: url('/bug_cake/img/bg.jpg') repeat scroll 0 0 #FCFCFC;
      }
      a {
          text-decoration: none;  
      }
  </style>
  
  <script src="http://code.jquery.com/jquery-2.0.3.js"></script>
  <?php
  echo $this->Html->meta('favicon.ico', 'BugCake.favicon.ico', array('type' => 'icon'));
  echo $this->Html->meta('Issues', 'bug_cake/issues/index.rss', array('type' => 'rss'));
  echo $this->Html->css('BugCake.semantic');
  echo $this->Html->script('BugCake.semantic');
  ?>
  <!-- Site Properities -->
  
</head>
<body class="index bgj">

      <div class="ui menu">

        <?php echo $this->Html->link('<i class="warning icon"></i> Create an issue', array('plugin' => 'bug_cake', 'controller'=>'issues', 'action' => 'add'), array('class' => 'active green item', 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="bug icon"></i> All', array('plugin' => 'bug_cake', 'controller'=>'issues', 'action' => 'index'), array('class' => 'active purple item', 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="empty checkbox icon"></i> Open', array('plugin' => 'bug_cake', 'controller'=>'issues', 'action' => 'index', 'open'), array('class' => 'active red item', 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="checked checkbox icon"></i> Close', array('plugin' => 'bug_cake', 'controller'=>'issues', 'action' => 'index', 'close'), array('class' => 'active blue item', 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="search icon"></i> Search', array('plugin' => 'bug_cake', 'controller'=>'issues', 'action' => 'search'), array('class' => 'active teal item', 'escape' => false)); ?>

        <div class="right menu">
            <div class="ui dropdown item">
              <?php echo strtoupper($user); ?><i class="dropdown icon"></i>
              <div class="menu">
                <?php 
                if ($user == 'User Actions') { 
                  echo $this->Html->link('<i class="add icon"></i> Register', array('plugin' => 'bug_cake', 'controller'=>'users', 'action' => 'add'), array('class' => 'item', 'escape' => false)); 
                } else {
                  echo $this->Html->link('<i class="off icon"></i> Logout', array('plugin' => 'bug_cake', 'controller'=>'users', 'action' => 'logout'), array('class' => 'item', 'escape' => false)); 
                } ?>

              </div>
            </div>  
        </div>
      
      </div>
     
      <?php echo $this->Session->flash(); ?>
      <?php echo $this->fetch('content'); ?>
      
        <!-- <h6 class="ui right aligned tiny header">
            <p>Made with  <i class="black heart icon"></i>by lubbleup </p>
        </h6> -->
        <div class="ui divided horizontal footer link list right aligned page grid">
            <div class="item">Made with  <i class="black heart icon"></i>by <a href="https://github.com/intelligems/">LubbleUp</a> </div>
            <a class="item" href="https://github.com/intelligems/BugCake">Github</a>
        </div>
        
      <script>
            $('.ui.dropdown')
              .dropdown({
                on: 'hover'
                }) 
            ;
            
      </script>
</body>

</html>