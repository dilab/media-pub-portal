<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css('bootstrap.min');
		
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

    <style>
    body {
	  padding-top: 70px;
	}
    </style>
    
</head>
<body>

<?php echo $this->element('top-admin');?>

<div class="container">
	
	<div class="row">
	
	  <div class="col-lg-2 col-sm-2 col-sm-12">
		  <?php echo $this->element('menu-admin');?>
	  </div>
	  
	  
	  <div class="col-lg-10 col-sm-10">
	      <?php echo $this->Session->flash(); ?>
	
		  <?php echo $this->fetch('content'); ?>
	  </div>
      
      
      
      </div>
</div> <!-- /container -->
    
    <hr>
      <footer>
      <div class="container">
      	<p>Developed by <a href="http://www.the-di-lab.com">The-Di-Lab</a></p>
      </div>
      </footer>

	<?php // echo $this->element('sql_dump'); ?>
	
 	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php 
    echo $this->Html->script('https://code.jquery.com/jquery-1.10.2.min.js');
    echo $this->Html->script('bootstrap.min');
    echo $this->Html->script('app-admin.js');
    ?>
  </body>
</html>
