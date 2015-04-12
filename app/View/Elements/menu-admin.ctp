<?php
    if (!isset($menu)) {
        $menu = '';
    }

    if (!isset($categoryId)) {
        $categoryId = '';
    }
?>
<div class="list-group">
	
	<?php echo $this->Html->link(__('Dashboard'),'/admin',array('class'=>'list-group-item '.($menu=='dashboard'?'active':'')));?>
	
	<?php 
	$categories = $this->requestAction(array('controller'=>'posts','action'=>'categoryList','admin'=>false,'plugin'=>null));
	foreach ($categories as $cat) {
		$active = '';
		if ($menu=='posts' && $categoryId==$cat['Category']['id']) {
			$active = 'active';
		}
		echo $this->Html->link($cat['Category']['name'],array('controller'=>'posts','action'=>'index',
											$cat['Category']['id'],'admin'=>true,'plugin'=>null),
												array('class'=>'list-group-item '.$active));
	}
	?>

    <!-- Coming soon -->
	<?php //echo $this->Html->link(__('Pages'),'/admin',array('class'=>'list-group-item '.($menu=='pages'?'active':'')));?>
	<?php //echo $this->Html->link(__('Settings'),'/admin',array('class'=>'list-group-item '.($menu=='settings'?'active':'')));?>
	
	
</div>
