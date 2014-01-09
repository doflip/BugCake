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
  echo $this->Html->css('/bug_cake/css/semantic');
  echo $this->Html->script('/bug_cake/js/semantic');
  ?>
  <!-- Site Properities -->
  
</head>
<body class="index bgj">

      <div class="ui menu">

        <?php echo $this->Html->link('<i class="warning icon"></i> Create an issue', array('controller'=>'issues', 'action' => 'add'), array('class' => 'active green item', 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="bug icon"></i> All', array('controller'=>'issues', 'action' => 'index'), array('class' => 'active purple item', 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="empty checkbox icon"></i> Open', array('controller'=>'issues', 'action' => 'index', 0), array('class' => 'active red item', 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="checked checkbox icon"></i> Close', array('controller'=>'issues', 'action' => 'index', 1), array('class' => 'active blue item', 'escape' => false)); ?>
        <?php echo $this->Html->link('<i class="search icon"></i> Search', array('controller'=>'issues', 'action' => 'search'), array('class' => 'active teal item', 'escape' => false)); ?>

        <div class="right menu">
            <div class="ui dropdown item">
              User actions <i class="dropdown icon"></i>
              <div class="menu">
                <?php echo $this->Html->link('<i class="add icon"></i> Register', array('controller'=>'users', 'action' => 'add'), array('class' => 'item', 'escape' => false)); ?>
                <?php echo $this->Html->link('<i class="unlock icon"></i> Login', array('controller'=>'users', 'action' => 'login'), array('class' => 'item', 'escape' => false)); ?>
                <?php echo $this->Html->link('<i class="off icon"></i> Logout', array('controller'=>'users', 'action' => 'logout'), array('class' => 'item', 'escape' => false)); ?>

              </div>
            </div>  
        </div>
      
      </div>

      <?php echo $this->Session->flash(); ?>
      <?php echo $this->fetch('content'); ?>
      <script>
            $('.ui.dropdown')
              .dropdown({
                on: 'hover'
                }) 
            ;
      </script>
</body>

</html>