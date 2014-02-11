<?php if ($posts!=null):?>
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
<?php endif;?>
