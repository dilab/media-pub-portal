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
		echo $this->Html->css('social-buttons-3');
		echo $this->Html->css('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

    <style>
    body {
	  padding-top: 70px;
	}

	.facebook-fan iframe, .fb_iframe_widget, .fb_iframe_widget span, .fb_iframe_widget iframe {
		width: 100% !important;
	}

    </style>

</head>
<body>

<?php echo $this->element('top');?>

<div class="container">
		  <div class="row">
		      <?php echo $this->Session->flash(); ?>
			  <?php echo $this->fetch('content'); ?>
	      </div>

	      <hr>
	      <footer>
	      <p>Developed by <a href="http://www.the-di-lab.com">The-Di-Lab</a></p>
	      </footer>
</div> <!-- /container -->


	<?php // echo $this->element('sql_dump'); ?>

 	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php
    echo $this->Html->script('https://code.jquery.com/jquery-1.10.2.min.js');
    echo $this->Html->script('bootstrap.min');
    echo $this->Html->script('app.js');
    ?>

  </body>
</html>