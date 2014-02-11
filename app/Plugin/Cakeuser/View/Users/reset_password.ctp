<div>
   
    <?php echo $this->Form->create('User',array('class'=>'form-horizontal','url'=>array('action'=>'reset_password',$code)));?>
    <fieldset>
    <legend><?php echo __('Reset password')?></legend>
    
    
    <div class="control-group">
    	<label class="control-label">Password</label>
	    <div class="controls">
	    	<?php echo $this->Form->input('password',array('class'=>'input-xlarge',
	    								'label'=>false,'type'=>'password',
	    								'div'=>false)); ?>
	    </div>
    </div>
    
    <div class="control-group">
    	<label class="control-label">Confirm Password</label>
	    <div class="controls">
	    	<?php echo $this->Form->input('password2',array('class'=>'input-xlarge',
	    								'label'=>false,'type'=>'password',
	    								'div'=>false)); ?>
	    </div>
    </div>
    
    
    <div class="form-actions">
    	<?php echo $this->Form->button('Submit',array('class'=>'btn')); ?>
    </div>
    
    </fieldset>
    <?php echo $this->Form->end();?>
</div>

