      	  <div class="col-lg-8 col-sm-8">
      	  
      	  		<?php echo $this->element('topbar');?>
      	  		
	      	  	<div class="row">
	      	  		<?php foreach ($posts as $post) :?>
					  <div class="col-lg-4 col-sm-4">
					    <?php 
	      	  	      		echo $this->Html->link($this->Html->image($post['Post']['picture_upload_thumb']),
	      	  	      							   array('action'=>'view',$post['Post']['slug'],'admin'=>false,'plugin'=>null),
	      	  	      								array('class'=>'thumbnail','escape'=>false));
	      	  	        ?> 
					  </div>
				  <?php endforeach;?>
				</div> 
				
				<div class="row load-more-div" style="display:none;">
					<div class="col-lg-12">
						<?php 
						echo $this->Html->link(__('Load more').' <span class="caret"></span>',
												array('controller'=>'posts','action'=>'home_more','admin'=>false,'plugin'=>null),
												array('class'=>'btn btn-primary btn-block load-more-btn',
													  'data-category'=>$categoryId,
													  'data-page'=>1,
													  'data-loading-text'=>__('Loading...'),
													  'escape'=>false));
						?>
					</div>
				</div>
	      </div>
	      
	      <div class="col-lg-4 col-sm-4 col-sm-12">
	      	<?php echo $this->element('sidebar');?>
	      </div>