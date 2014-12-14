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

      
     
      <?php echo $this->Session->flash(); ?>
      <?php echo $this->fetch('content'); ?>
      
        <!-- <h6 class="ui right aligned tiny header">
            <p>Made with  <i class="black heart icon"></i>by lubbleup </p>
        </h6> -->
        <div class="ui divided horizontal footer link list right aligned page grid">
            <div class="item">Made with  <i class="black heart icon"></i>by <a href="http://lubbleup.com/">LubbleUp</a> </div>
            <a class="item" href="https://github.com/lubbleup/BugCake">Github</a>
        </div>
        
</body>

</html>