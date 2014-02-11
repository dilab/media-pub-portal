<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top navbar-inverse"
	role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
				data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span> 
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php 
			echo $this->Html->link(__('Media Pub Portal'),
									array('controller'=>'posts','action'=>'home','admin'=>false,'plugin'=>null),
										array('class'=>'navbar-brand '));
			?>
		</div>

		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<?php 
					$active = '';
				    if (!isset($categoryId)) {
				    	$active = 'active';
				    }
					echo '<li class="'.$active.'">';
					echo $this->Html->link('<span class="glyphicon glyphicon-home"></span> '.__('All'),
									array('controller'=>'posts','action'=>'home','admin'=>false,'plugin'=>null),
									array('escape'=>false));
					echo '</li>';
				
					$categories = $this->requestAction(array('controller'=>'posts','action'=>'categoryList','admin'=>false,'plugin'=>null));
					foreach ($categories as $cat) {
						$active = '';
						if (isset($categoryId) && $categoryId==$cat['Category']['id']) {
							$active = 'active';
						}
						echo '<li class="'.$active.'">';
						echo $this->Html->link('<span class="'.$cat['Category']['icon'].'"></span> '.$cat['Category']['name'],
									array('controller'=>'posts','action'=>'home',$cat['Category']['id'],'admin'=>false,'plugin'=>null),
									array('escape'=>false));
					    echo '</li>';
					}
				?>
			</ul>
			
			<ul class="nav navbar-nav navbar-right">
			  <li class="">
			  <?php  
						echo $this->Html->link(__('Submit').' <span class="glyphicon glyphicon-upload"></span> ',
									array('controller'=>'posts','action'=>'submit','admin'=>false,'plugin'=>null),
									array('escape'=>false)); ?>
			  </li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->

	</div>
</div>
