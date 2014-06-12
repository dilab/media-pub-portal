<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top "
	role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span> <span
					class="icon-bar"></span> <span class="icon-bar"></span> <span
					class="icon-bar"></span>
			</button>
			<?php 
			echo $this->Html->link(__('Media Pub Portal Admin'),'/admin/',array('class'=>'navbar-brand'));
			?>
		</div>

		 <ul class="nav navbar-nav navbar-right">
	      <li class="dropdown">
	        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
	        <ul class="dropdown-menu">
	          <li>
                <?php echo $this->Html->link(__('Change Password'),array('action'=>'change_pwd','controller'=>'users','plugin'=>'cakeuser','admin'=>false));?>
	          <li>
                <?php echo $this->Html->link(__('Log Out'),array('action'=>'logout','controller'=>'users','plugin'=>'cakeuser','admin'=>false));?>
              </li>
	        </ul>
	      </li>
	    </ul>
		<!-- /.navbar-collapse -->

	</div>
</div>
