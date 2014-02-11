<?php 
	echo $this->Html->meta(
	    'description',
	    $post['Post']['title'],
	    array('inline'=>false)
	);
	
	echo $this->Html->meta(
			array('property' => 'og:type', 'content' => 'website'),
			null,
			array('inline'=>false)
	);
	
	echo $this->Html->meta(
			array('property' => 'og:title', 'content' => $post['Post']['title']),
			null,
			array('inline'=>false)
	);
	
	echo $this->Html->meta(
			array('property' => 'og:url', 'content' => Router::url(null,true)),
			null,
			array('inline'=>false)
	);
	
	echo $this->Html->meta(
			array('property' => 'og:image', 'content' => Router::url($post['Post']['picture_upload'],true),'block'=>false),
			null,
			array('inline'=>false)
	);
	
	echo $this->Html->meta(
			array('property' => 'og:description', 'content' => empty($post['Post']['des'])?$post['Post']['title']:$post['Post']['des']),
			null,
			array('inline'=>false)
	);
	
?>
<div class="col-lg-8 col-sm-8">

	<?php echo $this->element('topbar');?>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1 class="panel-title">
					 <?php 
						 echo  $post['Post']['title'];
					 ?>
					</h1>
					
					<ul class="list-inline" style="margin-top: 10px;">
						<li><small>
						<?php 
						echo $this->Html->link($post['Category']['name'],
												array('controller'=>'posts','action'=>'home',$post['Category']['id'],'admin'=>false,'plugin'=>null),
												array('escape'=>false));
						?>
						</small></li>
						<li>|</li>
						<li><small><?php echo $this->Time->format('d M Y',$post['Post']['created']);?></small></li>
						
						
						<?php if (!empty($post['Post']['source'])) :?>
						<li>|</li>
						<li><small><?php echo __('Source: '). $post['Post']['source'];?></small>
						<?php endif;?>
						</li>
					</ul>
					
					<p class="">
						<a class="btn btn-primary btn-sm btn-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo Router::url(null,true);?>" target="_blank">
						  <span class="fa fa-facebook fa-lg"></span> <?php echo __('Share on Facebook');?>
						</a>

						<a class="btn btn-primary btn-sm btn-twitter" href="https://twitter.com/share?url=<?php echo Router::url(null,true);?>" target="_blank"> 
						  <span class="fa fa-twitter fa-lg"></span> <?php echo __('Share on Twitter');?>
						</a>
					</p>
					


				</div>
				<div class="panel-body">
					<ul class="pager">
						<li class="previous <?php echo null==$prevPost?'disabled':'';?>">
						 <?php 
						 	if (null==$prevPost) {
						 		echo $this->Html->link('&larr; '.__('Older'),'#',array('escape'=>false));
						 	} else {
						 		echo $this->Html->link('&larr; '.__('Older'),
						 								array('controller'=>'posts','action'=>'view',$prevPost['Post']['slug'],'admin'=>false,'plugin'=>null),
						 								array('escape'=>false));
						 	}
						 ?>	
						</li>
						
						<li class="next <?php echo null==$nextPost?'disabled':'';?>">
						<?php 
						 	if (null==$nextPost) {
						 		echo $this->Html->link(__('Newer').' &rarr;','#',array('escape'=>false));
						 	} else {
						 		echo $this->Html->link(__('Newer').' &rarr;',
						 								array('controller'=>'posts','action'=>'view',$nextPost['Post']['slug'],'admin'=>false,'plugin'=>null),
						 								array('escape'=>false));
						 	}
						 ?>	
						</li>
					</ul>


					<p class="text-center">
						<?php 
						if (TYPE_IMG == $post['Post']['type']) {
							echo $this->Html->image($post['Post']['picture_upload'],array('style'=>'width:100%;'));
						}
						?>
					</p>

					<p><?php echo $post['Post']['des'];?> </p>

					<div class="well well-sm ">
						<?php 
						$options['data-href'] = Router::url(null,true); ;
						$options['data-numposts'] = 2;
						$options['data-colorscheme'] = 'light';
						echo $this->Facebook->comments($options);
						?>
					</div>
				</div>
			</div>

		</div>
	</div>

	<?php if (null!=$related): ?>
	<div class="row">
		<div class="col-lg-12">
			<h4><?php echo __('You may also want to see');?></h4>
			<hr />
		</div>
		<?php foreach($related as $post):?>
		<div class="col-lg-4 col-sm-4">
			<?php 
			echo $this->Html->link($this->Html->image($post['Post']['picture_upload_thumb']),
					array('action'=>'view',$post['Post']['slug'],'admin'=>false,'plugin'=>null),
					array('class'=>'thumbnail','escape'=>false));
			?>
		</div>
		<?php endforeach;?>
	</div>
	<?php endif;?>


</div>

<div class="col-lg-4 col-sm-4 col-sm-12">
	<?php echo $this->element('sidebar');?>
</div>
