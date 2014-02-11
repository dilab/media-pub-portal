      	  <div class="col-lg-8 col-sm-8">
      	  
      	  		<?php echo $this->element('topbar');?>
      	  		
	      	  	<div class="row">
	      	  		<div class="col-lg-12">
	      	  			
	      	  			<?php echo $this->Session->flash();?>
	      	  			<div class="well">
	      	  				
	      	  				<p class="lead"><?php echo __('Submit Pictures, GIFS or Videos');?></p>
							<?php 
							echo $this->Form->create('User',array(
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
							
							echo $this->Form->input('title', array(
									'placeholder'=>__('Title')
							)
							);
							
							echo $this->Form->input('des', array(
									'label'=>array('class'=>'col-sm-2 control-label','text'=>__('Description')),
									'type'=>'textarea',
									'placeholder'=>__('Description (Optional)')
							)
							);
							
							echo $this->Form->input('type', array(
									'placeholder'=>'Type',
									'options'=>array(TYPE_IMG=>TYPE_IMG,TYPE_VID=>TYPE_VID),
									'between'=>'<div class="col-sm-5">',
									'class'=>'group-trigger form-control'
							)
							);
							
							echo $this->Form->input('source', array(
									'label'=>array('class'=>'col-sm-2 control-label','text'=>__('Source')),
									'placeholder'=>__('Source (Optional)')
							)
							);
							
							echo $this->Form->input('video_url',array(
									'label'=>array('text'=>__('Video URL'),'class'=>'col-sm-2 control-label'),
									'class'=>'group-video form-control'));
							
							echo $this->Form->input('picture_url',array(
									'label'=>array('text'=>__('Picture URL'),'class'=>'col-sm-2 control-label'),
									'class'=>'group-image form-control'));
							
							echo $this->Form->input('picture_upload_object',array('type'=>'file', 
									'class'=>'group-image form-control',
									'label'=>array('text'=>__('Upload file'),
									'class'=>'group-image col-sm-2 control-label')));
							
							echo $this->Form->input('Submit', array(
									'class'=>'btn btn-primary',
									'label'=>false,
									'type'=>'submit',
									'between'=>'<div class="col-sm-offset-2 col-sm-10">',
									'after'=>'</div>'
							));
							
							echo $this->Form->end();
							
							?>
							
						</div>
		
	      	  		</div>
				</div> 
				
				
	      </div>
	      
	      <div class="col-lg-4 col-sm-4 col-sm-12">
	      	<?php echo $this->element('sidebar');?>
	      </div>