<div class="container">
    <div class="row">
        <div class="goodhead">
            <h1>Change Password</h1>
            <div class="aline"></div>
        </div>
        
        <div class="goodbox">
            <?php 
            echo $this->Session->flash(); 

            echo $this->Form->create('User',array(
                            'novalidate'=>true,
                            'autocomplete'=>'off',
                            'inputDefaults' => array(
                                'class'=>'text input',
                                'required'=>false
                            )));
            ?>

            <div class="field">
            	<label class="control-label">New Password</label>
        	    <div class="control">
        	    	<?php echo $this->Form->input('password',array(
        	    								'label'=>false,'type'=>'password',
        	    								'div'=>false, 'after'=>'<div class="spantext">'.__('Min 6 characters.').'</div>')); ?>
        	    </div>
            </div>
            
            <div class="field">
            	<label class="control-label">Retype New Password</label>
        	    <div class="control">
        	    	<?php echo $this->Form->input('password2',array(
        	    								'label'=>false,'type'=>'password',
        	    								'div'=>false)); ?>
                </div>
            </div>
            
            <div class="field">
                <div class="control">
                    <?php 
                        echo $this->Form->end(array(
                            'label' => __('Save'),
                            'class'=> 'btn btn-danger'
                            )
                        );
                    ?>
                </div>
            </div>  
        </div>
    </div>
</div>