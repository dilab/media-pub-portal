<!DOCTYPE html>
<?php echo $this->Facebook->html(); ?>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title><?php echo $this->fetch('title');?></title>
  
    <!-- Le styles -->
    <?php echo $this->Html->css('Cakeuser.bootstrap.min.css');?>
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <?php echo $this->Html->css('Cakeuser.bootstrap-responsive.min.css');?>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <!-- <link rel="shortcut icon" href="http://twitter.github.com/bootstrap/assets/ico/favicon.ico">-->
  
    
  
 	<?php echo $this->fetch('css');?>
 	<?php echo $this->fetch('script');?>
 	<?php echo $this->fetch('meta');?>
  </head>

  <body>
  
   <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Cakeuser</a>
          <div class="nav-collapse">
            <ul class="nav">
              <?php if (!$this->Session->check('Auth.User')):?>
	              <li>
	              <?php echo $this->Html->link(__('Sign in'),array( 'controller'=>'users','action'=> 'login'));?>
	              </li>
	              <li>
	              <?php echo $this->Html->link(__('Registration'),array('controller'=>'users','action'=>'register'));?>
	              </li>
	               <li>
	              <?php echo $this->Html->link(__('Forget password'),array('controller'=>'users','action'=>'forget_password'));?>
	              </li>
              <?php else:?>
                    <li>
                    <?php echo $this->Html->link(__('Change Password'),array('controller'=>'users','action'=>'change_pwd'));?>
                    </li>
	              <li>	                
	                <?php echo $this->Html->link(__('Log out'),array('controller'=>'users','action'=>'logout'));?>
	              </li>
              <?php endif;?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
    
   <div class="container">
		<?php 
		echo $this->Session->flash();
		echo $this->fetch('content');
		?>
    </div> <!-- /container -->
    
   <?php //echo $this->element('sql_dump');?>
   <?php echo $this->Html->script('bootstrap.min.js');?>
  </body>
  <?php echo $this->Facebook->init(); ?>
</html>