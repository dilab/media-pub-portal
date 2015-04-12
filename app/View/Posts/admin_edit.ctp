<ol class="breadcrumb">
				  <li>
					  <?php echo $this->Html->link($category['Category']['name'],
										array('action'=>'index',$categoryId),
										array('escape'=>false));?>
				  </li>
				  <li class="active"><?php echo __('Add');?></li>
</ol>
			
<div class="well">
<?php 
		echo $this->Form->create('Post',array(
				'type'=>'file',
				'class'=>'form-horizontal',
				'inputDefaults' => array(
						'required'=>false,
						'class'=>'form-control',
						'div' => 'form-group',
						'between'=>'<div class="col-sm-10">',
						'after'=>'</div>',
						'label'=>array('class'=>'col-sm-2 control-label')
				)
		));

		echo $this->Form->input('title');
		echo $this->Form->input('des',array('label'=>array('text'=>__('Description'),'class'=>'col-sm-2 control-label')));
		
		echo $this->Form->input('source',array('label'=>array('text'=>__('Source (optional)'),'class'=>'col-sm-2 control-label')));
		
		if ($category['Category']['type'] == TYPE_IMG ) {
			echo $this->Form->input('picture_url', array('label'=>array('text'=>__('Picture URL'),'class'=>'col-sm-2 control-label'),
                                                         'after' => '<p class="help-block">Make sure this field is empty if you want to upload a file</p></div>',
                                                         'class'=>'group-picture form-control')
            );
		
			echo $this->Form->input('picture_upload_object',
                                    array(  'type'=>'file', 'class'=>'group-picture form-control',
                                            'label'=>array('text'=>__('Upload file'),'class'=>'col-sm-2 control-label')));
		
		} else {
			echo $this->Form->input('video_url',array('label'=>array('text'=>__('Video URL'),'class'=>'col-sm-2 control-label'),'class'=>'group-video form-control'));
		
		}
		
		
		echo $this->Form->input('status',array('options'=>Configure::read('status')));
		
		echo $this->Form->hidden('category_id',array('value'=>$categoryId));
		echo $this->Form->hidden('type',array('value'=>$category['Category']['type']));
		echo $this->Form->hidden('id');
		echo $this->Form->input(__('Save'),array('label'=>false, 'class'=>'btn btn-default','type'=>'submit')); 
		
		echo $this->Form->end();
?>
</div>