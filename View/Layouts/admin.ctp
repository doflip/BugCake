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
    <div class="ui four column grid">
        <div class="column">
          <div class="ui vertical menu">
              <?php echo $this->Html->link('<i class="browser icon"></i> Cookies', array('plugin' => 'bug_cake', 'controller'=>'admin', 'action' => 'cookies'), array('class' => 'active teal item', 'escape' => false)); ?>
              <?php echo $this->Html->link('<i class="sitemap icon"></i> Access', array('plugin' => 'bug_cake', 'controller'=>'admin', 'action' => 'access'), array('class' => 'active purple item', 'escape' => false)); ?>
              <?php echo $this->Html->link('<i class="users icon"></i> Users Management', array('plugin' => 'bug_cake', 'controller'=>'admin', 'action' => 'users'), array('class' => 'active red item', 'escape' => false)); ?>
              <?php echo $this->Html->link('<i class="left icon"></i> Back', array('plugin' => 'bug_cake', 'controller'=>'issues', 'action' => 'index'), array('class' => 'active blue item', 'escape' => false)); ?>
          </div>
        </div>
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
        <?php echo $this->element('sql_dump'); ?>
    </div>
    <div class="ui divided horizontal footer link list right aligned page grid">
        <div class="item">Made with  <i class="black heart icon"></i>by <a href="https://github.com/intelligems/">Intelligems</a> </div>
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